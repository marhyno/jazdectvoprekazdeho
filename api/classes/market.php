<?php
class market{

    public function __construct() {
        // allocate your stuff
    }

    //
    //  METHODS
    //

    public static function getAdvertInfo($itemId){
        $advertInfo = array();
        $advertInfo['generalDetails'] = getData("SELECT
                market.ID,
                userId,
                title,
                offerOrSearch,
                mainCategory,
                subCategory,
                market.phone,
                market.fullName,
                market.email,
                price,
                details,
                market.advertPassword,
                CONCAT(`province`, ' - ', `region`,' - ',`localCity`) as location
                FROM market 
                LEFT JOIN users ON market.userId = users.ID 
                LEFT JOIN slovakPlaces ON slovakPlaces.ID = market.locationId
                WHERE market.ID = :ID", array('ID' => $itemId));
        $advertInfo['gallery'] = getData("SELECT * FROM marketGalleries WHERE itemId = :ID", array('ID' => $itemId));
        return json_encode($advertInfo);
    }

    public static function getMyMarketItems($token){
        return json_encode(getData("SELECT
                market.ID,
                userId,
                title,
                offerOrSearch,
                mainCategory,
                subCategory,
                market.phone,
                market.fullName,
                market.email,
                price,
                details,
                market.advertPassword,
                CONCAT(`province`, ' - ', `region`,' - ',`localCity`) as location
                FROM market 
                LEFT JOIN users ON market.userId = users.ID 
                LEFT JOIN slovakPlaces ON slovakPlaces.ID = market.locationId
                WHERE token = :token", array('token' => $token)));
    }

    public static function getUserMarketItems($ID){
        return getData("SELECT
                market.ID,
                userId,
                title,
                offerOrSearch,
                mainCategory,
                subCategory,
                market.phone,
                market.fullName,
                market.email,
                price,
                details,
                market.advertPassword,
                CONCAT(`province`, ' - ', `region`,' - ',`localCity`) as location
                FROM market 
                LEFT JOIN users ON market.userId = users.ID 
                LEFT JOIN slovakPlaces ON slovakPlaces.ID = market.locationId
                WHERE market.userId = :userId", array('ID' => $ID));
    }


    public static function addNewItemToMarket($newItemDetails, $files){
        //user can but doesnt have to logged in
        if ($newItemDetails['token'] != null && userManagement::isUserLoggedIn($newItemDetails['token'])){
                $userId = userManagement::getMyInfo($newItemDetails['token'])['ID'];
        }else{
            $userId = NULL;
        }

        $locationId = siteAssetsFromDB::getLocationId($newItemDetails['locationProvince'], $newItemDetails['locationRegion'], $newItemDetails['locationLocalCity']);
        if (count($files['marketGalleries']) > 0){
            $galleryImages = fileManipulation::saveFiles($files['marketGalleries'], '/img/marketImages/');
        }

        insertData("INSERT INTO market 
        (
	        userId,
	        title,
            offerOrSearch,
	        mainCategory,
	        subCategory,
	        locationId,
	        phone,
	        fullName,
	        email,
	        price,
	        details,
            advertPassword
        )
        VALUES 
        (
	        :userId,
	        :title,
            :offerOrSearch,
	        :mainCategory,
	        :subCategory,
	        :locationId,
	        :phone,
	        :fullName,
	        :email,
	        :price,
	        :details,
            :advertPassword
        )"
        ,array(
        'userId' => $userId,
        'title' => $newItemDetails['marketTitle'],
        'offerOrSearch' => $newItemDetails['offerOrSearch'],
        'mainCategory' => $newItemDetails['mainCategory'],
        'subCategory' => $newItemDetails['subCategory'],
        'locationId' => $locationId,
        'phone' => $newItemDetails['marketPhone'],
        'fullName' => $newItemDetails['marketContactPerson'],
        'email' => $newItemDetails['marketEmail'],
        'price' => $newItemDetails['priceMarket'],
        'details' => $newItemDetails['marketDescription'],
        'advertPassword' => $newItemDetails['advertPassword']
        ));

        $ID = getData("SELECT ID from market ORDER BY ID DESC LIMIT 1")[0]['ID'];
        $marketItemImages = "";
        foreach ($galleryImages as $singleImage) {
            $marketItemImages .= "(".$ID.",'".$singleImage."'),";
        }
        insertData("INSERT INTO marketGalleries (itemId, imageLink) VALUES " . rtrim($marketItemImages,','));
    }

    public static function saveEditItemInMarket($editItemDetails, $files){
        //user can but doesnt have to logged in
        if ($editItemDetails['token'] != null && userManagement::isUserLoggedIn($editItemDetails['token'])){
                $userId = userManagement::getMyInfo($editItemDetails['token'])['ID'];
        }else{
            $userId = NULL;
        }

        $locationId = siteAssetsFromDB::getLocationId($editItemDetails['locationProvince'], $editItemDetails['locationRegion'], $editItemDetails['locationLocalCity']);
        if (count($files['marketGalleries']) > 0){
            $galleryImages = fileManipulation::saveFiles($files['marketGalleries'], '/img/marketImages/');
        }

        insertData("INSERT INTO market 
        (
            userId,
            title,
            mainCategory,
            subCategory,
            locationId,
            phone,
            fullName,
            email,
            price,
            details
        )
        VALUES 
        (
            :userId,
            :title,
            :mainCategory,
            :subCategory,
            :locationId,
            :phone,
            :fullName,
            :email,
            :price,
            :details
        )"
        ,array(
        'userId' => $userId,
        'title' => $editItemDetails['marketTitle'],
        'mainCategory' => $editItemDetails['mainCategory'],
        'subCategory' => $editItemDetails['subCategory'],
        'locationId' => $locationId,
        'phone' => $editItemDetails['marketPhone'],
        'fullName' => $editItemDetails['marketContactPerson'],
        'email' => $editItemDetails['marketEmail'],
        'price' => $editItemDetails['priceMarket'],
        'details' => $editItemDetails['marketDescription']
        ));

        $ID = getData("SELECT ID from market ORDER BY ID DESC LIMIT 1")[0]['ID'];
        $marketItemImages = "";
        foreach ($galleryImages as $singleImage) {
            $marketItemImages .= "(".$ID.",'".$singleImage."'),";
        }
        insertData("INSERT INTO marketGalleries (itemId, imageLink) VALUES " . rtrim($marketItemImages,','));
    }

    public static function getSubcategoriesFromMain($mainCategory)
    {
        $xml=simplexml_load_file($_SERVER["DOCUMENT_ROOT"].'/assets/marketSearchFilter.xml');
        $returnOptions = "";
        foreach($xml->children() as $child)
        {
            if ($child->attributes()['name'] == $mainCategory){
               foreach($child->children() as $subCategories)
               {
                   $returnOptions .='<option value="' . $subCategories . '">' . $subCategories . '</option>';
               }
            }
        }

        return $returnOptions;
    }

    public static function searchMarket($searchCriteria){
    // TO DO 
    // TO DO 
    // TO DO 
        $category = $searchCriteria['category']; //array
        $distanceRange = $searchCriteria['distanceRange'];
        $rangeSQLClause = "";
        $locationStringAndValues = servicesBarnsEvents::buildLocationsSQLStringAndEscapedValues();
        $locations = $locationStringAndValues['locations'];
        $searchCriteriaArray = $locationStringAndValues['values'];

        if ($distanceRange != "" && $searchCriteriaArray['localCity'] != ""){
            $getLocalCityGPSCoordinates = getData("SELECT latitude, longitude FROM slovakPlaces " . $locations, $searchCriteriaArray)[0];
            $rangeSQLClause = " OR market.locationId IN (SELECT
                                id FROM (
                                    SELECT id,(
                                        6378 * acos (
                                        cos ( radians( :latitude ) )
                                        * cos( radians( latitude ) )
                                        * cos( radians( longitude ) - radians( :longitude ) )
                                        + sin ( radians( :latitude ) )
                                        * sin( radians( latitude ) )
                                        )
                                    ) AS distance
                                    FROM slovakPlaces
                                    HAVING distance < :distanceRange
                                    ORDER BY distance
                                ) as locationId))";

            $searchCriteriaArray['latitude'] = $getLocalCityGPSCoordinates['latitude'];
            $searchCriteriaArray['longitude'] = $getLocalCityGPSCoordinates['longitude'];
            $searchCriteriaArray['distanceRange'] = $distanceRange;
        }

        $searchSQLClause = "SELECT * FROM market LEFT JOIN slovakPlaces ON market.locationId = slovakPlaces.ID WHERE market.locationId IN (SELECT id FROM slovakPlaces ".$locations.")" . $rangeSQLClause;
        return json_encode(getData($searchSQLClause,$searchCriteriaArray));
    }
}


?>