<?php
setlocale(LC_ALL, 'sk_SK');

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
dispatch_post('/user/getMyInfo/', 'getMyInfo');
    function getMyInfo()
    {
      print_r(json_encode(userManagement::getMyInfo($_POST['token'])));
    }

dispatch_get('/user/getSpecificUserInfo/:ID', 'getSpecificUserInfo');
    function getSpecificUserInfo()
    {
      $ID = params('ID');
      print_r(json_encode(userManagement::getSpecificUserInfo($ID)));
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

dispatch_post('/user/isUserAdmin/', 'isUserAdmin');
    function isUserAdmin()
    {
      echo userManagement::isUserAdmin($_POST['token']);
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
 * SERVICES AND BARNS AND EVENTS
 * 
 */

dispatch_post('/getMyServices/', 'getMyServices');
    function getMyServices()
    {
      print_r(servicesBarnsEvents::getMyServices($_POST['token']));
    }

dispatch_post('/getMyBarns/', 'getMyBarns');
    function getMyBarns()
    {
      print_r(servicesBarnsEvents::getMyBarns($_POST['token']));
    }

dispatch_post('/getMyEvents/', 'getMyEvents');
    function getMyEvents()
    {
      print_r(servicesBarnsEvents::getMyEvents($_POST['token']));
    }

dispatch_get('/getBarnDetails/:ID/', 'getBarnDetails');
    function getBarnDetails()
    {
      $ID = params('ID');
      print_r(servicesBarnsEvents::getBarnDetails($ID));
    }

dispatch_get('/getServiceDetails/:ID/', 'getServiceDetails');
    function getServiceDetails()
    {
      $ID = params('ID');
      print_r(servicesBarnsEvents::getServiceDetails($ID));
    }

dispatch_get('/getEventDetails/:ID/', 'getEventDetails');
    function getEventDetails()
    {
      $ID = params('ID');
      print_r(servicesBarnsEvents::getEventDetails($ID));
    }

dispatch_post('/searchServices/', 'searchServices');
    function searchServices()
    {
      print_r(servicesBarnsEvents::searchServices($_POST));
    }

dispatch_post('/getSpecialServiceCriteria/', 'getSpecialServiceCriteria');
    function getSpecialServiceCriteria()
    {
      print_r(servicesBarnsEvents::getSpecialServiceCriteria($_POST['type']));
    }
/*
 *
 * NEW ASSETS
 * 
*/
dispatch_post('/addNewBarn/', 'addNewBarn');
    function addNewBarn()
    {
      print_r(servicesBarnsEvents::addNewBarn($_POST, $_FILES));
    }

dispatch_post('/addNewService/', 'addNewService');
    function addNewService()
    {
      print_r(servicesBarnsEvents::addNewService($_POST, $_FILES));
    }

dispatch_post('/addNewEvent/', 'addNewEvent');
    function addNewEvent()
    {
      print_r(servicesBarnsEvents::addNewEvent($_POST, $_FILES));
    }

dispatch_post('/getFiveEvents/', 'getFiveEvents');
    function getFiveEvents()
    {
      print_r(servicesBarnsEvents::getFiveEvents($_POST));
    }

/*
 *
 * EDIT ASSETS 
 * 
 */

 dispatch_post('/saveEditBarn/', 'saveEditBarn');
    function saveEditBarn()
    {
      print_r(servicesBarnsEvents::saveEditBarn($_POST, $_FILES));
    }

dispatch_post('/saveEditService/', 'saveEditService');
    function saveEditService()
    {
      print_r(servicesBarnsEvents::saveEditService($_POST, $_FILES));
    }

dispatch_post('/saveEditEvent/', 'saveEditEvent');
    function saveEditEvent()
    {
      print_r(servicesBarnsEvents::saveEditEvent($_POST, $_FILES));
    }

dispatch_get('/getLocationFromBacked/:entity/', 'getLocationFromBacked');
    function getLocationFromBacked()
    {
      $entity = params('entity');
      print_r(servicesBarnsEvents::getLocationFromBacked($entity));
    }

dispatch_post('/removeAssetFromDB/', 'removeAssetFromDB');
    function removeAssetFromDB()
    {
      print_r(servicesBarnsEvents::removeAssetFromDB($_POST));
    }

dispatch_post('/removeSingleImageFromAssetGallery/', 'removeSingleImageFromAssetGallery');
    function removeSingleImageFromAssetGallery()
    {
      print_r(fileManipulation::removeSingleImageFromAssetGallery($_POST));
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

/*
 *
 * MARKET
 * 
 */
dispatch_post('/addNewItemToMarket/', 'addNewItemToMarket');
    function addNewItemToMarket()
    {
      print_r(market::addNewItemToMarket($_POST, $_FILES));
    }

dispatch_post('/saveEditItemInMarket/', 'saveEditItemInMarket');
    function saveEditItemInMarket()
    {
      print_r(market::saveEditItemInMarket($_POST, $_FILES));
    }

dispatch_post('/getMyMarketItems/', 'getMyMarketItems');
    function getMyMarketItems()
    {
      print_r(market::getMyMarketItems($_POST['token']));
    }

dispatch_get('/getSubcategoriesFromMain/:mainCategory', 'getSubcategoriesFromMain');
    function getSubcategoriesFromMain()
    {
      $mainCategory = params('mainCategory');
      print_r(market::getSubcategoriesFromMain($mainCategory));
    }

dispatch_get('/getAdvertInfo/:ID', 'getAdvertInfo');
    function getAdvertInfo()
    {
      $ID = params('ID');
      print_r(market::getAdvertInfo($ID));
    }

dispatch_post('/searchMarket/', 'searchMarket');
    function searchMarket()
    {
      print_r(market::searchMarket($_POST));
    }

//RUN APPLICATION
run();
?>