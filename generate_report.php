<?php
session_start();
include 'database/connect.php';

if (!isset($_SESSION['log']) || empty($_SESSION['log'])) {
    header("location:index.php");
    exit();
}


$projectName = $_SESSION['pname']; 
$projectId = $_SESSION['id']; 

$activities = [];
$sql = "SELECT id, m_email FROM member WHERE p_id = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("s", $_SESSION['id']);
$stmt->execute();
$stmt->store_result(); 
$stmt->bind_result($m_id, $m_email);

while ($stmt->fetch()) {
    $memberActivities = [];
    $sql_activities = "SELECT activity_name FROM activity WHERE p_id = ? AND m_email = ?";
    $stmt_activities = $connect->prepare($sql_activities);
    $stmt_activities->bind_param("ss", $_SESSION['id'], $m_email);
    $stmt_activities->execute();
    $stmt_activities->store_result(); 
    $stmt_activities->bind_result($activity_name);

    while ($stmt_activities->fetch()) {
        $memberActivities[] = $activity_name;
    }

    $stmt_activities->close();
    $activities[$m_email] = $memberActivities;
}
$stmt->close();


$chats = [
    '<div id="donutchart" style="width: 100%; height: 400px;"></div>',
    '<div id="piechart" style="width: 100%; height: 400px;"></div>'
];


$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <link rel="website icon" type="png" href="pic/web-logo2.png">
    <link rel="stylesheet" href="css/report.css" />
</head>

<body>

    <div class="container"style="padding-top:10px; ">
    <a href="dashboard.php" style="text-decoration: none; color: black; font-size: 20px;">&#8592; Back</a>
    <a align="left"style="margin:0px;" id="downloadPDF" class="downloadPDF">Download</a>
    
    <div id="pdf">
        <h1 align="center">Project Report</h1>
        <h2 >Project Details: </h2><strong style="padding-left: 180px;">Project Name:</strong> ' . $projectName . '<br><br>
        <strong style="padding-left: 180px;">Project ID:</strong> ' . $projectId . '
        
        <h2>Members and Activities: </h2>
        <div>';
foreach ($activities as $member => $memberActivities) {
    $html .= '<h3>' . $member . '</h3>';
    $html .= '<ul>';
    foreach ($memberActivities as $activity) {
        $html .= '<li>' . $activity . '</li>';
    }
    $html .= '</ul>';
}
$html .= '</div>';
$html .= '<h2>Chats: </h2>
        <ul>';
foreach ($chats as $chat) {
    $html .=  $chat . '<br><br><br>';
}
$html .= '</ul>

    <!-- Download PDF Button -->
    
</div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    function generatePDF() {
        console.log("you clicked it");
        const element = document.getElementById("pdf");
        console.log(element);
        html2pdf().from(element).set({ filename: "TeamUp_report.pdf" }).save();
    }

    document.getElementById("downloadPDF").addEventListener("click", generatePDF);
</script>
</body>
</html>';


echo $html;
?>

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

if ($isLeader == 1) {
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
    google.charts.setOnLoadCallback(drawChartPie);

    function drawChartPie() {
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