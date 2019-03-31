<?php
class userManagement{
    private $email = "";
    private $password = "";
    private $token = "";
    private $newUserDetails = array();

    public function __construct() {
        // allocate your stuff
    }

    //
    //  METHODS
    //

    public static function getMyInfo($token) {
        $userDetails = getData("SELECT ID,
        fullName,
        email,
        phoneNumber,
        userPhoto,
        userDescription,
        feiLink,
        sjfLink FROM users WHERE token=:token",array('token'=>$token));
        return count($userDetails) == 0 ? 'not found' : $userDetails[0];
    }

    public static function logInUser($loginData) {
        switch ($loginData['method']) {
            case 'regular':
                return userManagement::logInRegular($loginData);
            case 'facebook':
            case 'gmail':
                return userManagement::logInFbOrGmail($loginData);
            default:
                # code...
                break;
        }
    }

    public static function logOutUser($token) {
        insertData("UPDATE users SET token = '' WHERE token = :token",array('token'=>$token));
        return true;
    }

    public static function registerUser($data) {
        if (!userManagement::passwordMeetsMinimumRequirements($data['password'])){
            return 'Slabé heslo';
        }

        if ($data['email'] == ""){
            return 'Prázdne polia alebo nesprávny tvar emailu';
        }

        if ($data['password'] != "" && $data['fullName'] != "" && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            return 'Prázdne polia alebo nesprávny tvar emailu';
        }
        //hash PW
        $password = password_hash($data['password'],PASSWORD_DEFAULT);
        //return number of affected users -> 1 = OK / 0 = duplicate exists
        $newUser = insertData("INSERT INTO users (fullName, email, password)
        VALUES (:fullName,:email,:password)",array('fullName'=>$data['fullName'],'email'=>$data['email'],'password'=>$password));
        echo $newUser;
        if ($newUser == 1){
            $newUserId = getData("SELECT ID FROM users ORDER BY ID DESC LIMIT 1",null)[0]['ID'];
            userManagement::confirmRegistrationAndSendEmail($newUserId, $data['email']);
        }
    }

    public static function completeRegistration($registrationToken){
        $fetchUser = getData("SELECT userId FROM registrationConfirmation WHERE token=:token",array('token'=>$registrationToken));
        if (count($fetchUser) == 0){
            return 'Užívateľ neexistuje.';
        }else{
            insertData("DELETE FROM registrationConfirmation WHERE token=:token",array('token'=>$registrationToken));
            return 'token:' . userManagement::updateAccessToken($fetchUser[0]['userId']);
        }
    }

    public static function isUserLoggedIn($token) {
        $fetchUser = getData("SELECT ID FROM users WHERE token=:token",array('token'=>$token));
        if (count($fetchUser) == 0){
            return false;
        }else{
            return true;
        }
    }

    public static function isUserAdmin($token){
        $userType = getData("SELECT userType FROM users WHERE token=:token",array('token'=>$token))[0];
        if ($userType['userType'] == 'admin' || $userType['userType'] == 'superadmin'){
            return true;
        }else{
            return false;
        }
    }

    public static function updateUserData($newUserDetailsWithToken, $files) {
        $newPassword = "";
        if (!userManagement::isUserLoggedIn($newUserDetailsWithToken['token'])){
            return 'Užívaťeľ nie je prihlásený';
        }
        if ($newUserDetailsWithToken['newPassword'] != ""){
            if ($newUserDetailsWithToken['newPassword'] == $newUserDetailsWithToken['newPasswordRepeat']){
                if (!userManagement::passwordMeetsMinimumRequirements($newUserDetailsWithToken['newPasswordRepeat'])){
                    return 'Slabé heslo';
                }else{
                    $newPassword = password_hash($newUserDetailsWithToken['newPasswordRepeat'],PASSWORD_DEFAULT);
                }
            }else{
                return 'Heslá sa nezhodujú';
            }
        }

        if (count($files) > 0){
            $imagePaths = fileManipulation::saveFiles($files['userImage'], '/img/userImages/');
            userManagement::removeOldProfilePictures($newUserDetailsWithToken['token']);
        }

        $updateQuery = "UPDATE users SET 
                        fullName = :fullName,
                        email = :email,
                        phoneNumber = :phoneNumber,";
        $updateQuery .= $newPassword != "" ? "password = :newPassword," : "";
        $updateQuery .= count($imagePaths) > 0 ? "userPhoto = :userPhoto," : "";
        $updateQuery .= "sjfLink = :sjfLink,
                        feiLink = :feiLink,
                        userDescription = :userDescription WHERE token = :token";
        $updateParameters = array(
            "fullName" => $newUserDetailsWithToken['fullName'],
            "email" => $newUserDetailsWithToken['email'],
            "phoneNumber" => $newUserDetailsWithToken['phoneNumber'],
            "sjfLink" => $newUserDetailsWithToken['sjfLink'],
            "feiLink" => $newUserDetailsWithToken['feiLink'],
            "userDescription" => $newUserDetailsWithToken['userDescription'],
            "token" => $newUserDetailsWithToken['token'],
            );
        if ($newPassword != ""){
            $updateParameters['newPassword'] = $newPassword;
        }
        if (count($imagePaths) > 0){
            $updateParameters['userPhoto'] = $imagePaths[0];
        }

        insertData($updateQuery,$updateParameters);
    }

    public static function resetPassword($email) {
        $newToken = password_hash('jazdenieprekazdeho' . microtime(),PASSWORD_DEFAULT);
        $userId = getData("SELECT ID FROM users WHERE email = :email",array('email'=>$email))[0]['ID'];
        insertData("INSERT INTO resetPassword (userId,userEmail, resetToken) VALUES (:userId,:userEmail,:resetToken) ON DUPLICATE KEY UPDATE resetToken = :resetToken",array('userId'=>$userId,'userEmail'=>$email,'resetToken'=>$newToken));
        $contactInfo = array();
        $contactInfo['email'] = $email;
        $contactInfo['token'] = $newToken;
        sendEmail::sendResetPassword($contactInfo);
        return true;
    }

    public static function saveNewPassword($tokenAndNewPassword){
        $resetToken = $tokenAndNewPassword['resetToken'];
        $newPassword = $tokenAndNewPassword['newPassword'];
        
        $fetchUser = getData("SELECT userId FROM resetPassword WHERE resetToken=:resetToken",array('resetToken'=>$resetToken));
        if (count($fetchUser) == 0){
            return 'Užívateľ neexistuje.';
        }else{
            if (!userManagement::passwordMeetsMinimumRequirements($newPassword)){
                return 'Slabé heslo';
            }
            $newPassword = password_hash($newPassword,PASSWORD_DEFAULT);
            insertData("UPDATE users SET password = :newPassword WHERE ID = :userId",array('newPassword'=>$newPassword,'userId'=>$fetchUser[0]['userId']));
            insertData("DELETE FROM resetPassword WHERE resetToken = :resetToken",array('resetToken'=>$resetToken));
            return 'updated';
        }
    }

    public static function resendRegisterLink($email){
        $desiredUser = getData("SELECT ID FROM users WHERE email = :email",array('email'=>$email));
        if (count($desiredUser) == 0){
            return 'Užívateľ neexistuje.';
        }else{
            userManagement::confirmRegistrationAndSendEmail($desiredUser[0]['ID'], $email);
        }
    }

    public static function deleteUser($token) {
        insertData("DELETE FROM users WHERE token = :token",array('token'=>$token));
        return true;
    }
    
    public static function addToNewsLetter($email){
        insertData("INSERT INTO newsletter (email) VALUES (:email)",array('email'=>$email['newsLetterEmail']));
        return true;
    }

    public static function removeFromNewsletter($email){
        insertData("DELETE FROM newsletter WHERE email = :email",array('email'=>$email['newsLetterEmail']));
        return true;
    }



    public static function getSpecificUserInfo($ID){
        $userDetails = array();
        $userDetails['generalDetails'] = getData("SELECT ID,
        fullName,
        email,
        phoneNumber,
        userPhoto,
        userDescription,
        feiLink,
        sjfLink FROM users WHERE ID=:ID",array('ID'=>$ID));
        $userDetails['userBarns'] = servicesBarnsEvents::getUserBarns($ID);
        $userDetails['userServices'] = servicesBarnsEvents::getUserServices($ID);
        $userDetails['userEvents'] = servicesBarnsEvents::getUserEvents($ID);
        $userDetails['userMarketItems'] = market::getUserMarketItems($ID);

        return $userDetails;
    }

    /* 
    *
    *    SUPPORT FUNCTIONS
    *
    */
    
    private static function updateAccessToken($userId,$newToken = null){
        if ($newToken == null){
            $newToken = password_hash('jazdenieprekazdeho' . microtime(),PASSWORD_DEFAULT);
        }
        insertData("UPDATE users SET token = :newToken WHERE ID = :userId",array('newToken'=>$newToken,'userId'=>$userId));
        return $newToken;
    }

    private static function passwordMeetsMinimumRequirements($newPassword){
        if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,50}$/', $newPassword)) {
            return false;
        }else{
            return true;
        }
    }

    private static function logInRegular($loginData){
        $email = $loginData['email'];
        $inputPassword = $loginData['password'];
        //check if account has been confirmed
        $fetchUser = getData("SELECT ID FROM registrationConfirmation WHERE userEmail=:email",array('email'=>$email));
        if (count($fetchUser) > 0){
            return false;
        }

        //fetchUser -> check if exists
        $fetchUser = getData("SELECT ID,password FROM users WHERE email=:email",array('email'=>$email));
        if (count($fetchUser) == 0){
            return false;
        }else{
            $savedPassword = $fetchUser[0]['password'];
            $userId = $fetchUser[0]['ID'];
            if (password_verify($inputPassword, $savedPassword)) {
                //return back token and update DB
                return userManagement::updateAccessToken($userId);
            }else {
                return false;
            }
        }
    }

    private static function logInFbOrGmail($loginData){
        $email = $loginData['email'];
        $facebookOrGmailId = $loginData['facebookOrGmailId'];
        $fullName = $loginData['fullName'];
        
        //fetchUser -> check if exists
        $fetchUser = getData("SELECT ID FROM users WHERE email=:email AND facebookOrGmailId = :facebookOrGmailId",array('email'=>$email,'facebookOrGmailId'=>$facebookOrGmailId));
        if (count($fetchUser) == 0){
            return userManagement::registerNewFbOrGmailAccountAndReturnToken($loginData);
        }else{
            $userId = $fetchUser[0]['ID'];
            return userManagement::updateAccessToken($userId);
        }
    }

    private static function registerNewFbOrGmailAccountAndReturnToken($loginData){
        $email = $loginData['email'];
        $facebookOrGmailId = $loginData['facebookOrGmailId'];
        $fullName = $loginData['fullName'];
        $newToken = password_hash('jazdenieprekazdeho' . microtime(),PASSWORD_DEFAULT);
        $userId = insertData("INSERT INTO users (email,fullName, facebookOrGmailId, token)
        VALUES (:email,:fullName,:facebookOrGmailId,:token) ON DUPLICATE KEY UPDATE facebookOrGmailId = :facebookOrGmailId, token = :token",array('email'=>$email,'fullName'=>$fullName,'facebookOrGmailId'=>$facebookOrGmailId,'token'=>$newToken));
        return $newToken;
    }

    private static function confirmRegistrationAndSendEmail($newUserId, $newUserMail){
        $newToken = password_hash('jazdenieprekazdeho' . microtime(),PASSWORD_DEFAULT);
        insertData("INSERT INTO registrationConfirmation (userId,userEmail,token) VALUES (:userId,:userEmail,:token) ON DUPLICATE KEY UPDATE token = :token",array('userId'=>$newUserId,'userEmail'=>$newUserMail,'token'=>$newToken));
        $contactInfo = array();
        $contactInfo['email'] = $newUserMail;
        $contactInfo['token'] = $newToken;
        sendEmail::sendConfirmationMail($contactInfo);
        return true;
    }

    private static function removeOldProfilePictures($token){
        $currentUserPhotoPath = getData("SELECT userPhoto FROM users WHERE token=:token",array('token'=>$token))[0]['userPhoto'];
        unlink($_SERVER["DOCUMENT_ROOT"] . $currentUserPhotoPath);
    }
} 


?>