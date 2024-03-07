<?php
session_start();
include 'connect.php';

$email=$_SESSION['email'];

$password2 = $_POST['repassword'];
$password = $_POST['password'];

if ($password == $password2) {
    $sql_userdatabase = "UPDATE data SET password='$password' WHERE email='$email'";
    $result = mysqli_query($connect, $sql_userdatabase);

    if ($result) {
        echo 'You have successfully changed your password';
    } else {
        echo 'Error updating password: ' . mysqli_error($connect);
    }
} else {
    echo 'Enter the same password';
}
?>
