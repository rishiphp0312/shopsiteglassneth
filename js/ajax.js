/**
*	Function Name 		: 	getAjaxObject
*	@input				:	Nothing
*	$output				:	ajax (Object: Ajax)
*	@discription		:	Creates an Ajax Object and returns it
*
* 	@created by 		:	Mahipal Adhikari
*	@created on			:	27-May-09
*/
function getAjaxObject()
{
	var ajax = null;
	try
	{
		ajax = new XMLHttpRequest();
	}
	catch(ex)
	{
		try
		{
			ajax = new ActiveXObject("MsXml2.XMLHTTP");
		}
		catch(ex)
		{
			try
			{
				ajax = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(ex)
			{
				//...Ajax not Possible
			}		
		}
	}
	return ajax;
}

/**
*	Function Name 		: 	getCountryStates
*	@input				:	parentList
*	@input				:	childListName
*	$output				:	Nothing
*	@discription		:	fetch the list of states from Server using Ajax, for a Country
*
* 	@created by 		:	Mahipal Adhikari
*	@created on			:	27-May-09
*/
function getCountryStates(parentList, childListName)
{
	frmObj = parentList.form;
	childList = frmObj.elements[childListName];
	var value = parentList.value;
	//if no category selected delete all options
	if(value=="")
	{
		childList.options.length = 0;
		childList.options[childList.options.length] = new Option("--- Select States ---", "");
	}
	else
	{
		childList.options.length = 0;
		childList.options[childList.options.length] = new Option("Loading...", "");
	}
	
	var ajax = null;
	ajax = getAjaxObject();
	if (ajax != null && value!= "")
	{
		var data = "rnd="+Math.random();
		data += "&doAjax=yes";
		data += "&country_id="+escape(value);
		data += "&action=getStates";
		var ajaxServer = "ajaxCommon.php";
		//alert("here...!");
		ajax.open("POST", ajaxServer, true);
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajax.onreadystatechange = function()
		{
			if (ajax.readyState == 4)
			{
				if (ajax.status == 200)
				{
					var response = ajax.responseText;
					//alert("Response received "+response);
					try
					{
						response = eval(response);
						fillChildList(childList, response);
					}
					catch(ex)
					{
						alert("Exception in response data handling\n"+ex);
					}
				}
			}
		};
		//alert(data);
		ajax.send(data);
	}//else{alert("blank");}
}

function getCityRegions(parentList, childListName, strUrl)
{
	frmObj = parentList.form;
	childList = frmObj.elements[childListName];
	var value = parentList.value;
	//if no city selected delete all options
	if(value=="")
	{
		childList.options.length = 0;
		childList.options[childList.options.length] = new Option("--- Select Region ---", "");
	}
	else
	{
		childList.options.length = 0;
		childList.options[childList.options.length] = new Option("Loading...", "");
	}
	
	var ajax = null;
	ajax = getAjaxObject();
	if (ajax != null && value!= "")
	{
		var data = "rnd="+Math.random();
		data += "&doAjax=yes";
		data += "&city_id="+escape(value);
		data += "&action=getRegions";
		var ajaxServer = strUrl+"ajaxCommon.php";
		//alert("here...!");
		ajax.open("POST", ajaxServer, true);
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajax.onreadystatechange = function()
		{
			if (ajax.readyState == 4)
			{
				if (ajax.status == 200)
				{
					var response = ajax.responseText;
					//alert("Response received "+response);
					try
					{
						response = eval(response);
						fillChildList(childList, response);
					}
					catch(ex)
					{
						alert("Exception in response data handling\n"+ex);
					}
				}
			}
		};
		//alert(data);
		ajax.send(data);
	}//else{alert("blank");}
}

/**
*	Function Name 		: 	fillChildList
*	@input				:	childList
*	@input				:	response
*	$output				:	Nothing
*	@discription		:	fill the childList with states, for a choosen Country
*
* 	@created by 		:	Mahipal Adhikari
*	@created on			:	27-May-09
*/
function fillChildList(childList, response)
{
	childList.options.length = 0;
	//alert(response);
	if(response=="")
	{
		childList.options[childList.options.length] = new Option("No values available for this option", "");
	}
	for(var i = 0; i < response.length; i++)
	{
		//check condition for .(period), leading with . name will not appear
		var proOption = response[i].split("#");
		childList.options[childList.options.length] = new Option(proOption[1], proOption[0]);
		//if(proOption[1].charAt(0)!=".")
		//{
			//childList.options[childList.options.length] = new Option(response[i], response[i]);
		//}//end of if	
	}//end of for
	
	//fill multi select stae drop down
	if(document.getElementById('select_multi_states'))
	{
		document.getElementById('select_multi_states').options.length = 0;
		fillMultiStateList(response);
	}
}

//fill multi select stae drop down
function fillMultiStateList(response)
{
	for(var i = 0; i < response.length; i++)
	{
		var proOption = response[i].split("/");
		document.getElementById('select_multi_states').options[document.getElementById('select_multi_states').options.length]=new Option(proOption[1], proOption[0]);
	}
	
}