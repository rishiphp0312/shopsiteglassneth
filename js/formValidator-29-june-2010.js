$(document).ready(function()
{
	//add code for ahref tool tip
	//$('a.title').cluetip({splitTitle: '|'});
	
	//var message = 'You missed to fill following mandatory field(s)';
	var message = "You missed to fill required field(s). They have been highlighted below";
	var message1 = 'You missed to fill required field. It has been highlighted below';
	
	//create classes for validation
	$('.alph_num').alphanumeric();
	$('.alph_num_username').alphanumeric({allow:".@"});
	$('.num_phone').numeric({allow:"+- "})
	
	$('.only_numeric').numeric({allow:""})
	$('.num_zip').alphanumeric({allow:"-"})
	$('.num_amount').numeric({allow:"."})
	$('.shoes_model').alphanumeric({allow:"- "})
	$('.alpha_numeric').alphanumeric({allow:"@#$%&-+*_. "})
	
	
	jQuery.validator.messages.required = "";
	

	//validate item quantity form
    // update-quantity
 $("#update-quantity").bind("invalid-form.validate", function(e, validator) {									
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                        /*var message = errors == 1
                                ? 'You missed 1 field. It has been highlighted below'
                                : 'You missed ' + errors + ' fields.  They have been highlighted below';*/
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
		rules: {  
				available_quantity:{  
						required:true,
					//	minlength: 3,
					//	remote:'check_email.php'
				}	 
				
				
					
				
			},
			messages: {  
					available_quantity: {  
						required:"Quantity can not be left blank.",
					//	minlength: "Username should be at least 3 characters long.",
					//	remote:jQuery.format("Username \"{0}\" have been used.")
					 }
										
					
					
				} 
		});


		/////by deepak start

				//************************** validate contact Seller  form for SMS *******

        $("#send_sms").bind("invalid-form.validate", function(e, validator) {									
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                        /*var message = errors == 1
                                ? 'You missed 1 field. It has been highlighted below'
                                : 'You missed ' + errors + ' fields.  They have been highlighted below';*/
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
				rules: {  
						sms:{
								required:true
						}
						
					},
					messages: {  
							sms:{  
								 required: "Message can not be left blank."
							}
						} 
		});

		//************************** validate contact Seller  form for EMAIL ******

        $("#contact_seller").bind("invalid-form.validate", function(e, validator) {									
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                        /*var message = errors == 1
                                ? 'You missed 1 field. It has been highlighted below'
                                : 'You missed ' + errors + ' fields.  They have been highlighted below';*/
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
				rules: {  
						f_name:{  
								 required:true  
							 },
						l_name:{
								required:true
						},
						contact_email:{
								required:true
						},
						message:{
								required:true
						}
						
					},
					messages: {  
							f_name: {  
								 required:"First name can not be left blank."
							 },
							l_name:{  
								 required: "Last name can not be left blank."
							},
							contact_email:{  
								 required: "E-mail address can not be left blank.",
								 email: "Please provide valid E-mail address."
							},
							message:{  
								 required: "Message can not be left blank."
							}
						} 
		});


		//************************************ validation for gift card **********




$("#frmGiftcard").bind("invalid-form.validate", function(e, validator) {								
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                        /*var message = errors == 1
                                ? 'You missed 1 field. It has been highlighted below'
                                : 'You missed ' + errors + ' fields.  They have been highlighted below';*/
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
		rules: {  
				name:{
						required: true
				},
				email:{
						required:true
						
				},
				amount:{
						required: true
				},
				city:{
						required: true
				},
				state:{
						required: true
				}
				
			},
			messages: {  
					city:{
						required: "Reciver City can not  blank."
					},
					amount:{
						required: "Amount can not be blank."
					},
					email:{
						required: "Email address can not be left blank.",
						email: "Provide valid email address."
					},
					name:{
						required: "Reciver Name can not be blank."
					},
					state:{
						required: "Reciver State can not be blank."
					}
				} 
		});
	//**********************************************

	//Validate User ItemRequest form
    $("#frmpayment").bind("invalid-form.validate", function(e, validator) {									
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                        /*var message = errors == 1
                                ? 'You missed 1 field. It has been highlighted below'
                                : 'You missed ' + errors + ' fields.  They have been highlighted below';*/
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
		rules: {  
				firstName:{
						required: true
				},
				lastName:{
						required: true
				},
				creditCardNumber:{
						required: true
				},
				cvv2Number:{
						required: true
				},
				address1:{
						required: true
				},
				city:{
						required: true
				},
				zip:{
						required: true
				}
				
			},
			messages: {  
					
					v_cc_zip:{
						required: "Zip code require."
					},
					v_cc_state:{
						required: "State can not be blank."
					},
					city:{
						required: "City can not be blank."
					},
					address1:{
						required: "Address1 can not be blank."
					},
					v_cc_cvc:{
						required: "CVC can not be blank."
					},
					zip:{
						required: "Zip code can not be blank."
					},
					cvv2Number:{
						required: "Verification Number not be blank."
					},
					creditCardNumber:{
						required: "Credit card number can not be blank."
					},
					lastName:{
						required: "last name can not be blank."
					},
					firstName:{
						required: "First Name can not be blank."
					}
				} 
		});
	

//Validate User Registration form
    $("#frmRequest").bind("invalid-form.validate", function(e, validator) {									
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                        /*var message = errors == 1
                                ? 'You missed 1 field. It has been highlighted below'
                                : 'You missed ' + errors + ' fields.  They have been highlighted below';*/
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
		rules: {  
				title:{
						required: true
				},
				price:{
						required: true
				},
				deadline:{
						required: true
				},
				quantity:{
						required: true
				},
				description:{
						required: true
				},
				tags:{
						required: true
				},
				material:{
						required: true
				},
				fullname:{
						required: true
				},
				street:{
						required: true
				},
				city:{
						required: true
				},
				state:{
						required: true
				},
				zipcode:{
						required: true
				}			
				
			},
			messages: {  
					
					title:{
						required: "Title can not be blank."
					},
					price:{
						required: "Price can not be blank."
					},
					fullname:{
						required: "Please fill your name."
					},
					material:{
						required: "Material can not be blank."
					},
					tags:{
						required: "Tags can not be blank."
					},
					description:{
						required: "Description can not be blank."
					},
					deadline:{
						required: "Please assign Deadline."
					},
					quantity:{
						required: "Quantity can not be blank."
					},
					street:{
						required: "Street can not be blank."
					},
					city:{
						required: "City can not be blank."
					},
					state:{
						required: "State can not be blank."
					},
					zipcode:{
						required: "Zip Code can not be blank."
					}
				} 
		});



		// by deepak end

	
	//Validate User Registration form
     $("#frmRegister").bind("invalid-form.validate", function(e, validator) {									
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                        /*var message = errors == 1
                                ? 'You missed 1 field. It has been highlighted below'
                                : 'You missed ' + errors + ' fields.  They have been highlighted below';*/
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
		rules: {  
				username:{  
						required:true,
						minlength: 3,
						remote:'check_email.php'
				},		 
				email:{
						required:true,
						email:true,
						remote:'check_email.php'
				},
				reemail:{
						required:true
				},
				password:{
						required:true,
						minlength: 6
				},
				repassword:{
						required:true
				},
				security_answer:{
						required:true
				},
				phone1:{
						required:true
				},
				
					agree:{
						required: true
					}
			
				
			},
			messages: {  
					username: {  
						required:"Username can not be left blank.",
						minlength: "Username should be at least 3 characters long.",
						remote:jQuery.format("Username \"{0}\" have been used.")
					 },
					email:{  
						required: "Email address can not be left blank.",
						email: "Provide valid email address.",
						remote:jQuery.format("Email \"{0}\" have been used.")
					},
					reemail:{  
						required: "Retype email can not be left blank.",
						equalTo: "Retype email should be matched with email entered above."
					},
					password:{  
						required: "Password can not be left blank.",
						minlength: "Password should be at least 6 characters long."
					},
					repassword:{  
						required: "Confirm password can not be left blank.",
						equalTo: "Confirm password should be matched with password entered above."
					},
					security_answer:{  
						required: "Security answer can not be left blank."
					},
					
					phone1:{
						required: "Phone number can not be left blank."
				},
				
					agree:{
						required: "Please accept terms of use."
					}
					
					
					
				} 
		});
	
//Validate Change address form
     $("#frmChangeAddress").bind("invalid-form.validate", function(e, validator) {									
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                        /*var message = errors == 1
                                ? 'You missed 1 field. It has been highlighted below'
                                : 'You missed ' + errors + ' fields.  They have been highlighted below';*/
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
				rules: {  
						change_address:{  
								 required:true
									 
							 },
					
					},
					messages: {  
							change_address: {  
								 required:"Address can not be left blank.",
								
							 },
							
						} 
		});
//end


//Validate genrate coupon  form
     $("#testform").bind("invalid-form.validate", function(e, validator) {									
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                        /*var message = errors == 1
                                ? 'You missed 1 field. It has been highlighted below'
                                : 'You missed ' + errors + ' fields.  They have been highlighted below';*/
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
				rules: {  
						testinput:{  
								 required:true
									 
							 },
								 testinput2:{  
								 required:true
									 
							 },
								 amount:{  
								 required:true
									 
							 },
								 
					
					},
					messages: {  
						testinput: {  
								 required:"Start Date can not be left blank.",
								
							 },
							testinput2: {  
								 required:"End Date can not be left blank.",
								
							 },
								 amount: {  
								 required:"Amount can not be left blank.",
								
							 },
							
						} 
		});
//end


 //Validate sell an item form
 
     $("#sell-itemform").bind("invalid-form.validate", function(e, validator) {									
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                       //var message = errors == 1
                         //       ? 'You missed 1 field. It has been highlighted below'
                           //     : 'You missed ' + errors + ' fields.  They have been highlighted below';
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
				rules: {  
						title:{  
								 required:true  
							 },
						price:{
								required:true,
									numberDE:true
								//minlength: 6
						},
							quantity:{
								required:true,
									numberDE:true
								//minlength: 6
						},
							max_quantity:{
								required:true,
									numberDE:true
								//minlength: 6
						},
							
					
					},
					messages: {  
							title: {  
								 required:"Title can not be left blank.",
								 //equalTo: "Entred value doesn't matched with existing Old password."
							 },
							price:{  
								 required: "Price can not be left blank.",
									 numberDE: "Please enter numeric value"
								// minlength: "Password should be at least 6 character long."
							},
								quantity:{  
								 required: "Minimum Quantity can not be left blank.",
									 numberDE: "Please enter numeric value"
							},
								max_quantity:{
								required: " Quantity can not be left blank.",
									 numberDE: "Please enter numeric value"
								//minlength: 6
						},
				
						} 
		});






//Validate Change email form
     $("#frmChangeemail").bind("invalid-form.validate", function(e, validator) {									
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                        /*var message = errors == 1
                                ? 'You missed 1 field. It has been highlighted below'
                                : 'You missed ' + errors + ' fields.  They have been highlighted below';*/
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
				rules: {  
						Email:{  
								
									 required:true,
								email:true
									//  Email:true/*,
									 //remote:'../check_email.php'*/
							 },
					
					},
					messages: {  
							Email: {  
								 required:"Email can not be left blank.",
									 email:'Please enter the valid email address'
								
							 },
							
						} 
		});
		


	//Validate Store/Business Details form
     $("#frmStore").bind("invalid-form.validate", function(e, validator) {									
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                        /*var message = errors == 1
                                ? 'You missed 1 field. It has been highlighted below'
                                : 'You missed ' + errors + ' fields.  They have been highlighted below';*/
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
		rules: {  
				first_name:{  
						required:true,
						minlength: 2						
				},		 
				last_name:{
						required:true,
						minlength: 2
				},
				address1:{
						required:true,
						minlength: 10
				},
				city:{
						required:true,
						minlength: 2
				},
				zipcode:{
						required:true,
						minlength: 5
				},
				state:{
						required:true,
						minlength: 2
				},
				phone1:{
						required:true,
						minlength: 10
				},
				paypal_email:{
						required:true,
						email:true,
						remote:'check_email.php'
				},
				company_name:{
						minlength: 3
				},
				company_address:{
						minlength: 10
				},
				company_phone:{
						minlength: 10
				},
				store_name:{
						minlength: 3
				},
				company_desc:{
						minlength: 50
				}
			},
			messages: {  
					first_name: {  
						required:"First name can not be left blank.",
						minlength: "First name should be at least 2 characters long."
					 },
					last_name:{  
						required: "Last name can not be left blank.",
						minlength: "Last name should be at least 2 characters long."
					},
					address1:{  
						required: "Address1 can not be left blank.",
						minlength: "Address1 should be at least 10 characters long."
					},
					city:{  
						required: "City name can not be left blank.",
						minlength: "City name should be at least 2 characters long."
					},
					zipcode:{  
						required: "Postal code can not be left blank.",
						minlength: "Postal code should be at least 5 characters long.",
					},
					state:{  
						required: "State name can not be left blank.",
						minlength: "State name should be at least 2 characters long."
					},
					phone1:{  
						required: "Phone number1 name can not be left blank.",
						minlength: "Phone number should be at least 10 characters long."
					},
					paypal_email:{  
						required: "Paypal email address can not be left blank.",
						email: "Provide valid email address.",
						remote:jQuery.format("Email \"{0}\" have been used.")
					},
					company_name:{  
						minlength: "Company name should be at least 3 characters long."
					},
					company_address:{  
						minlength: "Company address should be at least 10 characters long."
					},
					company_phone:{  
						minlength: "Business phone should be at least 10 characters long."
					},
					store_name:{  
						minlength: "Store name should be at least 3 characters long."
					},
					company_desc:{  
						minlength: "Business description should be at least 50 characters long."
					}
				} 
		});
		
		//Validate Login form
		$("#frmLogin").bind("invalid-form.validate", function(e, validator) {
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				if($("#error_warning_msg"))
				{
					$("#error_warning_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                       /* var message = errors == 1
                                ? 'You missed 1 field. It has been highlighted below'
                                : 'You missed ' + errors + ' fields.  They have been highlighted below';*/
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }
        }).validate();
		
		//validate Forgot Password
		$("#frmForgotPwd").bind("invalid-form.validate", function(e, validator) {
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                        /*var message = errors == 1
                                ? 'You missed 1 field. It has been highlighted below'
                                : 'You missed ' + errors + ' fields.  They have been highlighted below';*/
                        $("div.error span").html(message1);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }
        }).validate();
		
		//Validate Change password form
        $("#frmChangePassword").bind("invalid-form.validate", function(e, validator) {									
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                        /*var message = errors == 1
                                ? 'You missed 1 field. It has been highlighted below'
                                : 'You missed ' + errors + ' fields.  They have been highlighted below';*/
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
				rules: {  
						OldPassword:{  
								 required:true  
							 },
						Password:{
								required:true,
								minlength: 6
						},
						RePassword:{
								required:true
						}
					},
					messages: {  
							OldPassword: {  
								 required:"Old Password can not be left blank."
							 },
							Password:{  
								 required: "Password can not be left blank.",
								 minlength: "Password should be at least 6 character long."
							},
							RePassword:{  
								 required: "Confirm password can not be left blank.",
								 equalTo: "Confirm password should be matched with password entered above."
							}
						} 
		});
		
		//validate contact Us form
        $("#contact_us").bind("invalid-form.validate", function(e, validator) {									
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                        /*var message = errors == 1
                                ? 'You missed 1 field. It has been highlighted below'
                                : 'You missed ' + errors + ' fields.  They have been highlighted below';*/
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
				rules: {  
						f_name:{  
								 required:true  
							 },
						l_name:{
								required:true
						},
						contact_email:{
								required:true
						},
						message:{
								required:true
						},
						CaptchaCode:{
								required:true
						} 
					},
					messages: {  
							f_name: {  
								 required:"First name can not be left blank."
							 },
							l_name:{  
								 required: "Last name can not be left blank."
							},
							contact_email:{  
								 required: "E-mail address can not be left blank.",
								 email: "Please provide valid E-mail address."
							},
							message:{  
								 required: "Message can not be left blank."
							},
							CaptchaCode:{  
								 /*required: "Security code can not be left blank."*/
							}
						} 
		});
		
		//validate NewsLetter submition form
		$("#frmNewsletter").bind("invalid-form.validate", function(e, validator) {
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                        $("div.error span").html(message1);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }
        }).validate();
					   
$.validator.setDefaults({
	submitHandler: function() { 
	$("#frmRegister").submit();
	$("#my_account").submit();
	$("#frmLogin").submit();
	$("#frmForgotPwd").submit();
	$("#contact_us").submit();
	}
});
						   
	 $("input.phone").mask("(999)999-9999");			   
	 $("input.zipcode").mask("99999");						   
	 $("input.coupon_start_date").mask("12/31/9999");
	 $("input.coupon_expiry_date").mask("12/31/9999");	
});


function save_user_fav_property(mls_no)
{
	var url = "search.php";
	var postData = "save=yes&mls_no="+mls_no;
	var handleSuccess = function(o)
	{
		//alert(o.responseText);
		//if added successfully
		if(o.responseText==1)
		{
			//window.location.reload();
			alert("This property has been added to your favorite list.");
			//window.location = 'favorite_properties.php';
		}
		//if failure
		if(o.responseText==2)
		{
			alert("Error occured please try again later.");
		}
		//not logged in
		if(o.responseText==3)
		{
			alert("Please login first to save this property.");
			window.location = 'do_login.php';
		}
		//already exists
		if(o.responseText==4)
		{
			alert("This property already saved in your favorite list.");
		}
	};
	var handleFailure = function(o)
	{
		alert("Sorry. your browser not able to handle this request.");
	};
	var deleteCallBack =
	{
		  success:handleSuccess,
		  failure:handleFailure
	};
	var request = YAHOO.util.Connect.asyncRequest('POST', url, deleteCallBack, postData);
}