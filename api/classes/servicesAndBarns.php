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
                userId,
                barnId,
                type,
                location,
                isWillingToTravel,
                rangeOfOperation,
                descriptionOfService,
                price FROM services LEFT JOIN users ON services.userId = users.ID WHERE token = :token ORDER BY type ASC",
                array('token' => $token)));
    }
}


?>