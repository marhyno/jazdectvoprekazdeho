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
        return json_encode(getData("SELECT ID,slug,CONCAT(SUBSTRING(title, 1, 80),'...') as title,titleImage,body,DATE_FORMAT(dateAdded, '%d.%m.%Y') as dateAdded FROM news WHERE news.visible = 1 AND news.published = 1 ORDER BY ID DESC LIMIT 5"));
    }
    
    public static function getTwoLastNewsForIndexPage(){
        return json_encode(getData("SELECT news.ID,title,slug,titleImage,SUBSTRING(body, 1, 300) as body, GROUP_CONCAT(categories.categoryName) as categories, DATE_FORMAT(dateAdded, '%d. %M %Y') as dateAdded FROM news 
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
        
        return json_encode(getData("SELECT ".$approveAndPublish." news.ID,slug,DATE_FORMAT(dateAdded, '%d.%m.%Y - %H:%i') as dateAdded,title, GROUP_CONCAT(DISTINCT(categories.categoryName)) as categories,users.fullName as writtenBy, users.ID as userId FROM news 
        LEFT JOIN newsCategories ON news.ID = newsCategories.newsId 
        JOIN users ON news.writtenBy = users.ID
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

        $returnArray['foundNews'] = getData("SELECT news.ID,slug,title,titleImage, SUBSTRING(body, 1, 300) as body, GROUP_CONCAT(DISTINCT(categories.categoryName)) as categories, DATE_FORMAT(dateAdded, '%d. %M %Y') as dateAdded FROM news 
        JOIN newsCategories ON news.ID = newsCategories.newsId 
        JOIN categories ON newsCategories.categoryId = categories.ID WHERE categories.categoryName LIKE :inputCategory AND (news.title LIKE :search OR news.body LIKE :search) AND news.visible = 1 AND news.published = 1
        GROUP BY news.ID ORDER BY news.ID DESC LIMIT 5 OFFSET ".$inputParameters['currentPage']."",$parameters);

        return json_encode($returnArray);
    }

    public static function getSingleNewsArticle($articleID){
        $returnArticleDetails = array();
        $returnArticleDetails = getData("SELECT news.ID,slug,news.title,news.titleImage,news.body,DATE_FORMAT(news.dateAdded, '%d. %M %Y') as dateAdded, GROUP_CONCAT(DISTINCT(categories.categoryName)) as categories, users.fullName as writtenBy, users.ID as userId FROM news 
        JOIN newsCategories ON news.ID = newsCategories.newsId 
        JOIN users ON news.writtenBy = users.ID
        JOIN categories ON newsCategories.categoryId = categories.ID WHERE news.slug = :articleID AND news.visible = 1",array('articleID' => $articleID));
        array_push($returnArticleDetails,self::getNextAndPreviousArticles($articleID));
        array_push($returnArticleDetails,self::getCategories(false));
        array_push($returnArticleDetails,self::getArticleShareCount($articleID));
        return json_encode($returnArticleDetails);
    }

    public static function getArticleById($articleID){
        return getData("SELECT slug FROM news WHERE ID = :articleID AND news.visible = 1",array('articleID' => $articleID))[0]['slug'];
    }

    public static function getNextAndPreviousArticles($articleID){
        $returnNextAndPreviousArticles = array();
        $returnNextAndPreviousArticles['nextArticle'] = getData("SELECT news.ID,slug,news.title,news.titleImage,news.dateAdded FROM news WHERE ID = (SELECT min(ID) FROM news WHERE ID > (SELECT ID FROM news WHERE slug = :articleID) AND news.visible = 1 AND news.published = 1)",array('articleID' => $articleID));
        $returnNextAndPreviousArticles['previousArticle'] = getData("SELECT news.ID,slug,news.title,news.titleImage,news.dateAdded FROM news WHERE ID = (SELECT max(ID) FROM news WHERE ID < (SELECT ID FROM news WHERE slug = :articleID) AND news.visible = 1 AND news.published = 1)",array('articleID' => $articleID));
        return $returnNextAndPreviousArticles;
    }

    public static function addNewArticle($newArticleDetails,$files){
        $imagePaths = fileManipulation::saveFiles($files['titleImage'], '/img/newsTitleImages/');
        $userId = userManagement::getMyInfo($newArticleDetails['token'])['ID'];
        $slug = siteAssetsFromDB::slugify($newArticleDetails['title']);
        $ifSlugExists = getData("SELECT ID FROM news WHERE slug = :slug",array('slug' => $slug))[0]['ID'];
        $slug = $ifSlugExists > 0 ? $slug . '-' . ($ifSlugExists + 1) : $slug;
        $addedArticle = insertData("INSERT INTO news (title,titleImage,body,slug,writtenBy) VALUES (:title,:titleImage,:body,:slug,:writtenBy)",array('title' => $newArticleDetails['title'],'titleImage' => $imagePaths[0],'body' => $newArticleDetails['body'],'slug'=>$slug,'writtenBy' => $userId));

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
            //insertData("DELETE FROM newsCategories WHERE newsId = :articleId",array('articleId' => $articleIdAndToken['articleId']));
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
        insertData("UPDATE news SET title = :title, ".$newImage." body = :body WHERE slug = :slug",array('title' => $newArticleDetails['title'],'body' => $newArticleDetails['body'],'slug' => $newArticleDetails['newsID']));

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
        $ID = $newArticleDetails['newsID'];
        insertData("DELETE FROM newsCategories WHERE newsId = :ID",array('ID' => $newArticleDetails['newsID']));
        insertData("INSERT IGNORE INTO newsCategories (newsId,categoryId) SELECT \"" . $ID . "\" as newsId,ID FROM categories WHERE " . $categoryQuery,$categoryParameters);
        return true;
    }

    public static function approveArticle($articleIdAndToken){
        $userType = getData("SELECT userType FROM users WHERE token = :token",array('token'=>$articleIdAndToken['token']))[0]['userType'];
        if ($userType == 'superadmin'){
            return insertData("UPDATE news SET published = 1 WHERE ID = :articleId",array('articleId' => $articleIdAndToken['articleId']));
        }else{
            return false;
        }
    }

    public static function fillTutorialsMenu(){
        return json_encode(getData("SELECT ID,title FROM tutorials ORDER BY ID DESC"));
    }

    public static function getSingleTutorial($singleTutorialId){
        return json_encode(getData("SELECT ID,title,content FROM tutorials WHERE ID = :ID",array('ID'=>$singleTutorialId)));
    }

    public static function addNewTutorial($data){
        if (!userManagement::isUserAdmin($data['token'])){
                return false;
        }
        $lastTutorialId = insertData("INSERT IGNORE INTO tutorials (title,content) VALUES (:title,:body)",array('title'=>$data['title'],'body'=>$data['body']));
        return $lastTutorialId;
    }

    public static function removeTutorial($data){
        if (!userManagement::isUserAdmin($data['token'])){
                return false;
        }
        insertData("DELETE FROM tutorials WHERE ID = :ID",array('ID'=>$data['ID']));
        return true;
    }

    public static function updateTutorial($data){
        if (!userManagement::isUserAdmin($data['token'])){
            return false;
        }
        insertData("UPDATE tutorials SET title = :title, content = :body WHERE ID = :ID",array('title'=>$data['title'],'body'=>$data['body'],'ID'=>$data['tutorialId']));
        return true;
    }

    public static function addNewCommentToArticle($data){
        if (!userManagement::isUserLoggedIn($data['token'])){
            return 'Užívaťeľ nie je prihlásený';
        }else{
            if ($data['comment'] != ""){
                $newsId = getData("SELECT ID FROM news WHERE slug = :slug",array("slug"=>$data['newsId']))[0]['ID'];
                $commentId = insertData("INSERT INTO comments (newsId,userId,comment) VALUES (:newsId,(SELECT ID FROM users WHERE token = :token),:comment)",array('newsId'=>$newsId,'token'=>$data['token'],'comment'=>$data['comment']));
                echo $commentId;
            } else{
                return "Komentár nesmie byť prázdny";
            }
        }
    }

    public static function loadCommentsFromDb($data){
        if ($data['token'] == "" || $data['token'] == "null"){
            $userId = "0";
        }
        else{
            $userId = userManagement::getMyInfo($data['token'])['ID'];
        }
        return json_encode(getData("SELECT comments.ID, IF (users.ID = ".$userId.", 'editable','') AS editable, comment, users.userPhoto, users.ID as userId, DATE_FORMAT(dateAdded,'%d.%m.%Y %H:%i') AS dateAdded, users.fullName FROM comments JOIN users ON users.ID = comments.userId WHERE newsId = :newsId ORDER BY comments.ID DESC",array('newsId'=>$data['newsId'])));
    }

    public static function updateComment($data){
        if (!userManagement::isUserLoggedIn($data['token'])){
            return 'Užívaťeľ nie je prihlásený';
        }else{
            if ($data['comment'] != ""){
                $hasBeenUpdated = insertData("UPDATE comments SET comment = :comment WHERE newsId = :newsId AND userId = (SELECT ID FROM users WHERE token = :token) AND ID = :commentId",array('newsId'=>$data['newsId'],'token'=>$data['token'],'commentId'=>$data['commentId'],'comment'=>$data['comment']));
                echo $hasBeenUpdated;
            } else{
                return "Komentár nesmie byť prázdny";
            }
        }
    }

    public static function removeComment($data){
        if (!userManagement::isUserLoggedIn($data['token'])){
            return 'Užívaťeľ nie je prihlásený';
        }else{
            $hasBeenUpdated = insertData("DELETE FROM comments WHERE ID = :commentId AND userId = (SELECT ID FROM users WHERE token = :token) AND newsId = :newsId",array('newsId'=>$data['newsId'],'token'=>$data['token'],'commentId'=>$data['commentId']));
            echo $hasBeenUpdated;
        }
    }

    public static function createSlugForArticles(){
         $articles = getData("SELECT ID,title FROM news");
         foreach ($articles as $article) {
            $slug = siteAssetsFromDB::slugify($article['title']);
            insertData("UPDATE news SET slug = :slug WHERE ID = :ID",array('slug'=>$slug,'ID'=>$article['ID']));
         }
    }

    private static function getArticleShareCount($slug){
        $url = 'https://' . $_SERVER['HTTP_HOST'] . '/clanok.php?nazov=' . $slug;
        $access_token = '425429784657516|72a16509811a18471c4b630b683c14d7';
        $api_url = 'https://graph.facebook.com/v3.0/?id=' .  str_replace("?","%3F",$url) . '&fields=engagement&access_token=' . $access_token;
        $fb_connect = curl_init(); // initializing
        curl_setopt( $fb_connect, CURLOPT_URL, $api_url );
        curl_setopt( $fb_connect, CURLOPT_RETURNTRANSFER, 1 ); // return the result, do not print
        curl_setopt( $fb_connect, CURLOPT_TIMEOUT, 20 );
        $json_return = curl_exec( $fb_connect ); // connect and get json data
        curl_close( $fb_connect ); // close connection
        $body = json_decode( $json_return );
        return array('shareCount'=> intval( $body->engagement->share_count ));
    }

    private static function slugify($text)
    {
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }
    return substr($text,0,98);
    }
    
}
?>