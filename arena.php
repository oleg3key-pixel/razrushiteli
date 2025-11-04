<?
include './system/common.php';   
include './system/functions.php';     
include './system/user.php';
    
if(!$user) {
header('location: /');   
exit;}
    
$title = 'Арена';
include './system/h.php';  


if(mysql_result(mysql_query('SELECT * FROM `arena` WHERE `user` = "'.$user['id'].'"'),0) == 0) {
mysql_query('INSERT INTO `arena` (`user`) VALUES ("'.$user['id'].'")');
}

    $arena = mysql_query('SELECT * FROM `arena` WHERE `user` = "'.$user['id'].'"');
    $arena = mysql_fetch_array($arena);
 echo' '.$_SESSION['mes1'].' '.$_SESSION['mes2'].' '.$_SESSION['mes3'].'  </div>
 <div class="line"></div>';

    $_SESSION['mes1']=NULL; //Удаляем сесию
    $_SESSION['mes2']=NULL; //Удаляем сесию
	$_SESSION['mes3']=NULL; //Удаляем сесию
if($arena[attack] <= '0'){
}else{
}




if($arena[attack] <= '0'){

echo '  <div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Арена 
    </div>
   </div>
  </div> 
  <div class="hr_g mb2">
   <div>
    <div></div>
   </div>
  </div>
  <div class="bntf">
   <div class="nl">
    <div class="nr cntr lyell lh1 p5 sh">
    </div>
   </div>
  </div>
   <div>
    <div></div>
   </div>
  <div class="bdr cnr bg_blue cntr">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="ml5 mt5 mb5 sh small"> 
            <img src="http://144.76.127.94/view/image/arena/arena_grey.png" alt="" class="icon"> 15 боев закончились, возвращайтесь через
            <br> '._time($arena['time']-time()).'  чтобы продолжить сражения 
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
  </div> ';
  
  

 


include './system/f.php';
exit;
}

























   if(!$arena['opponent']) {
$opponent = mysql_query('SELECT * FROM `users` WHERE `str` + `vit` + `def` >= "'.(($user['str'] + $user['vit'] + $user['def']) / 2).'" AND `str` + `vit` + `def` <= "'.($user['str'] + $user['vit'] + $user['def']).'" AND `id` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
$opponent = mysql_fetch_array($opponent);
      
  if(!$opponent) {
$opponent = mysql_query('SELECT * FROM `users` WHERE `str` + `vit` + `def` >= "'.(($user['str'] + $user['vit'] + $user['def']) / 2).'" AND `id` != "'.$user['id'].'" OR `str` + `vit` + `def` <= "'.($user['str'] + $user['vit'] + $user['def']).'" AND `id` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
$opponent = mysql_fetch_array($opponent);
}
    
mysql_query('UPDATE `arena` SET `opponent` = "'.$opponent['id'].'" WHERE `user` = "'.$user['id'].'"');
        
}else{
$opponent = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$arena['opponent'].'"');
$opponent = mysql_fetch_array($opponent);
}

  


		
   
		 
   if($_GET['attack'] == true && $arena[attack] > '0') { 

$dmg = _string(mt_rand($user[str] / 3.5,$user[str] / 3) - mt_rand($opponent[def] / 12,$opponent[def] / 9));
if($dmg <= '0'){ $dmg = 2;}
$opponent_dmg = _string(mt_rand($opponent[str] / 3.5,$opponent[str] / 3) - mt_rand($user[def] / 12,$user[def] / 9));
if($opponent_dmg <= '0'){ $opponent_dmg = 2;}   

    if($dmg > $opponent_dmg) { //При победе
    if($_key < 1) {$_key= 1;}

$_s = $user['amulet_silver'] + rand(1,5) + (100 * $user['level'] );           
$_exp = $user['amulet_exp'] + rand(1,5) + (100 * $user['level'] );    
$_SESSION['mes1'] = mes('<center><font color=lime>Победа</font></center>');
}else{//При поражении
$_s = $user['amulet_silver'] + rand(1,5) + (60 * $user['level']);
$_exp = $user['amulet_exp'] + rand(1,5) + (60 * $user['level']);     

$_SESSION['mes1'] = mes('<center><font color=red>Поражение</font></center>');
}

  if($user['trophies_silver']) {$_s+= round($_s/ 100) * $user['trophies_silver'];} //Бонус трофеев
  if($user['trophies_exp']) {$_exp+= round($_exp/ 100) * $user['trophies_exp'];}   //Бонус трофеев
  if($user['b_silver_2']) {$_s+= round($_s/ 100) * $user['b_silver_2'];}   //Бонус трофеев
  if($user['b_exp_2']) {$_exp+= round($_exp/ 100) * $user['b_exp_2'];}   //Бонус трофеев
  if($user['valor_b_silver']) {$_s+= round($_exp/ 100) * $user['valor_b_silver'];}   //Бонус трофеев
  if($user['valor_b_exp']) {$_exp+= round($_exp/ 100) * $user['valor_b_exp'];}   //Бонус трофеев
  if($user['b_valor_2']) {$_valor_exp+= round($_valor_exp/ 100) * $user['b_valor_2'];}   //Бонус трофеев

$_valor_exp = $arena['valor_exp'] + rand(20,20) * $user['b_valor_2'] / 100;  

   
   
  if($_q_1 < 1) {$_q_1 = 1;}

   
       if($clan_memb && $clan_memb['v'] > 0) {  //Верность клану
$_exp += round($_exp/100) * $clan_memb['v'];
}

  if($premium) {$_s+= round($_s/ 100) * 100 ;} //Если премик
  if($premium) {$_exp+= round($_exp/ 100) * 100  ;} //Если премик
  

  
 if($clan) { 
     
         //задания
	   if(date('w') != 0 AND date('w') != 7){
		$clans_q = mysql_fetch_array(mysql_query('SELECT * FROM `clans_q` WHERE `clans` = "'.$clan['id'].'"LIMIT 1'));
		if($clans_q['user_1'] == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_1` = "'.($clans_q['q_1'] >= "1000" ? "1000":($clans_q['q_1'] + $_q_1)).'" WHERE `clans` = "'.$clan['id'].'"');
		}
		if($clans_q['user_2'] == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_2` = "'.($clans_q['q_2'] >= "2500" ? "2500":($clans_q['q_2'] + $_q_1)).'" WHERE `clans` = "'.$clan['id'].'"');
		}
		if($clans_q['user_1_p']  == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_1` = "'.($clans_q['q_1'] >= "1000" ? "1000":($clans_q['q_1'] + $_q_1)).'" WHERE `clans` = "'.$clan['id'].'"');
		}
		if($clans_q['user_2_p'] == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_2` = "'.($clans_q['q_2'] >= "2500" ? "2500":($clans_q['q_2'] + $_q_1)).'" WHERE `clans` = "'.$clan['id'].'"');
		}



		if($clans_q['user_7'] == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_7` = "'.($clans_q['q_7'] >= "1000000" ? "1000000":($clans_q['q_7'] + $_exp)).'" WHERE `clans` = "'.$clan['id'].'"');
		}
		if($clans_q['user_7_p'] == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_7` = "'.($clans_q['q_7'] >= "100000" ? "1000000":($clans_q['q_7'] + $_exp)).'" WHERE `clans` = "'.$clan['id'].'"');
		}
		if($clans_q['user_8'] == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_8` = "'.($clans_q['q_8'] >= "500000" ? "500000":($clans_q['q_8'] + $_s)).'" WHERE `clans` = "'.$clan['id'].'"');
		}
		if($clans_q['user_8_p'] == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_8` = "'.($clans_q['q_8'] >= "500000" ? "500000":($clans_q['q_8'] + $_s)).'" WHERE `clans` = "'.$clan['id'].'"');
		}




		
	   } 
     
     
mysql_query('UPDATE `clans`     SET `exp` = `exp` + '.$_exp.'  WHERE `id` = "'.$clan['id'].'"'); //Плюсуем в клан
mysql_query('UPDATE `clan_memb` SET `exp` = `exp` + '.$_exp.' WHERE `clan` = "'.$clan['id'].'" AND `user` = "'.$user['id'].'"'); //Плюсуем учаснику клана
}

mysql_query('UPDATE `users`     SET  `valor_exp` = `valor_exp` + '.$_valor_exp.'  WHERE `id` = "'.$user['id'].'"'); //Плюсуем в клан

      mysql_query('UPDATE `arena` SET `end` = "0" WHERE `user` = "'.$user['id'].'"');
     
      $opponent = mysql_query('SELECT * FROM `users` WHERE `str` + `vit` + `def` >= "'.(($user['str'] + $user['vit'] + $user['def']) / 2).'" AND `str` + `vit` + `def` <= "'.($user['str'] + $user['vit'] + $user['def']).'" AND `id` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
      $opponent = mysql_fetch_array($opponent);
      
      if(!$opponent) {

      $opponent = mysql_query('SELECT * FROM `users` WHERE `str` + `vit` + `def` <= "'.($user['str'] + $user['vit'] + $user['def']).'" AND `id` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
      $opponent = mysql_fetch_array($opponent);
      
      }
    mysql_query('UPDATE `arena` SET `opponent` = "'.$opponent['id'].'",
                                          `time` = "'.(time() + 0).'", 
                                          `attack` = `attack` - "1" WHERE `user` = "'.$user['id'].'"');




$_SESSION['mes2'] = '

  <div class="bntf">
   <div class="nl">
    <div class="nr cntr lyell lh1 p5 sh">
     <span class="win"><b>
     <center>
     <img src="/images/ico/png/silver.png" class=icon> '.n_f($_s).' серебра | 
     <img src="/images/ico/png/exp.png" class=icon> '.n_f($_exp).' опыта  </center>
<br>
     <img src="/images/ico/png/valor_exp.png" class=icon> '.n_f($_valor_exp).' доблести 




     </b></span>
    </div>
   </div>
  </div>';






























if($_GET['attack2'] == true && $arena[attack2] > '0') { 

$dmg = _string(mt_rand($user[str] / 3.5,$user[str] / 3) - mt_rand($opponent[def] / 12,$opponent[def] / 9));
if($dmg <= '0'){ $dmg = 2;}
$opponent_dmg = _string(mt_rand($opponent[str] / 3.5,$opponent[str] / 3) - mt_rand($user[def] / 12,$user[def] / 9));
if($opponent_dmg <= '0'){ $opponent_dmg = 2;}   

    if($dmg > $opponent_dmg) { //При победе
$_s = $user['amulet_silver'] + rand(1,5) + (100 * $user['level'] * $user['b_silver_2'] / 100 ) ;           
$_exp = $user['amulet_exp'] + rand(1,5) + (100 * $user['level'] * $user['b_exp_2'] / 100 * $user['valor_b_exp'] / 100) ;
$_SESSION['mes1'] = mes('<center><font color=lime>Победа</font></center>');
}else{//При поражении
$_s = $user['amulet_silver'] + rand(1,5) + (60 * $user['level'] * $user['b_silver_2'] / 100 ) ;
$_exp = $user['amulet_exp'] + rand(1.5) + (60 * $user['level'] * $user['b_exp_2'] / 100 * $user['valor_b_exp'] / 100) ; 
$_SESSION['mes1'] = mes('<center><font color=red>Поражение</font></center>');
}
if($_q_1 < 1) {$_q_1 = 1;}
if($_s < 1) {$_s = 1 * $user['b_silver_1'] / 100  ;}
if($_exp < 1) {$_exp = 1  * $user['b_exp_1'] / 100 ;}
$_valor_exp = $arena['valor_exp'] + rand(3,6) * $user['b_valor_1'] / 100;  
if($clan_memb && $clan_memb['v'] > 0) {$_exp += round($_exp/100) * $clan_memb['v'];}
if($premium) {$_s+= round($_s/ 100) * 100;} 
if($premium) {$_exp+= round($_exp/ 100) * 100;} 
if($clan) { 
     
	   if(date('w') != 0 AND date('w') != 7){
		$clans_q = mysql_fetch_array(mysql_query('SELECT * FROM `clans_q` WHERE `clans` = "'.$clan['id'].'"LIMIT 1'));
		if($clans_q['user_1'] == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_1` = "'.($clans_q['q_1'] >= "100" ? "100":($clans_q['q_1'] + $_q_1)).'" WHERE `clans` = "'.$clan['id'].'"');
		}
		if($clans_q['user_2'] == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_2` = "'.($clans_q['q_2'] >= "300" ? "300":($clans_q['q_2'] + $_q_1)).'" WHERE `clans` = "'.$clan['id'].'"');
		}
		if($clans_q['user_1_p']  == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_1` = "'.($clans_q['q_1'] >= "100" ? "100":($clans_q['q_1'] + $_q_1)).'" WHERE `clans` = "'.$clan['id'].'"');
		}
		if($clans_q['user_2_p'] == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_2` = "'.($clans_q['q_2'] >= "300" ? "300":($clans_q['q_2'] + $_q_1)).'" WHERE `clans` = "'.$clan['id'].'"');
		}
		
		
		if($clans_q['user_7'] == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_7` = "'.($clans_q['q_7'] >= "100000" ? "100000":($clans_q['q_7'] + $_exp)).'" WHERE `clans` = "'.$clan['id'].'"');
		}
		if($clans_q['user_7_p'] == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_7` = "'.($clans_q['q_7'] >= "100000" ? "100000":($clans_q['q_7'] + $_exp)).'" WHERE `clans` = "'.$clan['id'].'"');
		}
		if($clans_q['user_8'] == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_8` = "'.($clans_q['q_8'] >= "50000" ? "50000":($clans_q['q_8'] + $_s)).'" WHERE `clans` = "'.$clan['id'].'"');
		}
		if($clans_q['user_8_p'] == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_8` = "'.($clans_q['q_8'] >= "50000" ? "50000":($clans_q['q_8'] + $_s)).'" WHERE `clans` = "'.$clan['id'].'"');
		}
		
		
		
		
		
		
		
		
		
	   }
mysql_query('UPDATE `clans`     SET `exp` = `exp` + '.$_exp.'  WHERE `id` = "'.$clan['id'].'"'); //Плюсуем в клан
mysql_query('UPDATE `clan_memb` SET `exp` = `exp` + '.$_exp.' WHERE `clan` = "'.$clan['id'].'" AND `user` = "'.$user['id'].'"'); //Плюсуем учаснику клана
}
mysql_query('UPDATE `users`     SET `valor_exp` = `valor_exp` + '.$_valor_exp.'  WHERE `id` = "'.$user['id'].'"'); //Плюсуем в клан
mysql_query('UPDATE `arena` SET `end` = "0" WHERE `user` = "'.$user['id'].'"');
     
$opponent = mysql_query('SELECT * FROM `users` WHERE `str` + `vit` + `def` >= "'.(($user['str'] + $user['vit'] + $user['def']) / 2).'" AND `str` + `vit` + `def` <= "'.($user['str'] + $user['vit'] + $user['def']).'" AND `id` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
$opponent = mysql_fetch_array($opponent);
if(!$opponent) {
$opponent = mysql_query('SELECT * FROM `users` WHERE `str` + `vit` + `def` <= "'.($user['str'] + $user['vit'] + $user['def']).'" AND `id` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
$opponent = mysql_fetch_array($opponent);
}
mysql_query('UPDATE `arena` SET `opponent` = "'.$opponent['id'].'",`time` = "'.(time() + 0).'", `attack` = `attack` - "1" WHERE `user` = "'.$user['id'].'"');
$_SESSION['mes2'] = '
  <div class="bntf">
   <div class="nl">
    <div class="nr cntr lyell lh1 p5 sh">
     <span class="win"><b>
     <center><img src="/images/ico/png/silver.png" class=icon> '.n_f($_s).' серебра <img src="/images/ico/png/exp.png" class=icon> '.n_f($_exp).' опыта  </center>
     </b></span>
    </div>
   </div>
  </div>';



















if($user['level'] >= '1') { $quality='1';  }
if($user['level'] >= '1'){ $quality='1';  }
if($user['level'] >= '1'){ $quality='1';  }
if($user['level'] == '60'){ $quality='1';  }



 
  $proc = rand(0,100);
  if($proc < '0' && $dmg > $opponent_dmg) { //Шанс выпадания шмоток 15% только при победе
$w = mysql_fetch_array(mysql_query('SELECT * FROM `shop` WHERE `quality` <= "'.$quality.'" ORDER BY RAND() LIMIT 1'));

if(mysql_num_rows(mysql_query('SELECT * FROM `inv` WHERE `place` = \'0\' AND `user` = "'.$user['id'].'" ')) + 1 < 20) { //Если в рюкзакуменьше 20-ти вещей
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
  
$task_id_25=25;// Найди на арене 6 вещей необычного качества и лучше
$req2 = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_25.'") AND (`complete`="0")');
$task2 = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id_25.'")'));
   if (mysql_num_rows ($req2) != 0) {
while ($t2 = mysql_fetch_array ($req2)) {
   if ($t2['how'] < $task2['how']){                               
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_25.'")');
}}}
//////////////////////////

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
  
  if($user['w_'.$item['w']] != 0) {   
$equip_item = mysql_query('SELECT * FROM `inv` WHERE `id` = "'.$user['w_'.$item['w']].'"');
$equip_item = mysql_fetch_array($equip_item);

  if(($w['_str'] + $w['_vit'] + $w['_def']) - ($equip_item['_str'] + $equip_item['_vit'] + $equip_item['_def']) > 0) {
$aaaa='<font color="#30c030">+'.($w['_str'] + $w['_vit'] + $w['_def']) - ($equip_item['_str'] + $equip_item['_vit'] + $equip_item['_def']).'</font> ';
}
  
}else{
$aaaa='<font color="#30c030">+'.($w['_str'] + $w['_vit'] + $w['_def']).'</font>';
}


  
  
$_SESSION['mes3'] = '
<table cellpadding="0" cellspacing="0">
<tr>
<td width="15%"><img src="/images/items/'.$w['item'].'.png" class=icon></td>
<td>
<img src="/images/ico/quality/'.$w['quality'].'.png" class=icon> <a href="/item/'.$w['id'].'/"> '.$item['name'].' </a>
<br/><small>
<font color="#'.(($user['level'] < $item['level']) ? 'c06060':'ffffff').'"><img src="/images/ico/png/up.png" alt="*" width="12"/>'.$item['level'].' ур, </font>
<font color="'.$quality_color.'"> '.$quality.' </font>
'.$aaaa.' </small>
</td></tr></table>';
  }

}//Конец выпадания шмоток

}
  
  
  
// Задания
$task_id=100000;// Победи 30 противников на Арене
$req = mysql_query ('SELECT SQL_CACHE * FROM `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
   if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
   if ($t['how'] < $task['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}   
$task_id=100001;// Победи 30 противников на Арене
$req = mysql_query ('SELECT SQL_CACHE * FROM `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
   if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
   if ($t['how'] < $task['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}   
$task_id=100002;// Победи 30 противников на Арене
$req = mysql_query ('SELECT SQL_CACHE * FROM `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
   if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
   if ($t['how'] < $task['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}   
  
    
  
  
  
// Задания
$task_id=4;// Победи 30 противников на Арене
$req = mysql_query ('SELECT SQL_CACHE * FROM `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
   if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
   if ($t['how'] < $task['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}} 
// Задания
$task_id_12=12;// Победи 25 противников на Арене
$req2 = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_12.'") AND (`complete`="0")');
$task2 = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id_12.'")'));
   if (mysql_num_rows ($req2) != 0) {
while ($t2 = mysql_fetch_array ($req2)) {
   if ($t2['how'] < $task2['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_12.'")');
}}}} 
//////////////////////////
$task_id_35=35;// Победи 60 противников на Арене
$req2 = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_35.'") AND (`complete`="0")');
$task2 = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id_35.'")'));
   if (mysql_num_rows ($req2) != 0) {
while ($t2 = mysql_fetch_array ($req2)) {
   if ($t2['how'] < $task2['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_35.'")');
}}}} 
//////////////////////////
$task_id_38=38;// Победи 200 противников на Арене
$req2 = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_38.'") AND (`complete`="0")');
$task2 = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id_38.'")'));
   if (mysql_num_rows ($req2) != 0) {
while ($t2 = mysql_fetch_array ($req2)) {
   if ($t2['how'] < $task2['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_38.'")');
}}}} 
//////////////////////////

$task_id_53=53;// Победи 400 противников на Арене
$req2 = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_53.'") AND (`complete`="0")');
$task2 = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id_53.'")'));
   if (mysql_num_rows ($req2) != 0) {
while ($t2 = mysql_fetch_array ($req2)) {
   if ($t2['how'] < $task2['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_53.'")');
}}}} 
//////////////////////////

$task_id_59=59;// Победи 700 противников на Арене
$req2 = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_59.'") AND (`complete`="0")');
$task2 = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id_59.'")'));
   if (mysql_num_rows ($req2) != 0) {
while ($t2 = mysql_fetch_array ($req2)) {
   if ($t2['how'] < $task2['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_59.'")');
}}}} 
//////////////////////////
$task_id_89=89;// Победи 1500 противников на Арене
$req2 = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_89.'") AND (`complete`="0")');
$task2 = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id_89.'")'));
   if (mysql_num_rows ($req2) != 0) {
while ($t2 = mysql_fetch_array ($req2)) {
   if ($t2['how'] < $task2['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_89.'")');
}}}} 
//////////////////////////
$task_id_99=99;// Победи 2200 противников на Арене
$req2 = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_99.'") AND (`complete`="0")');
$task2 = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id_99.'")'));
   if (mysql_num_rows ($req2) != 0) {
while ($t2 = mysql_fetch_array ($req2)) {
   if ($t2['how'] < $task2['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_99.'")');
}}}} 
//////////////////////////
$task_id_138=138;// Победи 3000 противников на Арене
$req2 = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_138.'") AND (`complete`="0")');
$task2 = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id_138.'")'));
   if (mysql_num_rows ($req2) != 0) {
while ($t2 = mysql_fetch_array ($req2)) {
   if ($t2['how'] < $task2['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_138.'")');
}}}} 
//////////////////////////
$task_id_148=148;// Победи 3000 противников на Арене
$req2 = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_148.'") AND (`complete`="0")');
$task2 = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id_148.'")'));
   if (mysql_num_rows ($req2) != 0) {
while ($t2 = mysql_fetch_array ($req2)) {
   if ($t2['how'] < $task2['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_148.'")');
}}}} 
//////////////////////////
$task_id_160=160;// Победи 3000 противников на Арене
$req2 = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_160.'") AND (`complete`="0")');
$task2 = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id_160.'")'));
   if (mysql_num_rows ($req2) != 0) {
while ($t2 = mysql_fetch_array ($req2)) {
   if ($t2['how'] < $task2['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_160.'")');
}}}} 
//////////////////////////
$task_id_198=198;// Победи 3000 противников на Арене
$req2 = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_198.'") AND (`complete`="0")');
$task2 = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id_198.'")'));
   if (mysql_num_rows ($req2) != 0) {
while ($t2 = mysql_fetch_array ($req2)) {
   if ($t2['how'] < $task2['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_198.'")');
}}}} 
//////////////////////////



mysql_query('UPDATE `users` SET `exp` = `exp` + '.$_exp.', `s` = `s` + '.$_s.' WHERE `id` = "'.$user['id'].'"'); 
header("Location: /arena/"); 
exit; 
}


  
  
  
  $opponent = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$arena['opponent'].'"');
  $opponent = mysql_fetch_array($opponent);

$w_1 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$opponent['id'].'" AND `id` = "'.$opponent['w_1'].'"');
$w_1 = mysql_fetch_array($w_1); 

if(!$w_1) { 

$w_1['item'] = 0; 

} 

$w_2 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$opponent['id'].'" AND `id` = "'.$opponent['w_2'].'"');
$w_2 = mysql_fetch_array($w_2); 

if(!$w_2) { 

$w_2['item'] = 0; 

} 


$w_3 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$opponent['id'].'" AND `id` = "'.$opponent['w_3'].'"');
$w_3 = mysql_fetch_array($w_3); 

if(!$w_3) { 

$w_3['item'] = 0; 

} 

$w_4 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$opponent['id'].'" AND `id` = "'.$opponent['w_4'].'"');
$w_4 = mysql_fetch_array($w_4); 

if(!$w_4) { 

$w_4['item'] = 0; 

} 

$w_5 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$opponent['id'].'" AND `id` = "'.$opponent['w_5'].'"');
$w_5 = mysql_fetch_array($w_5); 

if(!$w_5) { 

$w_5['item'] = 0; 

} 

$w_6 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$opponent['id'].'" AND `id` = "'.$opponent['w_6'].'"');
$w_6 = mysql_fetch_array($w_6); 

if(!$w_6) { 

$w_6['item'] = 0; 

} 

$w_7 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$opponent['id'].'" AND `id` = "'.$opponent['w_7'].'"');
$w_7 = mysql_fetch_array($w_7); 

if(!$w_7) { 

$w_7['item'] = 0; 

} 


$w_8 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$opponent['id'].'" AND `id` = "'.$opponent['w_8'].'"');
$w_8 = mysql_fetch_array($w_8); 

if(!$w_8) { 

$w_8['item'] = 0; 

} 
if(!isset($lastPlayer)){

}


echo '<div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Арена ('.$arena['attack'].' боев)
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
           <div class="fl ml5 mt5"> 
          
            <div class="iqcont1">
             <div class="icbtn20">';
            ?>
            <td><a href='/arena/?attack=true'><img src='/manekenImage/<?=$opponent['sex']?>/<?=$w_1['item']?>/<?=$w_2['item']?>/<?=$w_3['item']?>/<?=$w_4['item']?>/<?=$w_5['item']?>/<?=$w_6['item']?>/<?=$w_7['item']?>/<?=$w_8['item']?>/' width=128 height=160></a> 
 </td>
 <?
 
            
          echo '  </div>
            </div> 
           </div> 
           <div class="ml130 mt10 mb10 mr10 sh"> 
            <span class="lwhite tdn"><img class="icon" src="http://144.76.127.94/view/image/icons/hero.png"> '.$opponent['login'].'</span>
            <br> 
            <br>
            <img class="icon" src="http://144.76.127.94/view/image/icons/strength.png"> Сила: '.$opponent['str'].'
            <br>
            <img class="icon" src="http://144.76.127.94/view/image/icons/health.png"> Здоровье: '.$opponent['vit'].'
            <br>
            <img class="icon" src="http://144.76.127.94/view/image/icons/defense.png"> Броня: '.$opponent['def'].'
            <br> 
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
   <div class="aeblck16">
    <div class="cntr">
     <br><a href="/arena/?attack=true" class="ubtn inbl mt-15 red mb5"><span class="ul"><span class="ur">Атаковать</span></span></a>
    </div>
   </div>
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
       Чем выше уровень амулета, тем больше опыта и серебра получишь за победу! 
     </div>
    </div>
   </div>
  </div> 
  <div class="hr_g mb2">
   <div>
    <div></div>
   </div>
  </div> 
  <div class="bntf">
   <div class="nl">
    <div class="nr cntr lyell lh1 p5 nd sh"> 
     <a href="/shop/amulet" class="lwhite nd"><img src="http://144.76.127.94/view/image/arena/amulet1.png" height="16" class="icon"> Амулет арены </a>
    </div>
   </div>
  </div> 
 
   <div>
    <div></div>
   
  </div> 
  
   <div>
    <div></div>
   
  </div> ';


include './system/f.php';

?>