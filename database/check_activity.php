<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['activityID'])) {
        $aid = $_POST['activityID'];

        $sqlq = "SELECT isDone FROM activity WHERE activity_id = ?";
        $stmt = $connect->prepare($sqlq);
        $stmt->bind_param("s", $aid);
        $stmt->execute();
        $stmt->bind_result($isdone);
        
        if($stmt->fetch()) {
            $stmt->close(); 
            if($isdone == 0)
            {
                $sql = "UPDATE activity SET isDone=1 WHERE activity_id = ?";
                $stmt = $connect->prepare($sql);
                $stmt->bind_param("s", $aid);
                $stmt->execute();
                echo 'Activity Done successfully.';
                $stmt->close();
            } else {
                $sql = "UPDATE activity SET isDone=0 WHERE activity_id = ?";
                $stmt = $connect->prepare($sql);
                $stmt->bind_param("s", $aid);
                $stmt->execute();
                echo 'Activity Done successfully.';
                $stmt->close();
            }
        } 
        else {
            echo 'Failed.';
        }
    } else {
        echo 'Failed.';
    }
}
?>
