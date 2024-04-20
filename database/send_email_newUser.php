<?php
session_start();
$user = $_POST['memberName'];
$pname=$_SESSION['pname'] ;
$uid=$_SESSION['u_id'];
$id=$_SESSION['id'] ;
$email=$_SESSION['email'];

$to_email = $user;
$subject = "TeamUp: You are a Project Member!";
$body = "Hi, It's TeamUp Developers.

You are selected as team member.🎉 

Project Details: 📝

Project: $pname And Project-ID: $id 
Leader: $email And Leader-ID: $id

Please Sign-up using this link 🔗: http://localhost:8080/TeamUp_collaborative_app/index.php
Thank You";
$headers = "From: example@gmail.com";


if (mail($to_email, $subject, $body, $headers)) {
    echo 'alert("Email successfully sent")';
} else {
    echo 'alert(Email sending failed")';
}
?>

