{include file="header.tpl"}

{include file="header_search.tpl"}
<!--Start Middle-->
<div id="middleMain"> 
	{include file="left_category.tpl"}
	<div id="middleRtMain" >
		<!--End Tab Link-->
			<div class="gap" style="height:5px;"></div>
			<div class="imgCatSec">
				<div class="catItemBg">
					<div class="catItemHed">
<img src="images/cat_hdbull.jpg" alt="" class="vAlign" /> Featured Items</div>
						<div class="clear"></div>
				</div>
				<div class="grpImgBotBdr">
					{if $every_thing_handpicked_all}
					{foreach name='csdf' from=$every_thing_handpicked_all  item=v}
					  {*if $anObject->home_pageHaatedItems($v.item_id)==0*}
                                       <div class="imgLftBdr">
					<div><a href="item-details.php?details_item_value={$v.item_id}" title="{$v.title|ucfirst}"><img src="{$baseUrl}getthumb.php?w=150&h=100&fromfile=uploads/{$v.image1}" onerror="this.src='{$baseUrl}images/item_small_img.jpg'; this.style.width='150px'; this.style.height='100px';" alt="{$v.title|ucfirst}" class="catImgBdr" /></a></div>
					<div class="imgText"><a href="item-details.php?details_item_value={$v.item_id}" title="{$v.title|ucfirst}"><strong>
                                        {assign var='prd_nameh' value=$v.title|ucfirst}
                               {$prd_nameh|truncate:20}</strong></a><br />{$v.cost_item|convert_price}
                               {if $v.hatting_status==1 }
                          <fieldset id="set1">
   {if $smarty.session.session_user_id ==''}
  <span style='color:#9ac243;font-weight:normal;'>&nbsp;&nbsp;
  <label title=" In order to negotiate online for this item on haating ,please log in. " ><b>Haat It </b></label>
  </span>
   {else}
  <span style='color:#9ac243;'>&nbsp;&nbsp;
  <label title=" Click on the item to negotiate online." ><b>Haat It </b></label>
  </span>{/if}{literal}<script >
  <code class="mix">$('#set1 *').tooltip();</code>
   </script>{/literal}
</fieldset> {/if} </div>
					<div class="imgTextDesc"><a href="item-details.php?details_item_value={$v.item_id}" title="{$v.title|ucfirst}">{$v.description|truncate:20:'...':true:true}</a></div>
					</div>
					{if $smarty.foreach.csdf.iteration%4==0 }
					<div class="clear"></div>
					{/if}
                                       {*/if*}
					{/foreach}
					{else}
					<div>No featured items listed.</div>
					{/if}
					<div class="clear"></div>
					{if $total_hand_picked==12}
					<div style='text-align:right;'><!--<a href="handpicked-list.php">More</a>--></div>
					{/if}
				</div>
			</div>
			<div class="imgCatSec">
				<div class="catItemBg">
					<div class="catItemHed"><img src="images/cat_hdbull.jpg" alt="" class="vAlign" /> New Items</div>
				
					<div class="clear"></div>
				</div>
				<div class="grpImgBotBdr">
		{if $every_recent_product_all}
		{foreach name='csdfall1' from=$every_recent_product_all  item=v_r}
		{*if $anObject->home_pageHaatedItems($v_r.item_id)==0*}
                <div class="imgLftBdr">
		<div><a href="item-details.php?details_item_value={$v_r.item_id}" title="{$v_r.title|ucfirst}"><img src="{$baseUrl}getthumb.php?w=150&h=100&fromfile=uploads/{$v_r.image1}" onerror="this.src='{$baseUrl}images/item_small_img.jpg'; this.style.width='150px'; this.style.height='100px';" alt="{$v_r.title|ucfirst}" class="catImgBdr" /></a></div>
		<div class="imgText"><a href="item-details.php?details_item_value={$v_r.item_id}" title="{$v_r.title|ucfirst}"><strong>
{assign var='prd_name' value=$v_r.title|ucfirst}
                 {$prd_name|truncate:20}</strong></a><br />
                 {$v_r.cost_item|convert_price}

{if $v_r.hatting_status==1}
 <fieldset id="set2">
   {if $smarty.session.session_user_id ==''}
  <span style='color:#9ac243;font-weight:normal;'>&nbsp;&nbsp;
  <label title=" In order to negotiate online for this item on haating ,please log in. " ><b>Haat It </b></label>
  </span>
   {else}
  <span style='color:#9ac243;'>&nbsp;&nbsp;
  <label title=" Click on the item to negotiate online." ><b>Haat It </b></label>
  </span>{/if}{literal}<script >
  <code class="mix">$('#set2 *').tooltip();</code>
   </script>{/literal}
</fieldset>

 {/if}  </div>
		  <div class="imgTextDesc"><a href="item-details.php?details_item_value={$v_r.item_id}" title="{$v_r.title|ucfirst}">{$v_r.description|truncate:20:'...':true:true}</a></div>
		  </div>
		  {if $smarty.foreach.csdfall1.iteration%4==0 }
		  <div class="clear"></div>
		  {/if}
                 {*/if*}
					{/foreach}
					{else}
					<div>No items listed.</div>
					{/if}
					<div class="clear"></div>
					{if $total_recent_listed==12}
					<div style='text-align:right;'><a href="buyer.php">More</a></div>
					{/if}
				</div>
			</div>
			<div class="imgCatSec">
				<div class="catItemBg">
					<div class="catItemHed"><img src="images/cat_hdbull.jpg" alt="" class="vAlign" /> Featured Stores</div>							
					<div class="clear"></div>
				</div>
				<div class="grpImgBotBdr">
					{if $store}
					{foreach name=store_list from=$store  item=store}
					<div class="imgLftBdr">
						<div><a href="http://{$add_this_name_www}.{if $smarty.server.HTTP_HOST=='www.nethaat.com'}{$store.username}.{/if}{$add_this_name}/featured_store_information.php" title="{$store.username|ucfirst}"><img src="{$baseUrl}getthumb.php?w=150&h=100&fromfile=uploads/store_logos/{$store.v_store_image}" onerror="this.src='{$baseUrl}images/item_small_img.jpg'; this.style.width='150px'; this.style.height='100px';" alt="{$store.username|ucfirst}" class="catImgBdr" /></a></div>
						<div class="imgText"><a href="http://{$add_this_name_www}.{if $smarty.server.HTTP_HOST=='www.nethaat.com'}{$store.username}.{/if}{$add_this_name}/featured_store_information.php" title="{$store.username|ucfirst}"><strong>{$store.username|ucfirst|truncate:20}</strong></a></div>
						<div class="imgTextDesc"><a href="http://{$add_this_name_www}.{if $smarty.server.HTTP_HOST=='www.nethaat.com'}{$store.username}.{/if}{$add_this_name}/featured_store_information.php" title="{$store.username|ucfirst}">{$store.company_desc|truncate:20:'...':true:true}</a></div> 
					</div>
					{if $smarty.foreach.store_list.iteration%4==0 }
					<div class="clear"></div>
					{/if}
					{/foreach}
					{else}
					<div>No featured store listed.</div>
					{/if}
					<div class="clear"></div>
					{if $rows==13}
					<div style='text-align:right;'><a href="featured_more_store.php">More</a></div>
					{/if}
				</div>
			</div>
			
			<div class="imgCatSec">
				<div class="catItemBg">
					<div class="catItemHed"><img src="images/cat_hdbull.jpg" alt="" class="vAlign" /> Recent Post</div>							
					<div class="clear"></div>
				</div>
				<div class="grpImgBotBdr" style="float:left;">
				{$blog}
				<div class="clear"></div>
				</div>
				
				
			</div>
			
		</div>
		
	</div>
	<div class="clear"></div>

</div>

<!--End Middle-->


{include file="footer.tpl"}