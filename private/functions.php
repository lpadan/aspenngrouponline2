<?php

function isLocalHost($whitelist = ['127.0.0.1', '::1']) {
    
    return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
}

function changeUserPassword($userId, $password) {
    $user = User::find_by_id($userId);
    $user->password = $password;
    $user->set_hashed_password();
    $user->update();
}

function checkEmailKey($recovery_key,$user_id,$db) {

    // $cur_date = date("Y-m-d H:i:s");
    // $query = "SELECT user_id FROM recovery_emails WHERE user_id = $user_id AND recovery_key = '{$recovery_key}' AND exp_date >= '{$cur_date}'";

    $query = "SELECT user_id FROM recovery_emails WHERE user_id = $user_id AND recovery_key = '{$recovery_key}' AND exp_date >= CURDATE()"; // not tested yet

    $result = mysqli_query($db,$query);
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0 && $user_id != '') {
        return array('status'=>true,'user_id'=>$user_id);
    }
    return false;
}

function checkUNEmail($user_name,$email) {

    $error = array('status'=>false,'user_id'=>0);
    if (isset($email) && trim($email) != '') {

        $sql = "SELECT * FROM users WHERE email = '{$email}' LIMIT 1";
        $users = User::find_by_sql($sql);
        if ($users) {
            $user = $users[0];
        } else {
            return $error;
        }

        $user_id = $user->id;
        return array('status'=>true,'user_id'=>$user_id);

    } elseif (isset($user_name) && trim($user_name) != '') {

        $sql = "SELECT * FROM users WHERE username = '{$user_name}' LIMIT 1";
        $users = User::find_by_sql($sql);
        if ($users) {
            $user = $users[0];
        } else {
            return $error;
        }

        $user_id = $user->id;
        return array('status'=>true,'user_id'=>$user_id);

    } else {
        //nothing was entered;
        return $error;
    }
}

function convertFromCamelCase($camelCaseString) {
    // convert camelCaseString to Camel Case String
    $re = '/(?<=[a-z])(?=[A-Z])/x';
    $a = preg_split($re, $camelCaseString);
    $name = join($a, " " );
    return ucfirst($name);
}

function convertName($name) { // convert "table_name" to Table Name
    $array = explode('_',$name);
    $name = '';
    if (count($array) == 1) {
        $name = ucfirst($array[0]);
    }
    else {
        $name = ucfirst($array[0]);
        for ($i = 1; $i < count($array); $i++) {
            $name .= " " . ucfirst($array[$i]);
        }
    }
    return $name;
}

function error_404() {
    header($_SERVER['SERVER_PROTOCOL'] . " 404 Not Found");
    exit();
}

function error_500() {
    header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
    exit();
}

function h($string="") {

    return htlspecialchars($string);
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

function is_ajax_request() {
    // this only works with jquery ajax requests
    // jquery adds the $_SERVER['HTTP_X_REQUESTED_WITH'] = 'xmlhttprequest' header
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        return true;
    } else {
        return false;
    }
}

function is_post_request() {

    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function is_get_request() {

    return $_SERVER['REQUEST_METHOD'] === 'GET';
}

function objectNameComparator($obj1, $obj2) {
    // sort an array of objects based upon the object->name value
    // this funciton searchs for the value after the "_" and converts to an integer
    // then does the compare

    $obj1Name = $obj1->name;
    $obj2Name = $obj2->name;

    $index = strpos($obj1Name,"_");
    if ($index == -1) {
        $obj1Value = 1;
    } else {
        // get all values after the "_";
        $obj1Value = (int)substr($obj1Name,$index + 1);
    }

    $index = strpos($obj2Name,"_");
    if ($index == -1) {
        $obj2Value = 1;
    } else {
        // get all values after the "_";
        $obj2Value = (int)substr($obj2Name,$index + 1);
    }

    return $obj1Value > $obj2Value;
}

function toCamelCase($str, array $noStrip = []) {
    // non-alpha and non-numeric characters become spaces
    $str = preg_replace('/[^a-z0-9' . implode("", $noStrip) . ']+/i', ' ', $str);
    $str = trim($str);
    $str = ucwords($str);
    $str = str_replace(" ", "", $str);
    $str = lcfirst($str);
    return $str;
}

function raw_u($string="") {

    return rawurlencode($string);
}

function redirect_to($location) {
    header("location: " . $location);
    exit;
}

function u($string="") {

    return urlencode($string);
}

function updateUserPassword($userId,$password,$key,$db) {

    if (!isset($_SESSION['new_user'])) {
        if (checkEmailKey($key,$userId,$db) === false) return false;
    }

    $user = User::find_by_id($userId);
    $user->password = $password;
    $user->set_hashed_password(); // hased_password is protected.  use setter.
    $user->update();

    if (!isset($_SESSION['new_user'])) {
        $query = "DELETE FROM recovery_emails WHERE recovery_key = '{$key}'";
        mysqli_query($db,$query);
    }
}

function url_for($script_path) {
	// add the leading '/' if not present
	if($script_path[0] != '/') {
		$script_path = "/" . $script_path;
	}
	return WWW_ROOT . $script_path;
}

function validateSubmittalId($submittalId) {
    $submittalId = strtolower($submittalId);
    $match = preg_match('/[a-z]{2}[0-9]{4}p?[c,s,v][0-9]+/',$submittalId);
    if (!$match) return false;
    if ($match) return true;
}


// function check_logged_in() {
//     // NOT USED
//     $data = [];
//     if (!isset($_SESSION['logged_in'])) {
//         $data['logged_out'] = true;
//         $data['error_message'] = "You've been logged out after a period of inactivity.\nPlease login again.";
//         echo json_encode($data);
//         exit;
//     }
// }

// function verifyAjaxAccess() {
//     *
//         * NOT USED
//         * call this function when the ajax file is expected to return HTML, not a data object
//         * if the calling file expects data, the ajax file can just return an error in the data object
//         * when the calling file expects HTML to return, you must add the following HTML code and return to the
//         * AJAX success method.
//         * call this at the top of files loaded via AJAX when user may be logged out by the server after a period of inactivity
//         * or may have entered the URL directly even if he is logged in.


//     if (!isset($_SESSION['logged_in'])) {
//        $error_message = "You have been logged out after a period of inactivity.\nPlease login again.";
//        echo "<input id='login_error' value='$error_message' style='display:none'>";
//        exit();
//     }
// }

?>