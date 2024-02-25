<?php

session_start();
?>
<html>

<?php
session_destroy();
 header("location:../index.php");
?>
</html>