<?php

$userId = $_GET['userId'];
$data = [];

require_once('../private/initialize.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP; // not sure this is required
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

$user = User::find_by_id($userId);
$userId = $user->id;
$email = $user->email;

$db = db_connect();

$expFormat = mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+3, date("Y"));
$expDate = date("Y-m-d H:i:s",$expFormat);
$recoveryKey = md5($userId . '_' . $email . rand(0,10000) . $expDate); // .$salt

$query = "INSERT INTO recovery_emails (user_id, recovery_key, exp_date) VALUES ($userId,'{$recoveryKey}', '{$expDate}')";
$result = mysqli_query($db,$query);
echo (mysqli_error($db));

function isLocalHost($whitelist = ['127.0.0.1', '::1']) {
    return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
}

// $root = ($_SERVER['SERVER_ADDR'] == "::1") ? "http://localhost/aspengroup.online/":"https://aspengroup.online/";
$root = (isLocalHost()) ? "http://localhost/aspengroup.online/":"https://aspengroup.online/";

$passwordLink = $root . "manage_account.php?a=new&email=" . $recoveryKey . "&u=" . urlencode(base64_encode($userId));

$query = "SELECT name FROM projects JOIN projects_users ON projects_users.project_id = projects.id WHERE user_id = $userId";
$result_projects = mysqli_query($db,$query);
$num_rows_projects = mysqli_num_rows($result_projects);

$query = "SELECT name FROM offerings JOIN offerings_users ON offerings_users.offering_id = offerings.id WHERE user_id = $userId";
$result_offerings = mysqli_query($db, $query);
$num_rows_offerings = mysqli_num_rows($result_offerings);

$to = $user->email;
$subject = "New User";
$message  = "Welcome $user->first_name,\r\n\r\n";
$message .= "You have been added as a new user to AspenGroup.online with permissions to view the following:\r\n\r\n";

if (isset($num_rows_projects) && $num_rows_projects) {
    $message .= "Projects:\r\n\r\n";
    while ($row = mysqli_fetch_assoc($result_projects)) {
        $project_name = $row['name'];
        $message .= " - " . $project_name . "\r\n\r\n";
    }
}

if (isset($num_rows_offerings) && $num_rows_offerings) {
    $message .= "Offerings:\r\n\r\n";
    while ($row = mysqli_fetch_assoc($result_offerings)) {
        $offering_name = $row['name'];
        $message .= " - " . $offering_name . "\r\n\r\n";
    }
}

$message .= "Please visit the following link to complete the setup of your account:\r\n\r\n";
$message .= "$passwordLink\r\n\r\n";
$message .= "The link will expire after 3 days for security reasons.\r\n\r\n";
$message .= "Thank you,\r\n\r\n";
$message .= "-- Aspen Group USA\r\n";

//echo "<div style='white-space:pre-wrap'>" . $message . "</div>";
//echo $message;

require 'vendor/autoload.php';
$mail = new PHPMailer(true);

$mail->Host = "smtp.gmail.com";
$mail->Port = 587;
$mail->IsSMTP();
//$mail->IsHTML(true);
$mail->SMTPAuth = true;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->AuthType = 'XOAUTH2';

$email = 'Webmaster@AspenGroupUSA.com';
$clientId = '861911049103-hkjpv3q2lg8o9bcqo9aumfuacehopu7d.apps.googleusercontent.com';
$clientSecret = 'sWd21nqx5JpjeQT4Qp-dbN3K';
$refreshToken = '1//057kJaiIGhVAeCgYIARAAGAUSNwF-L9Irb5f3kGlMovVUPeqwaB2zhZuO8-3Pa3k8t4UToUFbIpJvj0xNqBsuZxZJNWnhUjWul0I'; 

$provider = new Google(
    [
        'clientId' => $clientId,
        'clientSecret' => $clientSecret,
    ]
);

$mail->setOAuth(
    new OAuth(
        [
            'provider' => $provider,
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
            'refreshToken' => $refreshToken,
            'userName' => $email,
        ]
    )
);

$mail->setFrom($email, 'Aspen Group');
$mail->AddAddress($to);
$mail->Subject = $subject;
$mail->Body = $message;
if (isset($cc) && $cc) $mail->AddCC($cc);
if (isset($bcc) && $bcc) $mail->AddBcc($bcc);

try {
$mail->Send();
} catch (phpmailerException $e) {

echo $e->errorMessage(); //Pretty error messages from PHPMailer

} catch (Exception $e) {

echo $e->getMessage(); //Boring error messages from anything else!

}

