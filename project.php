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
    <link rel="stylesheet" href="css/projectstyle.css" />

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />

    <!-- <script src="js/homejs.js"></script> -->
    <script src="js/projectjs.js"></script>

</head>

<body>
    <header class="header" style="padding-left: 0px; padding-right: 0px;">
        <nav class="nav">
            <a href="project.php" class="nav_logo"><img src="pic/logo2.png" alt="TeamUp's Logo" style="height: 50px; width: auto;" /></a>

            <ul class="nav_items">
                <li class="nav_item">
                    <a href="#services" class="nav_link">DashBoard</a>
                    <a href="home.php" class="nav_link">My Projects</a>
                    <a href="#about" class="nav_link">Activity Tracking</a>
                    <a href="#contact" class="nav_link">Chat</a>
                </li>
            </ul>

            <div class="dropdown">
                <button id="dropdownButton" class="button">
                    <html><?php echo $_SESSION['pname'] . " ID: " . $_SESSION['id'] . "" ?>

                    </html>
                </button>
                <div id="myDropdown" class="dropdown-content">
                    <a href="profile.php" class="nav_link">My Profile</a>
                    <!-- <a href="temp1.php" class="nav_link">Project Details</a>
                    <a href="#" id="changepass" class="button nav_link" style="border-color: white;">Change Password</a> -->
                    <a href="database/logout.php" class="nav_link">Log Out</a>
                </div>
            </div>

        </nav>
    </header>
    <section class="home">
        <!-- Home -->
        <section class="hero" style="padding-bottom: 0px;">
            <div style="color: black;padding-top:50px">
                <table>
                    <tr>
                        <td style="text-align: left;"><strong>Project Details:</strong></td>
                        <td style="text-align: left;"><strong>Name:</strong> <?php echo $_SESSION['pname']; ?></td>

                    </tr>
                    <tr></tr>
                    <tr>
                        <td></td>
                        <td style="text-align: left;"><strong>ID:</strong> <?php echo $_SESSION['id']; ?></td>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td>
                            <h4>Members of Project:</h4>
                        </td>
                        <?php
                        include 'database/connect.php';

                        $p_id = $_SESSION['id'];

                        $sql = "SELECT m_email FROM member WHERE p_id = ?";

                        $stmt = $connect->prepare($sql);
                        $stmt->bind_param("s", $p_id);
                        $stmt->execute();
                        $stmt->bind_result($m_email);
                        $flag = false;

                        if ($stmt) {
                            while ($stmt->fetch()) {
                                $flag = true;
                                echo '<td>' . $m_email . '</td></tr>';
                                echo '<tr></tr><tr><td></td>';
                            }
                        }
                        if (!$flag) {
                            echo '<td>  No Project-Member Yet!!</td>';
                        }
                        ?>
                    </tr>
                </table>
            </div>
            <?php
            include 'database/connect.php';

            $email=$_SESSION['email'];
            $sqlq = "SELECT id FROM data WHERE email = ?";

            $stmt = $connect->prepare($sqlq);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($u_id);
            
            if($stmt->fetch()) {
                $stmt->close(); 
            $_SESSION['u_id']=$u_id;
            $p_id = $_SESSION['id'];

            $sql = "SELECT IsLeader FROM projects WHERE id = ? AND u_id = ?";
          
            $stmt = mysqli_prepare($connect, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $p_id, $u_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $isLeader);
            mysqli_stmt_fetch($stmt);

            if ($isLeader == 1) {

                echo '<div id="create-project-form">';
                echo '<h2 style="color: black;">Add New Member</h2>';
                echo '<input type="text" id="member-id" placeholder="Enter Member email" required>';
                echo ' <input id="add-button" type="submit" value="Add"></input>';
                echo '</div>';
            } else {
                echo '<div id="create-project-form">';
                echo '<h3 style="color: black;">You Can not add new Member!!</h3>';
                echo '</div>';
            }

        }
            ?>


            <br /><br /><br /><br /><br /><br />

        </section>
    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 TeamUp. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>