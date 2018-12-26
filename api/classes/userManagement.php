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

    public static function getUserInfo($token) {
        $userDetails = getData("SELECT
        fullName,
        email,
        userDescription,
        feiLink,
        sjfLink FROM users WHERE token=:token",array('token'=>$token));
        return count($userDetails) == 0 ? 'not found' : $userDetails[0];
    }

    public static function logIn($loginData) {
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
        if ($userType['userType'] == 'admin'){
            return true;
        }else{
            return false;
        }
    }

    public static function updateData($token, $newUserDetails) {
        return $token . '<br>' . $newUserDetails;
    }

    public static function resetPassword($email) {
        $newToken = md5('jazdenieprekazdeho' . microtime());
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

    public static function deleteUser($token) {
        insertData("DELETE FROM users WHERE token = :token",array('token'=>$token));
        return true;
    }
    
    public static function addToNewsLetter($email){
        insertData("INSERT INTO newsletter (email) VALUES (:email)",array('email'=>$email['newsLetterEmail']));
        return true;
    }

    /* 
    *
    *    SUPPORT FUNCTIONS
    *
    */
    private static function updateAccessToken($userId,$newToken = null){
        if ($newToken == null){
            $newToken = md5('jazdenieprekazdeho' . microtime());
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
        $newToken = md5('jazdenieprekazdeho' . microtime());
        $userId = insertData("INSERT INTO users (email,fullName, facebookOrGmailId, token)
        VALUES (:email,:fullName,:facebookOrGmailId,:token)",array('email'=>$email,'fullName'=>$fullName,'facebookOrGmailId'=>$facebookOrGmailId,'token'=>$newToken));
        return $newToken;
    }

    private static function confirmRegistrationAndSendEmail($newUserId, $newUserMail){
        $newToken = md5('jazdenieprekazdeho' . microtime());
        insertData("INSERT INTO registrationConfirmation (userId,userEmail,token) VALUES (:userId,:userEmail,:token)",array('userId'=>$newUserId,'userEmail'=>$newUserMail,'token'=>$newToken));
        $contactInfo = array();
        $contactInfo['email'] = $newUserMail;
        $contactInfo['token'] = $newToken;
        sendEmail::sendConfirmationMail($contactInfo);
        return true;
    }
} 


?>