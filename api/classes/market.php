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
                specificCriteria,
                mainCategory,
                subCategory,
                market.phone,
                market.fullName,
                market.email,
                price,
                details,
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
                specificCriteria,
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
                specificCriteria,
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
        $password = password_hash($newItemDetails['advertPassword'],PASSWORD_DEFAULT);

        insertData("INSERT INTO market 
        (
	        userId,
	        title,
            offerOrSearch,
            specificCriteria,
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
            :specificCriteria,
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
        'specificCriteria' => $newItemDetails['specialAdvertCriteria'],
        'mainCategory' => $newItemDetails['mainCategory'],
        'subCategory' => $newItemDetails['subCategory'],
        'locationId' => $locationId,
        'phone' => $newItemDetails['marketPhone'],
        'fullName' => $newItemDetails['marketContactPerson'],
        'email' => $newItemDetails['marketEmail'],
        'price' => $newItemDetails['priceMarket'],
        'details' => $newItemDetails['marketDescription'],
        'advertPassword' => $password
        ));

        $ID = getData("SELECT ID from market ORDER BY ID DESC LIMIT 1")[0]['ID'];
        $marketItemImages = "";
        foreach ($galleryImages as $singleImage) {
            $marketItemImages .= "(".$ID.",'".$singleImage."'),";
        }
        insertData("INSERT INTO marketGalleries (itemId, imageLink) VALUES " . rtrim($marketItemImages,','));
        return $ID;
    }

    public static function saveEditItemInMarket($editItemDetails, $files){
        $details = array();
        $details['advertPassword'] = $editItemDetails['advertPassword'];
        $details['ID'] = $editItemDetails['ID'];
        $isAllowedToEdit = market::checkEditAdvertPassword($details);
        if ($isAllowedToEdit != 1){
            return $isAllowedToEdit;
        }

        $locationId = siteAssetsFromDB::getLocationId($editItemDetails['locationProvince'], $editItemDetails['locationRegion'], $editItemDetails['locationLocalCity']);
        if (count($files['marketGalleries']) > 0){
            $galleryImages = fileManipulation::saveFiles($files['marketGalleries'], '/img/marketImages/');
        }

        insertData("UPDATE market SET
        userId = :userId,
        title = :title,
        offerOrSearch = :offerOrSearch,
        specificCriteria = :specificCriteria,
        mainCategory = :mainCategory,
        subCategory = :subCategory,
        locationId = :locationId,
        phone = :phone,
        fullName = :fullName,
        email = :email,
        price = :price,
        details = :details WHERE ID = :ID"
        ,array(
        'userId' => $userId,
        'title' => $editItemDetails['marketTitle'],
        'offerOrSearch' => $editItemDetails['offerOrSearch'],
        'specificCriteria' => $editItemDetails['specialAdvertCriteria'],
        'mainCategory' => $editItemDetails['mainCategory'],
        'subCategory' => $editItemDetails['subCategory'],
        'locationId' => $locationId,
        'phone' => $editItemDetails['marketPhone'],
        'fullName' => $editItemDetails['marketContactPerson'],
        'email' => $editItemDetails['marketEmail'],
        'price' => $editItemDetails['priceMarket'],
        'details' => $editItemDetails['marketDescription'],
        'ID' => $editItemDetails['ID']
        ));

        if ($galleryImages != NULL){
            $ID = $editItemDetails['ID'];
            $marketItemImages = "";
            foreach ($galleryImages as $singleImage) {
                $marketItemImages .= "(".$ID.",'".$singleImage."'),";
            }
            insertData("INSERT INTO marketGalleries (itemId, imageLink) VALUES " . rtrim($marketItemImages,','));
        }

        return 'Inzerát bol aktualizovaný.';
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
                   if ($subCategories != 'Všetko'){
                    $returnOptions .='<option value="' . $subCategories . '">' . $subCategories . '</option>';
                   }
               }
            }
        }

        return $returnOptions;
    }

    public static function searchMarket($searchCriteria){
        $subCategory = $searchCriteria['subCategory'];
        $mainCategory = $searchCriteria['mainCategory'];
        $page = $searchCriteria['page'];
        $specificCriteriaValues = $searchCriteria['specificCriteria'];
        $distanceRange = $searchCriteria['distanceRange'];
        $marketOfferOrSearch = $searchCriteria['marketOfferOrSearch'];
        $advertTitle = $searchCriteria['advertTitle'];
        $orderBy = $searchCriteria['orderBy'];
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

        if ($specificCriteriaValues != "" && $specificCriteriaValues != 'null'){
            $specificCriteriaSQLString = "";
            $specificCriteriaValues = explode(',',$specificCriteriaValues);
            for ($i=0; $i < count($specificCriteriaValues); $i++) { 
                $specificCriteriaSQLString .= ' (specificCriteria LIKE :specificValue'. $i . ') AND';
                $searchCriteriaArray['specificValue'.$i] = '%'.$specificCriteriaValues[$i] .'%';
            }
            $specificCriteriaSQLString = rtrim($specificCriteriaSQLString,"AND");
            $specificCriteriaSQLString = ' AND ('.$specificCriteriaSQLString.') ';
        }
        if ($mainCategory != ""){
            $categories = " AND mainCategory = :mainCategory AND subCategory LIKE :subCategory ";
            $searchCriteriaArray['mainCategory'] = $mainCategory;
            $searchCriteriaArray['subCategory'] = $subCategory == "Všetko" ? "%%" : $subCategory . '%';
        }

        if ($marketOfferOrSearch != "undefined"){
            $offerOrSearch = " AND offerOrSearch = :marketOfferOrSearch";
            $searchCriteriaArray['marketOfferOrSearch'] = $marketOfferOrSearch;
        }

        if ($advertTitle != ""){
            $advertTitleFilter = " AND title LIKE :title";
            $searchCriteriaArray['title'] = '%' . $advertTitle  . '%';
        }

        $page = filter_var($page, FILTER_SANITIZE_NUMBER_INT) * 10;
        $pagination = "LIMIT 10 OFFSET " . $page;

        if ($orderBy == "undefined" || $orderBy == ""){
            $orderBy = " ORDER BY dateAdded DESC";
        }else{
            switch ($orderBy) {
                case 'Najlacnejšie':
                    $orderBy = " ORDER BY CAST(price as unsigned) ASC";
                    break;
                case 'Najdrahšie':
                    $orderBy = " ORDER BY CAST(price as unsigned) DESC";
                    break;
                case 'Najnovšie':
                    $orderBy = " ORDER BY dateAdded DESC";
                    break;
                case 'Najstaršie':
                    $orderBy = " ORDER BY dateAdded ASC";
                    break;
                default:
                    break;
            }
        }

        $selectedColumns = "market.ID,
                userId,
                title,
                offerOrSearch,
                mainCategory,
                subCategory,
                market.phone,
                market.fullName,
                market.email,
                price,
                (SELECT imageLink FROM marketGalleries WHERE itemId = market.ID LIMIT 1) AS advertImage,
                SUBSTRING(details, 1, 150) as details,
                market.advertPassword,
                CONCAT(`province`, ' - ', `region`,' - ',`localCity`) as location";
        $searchSQLClause = "SELECT {{columns}} FROM market LEFT JOIN slovakPlaces ON market.locationId = slovakPlaces.ID WHERE market.locationId IN (SELECT id FROM slovakPlaces ".$locations.") " . $rangeSQLClause . "  " . $specificCriteriaSQLString . " ".$categories . " ".$advertTitleFilter . " ".$offerOrSearch . " " . $orderBy;
        $returnArray = array();
        //with limit $limitForPagination
        $fullSearch = str_replace("{{columns}}",$selectedColumns,$searchSQLClause ." " . $pagination);
        $returnArray['results'] = getData($fullSearch,$searchCriteriaArray);
        //without limit
        $countSearch = str_replace("{{columns}}","COUNT(market.ID) AS allResults",$searchSQLClause);
        $returnArray['completeNumber'] = getData($countSearch,$searchCriteriaArray)[0]['allResults'];
        return json_encode($returnArray);
    }

    public static function checkEditAdvertPassword($details)
    {
        $inputAdvertPassword = $details['advertPassword'];
        $advertId = $details['ID'];
        $fetchAdvert = getData("SELECT advertPassword FROM market WHERE ID=:ID",array('ID'=>$advertId));
        if (count($fetchAdvert) == 0){
            return 'Inzerát neexistuje.';
        }else{
            $savedPassword = $fetchAdvert[0]['advertPassword'];
            if (password_verify($inputAdvertPassword, $savedPassword)) {
                return true;
            }else {
                return 'Nesprávne heslo inzerátu.';
            }
        }
    }

    public static function informOwnerAboutExpiringAdverts(){
        $expiringAdverts = getData("SELECT email, GROUP_CONCAT(title) AS titles, GROUP_CONCAT(ID) AS itemIds FROM market WHERE dateAdded < '".date('Y-m-d', strtotime('-58 day'))."' GROUP BY email",null); 
        if (count($expiringAdverts) == 0){
            return;
        }
        foreach ($expiringAdverts as $singleExpiringAdvert) {
            sendEmail::informOwnerAboutExpiringAdverts($singleExpiringAdvert);
        }
    }

    public static function removeOldAdverts(){
        $expiringAdverts = getData("SELECT email, GROUP_CONCAT(title) AS titles, GROUP_CONCAT(ID) AS itemIds FROM market WHERE dateAdded < '".date('Y-m-d', strtotime('-60 day'))."' GROUP BY email",null); 
        if (count($expiringAdverts) == 0){
            return;
        }
        foreach ($expiringAdverts as $singleExpiringAdvert) {
            sendEmail::informOwnerAboutDeletionOfAdverts($singleExpiringAdvert);
            $itemIds = explode(',',$singleExpiringAdvert['itemIds']);
            foreach ($itemIds as $singleId) {
                fileManipulation::removeGallery('advert', $singleId);
                insertData("DELETE FROM marketGalleries WHERE itemId = :ID",array('ID'=>$singleId));
                insertData("DELETE FROM market WHERE ID = :ID",array('ID'=>$singleId));
            }
        }
    }
}


?>