<?php
session_start();
$otp = $_POST['otp'];
$email = $_POST['email'];
$_SESSION['email']=$email;

$to_email = $email;
$subject = "TeamUp: Forget Password OTP..";
$body = "Hi, It's TeamUp Developers. Your One Time Password is: $otp";
$headers = "From: example@gmail.com";


if (mail($to_email, $subject, $body, $headers)) {
    echo '<script>alert("Email successfully sent")';
} else {
    echo 'alert(Email sending failed")';
}
?>

