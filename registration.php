<?php

	header('Content-type: text/html');
    header('Access-Control-Allow-Origin: *');

	$mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_password = 'phrase';
	$mysql_db = 'phrase dictionary';


	if(mysql_connect($mysql_host,$mysql_user,$mysql_password)&& mysql_select_db($mysql_db))
	{
		if (isset($_GET['username'])&& isset($_GET['password'])&& isset($_GET['password2'])&& isset($_GET['firstname'])&& isset($_GET['surename']))
		{
			$username = $_GET['username'];
			$password = $_GET['password'];
			$password2 = $_GET['password2'];
			$firstname = $_GET['firstname'];
			$surename = $_GET['surename'];

			if(!empty($username)&& !empty($password)&& !empty($password2)&& !empty($firstname)&& !empty($surename))
			{
				if($password == $password2)
				{
					$query = "SELECT username FROM users WHERE username='$username'";
					$query_run = mysql_query($query);

					if(mysql_num_rows($query_run) == 1)
					{
						echo $_GET['callback'] . '(' . "{'text' : 'the username already exists.'}" . ')';
					}
					else
					{
						$query = "INSERT INTO users VALUES ('','".mysql_real_escape_string($username)."','".mysql_real_escape_string($password)."','".mysql_real_escape_string($surename)."','".mysql_real_escape_string($firstname)."')";
						if($query_run = mysql_query($query))
						{
							echo $_GET['callback'] . '(' . "{'text' : 'registration succesfull. User has been added to the database.'}" . ')';
						}
						else
						{
							echo $_GET['callback'] . '(' . "{'text' : 'sorry, we could not register you. Try again later.'}" . ')';
						}
					}
				}
				else
				{
					echo $_GET['callback'] . '(' . "{'text' : 'the passwords do not match!'}" . ')';
				}
			}
			else
			{
				echo $_GET['callback'] . '(' . "{'text' : 'all feelds are required'}" . ')';
			}
		}
	}
	else
	{
		echo $_GET['callback'] . '(' . "{'text' : 'Failed to connect to MySQL!'}" . ')';
	}
?>