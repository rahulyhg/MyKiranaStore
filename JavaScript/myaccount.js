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
function LoadRightPanel(from)
{
	$("#loadingicon_home").show();	
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			$("#loadingicon_home").hide();
			document.getElementById("account_right_panel_container").innerHTML = xmlhttp.responseText;
			if(from == 1)
			{
				$("#account_right_panel_heading").text("My Orders");
			}
			else if(from == 2)
			{
				$("#account_right_panel_heading").text("Edit Your Profile");
			}
			else if(from == 3)
			{
				$("#account_right_panel_heading").text("Manage Your Addresses");
			}
		}
	}

xmlhttp.open("GET","AJAX_MyAccount.php?from="+from,true);
xmlhttp.send();
}

//for updating user information...
function UpdateInfo(from)
{
	$("#loadingicon_home").show();	
	if(from == 2)
	{
		var fname = $("#tb_firstname").val();
		var lname = $("#tb_lastname").val();
		var dob = $("#tb_dob").val();
		var mobile = $("#tb_mobile").val();
		var sex = $("#radio_sex:checked").val();
	}
	
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			alert("hii");
			//document.location.href = "AJAX_UpdateAccountInfo.php?from="+from+"&fname="+fname+"&lname="+lname+"&dob="+dob+"&mobile="+mobile+"&sex="+sex;
			document.getElementById("account_right_panel_container").innerHTML = xmlhttp.responseText;
			$("#loadingicon_home").show();
		}
	}

if(from == 1)
{
	xmlhttp.open("GET","AJAX_UpdateAccountInfo.php?from="+from+"&fname="+fname+"&lname="+lname+"&dob="+dob+"&mobile="+mobile+"&sex="+sex,true);
	xmlhttp.send();
}
else if(from == 2)
{
	xmlhttp.open("GET","AJAX_UpdateAccountInfo.php?from="+from+"&fname="+fname+"&lname="+lname+"&dob="+dob+"&mobile="+mobile+"&sex="+sex,true);
	xmlhttp.send();
}
else if(from == 3)
{
	xmlhttp.open("GET","AJAX_UpdateAccountInfo.php?from="+from+"&fname="+fname+"&lname="+lname+"&dob="+dob+"&mobile="+mobile+"&sex="+sex,true);
	xmlhttp.send();
}
}

function vieworderdetails(orderid)
{
	//alert(orderid);
	$('.div_home_shield').show();
	$('.div_home_cart_popup').show();	
	$("#loadingicon_popup_revieworder").show();	
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			$("#loadingicon_popup_revieworder").hide();	
			//document.location.href = "AJAX_UpdateAccountInfo.php?from="+from+"&fname="+fname+"&lname="+lname+"&dob="+dob+"&mobile="+mobile+"&sex="+sex;
			document.getElementById("div_home_cart_popup").innerHTML = xmlhttp.responseText;
			$("#loadingicon_home").show();
		}
	}

	xmlhttp.open("GET","AJAX_UpdateAccountInfo.php?orderdetail=1&orderid="+orderid,true);
	xmlhttp.send();
}
