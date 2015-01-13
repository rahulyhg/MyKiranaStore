<?php
	include("masterpage.php");
	include("masterpage_admin.php");
	include("../Include/Defines.php");
	
	unset($_SESSION['admin_userid']);
	header("location:index.php");
?>