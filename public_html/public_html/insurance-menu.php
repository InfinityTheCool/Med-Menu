<?php
if(session_status() == PHP_SESSION_NONE)
{
  session_start();
}

function insurance_main()
{
    require_once 'sqlstuff.php';
    require_once 'sqlsts.php';
    require_once 'allergyfunc.php';

    
    
    if(isset($_SESSION['PersonID']))
    {
    $conn = connect_db();
    if(!$conn)
    {
      die("failed on DB connection");
    }
    $PersonID = $_SESSION['PersonID'];
    
    //personID->cadetID
    $query = "SELECT CadetID FROM tblCadets WHERE fkPersonID = $PersonID"; //what about if there are multiple cadet ids to the same personID?
    $result = $conn->query($query);
    if(!$result)
    {
      die("fatal error");
    }
    $arr=$result->fetch_array(MYSQLI_ASSOC);
    $CadetID = $arr['CadetID'];
    
    
    //cadetID->classDetailID
    $query = "SELECT ClassDetailID FROM tblClassDetails WHERE fkCadetID = $CadetID";
    $result = $conn->query($query);
    if(!$result)
    {
      die("fatal error");
    }
    $arr=$result->fetch_array(MYSQLI_ASSOC);
    $ClassDetailID = $arr['ClassDetailID'];
    
    //classDetailID->medInsurance
    //fields to CRUD:
    // InsuranceType, PolicyNumber, GroupNumber, PolicyExpDate
    // PolicyHolderName, PolicyHolderRelationship, CopayInfo
    // InsCoName, InsCoAddress, InsCoAddress2
    // InsCoCity, InsCoState, InsCoZIP
    // InsCoPhone, InsCoFax
    $query = "SELECT * FROM tblMedInsurance WHERE fkClassDetailID = $ClassDetailID";
    $result = $conn->query($query);
    $conn->close();
    if(!$result)
    {
      die("fatal error");
    }
    $rows = $result->num_rows;
    if($rows != 0)
    {
        $pid = $_SESSION['PersonID'];

echo <<<_END
<form>
    <label id="hiddennorecord"></label>
    <input type="hidden" id="PersonID" name="PersonID" value=$pid>
    
    <label id="existinginsurance"></label>
    
    <br>
    
    <label>Type</label>
    <label for="Type"></label>
    
    <select id="Type">
        <option value="Medical">Medical</option>
        <option value="Other">Other</option>
    </select>
    <label>Policy Number</label>
    <input type="text" id="PolicyNumber" name="PolicyNumber" required="required">
    <label>Group Number</label>
    <input type="text" id="GroupNumber" name="GroupNumber" required="required">
    <label>Policy Expiration Date</label>
    <input type="text" id="PolicyExpDate" name="PolicyExpDate" required="required">
    
    <br>
    
    <label>Policy Holder Name</label>
    <input type="text" id="PolicyHolderName" name="PolicyHolderName" required="required">
    <label>Relationship</label>
    <input type="text" id="PolicyHolderRelationship" name="PolicyHolderRelationship" required="required">
    <label>Co-Pay</label>
    <input type="text" id="CopayInfo" name="CopayInfo" required="required">
                  
    <br>
    
    <label>Insurance Company</label>
    <input type="text" id="InsCoName" name="InsCoName" required="required">
    <label>Address</label>
    <input type="text" id="InsCoAddress" name="InsCoAddress" required="required">
    <label>Address Line2</label>
    <input type="text" id="InsCoAddress2" name="InsCoAddress2" required="required">
    
    <br>
    
    <label>City</label>
    <input type="text" id="InsCoCity" name="InsCoCity" required="required">
    <label>State</label>
    <input type="text" id="InsCoState" name="InsCoState" required="required">
    <label>Zip</label>
    <input type="text" id="InsCoZip" name="InsCoZip" required="required">
    
    <br>
    
    <label>Phone</label>
    <input type="text" id="InsCoPhone" name="InsCoPhone" required="required">
    <label>Fax</label>
    <input type="text" id="InsCoFax" name="InsCoFax" required="required">
    
    <br>
                    
    
    
    <button type="button" class="btn btn-primary" onclick = "insertInsurance(this)">Insert</button>
    <button type="button" class="btn btn-primary" onclick = "updateInsurance(this)">Update</button>
    <button type="button" class="btn btn-primary" onclick = "viewInsurance(this)">View</button>
    <button type="button" class="btn btn-primary" onclick = "deleteInsurance(this)">Delete</button>
    
    
    
    
    <input type="hidden" id="InsuranceType" name="InsuranceType" value=$pid>
    <input type="hidden" id="MedInsuranceID" name="MedInsuranceID" value=$pid>
    <input type="hidden" id="PrimaryHCP" name="PrimaryHCP" value=$pid>
    <input type="hidden" id="fkClassDetailID" name="fkClassDetailID" value=$pid>
    
</form>

<script type="text/javascript" src="./javascript/insurancesearch.js"></script>
_END;
    }
    else
    {
        echo "No insurance form";
    }
      
  } //end if
  else
  {
    echo "No cadet selected";
  }
}
?>






