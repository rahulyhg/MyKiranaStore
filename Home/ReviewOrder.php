<?php
	include("masterpage.php");
	include("../Include/Defines.php");
	
	if(!checkLoginStatus())
		header("location:LoginForm.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Buy Your own kirana online</title>
<link href="../CSS/background.css"  type="text/css" rel = "stylesheet"/>
<link href="../CSS/cart_popup.css"  type="text/css" rel = "stylesheet"/>
<link href="../CSS/home.css"  type="text/css" rel = "stylesheet"/>
<link href="../CSS/loginform.css"  type="text/css" rel = "stylesheet"/>
<link href="../CSS/revieworder.css"  type="text/css" rel = "stylesheet"/>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<!-- bxSlider Javascript file -->
<script src="../JavaScript/jquery.bxslider.min.js"></script>
<script src="../JavaScript/home.js"></script>
<!-- bxSlider CSS file -->
<link href="../CSS/jquery.bxslider.css" rel="stylesheet" type="text/css" />

</head>

<body>
<?php
	drawHeader();
?>
<div class = "form_main_wrapper" id = "addressform_main_wrapper" style = "height:auto;">
    <div class = "form_header">Review your Order</div>
    <div class = "revieworder_address">
    	<div class = "revieworder_address_header">Delivery Address</div>
        <div class = "revieworder_address_container">
        	<div class = "revieworder_address_left">
        	<?php
			if(!isset($_POST['tb_addressid']))
				header("location:AddressForm.php");	
            else
			{
				$addressid = $_POST["tb_addressid"];
				$_SESSION['addressid'] = $addressid;
			}
				$res = FindAddressbyAddressID($addressid);
				if(mysql_num_rows($res) > 0)
				{
					 $row = mysql_fetch_assoc($res);
					 echo '
					 	<span style = "font-weight:bold;font-size:20px;color:black;">'.$row["Name"].'</span><br>
						<span>'.$row["Address"].'</span><br>
						<span>'.$row["City"].','.$row["State"].'</span><br>
						<span>Pin '.$row["Pin"].'</span><br>
						<span>Phone '.$row["Mobile"].'</span>
					 ';
				}	
			?>
            </div>
            <div class = "revieworder_address_right">
            	<input value = "Change Address" type = "button" onclick = "document.location.href = 'AddressForm.php';" ></input>
            </div>
        </div>
    </div>
    <hr />
    
    <div class = "revieworder_order">
        <div class = "revieworder_order_header">Order Details</div>
        <div class = "revieworder_order_container" id = "revieworder_order_container">
        	<?php
            	echo loadCartPopup_For_Review();
			?>
        </div>
    </div>
    
    
</div>
<br /><br />
<div class = "div_home_shield"></div>
<div class = "div_home_cart_popup" id = "div_home_cart_popup"></div>

<?php
	echo drawFooter();
?>
</body>
</html>