function clearText(thefield)
{
  if (thefield.defaultValue==thefield.value) { thefield.value = "" }
}
 
function replaceText(thefield)
{
  if (thefield.value=="") { thefield.value = thefield.defaultValue }
}

/*Tab Function Start*/
function fp_show(tab,cls) 
{
	i=1;
	
	while (document.getElementById("tab_"+i))
	 {
	 document.getElementById("tab_"+i).style.display='none';
	 document.getElementById("v"+i).className='';
	 i++;	 
	 }
	 document.getElementById(tab).style.display='block';
	 document.getElementById(cls).className='sel';
}
/*Tab Function End*/

//hide flash message DIV
function hideFlashMessage()
{
	if(document.getElementById('success_message') || document.getElementById('error_message'))
	{
		//setTimeout("callImage('" + imgName + "')",1000);
		setTimeout("hideFlashDIV()",10000);
	}
}
function hideFlashDIV()
{
	$("#success_message").fadeOut(2500);
	$("#error_message").fadeOut(2500);
	//$("#error_message").hide("clip", { direction: "vertical" }, 1000);
//	document.getElementById('session_flash_message').style.display = "none";
}

function page_load() 
{
	//hide loading message
	document.getElementById('page_loader_wait_msg').style.display="none";
}