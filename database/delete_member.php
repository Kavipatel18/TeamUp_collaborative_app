<?php
session_start();
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['memail'])) {
    $memail = $_POST['memail'];

    $sql = "DELETE FROM member WHERE m_email=?";
    $sql1 = "DELETE FROM activity WHERE m_email=?";
    try {
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("s", $memail);
        $stmt->execute();

        if ($stmt->affected_rows === 1) {
            echo 'Member Deleted Successfully';
        } else {
            echo "Error: ". $memail. " not found!";
        }

    } catch (Exception $e) {
        echo "Error: ". $e->getMessage();
    }

    $stmt->close();

    try {
        $stmt1 = $connect->prepare($sql1);
        $stmt1->bind_param("s", $memail);
        $stmt1->execute();

        $stmt1->affected_rows;
    } catch (Exception $e) {
        echo "Error: ". $e->getMessage();
    }

    $stmt1->close();
}