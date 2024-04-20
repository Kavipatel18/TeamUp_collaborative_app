<?php
session_start();
include 'connect.php';

// Check if the request is coming from a POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['email'];
    $password = $_POST['currentpassword'];

    $sql = "SELECT * FROM data WHERE email = '$email'";
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        die("Database query failed: " . mysqli_error($connect));
    }

    $con = mysqli_num_rows($result);
    if ($con <= 0) {
        echo "<script>alert('Email is not registered yet!!')</script>";
        echo'<script>window.location.href="../index.php";</script>';
    } else {
        $row = mysqli_fetch_array($result);
        $password2 = $row['password'];

        if ($password != $password2) {
            echo "Enter correct password to change your password!!";
        } else {
            echo 'successfull';
        }
    }
}
?>
