<?php
	include('databaseconnect.php');

	try {
		$type  = isset($_POST['type']) ? $_POST['type'] : "";

		$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);

		$qry = "";
		if ($type == "account") {
			$qry = "SELECT COUNT(*) AS maximum FROM electricalclearance";
		} elseif ($type == "cle") {
			$qry = "SELECT COUNT(*) AS maximum FROM buildingpermit";
		} elseif ($type == "establish") {
			$qry = "SELECT COUNT(*) AS maximum FROM establishmentprofile";
		} elseif ($type == "occupan") {
			$qry = "SELECT COUNT(*) AS maximum FROM occupancyprofile";
		}

		$stmt = $dbh->prepare($qry);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$maximum = $row['maximum'];

		$arr = array("unid" => $maximum, "status" => 1);
		echo json_encode($arr);
	} catch (PDOException $e) {
		$arr = array("err" => $e->getMessage());
		echo json_encode($arr);
	}

	$dbh = null;
?>