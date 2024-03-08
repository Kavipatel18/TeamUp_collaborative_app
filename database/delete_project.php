<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['project'])) {
        $projectName = $_POST['project'];

        $sql1 = "DELETE FROM projects WHERE pname=?";
        $stmt = mysqli_prepare($connect, $sql1);
        mysqli_stmt_bind_param($stmt, "s", $projectName);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo 'Successfully Deleted';
        } else {
            echo $_POST['project'];
            echo "Project not exist!!";
        }

        mysqli_stmt_close($stmt);
    }
}
?>

