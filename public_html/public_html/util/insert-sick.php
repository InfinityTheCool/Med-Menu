<?php
	$dir=dirname(dirname(__FILE__)); //seeks to the folder two levels up
    require_once $dir."/sqlstuff.php";
    require_once $dir."/sqlsts.php";
    $conn=connectDB();
    $classdetailid=sanitize_my_sql($conn, $_GET['ClassDetailID']);
	$insert="INSERT INTO tblMedSickCalls(fkClassDetailID) VALUES (\"$classdetailid\")";
	$result=$conn->query($insert);
	if(!$result){
      echo "insert query is not correct";
      die("fatal error");
    }

    echo json_encode($result);
    $conn->close();
?>