<?php
/*
Author: James Pangia
Date created: 2-11-21
CSCI 3610-01B
A file with sql-related functions for the pizza store project
*/

/*
	connects to the pizza database
	returns:
			a connection object created by a mysqli constructor
*/
function connect_db()
{
	//db server for local pc
// 	$hn = "localhost";
// 	$un = "phpUser2";
// 	$pw = "accessDB@php";
// 	$db = "ngycp";

	//db server for production server 
	$hn = "localhost";
	$un = "id16516957_ngycpadmin";
	$pw = "(H65czkoF^hLvGNp";
	$db = "id16516957_ngycp";

	$conn = new mysqli($hn, $un, $pw, $db);
	if($conn->connect_error) die("Fatal Error on connecting to database.");

	return $conn;
}

/**
 * submits the query to the database
 * @param  $conn  the connection object associated with the target database
 * @param  $query the query to submit
 * @return a result object from the query if the query does not cause an error
 */
function submit_query($conn, $query)
{
	//submit the query to the db
    $result = $conn->query($query);
    //check for failure
    if(!$result)
    {
      die("fatal error");
    }

    return $result;
}

/*
	sanitizes user/third-party input before sending it
	to the database (from Nixon's "Learning PHP, MySQL & JavaScript")
	paramters:
		$connection: a connection to a database generated from a mysqli constructor
		$var: the string variable to sanitize against SQL injection
	returns: 
		the sanitized string
 */
function sanitize_my_sql($connection, $var)
{
	$var = $connection->real_escape_string($var);
	$var = sanitizeString($var);
	return $var;
}

/*
	Sanitizes user/third-party input for use in html 
	(from Nixon's "Learning PHP, MySQL & JavaScript")
	paramters:
		$var: the string to sanitize
	returns: 
		the sanitized string
*/
function sanitizeString($var)
{
	if(get_magic_quotes_gpc() )
	{
		$var = stripslashes($var);
	}
	$var = strip_tags($var);
	$var = htmlentities($var);
	return $var;
}

?>