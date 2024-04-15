<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['activityID'])) {
        $aid = $_POST['activityID'];

        $sql1 = "DELETE FROM activity WHERE activity_id=?";
        
        $stmt = mysqli_prepare($connect, $sql1);
    
        mysqli_stmt_bind_param($stmt, "s", $aid);
        
        mysqli_stmt_execute($stmt);
    
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo 'Successfully Deleted';
        } else {
            echo "Activity not exist or couldn't be deleted!";
        }

        mysqli_stmt_close($stmt);
    }
}
?>
