<?php
session_start();
?>
<!-- 
Author: James Pangia
CSCI 3610-01B
NGYCP Project
gathers information for admin login 
-->


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="./css/styles.css">

    <title>Admin Login | NGYCP</title>
  </head>
  <body>
    <?php

    require_once 'sqlsts.php';
    //require_once 'page-format.php';

    //generate page header banner
    //pageheader('./images/logo1.jpg');

    // opening tag for making the entire page be a div of (bootstrap) class "container"
    echo "<div class = \"container\">";

    //print the page title
    echo "<h1 class = >Admin Login</h1><br>";

    //check for GET messages
    if(isset($_GET['msg']) )
    {
        $msg = sanitizeString($_GET['msg']);
        echo "<h4 class = \"text-danger\">$msg<br>Try Again</h4>";
    }
    if(isset($_GET['loggedOut']) )
    {
        $msg = sanitizeString($_GET['loggedOut']);
        echo "<h4 class = >$msg</h4>";
    }

    //show form
    echo <<< _END
    	<form action="./admin-login-handler.php" method = "POST">
		  <label for="Login">Login:</label><br>
		  <input type="Login" id="Login" name="Login"><br>
		  <label for="Password">Password:</label><br>
		  <input type="Password" id="Password" name="Password"><br><br>
		  <input type="submit" value="Login">
		</form> 
_END;

    //closing div tag for making the entire page be in a div
    echo "</div>";
    //generate the page footer
    //pagefooter();
    ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>