<script  language="JavaScript"  src="gen_validatorv31.js"  type="text/javascript"></script>

<!-- Client's name field -->
<div class="justRow"><div id="row"><div id="clmn_Name">*Ваше имя:</div>
<div id="clmn_Check"><form name="mypageform" action="order.php" method="post"><input class="order" type="text" name="CLIENT_NAME" /></div>
</div><div style="clear: both;"></div></div>
<!-- Client's phone number -->
<div class="justRow"><div id="row"><div id="clmn_Name">*Номер телефона:</div>
<div id="clmn_Check"><input class="order" type="text" name="CLIENT_PHONE" /></div>
</div><div style="clear: both;"></div></div>
<!-- Client's message -->
<div class="justRow"><div id="row"><div id="clmn_Name">Сообщение:</div>
<div id="clmn_Check"><textarea name="CLIENT_MESSAGE" >Отложите для меня книгу</textarea>
<input class="line-genre" type="text" name="BOOK_NUMBER" value="<?php echo $BOOK_NUMBER ?>" />
<input class="line-genre" type="text" name="BOOK_AUTHOR" value="<?php echo $BOOK_AUTHOR ?>" />
<input class="line-genre" type="text" name="BOOK_NAME" value="<?php echo $BOOK_NAME ?>" />


</div>
</div><div style="clear: both;"></div></div>

<!-- submit button -->
<div class="justRow"><div id="row"><div id="clmn_Name"></div>
<div id="clmn_Check"><input id="submitButton" onclick="newf()" type="submit" value="Отправить"/></form><div id='mypageform_errorloc' class='error_strings'>
                              </div>

<script  language="JavaScript"> 
  var  frmvalidator    =  new  Validator("mypageform"); 
  
  frmvalidator.EnableOnPageErrorDisplaySingleBox();
  frmvalidator.EnableMsgsTogether();
   
  frmvalidator.addValidation("CLIENT_NAME","req","Необходимо ввести Ваше имя");
  frmvalidator.addValidation("CLIENT_PHONE","req","Необходимо ввести номер телефона");

</script>  

</div>
</div><div style="clear: both;"></div></div>



