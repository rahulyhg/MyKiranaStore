// JavaScript Document

var xmlhttp;
if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}


//for hiding one part if another one is on focus..
$(document).ready(function()
{	
	$("#tb_emailid,#tb_password").focus(function()
	{
		$(".loginform_left_panel_loginform").css('opacity','1');
		$(".loginform_left_panel_registerform").css('opacity','0.3');
	});
});


//for hiding one part if another one is on focus..
$(document).ready(function()
{	
	$("#tb_registerform_emailid,#tb_registerform_password,#tb_registerform_confirmpassword").focus(function()
	{
		$(".loginform_left_panel_loginform").css('opacity','.3');
		$(".loginform_left_panel_registerform").css('opacity','1');
	});
});
	
	
//script for login form.

$(document).ready(function()
{	
	$('#loginform').submit(function(event){
		if(this.checkValidity())
		{
			event.preventDefault();
				xmlhttp.onreadystatechange=function()
				{
					$(".loginform_form_container").fadeTo(800,0.4);
					$("#loadingicon").show();
					//alert(xmlhttp.responseText.trim());
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						$(".loginform_form_container").fadeTo(1,1);
						$("#loadingicon").hide();
						//	alert(xmlhttp.responseText.trim().charAt(0));
						if(xmlhttp.responseText.trim().charAt(0) == 0)
						{
							alert("Please register first to place order");
							$("#tb_registerform_emailid").focus();	
						}
						else if(xmlhttp.responseText.trim().charAt(0) == 1)
						{
							alert("Wrong UserName and Password");
							$("#tb_emailid").focus();	
						}
						else if(xmlhttp.responseText.trim().charAt(0) == 2)
						{
							alert("Logged in successfully");
							document.location.href = "AddressForm.php";
						}
						else if(xmlhttp.responseText.trim().charAt(0) == 5)
						{
							alert("Logged in successfully");
							document.location.href = "MyAccount.php";
						}
						else if(xmlhttp.responseText.trim().charAt(0) == 6)
						{
							alert("Logged in successfully");
							document.location.href = "index.php";
						}
					}
				}
				var email = $("#tb_emailid").val();
				var password = $("#tb_password").val();
				if(ValidateEmail(email))
				{
					xmlhttp.open("GET","AJAX_ValidateUser.php?email="+email+"&pass="+password,true);
					xmlhttp.send();
				}
				else
					alert("Please enter valid email id");
		}
		else
		{
			alert("not valid");	
		}
	});
});



//script for registration form
$(document).ready(function()
{	
	$('#registerform').submit(function(event){
		if(this.checkValidity())
		{
			event.preventDefault();
				xmlhttp.onreadystatechange=function()
				{
					$(".loginform_form_container").fadeTo(800,0.4);
					$("#loadingicon").show();
					//alert(xmlhttp.responseText.trim().charAt(0));					
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						$(".loginform_form_container").fadeTo(1,1);
						$("#loadingicon").hide();
						//document.location.href = "AJAX_ValidateUser.php?email="+email+"&pass="+password+"&new=1";
						if(xmlhttp.responseText.trim().charAt(0) == 0)
						{
							alert("Please register first to place order");
							$("#tb_registerform_emailid").focus();	
						}
						else if(xmlhttp.responseText.trim().charAt(0) == 4)
						{
							alert("You are already Registerd!Please login here.");
							$("#tb_emailid").val($("#tb_registerform_emailid").val());	
							$("#tb_password").focus();	
							
						}
						else if(xmlhttp.responseText.trim().charAt(0) == 3)
						{
							alert("registerd successfully");
							document.location.href = "AddressForm.php";
						}
						else if(xmlhttp.responseText.trim().charAt(0) == 5)
						{
							alert("registerd successfully");
							document.location.href = "MyAccount.php";
						}
						else if(xmlhttp.responseText.trim().charAt(0) == 6)
						{
							alert("registerd successfully");
							document.location.href = "index.php";
						}
					}
				}
				
				var email = $("#tb_registerform_emailid").val();
				var password = $("#tb_registerform_password").val();
				var confirmpassword = $("#tb_registerform_confirmpassword").val();
				if(ValidateEmail(email))
				{
					if(password == confirmpassword)
					{
						xmlhttp.open("GET","AJAX_ValidateUser.php?email="+email+"&pass="+password+"&new=1",true);
						xmlhttp.send();
					}	
					else
					{
						alert("Password and Confirm Password Does not Match");
						$("#tb_registerform_password").focus();	
					}
				}
				else
					alert("Please enter valid email id");
		}
	});
});


function ValidateEmail(email)
{
	var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if (filter.test(email)) 
		return true;
	else 
		return false;
}