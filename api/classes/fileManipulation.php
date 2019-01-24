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
            $magicianObj -> resizeImage(1280, 720,'portrait');
            // Save resized image as a PNG
            $magicianObj -> saveImage($uploadfile,70);

            array_push($returnImagePaths, $path . $timeStamp . '.' . $ext);
        }

        return $returnImagePaths;
    }

    public static function removeGallery($assetType, $assetId){
        switch (strtolower($assetType)) {
            case 'barn':
                $table = "barnGalleries";
                $columnName = "barnId";
                break;
            case 'service':
                $table = "serviceGalleries";
                $columnName = "serviceId";
                break;
            case 'event':
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
        $imageLinks = getData("SELECT imageLink FROM " . $table ." WHERE " . $columnName . " = :ID",array('ID'=>$assetId));
        foreach ($imageLinks as $singleImage) {
            unlink($_SERVER["DOCUMENT_ROOT"] . $singleImage['imageLink']); 
        }
    }
}
?>