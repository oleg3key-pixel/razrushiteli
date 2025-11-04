<?php
/**
 * Мятеж
 * Битва начинаеться в 11:00\13:30\16:30\19:30\22:00 часа по серверу
 */


$invasionTime = 15; //Время на проведение мятежа минут


/**
 * Босс статы
 */

$boss = [	'name'=>'Demon',
			'str'=>15000,
			'vit'=>300000,
			'def'=>20000
		];



/**
 * Время стартов мятежа.
 */
 
		$date1 =  strtotime('18:00');
		$date2 =  strtotime('23:30');
	
	if(time() <= $date1){
	$dateStart =  strtotime('18:00');
	}elseif(time() <= $date2){
	$dateStart =  strtotime('23:30');
	}else{
	$dateStart = strtotime('next day 18:00');
	}



include './system/common.php';
include './system/functions.php';
include './system/user.php';

if(!$user) {
header('location: /');
exit;}

$title = 'Вторжение';
include './system/h.php';


if(isset($_REQUEST['info'])){
$title = 'История вторжений';
$invasion = mysql_query("SELECT * FROM `invasion` WHERE `end` = '1' ORDER BY `id` DESC LIMIT 1");
$invasion = mysql_fetch_assoc($invasion);


$membersCounter = mysql_num_rows(mysql_query("SELECT `id` FROM `invasion_member` WHERE `invasion`='".$invasion['id']."' "));//Героев в отряде
$mobsCounter = mysql_num_rows(mysql_query("SELECT `id` FROM `invasion_mobs` WHERE `invasion`='".$invasion['id']."' "));//разбойников в отряде

echo'<div class="title">'.$title.'</div>';
echo '<div class="empty_block item_center">
Результат: '.($invasion['pobeda'] != 0 ? '<font color="7AFE4E"><b>Победили</b></font>':'<font color="C12322"><b>Проиграли</b></font>').'

	 </br>
Игроки:	'.$membersCounter.' </br>
Врагов:	'.$mobsCounter.' </br>
'.($invasion['kill_boss'] != 0 ? ''.nick($invasion['kill_boss']).' убил Лорда Командующего и получает 
<img src="/images/ico/png/hp.png" alt="*" width="15"> 250
<img src="/images/ico/png/attack.png" alt="*" width="15"> 250
<img src="/images/ico/png/def.png" alt="*" width="15"> 250
на 24 часа.
':'<font color="7AFE4E"><b>Предводитель разбойников</b></font> не был убит').' </div>';

if($invasion['kill_boss'] != '0'){ 
echo'<div class="title"> ТОП 3</div>
<div class="empty_block item_center">';
$req = mysql_query('SELECT * FROM `invasion_items` WHERE `invasion`= "'.$invasion['id'].'" ORDER BY `id` DESC LIMIT 3');
while($invasionItems = mysql_fetch_array($req)) {
$item = mysql_fetch_array(mysql_query('SELECT * FROM `items` WHERE `id` = "'.$invasionItems['item'].'"'));
echo'<a href="/user/'.$invasionItems['user'].'/">'.nick($invasionItems['user']).'</a> <img src="images/ico/png/gold.png" alt="*"> 30 золота и
<img src="/images/ico/quality/5.png" alt="*"> <a href="/items/'.$invasionItems['item'].'/"> '.$item['name'].' </a> </br>
';
}
echo'</div><div class="line"></div>
<div class="empty_block item_center">
Лучшие игроки получили дополнительную награду:</br>
Топ-3:   <img src="/images/ico/png/gold.png" alt="*" width="15"> 30 и легендарную вещь</br>
Топ-100: <img src="/images/ico/png/gold.png" alt="*" width="15"> 3 и эпическую/редкую вещь
</div>
<div class="line"></div>';
}
echo'<div class="block_link"><a href="/invasion" class="link"><img src="/images/ico/png/invasion.png" width="18"> Назад к Вторжению </a></div>
<div class="line"></div>';


include './system/f.php';
exit;}
////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////








$invasion = mysql_query("SELECT * FROM `invasion` ORDER BY `id` DESC LIMIT 1");
$invasion = mysql_fetch_assoc($invasion);
$invasionMember =  mysql_query("SELECT * FROM  `invasion_member` WHERE `invasion`='".$invasion['id']."' and `user`='".$user['id']."'");
$invasionMember = mysql_fetch_assoc($invasionMember);








////////////////////////////////////////////////////////////////////////////////////
$iMember =  mysql_query("SELECT * FROM  `invasion_member` WHERE `invasion`!='".$invasion['id']."' and `user`='".$user['id']."' ORDER BY `id` DESC LIMIT 1");
$iMember = mysql_fetch_assoc($iMember);
if($iMember['nagrada'] == '0') {//Если вторжение закончилось
	 	  if(isset($_REQUEST['ok'])){
mysql_query("UPDATE `invasion_member` SET `nagrada`='1' WHERE `user`='".$user['id']."' and `invasion`='".$iMember['invasion']."' ");
header('location: /invasion');
exit;}

 if($iMember['uron'] == '0') {
echo'<div class="title">'.$title.'</div>
<div class="empty_block item_center">
Предыдущее вторжение закончилось. Вы не пришли на битву и ваша награда меньше.</br>
<font color="7AFE4E"><b>Награда:</b></font>
<img src="/images/ico/png/silver.png" alt="*" width="15"> '._string(_num($iMember['uron']/3)).'
<img src="/images/ico/png/exp.png" alt="*" width="15"> '._string(_num($iMember['uron']/2)).' </br>';
if($iMember){
echo'<a href="?ok"> <input class="button" type="submit" value="Продолжить"> </a>';
}
echo'</div>
<div class="line"></div>';
}else{
echo'<div class="title">'.$title.'</div>
<div class="empty_block item_center">
Предыдущее вторжение закончилось. Вы храбро сражались и получите достойную награду.</br>
<font color="7AFE4E"><b>Награда:</b></font>
<img src="/images/ico/png/silver.png" alt="*" width="15"> '._string(_num($iMember['uron']/3)).'
<img src="/images/ico/png/exp.png" alt="*" width="15"> '._string(_num($iMember['uron']/2)).' </br>';
if($iMember){
echo'<a href="?ok"> <input class="button" type="submit" value="Продолжить"> </a>';
}
echo'</div>
<div class="line"></div>';
}
include './system/f.php';
exit;
}
///////////////////////////////////////////////////////////////






//////////////////////////////////////////////////////////////
if ($invasion['time_left'] <= time() ){//Начинаем вторжение...
    mysql_query("UPDATE `invasion` SET `end`='1' WHERE `id`='".$invasion['id']."'");
	mysql_query("INSERT INTO `invasion` SET `time_start`='$dateStart',`start`='0',`time_left`='".($dateStart+(60*$invasionTime))."'");
	mysql_query("INSERT INTO `time_jurnal` SET `time`='$dateStart',`name`='invasion'");
	header("Location:/invasion");
	exit;}
$membersCounter = mysql_num_rows(mysql_query("SELECT `id` FROM `invasion_member` WHERE `invasion`='".$invasion['id']."' and `dead`='0' "));//Героев в отряде





if ($invasion['start'] == 0 && $invasion['time_start'] > time() && $invasion['end'] == 0) {//Если мятеж еще не начат..

	if (isset($_GET['enter']) ) {//Подаем заявку на участвие
mysql_query("INSERT INTO `invasion_member` SET `user`='".$user['id']."',
													`vit`='".$user['vit']."',
													`str`='".$user['str']."',
													`def`='".$user['def']."',
															`invasion`='".$invasion['id']."'")or die (mysql_error());
$bot_img_ = rand(1, 3);   
mysql_query("INSERT INTO `invasion_mobs` SET `type`='demon',
													`str`='".$user['str']."',
													`def`='".$user['def']."',
													`max_hp`='".$user['vit']."',
													`hp`='".$user['vit']."',
													`invasion`='".$invasion['id']."',
													`img`='".$bot_img_."' ");//Добавляем противников
  $chanse = rand(1,100);
  if($chanse < '25' ) {//Шанс 25% добавить ещё одного бота                                                   
mysql_query("INSERT INTO `invasion_mobs` SET `type`='demon',
													`str`='".$user['str']."',
													`def`='".$user['def']."',
													`max_hp`='".$user['vit']."',
													`hp`='".$user['vit']."',
													`invasion`='".$invasion['id']."',
													`img`='".$bot_img_."' ");//Добавляем противников
  }
header("Location:/invasion/");
exit;}



echo '<div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Вторжение
    </div>
   </div>
  </div> 
  <div class="bdr bg_blue">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="cntr mt5 mb2"> 
            <div class="mb5">
             <img src="http://144.76.127.94/view/image/invas0.png" alt="">
            </div> 
           </div> 
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div><br>
  <div class="cntr">
  '.($invasionMember ? '<a  class="ubtn inbl mt-15 red mb5" href="?">   <span class="ul"><span class="ur">Обновить</a></span></span>':''.($user['str'] >= 400 ? '<a    class="ubtn inbl mt-15 red mb5"  href="?enter">   <span class="ul"><span class="ur">Подать заявку</a></span></span>':'').'').'
  </div> 
  <div class="hr_g mb2">
   <div>
    <div></div>
   </div>
  </div> 
  <div class="bntf">
   <div class="small">
    <div class="nl">
     <div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">
       Вражеское войско на подходе! Вступите в отряд и разгромите врага! 
<br>До начала: '._time($invasion['time_start']-time()).'
<br>Героев в отряде: '.$membersCounter.'

     </div>
    </div>
   </div>
  </div> 
   <div>
    <div></div>
   </div>
  </div> ';




/*
echo'
<div class="title">'.$title.'</div>

<div class="empty_block item_center">
  <img src="/images/invasion/logo.png" alt="*"/></br>
'.($user['str'] >= 400 ? 'Битва начнется через: '._time($invasion['time_start']-time()).'':'Для участия требуется 400 силы').'
'.($invasionMember ? '<a href="?"><div class="button">Обновить</div></a> ':''.($user['str'] >= 400 ? '<a href="?enter"><div class="button">Подать заявку</div></a>':'<div class="button2">В бой</div>').'').'

Героев в отряде: '.$membersCounter.' </div>
<div class="line"></div>
<div class="block_link"><a href="/invasion_info" class="link"><img src="/images/ico/png/invasion.png" width="18"> История Вторжений </a></div>
<div class="line"></div>';
*/
} 


elseif ($invasion['time_start'] <=  time() && $invasion['start'] == 0 ){ //Начинаем турнир если время до начала истекло.
mysql_query("UPDATE `invasion` SET `start`='1' WHERE `id`='".$invasion['id']."'");
header('Location:/invasion');
exit;























} 
elseif ($invasion['time_start'] <= time()  && $invasion['start']  == 1 && $invasion['end'] == 0 && $invasion['time_left'] >  time()) 
{ //Если турнир начат...

	////////////////// Посчитаем время до конца... /////////////////////
	$to_end = ($invasion['time_left']-time())/60%60;
	$to_ends = ($invasion['time_left']-time())%60;




	///// Если юзверь участвует в битве и она началась//////////////
	if ($invasionMember){//
$mobsCounter = mysql_num_rows(mysql_query("SELECT `id` FROM `invasion_mobs` WHERE `invasion`='".$invasion['id']."' and `type`= 'demon' and `dead`='0' "));//Считаем разбойников
echo'<div class="empty_block item_center">
Игроки: '.$membersCounter.' vs разбойники: '.$mobsCounter.' </br>
Осталось: '._time($invasion['time_left'] - time()).'
</div>';//Показуем информицию

 
		
		
/** Бой...*/

		if ($invasionMember['vit'] <= '0' OR $invasionMember['dead'] == 1){//Если вас убили
echo''.mes('Поражение').'';	
echo'<div class="empty_block item_center">
Вы храбро сражались, но были убиты во время сражения. 
</div><div class="line"></div>';
    if($nag['dead'] == '0'){	
mysql_query("UPDATE `invasion_member` SET `dead`='1' WHERE `invasion`='".$invasion['id']."' and `user`='".$user['id']."' ");}	
}else{

echo'<div class="line"></div>';
		
////////////////Определяем есть ли Предводитель////////////

if ($mobsCounter == 0){//Если нет разбойников
if (mysql_num_rows(mysql_query("SELECT * FROM `invasion_mobs` WHERE `type`='boss'and `invasion`='".$invasion['id']."' and `dead`='0'")) == 0 && $invasion['kill_boss'] == 0)
{//Выпускаем Предводительа...

					
mysql_query("INSERT INTO `invasion_mobs` SET `invasion`='".$invasion['id']."',
																`str`='".$boss['str']."',
																`def`='".$boss['def']."',
																`max_hp`='".$boss['vit']."',
																`hp`='".$boss['vit']."',
																`type`='boss' ");
$log = '<span class="lime">Предводитель разбойников вступил в бой</span>';
mysql_query("INSERT INTO `invasion_logs` SET `time`='".time()."',`text`='".$log."',`invasion`='".$invasion['id']."',`user`='0'");
header("Location:/invasion/");
exit;}
}
$boss = mysql_fetch_assoc(mysql_query("SELECT * FROM `invasion_mobs` WHERE `invasion`='".$invasion['id']."' and `dead`='0' and `type`='boss'"));
				
		

 



/////////////////////////////////////////////////////////////////////////
/////////////////////////////Атака///////////////////////////////////////
/////////////////////////////////////////////////////////////////////////
if (isset($_GET['attack'])){//Атака
$attack = htmlspecialchars(trim($_GET['attack']));
				
if($invasionMember['cooldown'] < time()){
mysql_query("UPDATE `invasion_member` SET `cooldown`='".(time()+0)."' WHERE `invasion`='".$invasion['id']."' and `user`='".$user['id']."'");

				/**
				 * Мочим разбойников!
				 */
			if ($attack == 'mob'){
		if ($mobsCounter > 0){
if($invasionMember['target'] == 0){
$enemy = mysql_fetch_assoc(mysql_query("SELECT * FROM `invasion_mobs` WHERE `dead`='0' and `invasion`='".$invasion['id']."' ORDER BY RAND()"));						
mysql_query("UPDATE `invasion_member` SET `target`='".$enemy['id']."' WHERE `user`='".$user['id']."'");
header("Location:/invasion/");					
}else{					
$enemy = mysql_fetch_assoc(mysql_query("SELECT * FROM `invasion_mobs` WHERE `id`='".$invasionMember['target']."' and `invasion`='".$invasion['id']."' "));													
}}
}
			


	if ($attack == 'mob'){//Система боя с разбойником
$my_attack = _string(mt_rand($user['str'] / 3.5,$user['str'] / 3) - mt_rand($enemy['def'] / 12,$enemy['def'] / 9));
if($my_attack <= '0'){ $my_attack = 2;}
$boss_atk = _string(mt_rand($enemy['str'] / 3.5,$enemy['str'] / 3) - mt_rand($user['def'] / 12,$user['def'] / 9));
if($boss_atk <= '0'){ $boss_atk = 2;}  


	if ($my_attack > $enemy['hp'] AND $mobsCounter > 0){			
mysql_query("UPDATE `invasion_member` SET `target`='0', `kill`=`kill`+'1' WHERE `user`='".$user['id']."' and `invasion`='".$invasion['id']."'");
mysql_query("UPDATE `invasion_mobs` SET `dead`='1',`hp`='0' WHERE `id`='".$enemy['id']."'");
$log = ' Вы убили <span class="red">разбойника!</span>';
mysql_query("INSERT INTO `invasion_logs` SET `time`='".time()."',`text`='".$log."',`invasion`='".$invasion['id']."',`user`='".$user['id']."'");
}else{	

  $chanse = rand(1,100);
  if($chanse < '35' ) {//Шанс нанести урон у разбойника 35%
mysql_query("UPDATE `invasion_member` SET `vit`=`vit`-'".$boss_atk."', `uron`=`uron`+'".$my_attack."' WHERE `user`='".$user['id']."' AND `invasion` = '".$invasion['id']."' ");
$log = '<span class="red">разбойник</span> ударил Вас на '.$boss_atk.'!</span>';
mysql_query("INSERT INTO `invasion_logs` SET `time`='".time()."',`text`='".$log."',`invasion`='".$invasion['id']."',`user`='".$user['id']."'");
  }
mysql_query("UPDATE `invasion_mobs` SET `hp`=`hp`-'".$my_attack."' WHERE `id`='".$enemy['id']."'");
mysql_query("UPDATE `invasion_member` SET `uron`=`uron`+'".$my_attack."' WHERE `user`='".$user['id']."' AND `invasion` = '".$invasion['id']."' ");
$log = 'Вы ударили <span class="red">разбойника</span> на '.$my_attack.'!</span>';
mysql_query("INSERT INTO `invasion_logs` SET `time`='".time()."',`text`='".$log."',`invasion`='".$invasion['id']."',`user`='".$user['id']."'");
}
header('Location:/invasion/');
exit;} 



elseif ($attack == 'boss') {//Система боя с Лордом
	$boss = mysql_fetch_assoc(mysql_query("SELECT * FROM `invasion_mobs` WHERE `invasion`='".$invasion['id']."' and `dead`='0' and `type`='boss'")); 
$my_attack = _string(mt_rand($user['str'] / 3.5,$user['str'] / 3) - mt_rand($boss['def'] / 12,$boss['def'] / 9));
if($my_attack <= '0'){ $my_attack = 2;}
$boss_atk = _string(mt_rand($boss['str'] / 3.5,$boss['str'] / 3) - mt_rand($user['def'] / 12,$user['def'] / 9));
  

			

					if ($my_attack >= $boss['hp'] AND $invasion['kill_boss'] == 0) {
										
						/*
                         * Выдаём камень на 24 часов тому кто убил Лорда, и сразу начисляем параметры.
                         */

mysql_query("INSERT INTO `invasion_stone` SET `user`='".$user['id']."',`time`='".(time() + (3600 * 24))."'");
mysql_query('UPDATE `users` SET `str` = `str` + 250,
                                 `vit` = `vit` + 250,
                                 `def` = `def` + 250 
					    		WHERE `id` = \''.$user['id'].'\'');
						

mysql_query("UPDATE `invasion_mobs` SET `dead`='1',`hp`='0' WHERE `type`='boss'");
mysql_query("UPDATE `invasion` SET `kill_boss`='".$user['id']."', `end`='1', `time_left` = '".time()."', `pobeda` = '1' WHERE `id`='".$invasion['id']."'");




////////////////////////////////////////////////////////////////////////////
///////////////////Начисляем награду///////////////////////////////////////
$us = mysql_query('SELECT * FROM `invasion_member` WHERE `invasion`= "'.$invasion['id'].'" ');
while($member = mysql_fetch_array($us)) {
mysql_query('UPDATE `users` SET `s` = `s` + "'.($member['uron']/3).'",
                                `exp` = `exp` + "'.($member['uron']/2).'"
					    		WHERE `id` = "'.$member['user'].'" ');
 $_clan_memb = mysql_fetch_array(mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$member['user'].'"'));
 $_clan = mysql_fetch_array(mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$_clan_memb['clan'].'"'));
     if($clan) {//Если в клане 
mysql_query('UPDATE `clans`     SET `exp` = `exp` + '.($member['uron']/2).' WHERE `id` = "'.$_clan['id'].'"'); //Плюсуем в клан
mysql_query('UPDATE `clan_memb` SET `exp` = `exp` + '.($member['uron']/2).' WHERE `clan` = "'.$_clan['id'].'" AND `user` = "'.$member['user'].'"'); //Плюсуем учаснику клана
}                                
}
//////////////////////////////////////////////////////////////////////////
//////////////////////////Награда для топ 3-100//////////////////////////
$u = mysql_query('SELECT * FROM `invasion_member` WHERE `invasion`= "'.$invasion['id'].'" ORDER BY `uron` DESC LIMIT 100');
while($row = mysql_fetch_array($u)) {
$i++;
if($i <= 3) {//Награда для ТОП-3
echo' '.$row['user'].' ';
$w = mysql_fetch_array(mysql_query('SELECT * FROM `shop` WHERE `quality` = "5" ORDER BY RAND() LIMIT 3'));

/*if(mysql_num_rows(mysql_query('SELECT * FROM `inv` WHERE `place` = \'0\' AND `user` = \''.$user['id'].'\'')) + 1 < 20) { //Если в рюкзакуменьше 20-ти вещей*/
mysql_query('INSERT INTO `inv` (`user`,
                                    `item`,
                                    `quality`,
                                    `_str`,
                                    `_vit`,
                                    `_def`) VALUES (\''.$row['user'].'\',
                                                    \''.$w['id'].'\',
                                                    \''.$w['quality'].'\',
                                                    \''.$w['_str'].'\',
                                                    \''.$w['_vit'].'\',
                                                    \''.$w['_def'].'\')'); //Начисляем вещь легендарного качества
  $new_item = mysql_insert_id();
  mysql_query("UPDATE `invasion_member` SET `item`='".$new_item."' WHERE `user`='".$user['id']."' AND `invasion` = '".$invasion['id']."' ");

/*}*/


  $item = mysql_fetch_array(mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w['id'].'"'));
  mysql_query('INSERT INTO `invasion_items` (`invasion`,
                                    `user`,
                                    `item`) VALUES (\''.$invasion['id'].'\',
                                                    \''.$row['user'].'\',
                                                    \''.$item['id'].'\')');
mysql_query('UPDATE `users` SET `g` = `g` + "25000" WHERE `id` = "'.$row['user'].'"'); //Начисляем золото
$text='В сегодняшнем вторжении вы вошли в ТОП-3 '.$new_id.'</br>
Ваша награда [img=20]/images/ico/png/gold.png[/img] 25000 золота и
[img=20]/images/ico/quality/5.png[/img] [url=/item/'.$new_item.'/] '.$item['name'].' [/url]'; //Текст уведомления
mysql_query("INSERT INTO `mail` SET `from`='2',`to`='".$row['user']."',`text`='".$text."',`time`='".time()."'"); //Отправляем уведомление
mysql_query('UPDATE `contacts` SET `time` = \''.time().'\' WHERE `user` = "2" AND `ho` = "'.$row['user'].'" ');  //Оновляем время 
mysql_query('UPDATE `contacts` SET `time` = \''.time().'\' WHERE `ho` = "2" AND `user` = "'.$row['user'].'" ');  //Оновляем время 
}elseif($i <= 100){//Награда для ТОП-100
	echo' '.$row['uron'].' ';
	$w = mysql_fetch_array(mysql_query('SELECT * FROM `shop` WHERE `quality` = "4" ORDER BY RAND() LIMIT 3'));

if(mysql_num_rows(mysql_query('SELECT * FROM `inv` WHERE `place` = \'0\' AND `user` = \''.$user['id'].'\'')) + 1 < 0) { //Если в рюкзакуменьше 20-ти вещей
mysql_query('INSERT INTO `inv` (`user`,
                                    `item`,
                                    `quality`,
                                    `_str`,
                                    `_vit`,
                                    `_def`) VALUES (\''.$row['user'].'\',
                                                    \''.$w['id'].'\',
                                                    \''.$w['quality'].'\',
                                                    \''.$w['_str'].'\',
                                                    \''.$w['_vit'].'\',
                                                    \''.$w['_def'].'\')'); //Начисляем вещь эпического качества
  $new_item = mysql_insert_id();
  mysql_query("UPDATE `invasion_member` SET `item`='".$new_item."' WHERE `user`='".$user['id']."' AND `invasion` = '".$invasion['id']."' ");
}
  $item = mysql_fetch_array(mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w['id'].'"'));

mysql_query('UPDATE `users` SET `g` = `g` + "3000" WHERE `id` = "'.$row['user'].'"'); //Начисляем золото
$text='В сегодняшнем вторжении вы вошли в ТОП-100 '.$new_id.'</br>
Ваша награда [img=20]/images/ico/png/gold.png[/img] 3000 золота и
[img=20]/images/ico/quality/4.png[/img] [url=/item/'.$new_item.'/] '.$item['name'].' [/url]'; //Текст уведомления
mysql_query("INSERT INTO `mail` SET `from`='2',`to`='".$row['user']."',`text`='".$text."',`time`='".time()."'"); //Отправляем уведомление
mysql_query('UPDATE `contacts` SET `time` = \''.time().'\' WHERE `user` = "2" AND `ho` = "'.$row['user'].'" ');  //Оновляем время 
mysql_query('UPDATE `contacts` SET `time` = \''.time().'\' WHERE `ho` = "2" AND `user` = "'.$row['user'].'" ');  //Оновляем время 
}
}


mysql_query("TRUNCATE `invasion_logs`");
mysql_query("INSERT INTO `invasion` SET `time_start`='".$dateStart."',`start`='0',`time_left`='".($dateStart+(60*$invasionTime))."'");//Начинаем вторжение...
header("Location:/invasion/");
exit;
}else{

  $chanse = rand(1,100);
  if($chanse < '35' ) {//Шанс нанести урон у Лорда 35%
mysql_query("UPDATE `invasion_member` SET `vit`=`vit`-'".$boss_atk."' WHERE `user`='".$user['id']."' AND `invasion` = '".$invasion['id']."' ");
$log = '<span class="red">Предводитель разбойников</span> ударил Вас на '.$boss_atk.'!</span>';
mysql_query("INSERT INTO `invasion_logs` SET `time`='".time()."',`text`='".$log."',`invasion`='".$invasion['id']."',`user`='".$user['id']."'");
  }
mysql_query("UPDATE `invasion_mobs` SET `hp`=`hp`-'".$my_attack."' WHERE `type`='boss'");
mysql_query("UPDATE `invasion_member` SET `uron`=`uron`+'".$my_attack."' WHERE `user`='".$user['id']."' AND `invasion` = '".$invasion['id']."' ");
$log = 'Вы ударили <span class="red">Лорда командующего</span> нанеся '.$my_attack.'!</span>';
mysql_query("INSERT INTO `invasion_logs` SET `time`='".time()."',`text`='$log',`invasion`='".$invasion['id']."',`user`='".$user['id']."'");
header('Location:/invasion/');
exit;} 

}

			
/////////////////////////// UPD cooldown////////	
}else{ //Если игрок жахает по кнопкам со скоростью Formula-1
$log = '<span class="white">Вы промахнулись</span></span>';
mysql_query("INSERT INTO `invasion_logs` SET `time`='".time()."',`text`='".$log."',`invasion`='".$invasion['id']."',`user`='".$user['id']."'");
header("Location:/invasion/");
exit;}

}
        //////////////////////////////////////////////////////////////////////////

		/////////////////////////////////////////////////////////////////////////
        ////////////////////////////////Интерфейс боя.
        ////////////////////////////////////////////////////////////////////////
	if ($mobsCounter > 0){

	if($invasionMember['target'] == 0){
$enemy = mysql_fetch_assoc(mysql_query("SELECT * FROM `invasion_mobs` WHERE `dead`='0' and `invasion`='".$invasion['id']."' ORDER BY RAND()"));						
mysql_query("UPDATE `invasion_member` SET `target`='".$enemy['id']."' WHERE `user`='".$user['id']."'");
header("Location:/invasion/");
exit;}
				
			
	$enemy = mysql_fetch_assoc(mysql_query("SELECT * FROM `invasion_mobs` WHERE `id`='".$invasionMember['target']."' and `invasion`='".$invasion['id']."'"));
	$hp_progress_bot = round(100 / ($enemy['max_hp'] / $enemy['hp']));
	$hp_progress_user = round(100/(($user['vit']*4)/$user['hp']));


echo '<div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Вторжение
    </div>
   </div>
  </div> 
  <div class="bdr bg_red">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="fl ml10 mt10"> 
            <div class="imcon1">
             <div class="idblck12">
              <a class="nd" href="?attack=mob"><img src="/images/invasion/Разбойник.png"></a>
             </div>
            </div> 
           </div> 
           <div class="ml68 mt10 mb10 mr10 sh"> 
            <span class="lwhite tdn">Разбойник</span> 
            <div class="small mb2"> 
             <span class="fr rdmg"></span> 
             <span class="lorange"> <img src="http://144.76.127.94/view/image/icons/strength.png" class="va_t" height="16" width="16" alt=""> '._string(_num($enemy['str'])).' <img src="http://144.76.127.94/view/image/icons/health.png" class="va_t" height="16" width="16" alt=""> '._string(_num($enemy['hp'])).' <img src="http://144.76.127.94/view/image/icons/defense.png" class="va_t" height="16" width="16" alt=""> '._string(_num($enemy['def'])).' </span> 
            </div> 
            <div class="prg-bar fght">
             <div class="prg-green fl" style="width:100%;"></div>
             <div class="prg-red fl" style="width:0%;"></div>
            </div>
           </div> 
           <div class="clb"></div> 
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div> 
  <div class="aablock6">
   <div class="aeblck19">
    <div class="cntr">
     <a href="?attack=mob" class="ubtn inbl mt-15 red mb2"><span class="ul"><span class="ur">Атаковать</span></span></a>
    </div>
   </div>
  </div>
  
  <div class="bdr bg_blue mb2">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="fl ml10 mt10"> ';
 
  if($user['sex'] == '0'){
     echo' <img src="/images/user/0.png" alt="user" width="40">';}
  if($user['sex'] == '1'){
     echo' <img src="/images/user/1.png" alt="user" width="40">';}
         echo '</div> 
           <div class="ml68 mt10 mb10 mr10 sh"> 
            <div class="cqcont1">
             <div class="ceblck26">
              <span class="lwhite tdn"><a class="nd" href="?attack=mob">'.$user['login'].'</a></span>
             </div>
            </div>
            
            <div class="small mb2"> 
             <span class="fr rdmg"></span> 
             <span class="lorange"> <img src="http://144.76.127.94/view/image/icons/strength.png" class="va_t" height="16" width="16" alt=""> '.$user['str'].' <img src="http://144.76.127.94/view/image/icons/health.png" class="va_t" height="16" width="16" alt="">  '._string(_num($invasionMember['vit'])).' <img src="http://144.76.127.94/view/image/icons/defense.png" class="va_t" height="16" width="16" alt=""> '.$user['def'].' </span> 
            </div> 
            <div class="prg-bar fght">
             <div class="prg-green fl" style="width:100%;"></div>
             <div class="prg-red fl" style="width:0%;"></div>
            </div>
           </div> 
          </div> 
          <div class="clb"></div> 
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div> 
  <div class="hr_g mb2">
   <div>
    <div></div>
   </div>
  </div> 
  
  
   <div>
    <div></div>
   </div>
  </div> 
  
   <div>
    <div></div>
   </div>
  </div> ';

/*
  echo' <div class="empty_block">
<table align="center"> <tbody><tr>
 <td style="width:33%;">
 <span style="float:right;"> <b>Вы</b> </span> <br>
 <span style="float:right;"> <img src="/images/ico/png/hp.png" alt="hp" width="15"> '._string(_num($invasionMember['vit'])).' </span>               
</td><td> ';
  if($user['sex'] == '0'){
     echo' <img src="/images/user/man.png" alt="user" width="48">';}
  if($user['sex'] == '1'){
     echo' <img src="/images/user/woman.png" alt="user" width="48">';}
     echo'<td>
<td> <img src="'.$HOME.'/images/invasion/bot'.$enemy['img'].'.png" alt="*" width="48"> </td>
<td style="width:33%;">
    <span style="float:left;"> <b>Враг</b> id'.$enemy['id'].' </span> <br>
    <span style="float:left;"> <img src="/images/ico/png/hp.png" alt="hp" width="15"> '._string(_num($enemy['hp'])).'  </span> 
</td></tr>
</tbody></table>
</div> ';
echo' <div class="block_link">
 <a href="?attack=mob"><img src="/images/ico/png/attack.png" width="15"> Атаковать </a> </div>
 <div class="line"></div>';
echo' <div class="block_link">
 <a href="?last=mob"><img src="/images/ico/png/attack.png" width="15"> Сменить противника </a> </div>
 <div class="line"></div>';
			*/

			}



			if ($boss)
			{
	$enemy =&$boss;
	$hp_progress_bot = round(100 / ($enemy['max_hp'] / $enemy['hp']));
	$hp_progress_user = round(100/(($user['vit']*4)/$user['hp']));















echo '<div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Вторжение
    </div>
   </div>
  </div> 
  <div class="bdr bg_red">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="fl ml10 mt10"> 
            <div class="imcon1">
             <div class="idblck12">
              <a class="nd" href="?attack=boss"><img src="/images/invasion/Предводитель.png"></a>
             </div>
            </div> 
           </div> 
           <div class="ml68 mt10 mb10 mr10 sh"> 
            <span class="lwhite tdn">Предводитель разбойников</span> 
            <div class="small mb2"> 
             <span class="fr rdmg"></span> 
             <span class="lorange"> <img src="http://144.76.127.94/view/image/icons/strength.png" class="va_t" height="16" width="16" alt=""> '._string(_num($boss['str'])).' <img src="http://144.76.127.94/view/image/icons/health.png" class="va_t" height="16" width="16" alt=""> '._string(_num($boss['hp'])).' <img src="http://144.76.127.94/view/image/icons/defense.png" class="va_t" height="16" width="16" alt=""> '._string(_num($boss['def'])).' </span> 
            </div> 
            <div class="prg-bar fght">
             <div class="prg-green fl" style="width:100%;"></div>
             <div class="prg-red fl" style="width:0%;"></div>
            </div>
           </div> 
           <div class="clb"></div> 
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div> 
  <div class="aablock6">
   <div class="aeblck19">
    <div class="cntr">
     <a href="?attack=boss" class="ubtn inbl mt-15 red mb2"><span class="ul"><span class="ur">Атаковать</span></span></a>
    </div>
   </div>
  </div>
  
  <div class="bdr bg_blue mb2">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="fl ml10 mt10"> ';
  if($user['sex'] == '0'){
     echo' <img src="/images/user/man.png" alt="user" width="48">';}
  if($user['sex'] == '1'){
     echo' <img src="/images/user/woman.png" alt="user" width="48">';}
           echo '</div> 
           <div class="ml68 mt10 mb10 mr10 sh"> 
            <div class="cqcont1">
             <div class="ceblck26">
              <span class="lwhite tdn"><a class="nd" href="?attack=boss">'.$user['login'].'</a></span>
             </div>
            </div>
            
            <div class="small mb2"> 
             <span class="fr rdmg"></span> 
             <span class="lorange"> <img src="http://144.76.127.94/view/image/icons/strength.png" class="va_t" height="16" width="16" alt=""> '.$user['str'].' <img src="http://144.76.127.94/view/image/icons/health.png" class="va_t" height="16" width="16" alt="">  '._string(_num($invasionMember['vit'])).' <img src="http://144.76.127.94/view/image/icons/defense.png" class="va_t" height="16" width="16" alt=""> '.$user['def'].' </span> 
            </div> 
            <div class="prg-bar fght">
             <div class="prg-green fl" style="width:100%;"></div>
             <div class="prg-red fl" style="width:0%;"></div>
            </div>
           </div> 
          </div> 
          <div class="clb"></div> 
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div> 
  <div class="hr_g mb2">
   <div>
    <div></div>
   </div>
  </div> 
  
  
   <div>
    <div></div>
   </div>
  </div> 
  
   <div>
    <div></div>
   </div>
  </div> ';


































/*
echo '<div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Вторжение
    </div>
   </div>
  </div> 
  <div class="bdr bg_red">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="fl ml10 mt10"> 
            <div class="iqcont9">
             <div class="iabtn29">
              <a class="nd" href="?attack=boss"><img src="/images/invasion/Предводитель.png"></a>
             </div>
            </div>
            <div class="imcon8">
             <div class="ieblck19">
             </div>
            </div>
            <div class="iqcont4">
             <div class="ieblck29">
             </div>
            </div>
            <div class="imcon1">
             <div class="idblck12">
             </div>
            </div> 
           </div> 
           <div class="ml68 mt10 mb10 mr10 sh"> 
            <span class="lwhite tdn">Предводитель разбойников</span> 
            <div class="small mb2"> 
             <span class="fr rdmg"></span> 
             <span class="lorange"> <img src="http://144.76.127.94/view/image/icons/strength.png" class="va_t" height="16" width="16" alt="">  '._string(_num($boss['str'])).' <img src="http://144.76.127.94/view/image/icons/health.png" class="va_t" height="16" width="16" alt="">  '._string(_num($boss['hp'])).' <img src="http://144.76.127.94/view/image/icons/defense.png" class="va_t" height="16" width="16" alt="">  '._string(_num($boss['def'])).' </span> 
            </div> 
            <div class="prg-bar fght">
             <div class="prg-green fl" style="width:100%;"></div>
             <div class="prg-red fl" style="width:0%;"></div>
            </div>
           </div> 
           <div class="clb"></div> 
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div> 
<br>  <div class="aqcont1">
   <div class="acbtn5">
    <div class="cntr">
     <a href="?attack=boss" class="ubtn inbl mt-15 red mb2"><span class="ul"><span class="ur">Атаковать</span></span></a>
    </div>
   </div>
  </div> 
  <div class="bdr bg_blue mb2">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="fl ml10 mt10"> ';
if($user['sex'] == '0'){
     echo' 
     <img src="/images/user/man.png" alt="user" width="48">
     ';}
  if($user['sex'] == '1'){
     echo' <img src="/images/user/woman.png" alt="user" width="48">';}
           echo '</div> 
           <div class="ml68 mt10 mb10 mr10 sh"> 
            <div class="cqcont1">
             <div class="ceblck26">
              <span class="lwhite tdn"><a class="nd" href="?attack=boss">'.$user['login'].'</a></span>
             </div>
            </div>
            </div> 
            <div class="small mb2"> 
             <span class="fr rdmg"></span> 
             <span class="lorange"> <img src="http://144.76.127.94/view/image/icons/strength.png" class="va_t" height="16" width="16" alt=""> '.$user['str'].' <img src="http://144.76.127.94/view/image/icons/health.png" class="va_t" height="16" width="16" alt=""> '._string(_num($invasionMember['vit'])).'  <img src="http://144.76.127.94/view/image/icons/defense.png" class="va_t" height="16" width="16" alt=""> '.$user['def'].' </span> 
            </div> <br>
            <div class="prg-bar fght">
             <div class="prg-green fl" style="width:100%;"></div>
             <div class="prg-red fl" style="width:0%;"></div>
            </div>
           </div> 
          </div> 
          <div class="clb"></div> 
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div> 
   <div>
    <div></div>
   </div>
  </div> 
  <div class="bntf">
   <div class="small">
    <div class="nl">
     </div>
    </div>
   </div>
  </div> 
   <div>
    <div></div>
   </div>
  </div> 
   <div>
    <div></div>
   </div>
  </div> ';
  
  */
  /*

  echo' <div class="empty_block">
<table align="center"> <tbody><tr>
 <td style="width:33%;">
 <span style="float:right;"> <b>Вы</b> </span> <br>
 <span style="float:right;"> <img src="/images/ico/png/hp.png" alt="hp" width="15"> '._string(_num($invasionMember['vit'])).' </span>               
</td><td> ';
  if($user['sex'] == '0'){
     echo' <img src="/images/user/man.png" alt="user" width="48">';}
  if($user['sex'] == '1'){
     echo' <img src="/images/user/woman.png" alt="user" width="48">';}
     echo'<td>
<td> <img src="'.$HOME.'/images/invasion/lord.png" alt="*" width="48"> </td>
<td style="width:33%;">
    <span style="float:left;"> <b>Предводитель разбойников</b> </span> <br>
    <span style="float:left;"> <img src="/images/ico/png/hp.png" alt="hp" width="15"> '._string(_num($boss['hp'])).'  </span> 
</td></tr>
</tbody></table>
</div> ';
echo' <div class="block_link">
 <a href="?attack=boss"><img src="/images/ico/png/attack.png" width="15"> Атаковать </a> </div>
 <div class="line"></div>';
*/
}






			
echo '<div class="bdr bg_blue mb2">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8">
<div class="bntf">
   <div class="small">
    <div class="nl">
     <div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">

          ';

$logs=mysql_query("SELECT * FROM `invasion_logs` WHERE `invasion`='".$invasion['id']."' AND `user` = '".$user['id']."' OR `user` = '0' AND `invasion`='".$invasion['id']."' ORDER BY `id` DESC LIMIT 16");
if(mysql_num_rows($logs)=='0'){
echo'<font color="lime">Вторжение началось</font>';
}elseif (mysql_num_rows($logs)>0) {
while ($log=mysql_fetch_array($logs)) {
echo''.$log['text'].'</br>';
			}	
	}
echo'
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="line"></div>';
			
		






				/**
				 * Attack mob!
				 * @var [type]
				 */
			// Если мы хотим поменять цель.
if (isset($_GET['last'])){
$last = htmlspecialchars(trim($_GET['last']));
if ($last == 'mob'){//Меняем противникп
$enemy = mysql_fetch_assoc(mysql_query("SELECT * FROM `invasion_mobs` WHERE `dead`='0' and `invasion`='".$invasion['id']."' ORDER BY RAND()"));		
mysql_query("UPDATE `invasion_member` SET `target`='".$enemy['id']."' WHERE `user`='".$user['id']."'");
}
header('Location:/invasion/');
}
		
		
			


		}







	}else{ //Если не участвует и она началась	 
echo'
<div class="title">'.$title.'</div>

<div class="empty_block item_center">
  <img src="/images/invasion/logo.png" alt="*"/></br>
  Вы опоздали, вторжение уже идёт! 
<center> <div class="button2"> '.$to_end.':'.$to_ends.' мин. </div> </center>
</div>
<div class="line"></div>';
}





}



include './system/f.php';
?>