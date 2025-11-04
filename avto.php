<?
include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';

include './system/h.php';























$lair_mobs = mysql_fetch_assoc(mysql_query("SELECT * FROM `lair_mobs` WHERE `id`='".$user['lair']."' ")); 
$lair = mysql_fetch_assoc(mysql_query("SELECT * FROM `lair` WHERE `id`='".$lair_mobs['glava']."' ")); 
$lair_users = mysql_fetch_assoc(mysql_query("SELECT * FROM `lair_users` WHERE `user_id`='".$user['id']."' ")); 



	


















//////////////////////////////////////////////////
/////////////////////////////////////////////////
if($lair_users['user_vit'] <= '0'){//Если вы мертвы
$_gold = 0;  














$_valor2 = $lair_mobs['valor'] + rand(5,15) * $user['b_valor_1'] / 100;
$_exp2 = $lair_mobs['exp'] + rand(1000,10000) * $user['b_exp_1'] / 100;    



if($clan_memb && $clan_memb['v'] > 0) {  //Верность клану
$_exp2 += round($_exp/100) * $clan_memb['v']; }
if($premium) {$_exp+= round($_exp/ 100) * 100;} //Если премик 	
  

$_exp+= round($_exp/ 10) * $clan['doom'];
$_s+= round($_s/ 10) * $clan['doom'];
$_valor+= round($_valor/ 10) * $clan['doom'];


if($_q_222 < 1) {$_q_222 = 2;}



 if($user['lair_gold'] < $lair_mobs['gold']){
	$_gold = round($lair_mobs['gold'] / 5); 
	$lair_gold=$user['lair_gold']+$_gold;
	if($lair_gold > $lair_mobs['gold']){
	$_gold = $lair_mobs['gold']-$user['lair_gold'];
	$lair_gold=$user['lair_gold']+$_gold;
	}
 }elseif($user['lair_gold'] == $lair_mobs['gold']){	 
    $_gold = 0;
	$lair_gold=$user['lair_gold'];
 }
 


mysql_query("UPDATE `users` SET `g`=`g`+'".$_gold2."', `exp`=`exp`+'".$_exp2."', `lair_boi` = `lair_boi` - '".$user['lair_boi']."', `lair_gold`=`lair_gold`+'".$_gold2."' WHERE `id`='".$user['id']."' ");
mysql_query('UPDATE `users`     SET `valor_exp` = `valor_exp` + '.$_valor2.' WHERE `id` = "'.$user['id'].'"'); //Плюсуем в клан




	// Задания
$task_id=100003;// Сразись 3 раза с босами
$req = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
   if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
   if ($t['how'] < $task['how']){                              
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}		
$task_id=100004;// Сразись 3 раза с босами
$req = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
   if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
   if ($t['how'] < $task['how']){                              
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}		
$task_id=100005;// Сразись 3 раза с босами
$req = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
   if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
   if ($t['how'] < $task['how']){                              
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}		





  if($clan) {//Если в клане 


           //задания
	   if(date('w') != 0 AND date('w') != 7){
		$clans_q = mysql_fetch_array(mysql_query('SELECT * FROM `clans_q` WHERE `clans` = "'.$clan['id'].'"LIMIT 1'));
		if($clans_q['user_3'] == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_3` = "'.($clans_q['q_3'] >= "100" ? "100":($clans_q['q_3'] + $_q_222)).'" WHERE `clans` = "'.$clan['id'].'"');
		}
		if($clans_q['user_4'] == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_4` = "'.($clans_q['q_4'] >= "250" ? "250":($clans_q['q_4'] + $_q_222)).'" WHERE `clans` = "'.$clan['id'].'"');
		}
		if($clans_q['user_3_p']  == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_4` = "'.($clans_q['q_3'] >= "100" ? "100":($clans_q['q_3'] + $_q_222)).'" WHERE `clans` = "'.$clan['id'].'"');
		}
		if($clans_q['user_4_p'] == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_5` = "'.($clans_q['q_4'] >= "250" ? "250":($clans_q['q_4'] + $_q_222)).'" WHERE `clans` = "'.$clan['id'].'"');
		}







		
	   } 




mysql_query('UPDATE `clans`     SET `exp` = `exp` + '.$_exp2.'  WHERE `id` = "'.$clan['id'].'"'); //Плюсуем в клан
mysql_query('UPDATE `clan_memb` SET `exp` = `exp` + '.$_exp2.' WHERE `clan` = "'.$clan['id'].'" AND `user` = "'.$user['id'].'"'); //Плюсуем учаснику клана
}
}	
//////////////////////////////////////////////////
/////////////////////////////////////////////////











$my_attack = round(rand($lair_users[user_str] * 2.4 * 0.38,$lair_users[user_str] * 2.5 * 0.65) - ($lair_users[boss_def] / 5 * 0.66));
if($my_attack <= '0'){ $my_attack = 5;}
$lair_attack = round(rand($lair_users[boss_str] * 2.1 * 0.37,$lair_users[boss_str] * 2.2 * 0.38) - ($lair_users[boss_def] / 5 * 0.66) );
	if($_GET['attack'] == true){//Система боя

/*if($lair_attack <= '0'){ $lair_attack = 5;}*/
$hp_mob = round(100/($lair_mobs['vit']/$lair_users['boss_vit']));
if($hp_mob > 100)
	$hp_mob = 100;  

$hp_user = round(100/($user['vit']/$lair_users['user_vit']));
if($hp_user > 100)
	$hp_user = 100;   
$log = 'Вы ударили '.$lair_mobs['name'].'  на <span class="red">'.$my_attack.'</span> </br>
'.$lair_mobs['name'].' ударил вас на <span class="red">'.$lair_attack.'</span>';
mysql_query("INSERT INTO `lair_logs` SET `user_id`='".$user['id']."', `text`='".$log."', `time`='".time()."'");
mysql_query("UPDATE `lair_users` SET `user_vit`=`user_vit`-'".$lair_attack."', `boss_vit`=`boss_vit`-'".$my_attack."', `last_prg_red` = '".$hp_mob."', `last_prg_red_us` = '".$hp_user."' WHERE `user_id`='".$user['id']."' ");
header('Location:/lair');
exit;} 

$hp_mob = round(100/($lair_mobs['vit']/$lair_users3['boss_vit']));
if($hp_mob > 100)
	$hp_mob = 100;   

$hp_user = round(100/($user['vit']/$lair_users3['user_vit']));
if($hp_user > 100)
	$hp_user = 100;   

$dmg_mob = $lair_users3['last_prg_red'] - $hp_mob;
$dmg_user = $lair_users3['last_prg_red_us'] - $hp_user;
///////////Выводим дизайн как в оригинале
$logs = mysql_fetch_array(mysql_query("SELECT * FROM `lair_logs` WHERE `user_id` = '".$user['id']."'"));










































$arena=mysql_fetch_array(mysql_query("SELECT * FROM `arena` WHERE `user`= '".$user['id']."' LIMIT 15"));

	   
	   
	   
	   
	   
	   
$dmg = _string(mt_rand($user[str] / 3.5,$user[str] / 3) - mt_rand($opponent[def] / 12,$opponent[def] / 9));
if($dmg <= '0'){ $dmg = 2;}
$opponent_dmg = _string(mt_rand($opponent[str] / 3.5,$opponent[str] / 3) - mt_rand($user[def] / 12,$user[def] / 9));
if($opponent_dmg <= '0'){ $opponent_dmg = 2;}   
if($dmg > $opponent_dmg) { //При победе
if($_key < 1) {$_key= 1;}
$_s = $user['amulet_silver'] + rand(1,5) + (100 * $user['level'] * 15);           
$_exp = $user['amulet_exp'] + rand(1,5) + (100 * $user['level'] * 15);   
$_SESSION['mes1'] = mes('<center><font color=lime>Победа</font></center>');
}else{//При поражении
$_s = $user['amulet_silver'] + rand(1,5) + (60 * $user['level'] * 15) ;
$_exp = $user['amulet_exp'] + rand(1,5) + (60 * $user['level'] * 15) ;  
$_SESSION['mes1'] = mes('<center><font color=red>Поражение</font></center>');
}
  if($user['trophies_silver']) {$_s+= round($_s/ 100) * $user['trophies_silver'];} //Бонус трофеев
  if($user['trophies_exp']) {$_exp+= round($_exp/ 100) * $user['trophies_exp'] ;}   //Бонус трофеев
  if($user['b_silver_2']) {$_s+= round($_s/ 100) * $user['b_silver_2'];}   //Бонус трофеев
  if($user['b_exp_2']) {$_exp+= round($_exp/ 100) * $user['b_exp_2'] ;}   //Бонус трофеев
  if($user['valor_b_silver']) {$_s+= round($_exp/ 100) * $user['valor_b_silver']  ;}   //Бонус трофеев
  if($user['valor_b_exp']) {$_exp+= round($_exp/ 100) * $user['valor_b_exp'];}   //Бонус трофеев
$_valor_exp = $arena['valor_exp'] + rand(20,20) * ($user['b_valor_2']  / 100) * 15;  


if($clan_memb && $clan_memb['v'] > 0) {  //Верность клану
$_exp += round($_exp/100) * $clan_memb['v'];
}

  if($premium) {$_s+= round($_s/ 100) * 100 ;} //Если премик
  if($premium) {$_exp+= round($_exp/ 100) * 100  ;} //Если премик


	
   
   
if($_q_1 < 1) {$_q_1 = 15;}
if($_q_2 < 1) {$_q_2 = 15;}
if($_q_3 < 1) {$_q_3 = 15;}





























echo' '.$_SESSION['mes666'].'  ';
$_SESSION['mes666']=NULL; //Удаляем сесию



if($_GET['wakeup2'] == true){  
$cost = 35;
if($cost > $user[g]) {
echo'<div class="bntf"><div class="small"><div class="nl"><div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">Не достаточно золота. Нужно  <img class="icon" src="http://144.76.127.94/view/image/icons/gold.png">35</div></div></div></div>';
include './system/f.php';

exit; }  






mysql_query('UPDATE  `users` SET `g` = `g`+ "'.$_gold.'" , `lair_gold`=`lair_gold`+ "'.$_gold.'"  WHERE `id`="'.$user['id'].'" LIMIT 1');
mysql_query('UPDATE  `users` SET `lair_boi` = `lair_boi` - "'.$user['lair_boi'].'"  WHERE `user`="'.$user['id'].'" LIMIT 1');
mysql_query('UPDATE  `arena` SET `attack` = `attack` - "'.$arena['attack'].'"  WHERE `user`="'.$user['id'].'" LIMIT 1');
mysql_query('UPDATE  `users` SET `g` = `g` - "35"  WHERE `id`="'.$user['id'].'" LIMIT 1');
mysql_query('UPDATE `clans`     SET `exp` = `exp` + '.$_exp.'  WHERE `id` = "'.$clan['id'].'"'); 
mysql_query('UPDATE `clan_memb` SET `exp` = `exp` + '.$_exp.' WHERE `clan` = "'.$clan['id'].'" AND `user` = "'.$user['id'].'"'); 
mysql_query('UPDATE `users`     SET `exp` = `exp` + '.$_exp.', `s` = `s` + '.$_s.'  WHERE `id` = "'.$user['id'].'"'); 
mysql_query('UPDATE `users` SET `valor_exp` = `valor_exp` + '.$_valor_exp.'  WHERE `id` = "'.$user['id'].'"'); 




//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////Клановые задания арены//////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////


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
		mysql_query('UPDATE `clans_q` SET `q_7` = "'.($clans_q['q_7'] >= "1000000" ? "1000000":($clans_q['q_7'] + $_exp)).'" WHERE `clans` = "'.$clan['id'].'"');
		}
		if($clans_q['user_8'] == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_8` = "'.($clans_q['q_8'] >= "500000" ? "500000":($clans_q['q_8'] + $_s)).'" WHERE `clans` = "'.$clan['id'].'"');
		}
		if($clans_q['user_8_p'] == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_8` = "'.($clans_q['q_8'] >= "500000" ? "500000":($clans_q['q_8'] + $_s)).'" WHERE `clans` = "'.$clan['id'].'"');
		}




	   }


}





//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////Задания арены///////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////

// Задания
$task_id=100000;// Победи 30 противников на Арене
$req = mysql_query ('SELECT SQL_CACHE * FROM `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
   if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
   if ($t['how'] < $task['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+15 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}   
$task_id=100001;// Победи 30 противников на Арене
$req = mysql_query ('SELECT SQL_CACHE * FROM `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
   if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
   if ($t['how'] < $task['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+15 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}   
$task_id=100002;// Победи 30 противников на Арене
$req = mysql_query ('SELECT SQL_CACHE * FROM `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
   if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
   if ($t['how'] < $task['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+15 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}   


$task_id=4;
$req = mysql_query ('SELECT SQL_CACHE * FROM `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
   if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
   if ($t['how'] < $task['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+15 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}} 

$task_id_12=12;
$req2 = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_12.'") AND (`complete`="0")');
$task2 = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id_12.'")'));
   if (mysql_num_rows ($req2) != 0) {
while ($t2 = mysql_fetch_array ($req2)) {
   if ($t2['how'] < $task2['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+15 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_12.'")');
}}}} 

$task_id_35=35;
$req2 = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_35.'") AND (`complete`="0")');
$task2 = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id_35.'")'));
   if (mysql_num_rows ($req2) != 0) {
while ($t2 = mysql_fetch_array ($req2)) {
   if ($t2['how'] < $task2['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+15 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_35.'")');
}}}} 

$task_id_38=38;
$req2 = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_38.'") AND (`complete`="0")');
$task2 = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id_38.'")'));
   if (mysql_num_rows ($req2) != 0) {
while ($t2 = mysql_fetch_array ($req2)) {
   if ($t2['how'] < $task2['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+15 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_38.'")');
}}}} 


$task_id_53=53;
$req2 = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_53.'") AND (`complete`="0")');
$task2 = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id_53.'")'));
   if (mysql_num_rows ($req2) != 0) {
while ($t2 = mysql_fetch_array ($req2)) {
   if ($t2['how'] < $task2['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+15 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_53.'")');
}}}} 


$task_id_59=59;
$req2 = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_59.'") AND (`complete`="0")');
$task2 = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id_59.'")'));
   if (mysql_num_rows ($req2) != 0) {
while ($t2 = mysql_fetch_array ($req2)) {
   if ($t2['how'] < $task2['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+15 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_59.'")');
}}}} 

$task_id_89=89;
$req2 = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_89.'") AND (`complete`="0")');
$task2 = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id_89.'")'));
   if (mysql_num_rows ($req2) != 0) {
while ($t2 = mysql_fetch_array ($req2)) {
   if ($t2['how'] < $task2['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+15 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_89.'")');
}}}} 

$task_id_99=99;
$req2 = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_99.'") AND (`complete`="0")');
$task2 = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id_99.'")'));
   if (mysql_num_rows ($req2) != 0) {
while ($t2 = mysql_fetch_array ($req2)) {
   if ($t2['how'] < $task2['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+15 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_99.'")');
}}}} 

$task_id_138=138;
$req2 = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_138.'") AND (`complete`="0")');
$task2 = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id_138.'")'));
   if (mysql_num_rows ($req2) != 0) {
while ($t2 = mysql_fetch_array ($req2)) {
   if ($t2['how'] < $task2['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+15 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_138.'")');
}}}} 

$task_id_148=148;
$req2 = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_148.'") AND (`complete`="0")');
$task2 = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id_148.'")'));
   if (mysql_num_rows ($req2) != 0) {
while ($t2 = mysql_fetch_array ($req2)) {
   if ($t2['how'] < $task2['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+15 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_148.'")');
}}}} 

$task_id_160=160;
$req2 = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_160.'") AND (`complete`="0")');
$task2 = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id_160.'")'));
   if (mysql_num_rows ($req2) != 0) {
while ($t2 = mysql_fetch_array ($req2)) {
   if ($t2['how'] < $task2['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+15 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_160.'")');
}}}} 

$task_id_198=198;
$req2 = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_198.'") AND (`complete`="0")');
$task2 = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id_198.'")'));
   if (mysql_num_rows ($req2) != 0) {
while ($t2 = mysql_fetch_array ($req2)) {
   if ($t2['how'] < $task2['how']){                      
if($dmg > $opponent_dmg) {          
mysql_query ('UPDATE `task_user` SET `how`=`how`+15 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id_198.'")');
}}}} 






//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////Задания подземелья//////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////










header('location: /avto.php');
exit; 
}



$nagrada1=array($_s,$_s2);
$nagrada2=array($_exp,$_exp2);
$nagrada3=array($_valor_exp,$valor2);
$nagrada4=array($_plat,$plat2);
$nagrada5=array($_gold);
           
           


          
           
echo'<div class="bntf"><div class="nl"><div class="nr cntr lyell lh1 p5 sh"><span class="win"><b>Арена и Подземелье пройдены.</b></span>
<br>
			<a class="lwhite" href="/item/'.$w['id'].'">'.$item['name'].'</a>

     <br>
<img class="icon" src="http://144.76.127.94/view/image/icons/silver.png"> '.array_sum($nagrada1).' серебра<br>
<img class="icon" src="http://144.76.127.94/view/image/icons/expirience.png"> '.array_sum($nagrada2).' опыта <br>
<img class="icon" src="http://144.76.127.94/view/image/icons/valor_exp.png"> '.array_sum($nagrada3).' доблести <br>';
if($_gold){
echo'<img class="icon" src="http://144.76.127.94/view/image/icons/gold.png"> '.array_sum($nagrada5).' золота ';
} 

echo'</div></div></div><div class="hr_g mb2"><div><div></div></div></div>

 '.$_SESSION['mes'].' ';$_SESSION['mes']=NULL; 


  ?>
<div class="bntf"><div class="nl"><div class="nr cntr lyell lh1 p5 sh">Собрано в подземелье <img src="http://144.76.127.94/view/image/icons/gold.png" class="icon"><?=$lair_gold?> из <?=$lair_mobs['gold']?>			</div></div></div>
<div class="hr_g mb2"><div><div></div></div></div>

<?


echo'<br><div class="cntr p_relative"><a href="?wakeup2=true" class="ubtn inbl mt-15 mb2 blue"><span class="ul"><span class="ur">Биться еще за <img class="icon" src="http://144.76.127.94/view/image/icons/gold.png">35</span></span></a></div>';


?>
<div class="cntr grey1 small">
									Восстановить энергию и провести 15 боев на арене 							</div>
									
									
									
<div class="bdr cnr bg_blue mt10"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
				<div class="inbl w100">
					<div class="fl ml68 mr10 mt10 mb5">
						<img src="http://144.76.127.94/view/image/item/premium.png">
					</div>
					<div class="mr10 mt10 sh small lyell">
						Премиум удвоит ваши награды!					</div>
					<div class="mr10 sh small lyell">
						+100% к опыту +100% к серебру					</div>
					<div class="mr10 mt10 mb10 sh small lyell">
						<a href="/shop/premium" class="medium ubtn inbl green"><span class="ul"><span class="ur">Купить</span></span></a>
					</div>
				</div>
				<div class="clb"></div>
			</div></div></div></div></div></div></div></div></div>
			
			
			
			
			
			<div class="bdr bg_blue mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="ml10 mt5 mr10 mb5 cntr">
	    <font color=red><b>Внимание! Боссы в автоматическом режиме не побеждаются, с ними проходят лишь бои.</b></font>
				</div></div><div class="clb"></div>
			</div></div></div></div></div></div></div></div></div>
	    
	    
	    
	    
	    
<?



include ('./system/f.php');


