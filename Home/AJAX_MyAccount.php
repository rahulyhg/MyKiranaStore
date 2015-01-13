<?php
require_once("masterpage.php");
require_once("masterpage_account.php");
	if(isset($_GET['from']) && checkLoginStatus())
	{
		if($_GET['from'] == 1)
			echo LoadMyOrders();
		else if($_GET['from'] == 2)
			echo LoadEditProfile();
		else if($_GET['from'] == 3)
			echo LoadAddressBook();
	}
	
	
	
?>