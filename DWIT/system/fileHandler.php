<?php

class FileHandler
{
    private $fileType;
    private $fileName;

    public function getFileName($file, $folder, $fileType = 0)
    {
        $fileName = $file['name'];
        if (isset($fileName)) {
            $type = $fileName['type'];

            if ($typChecker($type, $fileType) == 1) {
                $size = $fileName['size'];
                if ($size < 2050) {
                    $source = $fileName['tmp_name'];
                    $destination = "upload/" . $folder . "/" . date("Ymdhis_") . $fileName;
                    move_uploaded_file($source, $destination);
                    return $destination;
                }
            }
        }
    }


    public function typChecker($type, $fileType)
    {
        $validType = array("JPG", "JPEG", "PNG", "TIF", "GIF");
        if ($fileType == 0) {
            if (in_array(strtoupper($type), $validTypes))
                return 1;
        } elseif ($fileType == 1) {
            if (strtoupper($type) == "PDF")
                return 1;
        }
        return 0;
    }

}

?>