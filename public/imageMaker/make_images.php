<?php

// NOTE: you cannot share a folder in a Shared Drive at this time (04/03/2020)

// if Drive URL is a folder, then process every image in the folder.
// e.g. architectural/richardMoore/current.  This will occur when you move current images to "Old" and replace with new ones.
// The user would likely use fileZilla to delete sommetblanc/images/richardMoore in its entirety.
// and would then want to reprocess the entrie richardMoore/current folder in one go, to copy to the web server.
// until sharing folders in Shared Drives is avilable, the user must make an entry into the spreadhseet for every image file.
// this is an issue when architectural drawings are changing, and you want to keep an updated copy of all architectural images on the website.


//*********************************** test POST data **************************************//

// uncomment the test POST data to run the file directly from localhost.
// can run this file from localhost/imageMakerPHP, or copy to a domain folder e.g. localhost/aspengroup/imageMaker, or live

//$_POST['webUrl'] = "https://arbordayblog.org/wp-content/uploads/2018/06/oak-tree-sunset-iStock-477164218-1080x608.jpg"; // jpg
//$_POST['webUrl'] = "https://upload.wikimedia.org/wikipedia/commons/f/f6/Bright_green_tree_-_Waikato.jpg";
//$_POST['webUrl'] = "https://static.dezeen.com/uploads/2017/08/bigwood-olson-kundig-windows-936.gif"; // gif

//$_POST['driveUrl'] = "https://drive.google.com/file/d/1ksRWxqeEZw9gZinv1aY2_njyX7iM56Ry/view?usp=sharing";
//$_POST['driveUrl'] = "1eXOFixhI9_MPyYum9c9e_UOJaORRthyN";
// $_POST['driveUrl'] = "1eq_33_PIWhwFTKQ5cn4PGPDDfJHddX-K";

//$_POST['serverUrl'] = "https://aspengroupusa.com/imageMaker/images/image1.png";

// $_POST['domainName'] = 'aspengroupusa.com';
// $_POST['initialPath'] = 'sommetblanc/salesgallery/images/construction'; // relative path from root
// $_POST['imageParentPath'] = 'test'; // path from initial path
// $_POST['imageFolderName'] = '';
// $_POST['fullSizeWidth'] = 1700;
// $_POST['fullSizeHeight'] = 900;
// $_POST['thumbnailWidth'] = 300;
// $_POST['thumbnailHeight'] = 225;
// $_POST['comments'] = "These are comments";
// $_POST['imageFolderNameType'] = "common";
// $_POST['commonFolderName'] = 'image';
// $_POST['deleteFilesOnSuccess'] = 'on';

//****************************************************************************************//

function isLocalHost($whitelist = ['127.0.0.1', '::1']) {
    return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
}

// if ($_SERVER['SERVER_ADDR'] == "::1") {
if (isLocalHost()) {
    $documentRoot = $_SERVER['DOCUMENT_ROOT'] . "/aspengroup"; 
    define("DOCUMENT_ROOT",$documentRoot); // local file system root: /Users/lpadan/Software/aspengroup
} else {
    $documentRoot = $_SERVER['DOCUMENT_ROOT'];
    define("DOCUMENT_ROOT",$documentRoot); // webserver file system root: public_html
}

$data = [];
$data['success'] = false;
$webUrl = $_POST['webUrl'] ?? '';
$driveUrl = $_POST['driveUrl'] ?? '';
$serverUrl = $_POST['serverUrl'] ?? '';
$domainName = $_POST['domainName'] ?? '';
$initialPath = $_POST['initialPath'] ?? '';
$imageParentPath = $_POST['imageParentPath'] ?? '';
$imageParentPath = stringToCamelCase($imageParentPath);
$imageFolderName = $_POST['imageFolderName'] ?? '';
$imageFolderName = stringToCamelCase($imageFolderName);
$fullSizeWidth = $_POST['fullSizeWidth'];
$fullSizeHeight = $_POST['fullSizeHeight'];
$thumbnailWidth = $_POST['thumbnailWidth'];
$thumbnailHeight  = $_POST['thumbnailHeight'];
$comments = $_POST['comments'] ?? '';
$imageFolderNameType = $_POST['imageFolderNameType'] ?? '';
$commonFolderName = $_POST['commonFolderName'] ?? '';
$commonFolderName = stringToCamelCase($commonFolderName);
$deleteFilesOnSuccess = $_POST['deleteFilesOnSuccess'] ?? '';
$email = $_POST['email'];

$driveUrl = trim($driveUrl);
$webUrl = trim($webUrl);
$serverUrl = trim($serverUrl);
$initialPath = "../" . trim($initialPath);


if (!$webUrl && !$driveUrl && !$serverUrl) {
    $data['success'] = false;
    $data['errorMessage'] = "No image URL";
    echo json_encode($data);
    exit;
}

if ($imageFolderNameType == 'unique' && !$imageFolderName) {
    $data['success'] = false;
    $data['errorMessage'] = "Image folder naming conflict";
    echo json_encode($data);
    exit;
}

if (($imageFolderNameType == 'parent' || $imageFolderNameType == 'common') && $imageFolderName) {
    $data['success'] = false;
    $data['errorMessage'] = "Image folder naming conflict";
    echo json_encode($data);
    exit;
}

if ($driveUrl) { // or driveId
    
    require_once ('../vendor/autoload.php');
    putenv('GOOGLE_APPLICATION_CREDENTIALS=../aspen-group-google-client.json');

    preg_match('/[-\w]{25,}/',$driveUrl,$matches); // 25 or more word characters and the '-'
    if ($matches) {
        $driveFileId = $matches[0];
    } else {
        $data['success'] = false;
        $data['errorMessage'] = "Invalid Drive ID";
        echo json_encode($data);
        exit;
    }

    $client = new Google_Client();
    $client->useApplicationDefaultCredentials();
    //$client->setSubject('lpadan@aspengroupusa.com');
    $client->setSubject($email);
    $client->addScope(Google_Service_Drive::DRIVE);
    $drive_service = new Google_Service_Drive($client);

    try {
        $file = $drive_service->files->get($driveFileId, array('supportsTeamDrives' => true)); 
        // Share Drive (fka Team Drives) supports "file" sharing, but not "folder" sharing as of 4/15/2020).  
        // Also 'supportsTeamDrives' should not be required after June 2020.
        // not sure a file or folder needs to be shared. All files and folders should be accessible by the Aspen Group service account.
    } catch (Google_Service_Exception $e) {
        // NOTE:  Google returns exceptions as a json string
        $message = json_decode($e->getMessage()); // returns an object (include a second parameter: "true", to return an associative array)
        $data['success'] = false;
        $data['errorMessage'] = $message->error->errors[0]->message; // object notation (vs associative array notation)
        echo json_encode($data);
        exit;
    }

    $fileName = $file->getName();
    $ext = pathinfo($fileName,PATHINFO_EXTENSION);
    $ext = strtolower($ext);
    if ($ext === 'jpeg') $ext = 'jpg';
    $fileNameNoExt = pathinfo($fileName,PATHINFO_FILENAME);

    if ($ext != 'jpg' && $ext != 'gif' && $ext != 'png') {
        $data['success'] = false;
        $data['errorMessage'] = "File type must be jpg, png or gif";
        echo json_encode($data);
        exit;
    }
    $content = $drive_service->files->get($driveFileId, array("alt" => "media"));
    $outHandle = $content->getBody();
}

if ($webUrl) {
    $pathParts = pathinfo($webUrl);
    $ext = strtolower($pathParts['extension']);
    //$ext = strtolower(substr($webUrl, -3));
    if ($ext === 'jpeg') $ext = 'jpg';
    if ($ext != 'jpg' && $ext != 'gif' && $ext != 'png') {
        $data['success'] = false;
        $data['errorMessage'] = "File type must be jpg, png or gif";
        echo json_encode($data);
        exit;
    }
}

if ($serverUrl) {
    
    if (!strpos($serverUrl,$domainName)) {
        $data['success'] = false;
        $data['errorMessage'] = "Server URL and Domain Name do not match";
        echo json_encode($data);
        exit;
    }
    $stringToRemove = 'https://' . $domainName . "/";
    $serverFilePath = DOCUMENT_ROOT . "/" . str_replace($stringToRemove,'',$serverUrl); // imageMaker/images/image1.png  path from the root
    $pathParts = pathinfo($serverUrl);
    $ext = strtolower($pathParts['extension']);
    
    if ($ext === 'jpeg') $ext = 'jpg';
    if ($ext != 'jpg' && $ext != 'gif' && $ext != 'png') {
        $data['success'] = false;
        $data['errorMessage'] = "File type must be jpg, png or gif";
        echo json_encode($data);
        exit;
    }
}

if ($initialPath) {
   
    if (!is_dir($initialPath)) {
        $data['success'] = false;
        $data['fatalError'] = true;
        $data['fatalErrorMessage'] = "Intial Destination Path is not valid";
        echo json_encode($data);
        exit;
    }
}

// remove trailing "/" if present in initialPath
if ($initialPath && substr($initialPath, -1) == "/") {

    $initialPath = substr($initialPath, 0, -1);
}

// remove leading "/" if present in imageParentPath
if (substr($imageParentPath,0,1) == "/") {

    $imageParentPath = substr($imageParentPath,1);
}

// remove trailing "/" if present in imageParentPath
if ($imageParentPath && substr($imageParentPath, -1) == "/") {

    $imageParentPath = substr($imageParentPath, 0, -1);
}

// combine initial and parent paths
if ($initialPath) {

    $imageFolderPath = $initialPath . "/" . $imageParentPath; // sommetblanc/images/tomKundig
} else {

    $imageFolderPath = "../" . $imageParentPath;
}

$imageSource = new Imagick();

if ($webUrl) {
    try {
        $imageSource->readImage($webUrl);
    }
    catch (Exception $e) {
        $data['success'] = false;
        $data['errorMessage'] = $e->getMessage();
        echo json_encode($data);
        exit;
    }
} elseif ($driveUrl) {
    $imageSource->readImageBlob($outHandle);
} elseif ($serverFilePath) {
    $imageSource->readImage($serverFilePath);
}

image_fix_orientation($imageSource);

$imageHeight = $imageSource->getImageHeight();
$imageWidth = $imageSource->getImageWidth();

if ($imageWidth < $thumbnailWidth || $imageHeight < $thumbnailHeight) {
    $data['success'] = false;
    $data['errorMessage'] = "Image too small to create thumbnail";
    echo json_encode($data);
    exit;
}

if (!file_exists($imageFolderPath)) {

    if (!@mkdir($imageFolderPath,0777,true)) { // "@"" supresses warnings.  mkdir does not throw an exception, only echos warnings
        $data['success'] = false;
        $data['errorMessage'] = "Combined Initial and Image Folder Parent Paths are not valid";
        echo json_encode($data);
        exit;
    }
} else { // image folder parent directory exists.

    $imageFolders = glob($imageFolderPath . "/*",GLOB_ONLYDIR);

    if ($imageFolders) {
        $existingImageFolderName = basename($imageFolders[0]); // get the first existing image folder

        if (strpos($existingImageFolderName,"_") != false) { // maybe not test for "_" but test if last character is a digit
            if ($imageFolderNameType == 'unique') {
                $data['success'] = false;
                $data['errorMessage'] = "Specified image folder name not allowed. Use Parent or Common image folder name";
                echo json_encode($data);
                exit;
            }
        }
     }
}

if ($imageFolderNameType == 'unique') {
    $finalPath = $imageFolderPath . "/" . $imageFolderName;
    if (!file_exists($finalPath)) {
        if (!@mkdir($finalPath,0777,true)) {
            $data['success'] = false;
            $data['errorMessage'] = 'The directory name "' . $finalPath . '" already exists';
            echo json_encode($data);
            exit;
        }
    }

} elseif ($imageFolderNameType == 'parent' || $imageFolderNameType == 'common') {

    $dirs = glob($imageFolderPath . "/*",GLOB_ONLYDIR); // get array of subdirectories with full path
    if ($imageFolderNameType == 'parent') $lastFolder = basename($imageFolderPath);
    if ($imageFolderNameType == 'common') $lastFolder = $commonFolderName;

    $maxInt = 1;
    foreach ($dirs as $dir) {
        $integer = (int)substr(strrchr($dir, "_"), 1); // return evverything after "_"
        if ($integer >= $maxInt) $maxInt = ($integer + 1);
    }
    $finalPath = $imageFolderPath . "/" . $lastFolder . "_" . $maxInt;
    mkdir($finalPath); // sommetblanc/images/tomKundig/tomKundig_1
}

elseif($imageFolderNameType = 'fileName' && $driveUrl) {

    $fileNameNoExt = str_replace("-","_",$fileNameNoExt);
    $finalPath = $imageFolderPath . "/" . $fileNameNoExt;
    if (!file_exists($finalPath)) {
        if (!@mkdir($finalPath,0777,true)) {
            $data['success'] = false;
            $data['errorMessage'] = 'The directory name "' . $finalPath . '" already exists';
            echo json_encode($data);
            exit;
        }
    }
}

// create fullsize image for jpg or png
if ($ext === 'jpg' || $ext === 'png') {
    $fullSizeFilePath = $finalPath . '/fullsize.' . $ext;
    $image = new Imagick();
    $image->addImage($imageSource);
    if ($imageWidth >= $imageHeight) {
        if ($imageWidth > $fullSizeWidth) {
            $image->scaleImage($fullSizeWidth,0);
        }
    } elseif ($imageWidth < $imageHeight) {
        if ($imageHeight > $fullSizeHeight) {
            $image->scaleImage(0,$fullSizeHeight);
        }
    }
    $image->writeImage($fullSizeFilePath);
    $image->destroy();
}

// create thumbnail image for jpg or png
if ($ext === 'jpg' || $ext === 'png') {
    $thumbnailFilePath = $finalPath . '/thumbnail.' . $ext;
    $image = new Imagick();
    $image->addImage($imageSource);
    $image->cropThumbnailImage($thumbnailWidth,$thumbnailHeight);
    $image->writeImage($thumbnailFilePath);
    $image->destroy();
}

// create fullsize image for GIF
if ($ext === 'gif') {
    $fullSizeFilePath = $finalPath . '/fullsize.gif';
    $image = new Imagick();
    $image->addImage($imageSource);
    $image = $image->coalesceImages();
    $imageWidth = $image->getImageWidth();
    $imageHeight = $image->getImageHeight();

    if ($imageWidth >= $imageHeight) {
        if ($imageWidth >= $fullSizeWidth) {
            foreach ($image as $frame) {
              $frame->cropImage($fullSizeWidth, 0, 0, 0);
              $frame->setImagePage($fullSizeWidth, 0, 0, 0);
            }
        }
    } elseif ($imageWidth < $imageHeight) {
        if ($imageHeight > $fullSizeHeight) {
            foreach ($image as $frame) {
              $frame->cropImage(0, $fullSizeHeight,0, 0);
              $frame->setImagePage(0, $fullSizeHeight,0, 0);
            }
        }
    }

    $image = $image->deconstructImages();
    $image->writeImages($fullSizeFilePath, true);
    $image->destroy();
}

// create thumbnail image for GIF - couldn't figure a better way to do this. Bit of a hack.
if ($ext === 'gif') {
    $thumbnailFilePath = $finalPath . '/thumbnail.gif';
    $image = new Imagick();
    $image->addImage($imageSource);
    $image = $image->coalesceImages();
    $imageWidth = $image->getImageWidth();
    $imageHeight = $image->getImageHeight();

    if ($imageWidth >= $imageHeight) {
        if ($imageWidth >= $thumbnailWidth) {
            $newImage = new Imagick();
            foreach ($image as $frame) {
                $frame->cropThumbnailImage($thumbnailWidth,$thumbnailHeight);
                $newImage->addImage($frame->getImage());
                break;
            }
        }
    } elseif ($imageWidth < $imageHeight) {
        if ($imageHeight > $thumbnailHeight) {
            $newImage = new Imagick();
            foreach ($image as $frame) {
                $frame->cropThumbnailImage($thumbnailWidth,$thumbnailHeight);
                $newImage->addImage($frame->getImage());
                break;
            }
            $newImage->addImage($frame->getImage());
        }
    }
    $newImage->writeImages($thumbnailFilePath, true);
    $image->destroy();
}

if ($comments) {
    $comments = "<p>" . $comments . "</p>";
    $comments = nl2br($comments);
    $filePath = $finalPath . '/comments.html';
    $fp = fopen($filePath, 'w');
    fwrite($fp, $comments);
    fclose($fp);
}

if ($serverUrl && $deleteFilesOnSuccess) {
    // delete source file from server
    unlink($serverFilePath);
}

if ($driveUrl && $deleteFilesOnSuccess) {
    // delete source file from Drive
    $drive_service->files->delete($driveFileId);
}

$data['success'] = true;
echo json_encode($data);


function stringToCamelCase($str, array $noStrip = ['\/']) { // do not remove "/"

    // non-alpha and non-numeric characters become spaces
    $str = preg_replace('/[^a-z0-9' . implode("", $noStrip) . ']+/i', ' ', $str);
    $str = trim($str);
    // uppercase the first character of each word
    $str = ucwords($str);
    $str = str_replace(" ", "", $str);
    $str = lcfirst($str);

    return $str;
}

function image_fix_orientation($image) {

    if (method_exists($image, 'getImageProperty')) {
        $orientation = $image->getImageProperty('exif:Orientation');
    } else {
        $exif = exif_read_data($image);
        $orientation = isset($exif['Orientation']) ? $exif['Orientation'] : null;
    }

    if (!empty($orientation)) {
        switch ($orientation) {
            case 3:
                $image->rotateImage('#000000',180);
                break;

            case 6:
                $image->rotateImage('#000000', 90);
                break;

            case 8:
                $image->rotateImage('#000000', -90);
                break;
        }
    }
    $image->stripImage();
}

?>

