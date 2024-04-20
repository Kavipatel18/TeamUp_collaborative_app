<?php
session_start();
include 'connect.php';

$email = $_POST['email'];
$password = $_POST['password'];
$sql = "SELECT * FROM data WHERE email = '$email' AND password = '$password'";

$result = mysqli_query($connect, $sql);
if (mysqli_num_rows($result) <= 0) {
    echo "<script>alert('Something went wrong, please login again');</script>";
    echo'<script>window.location.href="../index.php";</script>';
} else {
    $row = mysqli_fetch_array($result);
    $_SESSION['name'] = $row['name'];
    $_SESSION['u_id'] = $row['id'];
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    $_SESSION['log'] = '1';

    echo'<script>window.location.href="../home.php";</script>';
    exit;
}

?>
