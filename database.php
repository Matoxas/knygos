<?php 
error_reporting(0); 	//nerodom db duomenų viešai.

$host = "eu-cdbr-west-01.cleardb.com";    
$user = "b9c3bc6f5d6c01";
$pass = "f18b34ea";
$dbname = "heroku_489cc183cbe7d94";

$db = new MySQLi($host, $user, $pass, $dbname);  


if ($db->connect_errno) {      //tikrinamos prisijungimo klaidos
    die("prisijungimas prie duombazes nepavyko: " . $db->connect_error);
} ;


// json duomenų įkėlimas į db
// $json = file_get_contents("booklist.json");
// $json_a = json_decode($json, true);
// foreach ($json_a as $value) {
    
// 	$db->query("INSERT INTO test (name, genre, author, year, description)
// 			VALUES('$value[name]', '$value[genre]', '$value[author]', '$value[year]', '$value[description]')");
	
// }




 ?>



