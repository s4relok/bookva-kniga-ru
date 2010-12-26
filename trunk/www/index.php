<?php

session_start(); //Start use cookies

include "functions.php"; //All PHP functions


$ADVERT="<script type='text/javascript'>
var begun_auto_pad = 120846269;
var begun_block_id = 126252232;
</script>
<script src='http://autocontext.begun.ru/autocontext2.js' type='text/javascript'></script>";



$CURRENT_TAB_MENU_IMAGE_PATH="images/Menu_Katalog_new.gif";

$URL_INDEX="index.php";

$GENRE = $_GET['genre'];



$table_name = "Books";



//If there is no page variable in GET group set that one in zero

if(isSet($_GET['page'])) $page = $_GET['page'];

else $page = 0;



//Set null search string

$search = "";

//If user authorized
if(isSet($_SESSION['login'])){	
	
	//Set logoff message
	$MESSAGE_LOGOFF="Доброе время суток,".$_SESSION['login'].".[<a href='admin.php?action=logoff'>Выйти</a>]";
	
}



/*if(isSet($_GET['action'])){



	switch($_GET['action']){

		

		case "search": 	

	

			//if(isSet($_POST['search'])) $search=$_POST['search'];

			if(isSet($_GET['search'])) $search=$_GET['search'];

			

			//mysql search php web

			$search = substr($search, 0, 64);

			//Erase abnormal symbols

			$search = preg_replace("/[^\w\x7F-\xFF\s]/", " ", $search);

			//Compress double spaces

			//$search = preg_replace(" +", " ", $search);

			

			//Make query

			$sql = "SELECT * FROM `".$table_name."` 

			WHERE name_book LIKE '%".$search."%' 

			LIMIT ".($page*MAX_ON_PAGE).",".MAX_ON_PAGE.";";

			

			//Paging

			$num_rows = GetNumRows($table_name, "name_book LIKE '%".$search."%'");

			

			break;

	}

}*/



if(isSet($_GET['author'])){

	

	//if(isSet($_POST['search'])) $search=$_POST['search'];

	$author=$_GET['author'];

		

	//Make query

	$sql = "SELECT * FROM `".$table_name."` 

	WHERE id_author = '".$author."'
	ORDER BY `isexist_book` DESC

	LIMIT ".($page*MAX_ON_PAGE).",".MAX_ON_PAGE.";";

	

	//Paging

	$num_rows = GetNumRows($table_name, "id_author = '".$author."'");

}



else if(isSet($_GET['year'])){

	

	//if(isSet($_POST['search'])) $search=$_POST['search'];

	$year=$_GET['year'];

	

	$year=mysql_escape_string($_GET['year']);

		

	//Make query

	$sql = "SELECT * FROM `".$table_name."` 

	WHERE year_book = '".$year."'
	ORDER BY `isexist_book` DESC

	LIMIT ".($page*MAX_ON_PAGE).",".MAX_ON_PAGE.";";

	

	//Paging

	$num_rows = GetNumRows($table_name, "year_book = '".$year."'");

}



else if(isSet($_GET['publisher'])){

		

	//if(isSet($_POST['search'])) $search=$_POST['search'];

	$publisher=$_GET['publisher'];

	

	$publisher=mysql_escape_string($_GET['publisher']);

		

	//Make query

	$sql = "SELECT * FROM `".$table_name."` 

	WHERE id_publisher = '".$publisher."'
	ORDER BY `isexist_book` DESC

	LIMIT ".($page*MAX_ON_PAGE).",".MAX_ON_PAGE.";";

	

	//Paging

	$num_rows = GetNumRows($table_name, "id_publisher = '".$publisher."'");

}



else if(isSet($_GET['search'])){

	

	//if(isSet($_POST['search'])) $search=$_POST['search'];

	if(isSet($_GET['search'])) $search=$_GET['search'];

	

	if(isSet($_GET['genre'])) {

		if($_GET['genre']!="")	$genre=$_GET['genre'];

	}

	

	//mysql search php web

	$search = substr($search, 0, 64);

	

	$search=mysql_escape_string($search);

		

	$search_array=explode(" ",$search, 64); 

		

	//Make query	

	$sql = "SELECT * FROM `".$table_name."` 
	WHERE (name_book LIKE '%". str_replace(" ", "%' AND name_book LIKE '%", $search). "%')";

	

	if($genre!=""){

		

		$sql.="AND `id_genre`=".$_GET['genre'];

	

	//Paging

		$num_rows = GetNumRows($table_name, "name_book LIKE '%". str_replace(" ", "%' AND name_book LIKE '%", $search). "%'"." AND `id_genre`=".$_GET['genre']);

			 }

	else {

		$num_rows = GetNumRows($table_name, "name_book LIKE '%". str_replace(" ", "%' AND name_book LIKE '%", $search). "%'");

	}

				

	$sql.=" ORDER BY `isexist_book` DESC LIMIT ".($page*MAX_ON_PAGE).",".MAX_ON_PAGE.";";
		

}



else if(isSet($_GET['genre'])){

		

	if($_GET['genre']!='') {

		

		$genre=$_GET['genre'];

		

		$genre=mysql_escape_string($genre);

		

		//Make query

		$sql = "SELECT * FROM `".$table_name."` 

		WHERE id_genre = '".$genre."' 
		ORDER BY `isexist_book` DESC

		LIMIT ".($page*MAX_ON_PAGE).",".MAX_ON_PAGE.";";

		

		//Paging

		$num_rows = GetNumRows($table_name, "id_genre = '".$genre."'");

	

	}

	

	else {

		

		

	

		$sql = "SELECT * FROM `".$table_name."` 
		ORDER BY `isexist_book` DESC

		LIMIT ".($page*MAX_ON_PAGE).",".MAX_ON_PAGE.";";

		

		//Paging

		$num_rows = GetNumRows($table_name, "*");	

	}

	

	

}



else{

	

	//Make query

	$sql = "SELECT * FROM `".$table_name."` ORDER BY `isexist_book` DESC LIMIT ".($page*MAX_ON_PAGE).",".MAX_ON_PAGE.";";

	

	//Paging

	$num_rows = GetNumRows($table_name, "*");

}



//Calculate number of pages

$num_pages = (int)($num_rows/MAX_ON_PAGE);



//Plus one if last page is exist

if((($num_pages*MAX_ON_PAGE)!=$num_rows)&&($num_pages!=0)){

	$num_pages=$num_pages+1;

}



if($num_pages>1) $PAGES_STRING=GetStirngNumPages($page, $num_pages, $search, $author, $publisher, $year, $genre);







//If it is search show search-query

if($search!=""){	

	$MESSAGE_INFO= "Результаты поиска по запросу '".$search."' ";

	if($genre!="") $MESSAGE_INFO.= "в разделе '".GetName("Genres", $genre, "id_genre")."'. ";

	//if(isSet($_GET['year'])) $MESSAGE_INFO.="[Год ".$_GET['year']."]"; 

	$MESSAGE_INFO.="Всего: ".$num_rows;

}

else if($year!="")	$MESSAGE_INFO= "Книги, выпущенные в ".$year." году";

else if($publisher!="")	$MESSAGE_INFO= "Книги издательства ".GetName("Publishers", $publisher, "id_publisher");

else if($author!="")	$MESSAGE_INFO= "Книги автора '".GetName("Authors", $author, "id_author")."'";



$GENRES_LIST=FillGList("Genres");



include("templates/body.tpl");



FillList($sql);



include("templates/down.tpl");



?>

