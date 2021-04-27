<?php
/*
Group: James Pangia, Dennis Parkman, Seth Rozelle
calls sickcallform_main() from sickcallform.php to reload the sick call info menu asynchronously
*/

$dir=dirname(dirname(__FILE__)); //seeks to the folder one level up
require_once $dir."/sickcallform.php";

sickcallform_main();
?>