<?php

// require_once('../private/initializeBeforeLogin.php');
require_once('../private/initialize.php');
$db = db_connect();


$userId = 1;
$password = "guest";

// $userId = $_POST['userId'];
// $password = $_POST['password'];
// $key = $_POST['key'];
$data = [];
$data['success'] = false;

$user = User::find_by_id($userId);
$user->password = $password;
$user->set_hashed_password(); // hased_password is protected.  use setter.
$user->update();

// if (!isset($_SESSION['new_user'])) {
//     $query = "DELETE FROM recovery_emails WHERE recovery_key = '{$key}'";
//     mysqli_query($db,$query);
// }

$data['success'] = true;
echo json_encode($data);
