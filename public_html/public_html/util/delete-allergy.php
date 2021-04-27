<?php
	$dir=dirname(dirname(__FILE__)); //seeks to the folder two levels up
    require_once $dir."/sqlstuff.php";
    require_once $dir."/sqlsts.php";
    $conn=connectDB();
    $MedAllergyID=sanitize_my_sql($conn, $_GET['MedAllergyID']);
  $delete="DELETE FROM tblMedAllergies WHERE MedAllergyID=$MedAllergyID";
  $result=$conn->query($delete);
  if(!$result){
      echo "detele query is not correct";
      die("fatal error");
}
    
    echo json_encode($result);
    $conn->close();
?>