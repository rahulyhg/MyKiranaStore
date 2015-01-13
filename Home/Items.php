
<?php
	include("masterpage.php");
	include("../Include/Defines.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Buy Your own kirana online</title>
<link href="../CSS/background.css"  type="text/css" rel = "stylesheet"/>
<link href="../CSS/home.css"  type="text/css" rel = "stylesheet"/>
<link href="../CSS/cart_popup.css"  type="text/css" rel = "stylesheet"/>
<link href="../CSS/style.css"  type="text/css" rel = "stylesheet"/>

<link href="../CSS/jquery.bxslider.css" rel="stylesheet" type="text/css" />

<!-- bxSlider Javascript file -->
<script src="../JavaScript/home.js" type="text/javascript"></script>
<script src="../JavaScript/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="../JavaScript/jquery.fitvids.js" type="text/javascript"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>    


</head>

<body>
<?php
	drawHeader();
?>
<div class = "div_home_main">
	<div class = "div_home_left_panel">
    	<div class = "div_home_slideshow">
            <?php echo LoadSlideShow();?>
        </div>	
        <div class = "div_home_offers">
       		<div class = "div_home_offers_category_wise">
        		<div class = "div_home_offers_tag">
            		<?php 
						$res = FindTagForItems($_GET['sc']);
						$row = mysql_fetch_assoc($res);
						echo $row["Name"];
					?>
            	</div>
            		<?php  
						echo LoadItems($_GET['sc']);
					?>
           </div>
    </div> 
    </div>
	<div class = "div_home_right_panel">
    	<div class = "div_home_mycart" id = "div_home_mycart">
            <?php 
				if(!checkLoginStatus())
					echo loadCart();
				else
				{
					loadSessionFromDB($_SESSION['userid']);	 
					echo loadCart();
				}
			?>
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