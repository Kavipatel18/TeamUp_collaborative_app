<?php
        include 'connect.php';
        $email = $_POST['email'];
        
        $sql = "SELECT * FROM data WHERE email = '$email'";
        $result = mysqli_query($connect, $sql);
        $con=mysqli_num_rows($result);
        if ($con <= 0) {
            echo "<h3>Email is not register yet!!</h3><br><br>";
            echo '<center><table><tr><td><a href="../index.php"><button style="background-color: #354f52; border-color: #354f52; color: white"><span>Register</span></button></a></td></tr></table></center>';
        } else 
        {
            //echo "Successfully Log-in Welcome to TeamUp";
        }
?>