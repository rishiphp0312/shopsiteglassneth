<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty property_inclusions modifier plugin
 *
 * Type:     modifier<br>
 * Name:     property_inclusions<br>
 * Purpose:  convert property inclusions to full text
 * @link: 
 * @author: Mahipal Adhikari
 * @param: string
 * @return string
 */
function smarty_modifier_property_inclusions($strInclusions="")
{
   //Air Conditioning, Appliance/Unit, Above Grnd Pool, Ceiling Fan, Chandelier, Compactor, Carpet, Crops, Window coverings, Dryer, Disposal, Drive, Dishwasher, Elevator, Fencing, Fireplace, Floor Tile, Furniture, Gar/Car Ea Unit, Graded, Gas Grill, Hardwood Floor, Kitchenware, Landscaped, Linens, Laundry, Microwave, Pool Equip, Pool, Refrigerator, Range, Rock Walls, Storage Area, Smoke/Heat Detector, Security, Solar, Spa, *See Remarks, Sprinkler System, Stream, Sidewalk, TV Antenna, TV Cable, Washer
		//$incArr = array("Air Conditioning", "Appliance/Unit", "Above Grnd Pool", "Ceiling Fan", "Chandelier", "Compactor", "Carpet", "Crops", "Window Coverings", "Dryer", "Disposal", "Drive", "Dishwasher", "Elevator", "Fencing", "Fireplace", "Floor Tile", "Furniture", "Gar/Car Ea Unit", "Graded", "Gas Grill", "Hardwood Floor", "Kitchenware", "Landscaped", "Linens", "Laundry", "Microwave", "Pool Equip", "Pool", "Refrigerator", "Range", "Rock Walls", "Storage Area", "Smoke/Heat Detector", "Security", "Solar", "Spa", "*See Remarks", "Sprinkler System", "Stream", "Sidewalk", "TV Antenna", "TV Cable", "Washer");
		
	$Inclusions = str_replace('AC','Air Conditioning',$strInclusions);
	$Inclusions = str_replace('AE','Appliance/Unit',$Inclusions);
	$Inclusions = str_replace('AP','Above Grnd Pool',$Inclusions);
	$Inclusions = str_replace('CF','Ceiling Fan',$Inclusions);
	$Inclusions = str_replace('CH','Chandelier',$Inclusions);
	$Inclusions = str_replace('CP','Compactor',$Inclusions);
	$Inclusions = str_replace('CT','Carpet',$Inclusions);
	$Inclusions = str_replace('CW','Crops Window',$Inclusions);
	$Inclusions = str_replace('CR','Coverings',$Inclusions);
	$Inclusions = str_replace('DR','Dryer',$Inclusions);
	$Inclusions = str_replace('DS','Disposal',$Inclusions);
	$Inclusions = str_replace('DR','Drive',$Inclusions);
	$Inclusions = str_replace('DW','Dishwasher',$Inclusions);
	$Inclusions = str_replace('EL','Elevator',$Inclusions);
	$Inclusions = str_replace('FN','Fencing',$Inclusions);
	$Inclusions = str_replace('FP','Fireplace',$Inclusions);
	$Inclusions = str_replace('FT','Floor Tile',$Inclusions);
	$Inclusions = str_replace('FUR','Furniture',$Inclusions);
	$Inclusions = str_replace('GA','Gar/Car Ea Unit',$Inclusions);
	$Inclusions = str_replace('GD','Graded',$Inclusions);
	$Inclusions = str_replace('GG','Gas Grill',$Inclusions);
	$Inclusions = str_replace('HW','Hardwood Floor',$Inclusions);
	$Inclusions = str_replace('KIT','Kitchenware',$Inclusions);
	$Inclusions = str_replace('LA','Landscaped',$Inclusions);
	$Inclusions = str_replace('LIN','Linens',$Inclusions);
	$Inclusions = str_replace('LU','Laundry',$Inclusions);
	$Inclusions = str_replace('MI','Microwave',$Inclusions);
	$Inclusions = str_replace('PE','Pool Equip',$Inclusions);
	$Inclusions = str_replace('PO','Pool',$Inclusions);
	$Inclusions = str_replace('RF','Refrigerator',$Inclusions);
	$Inclusions = str_replace('RG','Range',$Inclusions);
	$Inclusions = str_replace('RW','Rock Walls',$Inclusions);
	$Inclusions = str_replace('SA','Storage Area',$Inclusions);
	$Inclusions = str_replace('SD','Smoke/Heat Detector',$Inclusions);
	$Inclusions = str_replace('SEC','Security',$Inclusions);
	$Inclusions = str_replace('SL','Solar',$Inclusions);
	$Inclusions = str_replace('SPA','Spa',$Inclusions);
	$Inclusions = str_replace('SR','*See Remarks',$Inclusions);
	$Inclusions = str_replace('SS','Sprinkler System',$Inclusions);
	$Inclusions = str_replace('WF','Stream',$Inclusions);
	$Inclusions = str_replace('SWK','Sidewalk',$Inclusions);
	$Inclusions = str_replace('TVA','TV Antenna',$Inclusions);
	$Inclusions = str_replace('TVC','TV Cable',$Inclusions);
	$Inclusions = str_replace('WM','Washer',$Inclusions);
	$Inclusions = str_replace(',',', ',$Inclusions);
	return $Inclusions;
}
?>