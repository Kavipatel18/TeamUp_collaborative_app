
<?php 
session_start();
include 'database/connect.php';

// Check if the user is logged in
if (!isset($_SESSION['log']) || empty($_SESSION['log'])) {
    header("location:index.php");
    exit(); // Stop further execution
}

// Fetch project details
$projectName = $_SESSION['pname']; // Placeholder for project name (replace with actual data from the database)
$projectId = $_SESSION['id']; // Placeholder for project ID (replace with actual data from the database)

// Fetch activities assigned to each member
$activities = [];
$sql = "SELECT id, m_email FROM member WHERE p_id = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("s", $_SESSION['id']);
$stmt->execute();
$stmt->store_result(); // Buffer the result set
$stmt->bind_result($m_id, $m_email);
while ($stmt->fetch()) {
    $memberActivities = [];
    $sql_activities = "SELECT activity_name FROM activity WHERE p_id = ? AND m_email = ?";
    $stmt_activities = $connect->prepare($sql_activities);
    $stmt_activities->bind_param("ss", $_SESSION['id'], $m_email);
    $stmt_activities->execute();
    $stmt_activities->store_result(); // Buffer the result set
    $stmt_activities->bind_result($activity_name);
    while ($stmt_activities->fetch()) {
        $memberActivities[] = $activity_name;
    }
    $stmt_activities->close(); // Close the inner statement
    $activities[$m_email] = $memberActivities;
}
$stmt->close(); // Close the outer statement

// Fetch chats (replace this with actual chat data from your database)
$chats = [
    '<div id="donutchart" style="width: 100%; height: 400px;"></div>',
    '<div id="piechart" style="width: 100%; height: 400px;"></div>'
];

// Generate HTML report
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Report</title>
    <style>

    body {
        background-color: #1a1a1a; /* Dark background */
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }
    
    .container {
        background-color: #ffffff; /* White container background */
        width: 210mm; /* A4 paper width */
        padding: 20mm;
        margin: 20px
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        color: #333333; /* Dark text color */
    }
    
    .header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .header h1 {
        font-size: 32px;
        color: #007bff; /* Primary color */
        margin: 0;
    }
    
    .section {
        margin-bottom: 30px;
    }
    
    .section h2 {
        font-size: 24px;
        color: #007bff; /* Primary color */
        margin-bottom: 20px;
    }
    
    .section p {
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 15px;
    }
    
    .section ul {
        padding-left: 20px;
    }
    
    .section li {
        font-size: 16px;
        padding-left:180px;
        line-height: 1.6;
        margin-bottom: 5px;
    }
    
    .downloadPDF {
        display: block;
        width: 150px;
        margin: 0 auto;
        padding: 10px;
        background-color: #007bff; /* Primary color */
        color: #ffffff; /* White text color */
        border: none;
        border-radius: 5px;
        cursor: pointer; 
        text-align: center;
        cursor: pointer;
        text-decoration: none;
        margin-top: 20px;
        transition: background-color 0.3s ease; /* Smooth transition */
    }
    
    .downloadPDF:hover {
        background-color: #0056b3; /* Darker shade of primary color on hover */
    }
    
    </style>
</head>

<body>

    <div class="container"style="padding-top:10px;">
    <a href="dashboard.php" style="text-decoration: none; color: black; font-size: 20px;">&#8592; Back</a>
    <a id="downloadPDF" class="downloadPDF">Download</a>
    <div id="pdf">
        <h1 align="center">Project Report</h1>
        <h2 >Project Details</h2><strong style="padding-left: 180px;">Project Name:</strong> ' . $projectName . '<br><br>
        <strong style="padding-left: 180px;">Project ID:</strong> ' . $projectId . '
        
        <h2>Members and Activities</h2>
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
$html .= '<h2>Chats</h2>
        <ul>';
foreach ($chats as $chat) {
    $html .=  $chat ;
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

// Output the report
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
    mysqli_stmt_bind_param($stmt, "i", $p_id);
    mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);
    $stmt->close();

    $sql = "SELECT * FROM member WHERE p_id = ?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "i", $p_id);
    mysqli_stmt_execute($stmt);
    $results1 = mysqli_stmt_get_result($stmt);
    $stmt->close();
} else {
    $sql = "SELECT * FROM activity WHERE p_id =? AND m_email =?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "is", $p_id, $email);
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
        mysqli_stmt_bind_param($stmt, "is", $p_id, $result['m_email']);
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

