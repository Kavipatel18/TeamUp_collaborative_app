<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['project'])) {

        $projectName = $_POST['project'];
       
        $u_id = $_SESSION['u_id'];

        $sql1 = "select * from projects where pname='$projectName' and u_id='$u_id'";
        $result1 = mysqli_query($connect, $sql1);
        if (mysqli_num_rows($result1) <= 0) {
            $randomId = substr(uniqid(), -5);
            $p_id = $randomId;
            
            $sql = "INSERT INTO projects VALUES ('$p_id', '$u_id', '$projectName',1)";

            if (mysqli_query($connect, $sql)) {
                $_SESSION['p_id'] = $p_id;
                $_SESSION['pname'] = $projectName;
                echo 'Project Inserted successfully!';
                
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($connect);
            }
        } else {
            echo "Project name is already exists,please try another name!";
        }
    }
}
