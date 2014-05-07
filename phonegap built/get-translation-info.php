<?php

	header('Content-type: text/html');
    header('Access-Control-Allow-Origin: *');

	$mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_password = 'phrase';
	$mysql_db = 'phrase dictionary';


	if(mysql_connect($mysql_host,$mysql_user,$mysql_password)&& mysql_select_db($mysql_db))
	{
		$cat = $_GET['cat'];
		$language1 = $_GET['language1'];
		$language2 = $_GET['language2'];
		$catId;


		// Collects phrases in table phrase english 
		$data = mysql_query("SELECT phrase FROM `phrase english` WHERE id='1'");
		$info = mysql_result($data,0,'phrase');
		
		if($language1 == 'phrase english')
		{
			$catId = 'id eng';
		}
		else if($language1 == 'phrase finnish')
		{
			$catId = 'id fin';
		}
		else
		{
			$catId = 'id dutch';
		}

		$data2 = mysql_query("SELECT phrase FROM `$language1` WHERE id = ANY (SELECT `$catId` FROM `phrase connections` WHERE cat='$cat')");
		$total_rows = mysql_num_rows($data2);
		//$info2 = mysql_result($data2,0,'phrase');

		$array_result = array();
		for ($i = 1; $i <= $total_rows; $i++) {
			$j = $i - 1;
			$array_result["key$i"] = mysql_result($data2,$j,'phrase');
		}
		//echo $array_result[1];

		//$info3 = mysql_fetch_array($data2);

		//$info = mysql_fetch_array( $data );
		//$infoString = (string)$info;
		
		
		// SQL query for all traveling sentences in english SELECT phrase FROM `phrase english` WHERE `cat id`=1
		// SQL query for all directions sentences in english SELECT phrase FROM `phrase english` WHERE `cat id` = 2
		// SQL query for all ordering and shopping sentences in english SELECT phrase FROM `phrase english` WHERE `cat id` = 3
		// SQL query for all thanking and apologicing sentences in english SELECT phrase FROM `phrase english` WHERE `cat id` = 4
		// SQL query for all dates and times sentences in english SELECT phrase FROM `phrase english` WHERE `cat id` = 5
		// SQL query for all numerals sentences in english SELECT phrase FROM `phrase english` WHERE `cat id` = 6
		
		
		// SQL query for all traveling sentences in english SELECT phrase FROM `phrase dutch` WHERE `cat id`=1
		// SQL query for all directions sentences in english SELECT phrase FROM `phrase dutch` WHERE `cat id` = 2
		// SQL query for all ordering and shopping sentences in english SELECT phrase FROM `phrase dutch` WHERE `cat id` = 3
		// SQL query for all thanking and apologicing sentences in english SELECT phrase FROM `phrase dutch` WHERE `cat id` = 4
		// SQL query for all dates and times sentences in english SELECT phrase FROM `phrase dutch` WHERE `cat id` = 5
		// SQL query for all numerals sentences in english SELECT phrase FROM `phrase dutch` WHERE `cat id` = 6
		
		
		// SQL query for all traveling sentences in english SELECT phrase FROM `phrase finnish` WHERE `cat id`=1
		// SQL query for all directions sentences in english SELECT phrase FROM `phrase finnish` WHERE `cat id` = 2
		// SQL query for all ordering and shopping sentences in english SELECT phrase FROM `phrase finnish` WHERE `cat id` = 3
		// SQL query for all thanking and apologicing sentences in english SELECT phrase FROM `phrase finnish` WHERE `cat id` = 4
		// SQL query for all dates and times sentences in english SELECT phrase FROM `phrase finnish` WHERE `cat id` = 5
		// SQL query for all numerals sentences in english SELECT phrase FROM `phrase finnish` WHERE `cat id` = 6
		

		//$jsonstring = json_encode(''. $info2 . '');
		//echo $_GET['callback'] . '(' . "{'text' : $jsonstring}" . ')';

		//$jsonstring2 = json_encode(''. $language1 . '');
		//echo $_GET['callback'] . '(' . "{'text' : $jsonstring2}" . ')';

		$array_result = array_map('utf8_encode',$array_result);
		$json =  json_encode($array_result);
		echo $_GET['callback'] . '(' . $json . ')';

		//$jsonstring = json_encode(''. $array_result[1] . '');
		//echo $_GET['callback'] . '(' . "{'text' : $jsonstring}" . ')';
	}
	else
	{
		echo $_GET['callback'] . '(' . "{'text' : 'Failed to connect to MySQL!'}" . ')';
	}
?>