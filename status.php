<?
   include './system/common.php';
   include './system/functions.php';
   include './system/user.php';
  $title = 'Смена статуса';
	  include './system/h.php';

if(!$user) exit(header('Location: /'));

if(isset($_GET['StatusEdit'])) {
	
	if($user['g'] <= 0) exit(header('Location: /'));
	
$anketa_status = _string($_POST['anketa_status']);
$anketa_name = _string($_POST['anketa_name']);
$anketa_city = _string($_POST['anketa_city']);
$anketa_anketa = _string($_POST['anketa_anketa']);

mysql_query("UPDATE `users` SET `anketa_status` = '$anketa_status'  WHERE `id` = '$user[id]'");
mysql_query("UPDATE `users` SET `anketa_name` = '$anketa_name'  WHERE `id` = '$user[id]'");
mysql_query("UPDATE `users` SET `anketa_city` = '$anketa_city'  WHERE `id` = '$user[id]'");
mysql_query("UPDATE `users` SET `anketa_anketa` = '$anketa_anketa'  WHERE `id` = '$user[id]'");
exit(header ('Location: /info_user.php')); 

}
?>
  <div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Изменить статус
    </div>
   </div>
  </div> 

  
  
  
  
  
  
  
  
  
  
  
 <div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="ml5 mt10 mb10 mr5 sh">
		<form action="?StatusEdit" method="POST">

			<span class="lblue"><img src="http://144.76.127.94/view/image/icons/about.png" alt="" class="icon"> Статус</span><br>
			<input type="text" name="anketa_status" value="<?=$user['anketa_status']?>" maxlength="27" class="lbfld anketa_input"><br>

			<span class="grey1 small">Этот текст отображается в профиле игрока, не более 27 символов</span><br><br>

			<span class="lblue"><img src="http://144.76.127.94/view/image/icons/name.png" alt="" class="icon"> Реальное имя</span><br>

			<input type="text" name="anketa_name" value="<?=$user['anketa_name']?>" class="lbfld anketa_input"><br><br>

			<span class="lblue"><img src="http://144.76.127.94/view/image/icons/city.png" alt="" class="icon"> Город</span><br>

			<div>
											<div class="">
							<input type="text" name="anketa_city" class="lbfld anketa_input" value="<?=$user['anketa_city']?>">
						</div>

															</div>
			<br>

			<span class="lblue"><img src="http://144.76.127.94/view/image/icons/anketa.png" alt="" class="icon"> Анкета</span><br>
			<textarea rows="3" name="anketa_anketa" class="lbfld anketa_input"><?=$user['anketa_anketa']?></textarea><br>
			<div class="anketa_input pl5 pt3"><input type="submit" class="ibtn fr search" value="&nbsp;" name="preview"></div>
			<span class="grey1 small">Текст отображается в анкете, 1000 символов</span>

			<div class="mt5 mb5 small">
				<img class="icon" src="http://144.76.127.94/view/image/art/ico16-grey_smile.png" width="16" height="16" alt=":)"> <a class="grey1" href="/smiles?anketa=1">Смайлики</a>
				<span class="delimiter"> | </span><a class="grey1" href="/bbcodes">BB-коды</a>
			</div>

			<input type="hidden" name="save" value="1">

			<div class="cntr">
				<br>
				<input type="submit" class="ibtn" value="Сохранить">
			</div>

		</form>
	</div>
</div></div></div></div></div></div></div></div></div> 
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  <?

include './system/f.php';
?>