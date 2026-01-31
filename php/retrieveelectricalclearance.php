<?php
include('databaseconnect.php');

try {
    $ab = isset($_POST['a']) ? $_POST['a'] : "";

    $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);

    $qry = "SELECT * FROM electricalclearance WHERE clearance = :a";

    $stmt = $dbh->prepare($qry);
    $stmt->bindParam(":a", $ab);
    $stmt->execute();

    $count = $stmt->rowCount();

    if ($count > 0) {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);




      		$a1= $data["buildingname"];
			$a2= $data["owner"];
			$a3= $data["location"];
			$a4= $data["fscecno"];
			$a5= $data["dateiss"];
			$a6= $data["kindofinstall"];
			$a7= $data["voltage"];
			$a8= $data["nophase"];
			$a9= $data["connectedload"];
			$a10= $data["maincircuit"];
			$a11= $data["installedby"];
			$a12= $data["prc"];
			$a13= $data["validuntil"];
			$a14= $data["ammountpaid"];
			$a15= $data["qrnumber"];
			$a16= $data["clearance"];
			
			

			$arr = array("a1" => $a1,"a2" => $a2,"a3" => $a3,"a4" => $a4,"a5" => $a5,"a6" => $a6,"a7" => $a7,"a8" => $a8,"a9" => $a9,"a10" => $a10,"a11" => $a11,"a12" => $a12,"a13" => $a13,"a14" => $a14,"a15" => $a15,"a16" => $a16, "status" => 1);
        
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