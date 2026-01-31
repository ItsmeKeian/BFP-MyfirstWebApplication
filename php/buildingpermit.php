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
		$qq  = isset($_POST['q']) ? $_POST['q'] : "";
		$rr  = isset($_POST['r']) ? $_POST['r'] : "";
		$ss  = isset($_POST['s']) ? $_POST['s'] : "";
	
		
		
		$ed  = "add";

				

		$dup = 0;

		$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);

		

		$qry = "";


	

					if($ed == "add"){
						
					    $qry= "INSERT INTO `buildingpermit`( `establishment`, `owner`, `statstab`, `occupancy`, `statappli`, `address`, `dateiss`, `fsicnumber`, `amountpaid`, `qrnumber`, `typeapplic`, `dateinspect`, `inspectnum`, `dateissueorder`, `datefsic`, `inspector`, `violation`, `remarks`, `evaluator` ) VALUES " . 
							   "(:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k,:l,:m,:n,:o,:p,:q,:r,:s)";



					} 
					
					if($ed == "add") {
						$checker = "SELECT * FROM buildingpermit WHERE permit = :co";

						$fdup = $dbh->prepare($checker);
						$fdup->bindParam(":co", $ab);
					


					

						$fdup->execute();

						$count = $fdup->rowCount();

						if($count > 0)
							$dup++;
							
						}	


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
				$stmt->bindParam(":q", $qq);
				$stmt->bindParam(":r", $rr);
				$stmt->bindParam(":s", $ss);
			
			

			
				
			

		if($dup > 0)
			$arr = array("status" => 2);
		else {
			$stmt->execute();
			$arr = array("status" => 1);
		}
		echo json_encode($arr);
	}
	catch (PDOException $e) {
		echo $e->getMessage();
		$arr = array("status" => 0);
		echo json_encode($arr);
	}

	$dbh = null;
?>