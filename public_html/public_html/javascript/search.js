/**
 * Author: James Pangia
 * CSCI 3610-01B
 * person search functions for the NGYCP project
 */

function showPerson(id)
{
	//Ajax request for php to alter $_SESSION and display person info
	var ids = id.value.split("|");

	const xhr = new XMLHttpRequest(),
	    method = "GET",
	    url = "./util/post-and-show-person.php?PersonID=" + ids[0] + "&CadetID=" + ids[1];

		xhr.open(method, url, true);
		xhr.onreadystatechange = function () 
		{
		  // In local files, status is 0 upon success in Mozilla Firefox
		  if(xhr.readyState === XMLHttpRequest.DONE) 
		  {
		    var status = xhr.status;
		    if (status === 4 || (status >= 200 && status < 400)) 
		    {
		      // The request has been completed successfully
		      //sends person info to element with id personDisplay
		      var personArr = JSON.parse(this.responseText); //should get only one person record since we query by personID
		      var person = personArr[0]; //get the person record

		      var out = ``; //output variable

		      //salutation
		      if(person['PSalutation']!=null)
		      {
		      	out += person['PSalutation'] + " ";
		      }
		      //First Name
		      if(person['PersonFN']!=null)
		      {
		      	out += person['PersonFN'] + " ";
		      }
		      //Middle Name
		      if(person['PersonMN']!=null)
		      {
		      	out += person['PersonMN'] + " ";
		      }
		      //Last Name
		      if(person['PersonLN']!=null)
		      {
		      	out += person['PersonLN'] + " ";
		      }
		      out += "<br>";
		      //Address
		      if(person['PAddress']!=null)
		      {
		      	out += person['PAddress'] + " ";
		      }
		      //address2
		      if(person['PAddress2']!=null)
		      {
		      	out += person['PAddress2'] + " ";
		      }
		      out += "<br>";
		      //city
		      if(person['PCity']!=null)
		      {
		      	out += person['PCity'] + ", ";
		      }
		      //state
		      if(person['PState']!=null)
		      {
		      	out += person['PState'] + " ";
		      }
		      //zip
		      if(person['PZip']!=null)
		      {
		      	out += person['PZip'];
		      }
		      out += "<br>";
		      //county
		      if(person['PCounty']!=null)
		      {
		      	out += "County: " + person['PCounty'] + "<br>";
		      }
		      //dob
		      if(person['PDOB']!=null)
		      {
		      	out += "DOB (YYYY-mm-dd): " + person['PDOB'] + "<br>";
		      }
		      //last 4 digits of ssn
		      if(person['PSSN']!=null)
		      {
		      	out += "SSN: *****" + person['PSSN'].substring(person['PSSN'].length - 4) + "<br>"; //last 4 digits of ssn
		      }
		      //gender
		      if(person['PGender']!=null)
		      {
		      	out += "Gender: " + person['PGender'] + "<br>";
		      }
		      //race
		      if(person['PRace']!=null)
		      {
		      	out += "Race: " + person['Race'] + "<br>";
		      }
		      //ethnicity
		      if(person['PEthnicityIsHispanic']!=null)
		      {
		      	if(person['PEthnicityIsHispanic'] === 1)
		      	{
		      		out += `Ethnicity: Hispanic`;
		      	}
		      	else
		      	{
		      		out += `Ethnicity: Not Hispanic`;
		      	}
		      }
		      //display the person information in the element with id personDisplay 
		      document.getElementById("personDisplay").innerHTML = out;
		      // //display the name of the selected cadet
		      // document.getElementById("selectedInfo").innerHTML = `<h4>Currently Accessing Information For:</h4>
		      // 													   <h1> ${person['PersonFN']} ${person['PersonLN']}</h1>
		      // 													   <h4> PersonID: ${ids[0]} CadetID: ${ids[1]}`;		      
		    }
		  }
		};
		xhr.send();
}

/**
 * gets the results of a name (and optionally birthday) search and prints them
 * in an element with id nameDisplay
 * @param  id a reference to the calling element
 */
function showPersonSearchResults(id)
{
	//get fn
	var PersonFN = document.getElementById("PersonFN").value;
	//get ln
	var PersonLN = document.getElementById("PersonLN").value;
	//get DOB
	var PDOB = document.getElementById("PDOB").value;

	//query tblPeople and fetch PersonID, PersonFN, PersonLN, CadetID; display all but PersonID
	const xhr = new XMLHttpRequest(),
	    method = "GET",
	    url = `./util/personsearch.php?PersonFN=${PersonFN}&PersonLN=${PersonLN}&PDOB=${PDOB}&hasDOB=1&isTotalSearch=1`;
		xhr.open(method, url, true);
		xhr.onreadystatechange = function () 
		{
		  // In local files, status is 0 upon success in Mozilla Firefox
		  if(xhr.readyState === XMLHttpRequest.DONE) 
		  {
		    var status = xhr.status;
		    if (status === 4 || (status >= 200 && status < 400)) 
		    {
		      // The request has been completed successfully
		      var matches = JSON.parse(this.responseText); //retrieve the array of associative rows
		      var matchList = ``;
		      for(var n in matches)
		      {
		      	var ids = `${matches[n]['PersonID']}|${matches[n]['CadetID']}`
		      	matchList += `${matches[n]['PersonFN']} ${matches[n]['PersonLN']} (Cadet no: ${matches[n]['CadetID']})
		      				  <div class = "row">
		      				  	  <div class = "col-sm-5">
		      				  		<button class = "btn btn-primary btn-small" type = "button" value = "${ids}" onclick = "showPerson(this)">View Cadet</button>
		      				  	  </div>
		      				  	  <div class = "col-sm-5">
		      				  		<button class = "btn btn-primary btn-small" id = "select${ids}" type = "submit" name = "cadetIDs" value = "${ids}" >Select Cadet</button>
		      				  	  </div>
		      				  </div>
		      				  `;
		      }
		      if(matchList === "")
		      {
		      	  document.getElementById("nameDisplay").innerHTML = "No cadets match that search.";
		      	  document.getElementById("personDisplay").innerHTML = "";
		      }
		      else
		      {
			      document.getElementById("nameDisplay").innerHTML = matchList;
			      document.getElementById("personDisplay").innerHTML = "";
			  }
		      //post personID to med-menu.php; menu main functions read $_POST['PersonID'] for PersonID
		    }
		  }
		};
		xhr.send();
}

function searchPersonFN(id)
{
	var partName = id.value;
	if(partName.length >= 1)
	{
		const xhr = new XMLHttpRequest(),
	    method = "GET",
	    url = "./util/personsearch.php?PersonFN=" + partName;

		xhr.open(method, url, true);
		xhr.onreadystatechange = function () 
		{
		  // In local files, status is 0 upon success in Mozilla Firefox
		  if(xhr.readyState === XMLHttpRequest.DONE) 
		  {
		    var status = xhr.status;
		    if (status === 4 || (status >= 200 && status < 400)) 
		    {
		      // The request has been completed successfully
		      var personFNs = JSON.parse(this.responseText);
		      var opt = ``;
		      for(var n in personFNs)
		      {
		      	opt += `<option value = "${personFNs[n]}"></option>`;
		      }
		      document.getElementById("listPersonFN").innerHTML = opt;
		    }
		  }
		};
		xhr.send();
	}
}

function searchPersonLN(id)
{
	var partName = id.value;
	if(partName.length >= 1)
	{
		const xhr = new XMLHttpRequest(),
	    method = "GET",
	    url = "./util/personsearch.php?PersonLN=" + partName;

		xhr.open(method, url, true);
		xhr.onreadystatechange = function () 
		{
		  // In local files, status is 0 upon success in Mozilla Firefox
		  if(xhr.readyState === XMLHttpRequest.DONE) 
		  {
		    var status = xhr.status;
		    if (status === 4 || (status >= 200 && status < 400)) 
		    {
		      // The request has been completed successfully
		      var personLNs = JSON.parse(this.responseText);
		      var opt = ``;
		      for(n in personLNs)
		      {
		      	opt += `<option value = "${personLNs[n]}"></option>`;
		      }
		      document.getElementById("listPersonLN").innerHTML = opt;
		    }
		  }
		};
		xhr.send();
	}
}