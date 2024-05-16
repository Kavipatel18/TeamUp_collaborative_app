 <?php
    session_start();

    include 'connect.php';


    $email = $_POST['email'];
    $name = $_POST['name'];
    $password2 = $_POST['repassword'];
    $password = $_POST['password'];

    $sql = "Select * from data where email='$email'";
    $result = mysqli_query($connect, $sql);
    $con = mysqli_num_rows($result);

    if ($con > 0) {
        echo "<script>alert('Email is already Register');</script>";
        echo '<script>window.location.href="../index.php";</script>';
    } else {
        if ($password == $password2)
            $sql_userdatabase = "Insert into data(email, password,name) values ('$email' , '$password','$name')";

        else{
            echo "<script>alert('Password must be same,try again!')</script>";
            echo '<script>window.location.href="../index.php";</script>';
        }
           

        try {
            if (mysqli_query($connect, $sql_userdatabase) == true) {
                echo "<script>alert('You have been successfully registered')</script>";
                echo '<script>window.location.href="../index.php";</script>';
            } else {

                throw new Exception("Email already in use. Please register with a different email.");
            }
        } catch (Exception $e) {

            echo "<script>alert('Registration Unsuccessful: " . $e->getMessage() . "')</script>";
            echo '<script>window.location.href="../index.php";</script>';
        }
    }
    ?>