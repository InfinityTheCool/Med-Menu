<?php
 function getPeople($conn, $fn,$ln)
 {
 	$query="SELECT * FROM tblPeople WHERE PersonFN= \"$fn\" AND PersonLN=\"$ln\"";
 	$arr=getResultFromTable($conn,$query);
 	return $arr;
 }

 function getPersonByID($conn, $personID)
 {
 	$query="SELECT * FROM tblPeople WHERE PersonID=\"$personID\"";
 	$arr=getResultFromTable($conn,$query);
 	return $arr;
 }
 function getResultFromTable($conn, $query)
{
	$arr=array();
	$result=$conn->query($query);
	if(!$result) die("Fatal Error on query");

	$rows=$result->num_rows;
	for($i=0;$i<$rows;$i++)
	{
		array_push($arr, $result->fetch_assoc());
    }
    
    $result->free();
    return $arr;

}
function getColumnNames($conn,$table)
{
	$query="SELECT COLUMN_NAME AS name FROM information_schema.columns WHERE table_name=\"$table\"";
	$arr=getResultFromTable($conn, $query);
	return $arr;


}

?>