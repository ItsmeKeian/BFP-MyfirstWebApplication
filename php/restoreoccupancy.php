<?php
include('databaseconnect.php');

try {
    $id = isset($_POST['id']) ? $_POST['id'] : "";
    $type = isset($_POST['type']) ? $_POST['type'] : "";

    $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);

    // Check if the type is "establishment"
    if ($type == "occupancy") {
        // First, insert the data into the archive table
        $insertQuery = "INSERT INTO  occupancyprofile(`occupancy`, `establishment`, `owner`, `typeofoccupancy`, `statapplication`, `address`, `dateiss`, `fsecoccupancy`, `fsicoccupancy`, `amountpaid`, `qrnumber`, `typeofapplication`, `dateinspect`, `inspectornum`, `dateinspectord`, `datefsec`, `datefsic`, `inspector`, `violation`, `classhazard`) SELECT `occupancy`, `establishment`, `owner`, `typeofoccupancy`, `statapplication`, `address`, `dateiss`, `fsecoccupancy`, `fsicoccupancy`, `amountpaid`, `qrnumber`, `typeofapplication`, `dateinspect`, `inspectornum`, `dateinspectord`, `datefsec`, `datefsic`, `inspector`, `violation`, `classhazard` FROM arc_occupancyprofile WHERE occupancy = :id";
        $insertStmt = $dbh->prepare($insertQuery);
        $insertStmt->bindParam(":id", $id);
        $insertStmt->execute();

        // Then, delete the data from the original table
        $deleteQuery = "DELETE FROM arc_occupancyprofile WHERE occupancy = :id";
        $deleteStmt = $dbh->prepare($deleteQuery);
        $deleteStmt->bindParam(":id", $id);
        $deleteStmt->execute();

        $arr = array("status" => 1);
    } else {
        $arr = array("status" => 0, "message" => "Invalid type");
    }

    echo json_encode($arr);
} catch (PDOException $e) {
    echo $e->getMessage();
    $arr = array("status" => 0);
    echo json_encode($arr);
}

$dbh = null;
?>
