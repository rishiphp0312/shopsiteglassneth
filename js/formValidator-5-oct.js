//$('input:radio[name=bar]:checked').val();

$(document).ready(function()
{
	//add code for ahref tool tip
	//$('a.title').cluetip({splitTitle: '|'});
	
	//var message = 'You missed to fill following mandatory field(s)';
	var message = "You missed to fill required field(s). They have been highlighted below";
	var message1 = 'You missed to fill required field. It has been highlighted below';
	
	//create classes for validation
	
	$('.alph_num').alphanumeric();
	
	$('.alph_num_space').alphanumeric({allow:" "});
	$('.alph_num_username').alphanumeric({allow:".@"});
	$('.num_phone').numeric({allow:"+- "})
	
	$('.only_numeric').numeric({allow:""})
	$('.num_zip').alphanumeric({allow:"-"})
	$('.num_amount').numeric({allow:"."})
	$('.shoes_model').alphanumeric({allow:"- "})
	$('.alpha_numeric').alphanumeric({allow:"@#$%&-+*_. "})
	
	
	jQuery.validator.messages.required = "";
	

	 $("#frmgenrate_ticket").bind("invalid-form.validate", function(e, validator) {									
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
							 }	,
						message:{
								required:true
							     }
						      },
					   messages: {  
							subject: {  
								 required:" Subject can not be left blank."
								 	 }
						          ,							
						        message:{
								required: " Message can not be left blank."
							             }
						
						} 
		});
	
	$("#sell-itemform").bind("invalid-form.validate", function(e, validator) {									
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
						title:{  
								 required:true  
							 }
							
							 ,
				
				         price:{
								  required:true
								},
			              quantity:{
								   required:true,
									numberDE:true
						
						            }
									 ,
			               max_quantity:{
							    	required:true,
									numberDE:true
								
						            },
			               style_id:{
								required:true
						
						              }
									   ,
						   color:{
								required:true
							
						           }
						      },
					messages: {  
							title: {  
								 required:"Title can not be left blank."
								 //equalTo: "Entred value doesn't matched with existing Old password."
								 }
								 ,
							price:{  
								 required: "Price can not be left blank."
									// numberDE: "Please enter numeric value"
								// minlength: "Password should be at least 6 character long."
							},
								quantity:{  
							    	 required: "Minimum Quantity can not be left blank.",
									 numberDE: "Please enter numeric value"
							}
								,
								max_quantity:{
								required: " Quantity can not be left blank.",
									 numberDE: "Please enter numeric value"
								//minlength: 6
						},
						style_id:{
								required: " Style can not be left blank."
							
						},
						color:{
								required: " Colour can not be left blank."
							
						}
						
						
				
						} 
		});



 //Validate Email to friend page
 
     $("#frm_email_to_friend").bind("invalid-form.validate", function(e, validator) {									
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
						frinds_email:{  
						    	required:true  
							 },
						friend_name:{
								required:true
								},
		              	yours_name:{
						       required:true
							      },
			            yours_email:{
								required:true
							      },
			            message_post:{
							     required:true
								}
						
					},
					messages: {  
						frinds_email: {  
						 required:"Friends email can not be left blank."
									 } ,
						friend_name:{  
						  required:"Friends Name can not be left blank."
								     }   ,
						 yours_name:{  
						  required: "Yours Name can not be left blank."
									}   ,
						 yours_email:{
						  required: "Yours Email can not be left blank."
							        }  ,
						  message_post:{  
						   required: "Message can not be left blank."
										}
								} 
		});







/////by deepak start num


//****************************** LOCKER CREATION FORM ***********************
   
		$("#locker_password").bind("invalid-form.validate", function(e, validator) {				   
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
						locker_pass:{
							required:true,
							minlength: 6
						},
						repassword:{
								required:true
						}
												
					},
					messages: {  
							locker_pass:{  
								required: "Password can not be left blank.",
								minlength: "Password should be at least 6 characters long."
							},
							repassword:{  
								required: "Confirm password can not be left blank.",
								equalTo: "Confirm password should be matched with password entered above."
							}
					}
		});
		
		    
/////by deepak start num


//************************** validate Seller INFORMATION form for UPDATE *******
	
		$("#frmgenrate_coupon").bind("invalid-form.validate", function(e, validator) {									
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
						testinput:{  
								 required:true  
							 },
						testinput2:{
								required:true
						},
						amount:{
								required:true
						},
						available_items:{  
								 required:true
							}
						
					},
					messages: {  
							testinput: {  
								 required:"Start date can not be left blank."
							 },
							testinput2:{  
								 required: "End date can not be left blank."
							},
							amount:{  
								 required: "Amount can not be left blank."
							},
							
							available_items:{  
								 required: "Please select Items ."
							}

							
							
							
						} 
		});



//************************** validate contact Seller  form for SMS *******

 
  $("#send_sms").bind("invalid-form.validate", function(e, validator) {				   
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
				}
				,
				creditCardNumber:{
						required: true
				}
				,
				cvv2Number:{
						required: true
				}
				,
				address1:{
						required: true
				},
				city:{
						required: true
				},
				zip:{
						required: true
				},
				state:{
						required: true
					}
				
				
			},
			messages: {  
					lastName:{
						required: "last name can not be blank."
					},
					firstName:{
						required: "First Name can not be blank."
					},
					cvv2Number:{
						required: "Verification Number not be blank."
					},
					creditCardNumber:{
						required: "Credit card number can not be blank."
					}
					,
		          
					city:{
						required: "City can not be blank."
					}
					,
					address1:{
						required: "Address1 can not be blank."
					},
						zip:{
						required: "Zip code can not be blank."
					},
					 state:{
						required: "State can not be blank."
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
				quantity:{
						required: true
				},
				material:{
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
			    ,
				fullname:{
						required: true
				},
				description:{
						required: true
				},
				deadline:{
						required: true
				},
				street:{
						required: true
				},
					tags:{
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
					quantity:{
						required: "Quantity can not be blank."
					},
					material:{
						required: "Material can not be blank."
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
					,
					fullname:{
						required: "Please fill your name."
					},description:{
						required: "Description can not be blank."
					},
					deadline:{
						required: "Please assign Deadline."
					},
						street:{
						required: "Street can not be blank."
					},
					tags:{
						required: "Tags cannot be blank"
				}
				
					
				} 
		});

  
		// by deepak end




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
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
		rules: {  
				available_quantity:{  
						required:true
				}	 
			},
			messages: {  
					available_quantity: {  
						required:"Quantity can not be left blank."
					 }
				} 
		});
 


	// validte for add ing reminder	frmadd_reminder
	
	$("#frmadd_reminder").bind("invalid-form.validate", function(e, validator) {									
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
				 
				 
					 name_of_relatives:{
						required:true		},
				Email:{
						required:true,
						email:true
						//remote:'check_email.php'
				},
				event_name:{
						required:true
				},
				
				event_month:{
						required:true
				},

				
					event_day:{
						required: true
					}
			
				
			},
			messages: {  
				 name_of_relatives:{
						required: "Name of realtives can not be left blank."
							},
					
					Email:{  
						required: "Email address can not be left blank.",
						Email: "Provide valid email address."
						//remote:jQuery.format("Email \"{0}\" have been used.")
					},
					
					
					event_month:{  
						required: "Month can not be left blank."
					},
					event_day:{

						required: "Day can not be left blank."
				},
					event_name:{
						required: "Event Name can not be left blank."
				}
				
					
					
				} 
		});

	//Validate User Registration form
   $("#frmRegister").bind("invalid-form.validate", function(e, validator) {									

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
				first_name:{
						required:true
						
				},
				last_name:{
						required:true
						},
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

							zipcode:{
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
			
			        first_name:{
					required:"First Name can not be left blank."
					 		},
				    last_name:{
				    required:"Last Name can not be left blank."
						},
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
					zipcode:{
					required: "Zipcode can not be left blank."
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
                        $("div.error span").html(message);
                        $("div.error").show();
                } else {
                        $("div.error").hide();
                }	
        }).validate({	
				rules: {  
						change_address:{  
								 required:true
							 }
					},
					messages: {  
							change_address: {  
								 required:"Address can not be left blank."
							 }
						} 
		});
//end







//Validate Change email form

  $("#frmChangeemail").bind("invalid-form.validate", function(e, validator) {									
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
						Email:{  
								
									 required:true,
								     email:true
							 }
					
					},
					messages: {  
							Email: {  
								 required:"Email can not be left blank.",
									email:'Please enter the valid email address'
								
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
							}
						} 
		});
		
	
		
		
		

//************************** validate Seller INFORMATION form for UPDATE *******
	
    $("#frmStore_upd_new").bind("invalid-form.validate", function(e, validator) {									
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
						f_name:{  
								 required:true  
							 },
						l_name:{
								required:true
						},
						phone1:{
								required:true
						},
						address1:{
								required:true
						},
						city:{  
								required:true  
						}	,
						state:{
								required:true
						} ,
						zipcode:{
								required:true
						},
						
						paypal_email:{
								required:true
						}  ,
						company_name:{  
								 required:true  
					    } 
						,
						company_address:{
								required:true
						}  ,
						company_phone:{
								required:true
						}  ,
						company_desc:{
								required:true
						} ,
						store_name:{
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
							phone1:{  
								 required: "Phone number can not be left blank."
							},
				
							address1:{  
								 required: "Address can not be left blank."
							},
							city:{  
								 required: "City name can not be left blank."
							}
							,
							state:{  
								 required: "State field can not be left blank."
							}
							,
							
							zipcode:{  
								 required: "zipcode can not be left blank."
							}
							,
                            paypal_email:{  
								 required: "E-mail address can not be left blank.",
								 email: "Please provide valid E-mail address."
							}	,
							store_name:{  
								 required: "Store name can not be left blank."
							},
							company_desc:{  
								 required: "Company desc can not be left blank."
							},
							company_phone:{  
								 required: "Company phone can not be left blank."
							},
							company_address:{  
								 required: "Company address can not be left blank."
							},
							company_name:{  
								 required: "Company name can not be left blank."
							}
							
						} 
		});

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