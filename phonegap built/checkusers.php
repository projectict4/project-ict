<?php
	header('Content-type: text/html');
    header('Access-Control-Allow-Origin: *');

	//require 'core.php';

	$mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_password = 'phrase';
	$mysql_db = 'phrase dictionary';
	
	if(mysql_connect($mysql_host,$mysql_user,$mysql_password)&& mysql_select_db($mysql_db))
	{
		$log = $_GET['log'];
		$pas = $_GET['pas'];
		
		if(isset($log)&&isset($pas))
		{
			if(!empty($log) && !empty($pas))
			{
				$query = "SELECT id FROM users WHERE username='$log' and password='$pas'";

				if($query_run = mysql_query($query))
				{
					$query_num_rows = mysql_num_rows($query_run);
					if($query_num_rows == 0)
					{
						$jsonstring = json_encode('invalid username/password combination!');
						echo $_GET['callback'] . '(' . "{'text' : $jsonstring}" . ')';
					}
					else if($query_num_rows==1)
					{
						$user_id = mysql_result($query_run,0,'id');
						//$_SESSION['user_id']=$user_id;

						//$jsonstring = json_encode('user: '. $user_id . ' connected!!!');
						echo $_GET['callback'] . '(' . "{'text' : 'ok'}" . ')';
					}
				}
			}
			else
			{
				echo $_GET['callback'] . '(' . "{'text' : 'you must set a password and a username.'}" . ')';
			}
		}	
	}
	else
	{
		echo $_GET['callback'] . '(' . "{'text' : 'Failed to connect to MySQL!'}" . ')';
	}
?>