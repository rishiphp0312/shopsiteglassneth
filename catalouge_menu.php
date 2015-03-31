<ul id='red' class='treeview-red'>
<?php
include("class/constant.inc");
$con = mysql_connect($DB_SERVER, $DB_LOGIN, $DB_PASSWORD)or die("Can not connect=> ".mysql_error());
if($con)
{
	mysql_select_db($DB_COMMON, $con)or die("Can not select database=> ".mysql_error());
}
$sqlMain = "SELECT category_id, name FROM tbl_category_master WHERE status=1 AND parent_id=0 ORDER BY name";
$mainRes = mysql_query($sqlMain) or die("Error in query=> ".mysql_error());
while($row = mysql_fetch_array($mainRes))
{
	echo "<li><a href='buyer.php?main_cat_id=".$row['category_id']."'>".$row['name']."</a>";
	//display all sub-categories
	//$sqlSub = "SELECT category_id, name FROM tbl_category_master WHERE status=1 AND parent_id=".$row['category_id']." ORDER BY name";
	
	//display all sub-categories haing item count is greater than 0
	$sqlSub  = "SELECT tcm.category_id, tcm.name, COUNT(tid.category_id) AS item_count FROM tbl_category_master AS tcm";
	$sqlSub .= " JOIN tbl_item_details AS tid ON tid.category_id=tcm.category_id  ";
	$sqlSub .= " WHERE  tcm.parent_id=".$row['category_id'];
	$sqlSub .= " AND tid.locker_status =0 AND tid.quantity_available>0 ";
    $sqlSub .= " AND tid.hatting_status=0 AND tid.status=1 AND tid.delete_by_seller = 0 AND tid.expired_package = 0 ";
    $sqlSub .= " AND tid.delete_restored=0 ";
    $sqlSub .= " GROUP BY tid.category_id HAVING item_count > 0 ";
	$sqlSub .= " ORDER BY tcm.name ";

	$subRes = mysql_query($sqlSub) or die("Error in query=> ".mysql_error());
	
    if(mysql_num_rows($subRes)>0)
	{//$cnt_rowvarble=0;
	if(($_REQUEST['main_cat_id']==$row['category_id']))
        {            echo "<ul class='navLink'>";
		while($subRow = mysql_fetch_array($subRes))
		{ // echo 'name-'.$subRow['name'];
                 //    $cnt_rowvarble++;
                 //  echo $cnt_rowvarble=$cnt_rowvarble+1;
                 //  echo '<br>';
                   //    if($cnt_rowvarble=$cnt_rowvarble<6)
			echo "<li><a href='buyer.php?item_category_id=".$subRow['category_id']."&main_cat_id=".$_REQUEST['main_cat_id']." '>".$subRow['name']."</a></li>";
		}
		echo "</ul>";
        }

        }
	echo "</li>";
}
mysql_close($con);
?>
</ul>