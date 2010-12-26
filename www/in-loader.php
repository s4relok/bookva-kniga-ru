<?php

include "functions.php"; //All PHP functions

if(isSet($_FILES["filename"])){	

	$full_image_path="./covers/full/".$_POST["numberbook"].".jpg";
	$mid_image_path="./covers/mid/mid".$_POST["numberbook"].".png";
	$thumb_image_path="./covers/thumb/thumb".$_POST["numberbook"].".png";
			
	if($_FILES["filename"]["size"] > 1024*3*1024)
   	{
     echo ("Размер файла превышает три мегабайта");
     //exit;
   	}
	
   	if(copy($_FILES["filename"]["tmp_name"], $full_image_path))
   {
	   //Make middle copy
	   MakeThumnails($full_image_path, $mid_image_path, MAX_MID_SIZE);
	   //Make mini copy
	   MakeThumnails($full_image_path, $thumb_image_path, MAX_THUMB_SIZE);
	   
	   unlink($full_image_path);
	   	   	 
	echo '<script type="text/javascript">';
	echo 'window.parent.document.getElementById("res").style.display="block";';
	echo 'window.parent.document.getElementById("res").innerHTML="Файл успешно загружен";';
	
	echo 'window.parent.document.getElementById("loading';
	echo $_POST["numberbook"];
	echo '").style.display="none";';
	
	
	//delete($full_image_path);
	
	
	/*echo 'window.parent.document.getElementById("cover';
	echo $_POST["numberbook"];
	echo '").innerHTML="<img src="';
	echo "covers/thumb/thumb";
	echo $_POST["numberbook"];
	echo ".png";
	echo '"/>";';*/
		
	
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
	 echo 'window.parent.document.getElementById("loading'.$_POST["numberbook"].'").style.display="none";';
	 echo 'window.parent.document.getElementById("res").style.display="block";';
	 echo 'window.parent.document.getElementById("res").innerHTML="Ошибка при загрузке файла";';
	 echo '</script>';
	 
   }
}

/*if($_FILES["filename"]["size"] > 1024*3*1024)
   	{
     echo ("Размер файла превышает три мегабайта");
     //exit;
   	}
	
   	if(copy($_FILES["filename"]["tmp_name"],
		"./tmp/".$_FILES["filename"]["name"]))
   {
     echo("Файл успешно загружен <br>");
     echo("Характеристики файла: <br>");
     echo("Имя файла: ");
     echo($_FILES["filename"]["name"]);
     echo("<br>Размер файла: ");
     echo($_FILES["filename"]["size"]);
     echo("<br>Каталог для загрузки: ");
     echo($_FILES["filename"]["tmp_name"]);
     echo("<br>Тип файла: ");
     echo($_FILES["filename"]["type"]);
   } else {
     echo("Ошибка загрузки файла");
	 
   }*/


/*header('Content-Type: text/html; charset=windows-1251');




$table_name = "Books";



$search  = $_GET['search'];



//Make query	

$sql = "SELECT * FROM `".$table_name."` WHERE (name_book LIKE '%". str_replace(" ", "%' AND name_book LIKE '%", $search). "%')";



$sql.=" LIMIT ".MAX_ON_PAGE.";";



FillList($sql);*/

				

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
