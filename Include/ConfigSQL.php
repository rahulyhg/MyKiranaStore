<?php

/*
	define('HOST', 'mysql11.000webhost.com');
    define('USER', 'a9875909_umang');
    define('PASSWORD', 'cuttiepie@0711');
    define('DATABASE', 'a9875909_kirana');
*/
	define('HOST', 'localhost');
    define('USER', 'root');
    define('PASSWORD', '');
    define('DATABASE', 'kiranastore');

	//define("SECURE", FALSE);
	function OpenConnection()
	{
		$link = mysql_connect(HOST,USER,PASSWORD);
		if(!$link)
			die("Error in Connecting to Server");
		
		$db = mysql_select_db(DATABASE);
		if(!$db)
			die("Unable to connect to database");
	}
	
	/*function CloseConnection()
	{
		mysql_close($link);	
	}*/
	
	
?>