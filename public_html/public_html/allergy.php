<?php
if(session_status() == PHP_SESSION_NONE)
{
  session_start();
}

function allergy_main()
{
    require_once 'sqlstuff.php';
    require_once 'sqlsts.php';
    require_once 'allergyfunc.php';

    $fn = "ERROR";//"Alexander";
    $ln = "NO_CADET_SELECTED";//"Miller";
    $conn=connectDB();
    if(isset($_POST['PersonFN']) && isset($_POST['PersonLN']) )
    {
      $fn=sanitize_my_sql($conn, $_POST['PersonFN']);
      $ln=sanitize_my_sql($conn, $_POST['PersonLN']);
    }
    
    if(!$conn)
    {
      echo "connection failed, try again later!";
      die("failed on DB connection");
    }
    $read="SELECT tblPeople.PersonFN, tblPeople.PersonLN, tblCadets.CadetID FROM tblCadets JOIN tblPeople ON tblCadets.fkPersonID=tblPeople.PersonID WHERE PersonFN=\"$fn\" AND PersonLN=\"$ln\"";
    $result1=$conn->query($read);
    if(!$result1)
    {
      echo "query 1 is not correct";
      die("fatal error");
    }
    $row=$result1->fetch_array(MYSQLI_ASSOC);
    $personfirst=$row['PersonFN'];
    $personlast=$row['PersonLN'];
    
    if(isset($_SESSION['CadetID']))
    {
      $cadetid=sanitize_my_sql($conn, $_SESSION['CadetID']);//$row['CadetID'];

      $read2="SELECT tblClassDetails.ClassDetailID FROM tblClassDetails JOIN tblCadets ON tblCadets.CadetID=tblClassDetails.fkCadetID WHERE CadetID=\"$cadetid\"";
      $result2=$conn->query($read2);
      if(!$result2)
      {
        echo "query 2 is not correct";
        die("fatal error");
      }
      $row=$result2->fetch_array(MYSQLI_ASSOC);
      $classdetailid=$row['ClassDetailID'];

      $read3="SELECT tblMedAllergies.MedAllergyID, tblMedAllergies.AllergyType, tblMedAllergies.AllergyNote FROM tblMedAllergies JOIN tblClassDetails ON tblMedAllergies.fkClassDetailID=tblClassDetails.ClassDetailID WHERE ClassDetailID=\"$classdetailid\"";
      $result3=$conn->query($read3);
      if(!$result3)
      {
        echo "query 3 is not correct";
        die("fatal error");
      }
      $rows=$result3->num_rows;

      if($rows == 0)
      {
        echo "Cadet has no allergies on file. Click below to create entry.";
      }

      for($i=0;$i<$rows;$i++)
      {
          $row=$result3->fetch_array(MYSQLI_ASSOC);
          showallergies($row, $i, $classdetailid, $rows);
      }

echo <<<_END
        <form>
        <div class="form-group row">
            <div class="col-1">
          <button type="button" id="allergyinsert" class="btn btn-primary" onclick="insertallergy($classdetailid, $rows)">INSERT</button>
          </div>
        </div>
      </form>
_END;
  } //end if
  else
  {
    echo "No cadet selected";
  }
  $conn->close();
}
?>