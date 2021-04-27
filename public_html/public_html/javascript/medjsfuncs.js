function undisablemed(i)
{
	document.getElementById("medname"+i).disabled=false;
	document.getElementById("dose"+i).disabled=false;
	document.getElementById("medtypeselect"+i).disabled=false;
	document.getElementById("frequencyselect"+i).disabled=false;
	document.getElementById("takenwhenselect"+i).disabled=false;
	document.getElementById("medstartdate"+i).disabled=false;
	document.getElementById("medenddate"+i).disabled=false;
	document.getElementById("mednote"+i).disabled=false;
	document.getElementById("meddelete"+i).hidden=false;
	document.getElementById("medupdate"+i).hidden=false;
	document.getElementById("medcancel"+i).hidden=false;
	document.getElementById("mededit"+i).hidden=true;
}

function disablemed($i)
{
	document.getElementById("medname"+$i).disabled=true;
	document.getElementById("dose"+$i).disabled=true;
	document.getElementById("medtypeselect"+$i).disabled=true;
	document.getElementById("frequencyselect"+$i).disabled=true;
	document.getElementById("takenwhenselect"+$i).disabled=true;
	document.getElementById("medstartdate"+$i).disabled=true;
	document.getElementById("medenddate"+$i).disabled=true;
	document.getElementById("mednote"+$i).disabled=true;
	document.getElementById("meddelete"+$i).hidden=true;
	document.getElementById("medupdate"+$i).hidden=true;
	document.getElementById("medcancel"+$i).hidden=true;
	document.getElementById("mededit"+$i).hidden=false;
}

function insertmed($classdetailid, $rows)
{
	const xhr = new XMLHttpRequest(),
        method = "GET",
        url = "./util/insert-med.php?ClassDetailID=" + $classdetailid;
        xhr.open(method, url, true);

        xhr.onreadystatechange = function () 
		{
		  // In local files, status is 0 upon success in Mozilla Firefox
		  if(xhr.readyState === XMLHttpRequest.DONE) 
		  {
		    var status = xhr.status;
		    if (status === 4 || (status >= 200 && status < 400)) 
		    {
		      //reload the medform, passing the numbe of rows there will be for reload
		      fetchMedForm($rows + 1);

		    }
		  }
		};

        xhr.send();
}

function deletemed($MedID, $rows)
{
	if(confirm('This record will be completely removed from the database.\nAre you sure?') )
	{
		const xhr = new XMLHttpRequest(),
	        method = "GET",
	        url = "./util/delete-med.php?MedID=" +$MedID;
	        xhr.open(method, url, true);
	        
	        xhr.onreadystatechange = function () 
			{
			  // In local files, status is 0 upon success in Mozilla Firefox
			  if(xhr.readyState === XMLHttpRequest.DONE) 
			  {
			    var status = xhr.status;
			    if (status === 4 || (status >= 200 && status < 400)) 
			    {
			      //reload the medform
			      fetchMedForm($rows);
			    }
			  }
			};

	        xhr.send();
    }
}

function updatemed($medID, $i, $rows)
{	
	if(confirm('Are you sure you want to update this record?') )
	{
		var form = document.getElementById("medform"+$i);
		var inputs = form.getElementsByTagName("input");
		var data= new Array();
		for(idx in inputs){
			data.push(inputs[idx].value);
		}
		data = JSON.stringify(data);
		const xhr = new XMLHttpRequest(),
	        method = "GET",
	        url = "./util/update-med.php?MedID="+$medID+"&data="+data;        
	        xhr.open(method, url, true);
	        xhr.onreadystatechange = function () 
			{
			  // In local files, status is 0 upon success in Mozilla Firefox
			  if(xhr.readyState === XMLHttpRequest.DONE) 
			  {
			    var status = xhr.status;
			    if (status === 4 || (status >= 200 && status < 400)) 
			    {
			      //reload the medform
			      fetchMedForm($rows);

			    }
			  }
			};

	        xhr.send();
    }
}