<? 
include './system/common.php';  
include './system/functions.php';
include './system/user.php';


if(!$user) {
header('location: /');
exit;}

$title = 'Набег';    
include './system/h.php';
echo'<div class="hr_g mb2"><div><div></div></div></div></div>
<div class="ribbon mb2"><div class="rl"><div class="rr">
	Набег</div></div></div>';
  $travel = mysql_query('SELECT * FROM `travel` WHERE `user` = "'.$user['id'].'"');  
  $travel = mysql_fetch_array($travel);
  
    $travel_boss = mysql_query('SELECT * FROM `travel_boss` WHERE `id` = "'.$travel['boss'].'"');  
  $travel_boss = mysql_fetch_array($travel_boss);
  
	 if(mysql_result(mysql_query('SELECT * FROM `travel` WHERE `user` = "'.$user[id].'"'),0) == 0) {//Добавляем в бд, если зашел в первый раз
mysql_query('INSERT INTO `travel` (`user`) VALUES ("'.$user[id].'")');
header('location: /travel.php');  
exit;
}
  
  if($travel['h'] == '0' && $travel['time'] == '0' && $travel['step'] == '0') {//0-й этап
  $h = _string(_num($_GET['id'])); //Оприделяем какой набег
  
  if($h == '1'){
	  $h=1;
      $h2=1;
	  $boss=mt_rand(1,3);
	  $boss_stat=mt_rand(35,110);
	  }
  if($h == '2'){
	  $h=2;
      $h2=2;
	  $boss=mt_rand(4,8);
	  $boss_stat=mt_rand(110,400);
  }
  if($h == '3'){
	  $h=3;
      $h2=4;
	  $boss=mt_rand(9,12);
	  $boss_stat=mt_rand(400,1500);
  }
  if($h == '4'){
	  $h=4;
      $h2=8;
	  $boss=mt_rand(13,15);
	  $boss_stat=mt_rand(1500,4500);
  }
  if($h == '5'){
	  $h=5;
      $h2=12;
	  $boss=mt_rand(16,18);
	  $boss_stat=mt_rand(4500,9000);
  } 
  if($h == '6'){
	  $h=6;
      $h2=16;
	  $boss=mt_rand(19,21);
	  $boss_stat=mt_rand(9000,14000);
  } 	  
	  
  if($h) {
$hs = ($h2 * (60 * 60));         
mysql_query('UPDATE `travel` SET `h` = "'.$h.'", `step` = "1", `boss` = "'.$boss.'", `user_hp` = "'.$user['vit'].'", `boss_hp` = "'.$boss_stat.'", `boss_attack` = "'.$boss_stat.'", `boss_def` = "'.$boss_stat.'", `time` = "'.(time() + $hs).'" WHERE `user` = "'.$user['id'].'"');


// Задания
$task_id=6;// Сходи в набег 2 раза
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////////////////////////////


header('location: /travel.php');   
}



echo'<div class="bdr cnr bg_green"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
									<div class="fl ml5 mt5 mr10 mb5">
										<img src="/images/ico/travel/location_1.png">
									</div>
									<div class="ml100 mt5 mb2 mlr10 lwhite large">
										Долина ветров									</div>
									<div class="ml100 mb2 mlr10 lorange small">
																					Легко (1 часа)
																			</div>
								<div class="clb"></div>
								</div></div></div></div></div></div></div></div></div>




<br><div class="cntr"><a href="/travel.php?id=1" class="ubtn inbl green mb5 mt-15 w50"><span class="ul"><span class="ur">В долину</span></span></a></div>';




echo'<div class="bdr cnr bg_green"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
									<div class="fl ml5 mt5 mr10 mb5">
										<img src="/images/ico/travel/location_2.png">
									</div>
									<div class="ml100 mt5 mb2 mlr10 lwhite large">
										Ущелье грома									</div>
									<div class="ml100 mb2 mlr10 lorange small">
																					Легко (2 часа)<br>
																					'.($user['str'] >= 110 ? '':'Требуется 110 силы').'
																			</div>
								<div class="clb"></div>
								</div></div></div></div></div></div></div></div></div>
<br><center> '.($user['str'] >= 110 ? '<a href="/travel.php?id=2" class="ubtn inbl green mb5 mt-15 w50"><span class="ul"><span class="ur">В ущелье</span></span></a>':'<a href="?" class="ubtn inbl red mb5 mt-15 w50"><span class="ul"><span class="ur">В ущелье</span></span></a>').'</center>';

echo'<div class="bdr cnr bg_green"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
									<div class="fl ml5 mt5 mr10 mb5">
										<img src="/images/ico/travel/location_3.png">
									</div>
									<div class="ml100 mt5 mb2 mlr10 lwhite large">
										Алая пустыня									</div>
									<div class="ml100 mb2 mlr10 lorange small">
																					Легко (4 часа)<br>
																					'.($user['str'] >= 400 ? '':'Требуется 400 силы').'
																			</div>
								<div class="clb"></div>
								</div></div></div></div></div></div></div></div></div>
<br><center> '.($user['str'] >= 400 ? '<a href="/travel.php?id=3" class="ubtn inbl green mb5 mt-15 w50"><span class="ul"><span class="ur">В пустыню</span></span></a>':'<a href="?" class="ubtn inbl red mb5 mt-15 w50"><span class="ul"><span class="ur">В пустыню</span></span></a>').'</center>';


echo'<div class="bdr cnr bg_green"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
									<div class="fl ml5 mt5 mr10 mb5">
										<img src="/images/ico/travel/location_4.png">
									</div>
									<div class="ml100 mt5 mb2 mlr10 lwhite large">
										Мглистые горы									</div>
									<div class="ml100 mb2 mlr10 lorange small">
																					Легко (8 часов)<br>
																					'.($user['str'] >= 1500 ? '':'Требуется 1500 силы').'
																			</div>
								<div class="clb"></div>
								</div></div></div></div></div></div></div></div></div>
<br><center> '.($user['str'] >= 1500 ? '<a href="/travel.php?id=4" class="ubtn inbl green mb5 mt-15 w50"><span class="ul"><span class="ur">В горы</span></span></a>':'<a href="?" class="ubtn inbl red mb5 mt-15 w50"><span class="ul"><span class="ur">В горы</span></span></a>').'</center>';


echo'<div class="bdr cnr bg_green"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
									<div class="fl ml5 mt5 mr10 mb5">
										<img src="/images/ico/travel/location_5.png">
									</div>
									<div class="ml100 mt5 mb2 mlr10 lwhite large">
										Древний лес									</div>
									<div class="ml100 mb2 mlr10 lorange small">
																					Легко (12 часов)<br>
																					'.($user['str'] >= 4500 ? '':'Требуется 4500 силы').'
																			</div>
								<div class="clb"></div>
								</div></div></div></div></div></div></div></div></div>
<br><center> '.($user['str'] >= 4500 ? '<a href="/travel.php?id=5" class="ubtn inbl green mb5 mt-15 w50"><span class="ul"><span class="ur">В лес</span></span></a>':'<a href="?" class="ubtn inbl red mb5 mt-15 w50"><span class="ul"><span class="ur">В лес</span></span></a>').'</center>';


echo'<div class="bdr cnr bg_green"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
									<div class="fl ml5 mt5 mr10 mb5">
										<img src="/images/ico/travel/location_6.png">
									</div>
									<div class="ml100 mt5 mb2 mlr10 lwhite large">
										Затопленный город									</div>
									<div class="ml100 mb2 mlr10 lorange small">
																					Легко (16 часов)<br>
																					'.($user['str'] >= 9000 ? '':'Требуется 9000 силы').'
																			</div>
								<div class="clb"></div>
								</div></div></div></div></div></div></div></div></div>
<br><center> '.($user['str'] >= 9000 ? '<a href="/travel.php?id=6" class="ubtn inbl green mb5 mt-15 w50"><span class="ul"><span class="ur">В город</span></span></a>':'<a href="?" class="ubtn inbl red mb5 mt-15 w50"><span class="ul"><span class="ur">В город</span></span></a>').'</center>

<div class="hr_g mb2"><div><div></div></div></div>
<div class="bntf"><div class="small"><div class="nl"><div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">
					В набегах можно зарабатывать опыт и серебро. Чем продолжительнее набег, тем больше награда!				</div></div></div></div>

';
}




    if($travel['step'] == '1'){//1-й этап
if($travel['time'] > time()) {

echo'<div class="bdr cnr bg_green cntr"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
					<div class="ml5 mt5 mb5 sh small">
                    <span id="timer_travel_start"><img src="http://144.76.127.94/view/image/travel/travel_progress.jpg" alt=""><br><span>Ваш герой участвует в набеге.</span><br><span>До конца осталось '._time($travel['time'] - time()).'</span></span>
					</div>
					<div class="clb"></div>
					</div></div></div></div></div></div></div></div></div><br>
<div class="cntr"><a class="ubtn inbl mt-15 mb5 green" href="/"><span class="ul"><span class="ur">На главную</span></span></a></div>';

}else{

  if($_GET['enter'] == true) {
    mysql_query('UPDATE `travel` SET `step` = "2" WHERE `user` = "'.$user['id'].'"');
    header('location: /travel.php');
	exit;
  }
  
echo'<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
				<div class="mt10 mb10 mr10 sh cntr">
					<span class="lwhite tdn">Вы встретили '.$travel_boss['name2'].'</span>
				</div>
				<div class="cntr">
					<img src="/images/ico/travel/'.$travel['boss'].'.png">
				</div>
				<div class="mt10 mb10 mr10 sh cntr">
					<span class="lwhite tdn"></span>
				</div>
				<div class="clb"></div>
			</div></div></div></div></div></div></div></div>
			</div>

<br><div class="cntr"><a href="/travel.php?enter=true" class="ubtn inbl mt-15 red mb5"><span class="ul"><span class="ur">Напасть</span></span></a></div>
';



  }
}  
  
  
      if($travel['step'] == '2'){//2-й этап

  if($travel[boss_hp] <= '0' OR $travel['user_hp'] <= '0') {
mysql_query("UPDATE `travel` SET `step` = '3' WHERE `user` = '".$user['id']."' LIMIT 1");
header("Location:/travel.php");
exit;
  }


  if (isset($_GET['attack'])){
$my_attack = _string(mt_rand($user[str] / 3.5,$user[str] / 3) - mt_rand($travel[boss_def] / 12,$travel[boss_def] / 9));
if($my_attack <= '0'){ $my_attack = 2;}
$boss_atk = _string(mt_rand($travel[boss_attack] / 3.5,$travel[boss_attack] / 3) - mt_rand($user[def] / 12,$user[def] / 9));
if($boss_atk <= '0'){ $boss_atk = 2;}      
      
      

 
$my = "<b>Вы</b> нанесли "._string($my_attack)." урона";
$boss = "<b>".$travel_boss[name]."</b> нанес "._string($boss_atk)." урона";
$msg = "$my <br/> $boss";
mysql_query("update `travel` set    `boss_hp` = `boss_hp` - '".$my_attack."', `user_hp` = `user_hp` - '".$boss_atk."' where (`user` = '".$user[id]."')");
mysql_query("INSERT INTO `travel_log` SET
            `id_user`='".$user[id]."',
            `text`='".$msg."'");
    header("Location:/travel.php");
    exit;
   }

   
   
   
   
  echo' <div class="bdr bg_red"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
						<div class="fl ml10 mt10">
							<a class="nd" href="/travel.php?attack">
								<img src="/images/ico/travel/'.$travel['boss'].'.png">
							</a>
						</div>
														<div class="ml68 mt10 mb10 mr10 sh">
								<span class="lwhite tdn">'.$travel_boss[name].'</span>
								<div class="small mb2">
									<span class="fr rdmg"></span>
									<span class="lorange">
										<img src="http://144.76.127.94/view/image/icons/strength.png" class="va_t" height="16" width="16" alt=""> '._string($travel[boss_attack]).'										<img src="http://144.76.127.94/view/image/icons/health.png" class="va_t" height="16" width="16" alt=""> '._string($travel[boss_hp]).'										<img src="http://144.76.127.94/view/image/icons/defense.png" class="va_t" height="16" width="16" alt=""> '._string($travel[boss_def]).'									</span>
								</div>
								<div class="prg-bar fght"><div class="prg-green fl" style="width:100%;"></div><div class="prg-red fl" style="width:0%;"></div></div></div>
													<div class="clb"></div>
				</div></div></div></div></div></div></div></div></div>
  
  <br><div class="cntr"><a href="/travel.php?attack" class="ubtn inbl mt-15 red mb2"><span class="ul"><span class="ur">Атаковать</span></span></a></div>
  
  
  <div class="bdr bg_blue mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
					<div class="fl ml10 mt10">
						<img src="/images/user/'.($user['sex'] = man ? '0':'1').'.png" class="radius" height="48" alt="">
					</div>
					<div class="ml68 mt10 mb10 mr10 sh">
													<span class="lwhite tdn"><a class="nd" href="/travel.php?attack">'.$user[login].'</a></span>
												<div class="small mb2">
							<span class="fr rdmg"></span>
							<span class="lorange">
								<img src="http://144.76.127.94/view/image/icons/strength.png" class="va_t" height="16" width="16" alt=""> '.$user[str].'								<img src="http://144.76.127.94/view/image/icons/health.png" class="va_t" height="16" width="16" alt=""> '._string($travel[user_hp]).'								<img src="http://144.76.127.94/view/image/icons/defense.png" class="va_t" height="16" width="16" alt=""> '.$user[def].'							</span>
						</div>
						<div class="prg-bar fght"><div class="prg-green fl" style="width:100%;"></div><div class="prg-red fl" style="width:0%;"></div></div></div>
					</div>
					<div class="clb"></div>
				</div></div></div></div></div></div></div></div>';

   $ca=mysql_result(mysql_query("SELECT COUNT(*) FROM `travel_log`"),0);
$req = mysql_query("SELECT * FROM `travel_log` where `id_user` = '".$user[id]."' ORDER by `id` DESC LIMIT 3  ");
$avto=mysql_num_rows($req);
if($avto==0){
     echo'<div class="hr_g mb2"><div><div></div></div></div><div class="bntf"><div class="nl"><div class="nr cntr lyell lh1 p5 sh">Нет истории боя</div></div></div> ';
}else{
     echo'<div class="hr_g mb2"><div><div></div></div></div><div class="bntf"><div class="nl"><div class="nr cntr lyell lh1 p5 sh">История боя<br><br>';
while($log = mysql_fetch_array($req))
{
     echo' '.$log[text].' <br/>';
}
echo' </div></div></div>';
}
	  }

	        
			
if($travel['step'] == '3'){//3-й этап

if($travel[boss_hp] <= '0'){ //Награда при победе
$_gold=$travel['h'];
$_silver=rand(1,10) + ($user['vit']/2) + ($user['vit']/3) * $travel['h'];
$_exp=rand(1,10) + ($user['vit']/2) + ($user['vit']/3) *$travel['h'] ;}
if($travel[user_hp] <= '0'){ //Награда при поражении
$_gold=0;
$_silver=rand(1,10) + ($user['vit']/3.5) + ($user['vit']/4) *$travel['h'];
$_exp=rand(1,10) + ($user['vit']/3.5) + ($user['vit']/4) *$travel['h'];}



    if($clan_memb && $clan_memb['v'] > 0) {  //Верность клану
$_exp += round($_exp/100) * $clan_memb['v'];
}
  if($premium) {$_exp+= round($_exp/ 100) * 25;} //Если премик


	 
          
        
          
    mysql_query('UPDATE `travel` SET `h` = "0", 
								`step` = "0",
								`boss` = "0",
								`user_hp` = "0",
								`boss_hp` = "0",
								`boss_attack` = "0",
								`boss_def` = "0",
                                `time` = "0" WHERE `user` = "'.$user['id'].'"');
    
	if($travel[user_hp] <= '0'){ //Награда при поражении
mysql_query('UPDATE `users` SET `s` = `s` + "'.$_silver.'", `exp` = `exp` + "'.$_exp.'" WHERE `id` = "'.$user['id'].'"');
     if($clan) {//Если в клане 
mysql_query('UPDATE `clans`     SET `exp` = `exp` + '.$_exp.' WHERE `id` = "'.$clan['id'].'"'); //Плюсуем в клан
mysql_query('UPDATE `clan_memb` SET `exp` = `exp` + '.$_exp.' WHERE `clan` = "'.$clan['id'].'" AND `user` = "'.$user['id'].'"'); //Плюсуем учаснику клана
  } 
}
	if($travel[boss_hp] <= '0'){ //Награда при победе
mysql_query('UPDATE `users` SET  `g` = `g` + "'.$_gold.'", `s` = `s` + "'.$_silver.'", `exp` = `exp` + "'.$_exp.'" WHERE `id` = "'.$user['id'].'"');	
     if($clan) {//Если в клане 
mysql_query('UPDATE `clans`     SET `exp` = `exp` + '.$_exp.' WHERE `id` = "'.$clan['id'].'"'); //Плюсуем в клан
mysql_query('UPDATE `clan_memb` SET `exp` = `exp` + '.$_exp.' WHERE `clan` = "'.$clan['id'].'" AND `user` = "'.$user['id'].'"'); //Плюсуем учаснику клана
} }
  
  //
    $proc = rand(1,100);
	if($travel[user_hp] <= '0'){ //Награда при поражении
	$shans=20;
	}elseif($travel[boss_hp] <= '0'){ //Награда при победе
	$shans=30;
	}
  if($proc < $shans) { //Шанс выпадания шмоток 
$w = mysql_fetch_array(mysql_query('SELECT * FROM `shop` WHERE `quality` <= "3" ORDER BY RAND() LIMIT 1'));
if(mysql_num_rows(mysql_query('SELECT * FROM `inv` WHERE `place` = \'0\' AND `user` = \''.$user['id'].'\'')) + 1 < 200) { //Если в рюкзакуменьше 20-ти вещей
mysql_query('INSERT INTO `inv` (`user`,
                                    `item`,
                                    `quality`,
                                    `_str`,
                                    `_vit`,
                                    `_def`) VALUES (\''.$user['id'].'\',
                                                    \''.$w['id'].'\',
                                                    \''.$w['quality'].'\',
                                                    \''.$w['_str'].'\',
                                                    \''.$w['_vit'].'\',
                                                    \''.$w['_def'].'\')');
$w_id = mysql_insert_id();
$w = mysql_fetch_array(mysql_query('SELECT * FROM `inv` WHERE `id` = \''.$w_id.'\''));
$item = mysql_fetch_array(mysql_query('SELECT * FROM `items` WHERE `id` = \''.$w['item'].'\''));
  


  switch($w['quality']) {
case 1:
$quality = 'Обычный';
$quality_color = '#999999';
break;
case 2:
$quality = 'Необычный';
$quality_color = '#B1D689';
break;
case 3:
$quality = 'Редкий';
$quality_color = '#6BA0E7';
break;
case 4:
$quality = 'Эпический';
$quality_color = '#C780DB';
break;
case 5:
$quality = 'Легендарный';
$quality_color = '#FF8E94';
break;
case 6:
$quality = 'Мифический';
$quality_color = '#FE7E01';
break;
}
  

$equip_item = mysql_query('SELECT * FROM `inv` WHERE `id` = "'.$user['w_'.$item['w']].'"');
$equip_item = mysql_fetch_array($equip_item);
    $diff = 0;
  if($w['_str'] > $equip_item['_str']) { 
$diff += $w['_str'] - $equip_item['_str'];
}
    if($w['_vit'] > $equip_item['_vit']) {
$diff += $w['_vit'] - $equip_item['_vit'];
}
    if($w['_def'] > $equip_item['_def']) {
      $diff += $w['_def'] - $equip_item['_def'];
}


  if(($w['_str'] + $w['_vit'] + $w['_def']) - ($equip_item['_str'] + $equip_item['_vit'] + $equip_item['_def']) > 0) {
$ddd='<font color="#3c3">+'.$diff.'</font> </small>';
  }
$_SESSION['mes_item'] = '
<table cellpadding="0" cellspacing="0">
<tr>
<td width="15%"><img src="/images/items/'.$w['item'].'.png" alt="*"/></td>
<td>
<img src="/images/ico/quality/'.$w['quality'].'.png" alt="*"/> <a href="/item/'.$w['id'].'/"> '.$item['name'].' </a>
<br/><small>
<font color="#'.(($user['level'] < $item['level']) ? 'c06060':'ffffff').'"><img src="/images/ico/png/up.png" alt="*" width="12"/>'.$item['level'].' ур, </font>
<font color="'.$quality_color.'"> '.$quality.' </font>
'.$ddd.'
</td></tr></table>';
  }
  
  }
//  
mysql_query("DELETE FROM `travel_log` WHERE `id_user` = '".$user['id']."'");
  
  
  
  
  
  
  
  
  
if($travel[boss_hp] <= '0'){	
	echo'<div class="bntf"><div class="nl"><div class="nr cntr lyell lh1 p5 sh"><span class="win"><b>Победа!</b></span><div class="mb5"></div><img src="http://144.76.127.94/view/image/travel/travel_win.jpg" alt=""><br><span class="win">Награда: </span><img class="icon" src="http://144.76.127.94/view/image/icons/silver.png">'.n_f($_silver).',  <img class="icon" src="http://144.76.127.94/view/image/icons/expirience.png">'.n_f($_exp).'   <br><div class="mt10"><a href="/travel.php?end=true" class="ubtn inbl green"><span class="ul"><span class="ur">Новый набег</span></span></a></div></div></div></div>
	'.$_SESSION['mes_item'].'';
	$_SESSION['mes_item']=NULL; //Удаляем сесию
}

if($travel[user_hp] <= '0'){
	echo' <div class="bntf"><div class="nl"><div class="nr cntr lyell lh1 p5 sh"><span class="lose"><b>Поражение!</b></span><div class="mb5"></div><img src="http://144.76.127.94/view/image/travel/travel_lose.jpg" alt=""><br><span class="win">Награда: </span><img class="icon" src="http://144.76.127.94/view/image/icons/silver.png">'.n_f($_silver).',  <img class="icon" src="http://144.76.127.94/view/image/icons/expirience.png">'.n_f($_exp).'   <div class="mt10"><a href="/travel.php?end=true" class="ubtn inbl green"><span class="ul"><span class="ur">Новый набег</span></span></a></div></div></div></div>

	'.$_SESSION['mes_item'].'';
	$_SESSION['mes_item']=NULL; //Удаляем сесию

}

	


	
}
			
			
			
			
include './system/f.php';
?>