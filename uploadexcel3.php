<?php  


if(isset($_POST['submit3'] )) {


	 
     if(isset($_FILES['uploadFile']['name']) && $_FILES['uploadFile']['name'] != "") {
        $allowedExtensions = array("xls","xlsx");
        $ext = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);
		
        if(in_array($ext, $allowedExtensions)) {
				
               $file = "uploads/".$_FILES['uploadFile']['name'];
               $isUploaded = copy($_FILES['uploadFile']['tmp_name'], $file);
			 
               if($isUploaded) {
				
                    include("db.php");
				
                    include(__DIR__ .'/Classes/PHPExcel/IOFactory.php');
                    try {
                        // load uploaded file
                        $objPHPExcel = PHPExcel_IOFactory::load($file);
                    } catch (Exception $e) {
                         die('Error loading file "' . pathinfo($file, PATHINFO_BASENAME). '": ' . $e->getMessage());
                    }
                    
                    // Specify the excel sheet index
                    $sheet = $objPHPExcel->getSheet(0);
                    $total_rows = $sheet->getHighestRow();
					$highestColumn      = $sheet->getHighestColumn();	
					$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);		
					
					//	loop over the rows
					for ($row = 1; $row <= $total_rows; ++ $row) {
						for ($col = 0; $col < $highestColumnIndex; ++ $col) {
							$cell = $sheet->getCellByColumnAndRow($col, $row);
							$val = $cell->getValue();
							$records[$row][$col] = $val;
						}
					}
					$html="<table border='1'>";
					
					foreach($records as $row){
						// HTML content to render on webpage
						$html.="<tr>";
						$a = isset($row[0]) ? $row[0] : '';
						$b = isset($row[0]) ? $row[1] : '';
						$c = isset($row[0]) ? $row[2] : '';
						$d = isset($row[0]) ? $row[3] : '';
						$e = isset($row[0]) ? $row[4] : '';
						$f = isset($row[0]) ? $row[5] : '';
						$g = isset($row[0]) ? $row[6] : '';
						$h = isset($row[0]) ? $row[7] : '';
						$i = isset($row[0]) ? $row[8] : '';
						$j = isset($row[0]) ? $row[9] : '';
						$k = isset($row[0]) ? $row[10] : '';
						$l = isset($row[0]) ? $row[11] : '';
						$m = isset($row[0]) ? $row[12] : '';
						$n = isset($row[0]) ? $row[13] : '';
						$o = isset($row[0]) ? $row[14] : '';
						$p = isset($row[0]) ? $row[15] : '';
						$q = isset($row[0]) ? $row[16] : '';
						$r = isset($row[0]) ? $row[17] : '';
						$s = isset($row[0]) ? $row[18] : '';
				
						
						
						
						
						$html.="<td>".$a."</td>";
						$html.="</tr>";
					
						$query = "INSERT INTO buildingpermit(`establishment`, `owner`, `statstab`, `occupancy`, `statappli`, `address`, `dateiss`, `fsicnumber`, `amountpaid`, `qrnumber`, `typeapplic`, `dateinspect`, `inspectnum`, `dateissueorder`, `datefsic`, `inspector`, `violation`, `remarks`, `evaluator`) 
								values('".$a."','".$b."','".$c."','".$d."','".$e."','".$f."','".$g."','".$h."','".$i."','".$j."','".$k."','".$l."','".$m."','".$n."','".$o."','".$p."','".$q."','".$r."','".$s."')";

					
						
						$mysqli->query($query);	
						
					}
					
					
				header("Location:importexcelfile.html");		
				
                    unlink($file);
                } else {
                    echo '<span class="msg">File not uploaded!</span>';
                }
        } else {
            echo '<span class="msg">Please upload excel sheet.</span>';
        }
    } else {
        echo '<span class="msg">Please upload excel file.</span>';
    }
}
?>