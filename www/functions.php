<?php



/*File configuration*/

error_reporting(0);

$PAGE_TITLE="Книжный магазин \"Буква-Книга\"";
$COPYRIGHT_STRING= "Книжный магазин \"Буква-Книга\". 2009 © Epazzz Software/HC.Design";



//Define file with configuration of project

define(CONF_FILE_NAME,"bkv.csv");

define(ERROR_LOG, "log.txt");

//Loggin on/off

define(LOG_ON, 1);

//First define this

define(MAX_LENGTH_STRING, 1000);

//Define thumbnails size
define(MAX_MID_SIZE, 200);
define(MAX_THUMB_SIZE, 64);

//Define types of log writes

define(LOG_ERROR, 	0);

define(LOG_WARING, 	1);

define(LOG_INFO, 	2);



//Define numbers of fields in file to load them

$CSV_NUM_CSV_FILE_NAME=				0;

$CSV_NUM_MAX_VIEW_COUNT_PAGES=		1;

$CSV_NUM_MAX_ON_PAGE=				2;

$CSV_NUM_MAX_LENGTH_STRING=			3;

$CSV_NUM_E_MAIL=					4;



//Open conf. file

$fd = fopen(CONF_FILE_NAME,"r");

if(!$fd){		

	WriteToLog("Can't open configuration file", LOG_ERROR);  	

	echo("Ошибка открытия файла");

}



//Configure fields:

//CSV_FILE_NAME;MAX_VIEW_COUNT_PAGES;MAX_ON_PAGE;MAX_LENGTH_STRING;E_MAIL;

$data = fgetcsv ($fd, MAX_LENGTH_STRING, ";");



//Load configuration

$CSV_FILE_NAME=$data[$CSV_NUM_CSV_FILE_NAME];

$MAX_VIEW_COUNT_PAGES=$data[$CSV_NUM_MAX_VIEW_COUNT_PAGES];

$MAX_ON_PAGE=$data[$CSV_NUM_MAX_ON_PAGE];

$MAX_LENGTH_STRING=$data[$CSV_NUM_MAX_LENGTH_STRING];

$E_MAIL=$data[$CSV_NUM_E_MAIL];



//Close conf. file

fclose ($fd);



//Define main constants

define(MAX_LENGTH_STRING,$MAX_LENGTH_STRING);

define(MAX_ON_PAGE,$MAX_ON_PAGE);

define(MAX_VIEW_COUNT_PAGES,$MAX_VIEW_COUNT_PAGES);

define(CSV_FILE_NAME,$CSV_FILE_NAME);

define(E_MAIL,$E_MAIL);



//Connect to database

$link = mysql_connect("78.108.81.243", "u36453", "th3book7^d");

mysql_select_db("b36453");



//Write to log

function WriteToLog($message, $type){

	

	//Write to log if it's need

	if(!LOG_ON) return;

	

	//Ger currnt date-time

	$today = getdate(); 

	$string .= $today['mday']."/".$today['mon']."/".$today['year'];

	$string .= " ".$today['hours'].":".$today['minutes'].":".$today['seconds'];

	

	//Write to file

	error_log ($type.";".$string.";".$message."\n", 3, ERROR_LOG);

}



//Debug possible errors

function SQLDebugInfo($sql, $result, $link){

	

	if(!$result){

		

		WriteToLog("Query: ".$sql."\nError: ".mysql_error($link), LOG_WARING);

		

		/*echo $sql;

		echo "<br>";

		echo "<b>".mysql_error($link)."</b>";

		echo "<br>";*/

	}

}



function AgjustDictionary($table_name, $item_name, $id_name){

	

	//Escape items

	$table_name=mysql_escape_string($table_name);

	$item_name=mysql_escape_string($item_name);

		

	//Make query

	$sql = "SELECT * FROM `".$table_name."` WHERE `name` = '".$item_name."';";

	//Run query

	$result = mysql_query($sql);

	SQLDebugInfo($sql, $result, $link);

	//Get result as array

	$list = mysql_fetch_array($result);

	

	//If result doesn't contents item

	if(mysql_affected_rows()==0){

		

		//Insert new item in dictionary

		$sql = "INSERT INTO `".$table_name."` (name) VALUES('".$item_name."');";

		//Run query

		$result = mysql_query($sql);

		SQLDebugInfo($sql, $result, $link);

		

		//Select new item to get id

		$sql = "SELECT * FROM `".$table_name."` WHERE `name` = '".$item_name."';";

		//Run query

		$result = mysql_query($sql);

		SQLDebugInfo($sql, $result, $link);

		//Get result as array

		$list = mysql_fetch_array($result);

	}

			

	//Get id of item

	$id=$list[$id_name];	

	return $id; 	

}

function ClearDatabase($link){
	
	echo "Iam here";
	
	//In first - clear database
	$sql ="DELETE FROM `Authors`;";
	//Run query
	$result = mysql_query($sql);
	//Debug possible errors
	SQLDebugInfo($sql, $result, $link);
	
	//In first - clear database
	$sql ="DELETE FROM `Publishers`;";
	//Run query
	$result = mysql_query($sql);
	//Debug possible errors
	SQLDebugInfo($sql, $result, $link);
	
	//In first - clear database
	$sql ="DELETE FROM `Genres`;";
	//Run query
	$result = mysql_query($sql);
	//Debug possible errors
	SQLDebugInfo($sql, $result, $link);
	
	//In first - clear database
	$sql ="DELETE FROM `Books`;";
	//Run query
	$result = mysql_query($sql);
	//Debug possible errors
	SQLDebugInfo($sql, $result, $link);
	
}



function LoadBase($link){

	

	



	

	$CSV_NUM_GENRE=			0;

	$CSV_NUM_NUMBER=		1;

	$CSV_NUM_AUTHOR=		2;

	$CSV_NUM_NAME=			3;

	$CSV_NUM_PUBLISER=		4;

	$CSV_NUM_YEAR=			5;

	$CSV_NUM_SHEETS=		6;

	$CSV_NUM_COVER=			7;

	$CSV_NUM_ISBN=			8;

	$CSV_NUM_WHOLEPRICE=	9;

	$CSV_NUM_REGDATE=		10;

	$CSV_NUM_DISCOUNT=		11;

	$CSV_NUM_RETAILPRICE=	13;

	$CSV_NUM_ISEXIST=		14;

	$CSV_NUM_NUMINSTORE=	15;

	$CSV_NUM_ISNEW=			21;
	
	

	//Open .csv file

	$fd = fopen(CSV_FILE_NAME,"r");

	

	$cover_true;

	$isexist_true;

	$i=0;

	

	//Skip fitst (titles) row

	$data = fgetcsv ($fd, MAX_LENGTH_STRING, ";");

	

	//Read file and trim that to lines

	while($data = fgetcsv ($fd, MAX_LENGTH_STRING, ";")){	

			

		//Set book attributes

		$table_name="Books";

		$name_book=$data[$CSV_NUM_NAME];

		$number_book=$data[$CSV_NUM_NUMBER];

		

		$name_book=mysql_escape_string($name_book);

		$number_book=mysql_escape_string($number_book);

		

		//Make query

		$sql = "SELECT * FROM `".$table_name."` WHERE `number_book` = '".$number_book."';";

		//Run query

		$result = mysql_query($sql);

		//Debug possible errors

		SQLDebugInfo($sql, $result, $link);	

		

		//If result doesn't content item

		if(mysql_affected_rows()==0){

						

			//Get result as array

			$list = mysql_fetch_array($result);

			

			//Adjust dictionaries

			$id_author=AgjustDictionary("Authors", $data[$CSV_NUM_AUTHOR], "id_author");

			$id_genre=AgjustDictionary("Genres", $data[$CSV_NUM_GENRE], "id_genre");

			$id_publisher=AgjustDictionary("Publishers", $data[$CSV_NUM_PUBLISER], "id_publisher");		

			

			//Get values from first string

			if($i==0){

				$cover_true = $data[$CSV_NUM_COVER]; // cover

				$isexist_true = $data[$CSV_NUM_ISEXIST]; // existing

				$i=1;

			}	

			

			

			//Set other book fields 

			$number_book=$data[$CSV_NUM_NUMBER];

			$year_book=$data[$CSV_NUM_YEAR];			

			$sheets_book=$data[$CSV_NUM_SHEETS];

			$iscover_book=$data[$CSV_NUM_COVER];		

			$isbn_book=$data[$CSV_NUM_ISBN];

			$wholeprice_book=$data[$CSV_NUM_WHOLEPRICE];

			

			//date dd.mm.yyyy -> yyyy.mm.dd

			$regdate_book=$data[$CSV_NUM_REGDATE];

			$trim_date=explode(".", $regdate_book);

			$regdate_book = $trim_date[2].".".$trim_date[1].".".$trim_date[0];

			

			$discount_book=$data[$CSV_NUM_DISCOUNT];

			$retailprice_book=$data[$CSV_NUM_RETAILPRICE];

			$isexist_book=$data[$CSV_NUM_ISEXIST];		

			$numinstore_book=$data[$CSV_NUM_NUMINSTORE];

			

			$isnew_book=$data[$CSV_NUM_ISNEW];

			

			//Values 

			$values="name_book,

			number_book,

			year_book,

			sheets_book,

			iscover_book,

			isbn_book,

			wholeprice_book,

			regdate_book,

			discount_book,

			retailprice_book,

			isexist_book,

			numinstore_book,

			isnew_book,

			id_author, 

			id_genre,

			id_publisher";

			

			//Value set

			$values_set="'".$name_book."',

			'".$number_book."',

			'".$year_book."',

			'".$sheets_book."',

			'".$iscover_book."',

			'".$isbn_book."',

			'".$wholeprice_book."',

			'".$regdate_book."',

			'".$discount_book."',

			'".$retailprice_book."',

			'".$isexist_book."',

			'".$numinstore_book."',

			'".$isnew_book."',

			'".$id_author."',

			'".$id_genre."',

			'".$id_publisher."'";

			

			

			//Insert new item in dictionary

			$sql = "INSERT INTO `".$table_name."` (".$values.") VALUES(".$values_set.");";

			//Run query

			$result = mysql_query($sql);

			//Debug possible errors

			SQLDebugInfo($sql, $result, $link);

		}

		else{WriteToLog("Duplicate in file, name of duplikate: ".$name_book, LOG_INFO);}

		

	}

	

}



function FillDropdownList($table_name){



	//Make query

	$sql = "SELECT * FROM `".$table_name."`;";

	//Run query

	$result = mysql_query($sql);

	

	$affected_rows = mysql_affected_rows();

	

	if($affected_rows!=0){

		

		for($i=0; $i<$affected_rows; $i++){

			

			$row = mysql_fetch_array($result);

			

			echo "<option value='".$row['id_genre']."'>".$row['name']."</option>\n";

			

		}

	}

	

	else{

		

		echo "";

		

	}

	

}



function FillGList($table_name){



	//Make query

	$sql = "SELECT * FROM `".$table_name."`;";

	//Run query

	$result = mysql_query($sql);

	

	$genres="";

	

	$affected_rows = mysql_affected_rows();

	

	global $genre;

	

	if($genre!=$row['id_genre']){

			

				$genres .= "<div class=\"genre-item\"><a href=index.php?genre=>Все жанры</a></div>";

			

			}else{

				

				$genres .= "<div class=\"genre-item-selected\"><a href=index.php?genre=>Все жанры</a></div>";

			}

	

	if($affected_rows!=0){

		

		for($i=0; $i<$affected_rows; $i++){

			

			$row = mysql_fetch_array($result);

			

			//echo "<option value='".$row['id_genre']."'>".$row['name']."</option>\n";

			

			if($genre!=$row['id_genre']){

			

				$genres .= "<div class=\"genre-item\"><a href=index.php?genre=".$row['id_genre'].">".$row['name']."</a></div>";

			

			}else{

				

				$genres .= "<div class=\"genre-item-selected\"><a href=index.php?genre=".$row['id_genre'].">".$row['name']."</a></div>";

			}

			

		}

	}

	

	else{

		

		$genres = "";

		

	}

	

	return $genres;

	

}



function FillList($sql){



	

	//Run query

	$result = mysql_query($sql);	

	$affected_rows = mysql_affected_rows();

	

	if($affected_rows!=0){

				

		for($i=0; $i<$affected_rows; $i++){

			

			$row = mysql_fetch_array($result);

			

			//Books
			
			if(isSet($_SESSION['login'])){
		
				$EDIT_TOOLS="Добавить/изменить обложку";
			}

			$AUTHOR_BOOK=GetName("Authors", $row['id_author'], "id_author");

			$AUTHOR_BOOK_LINK="index.php?author=".$row['id_author'];

			$NAME_BOOK=$row['name_book'];

			$ISBN_BOOK=$row['isbn_book'];

			$PUBLISHER_BOOK=GetName("Publishers", $row['id_publisher'], "id_publisher");

			$PUBLISHER_BOOK_LINK="index.php?publisher=".$row['id_publisher'];

			$BOOK_PAGES=$row['sheets_book'];
			
			

			

			if(strcmp($row['iscover_book'], "обл")==0) $BOOK_COVER="обложка";

			else if(strcmp($row['iscover_book'], "пер")==0) $BOOK_COVER="переплет";

			else $BOOK_COVER="";

			

			

			$PRICE_BOOK=$row['retailprice_book'];

			$YEAR_BOOK=$row['year_book'];

			$YEAR_BOOK_LINK="index.php?year=".$row['year_book'];

			

			$NUMBER_BOOK=$row['number_book'];
			
			global $ORDER_BOOL;
			$image_path;
			
			$ORDER_BOOL ? $image_path="covers/mid/mid".$NUMBER_BOOK.".png" : $image_path="covers/thumb/thumb".$NUMBER_BOOK.".png";
							
			file_exists($image_path) ? $IMAGE_COVER=$image_path : $IMAGE_COVER="";			

			if(strcmp($row['isnew_book'], "1")==0) $ISNEW_BOOK="Новинка";

			

			if(strcmp($row['isexist_book'], "есть")==0) $LINK_BOOK="order.php?book=".$row['id_book'];

			

			include "templates/book.tpl";

					

		}

	}

	

	else{

		

		echo "";

		

	}

	

	

}



function GetName($table_name, $item_name, $id_name){

	

	//Make query

	$sql = "SELECT name FROM `".$table_name."` WHERE `".$id_name."` = '".$item_name."';";

	//Run query

	$result = mysql_query($sql);

	SQLDebugInfo($sql, $result, $link);

	//Get result as array

	$list = mysql_fetch_array($result);

	

	//If result doesn't content item

	if(mysql_affected_rows()==0){

		

		$name = "No name with this id";		

	}

			

	//Get id of item

	$name=$list['name'];	

	return $name; 	



}



function GetNumRows($table_name, $condition){

	

	//Make query

	if(strcmp($condition, "*")==0) $sql = "SELECT * FROM ".$table_name.";";

	else $sql = "SELECT * FROM `".$table_name."` WHERE ".$condition.";";

	

	//Run query

	$result = mysql_query($sql);

	SQLDebugInfo($sql, $result, $link);

	//Get result as array

	return mysql_affected_rows(); 

}


function MakeThumnails($full_image_path, $thumb_image_path, $max_size){
	
	//Create image from uploaded file
	$image=imagecreatefromjpeg($full_image_path);
	//Get image size
	$image_width = imagesx($image) ;
	$image_height = imagesy($image) ;
		
	//задано ограничение на высоту и ширину:
	if ($max_size) {
		
			$thumb_width = $max_size;
			$thumb_height = round($max_size * $image_height / $image_width);		
	}
		
	$thumb = imagecreatetruecolor($thumb_width, $thumb_height);
	imagealphablending($thumb, false);
	imagesavealpha($thumb, true);	
	imagecopyresampled($thumb, $image, 0, 0, 0, 0, $thumb_width, $thumb_height, $image_width, $image_height);	
	imagepng($thumb, $thumb_image_path);
	
}


function GetStirngNumPages($page, $num_pages, $search, $author, $publisher, $year, $genre){

	

	//In loop for pages

	for($i=$page;$i>=0;$i--){

	

		if($i!=$page){

			

			$string_num_pages_prev = $string_num_pages;

			$string_num_pages = "<a href='".$URL_INDEX."?page=".($i);

			if($search!="") $string_num_pages .= "&search=".$search;

			if($author!="") $string_num_pages .= "&author=".$author;

			if($publisher!="") $string_num_pages .= "&publisher=".$publisher;

			if($genre!="") $string_num_pages .= "&genre=".$genre;

			if($year!="") $string_num_pages .= "&year=".$year;

			$string_num_pages .="'>".($i+1)."</a>".".".$string_num_pages_prev;

		

		}else{

			

			//Don't wrte current page this (It's in next for-cycle)			

			continue;		

		}

					

		if($i==$page-MAX_VIEW_COUNT_PAGES) {

						

			//Edge condition

			if($page==MAX_VIEW_COUNT_PAGES) {

				break;

			}

			

			//...

			if($page==MAX_VIEW_COUNT_PAGES+1) $string_num_pages .= "";

			else $string_num_pages = "..".$string_num_pages;

			

			$i = 1;

		}

	

	}

	for($i=$page;$i<$num_pages;$i++){

	

		if($i!=$page){

			

		$string_num_pages .= "<a href='".$URL_INDEX."?page=".($i);

		if($search!="") $string_num_pages .= "&search=".$search;

		if($author!="") $string_num_pages .= "&author=".$author;

		if($publisher!="") $string_num_pages .= "&publisher=".$publisher;

		if($genre!="") $string_num_pages .= "&genre=".$genre;

		if($year!="") $string_num_pages .= "&year=".$year;

		$string_num_pages .= "'>".($i+1)."</a>";

		

		}else{

		

		//Write current page number without link

		$string_num_pages .= "<span class='activPageNumber'>";

		$string_num_pages .= ($i+1)."</span>";

		

		}

		

		if($i+1!=$num_pages) $string_num_pages .= ".";

			

		if($i==$page+MAX_VIEW_COUNT_PAGES) {

			

			//Edge condition

			if($i==$num_pages-1) {

				break;

			}

			

			//...

			if($i==$num_pages-(MAX_VIEW_COUNT_PAGES-1)) $string_num_pages .= "";

			else $string_num_pages .= "..";

			$i = $num_pages-2;

		}

	

	}

		

	return $string_num_pages;

}



?>



<?php



function OutListBySql($sql){

	

	?>

	

	  <table width="461" border="0" cellspacing="2">

		<tr>

		  <td id="name"><h1>Автор и название книги</h1></td>

		  <td id="year"><h1>Год</h1></td>

		  <td id="price"><h1>Цена</h1></td>

		</tr>

		

	

	<?php

	

	//Run query

	$result = mysql_query($sql);

	$affected_rows = mysql_affected_rows();

	

	

	

	//In loop fill the filds of post

	for($i=0; $i<$affected_rows; $i++){

		

	$row = mysql_fetch_array($result);

	

	?>

		<tr>

		  <td id="name"><a href="index.php?author= <?php echo $row['id_author']; ?> "><strong><?php echo GetName("Authors", $row['id_author'], "id_author")."</a><br>".$row['name_book'];?></strong></td>

		  <td id="year"><a href="index.php?year=<?php echo $row['year_book']; ?>"><?php echo $row['year_book'] ?></a></td>

		  <td id="price"><?php echo $row['retailprice_book'] ?> руб.</td>

		</tr>

		<tr>

		  <td id="other">ISBN:<?php echo $row['isbn_book'] ?><br>

		  Издательство: <a href="index.php?publisher=<?php echo $row['id_publisher']; ?>"><?php echo GetName("Publishers", $row['id_publisher'], "id_publisher") ?></a><br>

		  Страниц: <?php echo $row['sheets_book'] ?><br>

		  Обложка: <?php echo $row['iscover_book'] ?></td>

          <td colspan="2" id="other"><div align="left"><a onMouseOver="tobook_<?php echo $row['id_book'] ?>.src='images/order_on.gif'" onMouseOut="tobook_<?php echo $row['id_book'] ?>.src='images/order_off.gif'" href="book.php?book=<?php echo $row['id_book'] ?>"><img name="tobook_<?php echo $row['id_book'] ?>" border="0" src="images/order_off.gif" alt="Order" /></a></div></td>

		</tr>

		

		<tr>

		  <td colspan="3" id="other"><hr><br></td>

		</tr>

	  

	<?php 

	} 

}



?>

