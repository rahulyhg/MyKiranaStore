<?php
	include("masterpage.php");
	include("../Include/Defines.php");
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Buy Your own kirana online</title>
<link href="../CSS/background.css"  type="text/css" rel = "stylesheet"/>
<link href="../CSS/address.css"  type="text/css" rel = "stylesheet"/>
<link href="../CSS/home.css"  type="text/css" rel = "stylesheet"/>
<link href="../CSS/cart_popup.css"  type="text/css" rel = "stylesheet"/>
<link href="../CSS/loginform.css"  type="text/css" rel = "stylesheet"/>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<!-- bxSlider Javascript file -->
<script src="../JavaScript/jquery.bxslider.min.js"></script>
<script src="../JavaScript/addressform.js" type="text/javascript"></script>
<script src="../JavaScript/home.js"></script>
<!-- bxSlider CSS file -->
<link href="../CSS/jquery.bxslider.css" rel="stylesheet" type="text/css" />

</head>

<body>
<?php
	drawHeader();
?>

<div class = "form_main_wrapper" id = "addressform_main_wrapper">
	<?php
	if(!checkLoginStatus())
		header("location:LoginForm.php");
	else
		loadAddressForm();
	?>
</div>
<div class = "div_address_form_shield"></div>
<div class = "div_addressform_edit_address_form_container">
	<div class = "div_addressform_edit_address_form_closebutton" onclick = "closepopup()"></div>
    <div class = "div_addressform_header">
 		Edit Your Shipping Details
    </div>
    <hr />
    <form action = "UpdateAddress.php" method="post">
    <input type = "text" style = "visibility:hidden;position:absolute;" id = "addressid" name = "addressid"></input>
    <div class = "div_addressform">
    	<div class = "div_addressform_feild">
        	<div class = "div_addressform_feild_label">
        		Name
        	</div>
            <div class = "div_addressform_feild_input">
        		<input required type = "text" placeholder = "Name" id = "tb_name" name = "tb_name" />
        	</div>	
        </div>
        <div class = "div_addressform_feild">
        	<div class = "div_addressform_feild_label">
        		Address
        	</div>
            <div class = "div_addressform_feild_input" style = "height:90px;">
        		<textarea required  placeholder = "Address" style= "height:90px;"  id = "tb_address" name = "tb_address"></textarea>
        	</div>	
        </div>
        <div class = "div_addressform_feild">
        	<div class = "div_addressform_feild_label">
        		City
        	</div>
            <div class = "div_addressform_feild_input">
        		<input required type = "text" placeholder = "City"  id = "tb_city" name = "tb_city"/>
        	</div>	
        </div>
        <div class = "div_addressform_feild">
        	<div class = "div_addressform_feild_label">
        		State
        	</div>
            <div class = "div_addressform_feild_input">
        		<input required type = "text" placeholder = "State" id = "tb_state" name = "tb_state" />
        	</div>	
        </div>
        <div class = "div_addressform_feild">
        	<div class = "div_addressform_feild_label">
        		Pin Code
        	</div>
            <div class = "div_addressform_feild_input">
        		<input required type = "text" placeholder = "Pin Code"  id = "tb_pin" name = "tb_pin"/>
        	</div>	
        </div>
        <div class = "div_addressform_feild">
        	<div class = "div_addressform_feild_label">
        		Phone
        	</div>
            <div class = "div_addressform_feild_input">
        		<input type = "text" placeholder = "Contact Number" id = "tb_phone" name = "tb_phone" />
        	</div>	
        </div>
         <div class = "div_addressform_feild">
        	<div class = "div_addressform_feild_confirmbutton">
        		<input type = "submit" value = "Save" />
        	</div>	
        </div>
    </div>
    </form>

</div>	
<div class = "div_home_shield"></div>
<div class = "div_home_cart_popup" id = "div_home_cart_popup"></div>

<?php
	echo drawFooter();
?>
</body>