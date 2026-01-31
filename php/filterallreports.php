<?php
	include('databaseconnect.php');
 
	try {
		
		$bc  = isset($_POST['a']) ? $_POST['a'] : "";
		$bd  = isset($_POST['b']) ? $_POST['b'] : "";
		$type  = isset($_POST['type']) ? $_POST['type'] : "";
		$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);


	



	 if($type == "evaluation"){
		 

		$qry = "SELECT * FROM `buildingpermit` where dateiss BETWEEN  :a AND :b" ;


}


	 if($type == "inspection"){
		 

		$qry = "SELECT * FROM `establishmentprofile` where dateiss BETWEEN  :a AND :b" ;


}

if($type == "electrical"){
		 

		$qry = "SELECT * FROM `electricalclearance` where dateiss BETWEEN  :a AND :b" ;


}

if($type == "occupancy"){
		 

		$qry = "SELECT * FROM `occupancyprofile` where dateiss BETWEEN  :a AND :b" ;


}





			$stmt = $dbh->prepare($qry);
			$stmt->bindParam(":a", $bc);
			$stmt->bindParam(":b", $bd);
			
			$stmt->execute();

		$count = $stmt->rowCount();

		if($count > 0){
			$arr = $stmt->FETCHALL();
			
			echo json_encode($arr);
		} else {
			$arr = array("status" => 0);
			echo json_encode($arr);
		}
	}
	catch (PDOException $e) {
		$arr = array("err" => $e->getMessage());
		echo json_encode($arr);
	}

	$dbh = null;

?>