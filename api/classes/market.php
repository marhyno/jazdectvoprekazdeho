<?php
setlocale(LC_ALL, 'sk_SK');

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
                mainCategory,
                subCategory,
                market.phone,
                market.fullName,
                market.email,
                price,
                details,
                market.password,
                CONCAT(`province`, ' - ', `region`,' - ',`localCity`) as location
                FROM market 
                LEFT JOIN users ON market.userId = users.ID 
                LEFT JOIN slovakPlaces ON slovakPlaces.ID = market.locationId
                WHERE market.ID = :ID", array('ID' => $itemId));
        $advertInfo['gallery'] = getData("SELECT * FROM marketGallery WHERE itemId = :ID", array('ID' => $itemId));
        return json_encode($advertInfo);
    }

    public static function getUserMarketItems($token){
        return json_encode(getData("SELECT
                market.ID,
                userId,
                title,
                mainCategory,
                subCategory,
                market.phone,
                market.fullName,
                market.email,
                price,
                details,
                market.password,
                CONCAT(`province`, ' - ', `region`,' - ',`localCity`) as location
                FROM market 
                LEFT JOIN users ON market.userId = users.ID 
                LEFT JOIN slovakPlaces ON slovakPlaces.ID = market.locationId
                WHERE token = :token", array('token' => $token)));
    }


    public static function addNewItemToMarket($newItemDetails, $files){
        //user can but doesnt have to logged in
        if ($newItemDetails['token'] != null && userManagement::isUserLoggedIn($newItemDetails['token'])){
                $userId = userManagement::getUserInfo($newItemDetails['token'])['ID'];
        }else{
            $userId = NULL;
        }

        $locationId = siteAssetsFromDB::getLocationId($newItemDetails['locationProvince'], $newItemDetails['locationRegion'], $newItemDetails['locationLocalCity']);
        if (count($files['marketGallery']) > 0){
            $galleryImages = saveFiles::saveFiles($files['marketGallery'], '/img/marketImages/');
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
        'title' => $newItemDetails['marketTitle'],
        'mainCategory' => $newItemDetails['mainCategory'],
        'subCategory' => $newItemDetails['subCategory'],
        'locationId' => $locationId,
        'phone' => $newItemDetails['marketPhone'],
        'fullName' => $newItemDetails['marketContactPerson'],
        'email' => $newItemDetails['marketEmail'],
        'price' => $newItemDetails['priceMarket'],
        'details' => $newItemDetails['marketDescription']
        ));

        $ID = getData("SELECT ID from market ORDER BY ID DESC LIMIT 1")[0]['ID'];
        $marketItemImages = "";
        foreach ($galleryImages as $singleImage) {
            $marketItemImages .= "(".$ID.",'".$singleImage."'),";
        }
        insertData("INSERT INTO marketGallery (itemId, imageLink) VALUES " . rtrim($marketItemImages,','));
    }

    public static function saveEditItemInMarket($editItemDetails, $files){
        //user can but doesnt have to logged in
        if ($editItemDetails['token'] != null && userManagement::isUserLoggedIn($editItemDetails['token'])){
                $userId = userManagement::getUserInfo($editItemDetails['token'])['ID'];
        }else{
            $userId = NULL;
        }

        $locationId = siteAssetsFromDB::getLocationId($editItemDetails['locationProvince'], $editItemDetails['locationRegion'], $editItemDetails['locationLocalCity']);
        if (count($files['marketGallery']) > 0){
            $galleryImages = saveFiles::saveFiles($files['marketGallery'], '/img/marketImages/');
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
        insertData("INSERT INTO marketGallery (itemId, imageLink) VALUES " . rtrim($marketItemImages,','));
    }

    public function getSubcategoriesFromMain($mainCategory)
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
}


?>