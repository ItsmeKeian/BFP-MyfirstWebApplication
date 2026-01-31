<?php
include('databaseconnect.php');

try {
    $id = isset($_POST['id']) ? $_POST['id'] : "";
    $type = isset($_POST['type']) ? $_POST['type'] : "";

    $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);

    
    if ($type == "establishment") {

        // pag insert in ngadto han archive table ha database copy la ubos or parihasa an mga ngaran hanim mga input para dika malipongan

        $insertQuery = "INSERT INTO arc_electricalclearance (clearance, buildingname, owner, location, fscecno, dateiss, kindofinstall, voltage, nophase, connectedload, maincircuit, installedby, prc, validuntil, ammountpaid, qrnumber) SELECT clearance, buildingname, owner, location, fscecno, dateiss, kindofinstall, voltage, nophase, connectedload, maincircuit, installedby, prc, validuntil, ammountpaid, qrnumber FROM electricalclearance WHERE clearance = :id";
        $insertStmt = $dbh->prepare($insertQuery);
        $insertStmt->bindParam(":id", $id);
        $insertStmt->execute();


        // yadi pag delete na in mismo didto han table nim ha database

        $deleteQuery = "DELETE FROM electricalclearance WHERE clearance = :id";
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
