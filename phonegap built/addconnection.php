<?php
	header('Content-type: text/html');
	header('Access-Control-Allow-Origin: *');

	$mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_password = 'phrase';
	$mysql_db = 'phrase dictionary';

	if(mysql_connect($mysql_host,$mysql_user,$mysql_password)&& mysql_select_db($mysql_db))
	{
		if (isset($_GET['cat']))
		{
			
			$cat_id = $_GET['cat'];
			if(!empty($cat_id))
			{
				$query = "SELECT `cat` FROM `phrase connections`WHERE cat='$cat_id'";	
				$query_run = mysql_query($query);
			
				//placeholders
				$query = "INSERT INTO `phrase connections` VALUES ('','".mysql_real_escape_string($cat_id)."','','','')"; 
				if($query_run = mysql_query($query))
				{
					echo $_GET['callback'] . '(' . "{'text' : 'Id assigned!'}" . ')';
			
					$jsonstring = json_encode('Id: '. $cat_id . 'assigned!');
				}
				else
				{
					echo $_GET['callback'] . '('. "{'text' : 'Failed to assign id!'}" . ')';
				}
			}
		}
	}	
	else
	{
		echo $_GET['callback'] . '(' . "{'text' : 'Failed to connect to MySQL!'}" . ')';
	}
	
?>								