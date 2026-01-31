<?php
include('databaseconnect.php');

try {
    $ab = isset($_POST['a']) ? $_POST['a'] : "";

    $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);

    $qry = "SELECT * FROM establishmentprofile WHERE establish = :a";

    $stmt = $dbh->prepare($qry);
    $stmt->bindParam(":a", $ab);
    $stmt->execute();

    $count = $stmt->rowCount();

    if ($count > 0) {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);




        $a1 = $data["establishment"];
        $a2 = $data["owner"];
        $a3 = $data["statstab"];
        $a4 = $data["occupancy"];
        $a5 = $data["statappli"];
        $a6 = $data["address"];
        $a7 = $data["dateiss"];
        $a8 = $data["fsicnumber"];
        $a9 = $data["amountpaid"];
        $a10 = $data["qrnumber"];
        $a11 = $data["typeapplic"];
        $a12 = $data["dateinspect"];
        $a13 = $data["inspectnum"];
        $a14 = $data["dateissueorder"];
        $a15 = $data["datefsic"];
        $a16 = $data["inspector"];
        $a17 = $data["violation"];
        $a18 = $data["remarks"];
        $a19 = $data["establish"];
        





        $arr = array("a1" => $a1,"a2" => $a2,"a3" => $a3,"a4" => $a4,"a5" => $a5,"a6" => $a6,"a7" => $a7,"a8" => $a8,"a9" => $a9,"a10" => $a10,"a11" => $a11,"a12" => $a12,"a13" => $a13,"a14" => $a14,"a15" => $a15,"a16" => $a16,"a17" => $a17,"a18" => $a18,"a19" => $a19, "status" => 1);

        
    } else {
        $arr = array("status" => 0);
    }

    echo json_encode($arr);
} catch (PDOException $e) {
    $arr = array("err" => $e->getMessage());
    echo json_encode($arr);
}

$dbh = null;
?>