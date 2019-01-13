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

dispatch_post('/user/completeRegistration/', 'completeRegistration');
    function completeRegistration()
    {
      print_r(userManagement::completeRegistration($_POST['registrationToken']));
    }

dispatch_post('/user/saveNewPassword/', 'saveNewPassword');
    function saveNewPassword()
    {
      print_r(userManagement::saveNewPassword($_POST));
    }

dispatch_post('/user/resendRegisterLink/', 'resendRegisterLink');
    function resendRegisterLink()
    {
      print_r(userManagement::resendRegisterLink($_POST['email']));
    }
  
dispatch_post('/user/isUserLoggedIn/', 'isUserLoggedIn');
    function isUserLoggedIn()
    {
      echo userManagement::isUserLoggedIn($_POST['token']);
    }

dispatch_get('/user/isUserAdmin/:token/', 'isUserAdmin');
    function isUserAdmin()
    {
      $token = params('token');
      echo userManagement::isUserAdmin($token);
    }

dispatch_post('/user/logInUser/', 'logInUser');
    function logInUser()
    {
      echo userManagement::logInUser($_POST);
    }

dispatch_post('/user/logOutUser/', 'logOutUser');
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

dispatch_post('/user/updateUserData/', 'updateUserData');
    function updateUserData()
    {
      print_r(userManagement::updateUserData($_POST, $_FILES));
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

dispatch_get('/getLatestNewsSideBar/', 'getLatestNewsSideBar');
    function getLatestNewsSideBar()
    {
      print_r(siteAssetsFromDB::getLatestNewsSideBar());
    }

dispatch_get('/getNewsArchiveList/', 'getNewsArchiveList');
    function getNewsArchiveList()
    {
      print_r(siteAssetsFromDB::getNewsArchiveList());
    }

dispatch_post('/getAllNewsList/', 'getAllNewsList');
    function getAllNewsList()
    {
      print_r(siteAssetsFromDB::getAllNewsList($_POST));
    }

dispatch_get('/getTwoLastNewsForIndexPage/', 'getTwoLastNewsForIndexPage');
    function getTwoLastNewsForIndexPage()
    {
      print_r(siteAssetsFromDB::getTwoLastNewsForIndexPage());
    }

dispatch_get('/getFiveNewsInNewsPage/:category/:currentPage/:search/', 'getFiveNewsInNewsPage');
    function getFiveNewsInNewsPage()
    {
      $category = params('category');
      $currentPage = params('currentPage');
      $search = params('search');
      print_r(siteAssetsFromDB::getFiveNewsInNewsPage(array('inputCategory'=>$category, 'currentPage'=>$currentPage, 'search'=>$search)));
    }

dispatch_get('/getSingleNewsArticle/:articleID/', 'getSingleNewsArticle');
    function getSingleNewsArticle()
    {
      $articleID = params('articleID');
      print_r(siteAssetsFromDB::getSingleNewsArticle($articleID));
    }

dispatch_post('/addNewArticle/', 'addNewArticle');
    function addNewArticle()
    {
      print_r(siteAssetsFromDB::addNewArticle($_POST, $_FILES));
    }

dispatch_post('/removeArticle/', 'removeArticle');
    function removeArticle()
    {
      print_r(siteAssetsFromDB::removeArticle($_POST));
    }

dispatch_get('/getCategories/', 'getCategories');
    function getCategories()
    {
      print_r(siteAssetsFromDB::getCategories(true));
    }

dispatch_post('/updateArticle/', 'updateArticle');
    function updateArticle()
    {
      print_r(siteAssetsFromDB::updateArticle($_POST, $_FILES));
    }

dispatch_post('/approveArticle/', 'approveArticle');
    function approveArticle()
    {
      print_r(siteAssetsFromDB::approveArticle($_POST, $_FILES));
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

dispatch_get('/getServiceDetails/:ID/', 'getServiceDetails');
    function getServiceDetails()
    {
      $ID = params('ID');
      print_r(servicesAndBarns::getServiceDetails($ID));
    }

dispatch_post('/searchServices/', 'searchServices');
    function searchServices()
    {
      print_r(servicesAndBarns::searchServices($_POST));
    }

dispatch_post('/searchMarket/', 'searchMarket');
    function searchMarket()
    {
      print_r(servicesAndBarns::searchMarket($_POST));
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