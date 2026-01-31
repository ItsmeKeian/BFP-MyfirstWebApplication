<?php
include('databaseconnect.php');

try {
    $ab = isset($_POST['a']) ? $_POST['a'] : "";

    $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);

    $qry = "SELECT * FROM occupancyprofile WHERE occupancy = :a";

    $stmt = $dbh->prepare($qry);
    $stmt->bindParam(":a", $ab);
    $stmt->execute();

    $count = $stmt->rowCount();

    if ($count > 0) {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);




       $a1= $data["establishment"];
			$a2= $data["owner"];
			$a3= $data["typeofoccupancy"];
			$a4= $data["statapplication"];
			$a5= $data["address"];
			$a6= $data["dateiss"];
			$a7= $data["fsecoccupancy"];
			$a8= $data["fsicoccupancy"];
			$a9= $data["amountpaid"];
			$a10= $data["qrnumber"];
			$a11= $data["typeofapplication"];
			$a12= $data["dateinspect"];
			$a13= $data["inspectornum"];
			$a14= $data["dateinspectord"];
			$a15= $data["datefsec"];
			$a16= $data["datefsic"];
			$a17= $data["inspector"];
			$a18= $data["violation"];
			$a19= $data["classhazard"];
			$a20= $data["occupancy"];






       $arr = array("a1" => $a1,"a2" => $a2,"a3" => $a3,"a4" => $a4,"a5" => $a5,"a6" => $a6,"a7" => $a7,"a8" => $a8,"a9" => $a9,"a10" => $a10,"a11" => $a11,"a12" => $a12,"a13" => $a13,"a14" => $a14,"a15" => $a15,"a16" => $a16,"a17" => $a17,"a18" => $a18,"a19" => $a19,"a20" => $a20, "status" => 1);
        
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