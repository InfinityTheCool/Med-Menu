<?php
	$dir=dirname(dirname(__FILE__)); //seeks to the folder two levels up
    require_once $dir."/sqlstuff.php";
    require_once $dir."/sqlsts.php";
    $conn=connectDB();
    $MedSickCallID=sanitize_my_sql($conn, $_GET['MedSickCallID']);
    $data=json_decode($_GET['data']);
    
    $SickCallDate=sanitize_my_sql($conn, $data[0]);//["medname"];
    $WasDoctorVisit=sanitize_my_sql($conn, $data[1]);//["dose"];
    $WasPassIssued=sanitize_my_sql($conn, $data[2]);//["medtype"];
    $SickCallType=sanitize_my_sql($conn, $data[3]);//["frequency"];
    $DoctorVisitDate=sanitize_my_sql($conn, $data[4]);//["takenwhen"];
    $SickCallDiagnosis=sanitize_my_sql($conn, $data[5]);//["medstartdate"];
    $SickCallMedicine=sanitize_my_sql($conn, $data[6]);//["medenddate"];
    $SickCallReason=sanitize_my_sql($conn, $data[7]);//["mednote"];
    $SickCallHeight=sanitize_my_sql($conn, $data[8]);
    $SickCallWeight=sanitize_my_sql($conn, $data[9]);
    $Temprature=sanitize_my_sql($conn, $data[10]);
    $BP=sanitize_my_sql($conn, $data[11]);
    $Pulse=sanitize_my_sql($conn, $data[12]);
    $update="UPDATE tblMedSickCalls SET ";
    if($SickCallDate){
      $SickCallDate = date("Y-m-d", strtotime($SickCallDate) );
      $update.="SickCallDate=\"$SickCallDate\"";
    }
    if($WasDoctorVisit){
      $update.=", WasDoctorVisit=\"$WasDoctorVisit\"";
    }
    if($WasPassIssued){
      $update.=", WasPassIssued=\"$WasPassIssued\"";
    }
    if($SickCallType){
      $update.=", SickCallType=\"$SickCallType\"";
    }
   if($DoctorVisitDate){  
      $DoctorVisitDate = date("Y-m-d", strtotime($DoctorVisitDate) );
      $update.=", DoctorVisitDate=\"$DoctorVisitDate\"";
    }
    if($SickCallDiagnosis){
      $update.=", SickCallDiagnosis=\"$SickCallDiagnosis\"";
    }
    if($SickCallMedicine){
      $update.=", SickCallMedicine=\"$SickCallMedicine\"";
    }
    if($SickCallReason){
      $update.=", SickCallReason=\"$SickCallReason\"";
    }
    if($SickCallHeight){
      $update.=", SickCallHeight=\"$SickCallHeight\"";
    }
    if($SickCallWeight){
      $update.=", SickCallWeight=\"$SickCallWeight\"";
    }
    if($Temprature){
      $update.=", Temprature=\"$Temprature\"";
    }
    if($BP){
      $update.=", BP=\"$BP\"";
    }
    if($Pulse){
      $update.=", Pulse=\"$Pulse\"";
    }
    $update.=" WHERE MedSickCallID=$MedSickCallID";
    
    echo "$update";
	 $result=$conn->query($update);
	if(!$result){
      echo "update query is not correct";
      die("fatal error");
    }
    
    echo json_encode($result);
    $conn->close();
?>