<?php
	include('databaseconnect.php');

	try {
	$type  = isset($_POST['type']) ? $_POST['type'] : "";
	$ai  = isset($_POST['a']) ? $_POST['a'] : "";
	$bi  = isset($_POST['b']) ? $_POST['b'] : "";
	$c  = isset($_POST['c']) ? $_POST['c'] : "";

		

		$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
		
	


 	if($c == "statstab"){

	  $qry = "SELECT count(1) AS maximum FROM buildingpermit WHERE $c LIKE :bb AND dateiss BETWEEN  :a AND :b";
      
	}

	if($c == "statappli"){

	  $qry = "SELECT count(1) AS maximum FROM buildingpermit WHERE $c LIKE :bb AND dateiss BETWEEN  :a AND :b";
      
	}

	if($c == "statstab"){

	  $qry = "SELECT count(1) AS maximum FROM establishmentprofile WHERE $c LIKE :bb AND dateiss BETWEEN  :a AND :b";
      
	}

	if($c == "statappli"){

	  $qry = "SELECT count(1) AS maximum FROM establishmentprofile WHERE $c LIKE :bb AND dateiss BETWEEN  :a AND :b";
      
	}

	if($c == "kindofinstall"){

	  $qry = "SELECT count(1) AS maximum FROM electricalclearance WHERE $c LIKE :bb AND dateiss BETWEEN  :a AND :b";
      
	}

	if($c == "statapplication"){

	  $qry = "SELECT count(1) AS maximum FROM occupancyprofile WHERE $c LIKE :bb AND dateiss BETWEEN  :a AND :b";
      
	}
	
	if($c == "typeofapplication"){

	  $qry = "SELECT count(1) AS maximum FROM occupancyprofile WHERE $c LIKE :bb AND dateiss BETWEEN  :a AND :b";
      
	}




		$stmt = $dbh->prepare($qry);
			
				$stmt->bindParam(":a", $ai);
				$stmt->bindParam(":b", $bi);
				$stmt->bindParam(":bb", $type);
	
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$maximum = $row['maximum'];


			$arr = array("unid" => $maximum,"status" => 1);
		

		echo json_encode($arr);
	}
	catch (PDOException $e) {
		$arr = array("err" => $e->getMessage());
		echo json_encode($arr);
	}

	$dbh = null;
?>