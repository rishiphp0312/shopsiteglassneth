<?php
if(isset($_GET['action']) && $_GET['action']=='play')
{
	$video = "uploads/tutorials/".trim($_GET['video']);
	if($video!="")
	{
?>
<object height="391" width="616" data="player/flowplayer-3.1.4.swf" type="application/x-shockwave-flash" id="img1" >
	<param name="movie" value="player/flowplayer-3.1.4.swf" />
	<param name="quality" value="high"/>
	<param name="scale" value="noScale"/>
	<param name="autoplay" value="false"/>
	<param name="allowfullscreen" value="true" />
	<param name="allowscriptaccess" value="always" />
	<param name="flashvars"  value='config={"plugins":{"pseudo":{"url":"player/flowplayer.pseudostreaming-3.1.3.swf"},"controls":{"backgroundColor":"#400041","backgroundGradient":"high"}},"clip":{"provider":"pseudo","url":"<?php  echo $video; ?>"},"playlist":[{"provider":"pseudo","url":"<?php   echo $video;  ?>"}]}' />
</object>
<?php
	}
}
?>