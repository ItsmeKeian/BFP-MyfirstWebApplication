<?php
	include('databaseconnect.php');

	try {

		$type  = isset($_POST['type']) ? $_POST['type'] : "";
	

		$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);



	 if($type == "bfpmap"){

		$qry = "SELECT MAX(map) AS maximum FROM bfpmap";
		$stmt = $dbh->prepare($qry);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$maximum = $row['maximum'];
		$arr = array("unid" => $maximum,"status" => 1);
		
		}




echo json_encode($arr);

	}
	catch (PDOException $e) {
		$arr = array("err" => $e->getMessage());
		echo json_encode($arr);
	}

	$dbh = null;
?>