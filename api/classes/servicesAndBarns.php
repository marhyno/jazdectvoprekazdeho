<?php
setlocale(LC_ALL, 'sk_SK');

class servicesAndBarns{

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
                barns.locationId,
                barns.barnPhone,
                barns.barnEmail,
                barns.barnRidingStyle,
                barns.barnHorseTypes,
                barns.barnFacebook,
                barns.barnInstagram,
                barns.barnTwitter,
                barns.barnDescription,
                barns.barnHasOpenHours FROM barns LEFT JOIN barnAdmins ON barns.ID = barnAdmins.barnId LEFT JOIN users ON barnAdmins.userId = users.ID WHERE token = :token ORDER BY barnName ASC",
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
                services.locationId,
                isWillingToTravel,
                rangeOfOperation,
                descriptionOfService,
                price FROM services 
                LEFT JOIN users ON services.userId = users.ID 
                LEFT JOIN barns ON barns.ID = services.barnId WHERE token = :token ORDER BY type ASC",
                array('token' => $token)));
    }

    public static function getBarnDetails($barnId){
        $barnDetails = array();
        //generalInfor
        $barnDetails['generalDetails'] = getData("SELECT * FROM barns WHERE ID = :ID", array('ID' => $barnId));
        //servicesForBarns
        $barnDetails['barnServices'] = getData("SELECT * FROM services WHERE barnId = :ID", array('ID' => $barnId));
        //galeries
        $barnDetails['barnGallery'] = getData("SELECT * FROM barnGalleries WHERE barnId = :ID", array('ID' => $barnId));
        //barnNews
        $barnDetails['barnNews'] = getData("SELECT * FROM barnNews WHERE barnId = :ID", array('ID' => $barnId));

        return json_encode($barnDetails);
    }

    public static function getServiceDetails($serviceId){
        $barnDetails = array();
        //generalInfor
        $barnDetails['generalDetails'] = getData("SELECT * FROM services WHERE ID = :ID", array('ID' => $serviceId));
        return json_encode($barnDetails);
    }

    public static function searchServices($searchCriteria){
            $specificCriteriaValues = $_POST['specificCriteriaValues']; //array
            $specificCriteriaName = $_POST['specificCriteriaName'];
            $service = $_POST['service'];
            $distanceRange = $_POST['distanceRange'];
            $rangeSQLClause = "";
            $locationStringAndValues = servicesAndBarns::buildLocationsSQLStringAndEscapedValues();
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
            $locationStringAndValues = servicesAndBarns::buildLocationsSQLStringAndEscapedValues();
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
                            array_push($specialCriteria,array('categoryName'=>$option->attributes()['name']));
                        }
                    }
                }
            }
        }
        return json_encode($specialCriteria);
    }


    public static function addNewBarn($newBarnDetails, $files){
        if (!userManagement::isUserLoggedIn($newBarnDetails['token'])){
            return 'Užívaťeľ nie je prihlásený';
        }
    }
    public static function addNewService($newServiceDetails, $files){
        if (!userManagement::isUserLoggedIn($newServiceDetails['token'])){
            return 'Užívaťeľ nie je prihlásený';
        }
    }
    public static function addNewEvent($newEventDetails, $files){
        if (!userManagement::isUserLoggedIn($newEventDetails['token'])){
            return 'Užívaťeľ nie je prihlásený';
        }
        $userId = NULL;
        $barnId = NULL;
        if ($newEventDetails['organizer'] == 'me'){
            $userId = userManagement::getUserInfo($newEventDetails['token'])['ID'];
        }else{
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