<?php

$userName = $_POST['userName'] ?? '';
$email = $_POST['email'] ?? '';
$data = [];

//require_once('../private/initializeBeforeLogin.php');
require_once('../private/initialize.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP; // not sure this is required
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

$db = db_connect();

$result = checkUNEmail($userName,$email);

if ($result['status'] == false ) {
    $data['success'] = false;
    $data['errorMessage'] = 'User Not Found';
    echo json_encode($data);
    exit;
} else {
    $data['success'] = true;
    $passwordMessage = sendPasswordEmail($result['user_id'],$db);
    echo json_encode($data);
    exit;
}

function isLocalHost($whitelist = ['127.0.0.1', '::1']) {
    return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
}

function sendPasswordEmail($user_id,$db) {

    $user = User::find_by_id($user_id);
    $user_id = $user->id;
    $email = $user->email;
    $first_name = $user->first_name;
    $user_name = $user->username;
    $password = $user->password;

    $exp_format = mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+3, date("Y"));
    $exp_date = date("Y-m-d H:i:s",$exp_format);
    $recovery_key = md5($user_id . '_' . $email . rand(0,10000) .$exp_date); // .$salt

    $query = "INSERT INTO recovery_emails (user_id, recovery_key, exp_date) VALUES ($user_id,'{$recovery_key}', '{$exp_date}')";
    $result = mysqli_query($db,$query);
    echo (mysqli_error($db));

    // $root = ($_SERVER['SERVER_ADDR'] == "::1") ? "http://localhost/aspengroup.online/":"https://aspengroup.online/";
    $root = (isLocalHost()) ? "http://localhost/aspengroup.online/":"https://aspengroup.online/";
    $password_link = $root . "manage_account.php?a=recover&email=" . $recovery_key . "&u=" . urlencode(base64_encode($user_id));

    $to = $email;
    $subject = "Password Recovery";
    $message  = "Dear $first_name,\r\n\r\n";
    $message .= "Please visit the following link to reset your password:\r\n\r\n";
    $message .= "$password_link\r\n\r\n";
    $message .= "The link will expire after 3 days for security reasons.\r\n\r\n";
    $message .= "If you did not request this password recovery email, no action is needed. Your password will not be reset as long as the link above is not visited.\r\n\r\n";
    $message .= "Thank you,\r\n\r\n";
    $message .= "-- Aspen Group";

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
}