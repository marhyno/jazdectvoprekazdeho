<?php
class saveFiles
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
            $uploadfile = $uploaddir . time() . '.' . $ext;
            move_uploaded_file($inputFiles['tmp_name'][$i], $uploadfile);
            chmod($uploadfile, 0755);
            array_push($returnImagePaths, $path . time() . '.' . $ext);
        }

        return $returnImagePaths;
    }
}
?>