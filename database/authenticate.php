<?php
session_start();
include 'connect.php';

$email = $_POST['email'];
$password = $_POST['password'];
$sql = "SELECT * FROM data WHERE email = '$email' AND password = '$password'";

$result = mysqli_query($connect, $sql);
if (mysqli_num_rows($result) <= 0) {
    echo "<h3>Something went wrong, please login again</h3><br><br>";
    echo '<center><table><tr><td><a href="../index.php"><button style="background-color: #354f52; border-color: #354f52; color: white"><span>Sign in Again</span></button></a></td></tr></table></center>';
} else {
    $row = mysqli_fetch_array($result);
    $_SESSION['name'] = $row['name'];
    $_SESSION['u_id'] = $row['id'];
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    $_SESSION['log'] = '1';

    header("location:../home.php");
    exit;
}

?>
