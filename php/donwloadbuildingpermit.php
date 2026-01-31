<?php

define("DB_HOST", "localhost");
define("DB_USER", "u638441864_keian");
define("DB_PASS", "V[xBy[Kj9>");
define("DB_NAME", "u638441864_bfp");

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM buildingpermit";
$result = $conn->query($sql);

// Generate a CSV file
$filename = "bfp_evaluationclearance.csv";
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '"');

$output = fopen('php://output', 'w');

// Output column headers
$headers = array("Permit", "Establishment", "Owner", "Statstab", "Occupancy", "Statappli", "Address", "Dateiss", "Fsicnumber", "Amountpaid", "Qrnumber", "Typeapplic", "Dateinspect", "Inspectnum", "Dateissueorder", "Datefsic", "Inspector", "Violation", "Remarks", "Evaluator"); 
fputcsv($output, $headers);

// Output data
while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
$conn->close();
?>
