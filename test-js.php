<html>
<head>
    
<script language="javascript" src="js/Tooltip.js"></script>
<LINK rel="stylesheet" type="text/css" href="styles/StyleSheet.css">

</head>
<body onload=init()>

<strong>
Move your mouse over following lines:<br><br>
<span class="ttip" onmouseover=if(t1)t1.Show(event,l1) onmouseout=if(t1)t1.Hide(event)>
Line One
</span><br>

<span class="ttip" onmouseover=if(t1)t1.Show(event,l2) onmouseout=if(t1)t1.Hide(event)>
Line Two
</span>
</strong>

<div id="a" style="background-color:ivory;width: 150px;
 height: 49px;border: solid 1px gray; text-align: center;">
</div>

</body>
<script>

var t1=null;
var l1="Tooltip for line one";
var l2="Tooltip for line two";
function init()
{
 t1 = new ToolTip("a",false);
}

</script>
</html>
