
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


$(document).ready(function(){
  $('.bxslider').bxSlider();
});

function LoadExistingCart()
{	
	xmlhttp.onreadystatechange=function()
	{
		$("#loadingicon_home").show();
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			//if(from == 0) // to load cart at home page..
				$("#loadingicon_home").hide();
				document.getElementById("div_home_mycart").innerHTML = xmlhttp.responseText;
			//else 	//to load cart popup
				//document.getElementById("div_home_cart_popup").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","AJAX_AddToCart.php?new=1",true);
	xmlhttp.send();
}

function AddToCart(id,from)
{	
	xmlhttp.onreadystatechange=function()
	{
		if(from == 0) // to load cart at home page..
			$("#loadingicon_home").show();	
		else if(from == 1) 	//to load cart popup
			$("#loadingicon_popup").show();
		else if(from == 2)
			$("#loadingicon_review").show()
		
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			$("#loadingicon").hide();
			if(from == 0) // to load cart at home page..
			{
				$("#loadingicon_home").hide();
				document.getElementById("div_home_mycart").innerHTML = xmlhttp.responseText;
			}
			else if(from == 1) 	//to load cart popup
			{
				$("#loadingicon_popup").hide();
				document.getElementById("div_home_cart_popup").innerHTML = xmlhttp.responseText;
			}
			else if(from == 2)
			{
				$("#loadingicon_review").hide();
				document.getElementById("revieworder_order_container").innerHTML = xmlhttp.responseText;
			}
		}
	}
	if(from == 0) 	//to load cart at home page..
		var item_unit = $(".div_home_offers_container_quantity_wrapper:hover").find('input[type="text"]').val();
	else if(from == 1)	//to load cart popup
		var item_unit = $(".div_home_cart_popup_item_quantity:hover").find('input[type="text"]').val();
	else if(from == 2) //to load cart at review page..
		var item_unit = $(".div_home_cart_popup_item_quantity:hover").find('input[type="text"]').val();
		
	xmlhttp.open("GET","AJAX_AddToCart.php?id="+id+"&unit="+item_unit+"&from="+from,true);
	xmlhttp.send();
}

function decreasequantity(minquantity,item_unit)
{
	var initval = $(".div_home_offers_container_quantity_wrapper:hover").find('input[type="text"]').val();
	initval = initval.split(" ")[0];
	if(parseFloat(initval) > 0)
	{
		initval = parseFloat(initval) - parseFloat(minquantity);
	}
	initval = initval.toFixed(2);
	$(".div_home_offers_container_quantity_wrapper:hover").find('input[type="text"]').val(initval + " " + item_unit);
}


function decreasequantity_popup(minquantity,item_unit)
{
	var initval = $(".div_home_cart_popup_item_quantity:hover").find('input[type="text"]').val();
	initval = initval.split(" ")[0];
	if(parseFloat(initval) > 0)
	{
		initval = parseFloat(initval) - parseFloat(minquantity);
	}
	initval = initval.toFixed(2);
	$(".div_home_cart_popup_item_quantity:hover").find('input[type="text"]').val(initval + " " + item_unit);
}

function increasequantity(minquantity,item_unit)
{
	var initval = $(".div_home_offers_container_quantity_wrapper:hover").find('input[type="text"]').val();
	initval = initval.split(" ")[0];
	if(parseFloat(initval) >= 0)
		initval = parseFloat(initval) + parseFloat(minquantity);
		
	initval = initval.toFixed(2);
	$(".div_home_offers_container_quantity_wrapper:hover").find('input[type="text"]').val(initval + " " + item_unit);
}

function increasequantity_popup(minquantity,item_unit)
{
	var initval = $(".div_home_cart_popup_item_quantity:hover").find('input[type="text"]').val();
	initval = initval.split(" ")[0];
	if(parseFloat(initval) >= 0)
	{
		initval = parseFloat(initval) + parseFloat(minquantity);
	}
	initval = initval.toFixed(2);
	$(".div_home_cart_popup_item_quantity:hover").find('input[type="text"]').val(initval + " " + item_unit);
}

function showCartPopup()
{
	$('.div_home_shield').show();
	$('.div_home_cart_popup').show();	
	
	xmlhttp.onreadystatechange=function()
	{
		$("#loadingicon_popup").show();
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			$("#loadingicon_popup").hide();
			//document.location.href = "AJAX_LoadCartPopup.php";
			document.getElementById("div_home_cart_popup").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","AJAX_LoadCartPopup.php",true);
	xmlhttp.send();
}

function hideCartPopup()
{
	LoadExistingCart();
	$('.div_home_shield').hide();
	$('.div_home_cart_popup').hide();
		
}

function removeitem(id,from)
{
	xmlhttp.onreadystatechange=function()
	{
		if(from == 0) // to load cart at home page..
			$("#loadingicon_home").show();	
		else if(from == 1) 	//to load cart popup
			$("#loadingicon_popup").show();
		else if(from == 2)
			$("#loadingicon_review").show();
			
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			if(from == 0)
			{ // to delete item from cart at home page..
				$("#loadingicon_home").hide();
				document.getElementById("div_home_cart_bottom_container").innerHTML = xmlhttp.responseText;
			}
			else if(from == 1) 	//to delete item from popup
			{
				$("#loadingicon_popup").hide();
				document.getElementById("div_home_cart_popup").innerHTML = xmlhttp.responseText;
			}
			else if(from == 2) //to delte item from review page..
			{
				$("#loadingicon_review").hide();
				document.getElementById("revieworder_order_container").innerHTML = xmlhttp.responseText;
			}
		}
	}

	xmlhttp.open("GET","AJAX_AddToCart.php?id="+id+"&unit=0.00&from="+from,true);
	xmlhttp.send();
}

function showemptycart()
{
	alert("Your cart is empty! Please buy something to place order");	
}