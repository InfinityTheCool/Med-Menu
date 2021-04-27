<?php
	$dir=dirname(dirname(__FILE__)); //seeks to the folder two levels up
    require_once $dir."/sqlstuff.php";
    require_once $dir.'/sqlsts.php';
    $conn=connectDB();
    $MedID=sanitize_my_sql($conn, $_GET['MedID']);
    
  $delete="DELETE FROM tblMeds WHERE MedID=$MedID";
  $result=$conn->query($delete);
  if(!$result){
      echo "detele query is not correct";
      die("fatal error");
}

    echo json_encode($result);
    $conn->close();
?>