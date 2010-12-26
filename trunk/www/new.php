<?php



include "functions.php"; //All PHP functions





$CURRENT_TAB_MENU_IMAGE_PATH="images/Menu_new_new.gif";

$URL_INDEX="new.php";

//If there is no page variable in GET group set that one in zero

if(isSet($_GET['page'])) $page = $_GET['page'];

else $page = 0;



//Make query

$table_name = "Books";

$sql = "SELECT * FROM `".$table_name."` WHERE `isnew_book` = '1' ORDER BY `isexist_book` DESC LIMIT ".($page*MAX_ON_PAGE).",".MAX_ON_PAGE.";";



//Paging

$num_rows = GetNumRows($table_name, "`isnew_book` = '1'");

//Calculate number of pages

$num_pages = (int)($num_rows/MAX_ON_PAGE);



//Plus one if last page is exist

if((($num_pages*MAX_ON_PAGE)!=$num_rows)&&($num_pages!=0)){

	$num_pages=$num_pages+1;

}



if($num_pages>1) $PAGES_STRING=GetStirngNumPages($page, $num_pages, $search, $author, $publisher, $year, $genre);


$GENRES_LIST="<div class='guide'><h3>Наши новинки</h3><p>Для Вашего удобства ноые книги в нашем каталоге собраны здесь.</p>

</div>";



include("templates/body.tpl");



FillList($sql);



include("templates/down.tpl");



?>

