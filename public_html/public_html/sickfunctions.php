<?php
function showSickCall($row,$i,$classdetailid, $rows)
{
      require_once 'sqlsts.php';
      $conn=connectDB();
      $MedSickCallID=$row['MedSickCallID'];
      $SickCallDate=$row['SickCallDate'];
      $SickCallDate = date("Y-m-d", strtotime($SickCallDate) );
      $WasPassIssued=$row['WasPassIssued'];
      $SickCallType=$row['SickCallType'];
      $WasDoctorVisit=$row['WasDoctorVisit'];
      $show1="";
      $show2="";
      if($WasDoctorVisit==0){
          $show1="selected";
      }
      else{
          $show1="";
      }
      if($WasPassIssued==0){
          $show2="selected";
      }
      else{
          $show2="";
      }
      $DoctorVisitDate=$row['DoctorVisitDate'];
      $DoctorVisitDate = date("Y-m-d", strtotime($DoctorVisitDate) );
      $SickCallDiagnosis=$row['SickCallDiagnosis'];
      $SickCallMedicine=$row['SickCallMedicine'];
      $SickCallReason=$row['SickCallReason'];
      $SickCallHeight=$row['SickCallHeight'];
      $SickCallWeight=$row['SickCallWeight'];
      $Temperature=$row['Temperature'];
      $BP=$row['BP'];
      $Pulse=$row['Pulse'];
      $MedSickCallID=$row['MedSickCallID'];
      $Respirations=$row['Respirations'];
      $SOAPNoteID=$row['fkSOAPNoteID'];
      $ClassDetailID=$classdetailid;

      $read4="SELECT tblSOAPNotes.* 
      FROM tblSOAPNotes 
      JOIN tblMedSickCalls ON tblSOAPNotes.fkMedSickCallID=tblMedSickCalls.MedSickCallID
      WHERE MedSickCallID=\"$MedSickCallID\"";
      $result4=$conn->query($read4);
      if(!$result4){
        echo "query 4 is not correct";
        die("fatal error");
      }
      $row2=$result4->fetch_array(MYSQLI_ASSOC);
      $SOAPNoteID=$row2['SOAPNoteID'];
      $SubjectiveObjectiveSummery=$row2['SubjectiveObjectiveSummery'];
      $PlanSummery=$row2['PlanSummery'];
      $SOAPFilePath=$row2['SOAPFilePath'];
      

	echo <<<_END
<form id="form$i">
  <div class="form-group row">
    <label for="MedSickCallID" class="col-2 col-form-label">Sick Call ID</label> 
    <div class="col-1">
      <h4 id="MedSickCallID$i" name="MedSickCallID" placeholder="$MedSickCallID" type="text" disabled class="form-control">$MedSickCallID</h4>
    </div>
  </div>
  <div class="form-group row">
    <label for="SickCallDate" class="col-2 col-form-label">Sick Call Date</label> 
    <div class="col-2">
      <input id="SickCallDate$i" name="SickCallDate" value="$SickCallDate" type="date" disabled class="form-control">
    </div>
    </div>
   <div class="form-group row"> 
    <label for="WasDoctorVisit" class="col-0 col-form-label">Was Doctor Visit</label>
    <div class="col-3">
    <select class="col-4 form-control" name="WasDoctorVisit" id="WasDoctorVisit$i" disabled>
    <option value="1" onclick="selectyn(this,'WasDoctorVisit$i')">Yes</option>
    <option value="0" $show2 onclick="selectyn(this,'WasDoctorVisit$i')">No</option>
    </select>
      <input id="WasDoctorVisit$i" name="WasDoctorVisit" value="$WasDoctorVisit" type="text" hidden disabled class="form-control">
    </div>
    <label for="WasPassIssued" class="col-0 col-form-label">Was Pass Issued</label> 
    <div class="col-4">
    <select class="col-4 form-control" name="WasPassIssued" id="WasPassIssued$i" disabled>
    <option value="1" onclick="selectyn(this,'WasPassIssued$i')">Yes</option>
    <option value="0" $show1 onclick="selectyn(this,'WasPassIssued$i')">No</option>
    </select>
      <input id="WasPassIssued$i" name="WasPassIssued" value="$WasPassIssued" type="text" hidden disabled class="form-control">
    </div>
    </div>
    <div class="form-group row">
    <label for="SickCallType" class="col-2 col-form-label">Sick Call Type</label> 
    <div class="col-2">
      <option id = "SickCallTypewatcher$i" value = 1 hidden onchange = "tlkpDropdown('SickCallType', $i, 'SickCallType', 'tlkpSickCallType', '$SickCallType')"></option>
      <input id="SickCallType$i" name="SickCallType" value="$SickCallType" type = "hidden">
      <select id="SickCallTypeselect$i" name="SickCallTypeselect" value="$SickCallType" type="text" disabled class="form-control" onchange = "selectTheValue(this.selectedIndex, 'SickCallType', $i)"> </select>
      <script type = "text/javascript"> tlkpDropdown('SickCallType', $i, 'SickCallType', 'tlkpSickCallType', '$SickCallType');</script>
    </div>

    <label for="DoctorVisitDate" class="col-2 col-form-label">Doctor Visit Date</label> 
    <div class="col-2">
      <input id="DoctorVisitDate$i" name="DoctorVisitDate" value="$DoctorVisitDate" type="date" disabled class="form-control">
    </div>

    </div>
    <div class="form-group row">
      <label for="SickCallDiagnosis" class="col-2 col-form-label">Sick Call Diagnosis</label> 
      <div class="col-10">
        <input id="SickCallDiagnosis$i" name="SickCallDiagnosis" value="$SickCallDiagnosis" type="text" disabled class="form-control">
      </div>
    </div>

  <div class="form-group row">
    <label for="SickCallMedicine$i" class="col-2 col-form-label">Sick Call Medicine</label> 
    <div class="col-10">
      <input id="SickCallMedicine$i" name="SickCallMedicine" value="$SickCallMedicine" type="text" disabled class="form-control">
    </div>
  </div>

  <div class="form-group row">
    <label for="SickCallReason$i" class="col-2 col-form-label">Sick Call Reason</label> 
    <div class="col-10">
      <input id="SickCallReason$i" name="SickCallReason" value="$SickCallReason" type="text" disabled class="form-control">
    </div>
  </div>

  <div class="form-group row">
    <label for="SickCallHeight$i" class="col-2 col-form-label">Sick Call Height</label> 
    <div class="col-1">
      <input id="SickCallHeight$i" name="SickCallHeight" value="$SickCallHeight" type="text" disabled class="form-control">
    </div>

    <label for="SickCallWeight$i" class="col-2 col-form-label">Sick Call Weight</label> 
    <div class="col-1">
      <input id="SickCallWeight$i" name="SickCallWeight" value="$SickCallWeight" type="text" disabled class="form-control">
    </div>

    <label for="Temperature$i" class="col-2 col-form-label">Temperature</label> 
    <div class="col-1">
      <input id="Temperature$i" name="Temperature" value="$Temperature" type="text" disabled class="form-control">
    </div>
  </div>
  
  <div class="form-group row">
    <label for="BP$i" class="col-2 col-form-label">Blood Pressure</label> 
    <div class="col-1">
      <input id="BP$i" name="BP" value="$BP" type="text" disabled class="form-control">
    </div>
    <label for="Pulse$i" class="col-2 col-form-label">Pulse</label> 
    <div class="col-1">
      <input id="Pulse$i" name="Pulse" value="$Pulse" type="text" disabled class="form-control">
    </div>

  </div>

    <div class="form-group row">
    <div class="offset-1 col-1">
      <button type="button" id="sickedit$i" class="btn btn-primary" onclick="sickundisable($i)">EDIT</button>
    </div>
    <div class="col-1">
      <button type="button" id="sickdelete$i" class="btn btn-primary" hidden onclick="deletesick($MedSickCallID, $rows)">DELETE</button>
    </div>
    <div class="col-1">
      <button type="button" id="sickupdate$i" class="btn btn-primary" hidden onclick="updatesick($MedSickCallID, $i, $rows)">UPDATE</button>
    </div>
    <div class="col-1">
      <button type="button" id="sickcancel$i" class="btn btn-primary" hidden onclick="sickdisable($i)">CANCEL</button>
    </div>
    <div class="form-group row">
      <label for="SubjectiveObjectiveSummery" class="col-2 col-form-label">Subjective Objective Summery</label> 
      <div class="col-10">
        <input id="SubjectiveObjectiveSummery$i" name="SubjectiveObjectiveSummery" value="$SubjectiveObjectiveSummery" type="text" disabled class="form-control">
      </div>
    </div>
    <div class="form-group row">
      <label for="PlanSummery" class="col-2 col-form-label">Plan Summery</label> 
      <div class="col-10">
        <input id="PlanSummery$i" name="PlanSummery" value="$i PlanSummery" type="text" disabled class="form-control">
      </div>
    </div>
    <div class="form-group row">
      <label for="SAOPFilepath" class="col-2 col-form-label">SAOP File Path</label> 
      <div class="col-10">
        <input id="SAOPFilepath$i" name="SAOPFilepath" value="SAOPFilepath" type="text" disabled class="form-control">
      </div>
    </div>
    </div>

</form>
_END;
}
#Dennis changed line 182 and line 176 to fix errors with $iPlanSummery being treated as one word and $SAOPFilepath being treated as a variable
?> 