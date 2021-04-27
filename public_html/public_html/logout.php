<?php

/*
Author: James Pangia
CSCI 3610-01B
the page to log out and destroy a session
*/
    session_start();
    $_SESSION = array();
    setcookie(session_name(), '', time() - 2592000, '/');
    session_destroy();

      header("Location:index.php?loggedOut=Logged Out");
?>