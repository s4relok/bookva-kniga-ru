<?php

session_start(); //Start use cookies

include "functions.php"; //All PHP functions





$CURRENT_TAB_MENU_IMAGE_PATH="images/Menu_Katalog_new.gif";

$URL_INDEX="index.php";

$GENRES_LIST="<div class='guide'><h3>����������</h3><p>��� ���� �����, �� �������� �����, ������� �� �������, ��������� �����.</p>

<p>�� ���������� ��� ��� ������ �����������.</p>

<p>������� �� ��������������.</p></div>";

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
		$MESSAGE_INFO.= "�������� ����� ��� ������";

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
		 echo ("������ ����� ��������� ��� ���������");
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
		echo 'window.parent.document.getElementById("res").innerHTML="���� ������� ��������";';	
		echo '</script>';
	
	
		 /*echo("���� ������� �������� <br>");
		 echo("�������������� �����: <br>");
		 echo("��� �����: ");
		 echo($_FILES["filename"]["name"]);
		 echo("<br>������ �����: ");
		 echo($_FILES["filename"]["size"]);
		 echo("<br>������� ��� ��������: ");
		 echo($_FILES["filename"]["tmp_name"]);
		 echo("<br>��� �����: ");
		 echo($_FILES["filename"]["type"]);*/
	   } else {
		 //echo("������ �������� �����");
		 echo '<script type="text/javascript">';
		 echo 'window.parent.document.getElementById("loading").style.display="none";';
		 echo 'window.parent.document.getElementById("res").style.display="block";';
		 echo 'window.parent.document.getElementById("res").innerHTML="������ ��� �������� �����";';
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
	
	
	
		$MESSAGE_INFO= "<p>��������� ���������.</p> �� ������ <a href=".$URL_INDEX.">��������� � ������� </a> ��� <a href='admin.php?action=logoff'>�����</a><br><a href='admin.php'>��������� � �����������������</a>";
	
		
	
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