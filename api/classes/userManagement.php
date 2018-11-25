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

    public static function showUserDetails($userId) {
        return getData("SELECT ID,
        fullName,
        email,
        token,
        userType,
        isBarnAdmin,
        isTrainer,
        isVeterinary,
        isReferee,
        isShoer,
        isSaddler,
        location,
        mapLocation,
        userDescription,
        feiLink,
        sjfLink FROM users WHERE ID=:userId",array('userId'=>$userId));
    }

    public static function logIn($email, $inputPassword) {
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

    public static function logOut($token) {
        insertData("UPDATE users SET token = '' WHERE token = :token",array('token'=>$token));
        return true;
    }

    public static function isUserLoggedIn($token) {
        $fetchUser = getData("SELECT ID,password FROM users WHERE token=:token",array('token'=>$token));
        if (count($fetchUser) == 0){
            return false;
        }else{
            return true;
        }
    }

    public static function updateData($token, $newUserDetails) {
        $this->newUserDetails = $newUserDetails;
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
        return false;
    }
}


?>