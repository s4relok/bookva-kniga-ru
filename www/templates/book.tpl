			<div class="book">
			<div class="header">
            <div <?php if(!isSet($_SESSION['login'])){ ?> class="number"<?php }?> > <?php echo $NUMBER_BOOK ?></div> <div class="new"><?php echo $ISNEW_BOOK ?></div></div>	
            <!--Book's cover-->
            <?php if($IMAGE_COVER!="") { ?>
            
            <div class="bleft_Image_Column"><div id="cover<?php echo $NUMBER_BOOK ?>" class="bookCover"><img src="<?php echo $IMAGE_COVER ?>"/></div>
            </div>	
            
            <?php }?>
			<div class="bleft_Column" <?php if($ORDER_BOOL==true) { ?> style="width:50%" <?php }?> >
            
            
			<div class="bauthor"><a href="<?php echo $AUTHOR_BOOK_LINK ?>"><?php echo $AUTHOR_BOOK ?></a></div>
			<div class="bname"><?php echo $NAME_BOOK ?></div>
			<div class="bprop">
			
			ISBN: <?php echo $ISBN_BOOK ?><br>
			Издательство: <a href="<?php echo $PUBLISHER_BOOK_LINK ?>"><?php echo $PUBLISHER_BOOK ?></a><br>
			Страниц: <?php echo $BOOK_PAGES ?><br>
			<?php echo $BOOK_COVER ?>
			
			</div>
			
			<div style="clear:both;"></div>
			</div>
			
			
			<div class="bright_Column">
			<div class="price"><?php echo $PRICE_BOOK ?> р.</div>
			<div class="book-right"><a href="<?php echo $YEAR_BOOK_LINK ?>"><?php echo $YEAR_BOOK ?> </a></div>	
			<?php if($LINK_BOOK!="") { ?><div class="book-btn"><a href="<?php echo $LINK_BOOK ?>">Подробнее</a></div><?php } else {echo "Товар отсутствует";} ?>
			
			<div style="clear:both;"></div>
			</div>
			
			<div style="clear:both;">     
            
            
            
            <?php if($EDIT_TOOLS!="") { ?>
            <div class="editToolsForBook">
            <div id="clmn_Name"><?php echo $EDIT_TOOLS ?></div>
            
            
            <div id="clmn_Check"><form enctype="multipart/form-data" action="in-loader.php" method="post" name="fileDB" target="hiddenframe" onsubmit="document.getElementById('res').innerHTML=''; document.getElementById('loading<?php echo $NUMBER_BOOK ?>').style.display='block';
return true;">

	  <input class="order" type="file" name="filename" id="upload_file"  />
      <input class="line-genre" type="hidden" name="numberbook" value="<?php echo $NUMBER_BOOK ?>"/>
            </div>
            
            <!-- submit button -->
<div id="clmn_Name"></div>
<div id="clmn_Check"><input type="submit" value="Отправить"/></form></div>

<div id="loading<?php echo $NUMBER_BOOK ?>" style="display:none;">
<img src="images/loading.gif" border="0" />Идет загрузка...</div>
            
            
            </div>
            <?php }?></div>
            			
			</div>
			
