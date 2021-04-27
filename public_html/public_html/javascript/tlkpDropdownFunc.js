/*
Author: James Pangia
Group: James Pangia, Dennis Parkman, Seth Rozelle
function to generate dropdown menu options to populate a select element
 */

/**
 * Generates a dropdown menu using the lookup table associated with the attribute named by fieldName
 * necessary element ids are generated using:
 *    idroot+i for the input
 *    idroot+"select"+i for the select
 * @param idroot       the first part of the ids of the select and associated hidden input
 * @param i            the counter number of the select being updated
 * @param fieldName    name of the field with the tlkp
 * @param tlkpName     name of the tlkp
 * @param currentvalue value that should be selected initially
 */
function tlkpDropdown(idroot, i, fieldName, tlkpName, currentvalue)
{

	const xhr = new XMLHttpRequest(),
	    method = "GET",
	    url = `./util/tlkpDropdownAjaxReq.php?fieldName=${fieldName}&tlkpName=${tlkpName}`;
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
		      var options = JSON.parse(this.responseText);
		      var opt = ``
		      var nullSelected = "selected = \"selected\""; //set to "" if another value should be selected
		      for(var n in options)
		      {
		      	if(options[n]==currentvalue)//if this option's med type is the value of the current record, select this option
		      	{
		      		nullSelected = "";
			      	opt += `<option value = "${options[n]}" selected = "selected">${options[n]}</option>`;
		      	}
		      	else
		      	{
		      		opt += `<option value = "${options[n]}">${options[n]}</option>`;
		      	}
		      }
		      opt += `<option value = "NULL" ${nullSelected}></option>`;
		      document.getElementById(idroot+"select"+i).innerHTML = opt;
		    }
		  }
		};
		xhr.send();
}

/**
 * sets the value of the select element referenced by selectId to
 * the value of the option element referenced by optionId.
 * Necessary element ids are generated using:
 *    idroot+i for the input id
 *    idroot+"select"+i for the select id
 *    
 * @param optionIdx    index to the option element to fetch the value from
 * @param idroot       the first part of the ids of the option and associated hidden input
 * @param i            the counter number of the select and input being updated
 */
function selectTheValue(optionIdx, idroot, i)
{
	var selectID = document.getElementById(idroot+"select"+i);
	selectID.value = selectID.getElementsByTagName("option")[optionIdx].value;
	document.getElementById(idroot+""+i).value = selectID.getElementsByTagName("option")[optionIdx].value;
}