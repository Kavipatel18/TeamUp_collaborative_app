<?php
session_start();
include 'connect.php';

$pname = $_GET['project'];
$sql = "SELECT * FROM projects WHERE pname = '$pname' ";

$result = mysqli_query($connect, $sql);
if (mysqli_num_rows($result) <= 0) {
    echo "<h3>Something went wrong";
} else {
    $row = mysqli_fetch_array($result);
    $_SESSION['pname'] = $row['pname'];
    $_SESSION['u_id'] = $row['u_id'];
    $_SESSION['id'] = $row['id'];
    $_SESSION['leader']=0;
    
    
    // echo $_SESSION['pname'];
    // echo $_SESSION['u_id'];
    // echo $_SESSION['id'];
    header("location:../project.php");
    exit;
}

?>

