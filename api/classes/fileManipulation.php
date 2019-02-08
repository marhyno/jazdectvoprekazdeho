<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/assets/phpImageMagician/php_image_magician.php');
class fileManipulation
{
    public function __construct() {
        // allocate your stuff
    }

    public static function saveFiles($inputFiles, $path) // $path = /path/to/dest/
    {   

        $fileCount = count($inputFiles['name']);
        $returnImagePaths = array();
        for ($i = 0; $i < $fileCount; $i++) 
        {    
            $info = pathinfo($inputFiles['name'][$i]);
            $ext = $info['extension'];
            $allowedExtensions = array('jpeg','jpg','png','gif','tiff','bmp');
            if (!in_array($ext,$allowedExtensions)){
                echo 'Neplatný formát súboru';
                return;
            }
            $uploaddir = $_SERVER["DOCUMENT_ROOT"] . $path;
            usleep(1000);
            $timeStamp = round(microtime(true) * 1000);
            $uploadfile = $uploaddir . $timeStamp . '.' . $ext;
            move_uploaded_file($inputFiles['tmp_name'][$i], $uploadfile);
            chmod($uploadfile, 0755);
            // Open JPG image
            $magicianObj = new imageLib($uploadfile);
            // Resize to best fit then crop
            $magicianObj -> resizeImage(1366, 768,'portrait');
            // Save resized image as a PNG
            $magicianObj -> saveImage($uploadfile,70);

            array_push($returnImagePaths, $path . $timeStamp . '.' . $ext);
        }

        return $returnImagePaths;
    }

    public static function removeGallery($assetType, $assetId){
        switch (strtolower($assetType)) {
            case 'barn':
                $mainImageTable = "barns";
                $mainImageColumn = "barnImage";
                $table = "barnGalleries";
                $columnName = "barnId";
                break;
            case 'service':
                $mainImageTable = "services";
                $mainImageColumn = "serviceImage";
                $table = "serviceGalleries";
                $columnName = "serviceId";
                break;
            case 'event':
                $mainImageTable = "events";
                $mainImageColumn = "eventImage";
                $table = "eventGalleries";
                $columnName = "eventId";
                break;
            case 'advert':
                $table = "marketGalleries";
                $columnName = "itemId";
                break; 
            default:
                return;
        }
        $queryPrepare = "SELECT imageLink FROM " . $table ." WHERE " . $columnName . " = :ID";
        if ($mainImageTable != ""){
        $queryPrepare .= " UNION SELECT ".$mainImageColumn." FROM " . $mainImageTable ." WHERE ID = :ID";  
        }

        $imageLinks = getData($queryPrepare,array('ID'=>$assetId));
        foreach ($imageLinks as $singleImage) {
            unlink($_SERVER["DOCUMENT_ROOT"] . $singleImage['imageLink']); 
        }
    }

    public static function removeSingleImageFromAssetGallery($details){
        if (!userManagement::isUserLoggedIn($details['token'])){
            return 'Užívaťeľ nie je prihlásený';
        }

        switch ($details['what']) {
            case 'stajňu':
                $galleryType = 'barnGalleries';
                $parentTable = 'barns';
                $joinAdmins = ' JOIN barnAdmins ON barns.ID = barnAdmins.barnId ';
                break;
            case 'službu':
                $galleryType = 'serviceGalleries';
                $parentTable = 'services';
                break;
            case 'udalosť':
                $galleryType = 'eventGalleries';
                $parentTable = 'events';
                break;
            case 'inzerát':
                $galleryType = 'marketGalleries';
                $parentTable = 'market';
                break;
            default:
                break;
        }

        $userId = getData("SELECT userId FROM ".$parentTable. $joinAdmins ." WHERE ".$parentTable.".ID = :assetId AND userId = (SELECT ID FROM users WHERE token = :token)",array('assetId'=>$details['ID'],'token' => $details['token']));
        if (count($userId) == 0){
            return 'Užívaťeľ nie je vlastník stajne, preto nemôže zmazať obrázok.';
        }

        unlink($_SERVER["DOCUMENT_ROOT"] . $details['imageLink']); 
        insertData("DELETE FROM ".$galleryType." WHERE imageLink = :imageLink",array('imageLink'=>$details['imageLink']));
        return "true";
        //$details['token']
        //$details['what']
        //$details['imagePath']
    }
}
?>