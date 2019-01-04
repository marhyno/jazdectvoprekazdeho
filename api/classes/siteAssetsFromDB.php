<?php
setlocale(LC_TIME, 'sk_SK');

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

    public static function getNumberOfNewsByCategories(){
        return json_encode(getData("(SELECT '' as categoryName, COUNT(news.ID) as newsCount FROM news) UNION
                (SELECT categoryName, COUNT(news.ID) as newsCount FROM categories 
                        LEFT JOIN newsCategories ON categories.ID = newsCategories.categoryId 
                        LEFT JOIN news ON newsCategories.newsId = news.ID 
                        GROUP BY categoryName ORDER BY categories.ID ASC)"));
    }

    public static function getLatestNews(){
        return json_encode(getData("SELECT ID,title,titleImage,body,DATE_FORMAT(dateAdded, '%d.%m.%Y - %H:%i') as dateAdded FROM news ORDER BY dateAdded DESC LIMIT 5"));
    }
    
    public static function getTwoLastNewsForIndexPage(){
        return json_encode(getData("SELECT news.ID,title,titleImage,body, GROUP_CONCAT(categories.categoryName) as categories, DATE_FORMAT(dateAdded, '%d. %M %Y') as dateAdded FROM news 
        JOIN newsCategories ON news.ID = newsCategories.newsId 
        JOIN categories ON newsCategories.categoryId = categories.ID 
        GROUP BY news.ID ORDER BY news.ID DESC LIMIT 2;"));
    }

    public static function getNewsArchiveList(){
        return json_encode(getData("SELECT DATE_FORMAT(dateAdded, '%M \'%Y') as monthYearAdded,COUNT(*) as newsNumber FROM news GROUP BY DATE_FORMAT(dateAdded, '%Y-%m') ORDER BY dateAdded DESC"));
    }

    public static function getAllNews(){
        return json_encode(getData("SELECT * FROM news ORDER BY dateAdded DESC"));
    }

    public static function getFiveNewsInNewsPage($inputParameters){
        if ($inputParameters['inputCategory'] == "0"){
            $inputParameters['inputCategory'] = "";
        }
        $inputParameters['currentPage'] = filter_var($inputParameters['currentPage'], FILTER_SANITIZE_NUMBER_INT) * 5;
        return json_encode(getData("SELECT news.ID,title,titleImage,body, GROUP_CONCAT(DISTINCT(categories.categoryName)) as categories, DATE_FORMAT(dateAdded, '%d. %M %Y') as dateAdded FROM news 
        JOIN newsCategories ON news.ID = newsCategories.newsId 
        JOIN categories ON newsCategories.categoryId = categories.ID WHERE categories.categoryName LIKE :inputCategory
        GROUP BY news.ID ORDER BY news.ID DESC LIMIT 5 OFFSET ".$inputParameters['currentPage']."",array('inputCategory'=>'%'.$inputParameters['inputCategory'].'%')));
    }

    public static function getSingleNewsArticle($articleID){
        $returnArticleDetails = array();
        $returnArticleDetails = getData("SELECT news.ID,news.title,news.titleImage,news.body,DATE_FORMAT(news.dateAdded, '%d. %M %Y') as dateAdded, GROUP_CONCAT(DISTINCT(categories.categoryName)) as categories FROM news 
        JOIN newsCategories ON news.ID = newsCategories.newsId 
        JOIN categories ON newsCategories.categoryId = categories.ID WHERE news.ID = :articleID",array('articleID' => $articleID));
        array_push($returnArticleDetails,self::getNextAndPreviousArticles($articleID));
        return json_encode($returnArticleDetails);
    }

    public static function getNextAndPreviousArticles($articleID){
        $returnNextAndPreviousArticles = array();
        $returnNextAndPreviousArticles['nextArticle'] = getData("SELECT news.ID,news.title,news.titleImage,news.dateAdded FROM news WHERE ID = (SELECT min(ID) FROM news WHERE ID > :articleID)",array('articleID' => $articleID));
        $returnNextAndPreviousArticles['previousArticle'] = getData("SELECT news.ID,news.title,news.titleImage,news.dateAdded FROM news WHERE ID = (SELECT max(ID) FROM news WHERE ID < :articleID)",array('articleID' => $articleID));
        return $returnNextAndPreviousArticles;
    }
}


?>