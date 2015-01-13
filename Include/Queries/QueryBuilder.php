<?php
require_once("QueryMaster.php");
require_once("QueryExecuter.php");

function LoadMenu()
{	
	$result = RunSelectQuery(SELECT_CATEGORY);
	$output = "<ul>";
	while($row = mysql_fetch_assoc($result))
	{
		$output = $output."<li><a href = '#'>".$row["Name"]."</a>";
		
		$qry_sub_menu = SELECT_SUBCATEGORY;
		$qry_sub_menu = $qry_sub_menu."'".$row["ID"]."'";
		$result_sub_menu = RunSelectQuery($qry_sub_menu);
		if(mysql_num_rows($result_sub_menu) > 0)
		{
			$output = $output."<ul class = 'ul_sub_menu'>";
			while($row_sub_menu = mysql_fetch_assoc($result_sub_menu))
			{	
				$output = $output.'<li class = "li_sub_menu"><a href = "Items.php?sc='.$row_sub_menu["ID"].'">'.$row_sub_menu["Name"].'</a></li><br><br>';
			}	
			$output = $output."</ul>";
		}

		
		$output = $output."</li>";
		
	}
	$output = $output."</ul>";
	return $output;
}

function findCategoryWiseTags()
{
	$result = RunSelectQuery(SELECT_CATEGORY_WISE_TAG);
	return $result;
}

function FindTagForItems($sub_category)
{
	$qry = SELECT_ITEM_TAG.'ID="'.$sub_category.'"';
	$result = RunSelectQuery($qry);
	return $result;	
}

function findCategoryWiseOffers($tag_id)
{
	$qry = SELECT_CATEGORY_WISE_OFFER."'".$tag_id."'";
	$result = RunSelectQuery($qry);
	return $result;
}

function findItemsByID($subcategoryid)
{
	$qry = SELECT_ITEM_BY_SUBCATEGORY."'".$subcategoryid."'";
	$result = RunSelectQuery($qry);
	return $result;
}

function FindCurrentOfferOnItem($id)
{
	$qry = SELECT_OFFER_ON_ITEM."Item_ID = '".$id."'";
	$res = RunSelectQuery($qry);
	return $res;	
}

function InsertOfferInDB($itemid,$discount_percent,$offrs,$from,$to)
{
	$qry = INSERT_OFFER."'".$itemid."','".$discount_percent."','".$offrs."','".$from."','".$to."')";
	$res = RunSelectQuery($qry);
	return $res;	
}

function DeleteOfferFromDB($itemid)
{
	$qry = DELETE_OFFER.'"'.$itemid.'"';
	$res = RunDeleteQuery($qry);
	return $res;	
}

function SelectExistingOffers()
{
	$qry = SELECT_EXISTING_OFFERS;
	$res = RunSelectQuery($qry);
	return $res;	
}
function selectItemByType($id,$type)
{
	$qry = "";
	switch($type)
	{
		case "id":
			$qry .= SELECT_ITEM_BY_ID.'"'.$id.'"';
			break; 
	}
	$result = RunSelectQuery($qry);
	return $result;
	
}

/* Functions for user details.*/
function selectUserAccountDetails($email)
{
	$qry = SELECT_USER_ACCOUNT_DETAILS_BY_EMAIL.'"'.$email.'"';
	$result = RunSelectQuery($qry);
	return $result;
}

function insertFirstTimeUser($email,$password)
{
	$_SESSION['userid'] = uniqid();
	$qry = INSERT_NEW_USER.'"'.$_SESSION["userid"].'","'.$email.'","'.$password.'","'.date("Y-m-d H:i:s").'")';
	$result = RunInsertQuery($qry);
	return $result;	
}

function InsertUserAddress($userid,$name,$address,$city,$state,$country,$pin,$phone)
{
	$qry = INSERT_USER_ADDRESS."(User_ID,Name,Address,City,State,Country,Pin,Mobile) values('".$userid."','".$name."','".$address."','".$city."','".$state."','".
	$country."','".$pin."','".$phone."')";
	$result = RunInsertQuery($qry);
	return $result;
}

function SelectUserAddress($userid)
{
	$qry = SELECT_USER_ADDRESS.'"'.$userid.'"';
	$result = RunSelectQuery($qry);
	return $result;
}

function SelectUserAddress_By_ID($addressid)
{
	$qry = SELECT_USER_ADDRESS_BY_ID.'"'.$addressid.'"';
	$result = RunSelectQuery($qry);
	return $result;
}

function UpdateUserAddress($userid,$addressid,$name,$address,$city,$state,$country,$pin,$phone)
{

	$qry = UPDATE_USER_ADDRESS."Name='".$name."',Address='".$address."',City='".$city."',State='".$state."',Pin='".$pin."',Mobile='".$phone."' WHERE Address_ID='".
	$addressid."'";
	
	$result = RunUpdateQuery($qry);
	return $result;
}

function DeleteUserAddress($AddressID)
{
	$qry = DELETE_USER_ADDRESS.'"'.$AddressID.'"';
	$result = RunDeleteQuery($qry);
	return $result;
}

function SelectUserInfo($userid)
{
	$qry = SELECT_USER_INFO.'"'.$userid.'"';
	$result = RunSelectQuery($qry);
	return $result;
}

function InsertUserInfo($userid,$fname,$lname,$dob,$mobile,$sex)
{
	$qry = INSERT_USER_INFO.'"'.$userid.'","'.$fname.'","'.$lname.'","'.$dob.'","'.$mobile.'","'.$sex.'" )';
	$result = RunInsertQuery($qry);
	return $result;
}

function UpdateUserInfo($userid,$fname,$lname,$dob,$mobile,$sex)
{
	$qry = UPDATE_USER_INFO.'FirstName="'.$fname.'",LastName="'.$lname.'",DOB="'.$dob.'",Mobile="'.$mobile.'",Gender="'.$sex.'" WHERE User_ID = "'.$userid.'"';
	$result = RunUpdateQuery($qry);
	return $result;
	
}


//user cart and order related function
function SelectItemInCartByUserID($userid)
{
	$qry = SELECT_ITEM_IN_CART.'User_ID="'.$userid.'"';
	$result = RunSelectQuery($qry);
	return $result;
}

function SelectItemInConfirmOrderByUserIDAndOrderID($userid,$orderid)
{
	$qry = SELECT_ITEM_IN_CONFIRM_ORDER.'Order_ID="'.$orderid.'" AND User_ID="'.$userid.'"';
	$result = RunSelectQuery($qry);
	return $result;
}

function SelectItemInCartByUserIDAndItemID($userid,$itemid)
{
	$qry = SELECT_ITEM_IN_CART.'User_ID="'.$userid.'" AND Item_ID = "'.$itemid.'"';
	$result = RunSelectQuery($qry);
	return $result;
}

function UpdateItemInCartByUserIDAndItemID($userid,$itemid,$quantity,$date)
{
	$qry = UPDATE_ITEM_IN_CART.'Quantity="'.$quantity.'",Date_Added = "'.$date.'" WHERE User_ID="'.$userid.'" AND Item_ID="'.$itemid.'"';
	$result = RunUpdateQuery($qry);
	return $result;
}

function InsertItemInCartByUserIDAndItemID($userid,$itemid,$quantity,$date)
{
	$qry = INSERT_ITEM_IN_CART.'"'.$userid.'","'.$itemid.'","'.$quantity.'","'.$date.'")';
	$result = RunInsertQuery($qry);
	return $result;
}
function DeleteItemInCartByUserIDAndItemID($userid,$itemid)
{
	$qry = DELETE_ITEM_IN_CART.'User_ID="'.$userid.'" AND Item_ID = "'.$itemid.'"';
	$result = RunDeleteQuery($qry);
	return $result;
}

function InsertCartToConfirmOrder($userid)
{
	$res_select = SelectItemInCartByUserID($userid);
	$res =0;
	$orderid = uniqid();
	if(mysql_num_rows($res_select) > 0)
	{
		$_SESSION['orderid'] = $orderid;
		while($row = mysql_fetch_assoc($res_select))
		{
			$qry_offer = SELECT_OFFER_ON_ITEM.'Item_ID="'.$row["Item_ID"].'"';
			$res_offer = RunSelectQuery($qry_offer);
			
			$qry_price = SELECT_ITEM_BY_ID.'"'.$row["Item_ID"].'"';
			$res_price = RunSelectQuery($qry_price);
			$row_price = mysql_fetch_assoc($res_price);
			
			if(mysql_num_rows($res_offer) > 0)
			{
				$row_offer = mysql_fetch_assoc($res_offer);	
				$qry = INSERT_ITEM_IN_CONFIRM_ORDER.'"'.$orderid.'","'.$row['User_ID'].'","'.$row['Item_ID'].'","'.$row['Quantity'].'","'.$_SESSION['addressid'].
				'","'.date("Y/m/d").'","","'.$row_price["Price"].'","'.$row_offer["Off_Rs"].'")';		
			
			}
			else
			{
				$qry = INSERT_ITEM_IN_CONFIRM_ORDER.'"'.$orderid.'","'.$row['User_ID'].'","'.$row['Item_ID'].'","'.$row['Quantity'].'","'.$_SESSION['addressid'].
				'","'.date("Y/m/d").'","","'.$row_price["Price"].'","0")';		
				
			}
			
			
			$res = RunInsertQuery($qry);
		}
		return $qry;
	}
	else
		return 0;
	
}

function DeleteFromCartByUserID($userid)
{
	$qry = DELETE_ITEM_IN_CART.'User_ID="'.$userid.'"';
	$res = RunDeleteQuery($qry);
	return $res;	
}

function SelectUserOrder($userid)
{
	$qry = SELECT_ORDER.'"'.$userid.'" GROUP BY Order_ID';
	$res = RunSelectQuery($qry);
	return $res;
}

function SelectItemsInOrder($userid,$orderid)
{
	$qry = SELECT_ITEMS_IN_ORDER_ID.'User_ID = "'.$userid.'" AND Order_ID = "'.$orderid.'"';
	$res = RunSelectQuery($qry);
	return $res;
}

//queries related to category and subcategory and items and their items mapping
function SelectAllCategory()
{
	$qry = SELECT_CATEGORY;
	$res = RunSelectQuery($qry);
	return $res;	
}

function SelectCategoryByName($category_name)
{
	$qry = SELECT_CATEGORY_BY_NAME.'"'.$category_name.'"';
	$res = RunSelectQuery($qry);
	return $res;
}

function InsertCategory($category_name)
{
	$qry = INSERT_CATEGORY.'"'.$category_name.'")';
	$res = RunInsertQuery($qry);
	return $res;
}

function DeleteCategoryFromDB($categoryid)
{
	$qry = DELETE_CATEGORY.'"'.$categoryid.'"';
	$res = RunDeleteQuery($qry);
	return $res;
}

function DeleteCategorySubCategoryMappingByCategoryFromDB($id,$type)
{
	$qry = "";
	if($type == "category")
		$qry = DELETE_CATEGORY_SUBCATEGORY_BY_CATEGORY.'Category="'.$id.'"';
	else if($type == "subcategory")
		$qry = DELETE_CATEGORY_SUBCATEGORY_BY_CATEGORY.'SubCategory="'.$id.'"';
	
	$res = RunDeleteQuery($qry);
	return $res;
}

function SelectSubCategory($subcategory,$type)
{
	if($type == "name")
		$qry = SELECT_SUBCATEGORY_BY_TYPE.'Name="'.$subcategory.'"';
	else if($type == "id")
		$qry = SELECT_SUBCATEGORY_BY_TYPE.'ID="'.$subcategory.'"';
	
	$res = RunSelectQuery($qry);
	return $res;
}

function SelectSubCategoryFromMapping($subcategoryid,$type)
{
	$qry = SELECT_SUB_CATEGORY_FROM_MAPPING.'WHERE SubCategory="'.$subcategoryid.'"';
	$res = RunSelectQuery($qry);
	return $res;
}
function InsertSubCategory($subcategory_name)
{
	$qry = INSERT_SUB_CATEGORY.'"'.$subcategory_name.'")';
	$res = RunInsertQuery($qry);
	return $res;
}

function SelectAllSubCategory()
{
	$qry = SELECT_SUB_CATEGORY;
	$res = RunSelectQuery($qry);
	return $res;
}

function DeleteSubCategoryFromDB($subcategoryid)
{
	$qry = DELETE_SUB_CATEGORY.'"'.$subcategoryid.'"';
	$res = RunDeleteQuery($qry);
	return $res;
}

function CreateMappingInDB($category_id,$subcateogory_id)
{
	$qry = INSERT_MAPPING.'"'.$category_id.'","'.$subcateogory_id.'")';
	$res = RunInsertQuery($qry);
	return $res;
}

function AddItemInDB($description,$price,$unit,$minquantity,$imagepath)
{
	$qry = INSERT_ITEM.'"'.uniqid().'","'.$description.'","'.$imagepath.'","'.$price.'","'.$unit.'","'.$minquantity.'")';
	$res = RunInsertQuery($qry);
	return $res;	
}

function SelectAllItems()
{
	$qry = SELECT_ALL_ITEM;
	$res = RunSelectQuery($qry);
	return $res;
}

function SelectAllItemsNotMapped()
{
	$qry = SELECT_ALL_ITEM_NOT_MAPPED;
	$res = RunSelectQuery($qry);
	return $res;
}

function DeleteItemFromDB($itemid)
{
	$qry = DELETE_ITEM.'"'.$itemid.'"';
	$res = RunDeleteQuery($qry);
	return $res;
}

function SelectAllCategoryWhichAreMapped()
{
	$qry = SELECT_CATEGORY_WHICH_ARE_MAPPED;	
	$res = RunSelectQuery($qry);
	return $res;
}

function SelectAllSubCategoryWhichAreMapped()
{
	$qry = SELECT_SUB_CATEGORY_WHICH_ARE_MAPPED;	
	$res = RunSelectQuery($qry);
	return $res;
}

function SelectAllSubCategoryWhichAreNotMapped()
{
	$qry = SELECT_SUB_CATEGORY_WHICH_ARE_NOT_MAPPED;	
	$res = RunSelectQuery($qry);
	return $res;
}

function SelectItemMapping($categoryid,$subcategoryid)
{
	$qry = SELECT_CAT_SUBCAT_MAPPING.'Category="'.$categoryid.'" AND SubCategory="'.$subcategoryid.'"';
	$res = RunSelectQuery($qry);
	return $res;
}

function InsertItemMappingToDB($mappingid,$itemid)
{
	$qry = INSERT_ITEM_MAPPING.'"'.$mappingid.'","'.$itemid.'")';
	$res = RunInsertQuery($qry);
	return $res;
}

function SelectItemFromItemMapping($itemid)
{
	$qry = SELECT_FROM_ITEM_MAPPING.'Item_ID="'.$itemid.'"';	
	$res = RunSelectQuery($qry);
	return $res;
}


/* ADMIN SECTION*/
function Admin_SelectUser($emailid)
{
	$qry = ADMIN_SELECT_USER.'WHERE Email="'.$emailid.'"';
	$res = RunSelectQuery($qry);
	return $res;
}

?>