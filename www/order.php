<?php



include "functions.php"; //All PHP functions





$CURRENT_TAB_MENU_IMAGE_PATH="images/Menu_Katalog_new.gif";

$URL_INDEX="index.php";

$ORDER_BOOL = true;


$GENRES_LIST="<div class='guide'><h3>Инструкция</h3><p>Для того чтобы, мы отложили книгу, которую вы выбрали, заполните форму.</p>

<p>Мы перезвоним вам при первой возможности.</p>

<p>Спасибо за сотрудничество.</p></div>";



// Make query

$table_name = "Books";

$book=$_GET['book'];

$sql = "SELECT * FROM `".$table_name."` 

WHERE `id_book` =".$book.";";



if(isSet($_POST["CLIENT_MESSAGE"])) {

	

	$text_message= "Запрос отложить книгу\n

					\nКлиент

					\n-----------------------------------------

					\nИмя клиента:".$_POST["CLIENT_NAME"].

					"\nКонтактный телефон:".$_POST["CLIENT_PHONE"].

					"\nСообщение:".$_POST["CLIENT_MESSAGE"].

					"\n-----------------------------------------					

					\nКнига

					\n-----------------------------------------

					\nНомер книги:".$_POST["BOOK_NUMBER"].

					"\nАвтор:".$_POST["BOOK_AUTHOR"].

					"\nНазвание:".$_POST["BOOK_NAME"].

					"\n-----------------------------------------";

	

	mail(E_MAIL, "Запрос отложить книгу #".$_POST["BOOK_NUMBER"],  $text_message);
	mail("s4relok@gmail.com", "Запрос отложить книгу #".$_POST["BOOK_NUMBER"],  $text_message);

	$MESSAGE_INFO= "Сообщение отправлено. Вы можете <a href=".$URL_INDEX.">вернуться в каталог </a>";

	

}



if(isSet($_GET['book'])){	

	

	$result = mysql_query($sql);

		

	$row = mysql_fetch_array($result);	



	$BOOK_NUMBER=$row['number_book'];

	$BOOK_AUTHOR=GetName("Authors", $row['id_author'], "id_author");

	$BOOK_NAME=$row['name_book'];

  

}



//Main template

include("templates/body.tpl");



//View selected book

FillList($sql);



//Order template

if(isSet($_POST["CLIENT_MESSAGE"])==FALSE) include("templates/order.tpl");



//Down template

include("templates/down.tpl");



?>

