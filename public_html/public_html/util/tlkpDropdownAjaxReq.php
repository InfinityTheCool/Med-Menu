<?php
/*
Author: James Pangia
Group: James Pangia, Dennis Parkman, Seth Rozelle
services the tlkpDropdown js function request to fetch fields in the lookup table
 */

$dir=dirname(dirname(__FILE__)); //seeks to the folder two levels up
require_once $dir."/sqlsts.php";
require_once $dir.'/dbops.php';

$conn=connect_db();

$fieldName = sanitize_my_sql($conn, $_GET['fieldName']);
$tlkpName = sanitize_my_sql($conn, $_GET['tlkpName']);

$names=array(); //initialize an array to hold lookup table values

//need extra steps if fetching from tlkpAllergyType
if($tlkpName == "tlkpAllergyType" || $tlkpName == "tlkpallergytype")
{
	$query = "SELECT DISTINCT AllergyCategory FROM tlkpAllergyType ORDER BY AllergyCategory";
	$arr = getResultFromTable($conn, $query); //get array of associative result arrays from the query

	foreach($arr as $record)
	{
		array_push($names,$record["AllergyCategory"]);
	}
}

//query for fetching all the field values from the appropriate tlkp
$query = "SELECT $fieldName FROM $tlkpName ORDER BY $fieldName";

$arr = getResultFromTable($conn, $query); //get array of associative result arrays from the query

foreach($arr as $record)
{
	array_push($names,$record["$fieldName"]);
}

echo json_encode($names); //echo an array of the field values

$conn->close();
?>