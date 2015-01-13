<?php
require_once("../Include/Queries/QueryBuilder.php");
require_once("../Include/Defines.php");
function loadAccountLeftPanel()
{
	$result = "";
	$result .= '
				<div class = "account_left_panel_category">
					<span class = "account_left_panel_category_heading">Orders</span><br>
					<img src="../Images/Account/myordericon.jpg"></img><a href = "#" onclick = "LoadRightPanel(1)">My Orders</a><br>
				</div>
				<div class = "account_left_panel_category">
					<span class = "account_left_panel_category_heading">Account</span><br>
					<img src="../Images/Account/profileicon.png"></img><a href = "#" onclick = "LoadRightPanel(2)">Edit Profile</a><br>	
					<img src="../Images/Account/addressbook.jpg"></img><a href = "#" onclick = "LoadRightPanel(3)">Address Book</a>	
				</div>';
				
	return $result;
						
}

function LoadEditProfile()
{
	
	$result = '<div class = "account_right_panel_container"><h3>Account Details</h3>';
	$result .= '<span style = "line-height:25px;">Email </span><br><input type ="text" value = "'.$_SESSION['email'].'" readonly="true" />
			   </div>
	           <hr>';
			   $res = SelectUserInfo($_SESSION['userid']);
			   $row = mysql_fetch_assoc($res);
			   
	$result .= '<div class = "account_right_panel_container"><h3>General Information</h3>
					<span style = "line-height:25px;">First Name </span><br>
						<input type ="text" id = "tb_firstname" value = "'.$row['FirstName'].'"  /><br>
					<span style = "padding-right:20px;">Last Name </span><br>
						<input type ="text" id = "tb_lastname" value = "'.$row['LastName'].'"  /><br>
					<span style = "padding-right:20px;">Date of Birth </span><br>
						<input type ="date" id = "tb_dob" value = "'.$row['DOB'].'" /><br>
					<span style = "padding-right:20px;">Contact Number </span><br>
						<input type ="text" id = "tb_mobile" value = "'.$row['Mobile'].'"  /><br>
					<span style = "padding-right:20px;">Gender</span><br>';
					if($row['Gender'] == "M")
					{
						$result .= '<input type ="radio" name = "radio_sex" id = "radio_sex" value = "M" checked="checked"  />Male';	
						$result .= '<input type ="radio" name = "radio_sex" id = "radio_sex" value = "F"  />Female';	
					}
					else if($row['Gender'] == "F")
					{
						$result .= '<input type ="radio" name = "radio_sex" id = "radio_sex" value = "M" />Male';	
						$result .= '<input type ="radio" name = "radio_sex" id = "radio_sex" value = "F" checked="checked" />Female';	
					}
					else
					{
						$result .='
						<input type ="radio" name = "radio_sex" id = "radio_sex" value = "Male"  />Male
						<input type ="radio"  name = "radio_sex" id = "radio_sex" value = "Female"  />Female<br>';
					}
					$result .='
			    </div><hr>';
	$result .= '<div class = "account_right_panel_container">
					<input type = "button" value = "Cancel" style = "margin-right:50px;" />
					<input type = "button" onclick = "UpdateInfo(2)" value = "Save" style = "background:green;" />
			   </div>';
	return $result;
}

function LoadMyOrders()
{
   $res = SelectUserOrder($_SESSION['userid']);
   $result = "";
   while($row = mysql_fetch_assoc($res))
   {	
   	 $result .=
	 	'<div class = "account_right_panel_order_wrapper">
	 	<div class = "account_right_panel_order_header">
		   <div class = "myorder_header">
				<span style = "float:left";>Order No </span>
				<span style = "font-size:16px;font-weight:bold;float:left;padding-left:10px;">'.$row['Order_ID'].'</span>		
		   </div>
		   <div class = "myorder_header">
				<span style = "float:left";>Placed On</span>
				<span style = "font-size:16px;font-weight:bold;float:left;padding-left:10px;">'.$row['Date'].'</span>		
		   </div>
		   <div class = "myorder_header" style = "width:200px;">
				<span style = "float:left;color:green;">Delivered</span>
		   </div>
		</div>';
		
	$res_item_in_orderid = SelectItemsInOrder($_SESSION['userid'],$row["Order_ID"]);
	$totalitemsinorder = mysql_num_rows($res_item_in_orderid);
	$result .=
	 	'<div class = "account_right_panel_order_body">
		   <div class = "myorder_header">
				<span style = "float:left";>Total Items</span>
				<span style = "font-size:16px;font-weight:bold;float:left;padding-left:10px;">'.$totalitemsinorder.'</span>		
		   </div>
		   <div class = "myorder_header">
				<span style = "float:left;">Delivered On</span>
				<span style = "font-size:16px;font-weight:bold;float:left;padding-left:10px;">'.$row['Delivery_Date'].'</span>		
		   </div>
		   <div class = "myorder_header" style = "width:100px;">
				<input type = "button" value = "View Detail" onclick = vieworderdetails("'.$row["Order_ID"].'") ></input>
		   </div>';
		
	while($row_item_in_orderid = mysql_fetch_assoc($res_item_in_orderid))
	{
		$res_item = selectItemByType($row_item_in_orderid["Item_ID"],"id");
		$row_item = mysql_fetch_assoc($res_item);
		
	}
	$result .= '</div></div><hr>';
   }
	return $result;
}

function LoadAddressBook()
{
	
}

function LoadOrderDetail($orderid)
{
	$_SESSION['totalcost'] = 0;		
	$_SESSION['totalsaving'] = 0;
	$_SESSION['totalactualcost'] = 0;
	$_SESSION['itemcount'] = 0;
	
	$result = '
	<img style = "top:228px;left:440px;" id = "loadingicon_popup_revieworder"  src="../Images/loadingicon.gif"></img>
		<div  title = "Close Cart" class = "div_close_popup" onclick = "hideCartPopup()" ></div>
		<div class = "div_home_cart_popup_header">
			<div class = "div_home_cart_popup_header_item_discription" style = "width:305px;">Name</div>
			<div class = "div_home_cart_popup_header_item_quantity" style = "text-align:left;">Quantity</div>
			<div class = "div_home_cart_popup_header_item_price">SubTotal</div>
			
		</div>
    	<div class = "div_home_cart_popup_body" id = "div_home_cart_popup_body">';
		
		$res_order = SelectItemInConfirmOrderByUserIDAndOrderID($_SESSION['userid'],$orderid);
		
		//load the main body of cart popup.
		
		while($row_order = mysql_fetch_assoc($res_order))
		{
			$key = $row_order["Item_ID"];
			$val = $row_order["Quantity"];
			
			$res = selectItemByType($key,'id');
			$row = mysql_fetch_assoc($res);
			
			$result .= '<div class = "div_home_cart_popup_items_container">';
				$result.='<div class = "div_home_cart_popup_item_images"><image width="120px" height="120px" src = '.ImageRootPath_ItemImages.$row["ImagePath"].' >
						</image>
						</div>';
			
				$result.='<div class = "div_home_cart_popup_item_description">';
				$result.= '<span>'.$row["Description"].'</span>
						  </div>';
				
				//add option to change quantity..
				$result.='<div class = "div_home_cart_popup_item_quantity">
						  <input disabled="disabled" class = "text_quantity" type = "text" value = "'.$val." ".$row["Unit"].'" style = 
						  "width:50px;"/>
						</div>';
					
				//add opton to change quantity finished..
				$finalcost = (intval($row["Price"])-intval($row_order["Off_Rs"]))*floatval($val);	
				$_SESSION['totalcost'] += (intval($row["Price"])-intval($row_order["Off_Rs"]))*floatval($val);
				$_SESSION['totalactualcost'] += intval($row["Price"])*floatval($val);
				$_SESSION['totalsaving'] += intval($row_order["Off_Rs"])*floatval($val);
			
				$result.='<div class = "div_home_cart_popup_item_price">
						  <span style = "font-weight:bold;">Rs '.$finalcost.'</span><br><br>
						  <span style = "font-size:14px;color:gray;">Market Price Rs '.$row["Price"].'/'.$row["Unit"].'</span><br>';
						  
						  $result .= '<span style = "font-size:14px;color:green;">Off Rs '.$row_order["Off_Rs"].'/'.$row["Unit"].'</span><br> 
							<span id = "span_total_saving" style = "font-size:14px;color:green;">Saved: Rs '.$row_order["Off_Rs"]*$val.'
						  	</span>';
						  
						  $result .= '<br>
						  </div>';
						  
				$_SESSION['itemcount'] ++;
			$result .= '</div>';	
		}
	
	$result .= '</div>
	
    	  <div class = "div_home_cart_popup_footer">
		  	<div class = "div_home_cart_popup_footer_totalitem">Total Items: '.$_SESSION['itemcount'].'</div>
			<div class = "div_home_cart_popup_footer_totalcost">
				<span style = "font-size:14px;">Market Price Was Rs '.$_SESSION['totalactualcost']. '</span><br> 
				<span style = "color:green;font-size:14px;">Saved Rs '.$_SESSION['totalsaving'].'</span><br>
				<span style = "font-size:18px;">Total Ammount Paid Rs '.$_SESSION['totalcost']. '</span><br><br> 
			</div>
		  </div>';
	
	return $result;		
}
?>