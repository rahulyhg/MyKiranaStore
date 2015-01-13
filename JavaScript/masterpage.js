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



function Logout()
{	
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			//if(from == 0) // to load cart at home page..
				document.getElementById("div_home_cart_bottom_container").innerHTML = xmlhttp.responseText;
			//else 	//to load cart popup
				//document.getElementById("div_home_cart_popup").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","AJAX_AddToCart.php?new=1",true);
	xmlhttp.send();
}
