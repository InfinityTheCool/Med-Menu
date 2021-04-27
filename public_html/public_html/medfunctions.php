<?php
function show($row,$i,$classdetailid, $rows)
{
	    $medname=$row['MedName'];
      $dose=$row['Dose'];
      $medtype=$row['fkMedType']; //tlkp
      $frequency=$row['Frequency']; //tlkp
      $takenwhen=$row['TakenWhen']; //tlkp
      $medstartdate=$row['MedStartDate'];
      $medstartdate=date("Y-m-d", strtotime($medstartdate) ); //format the date as a string in YYYY-mm-dd format
      $medenddate=$row['MedEndDate'];
      $medenddate=date("Y-m-d", strtotime($medenddate) ); //format the date as a string in YYYY-mm-dd format
      $mednote=$row['MedNote']; 
      $medID=$row['MedID'];

	echo <<<_END
<form id="medform$i">
  <div class="form-group row">
    <label for="medID" class="col-1 col-form-label">Med ID</label> 
    <div class="col-2">
      <h4 id="medID$i" name="medID" placeholder="$medID" type="text" disabled = "disabled" class="form-control">$medID</h4>
    </div>
  </div>
  <div class="form-group row">
    <label for="medname" class="col-1 col-form-label">Med Name</label> 
    <div class="col-2">
      <input id="medname$i" name="medname" value="$medname" type="text" disabled class="form-control">
    </div>

    <label for="dose" class="col-0 col-form-label">Dose</label> 
    <div class="col-2">
      <input id="dose$i" name="dose" value="$dose" type="text" disabled class="form-control">
    </div>
 
    <label for="medtype" class="col-0 col-form-label">Med Type</label> 
    <div class="col-2">
      <option id = "medtypewatcher$i" value = 1 hidden onchange = "tlkpDropdown('medtype', $i, 'MedType', 'tlkpMedType', '$medtype')"></option>
      <input id="medtype$i" name="medtype" value="$medtype" type = "hidden">
      <select id="medtypeselect$i" name="medtypeselect" value="$medtype" type="text" disabled class="form-control" onchange = "selectTheValue(this.selectedIndex, 'medtype', $i)"> </select>
      <script type = "text/javascript"> tlkpDropdown('medtype', $i, 'MedType', 'tlkpMedType', '$medtype');</script>
    </div>
  </div>
  <div class="form-group row">
    <label for="frequency" class="col-1 col-form-label">Frequency</label> 
    <div class="col-2">
      <option id = "frequencywatcher$i" value = 1 hidden onchange = "tlkpDropdown('frequency', $i, 'MedFrequency', 'tlkpMedFrequency', '$frequency')"></option>
      <input id="frequency$i" name="frequency" value="$frequency" type="hidden">
      <select id="frequencyselect$i" name="frequencyselect" value="$frequency" type="text" disabled class="form-control" onchange = "selectTheValue(this.selectedIndex, 'frequency', $i)"> </select>
      <script type = "text/javascript"> tlkpDropdown('frequency', $i, 'MedFrequency', 'tlkpMedFrequency', '$frequency');</script>
    </div>

    <label for="takenwhen" class="col-1 col-form-label">Taken When</label> 
    <div class="col-2">
      <option id = "takenwhenwatcher$i" value = 1 hidden onchange = "tlkpDropdown('takenwhen', $i, 'TakenWhen', 'tlkpTakenWhen', '$takenwhen')"></option>
      <input id="takenwhen$i" name="takenwhen" value="$takenwhen" type="hidden">
      <select id="takenwhenselect$i" name="takenwhenselect" value="$takenwhen" type="text" disabled class="form-control" onchange = "selectTheValue(this.selectedIndex, 'takenwhen', $i)"> </select>
      <script type = "text/javascript"> tlkpDropdown('takenwhen', $i, 'TakenWhen', 'tlkpTakenWhen', '$takenwhen');</script>
    </div>
  </div>
  <div class="form-group row">
    <label for="startdate" class="col-1 col-form-label">Start Date</label> 
    <div class="col-2">
      <input id="medstartdate$i" name="startdate" value="$medstartdate" type="date" disabled class="form-control">
    </div>

    <label for="enddate" class="col-1 col-form-label">End Date</label> 
    <div class="col-2">
      <input id="medenddate$i" name="enddate" value="$medenddate" type="date" disabled class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label for="mednote$i" class="col-1 col-form-label">Med Note</label> 
    <div class="col-6">
      <input id="mednote$i" name="mednote" value="$mednote" type="text" disabled class="form-control">
    </div>
  </div> 

    <div class="form-group row">
    <div class="offset-1 col-1">
      <button type="button" id="mededit$i" class="btn btn-primary" onclick="undisablemed($i)">EDIT</button>
    </div>
    <div class="col-1">
      <button type="button" id="meddelete$i" class="btn btn-primary" hidden onclick="deletemed($medID, $rows)">DELETE</button>
    </div>
    <div class="col-1">
      <button type="button" id="medupdate$i" class="btn btn-primary" hidden onclick="updatemed($medID, $i, $rows)">UPDATE</button>
    </div>
    <div class="col-1">
      <button type="button" id="medcancel$i" class="btn btn-primary" hidden onclick="disablemed($i)">CANCEL</button>
    </div>

    </div>
  </form>

_END;
}

?>