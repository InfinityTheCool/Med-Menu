<?php

/**
 * prints the 
 * @param  [type] $displayFN  previously submitted first name
 * @param  [type] $displayLN  previously submitted last name
 * @param  [type] $displayDOB previously submitted dob
 */
function search_person_form_main($displayFN, $displayLN, $displayDOB)
{
echo <<<_END
    <div class="container">
         
    <h1> Select Cadet</h1>
   <form method = "Post" action = "./med-menu.php">
      <label >First Name:</label><br>
      <input type="text" list="listPersonFN" id="PersonFN" name="PersonFN"  value = "$displayFN" onkeyup = "searchPersonFN(this)" required="required" ><br>
      <datalist id = "listPersonFN"></datalist>
      <label >Last Name:</label><br>
      <input type="text" list="listPersonLN" id="PersonLN" name="PersonLN"  value = "$displayLN" onkeyup = "searchPersonLN(this)" required="required" ><br>
      <datalist id = "listPersonLN"></datalist>
      <label >Date of Birth (optional):</label><br>
      <input type="date" id="PDOB" name="PDOB" value = "$displayDOB" ><br><br>
      <input type = "hidden" id = "cadetPersonIDs">
      <button type="button" class="btn btn-primary" onclick = "showPersonSearchResults(this)">Search</button>
  

      <!-- a div to display the resultant people in -->
      <div id = "nameDisplay"></div>
      
      <!-- a div to display the info on the selected person -->
      <div id = "personDisplay"></div>
  </form> 
  </div> <!-- container -->

_END;
}
?>