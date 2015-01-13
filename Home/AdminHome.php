<?php
	include("masterpage.php");
	include("masterpage_admin.php");
	include("../Include/Defines.php");
	
	$email = $_POST['tb_emailid'];
	$password = $_POST['tb_password'];
	$res = Admin_SelectUser($email);
	if(mysql_num_rows($res) > 0)
	{
		$row = mysql_fetch_assoc($res);
		if($password == $row["Password"])
		{
			$_SESSION['admin_email'] = $email;
			$_SESSION['admin_userid'] = $row["User_ID"];
		}	
	}
	else
	{
		header("location:Index.php");
	}
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage Your Store Online</title>
<link href="../CSS/background.css"  type="text/css" rel = "stylesheet"/>
<link href="../CSS/home.css"  type="text/css" rel = "stylesheet"/>
<link href="../CSS/loginform.css"  type="text/css" rel = "stylesheet"/>
<link href="../CSS/admin.css"  type="text/css" rel = "stylesheet"/>
<link href="../CSS/cart_popup.css"  type="text/css" rel = "stylesheet"/>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<!-- bxSlider Javascript file -->
<script src="../JavaScript/jquery.bxslider.min.js"></script>
<script src="../JavaScript/home.js" type="text/javascript"></script>
<script src="../JavaScript/admin.js" type="text/javascript"></script>
<!-- bxSlider CSS file -->
<link href="../CSS/jquery.bxslider.css" rel="stylesheet" type="text/css" />

</head>

<body>
<?php
	drawHeader();
?>
	<div class = "form_main_wrapper" id = "addressform_main_wrapper">
        <div class = "form_container">
            <div class = "form_header">
                Manage Your Account
            </div>
            <div class = "div_admin_left_panel">
                <?php
                    echo loadAdminLeftPanel();
                ?>
            </div>
            <div class = "div_admin_right_panel" id = "div_admin_right_panel">
            </div>
        </div>
	</div>	

<!-- div for showing the cart popup-->
<div class = "div_home_shield"></div>
<div class = "div_home_cart_popup" id = "div_home_cart_popup"></div>
<?php
	echo drawFooter();
?>
</body>
</html>