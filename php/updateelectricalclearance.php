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
		$ii  = isset($_POST['i']) ? $_POST['i'] : "";
		$jj  = isset($_POST['j']) ? $_POST['j'] : "";
		$kk  = isset($_POST['k']) ? $_POST['k'] : "";
		$ll  = isset($_POST['l']) ? $_POST['l'] : "";
		$mm  = isset($_POST['m']) ? $_POST['m'] : "";
		$nn  = isset($_POST['n']) ? $_POST['n'] : "";
		$oo  = isset($_POST['o']) ? $_POST['o'] : "";
		$pp  = isset($_POST['p']) ? $_POST['p'] : "";

		
		
		
		
		
	
	

		$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);

	



		$qry = "UPDATE electricalclearance SET `buildingname`= :a,  `owner`= :b, `location`= :c, `fscecno`= :d,  `dateiss`= :e, `kindofinstall`= :f, `voltage`= :g, `nophase`= :h, `connectedload`= :i, `maincircuit` = :j, `installedby` = :k, `prc` = :l, `validuntil` = :m, `ammountpaid` = :n, `qrnumber` = :o WHERE `clearance` = :p";	
	

		$stmt = $dbh->prepare($qry);


				$stmt->bindParam(":a", $ab);
				$stmt->bindParam(":b", $bb);
				$stmt->bindParam(":c", $cc);
				$stmt->bindParam(":d", $dd);
				$stmt->bindParam(":e", $ee);
				$stmt->bindParam(":f", $ff);
				$stmt->bindParam(":g", $gg);
				$stmt->bindParam(":h", $hh);
				$stmt->bindParam(":i", $ii);
				$stmt->bindParam(":j", $jj);
				$stmt->bindParam(":k", $kk);
				$stmt->bindParam(":l", $ll);
				$stmt->bindParam(":m", $mm);
				$stmt->bindParam(":n", $nn);
				$stmt->bindParam(":o", $oo);
				$stmt->bindParam(":p", $pp);
				
				
				
	
		
		
	
		
		
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