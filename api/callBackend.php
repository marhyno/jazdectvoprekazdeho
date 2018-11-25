<?php

# as API is in subfolder, this file must be defined as root path
define('base_url', '/api/callBackend.php');

# include limonade Framework
require_once('lib/limonade.php');

# include classes
spl_autoload_register(function ($class_name) {
  include 'classes/' . $class_name . '.php';
});

# include DB Manipulation + DB connector 
require_once('classes/easypdo.php');


/* * * * * * * * * * *
 *                   *
 *                   *
 *     API CALLS     *
 *                   *
 *                   *
 * * * * * * * * * * */


dispatch_get('/user/:userId/', 'getUserInfo');
    function getUserInfo()
    {
      $userId = params('userId');
      print_r(userManagement::showUserDetails($userId));
    }
  
dispatch_post('/user/isLoggedIn/', 'isUserLoggedIn');
    function isUserLoggedIn()
    {
      echo userManagement::isUserLoggedIn($_POST['token']);
    }

dispatch_post('/user/login/', 'logInUser');
    function logInUser()
    {
      echo userManagement::logIn($_POST['email'],$_POST['password']);
    }

dispatch_post('/user/logout/', 'logOutUser');
    function logOutUser()
    {
      echo userManagement::logOut($_POST['token']);
    }

dispatch_delete('/user/deleteUser/', 'deleteUser');
    function deleteUser()
    {
      $token = apache_request_headers()['token'];
      echo userManagement::deleteUser($token);
    }

dispatch_put('/user/', 'updateUserData');
    function updateUserData()
    {
      $userData = apache_request_headers()['data'];
      $token = apache_request_headers()['token'];
      $userData = str_replace("'",'"',$userData);
      $userData = json_decode(stripslashes($userData),true);
      echo userManagement::updateData($token,$userData);
    }

dispatch_post('/user/resetPassword/', 'resetPassword');
    function resetPassword()
    {
      echo userManagement::resetPassword($_POST['email']);
    }
    //RUN APPLICATION
run();
?>