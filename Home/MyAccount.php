<?php
	require_once("masterpage.php");
	require_once("masterpage_account.php");
	require_once("../Include/Defines.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Buy Your own kirana online</title>
<link href="../CSS/background.css"  type="text/css" rel = "stylesheet"/>
<link href="../CSS/home.css"  type="text/css" rel = "stylesheet"/>
<link href="../CSS/cart_popup.css"  type="text/css" rel = "stylesheet"/>
<link href="../CSS/myaccount.css"  type="text/css" rel = "stylesheet"/>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<!-- bxSlider Javascript file -->
<script src="../JavaScript/jquery.bxslider.min.js"></script>
<script src="../JavaScript/home.js"></script>
<script src="../JavaScript/myaccount.js"></script>

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
		header("location:LoginForm.php?acc=1");
	//else
		//loadAddressForm();
	?>
    <div class = "form_container">
        <div class = "form_header">
            Manage Your Account
        </div>
    <div class = "account_left_panel">
    	<?php
        	echo loadAccountLeftPanel();
		?>
    </div>
    <div class = "account_right_panel">
    	<div class = "account_right_panel_heading" id = "account_right_panel_heading">
        	Profile Overview
        </div>
        <div class = "account_right_panel_container" id = "account_right_panel_container">
        	<img style = "top:370px;left:815px;" id = "loadingicon_home" src="../Images/loadingicon.gif"></img>
            <?php echo LoadEditProfile(); ?>
        </div>
		
    </div>
    </div>
    
</div>	
<div class = "div_home_shield"></div>
<div class = "div_home_cart_popup" id = "div_home_cart_popup"></div>

<?php
	echo drawFooter();
?>
</body>