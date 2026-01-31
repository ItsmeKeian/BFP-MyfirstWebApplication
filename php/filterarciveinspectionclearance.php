<?php
	include('databaseconnect.php');

			
         $id  = isset($_POST['a']) ? $_POST['a'] : "";
         



	try {


		$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
		
		$qry = "SELECT * FROM arc_establishmentprofile where establishment LIKE '%$id%'";




	



	

		$stmt = $dbh->prepare($qry);
		
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