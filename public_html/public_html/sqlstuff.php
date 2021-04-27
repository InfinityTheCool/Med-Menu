<?php
function connectDB(){
	/*local server connect
	$hn= "localhost";
	$usrn="PHPizza";
	$pw="pizzatimeguy";
	$db="ngycp";
    */
	//Server connect 
	$hn= "localhost";
	$un = "id16516957_ngycpadmin";
	$pw = "(H65czkoF^hLvGNp";
	$db = "id16516957_ngycp";
	
	$conn=new mysqli($hn, $un, $pw, $db);
	if($conn->connect_error) die("fatal error on connecting to database. ");
	return $conn;
}



?>