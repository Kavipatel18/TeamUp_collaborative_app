<?php
session_start();

include 'connect.php';

if ($_SESSION['log'] == '') {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $p_id = $_SESSION['id'];

        $sql = "SELECT * FROM data WHERE email = '$email'";

        $result = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result) <= 0) {
            echo "Something went wrong";
        } else {
            $sql1 = "SELECT * FROM member WHERE m_email = '$email' AND p_id = '$p_id' ";

            $res = mysqli_query($connect, $sql1);
            if (mysqli_num_rows($res) <= 0) {
                $query = "INSERT INTO member (p_id,m_email) VALUES ('$p_id','$email')";

                if (mysqli_query($connect, $query)) {
                    echo "Member added successfully.";
                } else {
                    echo "Failed to add member.";
                }
               
            } else {
                echo "Already member";
            }
        }
    }
}
