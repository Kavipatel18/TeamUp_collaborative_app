<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['project'])) {
        $projectName = $_POST['project'];

        $sql1 = "select id FROM projects WHERE pname=?";
        $stmt1 = $connect->prepare($sql1);
        $stmt1->bind_param("s", $projectName);
        $stmt1->execute();
        $stmt1->bind_result($p_id);
        

        if ($stmt1->fetch()) {
            $stmt1->close();
            $sql = "DELETE FROM member WHERE p_id=?";
            $stmt = mysqli_prepare($connect, $sql);
            mysqli_stmt_bind_param($stmt, "s", $p_id);
            mysqli_stmt_execute($stmt);
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo 'Member Deleted Successfully';
            } else {
                echo "Error!!";
            }
        } else {
            echo $_POST['project'];
            echo "Project not exist!!";
        }

        mysqli_stmt_close($stmt);
    }
}
?>

