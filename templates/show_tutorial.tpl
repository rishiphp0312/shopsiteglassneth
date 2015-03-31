{include file="header.tpl"}
{include file="header_search.tpl"}
<script language="javascript" type="text/javascript">
{literal}
function playVideo(video)
{
	$("#palyer_div").html("<img scr='images/ajax-loader.gif' border='0' align='center' />");
	$.ajax({
	type: "GET",
	url: "flv_player.php",
	data: "action=play&video="+video,
		success: function(response)
		{
			if(response)
			{
				//window.location.reload();
				$("#palyer_div").html(response);
			}
			else
			{
				alert("Unable to process this request, please try again");
			}
		}
	});

}
{/literal}
</script>
<!--Start Middle-->
	<div id="middleMain">
			{include file="left_category.tpl"}
		<div id="middleRtMain">
			<!--<h1>{$page_title|clear_input}</h1>-->
		 	<div style="text-align:justify;">
			<table align='center' cellpadding='0' cellspacing='0' border='0' width='100%'>
                                   <tr>
				    <td align='left' class='subHD'>How It Works</td>
			       </tr><tr><td align='left' >

	<!--Start Tab Link-->
		<div class="tabMenu"><a href="javascript://" class="sel" id="v1" onclick="fp_show('tab_1','v1')">
<span>BUYERS</span></a><a href="javascript://" id="v2" onclick="fp_show('tab_2','v2')"><span>SELLERS</span></a></div>
		<div class="tabBdr" id="tab_2" style="display:none;">
			<div class="tabContents">{$sellers_desc|clear_input}</div>
<div align="right"><a href="{$baseUrl}cms.php?page=sellers"><img src="{$baseUrl}images/findour_more.jpg" alt="" style="margin:3px 0 0 0;" /></a></div>
		</div>
		<div class="tabBdr" id="tab_1" >
			<div class="tabContents">{$buyers_desc|clear_input}</div>				
		</div>
		<!--End Tab Link-->
		
                                  </td>
                              </tr>

                            
			       <tr>
				     <td>{$description}</td>
				</tr>
				<tr>
				     <td align="center" style="font-size:14px; font-weight:bold;"><b>Language:</b>
				     <select name="tute_video" id="tute_video" onchange="playVideo(this.value);" style="width:200px; font-size:14px;">
				     {html_options options=$tuteList selected=$tute_video}
				     </select>
				     </td>
				</tr>
				<tr>
				     <td align="center">
				     <div style="border: 2px solid #000000; margin-bottom:5px; padding:0px;height:391px;width:616px;" id="palyer_div">
                                     </div>
				     </td>
				</tr>
			</table>
		 	</div>
		</div>
		<div class="clear"></div>
	</div>
<!--End Middle-->
{if $tute_video!=""}
<script language="javascript" type="text/javascript">
playVideo('{$tute_video}');
</script>
{/if}
{include file="footer.tpl"}