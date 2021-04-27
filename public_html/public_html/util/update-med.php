<?php
	$dir=dirname(dirname(__FILE__)); //seeks to the folder two levels up
    require_once $dir."/sqlstuff.php";
    require_once $dir."/sqlsts.php";
    $conn=connectDB();
    $medID=sanitize_my_sql($conn, $_GET['MedID']);
    $data=json_decode($_GET['data']);
    
    $med=sanitize_my_sql($conn, $data[0]);//["medname"];
    $dose=sanitize_my_sql($conn, $data[1]);//["dose"];
    $medtype=sanitize_my_sql($conn, $data[2]);//["medtype"];
    $frequency=sanitize_my_sql($conn, $data[3]);//["frequency"];
    $takenwhen=sanitize_my_sql($conn, $data[4]);//["takenwhen"];
    $medstartdate=sanitize_my_sql($conn, $data[5]);//["medstartdate"];
    $medenddate=sanitize_my_sql($conn, $data[6]);//["medenddate"];
    $mednote=sanitize_my_sql($conn, $data[7]);//["mednote"];
    $update="UPDATE tblMeds SET ";
    if($med){
      $update.="MedName=\"$med\"";
    }
    if($dose){
      $update.=", Dose=\"$dose\"";
    }
    if($medtype){
      $update.=", fkMedType=\"$medtype\"";
    }
    if($frequency){
      $update.=", Frequency=\"$frequency\"";
    }
    if($takenwhen){
      $update.=", TakenWhen=\"$takenwhen\"";
    }
    if($medstartdate){  
      $medstartdate = date("Y-m-d", strtotime($medstartdate) );
      $update.=", MedStartDate=\"$medstartdate\"";
    }
    if($medenddate){
      $medenddate = date("Y-m-d", strtotime($medenddate) );
      $update.=", MedEndDate=\"$medenddate\"";
    }
    if($mednote){
      $update.=", MedNote=\"$mednote\"";
    }
    $update.=" WHERE MedID=$medID";
    
    echo "$update";
	 $result=$conn->query($update);
	if(!$result){
      echo "update query is not correct";
      die("fatal error");
    }
    
    echo json_encode($result);
    $conn->close();
?>