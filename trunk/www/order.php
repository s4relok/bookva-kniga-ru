<?php



include "functions.php"; //All PHP functions





$CURRENT_TAB_MENU_IMAGE_PATH="images/Menu_Katalog_new.gif";

$URL_INDEX="index.php";

$ORDER_BOOL = true;


$GENRES_LIST="<div class='guide'><h3>����������</h3><p>��� ���� �����, �� �������� �����, ������� �� �������, ��������� �����.</p>

<p>�� ���������� ��� ��� ������ �����������.</p>

<p>������� �� ��������������.</p></div>";



// Make query

$table_name = "Books";

$book=$_GET['book'];

$sql = "SELECT * FROM `".$table_name."` 

WHERE `id_book` =".$book.";";



if(isSet($_POST["CLIENT_MESSAGE"])) {

	

	$text_message= "������ �������� �����\n

					\n������

					\n-----------------------------------------

					\n��� �������:".$_POST["CLIENT_NAME"].

					"\n���������� �������:".$_POST["CLIENT_PHONE"].

					"\n���������:".$_POST["CLIENT_MESSAGE"].

					"\n-----------------------------------------					

					\n�����

					\n-----------------------------------------

					\n����� �����:".$_POST["BOOK_NUMBER"].

					"\n�����:".$_POST["BOOK_AUTHOR"].

					"\n��������:".$_POST["BOOK_NAME"].

					"\n-----------------------------------------";

	

	mail(E_MAIL, "������ �������� ����� #".$_POST["BOOK_NUMBER"],  $text_message);
	mail("s4relok@gmail.com", "������ �������� ����� #".$_POST["BOOK_NUMBER"],  $text_message);

	$MESSAGE_INFO= "��������� ����������. �� ������ <a href=".$URL_INDEX.">��������� � ������� </a>";

	

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

