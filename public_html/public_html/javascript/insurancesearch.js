function viewInsurance(id)
{
	//query tblPeople and fetch PersonID, PersonFN, PersonLN, CadetID; display all but PersonID
	const xhr = new XMLHttpRequest(),
	    method = "GET",
	    url = `./util/insurance-menu-search.php`;
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
		      console.log(this.responseText);
		      if(this.responseText == "Error")
		      {
		          document.getElementById("existinginsurance").innerHTML = "No Insurance Record";
		          return;
		      }
		      var matches = JSON.parse(this.responseText); //retrieve the array of associative rows
		      console.log(matches);
		      var matchList = ``;
		      for(var n in matches)
		      {
		          if(matches == null)
		            break;
		          matchList = true;
		          document.getElementById(n).value = matches[n];
		      }
		      if(matchList === ``)
		      {
		      	  document.getElementById("existinginsurance").innerHTML = "No Insurance Record";
		      }
		      else
		      {
		          document.getElementById("existinginsurance").innerHTML = "";
			  }
		      //post personID to med-menu.php; menu main functions read $_POST['PersonID'] for PersonID
		      
		    }
		  }
		};
		xhr.send();
}
function updateInsurance(id)
{
	//query tblPeople and fetch PersonID, PersonFN, PersonLN, CadetID; display all but PersonID
	var PolicyNumber = document.getElementById("PolicyNumber").value;
    var GroupNumber = document.getElementById("GroupNumber").value;
    var PolicyExpDate = document.getElementById("PolicyExpDate").value;
    var PolicyHolderName = document.getElementById("PolicyHolderName").value;
    var PolicyHolderRelationship = document.getElementById("PolicyHolderRelationship").value;
    var CopayInfo = document.getElementById("CopayInfo").value;
    var InsCoName = document.getElementById("InsCoName").value;
    var InsCoAddress = document.getElementById("InsCoAddress").value;
    var InsCoAddress2 = document.getElementById("InsCoAddress2").value;
    var InsCoCity = document.getElementById("InsCoCity").value;
    var InsCoState = document.getElementById("InsCoState").value;
    var InsCoZip = document.getElementById("InsCoZip").value;
    var InsCoPhone = document.getElementById("InsCoPhone").value;
    var InsCoFax = document.getElementById("InsCoFax").value;
	const xhr = new XMLHttpRequest(),
	    method = "GET",
	    variables = `?PolicyNumber=`+PolicyNumber+`&GroupNumber=`+GroupNumber+`&PolicyExpDate=`+PolicyExpDate+`&PolicyHolderName=`+PolicyHolderName+`&PolicyHolderRelationship=`+PolicyHolderRelationship+`&CopayInfo=`+CopayInfo+`&InsCoName=`+InsCoName+`&InsCoAddress=`+InsCoAddress+`&InsCoAddress2=`+InsCoAddress2+`&InsCoCity=`+InsCoCity+`&InsCoState=`+InsCoState+`&InsCoZip=`+InsCoZip+`&InsCoPhone=`+InsCoPhone+`&InsCoFax=`+InsCoFax,
	    url = `./util/insurance-menu-update.php`+variables;
		xhr.open(method, url, true);
		xhr.onreadystatechange = function () 
		{
		  // In local files, status is 0 upon success in Mozilla Firefox
		  if(xhr.readyState === XMLHttpRequest.DONE) 
		  {
		    var status = xhr.status;
		    if (status === 4 || (status >= 200 && status < 400)) 
		    {
		        
		        console.log(this.responseText);
		      viewInsurance(id);
		    }
		  }
		};
		xhr.send();
}
function insertInsurance(id)
{
	//query tblPeople and fetch PersonID, PersonFN, PersonLN, CadetID; display all but PersonID
	var PolicyNumber = document.getElementById("PolicyNumber").value;
    var GroupNumber = document.getElementById("GroupNumber").value;
    var PolicyExpDate = document.getElementById("PolicyExpDate").value;
    var PolicyHolderName = document.getElementById("PolicyHolderName").value;
    var PolicyHolderRelationship = document.getElementById("PolicyHolderRelationship").value;
    var CopayInfo = document.getElementById("CopayInfo").value;
    var InsCoName = document.getElementById("InsCoName").value;
    var InsCoAddress = document.getElementById("InsCoAddress").value;
    var InsCoAddress2 = document.getElementById("InsCoAddress2").value;
    var InsCoCity = document.getElementById("InsCoCity").value;
    var InsCoState = document.getElementById("InsCoState").value;
    var InsCoZip = document.getElementById("InsCoZip").value;
    var InsCoPhone = document.getElementById("InsCoPhone").value;
    var InsCoFax = document.getElementById("InsCoFax").value;
	const xhr = new XMLHttpRequest(),
	    method = "GET",
	    variables = `?PolicyNumber=`+PolicyNumber+`&GroupNumber=`+GroupNumber+`&PolicyExpDate=`+PolicyExpDate+`&PolicyHolderName=`+PolicyHolderName+`&PolicyHolderRelationship=`+PolicyHolderRelationship+`&CopayInfo=`+CopayInfo+`&InsCoName=`+InsCoName+`&InsCoAddress=`+InsCoAddress+`&InsCoAddress2=`+InsCoAddress2+`&InsCoCity=`+InsCoCity+`&InsCoState=`+InsCoState+`&InsCoZip=`+InsCoZip+`&InsCoPhone=`+InsCoPhone+`&InsCoFax=`+InsCoFax,
	    url = `./util/insurance-menu-insert.php`+variables;
		xhr.open(method, url, true);
		xhr.onreadystatechange = function () 
		{
		  // In local files, status is 0 upon success in Mozilla Firefox
		  if(xhr.readyState === XMLHttpRequest.DONE) 
		  {
		    var status = xhr.status;
		    if (status === 4 || (status >= 200 && status < 400)) 
		    {
		        
		        console.log(this.responseText);
		      viewInsurance(id);
		    }
		  }
		};
		xhr.send();
}
function deleteInsurance(id)
{
	//query tblPeople and fetch PersonID, PersonFN, PersonLN, CadetID; display all but PersonID
	const xhr = new XMLHttpRequest(),
	    method = "GET",
	    url = `./util/insurance-menu-delete.php`;
		xhr.open(method, url, true);
		xhr.onreadystatechange = function () 
		{
		  // In local files, status is 0 upon success in Mozilla Firefox
		  if(xhr.readyState === XMLHttpRequest.DONE) 
		  {
		    var status = xhr.status;
		    if (status === 4 || (status >= 200 && status < 400)) 
		    {
		        if(this.responseText == "Error")
		            document.getElementById("existinginsurance").innerHTML = "Does not exist";
		        else
		        {
                    document.getElementById("existinginsurance").innerHTML = "No Insurance Record";
		        }
		    }
		  }
		};
		xhr.send();
}