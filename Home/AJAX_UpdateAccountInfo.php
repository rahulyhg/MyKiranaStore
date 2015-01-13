<?php
require_once("masterpage_account.php");
require_once("masterpage.php");
require_once("../Include/Queries/QueryBuilder.php");
if(isset($_GET["from"]))
{
	$from = $_GET['from'];
	if($from == 1)
	{
	}
	else if($from == 2)
	{
		$fname = $_GET['fname'];
		$lname = $_GET['lname'];
		$dob = $_GET['dob'];
		$mobile = $_GET['mobile'];
		$sex = $_GET['sex'];	
		$res = SelectUserInfo($_SESSION['userid']);
		if(mysql_num_rows($res) > 0)
			UpdateUserInfo($_SESSION['userid'],$fname,$lname,$dob,$mobile,$sex);
		else
			InsertUserInfo($_SESSION['userid'],$fname,$lname,$dob,$mobile,$sex);
		echo LoadEditProfile();
	}
	else if($from == 3)
	{}
	
}

//this code is for viewing order details..
if(isset($_GET['orderdetail']) && $_GET['orderdetail'] == 1)
{
	$orderid = $_GET['orderid'];
	echo LoadOrderDetail($orderid);	
}

?>