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

function deleteaddress(addressid)
{
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("addressform_main_wrapper").innerHTML = xmlhttp.responseText;			
		}	
	}
	xmlhttp.open("GET","AJAX_AddressForm.php?id="+addressid,true);
	xmlhttp.send();	
}

function load_address_entryform(addressid,newentry)
{
	if(newentry == 0)
	{
		$("#tb_name").val($(".addressform_addresses:hover").find($(".addressform_address_name")).text());
		$("#tb_address").val($(".addressform_addresses:hover").find($(".addressform_address_address")).text());
		$("#tb_city").val($(".addressform_addresses:hover").find($(".addressform_address_city")).text());
		$("#tb_state").val($(".addressform_addresses:hover").find($(".addressform_address_state")).text());
		$("#tb_pin").val($(".addressform_addresses:hover").find($(".addressform_address_pin")).text());
		$("#tb_phone").val($(".addressform_addresses:hover").find($(".addressform_address_mobile")).text());
		$("#addressid").val(addressid);
	}
	else
	{
		$("#tb_name").val("");
		$("#tb_address").val("");
		$("#tb_city").val("");
		$("#tb_state").val("");
		$("#tb_pin").val("");
		$("#tb_phone").val("");
		$("#addressid").val("");
	}
	
	$(".div_addressform_edit_address_form_container").show();
	$(".div_address_form_shield").show();
}

function closepopup()
{
	$(".div_addressform_edit_address_form_container").hide();
	$(".div_address_form_shield").hide();
}
	

