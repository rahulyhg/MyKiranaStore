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
	
function LoadAdminRightPanel(from)
{		
//alert(from);
	$("#loadingicon_home").show();
	xmlhttp.onreadystatechange=function()
	{
		//alert(xmlhttp.responseText.trim());
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			//document.location.href = "AJAX_AdminHome.php?from="+from;
			document.getElementById("div_admin_right_panel").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","AJAX_AdminHome.php?from="+from,true);
	xmlhttp.send();
}

function AddCategory()
{
	var category_name = $("#tb_addcategory").val();	
	if(category_name =="")
		alert("Please enter Name First");
	else
	{
		$("#loadingicon_home").show();
		xmlhttp.onreadystatechange=function()
		{
			//alert(xmlhttp.responseText.trim());
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				$("#loadingicon_home").hide();
				if(xmlhttp.responseText == 0)
				{
					alert("This category already exist");	
					$("#tb_addcategory").focus();	
				}
				if(xmlhttp.responseText == 1)
				{
					alert("New Category Added Successfully");	
					$("#tb_addcategory").val("");	
					$("#tb_addcategory").focus();	
				}
				if(xmlhttp.responseText == 2)
					alert("Error in Adding new Category");	
			}
		}
		xmlhttp.open("GET","AJAX_AdminHome.php?cat=1&catname="+category_name,true);
		xmlhttp.send();
	}
}

function RemoveCategory()
{
	var category_id = $("option:selected").attr("id");
	//alert(category_name);
	if(confirm("Are you sure you want to remove this category?"))
	{
		$("#loadingicon_home").show();
		xmlhttp.onreadystatechange=function()
		{
			//alert(xmlhttp.responseText.trim());
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				$("#loadingicon_home").hide();
				if(xmlhttp.responseText == 1)
					alert("Category Removed Successfully");	
				if(xmlhttp.responseText == 0)
					alert("Error in Removing Category");	
			}
		}
		xmlhttp.open("GET","AJAX_AdminHome.php?rcat=1&catid="+category_id,true);
		xmlhttp.send();
	}
	
}

function AddSubCategory()
{
	var subcategory_name = $("#tb_addsubcategory").val();	
	if(subcategory_name =="")
		alert("Please enter Name First");
	else
	{
		$("#loadingicon_home").show();
		xmlhttp.onreadystatechange=function()
		{
			//alert(xmlhttp.responseText.trim());
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				$("#loadingicon_home").hide();
				if(xmlhttp.responseText == 0)
				{
					alert("This Subcategory already exist");	
					$("#tb_addsubcategory").focus();	
				}
				if(xmlhttp.responseText == 1)
				{
					alert("New SubCategory Added Successfully");	
					$("#tb_addsubcategory").val("");	
					$("#tb_addsubcategory").focus();	
				}
				if(xmlhttp.responseText == 2)
					alert("Error in Adding new SubCategory");	
			}
		}
		xmlhttp.open("GET","AJAX_AdminHome.php?scat=1&scatname="+subcategory_name,true);
		xmlhttp.send();
	}
}

function RemoveSubCategory()
{
	var subcategory_id = $("option:selected").attr("id");
	//alert(category_name);
	if(confirm("Are you sure you want to remove this category?"))
	{
		$("#loadingicon_home").show();
		xmlhttp.onreadystatechange=function()
		{
			//alert(xmlhttp.responseText);
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				$("#loadingicon_home").hide();
				//alert(xmlhttp.responseText);
				if(xmlhttp.responseText == 1)
					alert("SubCategory Removed Successfully");	
				if(xmlhttp.responseText == 0)
					alert("Error in Removing SubCategory");	
			}
		}
		xmlhttp.open("GET","AJAX_AdminHome.php?rscat=1&scatid="+subcategory_id,true);
		xmlhttp.send();
	}
	
}

function AddMapping()
{ 
	var cat_id =  $(".create_menu_container:hover").find(".create_menu_category").find("option:selected").attr("id");
	var scat_id =  $(".create_menu_container:hover").find(".create_menu_subcategory").find("option:selected").attr("id");
	//var scat_id =  $(".create_menu_container:hover .create_menu_subcategory>option:selected").attr("id");
	$("#loadingicon_home").show();
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			$("#loadingicon_home").hide();
			//alert(xmlhttp.responseText);
			if(xmlhttp.responseText == 1)
				alert("Mapping Made Successfully");	
			if(xmlhttp.responseText == 0)
				alert("Error in creating Mapping");	
			if(xmlhttp.responseText == 2)
				alert("Mapping already Exist");	
		}
	}
	xmlhttp.open("GET","AJAX_AdminHome.php?mapping=1&cat_id="+cat_id+"&scat_id="+scat_id,true);
	xmlhttp.send();

}

function AddItem()
{
	$("#loadingicon_home").show();
	var des = $(".add_item_container:hover").find(".add_item_description").find("input").val();
	var price = $(".add_item_container:hover").find(".add_item_price").find("input").val();
	var itemunit = $(".add_item_container:hover").find(".add_item_unit").find("option:selected").val();
	var minquan = $(".add_item_container:hover").find(".add_item_minquantity").find("input").val();
	var imagepath = $(".add_item_container:hover").find(".add_item_image").find("input").val();
	imagepath = (imagepath.split("\\"))[2];
	
	xmlhttp.onreadystatechange=function()
	{		
		//alert(xmlhttp.responseText.trim());
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			$("#loadingicon_home").hide();
			//	alert(xmlhttp.responseText.trim().charAt(0));
			if(xmlhttp.responseText == 1)
				alert("Item Added Successfully");
			if(xmlhttp.responseText == 0)
				alert("Error in Adding Item");
		}
	}
	xmlhttp.open("GET","AJAX_AdminHome.php?additem=1&des="+des+"&price="+price+"&itemunit="+itemunit+"&minquan="+minquan+"&imagepath="+imagepath,true);
	xmlhttp.send();

}

function RemoveItem()
{
	var item_id = $("option:selected").attr("id");
	if(confirm("Are you sure you want to remove this Item?"))
	{
		$("#loadingicon_home").show();
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				//alert(xmlhttp.responseText);
				$("#loadingicon_home").hide();
				if(xmlhttp.responseText == 1)
					alert("Item Removed Successfully");	
				if(xmlhttp.responseText == 0)
					alert("Error in Removing Item");	
			}
		}
		xmlhttp.open("GET","AJAX_AdminHome.php?ritem=1&itemid="+item_id,true);
		xmlhttp.send();
	}
}

function AddItemMapping()
{ 
	var cat_id =  $(".item_mapping_container:hover").find(".itemmapping_category").find("option:selected").attr("id");
	var scat_id =  $(".item_mapping_container:hover").find(".itemmapping_subcategory").find("option:selected").attr("id");
	var item_id =  $(".item_mapping_container:hover").find(".itemmapping_item").find("option:selected").attr("id");
	//var scat_id =  $(".create_menu_container:hover .create_menu_subcategory>option:selected").attr("id");
	$("#loadingicon_home").show();
	xmlhttp.onreadystatechange=function()
	{
		
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			$("#loadingicon_home").hide();
			if(xmlhttp.responseText == 1)
				alert("Mapping Made Successfully");	
			if(xmlhttp.responseText == 0)
				alert("Error in creating Mapping");	
			if(xmlhttp.responseText == 2)
				alert("Mapping already Exist");	
		}
	}
	xmlhttp.open("GET","AJAX_AdminHome.php?itemmapping=1&cat_id="+cat_id+"&scat_id="+scat_id+"&itemid="+item_id,true);
	xmlhttp.send();

}

function AddOffer()
{ 
	var item_id =  $(".item_mapping_container:hover").find("#offer_item").find("option:selected").attr("id");
	var offrs =  $(".item_mapping_container:hover").find("#offer_offrs").find("input").val();
	var from =  $(".item_mapping_container:hover").find("#offer_from").find("input").val();
	var to =  $(".item_mapping_container:hover").find("#offer_to").find("input").val();
	
	$("#loadingicon_home").show();
	xmlhttp.onreadystatechange=function()
	{	
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			$("#loadingicon_home").hide();
			if(xmlhttp.responseText == 1)
				alert("Offer Added Successfully");	
			if(xmlhttp.responseText == 0)
				alert("Error in Adding Offer");	
			if(xmlhttp.responseText == 2)
				alert("Offer Already Exist");	
		}
	}
	xmlhttp.open("GET","AJAX_AdminHome.php?addoffer=1&itemid="+item_id+"&offrs="+offrs+"&from="+from+"&to="+to,true);
	xmlhttp.send();

}


function RemoveOffer()
{ 
	var item_id =  $(".item_mapping_container:hover").find("#removeoffer_item").find("input").attr("id");
	
	$("#loadingicon_home").show();
	xmlhttp.onreadystatechange=function()
	{	
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			$("#loadingicon_home").hide();
			if(xmlhttp.responseText == 1)
				alert("Offer Removed Successfully");	
			if(xmlhttp.responseText == 0)
				alert("Error in Removing Offer");	
		}
	}
	xmlhttp.open("GET","AJAX_AdminHome.php?removeoffer=1&itemid="+item_id,true);
	xmlhttp.send();

}
