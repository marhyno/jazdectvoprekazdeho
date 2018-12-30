<?php
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
                barns.barnLocation,
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
                location,
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
            $province = explode("|",$_POST['locationProvince'])[1];
            $region = explode("|",$_POST['locationRegion'])[1];
            $localCity = explode("|",$_POST['locationLocalCity'])[1];
            $distanceRange = $_POST['distanceRange'];
            $specificCriteria = $_POST['specificCriteria']; //array
            $service = $_POST['service'];
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

            if ($distanceRange != "" && $localCity != ""){
                $getLocalCityGPSCoordinates = getData("SELECT latitude, longitude FROM slovakPlaces WHERE localCity = :localCity AND region = :region AND province = :province", 
                array('localCity' => $localCity,'region' => $region,'province' => $province))[0];
                $rangeSQLClause = " OR locationId IN (SELECT
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

            $locations = count($locationBuilder) > 0 ? "WHERE ". implode("AND",$locationBuilder) : "";
            $searchSQLClause = "SELECT * FROM services WHERE locationId IN (SELECT id FROM slovakPlaces ".$locations.")" . $rangeSQLClause;
            return json_encode(getData($searchSQLClause,$searchCriteriaArray));

    }

    public static function searchMarket($searchCriteria){
        return $searchCriteria;
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