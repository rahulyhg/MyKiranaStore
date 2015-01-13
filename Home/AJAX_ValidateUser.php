<?php
require_once("../Include/Queries/QueryBuilder.php");
require_once("masterpage.php");

$email = $_GET['email'];
$password = $_GET['pass'];

	$res = selectUserAccountDetails($email);
	//already registerd user but again trying to register
	if(isset($_GET["new"]) && $_GET["new"] == 1 && mysql_num_rows($res) != 0)
	{
		echo "4";
	}
	//user does not exist
	else if(isset($_GET["new"]) && $_GET["new"] == 1 && mysql_num_rows($res) == 0)
	{
		$date = date("Y-m-d H:i:s");
		//$year =(explode('-',$date));
		//$year = $year[0];	
		
		$date = strtotime($date);
		$year = date('Y', $date);
		$salt = 'kiranastore';
		$tempHash = $password . (string)$date . (string)$salt;
		for($i=0; $i < $year; $i++) $tempHash = md5($tempHash);
		
		$password = $tempHash;
		

		//echo insertFirstTimeUser($email,$password);
		if(insertFirstTimeUser($email,$password))
		{
			$_SESSION['email'] = $email;
			if(isset($_SESSION['prev_location']) && $_SESSION['prev_location'] == "acc")
				echo "5";
			else if(isset($_SESSION['prev_location']) && $_SESSION['prev_location'] == "home")
				echo "6";
			else
				echo "3";
			//insert the cart to database.
			foreach($_SESSION['cart'] as $key=>$val)
				insertCartToDataBase($_SESSION['userid'],$key,$val);
			
		}
	}
	else if(mysql_num_rows($res) == 0)	//user uses login form to register .Ask him to register first.
	{
		echo "0";
	}
	else 	//user exist
	{
		$row = mysql_fetch_assoc($res);
		
		$date = strtotime($row["Created_Date"]);
		$year = date('Y', $date);
		$salt = 'kiranastore';
		$tempHash = $password . (string)$date . (string)$salt;
		for($i=0; $i < $year; $i++) $tempHash = md5($tempHash);
		
		$password = $tempHash;
		
		if($row["Password"] == $password)
		{
			$_SESSION['email'] = $email;
			$_SESSION['userid'] = $row['User_ID'];
			if(isset($_SESSION['prev_location']) && $_SESSION['prev_location'] == "acc")
				echo "5";
			else if(isset($_SESSION['prev_location']) && $_SESSION['prev_location'] == "home")
				echo "6";
			else
				echo "2";
			
			foreach($_SESSION['cart'] as $key=>$val)
				insertCartToDataBase($_SESSION['userid'],$key,$val);
		}
		else
		{
			echo "1";	
		}
	}
?>