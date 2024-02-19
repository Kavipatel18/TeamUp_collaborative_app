<?php

$hostname  = 'localhost';
$username = 'root';
$password='';
$dbname = 'User';
$connect =  mysqli_connect($hostname , $username , $password ,$dbname) or die("Error Connecting");



$email = $_POST['email'];
$password = $_POST['password'];
$sql = "SELECT * FROM data WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($connect, $sql);

if (mysqli_num_rows($result) <= 0) {
    echo "<h3>Something went wrong, please login again</h3><br><br>";
    echo '<center><table><tr><td><a href="index.html"><button style="background-color: #354f52; border-color: #354f52; color: white"><span>Sign in Again</span></button></a></td></tr></table></center>';
} else {
 
    echo "Successfully Log-in Welcome to TeamUp";
}
?>

