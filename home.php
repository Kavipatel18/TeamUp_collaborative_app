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

    <script src="js/homejs.js"></script>

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
                <span><input placeholder="Search" id="searchInput" type="search" class="input"></span>
            </div>

            <div class="dropdown">
                <button id="dropdownButton" class="button">
                    <html><?php echo " " . $_SESSION['name'] . "" ?>

                    </html>
                </button>
                <div id="myDropdown" class="dropdown-content">
                    <a href="#" id="profile" class="nav_link">My Profile</a>
                    <!-- <a href="#" id="changepass" class="button nav_link" style="border-color: white;">Change Password</a> -->
                    <a href="database/logout.php" class="nav_link">Log Out</a>
                </div>
            </div>
        </nav>
    </header>

    <section class="home">
        <section class="hero" style="padding-bottom: 0px;">
            <div id="create-project-form">
                <h2 style="color: black;">Create a New Project</h2>
                <input type="text" id="project-name" placeholder="Enter project name" required>
                <input id="create-button" type="submit" value="Create"></input>
            </div>

            <?php
            include 'database/connect.php';

            $user_id = $_SESSION['u_id'];
            $sql11 = "SELECT * FROM projects WHERE u_id = $user_id";
            $result = mysqli_query($connect, $sql11);

            // Check if there are any projects
            if (mysqli_num_rows($result) > 0) {
                echo '<div id="projects-container" style="color: black;">';
                echo '<h3>My Projects:</h3>';
                while ($row = mysqli_fetch_assoc($result)) {

                    echo '<div id="proj1" class="project">';
                    echo '<input type="submit" style="border:none; font-size:18px;width: 95%;" class="project-name" value="Project: ' . $row['pname'] . '" /><span class="delete" id="delete">&times;</span>';
                    echo '</div>';
                }
                echo '</div>';
            } else {
                echo '<div id="projects-container" style="color: black;">';
                echo '<h3>My Projects:</h3>';
                echo '<div class="project"id="proj">';
                echo '<input type="submit" style="border:none; font-size:18px;width: 95%;"  class="project-name" value="Project Not Created Yet!!" />';
                echo '</div>';
                echo '</div>';
            }

            $email = $_SESSION['email'];

            $sql = "SELECT * FROM member WHERE m_email = ?";
            $stmt = mysqli_prepare($connect, $sql);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                echo '<div id="projects-container" style="color: black;">';
                echo '<h3>My Projects(as Member):</h3>';
                
                while ($row = mysqli_fetch_assoc($result)) {
                    $pro_id = $row['p_id'];

                    $sql1 = "SELECT * FROM projects WHERE id = ?";
                    $stmt1 = mysqli_prepare($connect, $sql1);
                    mysqli_stmt_bind_param($stmt1, "s", $pro_id);
                    mysqli_stmt_execute($stmt1);
                    $result1 = mysqli_stmt_get_result($stmt1);

                    while ($row1 = mysqli_fetch_assoc($result1)) {
                        echo '<div id="proj1" class="project">';
                        echo '<input type="submit" style="border:none; font-size:18px;width: 95%;" class="project-name member-project" value="Project: ' . $row1['pname'] . '" />';
                        echo '</div>';
                    }
                }
                echo '</div>';
            } else {
                echo '<div id="projects-container" style="color: black;">';
                echo '<h3>My Projects(as Member):</h3>';
                echo '<div class="project"id="proj">';
                echo '<input type="submit" style="border:none; font-size:18px;width: 95%;"  class="project-name" value="Project Not Created Yet!!" />';
                echo '</div>';
                echo '</div>';
            }

            mysqli_stmt_close($stmt);
            mysqli_stmt_close($stmt1);
            mysqli_close($connect);


            ?>

            <br /><br />
            <footer class="footer">
                <div class="container">
                    <p>&copy; 2024 TeamUp. All rights reserved.</p>
                </div>
            </footer>
        </section>
        <div class="form_container">
            <i class="uil uil-times form_close"></i>
            <div class="form profile_form">
                <h2>Your Profile</h2>

                <div class="input_box">
                    <h5 align="left">Name: </h5>
                    <input type="text" name="name" style="border-bottom: 1.5px solid #aaaaaa;" value="<?php echo "" . $_SESSION['name'] . "" ?>" readonly />
                    <i class="uil uil-text text"></i>
                </div>
                <div class="input_box">
                    <h5 align="left">Email: </h5>
                    <input type="email" name="email" value="<?php echo "" . $_SESSION['email'] . "" ?>" readonly />
                    <i class="uil uil-envelope-alt email"></i>
                </div>

                <div class="input_box">
                    <h5 align="left">Password: </h5>
                    <input type="password" name="password" value="Password: <?php echo "" . $_SESSION['password'] . ""; ?>" readonly />
                    <i class="uil uil-lock password"></i>
                </div>
                <h5 align="right"><a href="#" id="changepass"><br>Change Password?</a></h5>

            </div>
            <!-- change password -->
            <div class="form reset_form">
                <form action="database/update.php" method="post">
                    <h2>Change Password</h2>
                    <div class="input_box">
                        <input type="password" name="currentpassword" onchange="checkpassword()" id="currentpassword" placeholder="Current password" required />
                        <i class="uil uil-lock password" style="top: 50%;"></i>
                        <i class="uil uil-eye-slash pw_hide" style="top: 50%;"></i>
                    </div>
                    <div class="input_box">
                        <input type="password" name="password" id="password" placeholder="Create password" required />
                        <i class="uil uil-lock password" style="top: 50%;"></i>
                        <i class="uil uil-eye-slash pw_hide" style="top: 50%;"></i>
                    </div>
                    <div class="input_box">
                        <input type="password" name="repassword" id="repassword" placeholder="Confirm password" required />
                        <i class="uil uil-lock password" style="top: 50%;"></i>
                        <i class="uil uil-eye-slash pw_hide" style="top: 50%;"></i>
                    </div>

                    <button class="button" id="change">Change</button>
                </form>
            </div>

        </div>

    </section>

</body>

</html>