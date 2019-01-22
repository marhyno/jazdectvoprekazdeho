<?php
setlocale(LC_ALL, 'sk_SK');

class servicesBarnsEvents{

    public function __construct() {
        // allocate your stuff
    }

    //
    //  METHODS
    //

    public static function getUserBarns($token) {
        return json_encode(getData("SELECT barns.ID,
                barns.barnName,
                barns.barnImage,
                barns.barnPhone,
                barns.barnEmail,
                barns.barnRidingStyle,
                barns.barnHorseTypes,
                CONCAT(`province`, ' - ', `region`,' - ',`localCity`) as location,
                barns.barnFacebook,
                barns.barnInstagram,
                barns.barnTwitter,
                SUBSTRING(barns.barnDescription, 1, 200) as barnDescription,
                barns.barnOpenHours FROM barns LEFT JOIN barnAdmins ON barns.ID = barnAdmins.barnId LEFT JOIN users ON barnAdmins.userId = users.ID 
                LEFT JOIN slovakPlaces ON slovakPlaces.ID = barns.locationId
                WHERE token = :token ORDER BY barnName ASC",
        array('token' => $token)));
    }

    public static function getUserServices($token){
        return json_encode(getData("SELECT
                services.ID,
                users.fullName,
                barns.barnName,
                userId,
                barnId,
                type,
                CONCAT(`province`, ' - ', `region`,' - ',`localCity`) as location,
                isWillingToTravel,
                rangeOfOperation,
                SUBSTRING(`descriptionOfService`, 1, 200) as descriptionOfService,
                price,
                workHours FROM services 
                LEFT JOIN users ON services.userId = users.ID 
                LEFT JOIN barns ON barns.ID = services.barnId
                LEFT JOIN slovakPlaces ON slovakPlaces.ID = barns.locationId
                WHERE token = :token ORDER BY type ASC",
                array('token' => $token)));
    }

    public static function getUserEvents($token){
        return json_encode(getData("SELECT
                events.ID,
                barnId,
                barnName,
                fullName,
                barnEmail,
                email,
                userId,
                eventName,
                eventType,
                eventImage,
                DATE_FORMAT(eventDate, '%d.%m.%Y %H:%i') as eventDate,
                eventStreet,
                eventDescription,
                eventFBLink,
                CONCAT(`province`, ' - ', `region`,' - ',`localCity`) as location
                FROM events 
                LEFT JOIN users ON events.userId = users.ID 
                LEFT JOIN barns ON barns.ID = events.barnId
                LEFT JOIN slovakPlaces ON slovakPlaces.ID = events.locationId
                WHERE token = :token ORDER BY eventDate ASC",
                array('token' => $token)));
    }

    public static function getEventDetails($eventId){
        $eventDetails = array();
        $eventDetails['generalDetails'] = getData("SELECT
                events.ID,
                barnId,
                barnName,
                fullName,
                barnEmail,
                email,
                userId,
                eventName,
                barnPhone,
                phoneNumber,
                eventType,
                eventImage,
                DATE_FORMAT(eventDate, '%d.%m.%Y - %H:%i') as eventDate,
                eventStreet,
                eventDescription,
                eventFBLink,
                CONCAT(`province`, ' - ', `region`,' - ',`localCity`) as location
                FROM events 
                LEFT JOIN users ON events.userId = users.ID 
                LEFT JOIN barns ON barns.ID = events.barnId
                LEFT JOIN slovakPlaces ON slovakPlaces.ID = events.locationId
                WHERE events.ID = :ID", array('ID' => $eventId));
        $eventDetails['gallery'] = getData("SELECT * FROM eventGalleries WHERE eventId = :ID", array('ID' => $eventId));
        return json_encode($eventDetails);
    }

    public static function getBarnDetails($barnId){
        $barnDetails = array();
        //generalInfor
        $barnDetails['generalDetails'] = getData("SELECT 
        barns.ID,
        barnName,
        barnImage,
        barnStreet,
        barnPhone,
        barnContactPerson,
        barnEmail,
        barnRidingStyle,
        barnHorseTypes,
        barnFacebook,
        CONCAT(`province`, ' - ', `region`,' - ',`localCity`) as location,
        barnInstagram,
        barnTwitter,
        barnYoutube,
        barnDescription,
        barnOpenHours 
        FROM barns LEFT JOIN slovakPlaces ON barns.locationId = slovakPlaces.ID WHERE barns.ID = :ID", array('ID' => $barnId));
        //servicesForBarns
        $barnDetails['barnServices'] = getData("SELECT * FROM services WHERE barnId = :ID", array('ID' => $barnId));
        //galeries
        $barnDetails['gallery'] = getData("SELECT * FROM barnGalleries WHERE barnId = :ID", array('ID' => $barnId));
        //barnNews
        $barnDetails['barnNews'] = getData("SELECT * FROM barnNews WHERE barnId = :ID", array('ID' => $barnId));

        return json_encode($barnDetails);
    }

    public static function getServiceDetails($serviceId){
        $serviceDetails = array();
        //generalInfor
        $serviceDetails['generalDetails'] = getData("SELECT services.ID,
			users.fullName,
			barns.barnName,
			users.email as userEmail,
			barns.barnEmail as barnEmail,
			barns.barnPhone as barnPhone,
			users.phoneNumber as userPhone,
			barns.ID as barnId,
            userId,
            barnId,
            type,
            serviceImage,
            CONCAT(`province`, ' - ', `region`,' - ',`localCity`) as location,
            street,
            isWillingToTravel,
            rangeOfOperation,
            descriptionOfService,
            price,
            workHours FROM services JOIN slovakPlaces ON services.locationId = slovakPlaces.ID 
            LEFT 
            JOIN users ON users.ID = services.userId
            LEFT 
            JOIN barns ON barns.ID = services.barnId
            WHERE services.ID = :ID", array('ID' => $serviceId));

        $serviceDetails['gallery'] = getData("SELECT * FROM serviceGalleries WHERE serviceId = :ID", array('ID' => $serviceId));
        $serviceDetails['specialCriteria'] = getData("SELECT * FROM specialServiceCriteria WHERE serviceId = :ID", array('ID' => $serviceId));

        return json_encode($serviceDetails);
    }

    public static function searchServices($searchCriteria){
            $specificCriteriaValues = $_POST['specificCriteriaValues']; //array
            $specificCriteriaName = $_POST['specificCriteriaName'];
            $service = $_POST['service'];
            $distanceRange = $_POST['distanceRange'];
            $rangeSQLClause = "";
            $locationStringAndValues = servicesBarnsEvents::buildLocationsSQLStringAndEscapedValues();
            $locations = $locationStringAndValues['locations'];
            $searchCriteriaArray = $locationStringAndValues['values'];

            if ($distanceRange != "" && $searchCriteriaArray['localCity'] != ""){
                $getLocalCityGPSCoordinates = getData("SELECT latitude, longitude FROM slovakPlaces " . $locations, $searchCriteriaArray)[0];
                $rangeSQLClause = " OR services.locationId IN (SELECT
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
                                    ) as locationId)";

                $searchCriteriaArray['latitude'] = $getLocalCityGPSCoordinates['latitude'];
                $searchCriteriaArray['longitude'] = $getLocalCityGPSCoordinates['longitude'];
                $searchCriteriaArray['distanceRange'] = $distanceRange;
            }
            
            $searchCriteriaArray['service'] = $service;

            if ($specificCriteriaValues != ""){
                $specificCriteriaSQLString = "";
                $specificCriteriaValues = explode(',',$specificCriteriaValues);
                for ($i=0; $i < count($specificCriteriaValues); $i++) { 
                    $specificCriteriaSQLString .= ' (specificCriteria = :specificName AND specificValue = :specificValue'. $i . ') OR';
                    $searchCriteriaArray['specificValue'.$i] = $specificCriteriaValues[$i];
                }
                $searchCriteriaArray['specificName'] = $specificCriteriaName;
                $specificCriteriaSQLString = rtrim($specificCriteriaSQLString,"OR");
                $specificCriteriaSQLString = ' AND ('.$specificCriteriaSQLString.') ';
                echo $specificCriteriaSQLString;
            }

            $searchSQLClause = "SELECT * FROM services LEFT JOIN slovakPlaces ON services.locationId = slovakPlaces.ID LEFT JOIN barns ON barns.ID = services.barnId LEFT JOIN users ON users.ID = services.userId LEFT JOIN specialServiceCriteria ON specialServiceCriteria.serviceId = services.ID WHERE type = :service AND (services.locationId IN (SELECT id FROM slovakPlaces ".$locations.")" . $rangeSQLClause . ") " . $specificCriteriaSQLString;
            return json_encode(getData($searchSQLClause,$searchCriteriaArray));

    }

    public static function searchMarket($searchCriteria){
        // TO DO 
        // TO DO 
        // TO DO 
        // TO DO 
            $category = $_POST['category']; //array
            $distanceRange = $_POST['distanceRange'];
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

            $searchSQLClause = "SELECT * FROM services LEFT JOIN slovakPlaces ON services.locationId = slovakPlaces.ID LEFT JOIN barns ON barns.ID = services.barnId LEFT JOIN users ON users.ID = services.userId WHERE services.locationId IN (SELECT id FROM slovakPlaces ".$locations.")" . $rangeSQLClause;
            return json_encode(getData($searchSQLClause,$searchCriteriaArray));
    }

    public static function getSpecialServiceCriteria($serviceType){
        $specialCriteria = array();
        $xml=simplexml_load_file($_SERVER["DOCUMENT_ROOT"]."/assets/searchFilter.xml");
        foreach($xml->children() as $child)
        {
            if ($child->attributes() == $serviceType){
                foreach($child->children() as $searchInput)
                {
                    if ($searchInput->attributes()['type'] == 'multiselect'){
                        foreach($searchInput->children() as $option)
                        {
                            array_push($specialCriteria,array('specificCriteria'=>$searchInput->attributes()['name'],'specificValue'=>$option->attributes()['name']));
                        }
                    }
                }
            }
        }
        return json_encode($specialCriteria);
    }

/*
 *
 * ADD NEW ASSETS
 *  
 */
    public static function addNewBarn($newBarnDetails, $files){
        if (!userManagement::isUserLoggedIn($newBarnDetails['token'])){
            return 'Užívaťeľ nie je prihlásený';
        }
        $userId = userManagement::getUserInfo($newBarnDetails['token'])['ID'];
        $locationId = siteAssetsFromDB::getLocationId($newBarnDetails['locationProvince'], $newBarnDetails['locationRegion'], $newBarnDetails['locationLocalCity']);
        $imagePaths = NULL;
        if (count($files['barnImage']) > 0){
            $imagePaths = saveFiles::saveFiles($files['barnImage'], '/img/barnImages/')[0];
        }
        if (count($files['barnGallery']) > 0){
            $galleryImages = saveFiles::saveFiles($files['barnGallery'], '/img/barnImages/');
        }

        insertData("INSERT INTO barns 
        (barnName,
	     barnImage,
	     locationId,
	     barnStreet,
	     barnPhone,
	     barnContactPerson,
	     barnEmail,
	     barnRidingStyle,
	     barnHorseTypes,
	     barnFacebook,
	     barnInstagram,
	     barnTwitter,
	     barnYoutube,
	     barnDescription,
	     barnOpenHours)
        VALUES 
        (
        :barnName,
	    :barnImage,
	    :locationId,
	    :barnStreet,
	    :barnPhone,
	    :barnContactPerson,
	    :barnEmail,
	    :barnRidingStyle,
	    :barnHorseTypes,
	    :barnFacebook,
	    :barnInstagram,
	    :barnTwitter,
	    :barnYoutube,
	    :barnDescription,
	    :barnOpenHours
        )"
        ,array(
         'barnName' => $newBarnDetails['barnName'],
	     'barnImage' => $imagePaths,
	     'locationId' => $locationId,
	     'barnStreet' => $newBarnDetails['barnStreet'],
	     'barnPhone' => $newBarnDetails['barnPhone'],
	     'barnContactPerson' => $newBarnDetails['barnContactPerson'],
	     'barnEmail' => $newBarnDetails['barnEmail'],
	     'barnRidingStyle' => $newBarnDetails['barnRidingStyle'],
	     'barnHorseTypes' => $newBarnDetails['barnHorseTypes'],
	     'barnFacebook' => $newBarnDetails['barnFacebook'],
	     'barnInstagram' => $newBarnDetails['barnInstagram'],
	     'barnTwitter' => $newBarnDetails['barnTwitter'],
	     'barnYoutube' => $newBarnDetails['barnYoutube'],
	     'barnDescription' => $newBarnDetails['barnDescription'],
	     'barnOpenHours' => $newBarnDetails['barnOpenHours'],
        ));

        $ID = getData("SELECT ID from barns ORDER BY ID DESC LIMIT 1")[0]['ID'];
        $barnGalleryValues = "";
        foreach ($galleryImages as $singleImage) {
            $barnGalleryValues .= "(".$ID.",'".$singleImage."'),";
        }
        insertData("INSERT INTO barnGalleries (barnId, imageLink) VALUES " . rtrim($barnGalleryValues,','));
        insertData("INSERT INTO barnAdmins (userId, barnId) VALUES (".$userId.",".$ID.")");
    }


    public static function addNewService($newServiceDetails, $files){

        if (!userManagement::isUserLoggedIn($newServiceDetails['token'])){
            return 'Užívaťeľ nie je prihlásený';
        }
        $userId = userManagement::getUserInfo($newServiceDetails['token'])['ID'];
        $barnId = NULL;
        if ($newServiceDetails['serviceProvider'] != 'me'){
            $barnId = $newServiceDetails['serviceProvider'];
        }
        $locationId = siteAssetsFromDB::getLocationId($newServiceDetails['locationProvince'], $newServiceDetails['locationRegion'], $newServiceDetails['locationLocalCity']);
        $imagePaths = NULL;
        if (count($files['serviceImage']) > 0){
            $imagePaths = saveFiles::saveFiles($files['serviceImage'], '/img/serviceImages/')[0];
        }
        if (count($files['serviceGallery']) > 0){
            $galleryImages = saveFiles::saveFiles($files['serviceGallery'], '/img/serviceImages/');
        }

        insertData("INSERT INTO services 
                (barnId,
                 userId,
	             type,
                 serviceImage,
	             locationId,
	             street,
	             isWillingToTravel,
	             rangeOfOperation,
	             descriptionOfService,
	             price,
                 workHours) 
                 VALUES 
                 (
                :barnId,
                :userId,
                :type,
                :serviceImage,
                :locationId,
                :street,
                :isWillingToTravel,
                :rangeOfOperation,
                :descriptionOfService,
                :price,
                :workHours
                 )",
                 array(
                     'barnId'=> $barnId,
                     'userId'=> $userId,
                     'type'=> $newServiceDetails['type'],
                     'serviceImage'=> $imagePaths,
                     'locationId'=> $locationId,
                     'street'=> $newServiceDetails['street'],
                     'isWillingToTravel'=> $newServiceDetails['isWillingToTravel'],
                     'rangeOfOperation'=> $newServiceDetails['rangeOfOperation'],
                     'descriptionOfService'=> $newServiceDetails['descriptionOfService'],
                     'price'=> $newServiceDetails['price'],
                     'workHours'=> $newServiceDetails['workHours']
                 ));
        
        $ID = getData("SELECT ID from services ORDER BY ID DESC LIMIT 1")[0]['ID'];
        $serviceGalleryValues = "";
        foreach ($galleryImages as $singleImage) {
            $serviceGalleryValues .= "(".$ID.",'".$singleImage."'),";
        }
        insertData("INSERT INTO serviceGalleries (serviceId, imageLink) VALUES " . rtrim($serviceGalleryValues,','));

        $specialCriteriaSQL = "INSERT INTO specialServiceCriteria (serviceId, specificCriteria, specificValue) VALUES ";
        $specialServiceCriteria = explode(',',$newServiceDetails['specialServiceCriteria']);
        $insertSpecialCriteriaParameters = array();
        $x = 0;
        foreach ($specialServiceCriteria as $singleSpecialCriteriaBundle) {
            $specialCriteriaSQL .= '('.$ID.',:specialCriteria'.$x.', :specialValue'.$x.'),';
            $specialCriteriaKeyAndValue = explode('|',$singleSpecialCriteriaBundle);
            $insertSpecialCriteriaParameters['specialCriteria'.$x] = $specialCriteriaKeyAndValue[0];
            $insertSpecialCriteriaParameters['specialValue'.$x] = $specialCriteriaKeyAndValue[1];
            $x++;
        }
        $specialCriteriaSQL = rtrim($specialCriteriaSQL,',');
        insertData($specialCriteriaSQL,$insertSpecialCriteriaParameters);
    }


    public static function addNewEvent($newEventDetails, $files){
        if (!userManagement::isUserLoggedIn($newEventDetails['token'])){
            return 'Užívaťeľ nie je prihlásený';
        }
        $userId = userManagement::getUserInfo($newEventDetails['token'])['ID'];
        $barnId = NULL;
        if ($newEventDetails['organizer'] != 'me'){
            $barnId = $newEventDetails['organizer'];
        }

        $locationId = siteAssetsFromDB::getLocationId($newEventDetails['locationProvince'], $newEventDetails['locationRegion'], $newEventDetails['locationLocalCity']);
        $imagePaths = NULL;
        if (count($files['eventImage']) > 0){
            $imagePaths = saveFiles::saveFiles($files['eventImage'], '/img/eventImages/')[0];
        }
        if (count($files['eventGallery']) > 0){
            $galleryImages = saveFiles::saveFiles($files['eventGallery'], '/img/eventImages/');
        }

        insertData("INSERT INTO events 
        (barnId,
	    userId,
	    eventName,
        eventType,
        eventImage,
	    eventDate,
	    locationId,
	    eventStreet,
	    eventDescription,
	    eventFBLink)
        VALUES 
        (
        :barnId,
	    :userId,
	    :eventName,
        :eventType,
        :eventImage,
	    :eventDate,
	    :locationId,
	    :eventStreet,
	    :eventDescription,
	    :eventFBLink
        )"
        ,array(
        'barnId' => $barnId,
        'userId' => $userId,
        'eventName' => $newEventDetails['eventName'],
        'eventType' => $newEventDetails['eventType'],
        'eventImage' => $imagePaths,
        'eventDate' => date('Y-m-d H:i:s',strtotime($newEventDetails['eventDate'])),
        'locationId' => $locationId,
        'eventStreet' => $newEventDetails['eventStreet'],
        'eventDescription' => $newEventDetails['eventDescription'],
        'eventFBLink' => $newEventDetails['eventFBLink']
        ));

        $ID = getData("SELECT ID from events ORDER BY ID DESC LIMIT 1")[0]['ID'];
        $eventGalleryValues = "";
        foreach ($galleryImages as $singleImage) {
            $eventGalleryValues .= "(".$ID.",'".$singleImage."'),";
        }
        insertData("INSERT INTO eventGalleries (eventId, imageLink) VALUES " . rtrim($eventGalleryValues,','));
    }

    /*
     * 
     * EDIT ASSETS
     * 
     */

    public static function saveEditBarn($editedBarnDetails, $files){
        if (!userManagement::isUserLoggedIn($editedBarnDetails['token'])){
            return 'Užívaťeľ nie je prihlásený';
        }
        $userId = userManagement::getUserInfo($editedBarnDetails['token'])['ID'];
        //CHECK IF USER IS BARN ADMIN
        if (count(getData("SELECT ID from barnAdmins WHERE userId = '".$userId."' AND barnId = :barnId",array('barnId'=>$editedBarnDetails['ID']))) == 0){
            return "Užívateľ nie je admin";
        }

        $locationId = siteAssetsFromDB::getLocationId($editedBarnDetails['locationProvince'], $editedBarnDetails['locationRegion'], $editedBarnDetails['locationLocalCity']);
        $imagePaths = NULL;
        if (count($files['barnImage']) > 0){
            $imagePaths = saveFiles::saveFiles($files['barnImage'], '/img/barnImages/')[0];
        }
        $galleryImages = NULL;
        if (count($files['barnGallery']) > 0){
            $galleryImages = saveFiles::saveFiles($files['barnGallery'], '/img/barnImages/');
        }

        $editedDetails = array();
        $editedDetails['barnName'] = $editedBarnDetails['barnName'];
        if ($imagePaths != NULL){
            $editedDetails['barnImage'] = $imagePaths;
            $barnImage = "barnImage = :barnImage,";
        }else{
            $barnImage = "";
        }
        $editedDetails['locationId'] = $locationId;
        $editedDetails['barnStreet'] = $editedBarnDetails['barnStreet'];
        $editedDetails['barnPhone'] = $editedBarnDetails['barnPhone'];
        $editedDetails['barnContactPerson'] = $editedBarnDetails['barnContactPerson'];
        $editedDetails['barnEmail'] = $editedBarnDetails['barnEmail'];
        $editedDetails['barnRidingStyle'] = $editedBarnDetails['barnRidingStyle'];
        $editedDetails['barnHorseTypes'] = $editedBarnDetails['barnHorseTypes'];
        $editedDetails['barnFacebook'] = $editedBarnDetails['barnFacebook'];
        $editedDetails['barnInstagram'] = $editedBarnDetails['barnInstagram'];
        $editedDetails['barnTwitter'] = $editedBarnDetails['barnTwitter'];
        $editedDetails['barnYoutube'] = $editedBarnDetails['barnYoutube'];
        $editedDetails['barnDescription'] = $editedBarnDetails['barnDescription'];
        $editedDetails['barnOpenHours'] = $editedBarnDetails['barnOpenHours'];
        $editedDetails['ID'] = $editedBarnDetails['ID'];


        insertData("UPDATE barns SET
         barnName = :barnName,
	     ".$barnImage."
	     locationId = :locationId,
	     barnStreet = :barnStreet,
	     barnPhone = :barnPhone,
	     barnContactPerson = :barnContactPerson,
	     barnEmail = :barnEmail,
	     barnRidingStyle = :barnRidingStyle,
	     barnHorseTypes = :barnHorseTypes,
	     barnFacebook = :barnFacebook,
	     barnInstagram = :barnInstagram,
	     barnTwitter = :barnTwitter,
	     barnYoutube = :barnYoutube,
	     barnDescription = :barnDescription,
         barnOpenHours = :barnOpenHours
         WHERE ID = :ID",$editedDetails);

        if ($galleryImages != NULL){
            $ID = $editedBarnDetails['ID'];
            $barnGalleryValues = "";
            foreach ($galleryImages as $singleImage) {
                $barnGalleryValues .= "(".$ID.",'".$singleImage."'),";
            }
            insertData("INSERT INTO barnGalleries (barnId, imageLink) VALUES " . rtrim($barnGalleryValues,','));
        }
    }


    public static function saveEditService($editedServiceDetails, $files){
        if (!userManagement::isUserLoggedIn($editedServiceDetails['token'])){
            return 'Užívaťeľ nie je prihlásený';
        }

        $userId = userManagement::getUserInfo($editedServiceDetails['token'])['ID'];
                
        //CHECK IF USER IS SERVICE OWNER
        if (count(getData("SELECT ID from services WHERE userId = '".$userId."' AND ID = :ID",array('ID'=>$editedServiceDetails['ID']))) == 0){
            return "Užívateľ nie je vlastník služby";
        }

        $barnId = NULL;
        if ($editedServiceDetails['serviceProvider'] != 'me'){
            $barnId = $editedServiceDetails['serviceProvider'];
        }

        $locationId = siteAssetsFromDB::getLocationId($editedServiceDetails['locationProvince'], $editedServiceDetails['locationRegion'], $editedServiceDetails['locationLocalCity']);
        $imagePaths = NULL;
        if (count($files['serviceImage']) > 0){
            $imagePaths = saveFiles::saveFiles($files['serviceImage'], '/img/serviceImages/')[0];
        }
        $galleryImages = NULL;
        if (count($files['serviceGallery']) > 0){
            $galleryImages = saveFiles::saveFiles($files['serviceGallery'], '/img/serviceImages/');
        }

        $editedDetails = array();
        if ($imagePaths != NULL){
            $editedDetails['serviceImage'] = $imagePaths;
            $serviceImage = "serviceImage = :serviceImage,";
        }else{
            $serviceImage = "";
        }

        $editedDetails['barnId'] = $barnId;
        $editedDetails['userId'] = $userId;
        $editedDetails['type'] = $editedServiceDetails['type'];
        $editedDetails['locationId'] = $locationId;
        $editedDetails['street'] = $editedServiceDetails['street'];
        $editedDetails['isWillingToTravel'] = $editedServiceDetails['isWillingToTravel'];
        $editedDetails['rangeOfOperation'] = $editedServiceDetails['rangeOfOperation'];
        $editedDetails['descriptionOfService'] = $editedServiceDetails['descriptionOfService'];
        $editedDetails['price'] = $editedServiceDetails['price'];
        $editedDetails['workHours'] = $editedServiceDetails['workHours'];
        $editedDetails['ID'] = $editedServiceDetails['ID'];
                 
        insertData("UPDATE services SET
             barnId = :barnId,
             userId = :userId,
             type = :type,
             ".$serviceImage."
             locationId = :locationId,
             street = :street,
             isWillingToTravel = :isWillingToTravel,
             rangeOfOperation = :rangeOfOperation,
             descriptionOfService = :descriptionOfService,
             price = :price,
             workHours = :workHours
             WHERE ID = :ID",$editedDetails);
        
        $ID = $editedServiceDetails['ID'];
        if ($imagePaths != NULL){
            $serviceGalleryValues = "";
            foreach ($galleryImages as $singleImage) {
                $serviceGalleryValues .= "(".$ID.",'".$singleImage."'),";
            }
            insertData("INSERT INTO serviceGalleries (serviceId, imageLink) VALUES " . rtrim($serviceGalleryValues,','));
        }

        $specialCriteriaSQL = "INSERT IGNORE INTO specialServiceCriteria (serviceId, specificCriteria, specificValue) VALUES ";
        $specialServiceCriteria = explode(',',$editedServiceDetails['specialServiceCriteria']);
        $insertSpecialCriteriaParameters = array();
        $x = 0;
        foreach ($specialServiceCriteria as $singleSpecialCriteriaBundle) {
            $specialCriteriaSQL .= '('.$ID.',:specialCriteria'.$x.', :specialValue'.$x.'),';
            $specialCriteriaKeyAndValue = explode('|',$singleSpecialCriteriaBundle);
            $insertSpecialCriteriaParameters['specialCriteria'.$x] = $specialCriteriaKeyAndValue[0];
            $insertSpecialCriteriaParameters['specialValue'.$x] = $specialCriteriaKeyAndValue[1];
            $x++;
        }
        $specialCriteriaSQL = rtrim($specialCriteriaSQL,',');
        insertData($specialCriteriaSQL,$insertSpecialCriteriaParameters);
    }


    public static function saveEditEvent($editedEventDetails, $files){
        if (!userManagement::isUserLoggedIn($editedEventDetails['token'])){
            return 'Užívaťeľ nie je prihlásený';
        }
        $userId = userManagement::getUserInfo($editedEventDetails['token'])['ID'];

        //CHECK IF USER IS SERVICE OWNER
        if (count(getData("SELECT ID from events WHERE userId = '".$userId."' AND ID = :ID",array('ID'=>$editedEventDetails['ID']))) == 0){
            return "Užívateľ nie je vlastník udalosti";
        }

        $barnId = NULL;
        if ($editedEventDetails['organizer'] != 'me'){
            $barnId = $editedEventDetails['organizer'];
        }

        $locationId = siteAssetsFromDB::getLocationId($editedEventDetails['locationProvince'], $editedEventDetails['locationRegion'], $editedEventDetails['locationLocalCity']);
        $imagePaths = NULL;
        if (count($files['eventImage']) > 0){
            $imagePaths = saveFiles::saveFiles($files['eventImage'], '/img/eventImages/')[0];
        }
        $galleryImages = NULL;
        if (count($files['eventGallery']) > 0){
            $galleryImages = saveFiles::saveFiles($files['eventGallery'], '/img/eventImages/');
        }

        $editedDetails = array();
        if ($imagePaths != NULL){
            $editedDetails['eventImage'] = $imagePaths;
            $eventImage = "eventImage = :eventImage,";
        }else{
            $eventImage = "";
        }
        
        $editedDetails['barnId'] = $barnId;
        $editedDetails['userId'] = $userId;
        $editedDetails['eventName'] = $editedEventDetails['eventName'];
        $editedDetails['eventType'] = $editedEventDetails['eventType'];
        $editedDetails['eventDate'] = date('Y-m-d H:i:s',strtotime($editedEventDetails['eventDate']));
        $editedDetails['locationId'] = $locationId;
        $editedDetails['eventStreet'] = $editedEventDetails['eventStreet'];
        $editedDetails['eventDescription'] = $editedEventDetails['eventDescription'];
        $editedDetails['eventFBLink'] = $editedEventDetails['eventFBLink'];
        $editedDetails['ID'] = $editedEventDetails['ID'];

        insertData("UPDATE events SET
        barnId = :barnId,
	    userId = :userId,
	    eventName = :eventName,
        eventType = :eventType,
        ".$eventImage."
	    eventDate = :eventDate,
	    locationId = :locationId,
	    eventStreet = :eventStreet,
	    eventDescription = :eventDescription,
        eventFBLink = :eventFBLink
        WHERE ID = :ID",$editedDetails);

        if ($galleryImages != NULL){
            $ID = $editedEventDetails['ID'];
            $eventGalleryValues = "";
            foreach ($galleryImages as $singleImage) {
                $eventGalleryValues .= "(".$ID.",'".$singleImage."'),";
            }
            insertData("INSERT INTO eventGalleries (eventId, imageLink) VALUES " . rtrim($eventGalleryValues,','));
        }
    }



    /*
     *
     *  SEARCH
     * 
     */

    public static function getFiveEvents($searchCriteria){
            $specificCriteriaValues = $searchCriteria['type'];
            $page = $searchCriteria['page'];
            $distanceRange = $searchCriteria['distanceRange'];
            $rangeSQLClause = "";
            $locationStringAndValues = servicesBarnsEvents::buildLocationsSQLStringAndEscapedValues();
            $locations = $locationStringAndValues['locations'];
            $searchCriteriaArray = $locationStringAndValues['values'];

            if ($distanceRange != "" && $searchCriteriaArray['localCity'] != ""){
                $getLocalCityGPSCoordinates = getData("SELECT latitude, longitude FROM slovakPlaces " . $locations, $searchCriteriaArray)[0];
                $rangeSQLClause = " OR events.locationId IN (SELECT
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
                                    ) as locationId)";

                $searchCriteriaArray['latitude'] = $getLocalCityGPSCoordinates['latitude'];
                $searchCriteriaArray['longitude'] = $getLocalCityGPSCoordinates['longitude'];
                $searchCriteriaArray['distanceRange'] = $distanceRange;
            }

            if ($specificCriteriaValues != "" && $specificCriteriaValues != 'null'){
                $specificCriteriaSQLString = "";
                $specificCriteriaValues = explode(',',$specificCriteriaValues);
                for ($i=0; $i < count($specificCriteriaValues); $i++) { 
                    $specificCriteriaSQLString .= ' (eventType LIKE :specificValue'. $i . ') AND';
                    $searchCriteriaArray['specificValue'.$i] = '%'.$specificCriteriaValues[$i] .'%';
                }
                $specificCriteriaSQLString = rtrim($specificCriteriaSQLString,"AND");
                $specificCriteriaSQLString = ' AND ('.$specificCriteriaSQLString.') ';
            }

            $page = filter_var($page, FILTER_SANITIZE_NUMBER_INT) * 5;
            $searchSQLClause = "SELECT events.ID as eventId, localCity,province,region, barns.ID as barnId, eventName, barns.barnName, users.ID as userId, events.eventDescription, DATE_FORMAT(events.eventDate, '%d.%m.%Y - %H:%i') as eventDate, events.eventImage  FROM events LEFT JOIN slovakPlaces ON events.locationId = slovakPlaces.ID LEFT JOIN barns ON barns.ID = events.barnId LEFT JOIN users ON users.ID = events.userId WHERE (events.locationId IN (SELECT id FROM slovakPlaces ".$locations.")" . $rangeSQLClause . ") " . $specificCriteriaSQLString . " LIMIT 5 OFFSET " . $page;
            return json_encode(getData($searchSQLClause,$searchCriteriaArray));
    }

    public static function getLocationFromBacked($entity)
    {
        if ($entity == 'me'){
            return;
        }else{
            return json_encode(getData("SELECT localCity,province,region FROM barns JOIN slovakPlaces ON barns.locationId = slovakPlaces.ID WHERE barns.ID = :ID",array('ID'=>$entity)));
        }
    }

    //SUPPORT FUNCTIONS
    
    private static function buildLocationsSQLStringAndEscapedValues(){
        $province = explode("|",$_POST['locationProvince'])[1];
        $region = explode("|",$_POST['locationRegion'])[1];
        $localCity = explode("|",$_POST['locationLocalCity'])[1];
        $rangeSQLClause = "";
        $locationBuilder = array();
        $searchCriteriaArray = array();
        if ($province != ""){
            $searchCriteriaArray['province'] = $province;
            array_push($locationBuilder, " province = :province ");
        }
        if ($region != ""){
            $searchCriteriaArray['region'] = $region;
            array_push($locationBuilder, " region = :region ");
        }
        if ($localCity != ""){
            $searchCriteriaArray['localCity'] = $localCity;
            array_push($locationBuilder, " localCity = :localCity ");
        }

        $locations = count($locationBuilder) > 0 ? "WHERE ". implode("AND",$locationBuilder) : "";
        $returnArray['locations'] = $locations;
        $returnArray['values'] = $searchCriteriaArray;
        return $returnArray;
    }

    /*
    SEARCH RANGE QUERY 
SELECT id FROM slovakPlaces WHERE 
localCity = $locationLocalCity
region = $locationRegion
province = $locationProvince

SELECT
    id FROM (
		 SELECT id,(
	        6378 * acos (
	        cos ( radians( :latitude ) )
	        * cos( radians( latitude ) )
	        * cos( radians( longitude ) - radians( :longitude ) )
	        + sin ( radians( 49.29175 ) )
	        * sin( radians( :latitude ) )
	        )
	    ) AS distance
	    FROM slovakPlaces
	    HAVING distance < 20
	    ORDER BY distance
	 ) as locationId
    
    */
}


?>