<?php
	header('Content-type: text/html');
    header('Access-Control-Allow-Origin: *');

	$mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_password = 'phrase';
	$mysql_db = 'phrase dictionary';
	
	if(mysql_connect($mysql_host,$mysql_user,$mysql_password)&& mysql_select_db($mysql_db))
	{
		if (isset($_GET['addedtranslation']) && isset($_GET['cat']))
		{
			$phrase = $_GET['addedtranslation'];
			$cat_id = $_GET['cat'];
			if(!empty($phrase))
			{
				$query = "SELECT phrase FROM 'phrase english' WHERE phrase='$phrase'";	
					$query_run = mysql_query($query);
					
					
					$query = "INSERT INTO `phrase english` VALUES ('','".mysql_real_escape_string($phrase)." ','".mysql_real_escape_string($cat_id)."')";					
						if($query_run = mysql_query($query))
						{
							echo $_GET['callback'] . '(' . "{'text' : 'Translation added, well done!'}" . ')';
							
							$jsonstring = json_encode('translation: '. $addedtranslation . ' added!!!');
							
							
						}
						else
						{
							echo $_GET['callback'] . '(' . "{'text' : 'YOUR TRANSLATION SUCKS! I AM NOT GOING TO ADD IT!!'}" . ')';
						}
						
					
			
			}
		}				
	}	
	else
	{
		echo $_GET['callback'] . '(' . "{'text' : 'Failed to connect to MySQL!'}" . ')';
	}
	
?>