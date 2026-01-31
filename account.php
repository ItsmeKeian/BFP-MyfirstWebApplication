<?php
include('databaseconnect.php');

try {
    // Check if the form was submitted
    if (isset($_POST['submit'])) {
        $filename = $_FILES["image"]["name"];
        $newname = $_POST["useracc"];
        $file_ext = substr($filename, strripos($filename, '.')); // get file extension
        $filesize = $_FILES["image"]["size"];
        $allowed_file_types = array('.jpg');

        $ab = isset($_POST['a']) ? $_POST['a'] : "";
        $bb = isset($_POST['b']) ? $_POST['b'] : "";
        $cc = isset($_POST['c']) ? $_POST['c'] : "";
        $dd = isset($_POST['d']) ? $_POST['d'] : "";
        $ee = isset($_POST['e']) ? $_POST['e'] : "";
        $ff = isset($_POST['f']) ? $_POST['f'] : "";
        $gg = isset($_POST['g']) ? $_POST['g'] : "";
        $hh = isset($_POST['h']) ? $_POST['h'] : "";
        $ii = isset($_POST['i']) ? $_POST['i'] : "";
        $jj = isset($_POST['j']) ? $_POST['j'] : "";

        $ed = "add";
        $dup = 0;

        $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $qry = "";

        if ($ed == "add") {
            $qry = "INSERT INTO `account`(`image`, `lastname`, `firstname`, `middlename`, `birthdate`, `position`, `gender`, `email`, `username`, `password`, `confirmpassword`) VALUES " .
                   "(:image, :a, :b, :c, :d, :e, :f, :g, :h, :i, :j)";
        }

        if ($ed == "add") {
            $checker = "SELECT * FROM account WHERE acc = :co";
            $fdup = $dbh->prepare($checker);
            $fdup->bindParam(":co", $ab);

            $fdup->execute();
            $count = $fdup->rowCount();

            if ($count > 0)
                $dup++;
        }

        $stmt = $dbh->prepare($qry);

        $imageContent = file_get_contents($_FILES["image"]["tmp_name"]); // Get image content
        $stmt->bindParam(":image", $imageContent, PDO::PARAM_LOB);
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

        if ($dup > 0) {
            $arr = array("status" => 2);
        } else {
            $stmt->execute();
            $arr = array("status" => 1);
            header("Location: register.html");
            exit(); // Exit the script after redirection
        }
        echo json_encode($arr);

        if (in_array($file_ext, $allowed_file_types) && ($filesize < 200000)) {
            $newfilename = ($newname) . $file_ext;
            if (file_exists("upload/" . $newfilename)) {
                echo "You have already uploaded this file.";
            } else {
                move_uploaded_file($_FILES["image"]["tmp_name"], "images/userprofiles/" . $newfilename);
                header("Location: register.html");
                exit();
            }
        } elseif (empty($file_basename)) {
            echo "Please select a photo to upload.";
            exit();
        } elseif ($filesize > 200000) {
            echo "The file you are trying to upload is too large.";
            exit();
        } else {
            echo "Only these file types are allowed for upload: " . implode(', ', $allowed_file_types);
            exit();
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
    $arr = array("status" => 0);
    echo json_encode($arr);
}
$dbh = null;
?>