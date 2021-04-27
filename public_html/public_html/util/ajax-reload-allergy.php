<?php
/*
Group: James Pangia, Dennis Parkman, Seth Rozelle
calls medform_main() from medform.php to reload the medical info menu asynchronously
*/

$dir=dirname(dirname(__FILE__)); //seeks to the folder one level up
require_once $dir."/allergy.php";

allergy_main();
?>