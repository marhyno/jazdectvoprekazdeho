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
        searchable,
        isBarnAdmin,
        isTrainer,
        isVeterinary,
        isReferee,
        isShoer,
        isSaddler,
        location,
        `range`,
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
        if ($data['password'] != "" && $data['fullName'] != "" && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            return 'Prázdne polia alebo nesprávny tvar emailu';
        }
        //hash PW
        $password = password_hash($data['password'],PASSWORD_DEFAULT);
        //return number of affected users -> 1 = OK / 0 = duplicate exists
        echo insertData("INSERT INTO users (fullName, email, password)
        VALUES (:fullName,:email,:password)",array('fullName'=>$data['fullName'],'email'=>$data['email'],'password'=>$password));
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
        MailPrepare::sendEmail($email);
    }

    public static function deleteUser($token) {
        insertData("DELETE FROM users WHERE token = :token",array('token'=>$token));
        return true;
    }

    /// SUPPORT FUNCTIONS ///
    private static function updateAccessToken($userId,$newToken){
        insertData("UPDATE users SET token = :newToken WHERE ID = :userId",array('newToken'=>$newToken,'userId'=>$userId));
        return true;
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
                $newToken = md5('jazdenieprekazdeho' . microtime());
                userManagement::updateAccessToken($userId,$newToken);
                return $newToken;
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
            $newToken = md5('jazdenieprekazdeho' . microtime());
            userManagement::updateAccessToken($userId,$newToken);
            return $newToken;
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
} 


?>