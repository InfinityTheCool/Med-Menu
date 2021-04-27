<?php
	$dir=dirname(dirname(__FILE__)); //seeks to the folder one level up
	require_once $dir."/sqlsts.php";
	require_once $dir.'/dbops.php';

	$conn=connect_db();

	if(isset($_GET['PersonFN']))
	{
		$partName= sanitize_my_sql($conn, $_GET['PersonFN']);
		$field="PersonFN";
	}
	else if(isset($_GET['PersonLN']))
	{
		$partName=sanitize_my_sql($conn, $_GET['PersonLN']);
		$field="PersonLN";
	}
	$query="SELECT DISTINCT $field FROM tblPeople 
		         WHERE $field like \"$partName%\" 
		         ORDER BY $field";
	if(isset($_GET['need']))
	{
		$field="PersonLN";
		$fieldFN="PersonFN";
		$query="SELECT DISTINCT $field FROM tblPeople 
		         WHERE $fieldFN like \"$partName%\" 
		         ORDER BY $field";
	}
	else if(isset($_GET['hasDOB']) ) //handles querying db for searching people
	{
		$PersonFN = sanitize_my_sql($conn, $_GET['PersonFN']);
		$PersonLN = sanitize_my_sql($conn, $_GET['PersonLN']);
		$query = "SELECT tblCadets.CadetID, tblPeople.PersonID, tblPeople.PersonFN, tblPeople.PersonLN FROM tblPeople JOIN tblCadets ON tblPeople.PersonID=tblCadets.fkPersonID WHERE PersonFN = \"$PersonFN\" AND PersonLN = \"$PersonLN\"";
		if($_GET['PDOB']!="")//if there is a dob passed, append it to the WHERE clause
		{
			$d = sanitize_my_sql($conn, $_GET['PDOB']);
		    $date = date("Y-m-d", strtotime($d) );
			$query .= " AND date(PDOB)=\"$date\"";
		}
	}
	
	$names=array();
	
	//get a numerical array of the query results
	$arr=getResultFromTable($conn,$query);

	//for when personsearch is called to search for people and their PersonID
	if(isset($_GET['isTotalSearch']) )
	{
		echo json_encode($arr); //sends the results array to the requesting function
	}
	else //used when updating the suggestions dropdown
	{
		foreach($arr as $record)
		{
		 array_push($names,$record["$field"]);
		}
		echo json_encode($names);
	}
	$conn->close();
?>
