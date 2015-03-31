<!--Start Logo-->
	<div class="bannerCon">
    	<div class="bannerMidBg">
        	<div class="banRBG">
            	<div class="banLBG">
                	<!--Start Search Part -->
                    <div class="banLeft">
                    	<div><img src="{$baseUrl}images/map_img.jpg" width="498" height="253" alt="" /></div>
                        <div class="searchCon">
                        	<div class="fl">
                            	<div class="botSearchBg"><input type="text" class="botSeaInput" value="Search by: Address, State, City or Zip" onfocus="clearText(this)" onblur="replaceText(this)" /></div>
                                <div class="eg">e.g. "New York, NY", "89148"</div>
                                <div class="priceBox">
                                Price Range $
                                <select name="" class="priceSel">
                                	<option>any</option>
                                </select>
                                To $
                                <select name="" class="priceSel">
                                	<option>any</option>
                                </select>
                                </div>
                            </div>
                            <div class="fr"><a href="#"><img src="{$baseUrl}images/search_btn.png" alt="" /></a></div>
                            <div class="clr"></div>
                        </div>
                  	</div>
                    <!--End Search Part -->
                    <!--Start Gallery Part -->
                    <div class="banRight">
                    	<div class="navi"><a class="active" href="#0">1</a><a href="#1">2</a><a href="#2">3</a><a href="#3">4</a></div>
                        <div class="scrollable" id="chained">
                        	<div class="items">
                            	<div class="firstBan">Online Real Estate <strong>Auction</strong></div>
                                <div class="secondBan">Online Real Estate <strong>Auction</strong></div>
                                <div class="thirdBan">Online Real Estate <strong>Auction</strong></div>
                                <div class="fourBan">Online Real Estate <strong>Auction</strong></div>
                            </div>
                        </div>
						{literal}
				             <script type="text/javascript">
							$(document).ready(function() {
							$("#chained").scrollable({circular: true, mousewheel: true}).navigator().autoscroll({
								interval: 5000		
							});	
							});
                            </script>
						 {/literal}
                    </div>
                    <!--End Gallery Part -->
                    <div class="clr"></div>
                </div>
            </div>
        </div>
    </div>
		<!--End Logo-->
		