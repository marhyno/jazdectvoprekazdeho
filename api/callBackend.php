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
  
dispatch_post('/user/', 'registerUser');
    function registerUser()
    {
      print_r(userManagement::registerUser($_POST));
    }
  
dispatch_post('/user/isLoggedIn/', 'isUserLoggedIn');
    function isUserLoggedIn()
    {
      echo userManagement::isUserLoggedIn($_POST['token']);
    }

dispatch_post('/user/login/', 'logInUser');
    function logInUser()
    {
      echo userManagement::logIn($_POST);
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
  
dispatch_post('/getLocations/', 'getLocations');
    function getLocations()
    {
      print_r(siteAssetsFromDB::getLocations($_POST));
    }

dispatch_get('/getNumberOfNewsByCategories/', 'getNumberOfNewsByCategories');
    function getNumberOfNewsByCategories()
    {
      print_r(siteAssetsFromDB::getNumberOfNewsByCategories());
    }

dispatch_get('/getLatestNews/', 'getLatestNews');
    function getLatestNews()
    {
      print_r(siteAssetsFromDB::getLatestNews());
    }

dispatch_get('/getNewsArchiveList/', 'getNewsArchiveList');
    function getNewsArchiveList()
    {
      print_r(siteAssetsFromDB::getNewsArchiveList());
    }

dispatch_post('/sendFastEmail/', 'sendFastEmail');
    function sendFastEmail()
    {
      print_r(sendEmail::sendFastEmail($_POST));
    }

//RUN APPLICATION
run();
?>