$(document).ready(function()
{
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
	
	
	$("#frm_bulk_mailUser").bind("invalid-form.validate", function(e, validator) {									
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                     
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
				rules: {  
						heading1:{
								required:true								
						}
						
						
					},
					messages: {  
							heading1:{  
								 required: "Option 1 Heading1  can not be left blank."								
							            }
						} 
		});




	$("#frmAdminpaymentAccount").bind("invalid-form.validate", function(e, validator) {									
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                     
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
				rules: {  
						API_USERNAME:{
								required:true								
						},
						API_PASSWORD:{
								required:true								
						},
						API_SIGNATURE:{
								required:true								
						},
						
					},
					messages: {  
							API_USERNAME:{  
								 required: "Username  can not be left blank."								
							            },
						    API_PASSWORD:{
								required: "Password  can not be left blank."								
						              },
							API_SIGNATURE:{
								required: "Signature  can not be left blank."
								            }
						} 
		});

////validate slabs

	$("#frmAdditemslabs").bind("invalid-form.validate", function(e, validator) {
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {

                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }
        }).validate({
				rules: {
					      package_name:{
								required:true

						},
				   
					       end_item_range:{
								required:true

						},
                                                 amount_1month:{
								required:true

						},
                                                amount_6month:{
								required:true

						},
                                               amount_12month:{
								required:true

						},
                                              start_item_range:{
								required:true

						}
					},
				messages: {
						package_name:{
								 required: "Package name  can not be left blank."

							},
                                 end_item_range:{
								required: "Item range cannot be left blank."

						},
                                 amount_1month:{
						
								required:"Monthly Amount cannot be left blank."

						},
                                                                                        				                                amount_6month:{

								required:"6 Month Amount cannot be left blank."

						},
                                                                                                                                 amount_12month:{

								required:"yearly Amount cannot be left blank."

						},
	

					      	start_item_range:{
								required: "Item range cannot be left blank."

						}
						}
		});



// end of slabs



        //Validate  quantity  and cost for payment of item.
      
	$("#frm_assign_quantity").bind("invalid-form.validate", function(e, validator) {									
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                     
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
				rules: {  
						set_quantity:{
								required:true
								
						},
						set_cost:{
								required:true
								
						}
					},
					messages: {  
							set_quantity:{  
								 required: "Quantity  can not be left blank."
								
							},
								set_cost:{
								required: "Cost can not be left blank."
								
						}
						} 
		});





	//Validate Add/Edit User form
 
	$("#frmAddUser").bind("invalid-form.validate", function(e, validator) {									
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                           $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
					rules: {  
							FirstName:{  
									 required:true  
								 },		 
							 LastName:{  
									 required:true  
								 },
					
						     Email:{
									 required:true
							    },
							 username:{
									 required:true
							    }
	
							
							
								/*company_name:{
									required:true
							},
							Password:{
									required:true,
									minlength: 6
							},
							RePassword:{
									required:true
							},
							company_address:{
									required:true
							},
							state:{
									required:true
							},
							company_phone:{
									required:true
							},
							company_desc:{
									required:true
							},
							store_name:{
									required:true
							},
							v_welcome:{
								required:true
							},
							v_payment:{
									required:true
							},
							v_shipping:{
									required:true
							},
							v_refund_exchange:{
									required:true
							},
							v_additional_info:{
									required:true
							},
							paypal_email:{
									required:true
							}
							*/
						},
						messages: {  
								FirstName: {  
									 required:"First name can not be left blank."  
								 },
								LastName: {  
									 required:"Last name can not be left blank."  
								 },
							Email:{  
									 required: "Email can not be left blank.",
									 email: "Provide valid email address."
								},
								username:{  
									 required: "Username can not be left blank."
									
								}
									/*,
								Password:{  
									 required: "Password can not be left blank.",
									 minlength: "Password should be at least 6 character long."
								},
								RePassword:{  
									 required: "Confirm password can not be left blank.",
									 equalTo: "Confirm password should be matched with password entered above."
								},
									state:{  
									 required: "State can not be left blank."
									 
								},
									company_name:{  
									 required: "Company name can not be left blank."
									 
								},
									company_address:{  
									 required: "Company address can not be left blank."
									 
								},
									company_phone:{  
									 required: "Company phone can not be left blank."
									 
								},
									company_desc:{  
									 required: "Company desc can not be left blank."
									 
								},
									store_name:{  
									 required: "Store name can not be left blank."
									 
								},
									v_welcome:{  
									 required: "Welcome Note can not be left blank."
									 
								},
									v_payment:{  
									 required: "Payment Note can not be left blank."
									 
								},
									v_shipping:{  
									 required: "Shipping Note can not be left blank."
									 
								},
									v_refund_exchange:{  
									 required: "Refund exchange Note can not be left blank."
									 
								},
									v_additional_info:{  
									 required: "Additional info Note can not be left blank."
									 
								},
									paypal_email:{  
									 required: "Paypal email info Note can not be left blank."
							 
								}*/ 
							}
				});
		

//Validate User ItemRequest form
    $("#frm_assign_style").bind("invalid-form.validate", function(e, validator) {									
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
		rules: {  
				set_style:{
						required: true
				}
				
			},
			messages: {  
					
					set_style:{
						required: "Style can not be blank."
					}	
					
					
				} 
		});
		
		
		// frmAddtutorial validate file
	 $("#frmAddtutorial").bind("invalid-form.validate", function(e, validator) {									
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                     
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
				rules: {  
						flv_tutorial:{
								required:true
								
						}
					},
					messages: {  
							flv_tutorial:{  
								 required: "Please select any flv file."
								
							}
						} 
		});
	 
			//Validate Add/Edit Category form
     $("#frmAddCategory").bind("invalid-form.validate", function(e, validator) {									
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                       
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
				rules: {  
						name:{  
						       required:true  
							 },
					    description:{
							    required:true,
                                maxlength: 200
						 }	
					},
					messages: {  
							name: {  
								 required:"Category name can not be left blank."
							 },
							 description: {  
								 required:"Category description can not be left blank.",
								 maxlength: "Category description can contains only 200 characters."
							 }
						} 
		});

	//Validate Change password form
     $("#frmChangePassword").bind("invalid-form.validate", function(e, validator) {									
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
				rules: {  
						old_password:{  
								 required:true  
							 },
						new_password:{
								required:true,
								minlength: 6
						},
						confirm_new_password:{
								required:true
						}
					},
					messages: {  
							old_password: {  
								 required:"Old Password can not be left blank."
								// equalTo: "Entered value doesn't matched with existing Old password."
							 },
							new_password:{  
								 required: "Password can not be left blank.",
								 minlength: "Password should be at least 6 character long."
							},
							confirm_new_password:{  
								 required: "Confirm password can not be left blank.",
								 equalTo: "Confirm password should be matched with password entered above."
							}
						} 
		});



//frmAddCategory

//Validate Admin Account form
     $("#frmAdminAccount").bind("invalid-form.validate", function(e, validator) {									
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
               
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
				rules: {  
						admin_name:{  
								 required:true  
							 },
						admin_user_name:{
								required:true,
								minlength: 5
						},
						admin_email:{
								required:true,
								email:true
						}
					},
					messages: {  
							admin_name: {  
								 required:"Name can not be left blank."
							 },
							admin_user_name:{  
								 required: "Admin username can not be left blank.",
								 minlength: "Admin username should be at least 5 character long."
							},
							admin_email:{  
								 required: "Admin email can not be left blank.",
								 email: "Please enter valid email address."
							}
						} 
		});

//Validate  Password form
     $("#frmAdminforgotPwd").bind("invalid-form.validate", function(e, validator) {									
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                     
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
				rules: {  
						admin_email:{
								required:true,
								email:true
						}
					},
					messages: {  
							admin_email:{  
								 required: "Admin email can not be left blank.",
								 email: "Please enter valid email address."
							}
						} 
		});
	 
//Validate  User Bulk mail form 1
        $("#frm_bulk_mailUser").bind("invalid-form.validate", function(e, validator) {									
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                        
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
					rules: {  
							subject:{  
									 required:true  
								 },		 
							 LastName:{  
									 required:true  
								 },
							Email:{
									 required:true,
									 email:true
							}
							
						},
						messages: {  
								subject: {  
									 required:"Subject can not be left blank."  
								 },
								LastName: {  
									 required:"Last name can not be left blank."  
								 },
								Email:{  
									 required: "Email can not be left blank.",
					
								}
						
							} 
				});


//Validate  User send single user mail form
        $("#frm_user_send_mail").bind("invalid-form.validate", function(e, validator) {									
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
					rules: {  
							subject:{  
									 required:true  
								 }	 
						
							
						},
						messages: {  
								subject: {  
									 required:"Subject can not be left blank."  
								 }
						
							} 
				});
	


//Validate Add/Edit CMS form
     $("#addCMSFrm").bind("invalid-form.validate", function(e, validator) {									
                //hide update msg div
				if($("#update_msg"))
				{
					$("#update_msg").hide();
				}
				var errors = validator.numberOfInvalids();
                if (errors) {
                       
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
				
		});
		
	
$.validator.setDefaults({
	submitHandler: function() { 
	$("#my_account").submit();
	}
});
						   
	 $("input.phone").mask("(999)999 9999");			   
	 $("input.zipcode").mask("99999");						   
	 //$("input.coupon_start_date").mask("12/31/9999");
	 //$("input.coupon_expiry_date").mask("12/31/9999");	
});