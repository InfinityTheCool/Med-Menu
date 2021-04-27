<?php
/*
	Author: James Pangia
	Group: James Pangia, Dennis Parkman, Seth Rozelle
	supporting page for sending the person id from the form and display the person data
 */
$dir=dirname(dirname(__FILE__)); //seeks to the folder one level up
require_once $dir."/sqlsts.php";
require_once $dir.'/dbops.php';

if(isset($_GET['PersonID']) && isset($_GET['CadetID']))
{
	$conn = connect_db();
	$PersonID = sanitize_my_sql($conn, $_GET['PersonID']);
	$CadetID = sanitize_my_sql($conn, $_GET['CadetID']);

	//check if tblPeople.PRace is in rlkpRace.RaceID
	$query = "SELECT tblPeople.PRace FROM tblPeople JOIN tlkpRace ON tblPeople.PRace = tlkpRace.RaceID WHERE PersonID = \"$PersonID\"";

	$result=$conn->query($query);
	$rows=$result->num_rows;
	
    //check for
	if($rows == 0)
	{

		$query = "SELECT tblPeople.* FROM tblPeople WHERE PersonID = \"$PersonID\"";
	}
	else
	{
		//get the person info
		$query = "SELECT tblPeople.*, tlkpRace.Race FROM tblPeople JOIN tlkpRace ON tblPeople.PRace = tlkpRace.RaceID WHERE PersonID = \"$PersonID\"";
	}
	$arr=array();

	$arr = getResultFromTable($conn, $query);
	//echo to the requesting file
	echo json_encode($arr);
	
	$conn->close();
}
?>