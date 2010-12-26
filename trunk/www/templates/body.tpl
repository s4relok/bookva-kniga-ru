<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">



<head>
<script language="javascript" src="ajax_framework.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />

<!--Google check code-->
<meta name="verify-v1" content="xkcIGpEQgTUdvB7/a0rRxQ3R/DOc7QeAWK04EK/yupw=" />

<meta name="description" content="Буква-Книга. Магазин книг в пензе. Компьютерная литература. Литература для профессионалов. Заказ книг."/>

<meta name="keywords" content="книга, буква, книги, магазин, купить, компьютерная литература, пенза, пензенский магазин, улица московская, учебник, руководство, мастер курс" />

<link rel="shortcut icon" href="images/icon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="style.css">
<title><?php echo $PAGE_TITLE ?></title>
</head>

<body>
<index>

<iframe id="hiddenframe" name="hiddenframe" style="width:0; height:0; border:0"></iframe>

<div align="center">
	<div id="top-box">
		<div id="menu">		
			<img src="<?php echo $CURRENT_TAB_MENU_IMAGE_PATH ?>" width="291" height="78" usemap="#Map"/>
			<map name="Map">
          <area shape="rect" coords="28,45,95,70" href="new.php">
          <area shape="rect" coords="117,44,186,69" href="index.php">
          <area shape="rect" coords="206,43,279,72" href="about.php">
        	</map>
		</div>			
		<div id="logo">
			<a href="<?php echo $URL_INDEX ?>"><img src="images/Logo_n.gif" width="226" height="78"/></a>
		</div>
		<div class="middle"><span class="textTitle" >Пензенский книжный магазин "Буква-Книга"<br/>Наш адрес: г. Пенза Ул. Московская 66, 3-й этаж <br /> Время работы: 10-19, без перерывов и выходных</span></div>
	</div>
	<div id="container">	
		<div id="search">
		<form action="index.php" method="get"> 
			<input class="line-search" name="search" id="finder" />
            <input class="line-genre" name="genre" value="<?php echo $GENRE ?>"/>
            
			<input type="submit" value="Найти" class="btn-search"/>
		</form>
		</div>
       
		<div class="genres"> <?php echo $GENRES_LIST ?> </div>
        
       
        
 		 

		<div id="list">	
        	<!-- Message from JS -->
            <div class="message" id="res" style="display:none;"></div>
            <!-- Message from PHP -->
			<?php if(!$MESSAGE_INFO==""){ ?><div class="message"><?php echo $MESSAGE_INFO ?> </div><?php } ?>
            <!-- Logoff link from PHP -->
            <?php if(!$MESSAGE_LOGOFF==""){ ?><div class="message" id="res"><?php echo $MESSAGE_LOGOFF ?> </div><?php } ?>			
			<div class="pages"><?php echo $PAGES_STRING ?></div>
            
            <!--Ajax testing-->
            
            <!--<h3>Ajax testing</h3>
 <div id="msg">Type something into the input field</div> 
<div id="search-result"></div>		
			-->			
			
			
			

