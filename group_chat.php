<?php
session_start();
include 'database/connect.php';

if ($_SESSION['log'] == '') {
    header("location:index.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $email = $_SESSION['email'];
    $pid = $_SESSION['id'];
    //$msg = $_REQUEST['msg'];
    $msg = mysqli_real_escape_string($connect, $_REQUEST['msg']);
    date_default_timezone_set('Asia/Kolkata');
    $ts = date('y-m-d h:ia', time());

    $stmt = $connect->prepare("INSERT INTO chats (p_id, email, messages, dates) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss", $pid, $email, $msg, $ts);
    if (!$stmt->execute()) {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $connect->close();
    header("Location: Group_chat.php");
    exit();
}

?>
<html>

<head>
    <link rel="website icon" type="png" href="pic/web-logo2.png">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/homestyle.css" />
    <link rel="stylesheet" href="css/projectstyle.css" />
    <link rel="stylesheet" href="css/chat.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <script src="js/projectjs.js"></script>
</head>

<header class="header" style="padding-left: 0px; padding-right: 0px;">
    <nav class="nav">
        <a href="home.php" class="nav_logo"><img src="pic/logo2.png" alt="TeamUp's Logo" style="height: 50px; width: auto;" /></a>

        <ul class="nav_items">
            <li class="nav_item">
                <a href="home.php" class="nav_link">Home</a>
                <a href="project.php" class="nav_link">Project</a>
                <a href="activity.php" class="nav_link">Activity Tracking</a>
                <a href="dashboard.php" class="nav_link">DashBoard</a>
                <a href="group_chat.php" class="nav_link">Chat</a>
            </li>
        </ul>

        <div class="dropdown">
            <button id="dropdownButton" class="button">
                <html><?php echo $_SESSION['pname'] . " ID: " . $_SESSION['id'] . "" ?>

                </html>
            </button>
            <div id="myDropdown" class="dropdown-content">
                <a href="#" id="profile" class="nav_link">My Profile</a>
                <!-- <a href="temp1.php" class="nav_link">Project Details</a>
                        <a href="#" id="changepass" class="button nav_link" style="border-color: white;">Change Password</a> -->
                <a href="database/logout.php" class="nav_link">Log Out</a>
            </div>
        </div>

    </nav>
</header>

<body onload="show_func()">
    <div id="container">
        <main>
            <script>
                function show_func() {

                    var element = document.getElementById("chathist");
                    element.scrollTop = element.scrollHeight;

                }
            </script>



            <form id="myform" action="group_chat.php" method="POST">
                <div class="inner_div" id="chathist">
                    <?php
                    include 'database/connect.php';
                    $pid = $_SESSION['id'];
                    $currentUserEmail = $_SESSION['email'];

                    $query = "SELECT * FROM chats WHERE p_id =?";
                    $stmt = $connect->prepare($query);
                    $stmt->bind_param("s", $pid);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()) {
                        if ($row['email'] === $currentUserEmail) {
                    ?>
                            <div id="triangle1" class="triangle1"></div>
                            <div id="message1" class="message1">
                                <span style="color:black;float:left;font-size:10px;clear:both;">
                                    <?php echo $row['email']; ?>
                                </span><br />
                                <span style="color:white;float:right;" class="message-text">
                                    <?php echo $row['messages']; ?>
                                </span> <br />
                                <div>
                                    <span style="color:black;float:right;font-size:10px;clear:both;">
                                        <?php echo $row['dates']; ?>
                                    </span>
                                </div>
                            </div>
                            <br /><br />
                        <?php
                        } else {
                        ?>
                            <div id="triangle" class="triangle"></div>
                            <div id="message" class="message">
                                <span style="color:black;float:left;font-size:10px;clear:both;">
                                    <?php echo $row['email']; ?>
                                </span><br />
                                <span style="color:white;float:left;" class="message-text">
                                    <?php echo $row['messages']; ?>
                                </span> <br />
                                <div>
                                    <span style="color:black;float:right;font-size:10px;clear:both;">
                                        <?php echo $row['dates']; ?>
                                    </span>
                                </div>
                            </div>
                            <br /><br />
                    <?php
                        }
                    }
                    ?>
                </div>


                <div align="center" id="textbutton">
                    <input type="text" id="msg" name="msg" placeholder="Enter Message" required><input class="input2" type="submit" id="submit" name="submit" value="Send">
                </div>
            </form>
        </main>
    </div>
</body>
<footer class="footer">
    <div class="container">
        <p>&copy; 2024 TeamUp. All rights reserved.</p>
    </div>
</footer>
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

</html>
