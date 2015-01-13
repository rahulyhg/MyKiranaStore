<?php
require_once("masterpage.php");
require_once("masterpage_admin.php");
include("../Include/Defines.php");	
//if load == 1 means to change the right panel 
if(isset($_GET['from']))
{
	$from = $_GET['from'];
	if($from == 1)
		echo AddCategory();	
	else if($from == 2)
		echo RemoveCategory();
	else if($from == 3)
		echo AddSubCategory();
	else if($from == 4)
		echo RemoveSubCategory();
	else if($from == 5)
		echo MapCategoryAndSubCategory();
	else if($from == 6)
		echo AddItems();	
	else if($from == 7)
		echo DeleteItem();	
	else if($from == 8)
		echo MapItem();	
	else if($from == 9)
		echo AddOffers();	
	else if($from == 10)
		echo RemoveOffers();	
}


//to add a new category
if(isset($_GET['cat']) && $_GET['cat'] == 1)
{
	$category_name = $_GET['catname'];
	$category_name = strtolower($category_name);
	$category_name = trim($category_name);
	
	$res = CheckIfCategoryExist($category_name);
	//if id does not exist..
	if(!$res)
	{
		$res_insert = InsertNewCategory($category_name);
		if($res_insert)
			echo "1";
		else	//error inserting category
			echo "2";
	}
	else	//if the category already exist
	{
		echo "0";	
	}
}
//remove a category..
if(isset($_GET['rcat']) && $_GET['rcat'] == 1)
{
	$category_id = $_GET['catid'];
	
	$res_del = DeleteCategory($category_id);
	//echo $res_del;
	if($res_del)
		echo "1";
	else	//error removing category
		echo "0";
}

//add a new sub category..
if(isset($_GET['scat']) && $_GET['scat'] == 1)
{
	$subcategory_name = $_GET['scatname'];
	$subcategory_name = strtolower($subcategory_name);
	$subcategory_name = trim($subcategory_name);
	
	$res = CheckIfSubCategoryExist($subcategory_name,"name");
	//if id does not exist..
	//echo "RES =".$res."<br>";
	if(!$res)
	{
		$res_insert = InsertNewSubCategory($subcategory_name);
		if($res_insert)
			echo "1";
		else	//error inserting category
			echo "2";
	}
	else	//if the category already exist
	{
		echo "0";	
	}
}


//remove a Subcategory..
if(isset($_GET['rscat']) && $_GET['rscat'] == 1)
{
	$subcategory_id = $_GET['scatid'];
	
	$res_del = DeleteSubCategory($subcategory_id);
	//echo $res_del;
	if($res_del)
		echo "1";
	else	//error removing category
		echo "0";
}

//mapping function to create menu..
if(isset($_GET['mapping']) && $_GET['mapping'] == 1)
{
	$cat_id = $_GET['cat_id'];
	$subcat_id = $_GET['scat_id'];
	$res = CheckIfSubCategoryExistInMapping($subcat_id,"id");
	//echo "res  = ".$res;
	if(!$res)
	{
		$res_insert = InsertMapping($cat_id,$subcat_id);
		if($res_insert)
			echo "1";
		else 
			echo "0";
	}
	else	//mapping already exist.
		echo "2";
}


//code to add a new item..
if(isset($_GET['additem']) && $_GET['additem'] == 1)
{
	$description = $_GET['des'];
	$price = $_GET['price'];
	$unit = $_GET['itemunit'];
	$minquantity = $_GET['minquan'];
	$imagepath = $_GET['imagepath'];
	
	$description = ucwords ($description);
	$res_insert = InsertItem($description,$price,$unit,$minquantity,$imagepath);
	if($res_insert)
		echo "1";
	else 
		echo "0";
}

//remove a item by its id
if(isset($_GET['ritem']) && $_GET['ritem'] == 1)
{
	$item_id = $_GET['itemid'];
	
	$res_del = DeleteItemByID($item_id);
	if($res_del)
		echo "1";
	else	//error removing category
		echo "0";
}


if(isset($_GET['itemmapping']) && $_GET['itemmapping'] == 1)
{
	$cat_id = $_GET['cat_id'];
	$subcat_id = $_GET['scat_id'];
	$item_id = $_GET['itemid'];
	//echo "cat id = ".$cat_id." and ".$subcat_id;
	if(!CheckIfItemMappingExist($item_id))
	{
		$res_mappingid = SelectItemMapping($cat_id,$subcat_id);
		$row_mappingid = mysql_fetch_assoc($res_mappingid);
		
		$res_insert = InsertItemMapping($row_mappingid["Mapping_ID"],$item_id);
		if($res_insert)
			echo "1";
		else 
			echo "0";
			
	}
	else	//mapping already exist.
		echo "2";
}

//add offer
if(isset($_GET['addoffer']) && $_GET['addoffer'] == 1)
{
	
	$item_id = $_GET['itemid'];
	$offrs = $_GET['offrs'];
	$from = $_GET['from'];
	$to = $_GET['to'];
	$res = FindCurrentOfferOnItem($item_id);
	//echo "res =  ".mysql_num_rows($res);
	if(mysql_num_rows($res) == 0)
	{
		$discountpercent = 0;
		$res_insert = InsertOfferInDB($item_id,$discountpercent,$offrs,$from,$to);
		if($res_insert)
			echo "1";
		else 
			echo "0";
			
	}
	else	//offer already exist.
		echo "2";
}

//remove offer
if(isset($_GET['removeoffer']) && $_GET['removeoffer'] == 1)
{
	
	$item_id = $_GET['itemid'];
	
	$res_delete = DeleteOfferFromDB($item_id);
	if($res_delete)
		echo "1";
	else 
		echo "0";
}


?>

