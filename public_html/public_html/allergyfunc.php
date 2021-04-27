<?php
	function showallergies($row, $i, $classdetailid, $rows){
		$MedAllergyID=$row['MedAllergyID'];
		$AllergyType=$row['AllergyType']; //tlkp
		$AllergyNote=$row['AllergyNote'];

		echo <<<_END
		<form id="allergyform$i">
    <div class="form-group row">
      <label for="MedAllergyID" class="col-1 col-form-label">Allergy ID</label> 
      <div class="col-2">
        <h4 id="MedAllergyID$i" name="MedAllergyID" placeholder="$MedAllergyID" type="text" disabled = "disabled" class="form-control">$MedAllergyID</h4>
      </div>
    </div>
    <div class="form-group row">
      <label for="allergytype" class="col-1 col-form-label">Allergy Type</label> 
      <div class="col-2">
        <option id = "allergytypewatcher$i" value = 1 hidden onchange = "tlkpDropdown('allergytype', $i, 'AllergyType', 'tlkpAllergyType', '$AllergyType')"></option>
        <input id="allergytype$i" name="allergytype" value="$AllergyType" type = "hidden">
        <select id="allergytypeselect$i" name="allergytypeselect" value="$AllergyType" type="text" disabled class="form-control" onchange = "selectTheValue(this.selectedIndex, 'allergytype', $i)"> </select>
        <script type = "text/javascript"> tlkpDropdown('allergytype', $i, 'AllergyType', 'tlkpAllergyType', '$AllergyType');</script>
      </div>
    </div>
  <div class="form-group row">
    <label for="allergynote" class="col-1 col-form-label">Allergy Note</label> 
    <div class="col-4">
      <input id="allergynote$i" name="allergynote" value="$AllergyNote" type="text" disabled class="form-control">
    </div>
    </div>

  <div class="form-group row">
    <div class="offset-1 col-1">
      <button type="button" id="allergyedit$i" class="btn btn-primary" onclick="undisable($i)">EDIT</button>
    </div>
    <div class="col-1">
      <button type="button" id="allergydelete$i" class="btn btn-primary" hidden onclick="deleteallergy($MedAllergyID, $rows)">DELETE</button>
    </div>
    <div class="col-1">
      <button type="button" id="allergyupdate$i" class="btn btn-primary" hidden onclick="updateallergy($MedAllergyID, $i, $rows)">UPDATE</button>
    </div>
    <div class="col-1">
      <button type="button" id="allergycancel$i" class="btn btn-primary" hidden onclick="disable($i)">CANCEL</button>
    </div>
    </div>
</form>

_END;
	}
?>