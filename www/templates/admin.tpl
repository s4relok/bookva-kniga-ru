<!-- File Database field -->
<p>������ ����� �����, <?php echo $_SESSION['login'] ?>. [<a href="admin.php?action=logoff">�����</a>] </p>
<div class="justRow" style="display:none;"><div id="row"><div id="clmn_Name">��� ����� � �� (*.csv): [<a href="admin.php?action=load">��������� ������</a>]:</div>
<div id="clmn_Check"><form action="admin.php" method="post"><input value="<?php echo CSV_FILE_NAME ?>" class="order" type="text" name="CSV_FILE_NAME" /></div>
</div><div style="clear: both;"></div></div>
<!-- Max books on the page field -->
<div class="justRow"><div id="row"><div id="clmn_Name">������������ ���������� ���� �� ��������:</div>
<div id="clmn_Check"><input value="<?php echo MAX_ON_PAGE ?>" class="order" type="text" name="MAX_ON_PAGE" /></div>
</div><div style="clear: both;"></div></div>
<!-- Number of pages around current one on the counter -->
<div class="justRow"><div id="row"><div id="clmn_Name">���������� ������� ������ ������� �� �������� �������:</div>
<div id="clmn_Check"><input value="<?php echo MAX_VIEW_COUNT_PAGES ?>" class="order" type="text" name="MAX_VIEW_COUNT_PAGES" /></div>
</div><div style="clear: both;"></div></div>
<!-- E-mail -->
<div class="justRow"><div id="row"><div id="clmn_Name">E-mail ��� ������ �� �����:</div>
<div id="clmn_Check"><input value="<?php echo E_MAIL ?>" class="order" type="text" name="E_MAIL" /></div>
</div><div style="clear: both;"></div></div>


<!-- submit button -->
<div class="justRow"><div id="row"><div id="clmn_Name"></div>
<div id="clmn_Check"><input type="submit" value="��������� ���������"/></form></div>
</div><div style="clear: both;"></div></div>

<!-- fileDB -->
<div class="justRow"><div id="row"><div id="clmn_Name">���� ���� ������ (*.csv):</div>
<div id="clmn_Check"><form enctype="multipart/form-data" action="admin.php" method="post" name="fileDB" target="hiddenframe" onsubmit="document.getElementById('res').innerHTML=''; document.getElementById('loading').style.display='block';
return true;"><input class="order" type="file" name="filename" id="upload_file"  /></div>
</div><div style="clear: both;"></div></div>
<!-- submit button -->
<div class="justRow"><div id="row"><div id="clmn_Name"></div>
<div id="clmn_Check"><input type="submit" value="��������� ���� � �����"/></form></div>
</div><div style="clear: both;"></div></div>
<!-- ajax indicator -->
<div class="justRow"><div id="row"><div id="clmn_Name"></div>
<div id="clmn_Check"><div id="loading" style="display:none;" 
<img src="images/loading.gif" border="0" /><br />���� ��������...</div></div>


</div><div style="clear: both;"></div></div>



<iframe id="hiddenframe" name="hiddenframe" style="width:0; height:0; border:0"></iframe>
