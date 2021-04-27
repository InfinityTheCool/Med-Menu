function undisable(i)
{
	document.getElementById("allergytypeselect"+i).disabled=false;
	document.getElementById("allergynote"+i).disabled=false;
	document.getElementById("allergydelete"+i).hidden=false;
	document.getElementById("allergyupdate"+i).hidden=false;
	document.getElementById("allergycancel"+i).hidden=false;
	document.getElementById("allergyedit"+i).hidden=true;
}

function disable(i)
{
	document.getElementById("allergytypeselect"+i).disabled=true;
	document.getElementById("allergynote"+i).disabled=true;
	document.getElementById("allergydelete"+i).hidden=true;
	document.getElementById("allergyupdate"+i).hidden=true;
	document.getElementById("allergycancel"+i).hidden=true;
	document.getElementById("allergyedit"+i).hidden=false;
}

function insertallergy($classdetailid, $rows)
{
	const xhr = new XMLHttpRequest(),
        method = "GET",
        url = "./util/insert-allergy.php?ClassDetailID=" + $classdetailid;

        xhr.open(method, url, true);
        xhr.onreadystatechange = function () 
		{
		  // In local files, status is 0 upon success in Mozilla Firefox
		  if(xhr.readyState === XMLHttpRequest.DONE) 
		  {
		    var status = xhr.status;
		    if (status === 4 || (status >= 200 && status < 400)) 
		    {
		      //reload the allergyform, passing the numbe of rows there will be for reload
		      fetchAllergyForm($rows + 1);
		    }
		  }
		};
        xhr.send();
}

function deleteallergy($MedAllergyID, $rows)
{
	if(confirm('This record will be deleted. This cannot be undone.\nAre you sure?') )
	{
		const xhr = new XMLHttpRequest(),
	        method = "GET",
	        url = "./util/delete-allergy.php?MedAllergyID=" +$MedAllergyID;
	        xhr.open(method, url, true);
	        xhr.onreadystatechange = function () 
			{
			  // In local files, status is 0 upon success in Mozilla Firefox
			  if(xhr.readyState === XMLHttpRequest.DONE) 
			  {
			    var status = xhr.status;
			    if (status === 4 || (status >= 200 && status < 400)) 
			    {
			      //reload the allergyform, passing the numbe of rows there will be for reload
			      fetchAllergyForm($rows);
			    }
			  }
			};
	        xhr.send();
    }
}

function updateallergy($MedAllergyID, $i, $rows)
{
	if(confirm('Are you sure you want to update this record?') )
	{
		var form = document.getElementById("allergyform"+$i);
		var inputs = form.getElementsByTagName("input");
		var data= new Array();
		for(var idx in inputs){
			data.push(inputs[idx].value);
		}
		data = JSON.stringify(data);
		const xhr = new XMLHttpRequest(),
	        method = "GET",
	        url = "./util/update-allergy.php?MedAllergyID="+$MedAllergyID+"&data="+data;     
	        xhr.open(method, url, true);
	 		xhr.onreadystatechange = function () 
			{
			  // In local files, status is 0 upon success in Mozilla Firefox
			  if(xhr.readyState === XMLHttpRequest.DONE) 
			  {
			    var status = xhr.status;
			    if (status === 4 || (status >= 200 && status < 400)) 
			    {
			        alert(this.responseText);
			      //reload the allergyform, passing the numbe of rows there will be for reload
			      fetchAllergyForm($rows);

			    }
			  }
			};
	        xhr.send();
    }
}