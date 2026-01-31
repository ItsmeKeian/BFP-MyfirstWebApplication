<?php
// Replace with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bfp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$filter = $_GET['filter'];

if ($filter === 'months') {
    $sql = "SELECT dateiss(dateiss) as label, COUNT(*) as count FROM buildingpermit GROUP BY MONTH(dateiss)";
} else {
    $sql = "SELECT dateiss(dateiss) as label, COUNT(*) as count FROM buildingpermit GROUP BY DAY(dateiss)";
}

$result = $conn->query($sql);

$data = array(
    'labels' => array(),
    'counts' => array(),
);

while ($row = $result->fetch_assoc()) {
    $data['labels'][] = $row['label'];
    $data['counts'][] = $row['count'];
}

echo json_encode($data);

$conn->close();
?>