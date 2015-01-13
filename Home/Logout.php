<?php
	include("masterpage.php");
	include("../Include/Defines.php");
	session_destroy();
	header("location:index.php");
?>