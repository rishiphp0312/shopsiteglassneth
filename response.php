<?php
include ('include/common.inc');
include ('class/class.user.inc');
include ('class/class.mail.inc');
include ('class/crypto_class.php');
include ('include/sendEmailClass.php');
$objUser 	= new Class_User();
//$_GET['data'];
if($_GET['data']==102)
{
$result=$objUser->selectstates();
$states_num = mysql_num_rows($result);
if($states_num>0)
	{?>
	<select class="formSel" name="state_value" id='state_value' >
<?
	while($arr_fetch_states = mysql_fetch_assoc($result))
		{
		?>
		
	         <option  value="<?=$arr_fetch_states['state_name'];?>" ><?= $arr_fetch_states['state_name'];?></option>
		
	<?
		}
	?>
		</select>
<?


    }
}
else
{
?>
<input type='text' class="formSel required" name="state_value" id='state_value' value=''  >
<?
	}

?>