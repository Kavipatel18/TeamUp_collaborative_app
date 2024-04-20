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
    <title>DashBoard</title>
    <link rel="website icon" type="png" href="pic/web-logo2.png">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/homestyle.css" />
    <link rel="stylesheet" href="css/projectstyle.css" />

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />

    <script src="js/dashboardjs.js"></script>
    <style>
        #table2 {
            border-spacing: 30px;
        }
    </style>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <?php

    $p_id = $_SESSION['id'];
    $u_id = $_SESSION['u_id'];
    $email = $_SESSION['email'];

    $sql = "SELECT IsLeader FROM projects WHERE id = ? AND u_id = ?";

    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $p_id, $u_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $isLeader);
    mysqli_stmt_fetch($stmt);
    $stmt->close();
    $results;

    if ($isLeader == 1) {
        $sql = "SELECT * FROM activity WHERE p_id =?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "s", $p_id);
        mysqli_stmt_execute($stmt);
        $results = mysqli_stmt_get_result($stmt);
        $stmt->close();



        $sql = "SELECT * FROM member WHERE p_id = ?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "s", $p_id);
        mysqli_stmt_execute($stmt);
        $results1 = mysqli_stmt_get_result($stmt);
        $stmt->close();

    } else {
        $sql = "SELECT * FROM activity WHERE p_id =? AND m_email =?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $p_id, $email);
        mysqli_stmt_execute($stmt);
        $results = mysqli_stmt_get_result($stmt);
    }

    $Activities = [];
    $members = [];
    $mActivities = [];

    foreach ($results as $result) {
        $Activities[] = $result['activity_name'];
    }

    if ($isLeader == 1)
        foreach ($results1 as $result) {
            $members[] = $result['m_email'];
            $p_id = $_SESSION['id'];
            $sql = "SELECT * FROM activity WHERE p_id =? AND m_email=?";
            $stmt = mysqli_prepare($connect, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $p_id, $result['m_email']);
            mysqli_stmt_execute($stmt);
            $results2 = mysqli_stmt_get_result($stmt);
            $stmt->close();

            $memberActivities = [];
            foreach ($results2 as $activity) {
                $memberActivities[] = $activity['activity_name'];
            }
            $mActivities[$result['m_email']] = $memberActivities;
        }
    ?>

    <script type="text/javascript">
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['activity_name', 'm_email'],
                <?php
                if (empty($members)) {
                    echo "hi";
                }
                foreach ($members as $member) {
                    
                    $count = count($mActivities[$member]);
                    echo "['$member', $count],";
                }
                ?>
            ]);

            var options = {
                title: 'Activity Distribution',
                pieHole: 0.4,
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
    </script>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['activity_name', 'isDone'],
                    <?php
                $doneActivities = [];
                $notDoneActivities = [];
                foreach ($results as $result) {
                    if ($result['isDone']) {
                        $doneActivities[] = $result['activity_name'];
                    } else {
                        $notDoneActivities[] = $result['activity_name'];
                    }
                }
                if (!empty($doneActivities)) {
                    foreach ($doneActivities as $activity) {
                        //echo "['Done Activities', ". count($doneActivities). "],";
                        echo "['" . $activity . "', " . count($doneActivities) . "],";
                    }
                }
                $combined = '';
                foreach ($notDoneActivities as $activity) {
                    $combined = $combined . ' (' . $activity . ') ';
                }
                if (!empty($notDoneActivities)) {
                    echo "['UNFINISHED $combined', " . count($notDoneActivities) . "],";
                }
                ?>
            ]);
            
        
            var options = {
                title: 'Project Progress:'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>

</head>

<body>
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
    <section class="home">
        <!-- Home -->
        <section class="hero" style="padding-bottom: 0px; padding-top:50px ;background-color:white;">
            
            <?php
            if (empty($members)) {
                echo '<div id="piechart" style="width: 100%; height: 400px;"></div>';
            } else {
                echo '<div id="donutchart" style="width: 100%; height: 400px;"></div>';
                echo '<div id="piechart" style="width: 100%; height: 400px;"></div><br>';
                echo '<a href="generate_report.php" class="button">Generate Report</a>';

            }
            ?>


            <br /><br />

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
        <div style="background-color:white;"><br><br><br></div>
        <footer class="footer">
            <div class="container">
                <p>&copy; 2024 TeamUp. All rights reserved.</p>
            </div>
        </footer>
        </section>
</body>

</html>