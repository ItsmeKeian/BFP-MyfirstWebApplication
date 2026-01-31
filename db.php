<?php
define("DB_HOST", "localhost");
define("DB_USER", "u638441864_keian");
define("DB_PASS", "V[xBy[Kj9>");
define("DB_NAME", "u638441864_bfp");

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>