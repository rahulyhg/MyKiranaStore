<?php
	require_once("masterpage.php");
	include("../Include/Defines.php");
	
	//if the already build cart needs to be loaded..
	if(isset($_GET["new"]) && $_GET["new"] == 1)
	{
		echo loadCart();
	}
	else 	//if there is change in quantity of item in cart then load new cart..
	{
		if(!isset($_SESSION['cart'][$_GET["id"]]))
			$_SESSION['cart'][$_GET["id"]] = 0;
			
		$item_unit = explode(' ',$_GET["unit"]);
		
		$_SESSION['cart'][$_GET["id"]] =  $item_unit[0];
		
		
		//insert all cart items to database.
		if(checkLoginStatus())
		{
			insertCartToDataBase($_SESSION['userid'],$_GET["id"],$_SESSION['cart'][$_GET["id"]]);
		}
		
		if($item_unit[0] == '0.00' || $item_unit[0] == '0')
		{
			unset($_SESSION['cart'][$_GET["id"]]);
		}
		
		
		if($_GET["from"] == 0)
			echo loadCart();
		else if($_GET["from"] == 1)
			echo loadCartPopup();
		else
			echo loadCartPopup_For_Review();
	}
?>
