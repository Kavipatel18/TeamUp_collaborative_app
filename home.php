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
    <title>Home</title>
    <link rel="website icon" type="png" href="pic/web-logo2.png">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/homestyle.css" />
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />


</head>

<body>
    <header class="header" style="padding-left: 0px; padding-right: 0px;">
        <nav class="nav">
            <a href="home.php" class="nav_logo"><img src="pic/logo2.png" alt="TeamUp's Logo" style="height: 50px; width: auto;" /></a>
            <div class="group">
                <svg class="icon" aria-hidden="true" viewBox="0 0 24 24" style="
                        width: 20px;">
                    <g>
                        <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                    </g>
                </svg>
                <span><input placeholder="Search" type="search" class="input"></span>
            </div>

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
        <section class="hero">
            <div id="create-project-form">
                <h2 style="color: black;">Create a New Project</h2>
                <input type="text" id="project-name" placeholder="Enter project name" required>
                <input id="create-button" type="submit">Create</input>
            </div>
            <div id="projects-container" style="color: black;" >
            <input style="height:25px;width:600px;"type="text" id="remove" class="project-name" value="" placeholder="Project Not Created Yet!!">
        </div>
            <br/><br/><br/><br/><br/><br/>
            <footer class="footer">
                <div class="container">
                    <p>&copy; 2024 TeamUp. All rights reserved.</p>
                </div>
            </footer>
        </section>
        <script src="js/homejs.js"></script>
</body>

</html>