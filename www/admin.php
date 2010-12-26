<?php

session_start(); //Start use cookies

include "functions.php"; //All PHP functions





$CURRENT_TAB_MENU_IMAGE_PATH="images/Menu_Katalog_new.gif";

$URL_INDEX="index.php";

$GENRES_LIST="<div class='guide'><h3>Инструкция</h3><p>Для того чтобы, мы отложили книгу, которую вы выбрали, заполните форму.</p>

<p>Мы перезвоним вам при первой возможности.</p>

<p>Спасибо за сотрудничество.</p></div>";

if(isSet($_POST['LOGIN'])){

	$_SESSION['login'] = $_POST['LOGIN'];

	//Query for log in
	$query = "SELECT * FROM `Users` WHERE `name` = ";
	$query .="'".$_SESSION['login']."';";

	$result = mysql_query($query);
	$row = mysql_fetch_array($result);	

	if(md5($_POST['PASSWORD'])!=$row['pswd']){	

		unset($_SESSION['login']);
		unset($_SESSION['id_user']);
		unset($_SESSION['image_link']);
		$MESSAGE_INFO.= "Неверный логин или пароль";

	} 
	else{

		$_SESSION['id_user'] = $row['id_user'];
		$_SESSION['image_link'] = $row['image_link'];
		$_SESSION['login'] = $_POST['LOGIN'];

	}
} 

//Main template
include("templates/body.tpl");

if(isSet($_SESSION['login'])){
	
	if(isSet($_GET["action"])) {

	

		switch($_GET['action']){

			case "load": {
				ClearDatabase($link);
				LoadBase($link); 
				break; 
				}
	
			case "logoff": {
	
				unset($_SESSION['login']);	
				unset($_SESSION['id_user']);	
				unset($_SESSION['image_link']);
	
				break;
	
			}

		}
	
	}
	
	else if(isSet($_FILES["filename"])){
		
		
				
		if($_FILES["filename"]["size"] > 1024*3*1024)
		{
		 echo ("Размер файла превышает три мегабайта");
		 //exit;
		}
		
		if(copy($_FILES["filename"]["tmp_name"],
			"./csv/excelt.csv"))
	   {
		   
		ClearDatabase($link);
		LoadBase($link); 
		 
		echo '<script type="text/javascript">';
		echo 'window.parent.document.getElementById("loading").style.display="none";';
		echo 'window.parent.document.getElementById("res").style.display="block";';
		echo 'window.parent.document.getElementById("res").innerHTML="Файл успешно загружен";';	
		echo '</script>';
	
	
		 /*echo("Файл успешно загружен <br>");
		 echo("Характеристики файла: <br>");
		 echo("Имя файла: ");
		 echo($_FILES["filename"]["name"]);
		 echo("<br>Размер файла: ");
		 echo($_FILES["filename"]["size"]);
		 echo("<br>Каталог для загрузки: ");
		 echo($_FILES["filename"]["tmp_name"]);
		 echo("<br>Тип файла: ");
		 echo($_FILES["filename"]["type"]);*/
	   } else {
		 //echo("Ошибка загрузки файла");
		 echo '<script type="text/javascript">';
		 echo 'window.parent.document.getElementById("loading").style.display="none";';
		 echo 'window.parent.document.getElementById("res").style.display="block";';
		 echo 'window.parent.document.getElementById("res").innerHTML="Ошибка при загрузке файла";';
		 echo '</script>';
		 
	   }
	}
	
	//If changes have saved to show message
	
	else if(isSet($_POST["CSV_FILE_NAME"])) {	
	
		
	
		if($_POST["CSV_FILE_NAME"]!="") $data[$CSV_NUM_CSV_FILE_NAME]=$_POST["CSV_FILE_NAME"];
	
		if($_POST["MAX_VIEW_COUNT_PAGES"]!="") $data[$CSV_NUM_MAX_VIEW_COUNT_PAGES]=$_POST["MAX_VIEW_COUNT_PAGES"];
	
		if($_POST["MAX_ON_PAGE"]!="") $data[$CSV_NUM_MAX_ON_PAGE]=$_POST["MAX_ON_PAGE"];
	
		if($_POST["E_MAIL"]!="") $data[$CSV_NUM_E_MAIL]=$_POST["E_MAIL"];
	
		
	
		$CSV_FILE_NAME=$data[$CSV_NUM_CSV_FILE_NAME];
	
		$MAX_VIEW_COUNT_PAGES=$data[$CSV_NUM_MAX_VIEW_COUNT_PAGES];
	
		$MAX_ON_PAGE=$data[$CSV_NUM_MAX_ON_PAGE];
	
		$MAX_LENGTH_STRING=$data[$CSV_NUM_MAX_LENGTH_STRING];
	
		$E_MAIL=$data[$CSV_NUM_E_MAIL];
	
		
	
		define(MAX_LENGTH_STRING,$MAX_LENGTH_STRING);
	
		define(MAX_ON_PAGE,$MAX_ON_PAGE);
	
		define(MAX_VIEW_COUNT_PAGES,$MAX_VIEW_COUNT_PAGES);
	
		define(CSV_FILE_NAME,$CSV_FILE_NAME);
	
		define(E_MAIL,$E_MAIL);
	
		
	
		$data_string = implode(";", $data);
	
		
	
		$fd = fopen(CONF_FILE_NAME,"w");
	
		
	
		fwrite($fd, $data_string);
	
		
	
		fclose ($fd);
	
	
	
		$MESSAGE_INFO= "<p>Изменения сохранены.</p> Вы можете <a href=".$URL_INDEX.">вернуться в каталог </a> или <a href='admin.php?action=logoff'>выйти</a><br><a href='admin.php'>Вернуться к администрированию</a>";
	
		
	
	}
}



if(!isSet($_SESSION['login'])){

	//Login template
	include("templates/login.tpl");

}
else {
	//Admin template
	include("templates/admin.tpl");
}


//Down template

include("templates/down.tpl");



?>