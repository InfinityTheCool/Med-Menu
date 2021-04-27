<?php

	$dir=dirname(dirname(__FILE__)); //seeks to the folder two levels up
    require_once $dir."/sqlstuff.php";
    require_once $dir."/sqlsts.php";
    
    $conn=connectDB();
    
    $MedAllergyID=sanitize_my_sql($conn, $_GET['MedAllergyID']);
    $data=json_decode($_GET['data']);
    $AllergyType=sanitize_my_sql($conn, $data[0]);
    $AllergyNote=sanitize_my_sql($conn, $data[1]);
    
    $update="UPDATE tblMedAllergies SET ";
    if($AllergyType){
      $update.="AllergyType=\"$AllergyType\"";
    }
    if($AllergyNote){
      $update.=", AllergyNote=\"$AllergyNote\"";
    }
    
    $update.=" WHERE MedAllergyID=$MedAllergyID";
	 $result=$conn->query($update);
	if(!$result){
      echo "update query is not correct";
      die("fatal error");
    }
    echo $update;
    echo json_encode($result);
    
    $conn->close();
?>