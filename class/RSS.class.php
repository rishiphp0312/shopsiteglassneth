<?php

class RSS
{
	public function GetFeed()
	{
		return $this->getDetails();
	}

	private function getDetails()
	{   
		$query = "SELECT * FROM tbl_item_details where 1=1 AND request_item_id=0 AND locker_status=0 AND delete_restored=0 AND delete_by_seller=0 AND expired_package=0 ORDER BY date_added DESC LIMIT 0, 20";
		$result = mysql_query($query);

		$details   ='<?xml version="1.0" encoding="iso-8859-1" ?>
					<rss version="2.0">
						<channel>
							<title>Nethaat | Hand Made Items Marketplace Online</title>
							<link>http://www.nethaat.com</link>
							<description>Hand Made Items Marketplace</description>
							<language>eng</language>
							<image>
								<title></title>
								<url></url>
								<link></link>
								<width></width>
								<height></height>
							</image>';
		while($row = mysql_fetch_array($result))
		{   $baseUrl= 'http://www.nethaat.com/';
         	//$img_thumb=  "uploads/".$row['image1'];
			$img_thumb=$baseUrl."getthumb.php?w=100&h=70&fromfile=uploads/".$row['image1'];
			$link="http://www.nethaat.com/item-details.php?details_item_value=".$row["item_id"];
			$description='<table border="0" cellspacing="1" cellpadding="1"><tr><td valign="top"><a href="'.$link.'"><img src="'.$img_thumb.'" alt="" width="100" height="75"/></a></td><td valign="top"> '.$row["description"].'</td></tr></table>';
			$details .= '<item>
								<title>'.$row["title"].'</title>
								<link>'.$link.'
</link>
								<description><![CDATA['.$description.']]></description>
							</item>';
		}
		$details .='</channel></rss>';
		return $details;
	}
}

?>