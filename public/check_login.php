<?php
require_once('../private/initializeBeforeLogin.php');

$_SESSION["user_id"] = null;
$_SESSION['login_expired'] = false;

$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;
$userName = $_POST['userName'] ?? null;

// TEMP CODE

$userName = strtolower($userName);
$password = strtolower($password);

if ($userName == 'guest' && $password == 'sommet') {
	
	$reservations[] = array(
		'owner' => 'Guest User',
		'priorityNum' => 1,
		'projectId' => 1,
		'projectName' => 'Sommet Blanc Reservations',
		'projectFolder' => 'sommetBlancReservations'
	);

	$_SESSION['roles'] = [2];
	$_SESSION['reservations'] = $reservations;
	$_SESSION['assigned_projects'] = [];
	$_SESSION['assigned_offerings'] = [];
	$_SESSION['logged_in'] = true;
	$_SESSION['user_id'] = 10;
	$_SESSION['full_name'] = 'Guest User';
	$_SESSION['first_name'] = 'Guest';
	$_SESSION['last_name'] = 'User';
	$_SESSION['user_email'] = 'guest@aspenGroupusa.com';
	$data['success'] = true;
	echo json_encode($data);
	exit;
}


if ($password && (!$email && !$userName)) {
	$_SESSION['logged_in'] = false;
	$data['success'] = false;
	echo json_encode($data);
	exit;
}

$data = [];

$db = db_connect();
$_SESSION['email'] = $email;

if ($email) {
	$safe_email = mysqli_real_escape_string($db,$email);
	$query = "SELECT * FROM users WHERE email = '{$safe_email}' LIMIT 1";
	$users = User::find_by_sql($query);
	if (!$users) {
		$_SESSION['logged_in'] = false;
		$data['success'] = false;
		$data['error_message'] = "Email not found";
		echo json_encode($data);
		exit;
	} 
} else if ($userName) {
	$query = "SELECT * FROM users WHERE user_name = '{$userName}' LIMIT 1";
	$users = User::find_by_sql($query);
	if (!$users) {
		$_SESSION['logged_in'] = false;
		$data['success'] = false;
		$data['error_message'] = "Email not found";
		echo json_encode($data);
		exit;
	} 
}

$user = $users[0];
$stored_password = $user->hashed_password;
$firstName = $user->first_name;
$lastName = $user->last_name;
$userId = $user->id;
$userEmail = $user->email;
$exp_date = $user->exp_date;

// create array of roles for the user
$query = "SELECT name FROM roles JOIN users_roles ON users_roles.role_id = roles.id WHERE user_id = $userId";
$roles_result = mysqli_query($db,$query);
$num_rows_roles = mysqli_num_rows($roles_result);
$roles = [];
if (isset($num_rows_roles) && $num_rows_roles) {
    while ($row = mysqli_fetch_assoc($roles_result)) {
        $roles[] = $row['name'];
    }
}

$today = strtotime('now');
$mysql_date = date("Y-m-d H:i:s", $today);
$exp_date = strtotime($exp_date);

if ($exp_date < $today) {	
	$_SESSION['login_expired'] = true;
} else {
	$_SESSION['login_expired'] = false;
}

if (!password_verify($password, $stored_password) || $_SESSION['login_expired']) {
	$data['success'] = false;
	if ($_SESSION['login_expired']) {
		$data['error_message'] = 'Your login has expired. Please contact Aspen Group';
	} else {
		$data['error_message'] = 'Invalid Password';
	}
	echo json_encode($data);
	exit;
}

// create array of project_ids user may view
$assigned_projects = [];
$query = "SELECT * FROM projects_users WHERE user_id = $userId";
$result = mysqli_query($db,$query);
$num_rows = mysqli_num_rows($result);
while ($row = mysqli_fetch_assoc($result)) {
	$project = Project::find_by_id($row['project_id']);
	$assigned_projects[] = array(
		'id' => $project->id,
		'name' => $project->name,
		'projectFolder' => $project->folder_name,
	);
}
usort($assigned_projects,'projectNameCompare');

// create array of offering_ids user may view
$assigned_offerings = [];
$query = "SELECT * FROM offerings_users WHERE user_id = $userId";
$result = mysqli_query($db,$query);
$num_rows = mysqli_num_rows($result);
while ($row = mysqli_fetch_assoc($result)) {
	$assigned_offerings[] = $row['offering_id'];
}

// create array of reservations with project names and project Ids
$reservationIds = [];
$query = "SELECT reservation_id,user_id FROM reservations_users WHERE user_id = $userId";
$result = mysqli_query($db,$query);
$num_rows = mysqli_num_rows($result);
while ($row = mysqli_fetch_assoc($result)) {
	$reservationIds[] = [
		'reservationId' => $row['reservation_id'],
		'userId' => $row['user_id']
	];
}
// loop through the reservation IDs and get the project names and ids
$reservations = [];
foreach ($reservationIds as $reservationId) {
	$reservation = Reservation::find_by_id($reservationId['reservationId']);
	$user = User::find_by_id($reservationId['userId']);
	$projectId = $reservation->project_id;
	$project = Project::find_by_id($projectId);
	$reservations[] = array(
		'owner' => $user->full_name(),
		'priorityNum' => $reservation->priority_num,
		'projectId' => $project->id,
		'projectName' => $project->name,
		'projectFolder' => $project->folder_name,
	);
}


if (in_array('admin',$roles)) $_SESSION['admin'] = true;
$_SESSION['roles'] = $roles;
$_SESSION['reservations'] = $reservations;
$_SESSION['assigned_projects'] = $assigned_projects;
$_SESSION['assigned_offerings'] = $assigned_offerings;
$_SESSION['logged_in'] = true;
$_SESSION['user_id'] = $userId;
$_SESSION['full_name'] = $user->full_name();
$_SESSION['first_name'] = $firstName;
$_SESSION['last_name'] = $lastName;
$_SESSION['user_email'] = $userEmail;
$data['success'] = true;

echo json_encode($data);

function projectNameCompare($array1,$array2) {
	$name1 = $array1['name'];
	$name2 = $array2['name'];
	if ($name1 != $name2) {
		return $name1 > $name2;
	} 
}
