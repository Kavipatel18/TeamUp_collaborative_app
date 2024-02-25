<html>

<body>
    <?php
    session_start();

    include 'connect.php';


    $email = $_POST['email'];
    $name = $_POST['name'];
    $password2 = $_POST['repassword'];
    $password = $_POST['password'];

    // $sql = "Select * from data where email='$email'";
    // $result = mysqli_query($connect, $sql);
    //         $con=mysqli_num_rows($result);
    // if($con <= 0)
    // {
    //     echo "<h3>Email is already Register</h3>";
    // }
    // else{
    if ($password == $password2)
        $sql_userdatabase = "Insert into data(email, password ) values ('$email' , '$password')";

    else
        echo "<h3>Registration Unsuccessful: </h3>";

    try {
        if (mysqli_query($connect, $sql_userdatabase) == true) {
            echo "<h3>You have been successfully registered</h3><br><br>";
            echo '<center><table><tr><td><a href="../index.php"><button style="background-color: #354f52; border-color: #354f52; color: white"><span>Sign in!</span></button></a></td></tr></table></center>';
        } else {

            throw new Exception("Email already in use. Please register with a different email.");
        }
    } catch (Exception $e) {

        echo "<h3>Registration Unsuccessful: " . $e->getMessage() . "</h3><br><br>";
        echo '<center><table><tr><td><a href="../index.php"><button style="background-color: #354f52; border-color: #354f52; color: white"><span>Register Again</span></button></a></td></tr></table></center>';
    }

    ?>
</body>

</html>