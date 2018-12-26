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

    /*
    SEARCH RANGE QUERY 

    SELECT
    id, localCity,region, province, (
        6378 * acos (
        cos ( radians( :latitude ) )
        * cos( radians( latitude ) )
        * cos( radians( longitude ) - radians( :longitude ) )
        + sin ( radians( :latitude ) )
        * sin( radians( latitude ) )
        )
    ) AS distance
    FROM slovakPlaces
    HAVING distance < :range
    ORDER BY distance
    
    */
}


?>