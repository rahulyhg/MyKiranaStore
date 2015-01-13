<?php
	include("masterpage.php");
	include("masterpage_admin.php");
	include("../Include/Defines.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Buy Your own kirana online</title>
<link href="../CSS/background.css"  type="text/css" rel = "stylesheet"/>
<link href="../CSS/loginform.css"  type="text/css" rel = "stylesheet"/>
<link href="../CSS/admin.css"  type="text/css" rel = "stylesheet"/>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<!-- bxSlider Javascript file -->
<script src="../JavaScript/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="../CSS/jquery.bxslider.css" rel="stylesheet" type="text/css" />

</head>

<body>
<?php
	drawHeader();
?>

<div class = "form_main_wrapper">
	<?php
		loadLoginFormForAdmin();
	?>
    
</div>	
<?php
	echo drawFooter();
?>
</body>