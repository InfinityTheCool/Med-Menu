<?php
/*
Author: James Pangia
CSCI 3610-01B
NGYCP Project
handles admin login validation
cannot output any html except through die because of how headers are configured
in the production server
*/

  require_once 'sqlsts.php';

  //connect to the db (function in sqlsts.php)
  $conn = connect_db();
  if(!$conn)
  {
    //echo "Connection failed. Try again later.<br>";
    die("failed on DB connection");
  }

    $Login = sanitize_my_sql($conn, $_POST['Login']);
    $Password = sanitize_my_sql($conn, $_POST['Password']);

    //write a query to fetch user id
    $query = "SELECT UserID FROM tblUsers WHERE Login=\"$Login\" AND Password=SHA1(\"$Password\")";

    //submit the query to the db
    $result = submit_query($conn, $query);
    $rows = $result->num_rows;
    //check for successful query (and that there aren't duplicate accounts)
    //if get exactly one account from query, everything is right, so start a session
    if($rows == 1)
    {
      //get UserID from last query
      $UserID = ($result->fetch_array(MYSQLI_ASSOC))['UserID'];

      //fetch the UserGroupID from tblUserPermission
      $query = "SELECT fkUserGroupID FROM tblUserPermissions WHERE fkUserID=$UserID";
      //submit the query to the db
      $result = submit_query($conn, $query);
      $rows = $result->num_rows;

      //if the user has at least one user group associated
      if($rows >= 1)
      {
          //save fkUserGroupID
          $fkUserGroupID = ($result->fetch_array(MYSQLI_ASSOC))['fkUserGroupID'];

          //fetch the groupids for siteAdmin and medical groups
          $query = "SELECT UserGroupID FROM tblUserGroups WHERE UserGroup=\"siteAdmin\" OR `UserGroup`=\"medical\"";
          $result = submit_query($conn, $query);
          $rows = $result->num_rows;

          //loop through the array of results to check group id equality
          $isValidUser = FALSE;
          for($i = 0; $i < $rows; $i++)
          {
              $row = $result->fetch_array(MYSQLI_ASSOC);
              if($row['UserGroupID'] == $fkUserGroupID)
              {
                  $isValidUser = TRUE;
                  break;
              }
          }

          if(!$isValidUser)
          {
              //pass information to web page through GET
              header("Location:index.php?msg=Invalid+User+Permissions!");
          }
          else
          {
            session_start();
            $_SESSION['Login'] = $Login;
            $_SESSION['Password'] = $Password;
            header("Location:med-menu.php");
          }
      }
      else
      {
          //pass information to web page through GET
          header("Location:index.php?msg=No+Group+ID");
      }
    }
    else
    {
      //pass information to web page through GET
      header("Location:index.php?msg=Login+Failed");
    }

?>