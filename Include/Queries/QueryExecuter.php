<?php
require_once("QueryMaster.php");
require_once("../Include/ConfigSQL.php");

function RunSelectQuery($qry)
{
	OpenConnection();
	$result = mysql_query($qry);
	if(!$result)
		return (mysql_error());
	else
	{
		return $result;
	}	
	
	//CloseConnection();
	
}

function RunInsertQuery($qry)
{
	OpenConnection();
	$result = mysql_query($qry);
	if(!$result)
		return (mysql_error());
	else
	{
		return $result;
	}	
	//CloseConnection();
}

function RunDeleteQuery($qry)
{
	OpenConnection();
	$result = mysql_query($qry);
	if(!$result)
		return mysql_error();
	else
	{
		return $result;
	}	
	//CloseConnection();
}

function RunUpdateQuery($qry)
{
	OpenConnection();
	$result = mysql_query($qry);
	if(!$result)
		return mysql_error();
	else
	{
		return $result;
	}	
	//CloseConnection();
}
?>