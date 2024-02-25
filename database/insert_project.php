<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['project'])) {
   
        $projectName = $_POST['project'];
  
        $randomId = substr(uniqid(), -5);
        $p_id=$randomId;
        $_SESSION['p_id'] = $p_id;
        $u_id = $_SESSION['u_id'];
        

    $sql = "INSERT INTO projects VALUES ('$p_id', '$u_id', '$projectName')";


    if (mysqli_query($connect, $sql)) {
        echo 'Inserted successfully!';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    }
}
}
?>
