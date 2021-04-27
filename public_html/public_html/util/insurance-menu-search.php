<?php
    session_start();
    $dir=dirname(dirname(__FILE__)); //seeks to the folder two levels up
    require_once $dir."/sqlsts.php";
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
    if(!$result)
    {
      die("fatal error");
    }
    $rows = $result->num_rows;
    
    if($rows==1)
        {
            $arr=$result->fetch_array(MYSQLI_ASSOC);
            
            echo json_encode($arr);
        }
        else
        {
            // No medical records
            // Update hidden form element
            $error["error"] = true;
            #echo json_encode($error);
            echo("Error");
        }
    
?>