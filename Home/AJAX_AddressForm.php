<?php
require_once("../Include/Queries/QueryBuilder.php");
require_once("masterpage.php");

if(isset($_GET['load']) && $_GET["load"] == 1)
{
	
		
}


if(isset($_GET['id']))
{
	if(DeleteUserAddress($_GET["id"]))
	{
		echo loadAddressForm();
	}
		
}
?>