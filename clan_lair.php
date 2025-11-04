<? 
include './system/common.php';
include './system/functions.php';
include './system/user.php';
if(!$user) {
header('location: /');   
exit;}



$lair_mobs = mysql_fetch_assoc(mysql_query("SELECT * FROM `clan_lair_boss` WHERE `clan` = '".$clan['id']."' AND `dead` = '0' ")); 
$lair = mysql_fetch_assoc(mysql_query("SELECT * FROM `clan_lair` WHERE `id`='".$lair_mobs['lair']."' ")); 
$lair_users = mysql_fetch_assoc(mysql_query("SELECT * FROM `clan_lair_memb` WHERE `user`='".$user['id']."' ")); 

if($lair_users['vit'] <= '0' OR $lair_users['dead'] == '1'){//Если вы мертвы
if($lair_users['time'] <= time() AND $lair_users['dead'] == '1'){//Обновляем параметры если вы зашли
mysql_query("DELETE FROM `clan_lair_logs` WHERE `user` = '".$user['id']."'");
mysql_query("UPDATE `clan_lair_memb` SET `str`='".$user['str']."', `vit`='".$user['vit']."', `def`='".$user['def']."', `time`='0', `dead`='0' WHERE `user`='".$user['id']."' ");
header('Location:/clan_lair');
exit;}
}

$title = ''.$lair['gde'].'';
include './system/h.php'; 

/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
$us_p = round(100/($lair_user[vit]/$start['user_hp']));
    if($us_p > 100) {
        $us_p = 100;
    }
 $opp_p = round(100/($lair_mobs[vit]/$start['lair_vit']));
    if($opp_p > 100) {
        $opp_p = 100;
    }
     



$memb = mysql_fetch_assoc(mysql_query("SELECT * FROM `clan_memb` WHERE `user`='".$user['id']."' ")); 
$time=$memb['time']+0*0;//Если больше 1-го дня в клане

$clan_lair_boss = mysql_fetch_assoc(mysql_query("SELECT * FROM `clan_lair_boss` WHERE `clan`='".$memb['clan']."'  ")); 

if(!$clan_lair_boss){//если нет дракона или он убит
header('location: /');   
exit;}

if(!$lair_users OR $time > time() ){//Если бой не начат
	
	if(isset($_REQUEST['start'])){		
	mysql_query("DELETE FROM `clan_lair_logs` WHERE `user` = '".$user['id']."'");
	mysql_query("INSERT INTO `clan_lair_memb` SET `clan`='".$clan['id']."', `user`='".$user['id']."', `str`='".$user['str']."', `vit`='".$user['vit']."', `def`='".$user['def']."', `time`='0' ");
	header('Location:/clan_lair');
	exit;} 
	
$memb = mysql_fetch_assoc(mysql_query("SELECT * FROM `clan_memb` WHERE `user`='".$user['id']."' ")); 
$time=$memb['time']+0*0;//Если больше 1-го дня в клане
	echo'<div class="ribbon mb2"><div class="rl"><div class="rr">
	'.$lair['gde2'].'</div></div></div>
	 
	<div class="bdr bg_blue mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="ml10 mt5 mr10 mb5 cntr">
	<img src="/images/ico/clan_lair/dragon'.$lair['id'].'_nowin.jpg" alt="*"> </br>
	'.($time < time() ? 'Но вход охраняет '.$lair['name'].'. У вашего клана 30 часов чтобы убить дракона и захватить сокровища, пока портал не закрылся.	
	</br><br>

	<a href="?start" class="ubtn inbl green mb5 mt-15 w50"><span class="ul"><span class="ur">Начать бой</span></span></a>
':'
	<font color="#FF2400">
	Биться с драконом могут лишь игроки пробывшие в клане 7 дней и более. </br>
	</font> ').'
	</div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div>
	<div class="line"></div>';
include './system/f.php';	
exit;}	
//////////////////////////////////////////////////
/////////////////////////////////////////////////





  

  








//////////////////////////////////////////////////
/////////////////////////////////////////////////

if($lair_mobs['vit'] <= '0'){//Если босс мертв
if($lair_mobs['vit'] <= '0' AND $lair_mobs['dead'] == '0'){
mysql_query("DELETE FROM `clan_lair_boss` WHERE `id` = '".$lair_mobs['id']."'");
mysql_query("DELETE FROM `clan_lair_memb` WHERE `clan` = '".$clan['id']."'");
}else{
header('location: /');   
exit;}	



	echo'<div class="bdr bg_red mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="ml10 mt5 mr10 mb5 cntr">
	Дракон убит и сокровища захвачены! </br>
	</font> 
	<font color="#7afe4e">Награда: </font> 
    <img src="/images/ico/png/gold.png" width=20 class=icon> '.n_f($lair['clan_gold']).'
	<img src="/images/ico/png/silver.png" width=20 class=icon> '.n_f($lair['clan_silver']).'
	<img src="/images/ico/png/exp.png" width=20 class=icon> '.n_f($lair['clan_exp']).' 
	</center>';
	
$w_1 = mysql_fetch_array(mysql_query('SELECT * FROM `inv` WHERE `id` = \''.$lair_users['nagrada_item_1'].'\''));
$item_1 = mysql_fetch_array(mysql_query('SELECT * FROM `items` WHERE `id` = \''.$w_1['item'].'\''));
  
  $quality = [	'1'=>'Обычный',
				'2'=>'Необычный',
				'3'=>'Редкий',
				'4'=>'Эпический',
				'5'=>'Легендарный',
				'6'=>'Мифический'
		];
$quality_color=['1'=>'#999999',
				'2'=>'#B1D689',
				'3'=>'#6BA0E7',
				'4'=>'#C780DB',
				'5'=>'#FF8E94',
				'6'=>'#FE7E01'
		];
  

$equip_item = mysql_query('SELECT * FROM `inv` WHERE `id` = "'.$user['w_'.$item_1['w']].'"');
$equip_item = mysql_fetch_array($equip_item);
    $diff = 0;
  if($w_1['_str'] > $equip_item['_str']) { 
$diff += $w_1['_str'] - $equip_item['_str'];
}
    if($w_1['_vit'] > $equip_item['_vit']) {
$diff += $w_1['_vit'] - $equip_item['_vit'];
}
    if($w_1['_def'] > $equip_item['_def']) {
      $diff += $w_1['_def'] - $equip_item['_def'];
}


  if(($w_1['_str'] + $w_1['_vit'] + $w_1['_def']) - ($equip_item['_str'] + $equip_item['_vit'] + $equip_item['_def']) > 0) {
$ddd='<font color="#3c3">+'.$diff.'</font> </small>';
  }
echo '
<table cellpadding="0" cellspacing="0">
<tr>
<td width="15%"><img src="/images/items/'.$w_1['item'].'.png" alt="*"/></td>
<td>
<img src="/images/ico/quality/'.$w_1['quality'].'.png" alt="*"/> <a href="/item/'.$w_1['id'].'/"> '.$item_1['name'].' </a>
<br/><small>
<font color="#'.(($user['level'] < $item_1['level']) ? 'c06060':'ffffff').'"><img src="/images/ico/png/up.png" alt="*" width="12"/>'.$item_1['level'].' ур, </font>
<font color="'.$quality_color[$w_1['quality']].'"> '.$quality[$w_1['quality']].' </font>
'.$ddd.'
</td></tr></table>';



$w_2 = mysql_fetch_array(mysql_query('SELECT * FROM `inv` WHERE `id` = \''.$lair_users['nagrada_item_2'].'\''));
$item_2 = mysql_fetch_array(mysql_query('SELECT * FROM `items` WHERE `id` = \''.$w_2['item'].'\''));
  
  $quality = [	'1'=>'Обычный',
				'2'=>'Необычный',
				'3'=>'Редкий',
				'4'=>'Эпический',
				'5'=>'Легендарный',
				'6'=>'Мифический'
		];
$quality_color=['1'=>'#999999',
				'2'=>'#B1D689',
				'3'=>'#6BA0E7',
				'4'=>'#C780DB',
				'5'=>'#FF8E94',
				'6'=>'#FE7E01'
		];
  

  

$equip_item = mysql_query('SELECT * FROM `inv` WHERE `id` = "'.$user['w_'.$item_2['w']].'"');
$equip_item = mysql_fetch_array($equip_item);
    $diff = 0;
  if($w_2['_str'] > $equip_item['_str']) { 
$diff += $w_2['_str'] - $equip_item['_str'];
}
    if($w_2['_vit'] > $equip_item['_vit']) {
$diff += $w_2['_vit'] - $equip_item['_vit'];
}
    if($w_2['_def'] > $equip_item['_def']) {
      $diff += $w_2['_def'] - $equip_item['_def'];
}


  if(($w_2['_str'] + $w_2['_vit'] + $w_2['_def']) - ($equip_item['_str'] + $equip_item['_vit'] + $equip_item['_def']) > 0) {
$ddd='<font color="#3c3">+'.$diff.'</font> </small>';
  }
echo '
<table cellpadding="0" cellspacing="0">
<tr>
<td width="15%"><img src="/images/items/'.$w_2['item'].'.png" alt="*"/></td>
<td>
<img src="/images/ico/quality/'.$w_2['quality'].'.png" alt="*"/> <a href="/item/'.$w_2['id'].'/"> '.$item_2['name'].' </a>
<br/><small>
<font color="#'.(($user['level'] < $item_2['level']) ? 'c06060':'ffffff').'"><img src="/images/ico/png/up.png" alt="*" width="12"/>'.$item_2['level'].' ур, </font>
<font color="'.$quality_color[$w_2['quality']].'"> '.$quality[$w_2['quality']].' </font>
'.$ddd.'
</td></tr></table>';
	
	echo'	<div class="clb"></div>
</div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div>';
	
	



////////////////////////////  

include './system/f.php';	
exit;}	
//////////////////////////////////////////////////
/////////////////////////////////////////////////


//////////////////////////////////////////////////
/////////////////////////////////////////////////

if($lair_users['vit'] <= '0'){//Если вы мертвы
if($lair_users['dead'] == '0'){
mysql_query("UPDATE `clan_lair_memb` SET `dead`='1', `time`='".(time()+3600)."' WHERE `user`='".$user['id']."' ");	
}




echo '  <div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      '.$lair['name'].'
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
           <div class="ml10 mt5 mr10 mb5 cntr"> 
          <td style="width:13%;"> <img src="/images/ico/clan_lair/dragon'.$lair['id'].'_nowin.jpg" alt="*" width="48"> </td>
           </div> 
           <div class="mrauto w160px"> 
            <div class="mr10 sh"> 
Атака: <img src="/images/ico/png/attack.png" alt="hp" width="15"> '._string(_num($lair_mobs['str'])).'
            </div> 
            <div class="mr10 sh"> 
Здоровье:	 <img src="/images/ico/png/hp.png" alt="hp" width="15"> '._string(_num($lair_mobs['vit'])).'
            </div> 
            <div class="mr10 sh"> 
Защита:  <img src="/images/ico/png/def.png" alt="hp" width="15"> '._string(_num($lair_mobs['def'])).'  	 
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
  
  
  
  

include './system/f.php';	
exit;}	
//////////////////////////////////////////////////
/////////////////////////////////////////////////




	if($_GET['attack'] == true){//Система боя

$my_attack = round(rand($lair_users['str'] * 3.0 * 0.40,$lair_users['str'] * 2.5 * 0.40) - ($lair_mobs['def'] / 5 * 0.60));
if($my_attack <= '0'){ $my_attack = 5;}
$lair_attack = round(rand($lair_mobs['str'] * 2.5 * 0.35,$lair_mobs['str'] * 2.2 * 0.35) - ($lair_umobs['def'] / 5 * 0.60) );
/*if($lair_attack <= '0'){ $lair_attack = 5;}*/

if($my_attack >= $lair_mobs['vit']){//даем награду за убивство
	

$u = mysql_query('SELECT * FROM `clan_lair_memb` WHERE `clan` = "'.$memb['clan'].'"  LIMIT 100');
while($row = mysql_fetch_array($u)) {
echo' '.$row['user'].' ';

if($lair['id'] == '1'){$item_quality=4;}//Качесто выпадаемых вещей
if($lair['id'] == '2'){$item_quality=4;}//Качесто выпадаемых вещей
if($lair['id'] == '3'){$item_quality=5;}//Качесто выпадаемых вещей
if($lair['id'] == '4'){$item_quality=5;}//Качесто выпадаемых вещей
if($lair['id'] == '5'){$item_quality=6;}//Качесто выпадаемых вещей
if($lair['id'] == '6'){$item_quality=6;}//Качесто выпадаемых вещей

$w_1 = mysql_fetch_array(mysql_query('SELECT * FROM `shop` WHERE `quality` = "'.$item_quality.'" ORDER BY RAND()'));
$w_2 = mysql_fetch_array(mysql_query('SELECT * FROM `shop` WHERE `quality` = "'.$item_quality.'" ORDER BY RAND()'));
/*if(mysql_num_rows(mysql_query('SELECT * FROM `inv` WHERE `place` = \'0\' AND `user` = \''.$user['id'].'\'')) + 1 < 20) { //Если в рюкзакуменьше 20-ти вещей*/
mysql_query('INSERT INTO `inv` (`user`,
                                    `item`,
                                    `quality`,
                                    `_str`,
                                    `_vit`,
                                    `_def`) VALUES (\''.$row['user'].'\',
                                                    \''.$w_1['id'].'\',
                                                    \''.$w_1['quality'].'\',
                                                    \''.$w_1['_str'].'\',
                                                    \''.$w_1['_vit'].'\',
                                                    \''.$w_1['_def'].'\')'); //Начисляем вещь легендарного качества
  $new_item_1 = mysql_insert_id();//1-я шмотка
  
  mysql_query('INSERT INTO `inv` (`user`,
                                    `item`,
                                    `quality`,
                                    `_str`,
                                    `_vit`,
                                    `_def`) VALUES (\''.$row['user'].'\',
                                                    \''.$w_2['id'].'\',
                                                    \''.$w_2['quality'].'\',
                                                    \''.$w_2['_str'].'\',
                                                    \''.$w_2['_vit'].'\',
                                                    \''.$w_2['_def'].'\')'); //Начисляем вещь легендарного качества
  $new_item_2 = mysql_insert_id();//2-я шмотка
  mysql_query("UPDATE `clan_lair_memb` SET `nagrada_item_1`='".$new_item_1."', `nagrada_item_2`='".$new_item_2."' WHERE `user`='".$row['user']."' ");

/*}*/


  $item_1 = mysql_fetch_array(mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_1['id'].'"'));
  $item_2 = mysql_fetch_array(mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_2['id'].'"'));

$nagrada_gold=$lair['clan_gold']*1;
$nagrada_silver=$lair['clan_silver']*1;
$nagrada_exp=$lair['clan_silver']*1;



mysql_query('UPDATE `users` SET `g` = `g` + '.$nagrada_gold.', `s` = `s` + '.$nagrada_silver.', `exp` = `exp` + '.$nagrada_exp.' WHERE `id` = "'.$row['user'].'"'); //Начисляем награду
mysql_query('UPDATE `clans` SET `g` = `g` + '.$nagrada_gold.', `s` = `s` + '.$nagrada_silver.', `exp` = `exp` + '.$nagrada_exp.' WHERE `id` = "'.$row['clan'].'"'); //Начисляем награду
mysql_query("UPDATE `clan_lair_memb` SET `nagrada_gold`='".$nagrada_gold."', `nagrada_silver`='".$nagrada_silver."', `nagrada_exp`='".$nagrada_exp."' WHERE `user`='".$row['user']."' ");

  $text=' '.$lair['name'].' убит и его сокровища захвачены. Награда!</br>

             [img=20]/images/ico/png/gold.png[/img] '.$nagrada_gold.' золота<br>
			 [img=20]/images/ico/png/silver.png[/img] '.$nagrada_exp.' серебра<br>
			 [img=20]/images/ico/png/exp.png[/img] '.$nagrada_exp.' опыта </br></br>
[img=20]/images/ico/quality/'.$item_quality.'.png[/img] [url=/item/'.$new_item_1.'/] '.$item_1['name'].' [/url]<br>
[img=20]/images/ico/quality/'.$item_quality.'.png[/img] [url=/item/'.$new_item_2.'/] '.$item_2['name'].' [/url]'; //Текст уведомления
mysql_query("INSERT INTO `mail` SET `from`='2',`to`='".$row['user']."',`text`='".$text."',`time`='".time()."'"); //Отправляем уведомление
mysql_query('UPDATE `contacts` SET `time` = \''.time().'\' WHERE `user` = "2" AND `ho` = "'.$row['user'].'" ');  //Оновляем время 
mysql_query('UPDATE `contacts` SET `time` = \''.time().'\' WHERE `ho` = "2" AND `user` = "'.$row['user'].'" ');  //Оновляем время 


}
}


$log = 'Вы ударили '.$lair['name2'].'  на <span class="red">'.$my_attack.'</span> </br>
'.$lair['name'].' ударил вас на <span class="red">'.$lair_attack.'</span>';
mysql_query("INSERT INTO `clan_lair_logs` SET `user`='".$user['id']."', `text`='".$log."', `time`='".time()."'");

	if($lair_users['vit'] <= $lair_attack){//Если вы мертвы
	$lair_attack=$lair_users['vit'];
	$log_dead = '<span class="red">'.$lair['name'].' убил вас</span>';\
	mysql_query("INSERT INTO `clan_lair_logs` SET `user`='".$user['id']."', `text`='".$log_dead."', `time`='".time()."'");
	}
	
mysql_query("UPDATE `clan_lair_boss` SET `vit`=`vit`-'".$my_attack."' WHERE `clan`='".$clan['id']."' ");
mysql_query("UPDATE `clan_lair_memb` SET `vit`=`vit`-'".$lair_attack."', `dmg`=`dmg`+'".$my_attack."', `udarov`=`udarov`+'1'  WHERE `user`='".$user['id']."' ");
header('Location:/clan_lair');
exit;} 




echo '  <div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
'.$lair['gde'].'
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
<td> <img src="/images/ico/clan_lair/dragon'.$lair['id'].'_nowin.jpg" alt="*" width="48"> </td>
           </div> 
           <div class="ml68 mt10 mb10 mr10 sh"> 
            <span class="lwhite tdn">'.$lair['name'].'</span> 
            <div class="small mb2"> 
             <span class="fr rdmg"></span> 
             <span class="lorange"> <img src="http://144.76.127.94/view/image/icons/strength.png" class="va_t" height="16" width="16" alt="">     '._string(_num($lair_mobs['str'])).'  <img src="http://144.76.127.94/view/image/icons/health.png" class="va_t" height="16" width="16" alt="">     '._string(_num($lair_mobs['vit'])).'   <img src="http://144.76.127.94/view/image/icons/defense.png" class="va_t" height="16" width="16" alt="">     '._string(_num($lair_mobs['def'])).'   </span> 
            </div> <br>
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
  </div> <br>
  <div class="cntr">
   <a href="?attack=true" class="ubtn inbl mt-15 red mb2"><span class="ul"><span class="ur">Атаковать</span></span></a>
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
           <div class="fl ml10 mt10">';
  if($user['sex'] == '0'){ 
      echo' <img src="/images/user/0.png" alt="user" width="48">';}
      if($user['sex'] == '1'){
          echo' <img src="/images/user/1.png" alt="user" width="48">';}
           echo '</div> 
           <div class="ml68 mt10 mb10 mr10 sh"> 
            <span class="lwhite tdn">'.$user['login'].'</span> 
            <div class="small mb2"> 
             <span class="fr rdmg"></span> 
             <span class="lorange"> <img src="http://144.76.127.94/view/image/icons/strength.png" class="va_t" height="16" width="16" alt=""> '.$user['str'].' <img src="http://144.76.127.94/view/image/icons/health.png" class="va_t" height="16" width="16" alt="">  '._string(_num($lair_users['vit'])).' <img src="http://144.76.127.94/view/image/icons/defense.png" class="va_t" height="16" width="16" alt=""> '.$user['def'].'</span> 
            </div><br>
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
   <div>
    <div></div>
   </div>
  </div>';

  
  
  
  
  

echo'</div><div class="line"></div>';

include './system/f.php';
?>