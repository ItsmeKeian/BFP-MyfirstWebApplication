<?php
include('databaseconnect.php');

try {
    $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);

    $qry = "SELECT * FROM account";
    
    $stmt = $dbh->prepare($qry);
    $stmt->execute();

    $count = $stmt->rowCount();

    if ($count > 0) {
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        echo json_encode($arr);
    } else {
        $arr = array("status" => 0);
        echo json_encode($arr);
    }
} catch (PDOException $e) {
    $arr = array("err" => $e->getMessage());
    echo json_encode($arr);
}

$dbh = null;
?>