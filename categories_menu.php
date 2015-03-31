<?php
//function is used to generate category menu
$main_menu = false;
function generate_menu($parent)
{
	//this prevents printing 'ul' if we don't have subcategories for this category
	$has_childs = false;
	global $main_menu; //set main menu categories only once

	//use global array variable instead of a local variable to lower stack memory requierment
	global $leftCategories;
		
	foreach($leftCategories as $key => $value)
	{
		if ($value['parent'] == $parent) 
		{ 
			//if this is the first child print '<ul>'                       
			if ($has_childs === false)
			{
				//don't print '<ul>' multiple times                             
				$has_childs = true;
				if(!$main_menu)
				{
					echo "<ul id='red' class='treeview-red'>";
					$main_menu = true;
				}
				else
				{
					echo "<ul class='navLink'>";
				}
			}
			
			if($value['parent']==0)
			{
				echo "<li><a href='buyer.php?main_cat_id=".$key."'>".$value['name']."</a>";
			}
			else
			{
				echo "<li><a href='buyer.php?item_category_id=".$key."'>".$value['name']."</a>";
			}
		
			//call function again to generate nested list for subcategories belonging to this category
			generate_menu($key);
					
			echo "</li>";
		}
	}
	if ($has_childs === true)
	{
		echo "</ul>";
	}
}
generate_menu(0);
?>