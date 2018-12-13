<?php
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
        return json_encode(getData("SELECT categoryName, COUNT(news.ID) as newsCount FROM categories 
        LEFT JOIN newsCategories ON categories.ID = newsCategories.categoryId 
        LEFT JOIN news ON newsCategories.newsId = news.ID 
        GROUP BY categoryName"));
    }

    public static function getLatestNews(){
        return json_encode(getData("SELECT * FROM news ORDER BY dateAdded DESC LIMIT 5"));
    }

    public static function getNewsArchiveList(){
        return json_encode(getData("SELECT DATE_FORMAT(dateAdded, '%M \'%Y') as monthYearAdded,COUNT(*) as newsNumber FROM news GROUP BY DATE_FORMAT(dateAdded, '%Y-%m') ORDER BY dateAdded"));
    }
}


?>