<?php
require_once("../Include/Queries/QueryBuilder.php");

session_start();

function drawHeader()
{
	if(checkLoginStatus())
	{
		loadSessionFromDB($_SESSION['userid']);
	}
	
echo '
<div id = "header">
	<div class = "top-header">
		<div class = "top_header_logo">
			<img src="../Images/logo.jpg" style = "width:200px;height:75px;" />
		</div>
		
		<div class = "top_header_loginpanel">
			<ul>
				<li><a href = "index.php">Home</a></li>
				<li><a href = "'.WebSiteRoot.'Home/MyAccount.php">MyAccount</a></li>
				
				<li><a href = "#" onclick = "showCartPopup()">Cart</a></li>
				<li><a href = "#">Contact Us</a></li>';
				if(!checkLoginStatus())
						echo '<li><a href = "LoginForm.php?home=1">Login</a></li>';
					else
						echo '<li><a href = "Logout.php">Logout</a></li>';
			echo '
				<li><a href = "#">Feedback</a></li>
			</ul>
		</div>
		<div class = "top_header_searchbox">
			<input type = "text" placeholder = "Search for a product" />
			<input type = "button" value = "Search" />
		</div>
		
		

	
	</div>
	
	<div class = "menu">';
		echo LoadMenu();
	echo '
	</div>
	
</div>';
}

function LoadSlideShow()
{
	$result = '
	<div id="container">
            	<div id="content-slider">
                    <div id="slider">
                        <div id="mask">
                             <ul>
                              <li id="first" class="firstanimation">
                                <a href="#"><img src="../Images/image1.jpg" alt="Cougar"/></a>
                                <div class="tooltip"><h1>Shop on or above 2000 and get Rs 100 OFF.</h1></div>
                              </li>
                              <li id="second" class="secondanimation">
                                 <a href="#"><img src="../Images/image2.jpg" alt="Cougar"/></a>
                                 <div class="tooltip"><h1>Shop on or above 2000 and get Rs 100 OFF.</h1></div>
                              </li>
                              <li id="third" class="thirdanimation">
                                 <a href="#"><img src="../Images/image3.jpg" alt="Cougar"/></a>
                                 <div class="tooltip"><h1>Shop on or above 2000 and get Rs 100 OFF.</h1></div>
                              </li>             
                              <li id="fourth" class="fourthanimation">
                                  <a href="#"><img src="../Images/image4.jpg" alt="Cougar"/></a>
                                  <div class="tooltip"><h1>Shop on or above 2000 and get Rs 100 OFF.</h1></div>
                              </li>         
                              <li id="fifth" class="fifthanimation">
                                  <a href="#"><img src="../Images/image5.jpg" alt="Cougar"/></a>
                                 <div class="tooltip"><h1>Shop on or above 2000 and get Rs 100 OFF.</h1></div>
                              </li>
                           </ul>
                        </div>
                        <div class="progress-bar"></div>
        			</div>
    		    </div>
        	</div>';
	return $result;
}

function todaysOffers()
{
	echo 'this is todays offers...';	
}

function categoryWiseOffers()
{
	$result = "";
	$res_tags = findCategoryWiseTags();
	while($row_tags = mysql_fetch_assoc($res_tags))
	{
		$res_offers = findCategoryWiseOffers($row_tags["ID"]);
		$result = $result.'<a style = "cursor:pointer;color:black;">
		<div class = "div_home_offers_category_wise">
			<div class = "div_home_offers_tag">';
				$result = $result.$row_tags['Name'].'</div>
			<div class = "div_home_offers_offers_inside_tag">';
			while($row_offers = mysql_fetch_assoc($res_offers))
			{
				$result = $result.'<div class = "div_home_offers_container">';
				$result .= '<img height="120px" width = "120px" src = '.ImageRootPath_ItemImages.$row_offers["ImagePath"].'></img><br><br>';
				$result .= '<div class = "div_home_offers_container_description">'.$row_offers["Description"].'</div>';
				$result .= '<div class = "div_home_offers_container_actual_price">Rs.'.$row_offers["Price"].'/'.$row_offers["Unit"].'.You save Rs '.$row_offers[
				"Off_Rs"].'</div><hr>';	
				
				$finalprice = intval($row_offers["Price"]) - intval($row_offers["Off_Rs"]);
				$result .= '<div class = "div_home_offers_containter_final_price">Rs.'.$finalprice.'/'.$row_offers["Unit"].'</div>';
				$result .= '<div class = "div_home_offers_container_quantity_wrapper" id = "div_home_offers_container_quantity_wrapper">
							
							<div title = "Decrease Quantity" class = "div_decrease_quantity" onclick=decreasequantity("'.$row_offers["MinQuantity"].'","'.
							$row_offers["Unit"].'")></div>';
							
							if(isset($_SESSION['cart'][$row_offers["ID"]]))
								$result .= '<input disabled="disabled" class = "text_quantity" sytle = "float:left;" type = "text" value = "'.$_SESSION['cart'][
								$row_offers["ID"]]." ".$row_offers["Unit"].'" style = "width:50px;"/>';	
							else
								$result .= '<input disabled="disabled" class = "text_quantity" type = "text" value = "'.$row_offers["MinQuantity"]." ".
								$row_offers["Unit"].'" style = "width:50px;"/>';	
														
						$result .= '<div title = "Increase Quantity" class = "div_increase_quantity" onclick=increasequantity("'.$row_offers["MinQuantity"].'","'.
						$row_offers["Unit"].'")></div>
							
					  	 <input onclick=AddToCart("'.$row_offers["ID"].'",0) type = "button" value = "Add to cart" class = "button_addtocart"</input>
						</div>';
							
				$result .='</div>';
				
			}
			$result .= '</div>
		</div></a>';
	}
	return $result;
}

function LoadItems($id)
{
	$result = "";

		$res_items = findItemsByID($id);
		
		$result = $result.'<a style = "cursor:pointer;color:black;">
		
			<div class = "div_home_offers_offers_inside_tag">';
			while($row_item = mysql_fetch_assoc($res_items))
			{
				$res_offer = FindCurrentOfferOnItem($row_item["ID"]);
				$row_offer = mysql_fetch_assoc($res_offer);
				
				$result = $result.'<div class = "div_home_offers_container">';
				$result .= '<img height="120px" width = "120px" src = '.ImageRootPath_ItemImages.$row_item["ImagePath"].'></img><br><br>';
				$result .= '<div class = "div_home_offers_container_description">'.$row_item["Description"].'</div>';
				
				if(mysql_num_rows($res_offer) > 0)
				{
					$result .= '<div class = "div_home_offers_container_actual_price">Rs.'.$row_item["Price"].'/'.$row_item["Unit"].'.You save Rs '.$row_offer[
					"Off_Rs"].'</div><hr>';	
					$finalprice = intval($row_item["Price"]) - intval($row_offer["Off_Rs"]);
				}
				else
				{ 
					$result .= '<div class = "div_home_offers_container_actual_price">Rs.'.$row_item["Price"].'/'.$row_item["Unit"].'</div><hr>';	
					$finalprice = intval($row_item["Price"]);
				}
				
				
				$result .= '<div class = "div_home_offers_containter_final_price">Rs.'.$finalprice.'/'.$row_item["Unit"].'</div>';
				$result .= '<div class = "div_home_offers_container_quantity_wrapper" id = "div_home_offers_container_quantity_wrapper">
							
							<div title = "Decrease Quantity" class = "div_decrease_quantity" onclick=decreasequantity("'.$row_item["MinQuantity"].'","'.
							$row_item["Unit"].'")></div>';
							
							if(isset($_SESSION['cart'][$row_item["ID"]]))
								$result .= '<input disabled="disabled" class = "text_quantity" sytle = "float:left;" type = "text" value = "'.$_SESSION['cart'][
								$row_item["ID"]]." ".$row_item["Unit"].'" style = "width:50px;"/>';	
							else
								$result .= '<input disabled="disabled" class = "text_quantity" type = "text" value = "'.$row_item["MinQuantity"]." ".
								$row_item["Unit"].'" style = "width:50px;"/>';	
														
						$result .= '<div title = "Increase Quantity" class = "div_increase_quantity" onclick=increasequantity("'.$row_item["MinQuantity"].'","'.
						$row_item["Unit"].'")></div>
							
					  	 <input onclick=AddToCart("'.$row_item["ID"].'",0) type = "button" value = "Add to cart" class = "button_addtocart"</input>
						</div>';
							
				$result .='</div>';
				
			}
			$result .= '</div></a>';
	
	return $result;
}



//this function maintains the cart on page navigations..it loads the full portion including total cost.
function loadCart()
{	
	$result = '
	<img id = "loadingicon_home" src="../Images/loadingicon.gif"></img>
				<div class = "div_home_cart_header">My Cart</div>
				<div class = "div_home_cart_bottom_container" id = "div_home_cart_bottom_container">
				<div class = "div_home_cart_items_container" id  = "div_home_cart_items_container">';	
	if(isset($_SESSION["cart"]))
	{	
		$_SESSION['totalcost'] = 0;		
		$_SESSION['totalsaving'] = 0;
		$_SESSION['totalactualcost'] = 0;
		$_SESSION['itemcount'] = 0;
		foreach($_SESSION['cart'] as $key=>$val)
		{
			$res = selectItemByType($key,'id');
			$row = mysql_fetch_assoc($res);
			$res_offer = FindCurrentOfferOnItem($key);
			$row_offer = mysql_fetch_assoc($res_offer);
			
			$result.='<div class = "div_home_cart_items" id = "div_home_cart_items_"'.$key.'>';
			$result.='<div class = "div_home_cart_items_images"><image width="30px" height="30px" src = '.ImageRootPath_ItemImages.$row["ImagePath"].' ></image>
					  </div>';
			$result.='<div class = "div_home_cart_items_description"><span style = "font-weight:bold;">'.$val.' '.$row["Unit"].'</span> '.$row["Description"].'
				      </div>';
			if(mysql_num_rows($res_offer) > 0)
			{
				$result.='<div class = "div_home_cart_items_price">Rs. '.(intval($row["Price"])-intval($row_offer["Off_Rs"]))*floatval($val).'</div>';
				$_SESSION['totalcost'] += (intval($row["Price"])-intval($row_offer["Off_Rs"]))*floatval($val);
			}
			else
			{
				$result.='<div class = "div_home_cart_items_price">Rs. '.(intval($row["Price"]))*floatval($val).'</div>';
				$_SESSION['totalcost'] += (intval($row["Price"]))*floatval($val);
			}
			$result.='</div><hr>';
			
		}
	}
	else
		unset($_SESSION['totalcost']);
		
	$result .= '</div><div class = "div_home_cart_totalcost" id = "div_home_cart_totalcost"><span>Total</span><span style = "float:right;">';
	if(isset($_SESSION["totalcost"]))
		$result .= $_SESSION["totalcost"];
	else
		$result .= '0';
		
	$result	.= '</span></div>';
	
	$result .= '</div>
            <form action="LoginForm.php">
            <div class = "div_home_cart_submit" id = "div_home_cart_submit">
            	<input title = "View Cart" class = "button_show_cart" onclick="showCartPopup()" type = "button" value = "View Cart" style = "float:left;"/>';
				if(isset($_SESSION['cart']))
					$result .='<input title = "Place Order" type = "submit" value = "Place Order" />';
				else
					$result .= '<input title = "Place Order" type = "button" value = "Place Order" onclick="showemptycart()" ></input>';
		$result .= '
            </div>
            </form>';
	
	return $result;
}

//this function loads cart for popup
function loadCartPopup()
{	
	$_SESSION['totalcost'] = 0;		
	$_SESSION['totalsaving'] = 0;
	$_SESSION['totalactualcost'] = 0;
	$_SESSION['itemcount'] = 0;
	
	$result = '
	<img style = "top:228px;left:440px;" id = "loadingicon_popup" src="../Images/loadingicon.gif"></img>
		<div  title = "Close Cart" class = "div_close_popup" onclick = "hideCartPopup()" ></div>
		<div class = "div_home_cart_popup_header">
			<div class = "div_home_cart_popup_header_item_discription">Name</div>
			<div class = "div_home_cart_popup_header_item_quantity">Quantity</div>
			<div class = "div_home_cart_popup_header_item_price">SubTotal</div>
			
		</div>
    	<div class = "div_home_cart_popup_body" id = "div_home_cart_popup_body">';
	
	if(isset($_SESSION["cart"]))
	{	
		//load the main body of cart popup.
		
		foreach($_SESSION['cart'] as $key=>$val)
		{
			$res = selectItemByType($key,'id');
			$row = mysql_fetch_assoc($res);
			$res_offer = FindCurrentOfferOnItem($key);
			$row_offer = mysql_fetch_assoc($res_offer);
			
			$result .= '<div class = "div_home_cart_popup_items_container">';
				$result.='<div class = "div_home_cart_popup_item_images"><image width="120px" height="120px" src = '.ImageRootPath_ItemImages.$row["ImagePath"].' >
						</image>
						</div>';
			
				$result.='<div class = "div_home_cart_popup_item_description">';
				$result.= '<span>'.$row["Description"].'</span>
						  </div>';
				
				//add option to change quantity..
				$result.='<div class = "div_home_cart_popup_item_quantity">
						  
						  <div class = "div_decrease_quantity" title = "Decrease Quantity" onclick=decreasequantity_popup("'.$row["MinQuantity"].'","'.$row["Unit"].
						  '") ></div>
							
						  <input disabled="disabled" class = "text_quantity" type = "text" value = "'.$_SESSION['cart'][$row["ID"]]." ".$row["Unit"].'" style = 
						  "width:50px;"/>
						  
						  <div class = "div_increase_quantity" title = "Increase Quantity" onclick=increasequantity_popup("'.$row["MinQuantity"].'","'.$row["Unit"
						  ].'")></div>
	     				  
						  <input onclick=AddToCart("'.$row["ID"].'",1) type = "button" value = "Change" class = "button_addtocart"</input>
						</div>';
					
				//add opton to change quantity finished..
				if(mysql_num_rows($res_offer) > 0)
				{
					$finalcost = (intval($row["Price"])-intval($row_offer["Off_Rs"]))*floatval($val);	
					$_SESSION['totalcost'] += (intval($row["Price"])-intval($row_offer["Off_Rs"]))*floatval($val);
					$_SESSION['totalactualcost'] += intval($row["Price"])*floatval($val);
					$_SESSION['totalsaving'] += intval($row_offer["Off_Rs"])*floatval($val);
				}
				else
				{
					$finalcost = (intval($row["Price"]))*floatval($val);
					$_SESSION['totalcost'] += (intval($row["Price"]))*floatval($val);
					$_SESSION['totalactualcost'] += intval($row["Price"])*floatval($val);
					//$_SESSION['totalsaving'] += intval($row["Off_Rs"])*floatval($val);
				}
				
				$result.='<div class = "div_home_cart_popup_item_price">
						  <span style = "font-weight:bold;">Rs '.$finalcost.'</span><br><br>
						  <span style = "font-size:14px;color:gray;">Market Price Rs '.$row["Price"].'/'.$row["Unit"].'</span><br>';
						  
						  if(mysql_num_rows($res_offer) > 0)
						  {
							$result .= '<span style = "font-size:14px;color:green;">Off Rs '.$row_offer["Off_Rs"].'/'.$row["Unit"].'</span><br> 
							<span id = "span_total_saving" style = "font-size:14px;color:green;">Saving: Rs '.$row_offer["Off_Rs"]*$_SESSION['cart'][$row["ID"]].'
						  	</span>';
						  }
						  
						  $result .= '
						  <br>
						  </div>';
				//add the cross button..
				
				$result .= '<div title="Remove Item" class = "div_close_popup" style = "float:left;margin-left:10px;" onclick="removeitem('.$row["ID"].',1)">
				</div>';
				
				$_SESSION['itemcount'] ++;
			$result .= '</div>';
		}
	}
	$result .= '</div>
	
    	  <div class = "div_home_cart_popup_footer">
		  	<div class = "div_home_cart_popup_footer_totalitem">Total Items: '.$_SESSION['itemcount'].'</div>
			<div class = "div_home_cart_popup_footer_totalcost">
				<span style = "font-size:14px;">Market Price Rs '.$_SESSION['totalactualcost']. '</span><br> 
				<span style = "color:green;font-size:14px;">Saving Rs '.$_SESSION['totalsaving'].'</span><br>
				<span style = "font-size:18px;">Total Ammount Payable Rs '.$_SESSION['totalcost']. '</span><br><br> 
			</div>
			<div class = "div_home_cart_popup_footer_bottom_container">
				<input title = "Click to Continue Shopping" type = "button" value = "Continue Shopping" onclick = "hideCartPopup()" style = 
				"float:left;margin-left:30px;" class = "button_continue_shopping" ></input>
				<form action = "LoginForm.php" method = "post">
					<input title = "Click to Place Order" type = "submit" value = "Place Order" style = "float:right;margin-right:30px;background:green;" class = 
				"button_placeorder" ></input>
				</form>
			</div>
		  </div>';
	
	return $result;	
}

	
function loadCartPopup_For_Review()
{
	$_SESSION['totalcost'] = 0;		
	$_SESSION['totalsaving'] = 0;
	$_SESSION['totalactualcost'] = 0;
	$_SESSION['itemcount'] = 0;
	
	$result = '
	<img style = "top:550px;left:660px;" id = "loadingicon_review" src="../Images/loadingicon.gif"></img>
		<div class = "div_home_cart_popup_header" style = "border:0px;">
			<div class = "div_home_cart_popup_header_item_discription">Name</div>
			<div class = "div_home_cart_popup_header_item_quantity">Quantity</div>
			<div class = "div_home_cart_popup_header_item_price">SubTotal</div>
			
		</div>
    	<div class = "div_home_cart_popup_body" id = "div_home_cart_popup_body" style 
		="height:auto;overflow:visible;margin-left:30px;width:1000px;max-height:none;">';
	
	if(isset($_SESSION["cart"]))
	{	
		//load the main body of cart popup.
		
		foreach($_SESSION['cart'] as $key=>$val)
		{
			$res = selectItemByType($key,'id');
			$row = mysql_fetch_assoc($res);
			
			$res_offer = FindCurrentOfferOnItem($key);
			$row_offer = mysql_fetch_assoc($res_offer);
			
			$result .= '<div class = "div_home_cart_popup_items_container" style = "width:1000px;">';
				$result.='<div class = "div_home_cart_popup_item_images"><image width="120px" height="120px" src = '.ImageRootPath_ItemImages.$row["ImagePath"].' >
						</image>
						</div>';
			
				$result.='<div class = "div_home_cart_popup_item_description">';
				$result.= '<span>'.$row["Description"].'</span>
						  </div>';
				
				//add option to change quantity..
				$result.='<div class = "div_home_cart_popup_item_quantity">
						  
						  <div class = "div_decrease_quantity" title = "Decrease Quantity" onclick=decreasequantity_popup("'.$row["MinQuantity"].'","'.$row[
						  "Unit"].'") ></div>
							
						  <input disabled="disabled" class = "text_quantity" type = "text" value = "'.$_SESSION['cart'][$row["ID"]]." ".$row["Unit"].'" style = 
						  "width:50px;"/>
						  
						  <div class = "div_increase_quantity" title = "Increase Quantity" onclick=increasequantity_popup("'.$row["MinQuantity"].'","'.$row[
						  "Unit"].'")></div>
	     				  
						  <input onclick=AddToCart("'.$row["ID"].'",2) type = "button" value = "Change" class = "button_addtocart"</input>
						</div>';
					
				//add opton to change quantity finished..
				
				
				
				if(mysql_num_rows($res_offer) > 0)
				{
					$finalcost = (intval($row["Price"])-intval($row_offer["Off_Rs"]))*floatval($val);	
				$result.='<div class = "div_home_cart_popup_item_price">
						  <span style = "font-weight:bold;">Rs '.$finalcost.'</span><br><br>
						  <span style = "font-size:14px;color:gray;">Market Price Rs '.$row["Price"].'/'.$row["Unit"].'</span><br>
						  <span style = "font-size:14px;color:green;">Off Rs '.$row_offer["Off_Rs"].'/'.$row["Unit"].'</span><br>
						  <span id = "span_total_saving" style = "font-size:14px;color:green;">Saving: Rs '.$row_offer["Off_Rs"]*$_SESSION['cart'][$row["ID"]].'
						  </span>';
						  
					$_SESSION['totalcost'] += (intval($row["Price"])-intval($row_offer["Off_Rs"]))*floatval($val);
					$_SESSION['totalactualcost'] += intval($row["Price"])*floatval($val);
					$_SESSION['totalsaving'] += intval($row_offer["Off_Rs"])*floatval($val);
				}
				else
				{
					$finalcost = (intval($row["Price"]))*floatval($val);	
				$result.='<div class = "div_home_cart_popup_item_price">
						  <span style = "font-weight:bold;">Rs '.$finalcost.'</span><br><br>
						  <span style = "font-size:14px;color:gray;">Market Price Rs '.$row["Price"].'/'.$row["Unit"].'</span><br>';
					
					$_SESSION['totalcost'] += (intval($row["Price"]))*floatval($val);
					$_SESSION['totalactualcost'] += intval($row["Price"])*floatval($val);
				}
				
				$result .= '<br>
						  </div>';
				//add the cross button..
				
				$result .= '<div title="Remove Item" class = "div_close_popup" style = "float:left;margin-left:10px;" onclick="removeitem('.$row["ID"].',2)">
				</div>';
				$_SESSION['itemcount'] ++;
			$result .= '</div>';
		}
	}
	$result .= '</div>
	
    	  <div class = "div_home_cart_popup_footer" style = "padding-right:60px;">
		  	<div class = "div_home_cart_popup_footer_totalitem">Total Items: '.$_SESSION['itemcount'].'</div>
			<div class = "div_home_cart_popup_footer_totalcost" style = "padding-left:115px;">
				<span style = "font-size:14px;">Market Price Rs '.$_SESSION['totalactualcost']. '</span><br> 
				<span style = "color:green;font-size:14px;">Saving Rs '.$_SESSION['totalsaving'].'</span><br>
				<span style = "font-size:18px;">Total Ammount Payable Rs '.$_SESSION['totalcost']. '</span><br><br> 
			</div>
			<div class = "div_home_cart_popup_footer_bottom_container" style = "width:36%;float:right;">
				<form action = "OrderConfirmation.php" method = "post">
					<input title = "Click to Place Order" type = "submit" value = "Confirm Order" style = "float:left;background:green;" class = 
				"button_placeorder" ></input>
				</form>
			</div>
		  </div>';
	
	return $result;	
}

function loadConfirmOrder()
{
	$_SESSION['totalcost'] = 0;		
	$_SESSION['totalsaving'] = 0;
	$_SESSION['totalactualcost'] = 0;
	$_SESSION['itemcount'] = 0;
	
	$result = '
		<div class = "div_home_cart_popup_header" style = "border:0px;">
			<div class = "div_home_cart_popup_header_item_discription">Name</div>
			<div class = "div_home_cart_popup_header_item_quantity">Quantity</div>
			<div class = "div_home_cart_popup_header_item_price">SubTotal</div>
			
		</div>
    	<div class = "div_home_cart_popup_body" id = "div_home_cart_popup_body" style 
		="height:auto;overflow:visible;margin-left:30px;width:1000px;max-height:none;">';
	
	if(isset($_SESSION["confirmorder"]))
	{	
		//load the main body of cart popup.
		
		foreach($_SESSION['confirmorder'] as $key=>$val)
		{
			$res = selectItemByType($key,'id');
			$row = mysql_fetch_assoc($res);
			
			$res_offer = FindCurrentOfferOnItem($key);
			$row_offer = mysql_fetch_assoc($res_offer);
			
			$result .= '<div class = "div_home_cart_popup_items_container" style = "width:1000px;">';
				$result.='<div class = "div_home_cart_popup_item_images"><image width="120px" height="120px" src = '.ImageRootPath_ItemImages.$row["ImagePath"].' >
						</image>
						</div>';
			
				$result.='<div class = "div_home_cart_popup_item_description">';
				$result.= '<span>'.$row["Description"].'</span>
						  </div>';
				
				//add option to change quantity..
				$result.='<div class = "div_home_cart_popup_item_quantity">
						  <span style = "font-weight:bold; margin-left:-70px;">'.$_SESSION['confirmorder'][$row["ID"]]." ".$row["Unit"].'</span>						  
						  </div>';
					
				//add opton to change quantity finished..
				if(mysql_num_rows($res_offer) > 0)
				{
					$finalcost = (intval($row["Price"])-intval($row_offer["Off_Rs"]))*floatval($val);	
					
					$result.='<div class = "div_home_cart_popup_item_price" style = "margin-left:-28px;">
						  <span style = "font-weight:bold;">Rs '.$finalcost.'</span><br><br>
						  <span style = "font-size:14px;color:gray;">Market Price Rs '.$row["Price"].'/'.$row["Unit"].'</span><br>
						  <span style = "font-size:14px;color:green;">Off Rs '.$row_offer["Off_Rs"].'/'.$row["Unit"].'</span><br>
						  <span id = "span_total_saving" style = "font-size:14px;color:green;">Saving: Rs '.$row_offer["Off_Rs"]*$_SESSION['confirmorder'][$row["ID"
						  ]].'
						  </span><br>
						  </div>';
				
					$_SESSION['totalcost'] += (intval($row["Price"])-intval($row_offer["Off_Rs"]))*floatval($val);
					$_SESSION['totalactualcost'] += intval($row["Price"])*floatval($val);
					$_SESSION['totalsaving'] += intval($row_offer["Off_Rs"])*floatval($val);
				}
				else
				{
					$finalcost = (intval($row["Price"]))*floatval($val);
					$result.='<div class = "div_home_cart_popup_item_price" style = "margin-left:-28px;">
						  <span style = "font-weight:bold;">Rs '.$finalcost.'</span><br><br>
						  <span style = "font-size:14px;color:gray;">Market Price Rs '.$row["Price"].'/'.$row["Unit"].'</span><br>
						  <br>
						  </div>';
				
					$_SESSION['totalcost'] += (intval($row["Price"]))*floatval($val);
					$_SESSION['totalactualcost'] += intval($row["Price"])*floatval($val);
				}
				
			$result .= '</div>';
			$_SESSION['itemcount'] ++;
		}
	}
	$result .= '</div>
	
    	  <div class = "div_home_cart_popup_footer" style = "padding-right:60px;">
		  	<div class = "div_home_cart_popup_footer_totalitem">Total Items: '.$_SESSION['itemcount'].'</div>
			<div class = "div_home_cart_popup_footer_totalcost" style = "padding-left: 117px;text-align: center;">
				<span style = "font-size:14px;">Market Price Rs '.$_SESSION['totalactualcost']. '</span><br> 
				<span style = "color:green;font-size:14px;">Saving Rs '.$_SESSION['totalsaving'].'</span><br>
				<span style = "font-size:18px;">Total Ammount Payable Rs '.$_SESSION['totalcost']. '</span><br><br> 
			</div>
			<div class = "div_home_cart_popup_footer_bottom_container" style = "margin-right:0px;width:820px;">
				<input title = "Click to Print Invoice" type = "submit" value = "Print Invoice" style = "float:right;background:green;" class = "button_placeorder" 
				></input>
			</div>
		  </div>';
	
	return $result;	
}


function findTotalCartCost()
{	
	if(isset($_SESSION["cart"]))
	{
		$_SESSION['totalcost'] = 0;	
		foreach($_SESSION['cart'] as $key=>$val)
		{
			$res = selectItemByType($key,'id');
			$row = mysql_fetch_assoc($res);
			$_SESSION['totalcost'] += (intval($row["Price"])-intval($row["Off_Rs"]))*floatval($val);
		}
		return $_SESSION["totalcost"];
	}
}

function loadLoginForm()
{
echo '
		<div class = "loginform_form_container">
		<img style = "top: 316px;left:643px;position: absolute;display:none;" id = "loadingicon" src="../Images/loadingicon.gif"></img>
        <div class = "form_header">
            Please Login or Register here to Place Order
        </div>
        <div class = "loginform_left_panel">';
		
		if(isset($_GET['acc']) && $_GET['acc'] == 1)
			$_SESSION['prev_location'] = "acc";
		else if(isset($_GET['home']) && $_GET['home'] == 1)
			$_SESSION['prev_location'] = "home";
				
	   echo'<form action = "AJAX_ValidateUser.php" id = "loginform" method = "post" >
                <div class = "loginform_left_panel_loginform">
                <div class = "loginform_left_panel_loginform_header"> <span>Login</span></div>    	
                    
                    <span>Email ID</span><br />
                    <input type = "text" title="Email ID" placeholder = "Email ID" id = "tb_emailid" name = "tb_emailid" required = "true" /><br /><br />
                    <span>Password</span><br>
                    
                    <input type = "password" placeholder = "Password" name = "tb_password" id= "tb_password" required = "true" /><br /><br>
                    
                    <input type = "submit" id = "button_continue"  class = "button_continue" title = "Continue" value = "Continue" /><br /><br />
                </div>
            </form>
            <form action = "AJAX_RegisterUser.php" id = "registerform" method = "post" >
                <div class = "loginform_left_panel_registerform">
                <div class = "loginform_left_panel_registerform_header"> <span>Register Here</span></div>    	
                    <span>Email ID</span><br />
                    <input type = "text" title="Email ID" placeholder = "Email ID" id = "tb_registerform_emailid" name = "tb_registerform_emailid" required = "true" 					/>
                    <br /><br />
                    <span>Password</span><br>
                    
                    <input type = "password" placeholder = "Password" name = "tb_registerform_password" id= "tb_registerform_password" required = "true" />
                    <br /><br>
                    <span>Confirm Password</span>
                    <input type = "password" placeholder = "Confirm Password" name = "tb_registerform_confirmpassword" id= "tb_registerform_confirmpassword" 
                    required = "true" />
                    <br /><br>
                    
                    <input style = "background:green;" type = "submit" id = "button_continue"  class = "button_continue" title = "Register" value = "Register" /><br
                    />
                    <br />
                </div>
            </form>
            
    </div>';//left panel ends here..
  echo '
  
  </div>	
';	
}

function loadAddressForm()
{
	echo '
	<div class = "addressform_container">
    	<div class = "form_header">Delivery Address</div>';
		//check if existing addresses are there.
		$res = SelectUserAddress($_SESSION['userid']);
		if(mysql_num_rows($res) > 0)
		{
			echo 
			'<div class = "addressform_address_container">';
			while($row = mysql_fetch_assoc($res))
			{
				echo '	
				<div class = "addressform_addresses">
				<form action = "ReviewOrder.php" method = "post">
					<input type = "text" style="visibility:hidden;position:absolute;" value = "'.$row["Address_ID"].'" name ="tb_addressid" />
					<div class = "addressform_address_name">'.$row["Name"].'</div><hr>
					<div class = "addressform_address_address">'.$row["Address"].'</div>
					
					<span>City: </span><div class = "addressform_address_city">'.$row["City"].'</div>
					<span>State: </span><div class = "addressform_address_state">'.$row["State"].'</div>
					<span>Pin Code: </span><div class = "addressform_address_pin">'.$row["Pin"].'</div>
					<span>Phone: </span><div class = "addressform_address_mobile">'.$row["Mobile"].'</div>
					<div class = "addressform_address_deliverhere">
						<input type = "submit" value ="Deliver Here"></input>
					</div><hr>
					
					<div class = "addressform_address_editdelete">
					
					<div title = "Edit Address" style = "cursor:pointer;float:left;width:15px;height:20px;background:url(../Images/editicon.png);" onclick =	
					load_address_entryform("'.$row["Address_ID"].'","0")></div>
						
					<div  title = "Delete Address" style = "cursor:pointer;float:right;width:15px;height:20px;background:url(../Images/deleteicon.png);" onclick= 
					deleteaddress("'.$row["Address_ID"].'")></div>
					
					</div>
				</form>
				</div>';
			}
			echo '</div>';
		}
		else
		{
			echo '<div class = "addressform_address_container">No Saved Address For You</div>';
		}
		echo '<hr><div class = "addressform_addnew_address">
			<input type = "button" value = "Add new Address" title = "Click to add new address"  onclick = load_address_entryform("'.$_SESSION["email"].'","1") >
			</input>
		</div>';	
		
	echo '		
    </div>	
	';
}

//this function insert the existing cart session to database after log in.
function insertCartToDataBase($userid,$itemid,$quantity)
{	
	$res = SelectItemInCartByUserIDAndItemID($userid,$itemid);			
	if(($quantity == '0.00' || $quantity == '0') && mysql_num_rows($res) == 1)
	{ 	
		//if that item already exist in cart table and now its value has set to be 0
		$res_update = DeleteItemInCartByUserIDAndItemID($userid,$itemid);
	}
	else if(($quantity != '0.00' || $quantity != '0') && mysql_num_rows($res) == 1) 	//if that item already exist in cart table
	{	
		$res_update = UpdateItemInCartByUserIDAndItemID($userid,$itemid,$quantity,date("Y/m/d"));
	}
	else		//if that item needs to be inserted into cart table
	{
		$res_update = InsertItemInCartByUserIDAndItemID($userid,$itemid,$quantity,date("Y/m/d"));
	}
}

//this funtion loads the session from database if user has some items in cart and is logged in ...
function loadSessionFromDB($userid)
{
	$res = SelectItemInCartByUserID($userid);
	unset($_SESSION['cart']);
	while($row = mysql_fetch_assoc($res))
	{
		$_SESSION['cart'][$row['Item_ID']] = $row['Quantity'];	
	}
}

function loadSessionFromDB_ConfirmOrder($userid,$orderid)
{
	$res = SelectItemInConfirmOrderByUserIDAndOrderID($userid,$orderid);
	unset($_SESSION['confirmorder']);
	//$_SESSION['confirmorder'];
	unset($_SESSION['cart']);
	if($res && (mysql_num_rows($res) > 0))
	{
		while($row = mysql_fetch_assoc($res))
		{
			$_SESSION['confirmorder'][$row['Item_ID']] = $row['Quantity'];
		}
		//return $res;
	}
	//return $res;
	
}

function ConfirmOrder($userid)
{
	$result = InsertCartToConfirmOrder($userid);	
	//$res_del = 0;
	if($result)
		$res_del = DeleteFromCartByUserID($userid);	
	
	return $result;
}


function FindAddressbyAddressID($id)
{
	$res = SelectUserAddress_By_ID($id);
	return $res;
}
	
function checkLoginStatus()
{
	if(isset($_SESSION['userid']))
		return true;
	else
		return false;
}

function Admin_checkLoginStatus()
{
	if(isset($_SESSION['admin_userid']))
		return true;
	else
		return false;
}

function drawFooter()
{
	$result = 
	'<div class = "div_footer_wrapper">
		<div class = "div_footer_container">
			<div class = "div_footer_links">
			<ul>
				<li><a href = "index.php">Home</a></li>
				<li><a href = "ContactUs.php">Contact Us</a></li>
				<li><a href = "Feedback.php">Feedback</a></li>';
				if(!Admin_checkLoginStatus())
					$result .= '<li><a href = "AdminLogin.php">Administrative Login</a></li>';
				else
					$result .= '<li><a href = "AdminLogout.php">Administrative Logout</a></li>';
			$result .= '
			</ul>
			</div>
			<br><br>
			<div class = "div_footer_links">
				<span>For any other information please feel free to contact us at 
				<a href = "mailto:customercare@kiranastore.net16.net">customercare</a>
				</span>
				<br>
				<br>
				<span>© 2014-2015 mykiranastore.com</span>
			</div>
			
		</div>
	</div>
	';
	return $result;
}
?>

