<!--After Login-->
<?php
session_start();
include 'database/connect.php';

if ($_SESSION['log'] == '') {
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Index</title>
    <link rel="website icon" type="png" href="pic/web-logo2.png">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/homestyle.css" />

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />


</head>

<body>
    <header class="header" style="padding-left: 0px; padding-right: 0px;">
        <nav class="nav">
            <a href="home.php" class="nav_logo"><img src="pic/logo2.png" alt="TeamUp's Logo" style="height: 50px; width: auto;" /></a>

            <ul class="nav_items">
                <li class="nav_item">
                    <a href="#services" class="nav_link">DashBoard</a>
                    <a href="home.php" class="nav_link">Projects</a>
                    <a href="#about" class="nav_link">Activity Tracking</a>
                    <a href="#contact" class="nav_link">Chat</a>
                </li>
            </ul>

            <div class="dropdown">
                <button onmouseenter="myFunction()" class="button">
                    <html><?php echo " " . $_SESSION['name'] . "" ?>

                    </html>
                </button>
                <div id="myDropdown" class="dropdown-content">
                    <a href="#home" class="nav_link">Profile</a>
                    <a href="#" id="changepass" class="button nav_link" style="border-color: white;">Change Password</a>
                    <a href="database/logout.php" class="nav_link">Log Out</a>
                </div>
            </div>
        </nav>
    </header>
    <section class="home">
        <div class="form_container">
            <i class="uil uil-times form_close"></i>
            <!-- change password  -->

            <div class="form reset_form">
                <form action="#" method="post">
                    <h2>Change Password</h2>
                    <div class="input_box">
                        <input type="password" name="currentpassword" onchange="checkpassword()" id="currentpassword" placeholder="Current password" required />
                        <i class="uil uil-lock password"></i>
                        <i class="uil uil-eye-slash pw_hide"></i>
                    </div>
                    <div class="input_box">
                        <input type="password" name="password" id="password" placeholder="Create password" required />
                        <i class="uil uil-lock password"></i>
                        <i class="uil uil-eye-slash pw_hide"></i>
                    </div>
                    <div class="input_box">
                        <input type="password" name="repassword" id="repassword" placeholder="Confirm password" required />
                        <i class="uil uil-lock password"></i>
                        <i class="uil uil-eye-slash pw_hide"></i>
                    </div>

                    <button class="button" id="change">Change</button>
                </form>
            </div>
        </div>
        <!-- Home -->


     
    <script src="js/homejs.js"></script>
</body>

</html>
