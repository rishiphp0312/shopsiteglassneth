<?php
include ('include/common.inc');
include ('class/class.user.inc');
include ('class/class.item.inc');

$objItem = new Class_Item();

$objUser = new Class_User();
if(isset($_GET['sellerid'])&& $_GET['sellerid']!="")
{
	$objItem->user_id = $_GET['sellerid'];
	$UserRes = $objItem->getfeedbackstore();
	$num=mysql_num_rows($UserRes);
	$UserArr = mysql_fetch_array($UserRes);
	 $UserArr['id'];
	$smarty->assign("username",$UserArr['username']);
	$smarty->assign("regdt",$UserArr['reg_date']);
	$smarty->assign("user_country_name",$objUser->getcountry($UserArr['country_id']));
	$smarty->assign("num",$num);
	$smarty->assign("citem",$items);

	$objUser->id = $_GET['sellerid'];
	$UserRes11 = $objUser->getUserDetails();
	$UserArr11 = mysql_fetch_array($UserRes11);
	$smarty->assign("username1",$UserArr11['username']);
	$smarty->assign("regdt1",$UserArr11['reg_date']);
	$smarty->assign("user_country_name1",$objUser->getcountry($UserArr11['country_id']));


	$i1=1;
	$p1=1;
	$q1=1;

	$UserRes1 = $objItem->lastmonth();
	$num1=mysql_num_rows($UserRes1);
	//$UserArr1 = mysql_fetch_array($UserRes1);

	while($UserArr1 = mysql_fetch_array($UserRes1))
	{
		$feedback=$UserArr1['feedback'];
		
		if($feedback==-1)
		{
			$k1= $i1++;
		}
		if($feedback==1)
		{
			$h1= $q1++;
		}
		if($feedback==0)
		{
			$j1= $p1++;
		}
	}
	$smarty->assign('lastnegative',$k1);
	$smarty->assign('lastpositive',$h1);
	$smarty->assign('lastnutral',$j1);




	$i=1;
	$p=1;
	$q=1;
	$UserRes2 = $objItem->sixmonth();
	$num2=mysql_num_rows($UserRes2);
	while($UserArr2 = mysql_fetch_array($UserRes2))
	{
		$feedback=$UserArr2['feedback'];
		
		if($feedback==-1)
		{
			$k= $i++;
		}
		if($feedback==1)
		{
			$h= $q++;
		}
		if($feedback==0)
		{
			$j= $p++;
		}
	}
	

	$smarty->assign('sixnegative',$k);
	$smarty->assign('sixpositive',$h);
	$smarty->assign('sixnutral',$j);



	
	$i3=1;
	$p3=1;
	$q3=1;
	$UserRes3 = $objItem->twelvemonth();
	$num3=mysql_num_rows($UserRes3);
	while($UserArr3 = mysql_fetch_array($UserRes3))
	{
		$feedback=$UserArr3['feedback'];
		
		if($feedback==-1)
		{
			$k3= $i3++;
		}
		if($feedback==1)
		{
			$h3= $q3++;
		}
		if($feedback==0)
		{
			$j3= $p3++;
		}
	}
	

	$smarty->assign('onenegative',$k3);
	$smarty->assign('onepositive',$h3);
	$smarty->assign('onenutral',$j3);
}

$smarty->assign('site_page_title',SITE_HOME);
$smarty->assign('site_title',$site_title);
$smarty->display('feedback.tpl');
?>