<?php

header('Content-Type: text/html; charset=windows-1251');

include "functions.php"; //All PHP functions

$table_name = "Books";

$search  = $_GET['search'];

//Make query	
$sql = "SELECT * FROM `".$table_name."` WHERE (name_book LIKE '%". str_replace(" ", "%' AND name_book LIKE '%", $search). "%')";

$sql.=" LIMIT ".MAX_ON_PAGE.";";

FillList($sql);
				
//Run query
/*$result = mysql_query($sql);	
$affected_rows = mysql_affected_rows();



if($affected_rows!=0){	
				
		for($i=0; $i<$affected_rows; $i++){
			
			$row = mysql_fetch_array($result);
			
			echo $row['name_book']."<br/>";
			
		}
		
}
			

/*$getName = mysql_query($getTask_sql);
$total =  mysql_num_rows(getTask);



while ($row = mysql_fetch_array($getName)) {
echo $row.name_book . '<br/>';
}*/
?>

