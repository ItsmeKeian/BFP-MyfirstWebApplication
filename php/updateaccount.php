<?php
	include('databaseconnect.php');

	try {

		$ab  = isset($_POST['a']) ? $_POST['a'] : "";
		$bb  = isset($_POST['b']) ? $_POST['b'] : "";
		$cc  = isset($_POST['c']) ? $_POST['c'] : "";
		$dd  = isset($_POST['d']) ? $_POST['d'] : "";
		$ee  = isset($_POST['e']) ? $_POST['e'] : "";
		$ff  = isset($_POST['f']) ? $_POST['f'] : "";
		$gg  = isset($_POST['g']) ? $_POST['g'] : "";
		$hh  = isset($_POST['h']) ? $_POST['h'] : "";
		

		
		
		
		
		
	
	

		$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);

	



		$qry = "UPDATE account SET `lastname`= :a, `firstname`= :b, `middlename`= :c, `extensionname`= :d, `fullname`= :e, `position`= :f, `password`= :h WHERE `email`= :g";	
	

		$stmt = $dbh->prepare($qry);


				$stmt->bindParam(":a", $ab);
				$stmt->bindParam(":b", $bb);
				$stmt->bindParam(":c", $cc);
				$stmt->bindParam(":d", $dd);
				$stmt->bindParam(":e", $ee);
				$stmt->bindParam(":f", $ff);
				$stmt->bindParam(":g", $gg);
				$stmt->bindParam(":h", $hh);
				
				
				
				
				
	
		
		
	
		
		
		$stmt->execute();
		$arr = array("status" => 1);

		echo json_encode($arr);
	}
	catch (PDOException $e) {
		echo $e->getMessage();
		$arr = array("status" => 0);
		echo json_encode($arr);
	}

	$dbh = null;
?>