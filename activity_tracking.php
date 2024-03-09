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
    <link rel="stylesheet" href="css/projectstyle.css" />

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />

    <!-- <script src="js/homejs.js"></script> -->
    <script src="js/activitytracking.js"></script>

</head>

<body>
    <header class="header" style="padding-left: 0px; padding-right: 0px;">
        <nav class="nav">
            <a href="home.php" class="nav_logo"><img src="pic/logo2.png" alt="TeamUp's Logo" style="height: 50px; width: auto;" /></a>

            <ul class="nav_items">
                <li class="nav_item">
                    <a href="#services" class="nav_link">DashBoard</a>
                    <a href="home.php" class="nav_link">My Projects</a>
                    <a href="activity_tracking.php" class="nav_link">Activity Tracking</a>
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
            
            if ($stmt->fetch()) {
                $stmt->close();
                $_SESSION['u_id'] = $u_id;
                $p_id = $_SESSION['id'];
            
                $sql = "SELECT IsLeader FROM projects WHERE id = ? AND u_id = ?";
                $stmt = $connect->prepare($sql);
                $stmt->bind_param("ss", $p_id, $u_id);
                $stmt->execute();
                $stmt->bind_result($isLeader);
                $stmt->fetch();
                $stmt->close();
                if ($isLeader == 1) {
                    echo '<div id="create-project-form">
                            <h2 style="color: black;">Assign Activity</h2>
                            <input type="text" id="member-id" placeholder="Enter Member email" required>
                            <input type="text" id="activity-name" placeholder="Enter Activity Name" required>
                            <br/>
                            <input id="add-button1" type="submit" value="Add"></input>
                          </div>';


                        $activity = [];

                        $sql = "SELECT activity_id, activity_name, m_email FROM activity WHERE p_id = ?";
                        $stmt = $connect->prepare($sql);
                        $stmt->bind_param("i", $p_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
            
                        echo '<div id="projects-container" style="color: black; margin-top: 15px;">';
                        echo '<h3>Activity List</h3>';
            
                        if ($result->num_rows <= 0) {
                            //echo '<h5 style="color: black;">No activity assigned.</h5><br><br>';
                            echo '<div id="proj1" class="project">';
                            echo '<input type="submit" style="border:none; font-size:18px;width: -webkit-fill-available;" class="project-name" value="No activity assigned. " />';
                            echo '</div>';
                        } else {
                            while ($row = $result->fetch_assoc()) {
                                $activity[] = $row;
                            }
            
                            foreach ($activity as $a) {
                                echo '<div id="proj1" class="project">';
                                echo '<h5 style="color: black;">Activity ID: ' . $a['activity_id'] . '</h5>';
                                echo '<br>';
                                echo '<h5 style="color: black;">Activity Name: ' . $a['activity_name'] . '</h5>';
                                echo '<br>';
                                echo '<h5 style="color: black;">Member Email: ' . $a['m_email'] . '</h5>';
                                echo '<br>';
                                echo '<span class="delete" id="delete">&times;</span>';
                                echo '</div>';
                            }                
                        }
                        $stmt->close();
            
                        echo '</div>';

                } else {
                    echo '<div id="create-project-form">
                            <h3 style="color: black;">You Can not add new Activity!!</h3>
                          </div>';


                          $activity = [];

                          $sql = "SELECT activity_id, activity_name, m_email FROM activity WHERE p_id = ? AND  m_email = ?";
                          $stmt = $connect->prepare($sql);
                          $stmt->bind_param("is", $p_id, $email);
                          $stmt->execute();
                          $result = $stmt->get_result();
              
                          echo '<div id="projects-container" style="color: black; margin-top: 15px;">';
                          echo '<h3>Activity List</h3>';
              
                          if ($result->num_rows <= 0) {
                              //echo '<h5 style="color: black;">No activity assigned.</h5><br><br>';
                              echo '<div id="proj1" class="project">';
                              echo '<input type="submit" style="border:none; font-size:18px;width: -webkit-fill-available;" class="project-name" value="No activity assigned. " />';
                              echo '</div>';
                          } else {
                              while ($row = $result->fetch_assoc()) {
                                  $activity[] = $row;
                              }
              
                              foreach ($activity as $a) {
                                  echo '<div id="proj1" class="project">';
                                  echo '<h5 style="color: black;">Activity ID: ' . $a['activity_id'] . '</h5>';
                                  echo '<br>';
                                  echo '<h5 style="color: black;">Activity Name: ' . $a['activity_name'] . '</h5>';
                                  echo '<br>';
                                  echo '<h5 style="color: black;">Member Email: ' . $a['m_email'] . '</h5>';
                                  echo '<br>';
                                  echo '<span class="delete" id="delete">&times;</span>';
                                  echo '</div>';
                              }                
                          }
                          $stmt->close();
              
                          echo '</div>';

                }
            } else {
                echo '<div id="create-project-form">
                        <h3 style="color: black;">You Can not add new Activity!!</h3>
                      </div>';
            }

            ?>
            
            <br /><br />
            <footer class="footer">
        <div class="container">
            <p>&copy; 2024 TeamUp. All rights reserved.</p>
        </div>
    </footer>
    </section>


</body>

</html>