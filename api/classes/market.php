<?php
setlocale(LC_ALL, 'sk_SK');

class market{

    public function __construct() {
        // allocate your stuff
    }

    //
    //  METHODS
    //

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