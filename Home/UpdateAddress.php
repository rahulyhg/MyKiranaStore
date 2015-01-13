<?php
require_once("../Include/Queries/QueryBuilder.php");
session_start();


$addressid = $_POST["addressid"];
$name = $_POST["tb_name"];
$address = $_POST["tb_address"];
$city = $_POST["tb_city"];
$state = $_POST["tb_state"];
$country = "India";
$pin = $_POST["tb_pin"];
$phone = $_POST["tb_phone"];
$userid = $_SESSION['userid'];

if($addressid)
{
	$res = UpdateUserAddress($userid,$addressid,$name,$address,$city,$state,$country,$pin,$phone);
}
else
{
	$res = InsertUserAddress($userid,$name,$address,$city,$state,$country,$pin,$phone);	
}

//echo $res;
if($res)
{
	header("location:AddressForm.php");	
}
else
	header("location:AddressForm.php?err=1");	

?>