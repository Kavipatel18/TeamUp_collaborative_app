<?php
        include 'connect.php';
        $email = $_POST['email'];
        
        $sql = "SELECT * FROM data WHERE email = '$email'";
        $result = mysqli_query($connect, $sql);
        $con=mysqli_num_rows($result);
        if ($con <= 0) {
            header("location:../index.php");
        } else 
        {
            echo "User is Regestered";
        }
?>