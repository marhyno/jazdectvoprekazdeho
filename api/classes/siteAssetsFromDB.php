<?php
setlocale(LC_ALL, 'sk_SK');

class siteAssetsFromDB{

    public function __construct() {
        // allocate your stuff
    }

    //
    //  METHODS
    //

    public static function getLocations($locationDetails) {
        $whereQuery = "";
        if (!isset($locationDetails['province']) || $locationDetails['province'] == ""){
            $province = '%%';
        }else{
            $province = explode('|',$locationDetails['province'])[1];
        }
        if (!isset($locationDetails['region']) || $locationDetails['region'] == ""){
            $region = '%%';
        }else{
            $region = explode('|',$locationDetails['region'])[1];
        }
        if (!isset($locationDetails['localCity']) || $locationDetails['localCity'] == ""){
            $localCity = '%%';
        }else{
            $localCity = explode('|',$locationDetails['localCity'])[1];
        }
        //
        return json_encode(getData("SELECT localCity, region, province FROM slovakPlaces WHERE province LIKE :province AND region LIKE :region AND localCity LIKE :localCity ORDER BY province ASC,region ASC, localCity ASC",
        array('province' => $province,'region' => $region,'localCity' => $localCity)));
    }

    public static function getLocationId($province, $region, $localCity) {
        return getData("SELECT ID FROM slovakPlaces WHERE province = :province AND region = :region AND localCity = :localCity",
        array('province' => explode('|',$province)[1],
              'region' => explode('|',$region)[1],
              'localCity' => explode('|',$localCity)[1])
              )[0]['ID'];
    }

    public static function getNumberOfNewsByCategories(){
        return json_encode(getData("SELECT DISTINCT categoryName, newsCount FROM
        ((SELECT '' as categoryName, COUNT(news.ID) as newsCount FROM news WHERE news.visible = 1 AND news.published = 1) 
        UNION
        (SELECT categoryName, COUNT(news.ID) as newsCount FROM categories 
            LEFT JOIN newsCategories ON categories.ID = newsCategories.categoryId 
            LEFT JOIN news ON newsCategories.newsId = news.ID WHERE news.visible = 1 AND news.published = 1
            GROUP BY categoryName ORDER BY categories.ID ASC)
        UNION  DISTINCT
        (SELECT categoryName, COUNT(news.ID) as newsCount FROM categories 
            LEFT JOIN newsCategories ON categories.ID = newsCategories.categoryId 
            LEFT JOIN news ON newsCategories.newsId = news.ID 
            GROUP BY categoryName ORDER BY categories.ID ASC)) AS T3 GROUP BY categoryName ORDER BY newsCount DESC"));
    }

    public static function getLatestNewsSideBar(){
        return json_encode(getData("SELECT ID,title,titleImage,body,DATE_FORMAT(dateAdded, '%d.%m.%Y') as dateAdded FROM news WHERE news.visible = 1 AND news.published = 1 ORDER BY ID DESC LIMIT 5"));
    }
    
    public static function getTwoLastNewsForIndexPage(){
        return json_encode(getData("SELECT news.ID,title,titleImage,SUBSTRING(body, 1, 300) as body, GROUP_CONCAT(categories.categoryName) as categories, DATE_FORMAT(dateAdded, '%d. %M %Y') as dateAdded FROM news 
        JOIN newsCategories ON news.ID = newsCategories.newsId 
        JOIN categories ON newsCategories.categoryId = categories.ID WHERE news.visible = 1 AND news.published = 1
        GROUP BY news.ID ORDER BY news.ID DESC LIMIT 2;"));
    }

    public static function getNewsArchiveList(){
        return json_encode(getData("SELECT DATE_FORMAT(dateAdded, '%M \'%Y') as monthYearAdded,COUNT(*) as newsNumber FROM news WHERE news.visible = 1 AND news.published = 1 GROUP BY DATE_FORMAT(dateAdded, '%Y-%m') ORDER BY dateAdded DESC"));
    }

    public static function getAllNewsList($user){
        $token = $user['token'];
        $userType = getData("SELECT userType FROM users WHERE token = :token",array('token'=>$token))[0]['userType'];
        if ($userType == 'superadmin'){
            $approveAndPublish = "CASE WHEN published = 1 THEN 'Publikované' ELSE 'Nepublikované' END AS published,
                                  CASE WHEN published = 1 THEN NULL ELSE 'Publikovať' END AS approve,";
        }else if ($userType == 'admin'){
            $approveAndPublish = "CASE WHEN published = 1 THEN 'Publikované' ELSE 'Nepublikované' END AS published,
                                  CASE WHEN published = 1 THEN NULL ELSE NULL END AS approve,";
        }
        
        return json_encode(getData("SELECT ".$approveAndPublish." news.ID,DATE_FORMAT(dateAdded, '%d.%m.%Y - %H:%i') as dateAdded,title, GROUP_CONCAT(DISTINCT(categories.categoryName)) as categories,writtenBy FROM news 
        LEFT JOIN newsCategories ON news.ID = newsCategories.newsId 
        LEFT JOIN categories ON newsCategories.categoryId = categories.ID WHERE news.visible = 1 GROUP BY news.ID ORDER BY dateAdded DESC"));
    }

    public static function getFiveNewsInNewsPage($inputParameters){
        if ($inputParameters['inputCategory'] == "0"){
            $inputParameters['inputCategory'] = "";
        }
        if ($inputParameters['search'] == "0"){
            $inputParameters['search'] = "";
        }else{
            $inputParameters['search'] = str_replace("+"," ",$inputParameters['search']);
        }

        $inputParameters['currentPage'] = filter_var($inputParameters['currentPage'], FILTER_SANITIZE_NUMBER_INT) * 5;

        $returnArray = array();
        $parameters = array('inputCategory'=>'%'.$inputParameters['inputCategory'].'%','search'=>'%'.$inputParameters['search'].'%');

        $returnArray['allNews'] = getData("SELECT COUNT(DISTINCT(news.ID)) as allNews FROM news
        JOIN newsCategories ON news.ID = newsCategories.newsId 
        JOIN categories ON newsCategories.categoryId = categories.ID WHERE categories.categoryName LIKE :inputCategory AND (news.title LIKE :search OR news.body LIKE :search) AND news.visible = 1 AND news.published = 1
        ORDER BY news.ID DESC",$parameters)[0]['allNews'];

        $returnArray['foundNews'] = getData("SELECT news.ID,title,titleImage, SUBSTRING(body, 1, 300) as body, GROUP_CONCAT(DISTINCT(categories.categoryName)) as categories, DATE_FORMAT(dateAdded, '%d. %M %Y') as dateAdded FROM news 
        JOIN newsCategories ON news.ID = newsCategories.newsId 
        JOIN categories ON newsCategories.categoryId = categories.ID WHERE categories.categoryName LIKE :inputCategory AND (news.title LIKE :search OR news.body LIKE :search) AND news.visible = 1 AND news.published = 1
        GROUP BY news.ID ORDER BY news.ID DESC LIMIT 5 OFFSET ".$inputParameters['currentPage']."",$parameters);

        return json_encode($returnArray);
    }

    public static function getSingleNewsArticle($articleID){
        $returnArticleDetails = array();
        $returnArticleDetails = getData("SELECT news.ID,news.title,news.titleImage,news.body,DATE_FORMAT(news.dateAdded, '%d. %M %Y') as dateAdded, GROUP_CONCAT(DISTINCT(categories.categoryName)) as categories FROM news 
        JOIN newsCategories ON news.ID = newsCategories.newsId 
        JOIN categories ON newsCategories.categoryId = categories.ID WHERE news.ID = :articleID AND news.visible = 1",array('articleID' => $articleID));
        array_push($returnArticleDetails,self::getNextAndPreviousArticles($articleID));
        array_push($returnArticleDetails,self::getCategories(false));
        return json_encode($returnArticleDetails);
    }

    public static function getNextAndPreviousArticles($articleID){
        $returnNextAndPreviousArticles = array();
        $returnNextAndPreviousArticles['nextArticle'] = getData("SELECT news.ID,news.title,news.titleImage,news.dateAdded FROM news WHERE ID = (SELECT min(ID) FROM news WHERE ID > :articleID AND news.visible = 1 AND news.published = 1)",array('articleID' => $articleID));
        $returnNextAndPreviousArticles['previousArticle'] = getData("SELECT news.ID,news.title,news.titleImage,news.dateAdded FROM news WHERE ID = (SELECT max(ID) FROM news WHERE ID < :articleID AND news.visible = 1 AND news.published = 1)",array('articleID' => $articleID));
        return $returnNextAndPreviousArticles;
    }

    public static function addNewArticle($newArticleDetails,$files){
        $imagePaths = fileManipulation::saveFiles($files['titleImage'], '/img/newsTitleImages/');
        $fullName = userManagement::getMyInfo($newArticleDetails['token'])['fullName'];
        $addedArticle = insertData("INSERT INTO news (title,titleImage,body,writtenBy) VALUES (:title,:titleImage,:body,:writtenBy)",array('title' => $newArticleDetails['title'],'titleImage' => $imagePaths[0],'body' => $newArticleDetails['body'],'writtenBy' => $fullName));

        //insert categories
        $categories = explode(',',$newArticleDetails['categories']);
        $x = 0;
        $categoryParameters = array();
        foreach ($categories as $singleCategory) {
            $categoryQuery .= ' categoryName = :categoryName'.$x . ' OR';
            $categoryParameters['categoryName'.$x] = $singleCategory;
            $x++;
        }
        $categoryQuery = rtrim($categoryQuery,"OR");
        $ID = getData("SELECT ID from news ORDER BY ID DESC LIMIT 1")[0]['ID'];
        insertData("INSERT IGNORE INTO newsCategories (newsId,categoryId) SELECT \"" . $ID . "\" as newsId,ID FROM categories WHERE " . $categoryQuery,$categoryParameters);
        sendEmail::informOwnerOfPortalAboutNewArticle();
        return $addedArticle;
    }

    public static function removeArticle($articleIdAndToken){
        $userType = getData("SELECT userType FROM users WHERE token = :token",array('token'=>$articleIdAndToken['token']))[0]['userType'];
        if ($userType == 'admin' || $userType == 'superadmin'){
            insertData("DELETE FROM newsCategories WHERE newsId = :articleId",array('articleId' => $articleIdAndToken['articleId']));
            return insertData("UPDATE news SET visible = 0 WHERE ID = :articleId",array('articleId' => $articleIdAndToken['articleId']));
        }else{
            return false;
        }
    }

    public static function getCategories($json = true){
        $categories = getData("SELECT categoryName FROM categories");
        if ($json){
            return json_encode($categories);
        }else{
            return $categories;
        }
    }

    public static function updateArticle($newArticleDetails,$files){
        if ($files['titleImage'] != ""){
            $imagePaths = fileManipulation::saveFiles($files['titleImage'], '/img/newsTitleImages/');
            $newImage = "titleImage = '".$imagePaths[0]."',";
        }
        insertData("UPDATE news SET title = :title, ".$newImage." body = :body WHERE ID = :ID",array('title' => $newArticleDetails['title'],'body' => $newArticleDetails['body'],'ID' => $newArticleDetails['newsID']));

        //insert categories
        $categories = explode(',',$newArticleDetails['categories']);
        $x = 0;
        $categoryParameters = array();
        foreach ($categories as $singleCategory) {
            $categoryQuery .= ' categoryName = :categoryName'.$x . ' OR';
            $categoryParameters['categoryName'.$x] = $singleCategory;
            $x++;
        }
        $categoryQuery = rtrim($categoryQuery,"OR");
        $ID = getData("SELECT ID from news WHERE ID = :ID",array('ID' => $newArticleDetails['newsID']))[0]['ID'];
        insertData("INSERT IGNORE INTO newsCategories (newsId,categoryId) SELECT \"" . $ID . "\" as newsId,ID FROM categories WHERE " . $categoryQuery,$categoryParameters);
        return 1;
    }

    public static function approveArticle($articleIdAndToken){
        $userType = getData("SELECT userType FROM users WHERE token = :token",array('token'=>$articleIdAndToken['token']))[0]['userType'];
        if ($userType == 'superadmin'){
            return insertData("UPDATE news SET published = 1 WHERE ID = :articleId",array('articleId' => $articleIdAndToken['articleId']));
        }else{
            return false;
        }
    }
    
}
?>