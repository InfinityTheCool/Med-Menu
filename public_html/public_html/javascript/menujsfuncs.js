/*
Group: James Pangia, Dennis Parkman, Seth Rozelle
file containing supporting functions for the med-menu.php file
 */

function fetchMedForm($rows)//, $medtype, $frequency, $takenwhen)
{
	const xhr = new XMLHttpRequest(),
	    method = "GET",
	    url = `./util/ajax-reload-medform.php`;

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
		      document.getElementById("medformdiv").innerHTML = this.responseText;

		      //toggle watcher element values
		      for(var i = 0; i < $rows; ++i)
		      {
			      document.getElementById("medtypewatcher"+i).onchange();
			      document.getElementById("frequencywatcher"+i).onchange();
			      document.getElementById("takenwhenwatcher"+i).onchange();
			  }

		    }
		  }
		};
		xhr.send();
}

function fetchAllergyForm($rows)
{
	const xhr = new XMLHttpRequest(),
	    method = "GET",
	    url = `./util/ajax-reload-allergy.php`;

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
		      document.getElementById("allergydiv").innerHTML = this.responseText;

		      //toggle watcher element values
		      for(var i = 0; i < $rows; ++i)
		      {
			      document.getElementById("allergytypewatcher"+i).onchange();
			  }
		    }
		  }
		};
		xhr.send();
}
function fetchSickForm($rows)
{
	const xhr = new XMLHttpRequest(),
	    method = "GET",
	    url = `./util/ajax-reload-sickcallform.php`;

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
		      document.getElementById("sickcalldiv").innerHTML = this.responseText;

		      //toggle watcher element values
		      for(var i = 0; i < $rows; ++i)
		      {
			      document.getElementById("SickCallTypewatcher"+i).onchange();
			  }
		    }
		  }
		};
		xhr.send();
}