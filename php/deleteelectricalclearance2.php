<?php
include('databaseconnect.php');

try {
    $id  =0;
 
    $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);

  
        $qry = "DELETE FROM electricalclearance WHERE connectedload  = :a";
        $stmt = $dbh->prepare($qry);
        $stmt->bindParam(":a", $id);
        $stmt->execute();
        $arr = array("status" => 1);
        echo json_encode($arr);

} catch (PDOException $e) {
    echo $e->getMessage();
    $arr = array("status" => 0);
    echo json_encode($arr);
}

$dbh = null;
?>
