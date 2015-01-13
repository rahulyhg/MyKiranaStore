<?php


function loadLoginFormForAdmin()
{
echo '
		<div class = "loginform_form_container">
        <div class = "form_header">
            Please Login or Register here to Place Order
        </div>
        <div class = "loginform_left_panel">';
		
		if(isset($_GET['acc']) && $_GET['acc'] == 1)
			$_SESSION['prev_location'] = "acc";
		else if(isset($_GET['home']) && $_GET['home'] == 1)
			$_SESSION['prev_location'] = "home";
				
	   echo'<form action = "AdminHome.php" id = "loginform" method = "post" >
                <div class = "loginform_left_panel_loginform">
                <div class = "loginform_left_panel_loginform_header"> <span>Login</span></div>    	
                    
                    <span>Email ID</span><br />
                    <input type = "text" title="Email ID" placeholder = "Email ID" id = "tb_emailid" name = "tb_emailid" required = "true" /><br /><br />
                    <span>Password</span><br>
                    
                    <input type = "password" placeholder = "Password" name = "tb_password" id= "tb_password" required = "true" /><br /><br>
                    
                    <input type = "submit" id = "button_continue"  class = "button_continue" title = "Continue" value = "Continue" /><br /><br />
                </div>
            </form>
    </div>';//left panel ends here..
  echo '
  
  </div>	
';	
}

function loadAdminLeftPanel()
{
	$result = 
	'
		<div class = "div_admin_left_panel_category">
			<div class = "div_admin_left_panel_category_label" onclick = "LoadAdminRightPanel(1)">Add Category</div>
		</div>
		<div class = "div_admin_left_panel_category">
			<div class = "div_admin_left_panel_category_label" onclick = "LoadAdminRightPanel(2)">Remove Category</div>
		</div>
		
		<div class = "div_admin_left_panel_category">
			<div class = "div_admin_left_panel_category_label" onclick = "LoadAdminRightPanel(3)">Add Sub Category</div>
		</div>
		
		<div class = "div_admin_left_panel_category">
			<div class = "div_admin_left_panel_category_label" onclick = "LoadAdminRightPanel(4)">Remove Sub Category</div>
		</div>
		
		<div class = "div_admin_left_panel_category">
			<div class = "div_admin_left_panel_category_label" onclick = "LoadAdminRightPanel(5)">Create Menu</div>
		</div>
		
		<div class = "div_admin_left_panel_category">
			<div class = "div_admin_left_panel_category_label" onclick = "LoadAdminRightPanel(6)">Add Items</div>
		</div>
		
		<div class = "div_admin_left_panel_category">
			<div class = "div_admin_left_panel_category_label" onclick = "LoadAdminRightPanel(7)">Delete Items</div>
		</div>
			
		<div class = "div_admin_left_panel_category">
			<div class = "div_admin_left_panel_category_label" onclick = "LoadAdminRightPanel(8)">Map Items</div>
		</div>
		
		<div class = "div_admin_left_panel_category">
			<div class = "div_admin_left_panel_category_label" onclick = "LoadAdminRightPanel(9)">Add Offers</div>
		</div>
		
		
		<div class = "div_admin_left_panel_category">
			<div class = "div_admin_left_panel_category_label" onclick = "LoadAdminRightPanel(10)">Remove Offers</div>
		</div>
	';
	return $result;
		
}

function AddCategory()
{
	$result = '
	<div class = "div_admin_right_panel_heading" id = "admin_right_panel_heading">
         Add Category
    </div>
	<div class = "div_admin_right_panel_container" id = "admin_right_panel_container">
		<img style = "top:370px;left:815px;" id = "loadingicon_home" src="../Images/loadingicon.gif"></img>
	
		<div class = "admin_right_panel_container" style = "margin:30px 0px 20px 20px">
			<span>Enter Category Name</span><br>
			<input type = "text" placeholder = "Category Name" id="tb_addcategory" /><br>
			<input type = "button" value = "Add" onclick = "AddCategory()" />
		</div>
	</div>';
	return $result;
}

function RemoveCategory()
{
	$result = '
	<div class = "div_admin_right_panel_heading" id = "admin_right_panel_heading">
         Remove Category
    </div>
	<div class = "div_admin_right_panel_container" id = "admin_right_panel_container">
		<img style = "top:370px;left:815px;" id = "loadingicon_home" src="../Images/loadingicon.gif"></img>
	
		<div class = "admin_right_panel_container" style = "margin:30px 0px 20px 20px">
			<span>Select Category to be removed</span><br>
			<select id = "ddl_removecategory" name = "ddl_removecategory">';
				$res = SelectAllCategory();
				while($row = mysql_fetch_assoc($res))
				{
					$result .= '<option id = "'.$row["ID"].'" name = "'.$row["ID"].'">'.$row["Name"].'</option>';
				}
			$result .= '</select>
			<br>
			<input type = "button" value = "Remove" onclick = "RemoveCategory()" />
		</div>
	</div>';
	return $result;
}

function AddSubCategory()
{
	$result = '
	<div class = "div_admin_right_panel_heading" id = "admin_right_panel_heading">
         Add SubCategory
    </div>
	<div class = "div_admin_right_panel_container" id = "admin_right_panel_container">
		<img style = "top:370px;left:815px;" id = "loadingicon_home" src="../Images/loadingicon.gif"></img>
	
		<div class = "admin_right_panel_container" style = "margin:30px 0px 20px 20px">
			<span>Enter SubCategory Name</span><br>
			<input type = "text" placeholder = "SubCategory Name" id="tb_addsubcategory" /><br>
			<input type = "button" value = "Add" onclick = "AddSubCategory()" />
		</div>
	</div>';
	return $result;
}

function RemoveSubCategory()
{
	$result = '
	<div class = "div_admin_right_panel_heading" id = "admin_right_panel_heading">
         Remove SubCategory
    </div>
	<div class = "div_admin_right_panel_container" id = "admin_right_panel_container">
		<img style = "top:370px;left:815px;" id = "loadingicon_home" src="../Images/loadingicon.gif"></img>
	
		<div class = "admin_right_panel_container" style = "margin:30px 0px 20px 20px">
			<span>Select SubCategory to be removed</span><br>
			<select id = "ddl_removesubcategory" name = "ddl_removesubcategory">';
				$res = SelectAllSubCategory();
				while($row = mysql_fetch_assoc($res))
				{
					$result .= '<option id = "'.$row["ID"].'" name = "'.$row["ID"].'">'.$row["Name"].'</option>';
				}
			$result .= '</select>
			<br>
			<input type = "button" value = "Remove" onclick = "RemoveSubCategory()" />
		</div>
	</div>';
	return $result;
}

function MapCategoryAndSubCategory()
{
	$result = '
	<div class = "div_admin_right_panel_heading" id = "admin_right_panel_heading">
         Create Menu
    </div>
	<div class = "div_admin_right_panel_container" id = "admin_right_panel_container">
		<img style = "top:370px;left:815px;" id = "loadingicon_home" src="../Images/loadingicon.gif"></img>';
		for($i=1;$i<=5;$i++)
		{
		$result .= '
		<div class = "create_menu_container">
			
			<div class = "create_menu_category">
				<span>Category</span>
				<select id = "ddl_category" name = "ddl_category">';
					$res = SelectAllCategory();
					while($row = mysql_fetch_assoc($res))
					{
						$result .= '<option id = "'.$row["ID"].'" name = "'.$row["ID"].'">'.$row["Name"].'</option>';
					}
				$result .= 
			    '</select>
			</div>
			<div class = "create_menu_subcategory">
				<span>SubCategory</span>
				<select id = "ddl_subcategory" name = "ddl_subcategory">';
					$res = SelectAllSubCategoryWhichAreNotMapped();
					while($row = mysql_fetch_assoc($res))
					{
						$result .= '<option id = "'.$row["ID"].'" name = "'.$row["ID"].'">'.$row["Name"].'</option>';
					}
				$result .= 
			    '</select>
			</div>
			<div class = "create_menu_map">
				<input type = "button" value = "Add" onclick = "AddMapping()" style = "width:100px;" />
			</div>
			
		</div>';
		}
	$result .= '	
	</div>';
	return $result;
}

function AddItems()
{
	$result = '
	<div class = "div_admin_right_panel_heading" id = "admin_right_panel_heading">
         Add Items
    </div>
	<div class = "div_admin_right_panel_container" id = "admin_right_panel_container">
		<img style = "top:370px;left:815px;" id = "loadingicon_home" src="../Images/loadingicon.gif"></img>';
		for($i=1;$i<=3;$i++)
		{
		$result .= '
		<div class = "add_item_container" style = "float:left;">
	
			<div class = "add_item_description">
				<span>Description</span>
				<input type = "text" placeholder = "Description of Item" id="tb_description" required style = "width:350px;" />
			</div>
			<div class = "add_item_price">
				<span>Price</span>
				<input type = "text" placeholder = "Price" id="tb_price" style = "width:100px;" required />
			</div>
			<div class = "add_item_unit">
				<span>Unit</span>
				<select>
					<option>Kg</option>
					<option>Lt</option>
					<option>Pack</option>
				</select>
			</div>
			<div class = "add_item_minquantity">
				<span>MinQuantity</span>
				<input type = "text" placeholder = "MinQuantity Available" id="tb_minquantity" style = "width:180px;" required />
			</div>
			<div class = "add_item_image">
				<span>Select Image</span>
				<input type="file" name="image_file" id = "image_file" accept="image/*">
			</div>
			<div class = "add_item_button">
				<input type = "button" value = "Add Item" onclick = "AddItem()" style = "width:100px;" />
			</div>
		</div><br><br><hr>';
		}
	$result .= '	
	</div>';
	return $result;
}

function DeleteItem()
{
	$result = '
	<div class = "div_admin_right_panel_heading" id = "admin_right_panel_heading">
         Delete a Item
    </div>
	<div class = "div_admin_right_panel_container" id = "admin_right_panel_container">
		<img style = "top:370px;left:815px;" id = "loadingicon_home" src="../Images/loadingicon.gif"></img>
	
		<div class = "admin_right_panel_container" style = "margin:30px 0px 20px 20px">
			<span>Select Item to be Removed</span><br>
			<select id = "ddl_removeitem" name = "ddl_removeitem">';
				$res = SelectAllItems();
				while($row = mysql_fetch_assoc($res))
				{
					$result .= '<option id = "'.$row["ID"].'" name = "'.$row["ID"].'">'.$row["Description"].'</option>';
				}
			$result .= '</select>
			<br>
			<input type = "button" value = "Remove" onclick = "RemoveItem()" />
		</div>
	</div>';
	return $result;
}

function MapItem()
{
	$result = '
	<div class = "div_admin_right_panel_heading" id = "admin_right_panel_heading">
         Map Item to Their SubCategory
    </div>
	<div class = "div_admin_right_panel_container" id = "admin_right_panel_container">
		<img style = "top:370px;left:815px;" id = "loadingicon_home" src="../Images/loadingicon.gif"></img>';
		for($i=1;$i<=5;$i++)
		{
		$result .= '
		<div class = "item_mapping_container" style = "float:left;">
			
			<div class = "itemmapping_category">
				<span>Category</span>
				<select id = "ddl_category" name = "ddl_category">';
					$res = SelectAllCategoryWhichAreMapped();
					while($row = mysql_fetch_assoc($res))
					{
						$result .= '<option id = "'.$row["ID"].'" name = "'.$row["ID"].'">'.$row["Name"].'</option>';
					}
				$result .= 
			    '</select>
			</div>
			<div class = "itemmapping_subcategory">
				<span>SubCategory</span>
				<select id = "ddl_subcategory" name = "ddl_subcategory">';
					$res = SelectAllSubCategoryWhichAreMapped();
					while($row = mysql_fetch_assoc($res))
					{
						$result .= '<option id = "'.$row["ID"].'" name = "'.$row["ID"].'">'.$row["Name"].'</option>';
					}
				$result .= 
			    '</select>
			</div>
			<div class = "itemmapping_item">
				<span>Item</span>
				<select id = "ddl_item" name = "ddl_item">';
					$res = SelectAllItemsNotMapped();
					while($row = mysql_fetch_assoc($res))
					{
						$result .= '<option id = "'.$row["ID"].'" name = "'.$row["ID"].'">'.$row["Description"].'</option>';
					}
				$result .= 
			    '</select>
			</div>
			
			<div class = "itemmapping_map">
				<input type = "button" value = "Add" onclick = "AddItemMapping()" style = "width:100px;" />
			</div>
			
		</div><br><br><hr />';
		}
	$result .= '	
	</div>';
	return $result;
}

function  AddOffers()
{
	$result = '
	<div class = "div_admin_right_panel_heading" id = "admin_right_panel_heading">
         Add Offers
    </div>
	<div class = "div_admin_right_panel_container" id = "admin_right_panel_container">
		<img style = "top:370px;left:815px;" id = "loadingicon_home" src="../Images/loadingicon.gif"></img>';
		for($i=1;$i<=4;$i++)
		{
		$result .= '
		<div class = "item_mapping_container" style = "float:left;">
			<div class = "itemmapping_item" id = "offer_item">
				<span>Item</span>
				<select id = "ddl_item" name = "ddl_item">';
					$res = SelectAllItems();
					while($row = mysql_fetch_assoc($res))
					{
						$result .= '<option id = "'.$row["ID"].'" name = "'.$row["ID"].'">'.$row["Description"].'</option>';
					}
				$result .= 
			    '</select>
			</div>
			<div class = "itemmapping_item" id = "offer_offrs">
				<span>Off Rs</span>
				<input type = "text" placeholder = "Discount Rs" id= "tb_offrs" style = "width:230px;" />
			</div>
			<div class = "itemmapping_item" id = "offer_from">
				<span>From</span>
				<input type = "date" id = "date_from" />
			</div>
			<div class = "itemmapping_item" id = "offer_to">
				<span>To</span>
				<input type = "date" id = "date_to" />
			</div>
			
			<div class = "itemmapping_map">
				<input type = "button" value = "Add" onclick = "AddOffer()" style = "width:100px;" />
			</div>
				
		</div><br><br><hr />';
		}
	$result .= '	
	</div>';
	return $result;
}


function  RemoveOffers()
{	
	$result = '
	<div class = "div_admin_right_panel_heading" id = "admin_right_panel_heading">
         Remove Offers
    </div>
	<div class = "div_admin_right_panel_container" id = "admin_right_panel_container">
		<img style = "top:370px;left:815px;" id = "loadingicon_home" src="../Images/loadingicon.gif"></img>';
		
	$res = SelectExistingOffers();
	echo $res;
	while($row = mysql_fetch_assoc($res))
	{
		$res_item = selectItemByType($row["Item_ID"],"id");
		$row_item = mysql_fetch_assoc($res_item);
	$result .= '
		<div class = "item_mapping_container" style = "float:left;">
			<div class = "itemmapping_item" id = "removeoffer_item">
				<span>Item</span>
				<input type ="text" readonly id ="'.$row["Item_ID"].'" value = "'.$row_item["Description"].'" style = "width:200px;" />
			</div>
			<div class = "itemmapping_item" id = "offer_offrs">
				<span>Off Rs</span>
				<input type ="text" readonly value = "'.$row["Off_Rs"].'" style = "width:200px;" />
			</div>
			<div class = "itemmapping_map">
				<input type = "button" value = "Remove" onclick = "RemoveOffer()" style = "width:100px;"  style = "width:200px;"/>
			</div>
			<div class = "itemmapping_item" id = "offer_from">
				<span>From</span>
				<input type = "text" readonly id = "date_from" value = "'.$row["From"].'" style = "width:200px;" />
			</div>
			<div class = "itemmapping_item" id = "offer_to">
				<span>From</span>
				<input type = "text" readonly id = "date_from" value = "'.$row["To"].'" style = "width:200px;" />
			</div>
			
			
				
		</div><br><br><hr />';
	}
	$result .= '	
	</div>';
	return $result;
}





























function CheckIfCategoryExist($category_name)
{
	$res = SelectCategoryByName($category_name);
	if(mysql_num_rows($res) > 0)
		return true;
	else 	
		return false;
}

function InsertNewCategory($category_name)
{
	$res = InsertCategory($category_name);
	if($res)
		return true;
	else
		return false;	
}
function DeleteCategory($categoryid)
{
	$res = DeleteCategoryFromDB($categoryid);
	if($res)
	{
		$res_del = DeleteCategorySubCategoryMapping($categoryid,"category");
		if($res_del)
			return true;
	}
	return false;	
}
function CheckIfSubCategoryExist($subcategory,$type)
{
	$res = SelectSubCategory($subcategory,$type);
	if(mysql_num_rows($res) > 0)
		return true;
	else 	
		return false;
}

function CheckIfSubCategoryExistInMapping($subcategory,$type)
{
	$res = SelectSubCategoryFromMapping($subcategory,$type);

	if(mysql_num_rows($res) > 0)
		return true;
	else 	
		return false;
}


function DeleteCategorySubCategoryMapping($categoryid,$type)
{
	$res = DeleteCategorySubCategoryMappingByCategoryFromDB($categoryid,$type);
	if($res)
	{
		return true;
	}	
	return false;
}
function InsertNewSubCategory($subcategory_name)
{
	$res = InsertSubCategory($subcategory_name);
	if($res)
		return true;
	else
		return false;	
}

function DeleteSubCategory($subcategoryid)
{
	$res = DeleteSubCategoryFromDB($subcategoryid);
	if($res)
	{
		$res_del = DeleteCategorySubCategoryMapping($subcategoryid,"subcategory");
		if($res_del)
			return true;
	}
	return false;	
}

function InsertMapping($category_id,$subcategory_id)
{
	$res = CreateMappingInDB($category_id,$subcategory_id);
	if($res)
		return true;
	else
		return false;
}

function InsertItem($description,$price,$unit,$minquantity,$imagepath)
{
	$res = AddItemInDB($description,$price,$unit,$minquantity,$imagepath);
	if($res)
		return true;
	else
		return false;
}

function DeleteItemByID($itemid)
{
	$res = DeleteItemFromDB($itemid);
	if($res)
		return true;
	else
		return false;
}

function CheckIfItemMappingExist($itemid)
{
	$res = SelectItemFromItemMapping($itemid);	
	if($res)
	{
		if(mysql_fetch_assoc($res) > 0)
			return true;
	}
	return false;
}

function InsertItemMapping($mappingid,$itemid)
{
	$res = InsertItemMappingToDB($mappingid,$itemid);
	if($res)
		return true;
	else
		return false;	
}
?>