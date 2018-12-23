<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


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

 /*
 *
 * USER
 * 
 */
dispatch_get('/user/:token/', 'getUserInfo');
    function getUserInfo()
    {
      $token = params('token');
      print_r(json_encode(userManagement::getUserInfo($token)));
    }
  
dispatch_post('/user/', 'registerUser');
    function registerUser()
    {
      print_r(userManagement::registerUser($_POST));
    }
  
dispatch_get('/user/isUserLoggedIn/:token/', 'isUserLoggedIn');
    function isUserLoggedIn()
    {
      $token = params('token');
      echo userManagement::isUserLoggedIn($token);
    }

dispatch_get('/user/isUserAdmin/:token/', 'isUserAdmin');
    function isUserAdmin()
    {
      $token = params('token');
      echo userManagement::isUserAdmin($token);
    }

dispatch_post('/user/login/', 'logInUser');
    function logInUser()
    {
      echo userManagement::logIn($_POST);
    }

dispatch_post('/user/logout/', 'logOutUser');
    function logOutUser()
    {
      echo $_POST['token'];
      echo userManagement::logOutUser($_POST['token']);
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

/*
 *
 * NEWS
 * 
 */
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

/*
 *
 * SERVICES AND BARNS
 * 
 */

dispatch_get('/getUserServices/:token/', 'getUserServices');
    function getUserServices()
    {
      $token = params('token');
      print_r(servicesAndBarns::getUserServices($token));
    }

dispatch_get('/getUserBarns/:token/', 'getUserBarns');
    function getUserBarns()
    {
      $token = params('token');
      print_r(servicesAndBarns::getUserBarns($token));
    }

dispatch_get('/getBarnDetails/:ID/', 'getBarnDetails');
    function getBarnDetails()
    {
      $ID = params('ID');
      print_r(servicesAndBarns::getBarnDetails($ID));
    }

  
/*
 *
 * EMAIL
 * 
 */
dispatch_post('/sendFastEmail/', 'sendFastEmail');
    function sendFastEmail()
    {
      print_r(sendEmail::sendFastEmail($_POST));
    }

dispatch_post('/addToNewsLetter/', 'addToNewsLetter');
    function addToNewsLetter()
    {
      print_r(userManagement::addToNewsLetter($_POST));
    }
    
//RUN APPLICATION
run();
?>