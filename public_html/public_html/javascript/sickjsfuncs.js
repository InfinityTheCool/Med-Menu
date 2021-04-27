function sickundisable(i)
{
	document.getElementById("MedSickCallID"+i).disabled=false;
	document.getElementById("SickCallDate"+i).disabled=false;
	document.getElementById("WasDoctorVisit"+i).disabled=false;
	document.getElementById("WasPassIssued"+i).disabled=false;
	document.getElementById("SickCallTypeselect"+i).disabled=false;
	document.getElementById("DoctorVisitDate"+i).disabled=false;
	document.getElementById("SickCallDiagnosis"+i).disabled=false;
	document.getElementById("SickCallMedicine"+i).disabled=false;
	document.getElementById("SickCallReason"+i).disabled=false;
	document.getElementById("SickCallHeight"+i).disabled=false;
	document.getElementById("SickCallWeight"+i).disabled=false;
	document.getElementById("Temperature"+i).disabled=false;
	document.getElementById("BP"+i).disabled=false;
	document.getElementById("Pulse"+i).disabled=false;
	document.getElementById("sickdelete"+i).hidden=false;
	document.getElementById("sickupdate"+i).hidden=false;
	document.getElementById("sickcancel"+i).hidden=false;
	document.getElementById("sickedit"+i).hidden=true;
}

function sickdisable(i)
{
	document.getElementById("MedSickCallID"+i).disabled=true;
	document.getElementById("SickCallDate"+i).disabled=true;
	document.getElementById("WasDoctorVisit"+i).disabled=true;
	document.getElementById("WasPassIssued"+i).disabled=true;
	document.getElementById("SickCallTypeselect"+i).disabled=true;
	document.getElementById("DoctorVisitDate"+i).disabled=true;
	document.getElementById("SickCallDiagnosis"+i).disabled=true;
	document.getElementById("SickCallMedicine"+i).disabled=true;
	document.getElementById("SickCallReason"+i).disabled=true;
	document.getElementById("SickCallHeight"+i).disabled=true;
	document.getElementById("SickCallWeight"+i).disabled=true;
	document.getElementById("Temperature"+i).disabled=true;
	document.getElementById("BP"+i).disabled=true;
	document.getElementById("Pulse"+i).disabled=true;
	document.getElementById("sickdelete"+i).hidden=true;
	document.getElementById("sickupdate"+i).hidden=true;
	document.getElementById("sickcancel"+i).hidden=true;
	document.getElementById("sickedit"+i).hidden=false;
}

function insertsick($classdetailid, $rows)
{
	const xhr = new XMLHttpRequest(),
        method = "GET",
        url = "./util/insert-sick.php?ClassDetailID=" + $classdetailid;
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
		      fetchSickForm($rows + 1);

		    }
		  }
		};

        xhr.send();
}

function deletesick($MedSickCallID, $rows)
{
	if(confirm('This record will be completely removed from the database.\nAre you sure?') )
	{
		const xhr = new XMLHttpRequest(),
	        method = "GET",
	        url = "./util/delete-sick.php?MedSickCallID=" +$MedSickCallID;
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
			      fetchSickForm($rows);
			    }
			  }
			};

	        xhr.send();
    }
}

function updatesick($MedSickCallID, $i, $rows)
{	
	if(confirm('Are you sure you want to update this record?') )
	{
		var form = document.getElementById("form"+$i);
		var inputs = form.getElementsByTagName("input");
		var data= new Array();
		for(var idx in inputs){
			data.push(inputs[idx].value);
		}
		data = JSON.stringify(data);
		const xhr = new XMLHttpRequest(),
	        method = "GET",
	        url = "./util/update-sick.php?MedSickCallID="+$MedSickCallID+"&data="+data;        
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
			      fetchSickForm($rows);

			    }
			  }
			};

	        xhr.send();
    }
}
function selectyn(option,WasDoctorVisit){
    document.getElementByID(WasDoctorVisit).value = option.value;
    
}