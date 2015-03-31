  {include file="header.tpl"} 
      <div class="bradcrum"><span>You are here:</span>- <a href="{$baseUrl}index.php">Home</a> | Contact</div>
    <!--Start Banner -->
    <div class="insideBanner">Contact<span>Online Real Estate Auction</span></div>
    <!--End Banner -->
    <!--Start Middle Part -->
    <div class="midCon">
    	<!--Start Middle Left -->
        <div class="midLeft">
		<form action="" method="post" name="contactus-frm" id="contactus-frm">
		
            <div class="contactBox">
            	<div class="insideHd">Contact Form</div>
                <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to ma</div><br />
				<div>{include file="error_msg_template.tpl"}</div><br />
				
				
                <div class="contactField">Name</div>
                <div class="contactLabal">
                	<div class="contactIPBG"><input type="text" id="contactname" name="contactname" class="required contactInput" /></div>
                </div>
                <div class="clr"></div>
                <div class="contactField">Email Address</div>
                <div class="contactLabal">
                	<div class="contactIPBG"><input type="text" id="contactemail" name="contactemail" class="required contactInput" /></div>
                </div>
                <div class="clr"></div>
                <div class="contactField">Phone</div>
                <div class="contactLabal">
                	<div class="contactIPBG"><input type="text"
					id="contactphone" name="contactphone" class="required contactInput" /></div>
                </div>
                <div class="clr"></div>
                <div class="contactField">Message</div>
                <div class="contactLabal">
                	<div class="contactTABG"><textarea cols="2" 
					id="contactmessage" name="contactmessage" rows="2" class="required contactTA"></textarea></div>
                </div>
                <div class="clr"></div>
                <div class="contactField"></div>
                <div class="contactLabal"><input name="send" type="image" src="images/contact_btn.png" /></div>
                <div class="clr"></div>
            </div>
        
		</form>
		</div>
        <!--End Middle Left -->
        <!--Start Middle Right -->
        {include file="right-menu.tpl"}
        <!--End Middle Right -->
        <div class="clr"></div>
    </div>
    <!--End Middle Part -->
    <!--Start Footer -->
    {include file="footer.tpl"}
    <!--End Footer -->
</div>
</body>
</html>
