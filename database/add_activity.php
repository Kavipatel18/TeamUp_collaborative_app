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
        $aname= $_POST['activityName'];
        $p_id = $_SESSION['id'];

        $sql = "SELECT * FROM data WHERE email = '$email'";

        $result = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result) <= 0) {
            echo "Something went wrong";
        } else {
            $sql1 = "SELECT * FROM member WHERE m_email = '$email' AND p_id = '$p_id' ";

            $res = mysqli_query($connect, $sql1);

            if (mysqli_num_rows($res) > 0) {

                $sql2 = "SELECT * FROM activity WHERE m_email = '$email' AND p_id = '$p_id' AND activity_name = '$aname' ";
                $res2 = mysqli_query($connect, $sql2);
                
                if(mysqli_num_rows($res2) >0)
                {
                    echo "Activity Already Added.";
                } else {
                    $randomId = substr(uniqid(), -5);
                    $activity_id = $randomId;

                    $query = "INSERT INTO activity (activity_id,activity_name,p_id,m_email) VALUES ('$activity_id','$aname','$p_id','$email')";

                    if (mysqli_query($connect, $query)) {
                        echo "Activity added successfully.";
                    } else {
                        echo "Failed to add activity.";
                    }
                }
            } else {
                echo "Not a Project-member";
            }
        }
    }
}