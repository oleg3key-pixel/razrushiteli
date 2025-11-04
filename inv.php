<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';    

if(!$user) {
header('location: /');  
exit;}




$title = 'Сумка';
include './system/h.php';  



$wear = _string(_num($_GET['wear']));

if($wear) {
$query = mysql_query('SELECT * FROM `inv` WHERE `id` = \''.$wear.'\' AND `equip` = \'0\' AND `user` = \''.$user['id'].'\'');
$inv = mysql_fetch_array($query);    

  if($inv) {
$item = mysql_fetch_array(mysql_query('SELECT * FROM `items` WHERE `id` = \''.$inv['item'].'\''));  //Новая вещь
$item2 = mysql_fetch_array(mysql_query('SELECT * FROM `inv` WHERE `id` = \''.$user['w_'.$item['w']].'\''));    //Старая вещь


if($user['w_'.$item['w']]){//Если вещь одета

mysql_query('UPDATE `users` SET `str` = `str` - '.$item2['_str'].',        
                                `vit` = `vit` - '.$item2['_vit'].',        
								`def` = `def` - '.$item2['_def'].',
      
                         `w_'.$item['w'].'` = "0" WHERE `id` = "'.$user['id'].'" ');
mysql_query('UPDATE `inv` SET `equip` = "0" WHERE `id` = "'.$item2['id'].'" ');

mysql_query('UPDATE `users` SET `str` = `str` + '.$inv['_str'].',        
                                `vit` = `vit` + '.$inv['_vit'].',        
								`def` = `def` + '.$inv['_def'].',
      
                         `w_'.$item['w'].'` = "'.$inv['id'].'" WHERE `id` = "'.$user['id'].'" ');
mysql_query('UPDATE `inv` SET `equip` = "1" WHERE `id` = "'.$inv['id'].'" ');
header('Location: /inv/');
$_SESSION['mes'] = mes('Вещь успешно одета!');
exit; }
      
   

    
mysql_query('UPDATE `users` SET `str` = `str` + '.$inv['_str'].',        
                                `vit` = `vit` + '.$inv['_vit'].',        
								`def` = `def` + '.$inv['_def'].',
      
                         `w_'.$item['w'].'` = \''.$inv['id'].'\' WHERE `id` = \''.$user['id'].'\'');
mysql_query('UPDATE `inv` SET `equip` = \'1\' WHERE `id` = \''.$inv['id'].'\'');
$_SESSION['mes'] = mes('Вещь успешно одета!');
header('location: /inv/');
exit;
   
  
  }
        
}






$unwear = _string(_num($_GET['unwear']));

if($unwear) {
$query = mysql_query('SELECT * FROM `inv` WHERE `id` = \''.$unwear.'\' AND `user` = \''.$user['id'].'\'');
$inv = mysql_fetch_array($query);

if($inv) {
$query = mysql_query('SELECT * FROM `items` WHERE `id` = \''.$inv['item'].'\'');
$item = mysql_fetch_array($query);

    if($user['w_'.$item['w']] && $user['w_'.$item['w']] == $inv['id']) {
    if(mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user` = \''.$user['id'].'\' AND `equip` = \'0\''),0) + 1 > 100){
$_SESSION['mes'] = mes('Ошибка, сумка заполнена!');
header('location: /inv/');
exit;}
	
mysql_query('UPDATE `users` SET `str` = `str` - '.$inv['_str'].',
                                `vit` = `vit` - '.$inv['_vit'].',
                                `def` = `def` - '.$inv['_def'].',
                                      
                         `w_'.$item['w'].'` = \'0\' WHERE `id` = \''.$user['id'].'\'');
mysql_query('UPDATE `inv` SET `equip` = \'0\' WHERE `id` = \''.$inv['id'].'\'');
$_SESSION['mes'] = mes('Вещь успешно снята!');
header('location: /equip/');
exit;

    
}else{
mysql_query('UPDATE `inv` WHERE `id` = \''.$inv['id'].'\'');
$_SESSION['mes'] = mes('Ошибка!');
header('location: /inv/');
exit;
    }
        
  }       

}





  
$sell = _string(_num($_GET['sell']));  
if($sell) {
$query = mysql_query('SELECT * FROM `inv` WHERE `id` = \''.$sell.'\' AND `equip` = \'0\' AND `user` = \''.$user['id'].'\'');
$inv = mysql_fetch_array($query);
  
  if($inv) {

// Задания
$task_id=7;// Разбери 10 любых вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////////////////////////////
$task_id=15;// Разбери 10 любых вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////////////////////////////
$task_id=22;// Разбери 10 любых вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////////////////////////////
$task_id=37;// Разбери 10 любых вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
$task_id=126;// Разбери 10 любых вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
$task_id=137;// Разбери 10 любых вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////////////////////////////
$task_id=20;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '2'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////////////////////////////
$task_id=57;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '2'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////////////////////////////
$task_id=52;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '3'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
$task_id=67;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '4'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
$task_id=78;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '4'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
$task_id=31;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '3'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
$task_id=98;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '4'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
$task_id=109;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '4'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
$task_id=113;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '4'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
$task_id=136;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '4'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
$task_id=147;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '4'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
$task_id=159;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '4'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
$task_id=165;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '4'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
$task_id=175;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '4'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
$task_id=185;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '5'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
$task_id=197;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '6'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}







$_sell = array(0, 100, 300, 1000, 5000, 8000, 10000, 15000, 25000);
mysql_query('UPDATE `users` SET `s` = `s` + '.$_sell[$inv['quality']].' WHERE `id` = \''.$user['id'].'\'');
mysql_query('DELETE FROM `inv` WHERE `id` = \''.$inv['id'].'\'');
$_SESSION['mes'] = mes('Вещь разобрана!');
header('location: /inv/');
exit;
  }
}


    $sell_clean = _string(_num($_GET['sell_clean']));
  
if($sell_clean) {
  $s=0;  $kol=0;
  $s1=0; $kol1=0;
  $s2=0; $kol2=0;
  $s3=0; $kol3=0;
  $s4=0; $kol4=0;
  $s5=0; $kol5=0;
  $s6=0; $kol6=0;
  $s7=0; $kol6=0;
$__inv = mysql_query('SELECT * FROM `inv` WHERE `user`= \''.$user['id'].'\' AND `quality`<= \''.$sell_clean.'\' AND `equip`="0" ORDER BY `id`');
while($__item = mysql_fetch_array($__inv))
{
$item = mysql_fetch_array(mysql_query('SELECT * FROM `items` WHERE `id` = \''.$__item['item'].'\''));
  if($item['quality'] == 1 OR $item['quality'] == 2 OR $item['quality'] == 3 OR $item['quality'] == 4  OR $item['quality'] == 5) {
if($item['quality'] == '1'){
$kol1 = mysql_num_rows( mysql_query('SELECT * FROM `inv` WHERE `user`= "'.$user['id'].'" AND `quality`= "1" AND `equip`="0"') );
$s1+=6*$kol1;
}  
if($item['quality'] == '2'){
$kol2 = mysql_num_rows( mysql_query('SELECT * FROM `inv` WHERE `user`= "'.$user['id'].'" AND `quality`= "2" AND `equip`="0"') );
$s2+=13*$kol2;
}  
if($item['quality'] == '3'){
$kol3 = mysql_num_rows( mysql_query('SELECT * FROM `inv` WHERE `user`= "'.$user['id'].'" AND `quality`= "3" AND `equip`="0"') );
$s3+=21*$kol3;
}  
if($item['quality'] == '4'){
$kol4 = mysql_num_rows( mysql_query('SELECT * FROM `inv` WHERE `user`= "'.$user['id'].'" AND `quality`= "4" AND `equip`="0"') );
$s4+=50*$kol4;
}  
if($item['quality'] == '5'){
$kol5 = mysql_num_rows( mysql_query('SELECT * FROM `inv` WHERE `user`= "'.$user['id'].'" AND `quality`= "5" AND `equip`="0"') );
$s5+=150*$kol5;
}  



$s+=$s1+$s2+$s3+$s4+$s5;
$kol+=$kol1+$kol2+$kol3+$kol4+$kol5;


// Задания
$task_id=7;// Разбери 10 любых вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                            
mysql_query ('UPDATE `task_user` SET `how`=`how` + "'.$kol.'"  WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`="'.$task['how'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');	
}}}
$task_id=88;// Разбери 10 любых вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                            
mysql_query ('UPDATE `task_user` SET `how`=`how` + "'.$kol.'"  WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`="'.$task['how'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');	
}}}
$task_id=137;// Разбери 10 любых вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                            
mysql_query ('UPDATE `task_user` SET `how`=`how` + "'.$kol.'"  WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`="'.$task['how'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');	
}}}
$task_id=72;// Разбери 10 любых вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                            
mysql_query ('UPDATE `task_user` SET `how`=`how` + "'.$kol.'"  WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`="'.$task['how'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');	
}}}
/////////////////////////////////////////////////
$task_id=15;// Разбери 10 любых вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+ "'.$kol.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`="'.$task['how'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');	
	}}}
/////////////////////////////////////////////////
$task_id=22;// Разбери 10 любых вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+ "'.$kol.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`="'.$task['how'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');	
	}}}
/////////////////////////////////////////////////
$task_id=37;// Разбери 10 любых вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+ "'.$kol.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`="'.$task['how'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');	
	}}}

$task_id=126;// Разбери 10 любых вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+ "'.$kol.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`="'.$task['how'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');	
	}}}
/////////////////////////////////////////////////
$task_id=20;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '2'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+ "'.$kol2.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`="'.$task['how'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');	
	}}}
$task_id=31;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '3'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+ "'.$kol3.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`="'.$task['how'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');	
	}}}
/////////////////////////////////////////////////
$task_id=57;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '2'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+ "'.$kol2.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`="'.$task['how'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');	
	}}}
/////////////////////////////////////////////////
$task_id=52;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '3'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+ "'.$kol3.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`="'.$task['how'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');	
	}}}
$task_id=67;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '4'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+ "'.$kol4.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`="'.$task['how'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');	
	}}}
$task_id=78;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '4'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+ "'.$kol4.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`="'.$task['how'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');	
	}}}
$task_id=98;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '4'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+ "'.$kol4.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`="'.$task['how'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');	
	}}}
$task_id=109;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '4'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+ "'.$kol4.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`="'.$task['how'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');	
	}}}
$task_id=113;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '4'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+ "'.$kol4.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`="'.$task['how'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');	
	}}}
$task_id=136;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '4'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+ "'.$kol4.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`="'.$task['how'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');	
	}}}
$task_id=147;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '4'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+ "'.$kol4.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`="'.$task['how'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');	
	}}}
$task_id=159;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '4'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+ "'.$kol4.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`="'.$task['how'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');	
	}}}
$task_id=165;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '4'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+ "'.$kol4.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`="'.$task['how'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');	
	}}}
$task_id=175;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '4'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+ "'.$kol4.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`="'.$task['how'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');	
	}}}
$task_id=185;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '5'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+ "'.$kol5.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`="'.$task['how'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');	
	}}}
$task_id=197;// Разбери 10 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $inv['quality'] == '6'){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+ "'.$kol6.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`="'.$task['how'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');	
	}}}




/////////////////////

    mysql_query('UPDATE `users` SET `s` = `s` + '.$s.' WHERE `id` = "'.$user['id'].'"');
    mysql_query('DELETE FROM `inv` WHERE `user`= "'.$user['id'].'" AND `quality`<= "'.$sell_clean.'" AND `equip`="0"');   
  


   $_SESSION['mes'] = mes('Вы разобрали '.$kol.' вещей за <img src="/images/ico/png/s.png" alt="*" width="18"/>'.$s.'  серебра');
header('location: /inv/');
 exit;   
}
}
$_SESSION['mes'] = mes('У вас нет вещей для разбора!');
header('location: /inv/');
exit; 
 }












echo '  <div class="ribbon mb2"> <div class="rl">  <div class="rr">     Сумка  </div> </div></div>';


if(mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user` = \''.$user['id'].'\' AND `equip` = \'0\' '),0) > 0) {
$i = 0;
  
$q = mysql_query('SELECT * FROM `inv` WHERE `user` = \''.$user['id'].'\' AND `equip` = \'0\' ORDER BY `id` DESC');
while($row = mysql_fetch_array($q)) {  
$i++;
$item = mysql_fetch_array(mysql_query('SELECT * FROM `items` WHERE `id` = \''.$row['item'].'\''));

  $quality = [	'1'=>'Обычный',
				'2'=>'Необычный',
				'3'=>'Редкий',
				'4'=>'Эпический',
				'5'=>'Легендарный',
				'6'=>'Мифический',
				'7'=>'Реликтовный',
				'8'=>'Божественный'

		];
$quality_color=['1'=>'#999999',
				'2'=>'#B1D689',
				'3'=>'#6BA0E7',
				'4'=>'#C780DB',
				'5'=>'#FF8E94',
				'6'=>'#FE7E01',
				'7'=>'aqua',
				'8'=>'#960028'
		];
    
    if($row['new'] == 0) {
mysql_query('UPDATE `inv` SET `new` = \'1\' WHERE `id` = \''.$row['id'].'\'');
}
      /*
    echo '  <div class="bdr cnr bg_blue mb2">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="fl ml5 mt5 mr5 w48px"> 
            <div class="fl h48"> 
  <td width="15%"><img src="/images/items/'.$row['item'].'.png" alt="*"/></td><td><img src="/images/ico/quality/'.$item['quality'].'.png" alt="*"/> 
  <a href="/item/'.$row['id'].'/">
  '.$item['name'].'</a> '.($row['smith'] > 0 ? '<font color="#90b0c0"><small>+'.$row['smith'].'</small></font>':'').'<br/>
  <small><font color="#'.(($user['level'] < $item['level']) ? 'c06060':'ffffff').'"><img src="/images/ico/png/up.png" alt="*" width="12"/>'.$item['level'].' ур, </font>
  <font color="'.$quality_color[$item['quality']].'">'.$quality[$item['quality']].' </font> 
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
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div> ';
  */
  /*
    if($user['w_'.$item['w']]) {
$equipitem = mysql_fetch_array(mysql_query('SELECT * FROM `inv` WHERE `id` = \''.$user['w_'.$item['w']].'\''));
if( ( $row['_str'] + $row['_vit'] + $row['_def'] ) - ( $equipitem['_str'] + $equipitem['_vit'] + $equipitem['_def'] ) > 0) echo '<font color=\'#30c030\'>+'.(( $row['_str'] + $row['_vit'] + $row['_def'] ) - ( $equipitem['_str'] + $equipitem['_vit'] + $equipitem['_def'] )).'</font>';
}else{
echo '<font color="#30c030">+'.( $row['_str'] + $row['_vit'] + $row['_def'] ).'</font>';
}

*/



    if($row['rune']) {
      
switch($row['rune']) { 

case 1:
$rune_stats = 15; 
$rune_color = '#999999';
break;
case 2:
$rune_stats = 30; 
$rune_color = '#B1D689';
break;
case 3:
$rune_stats = 60;
$rune_color = '#6BA0E7'; 
break;
case 4:
$rune_stats = 200; 
$rune_color = '#C780DB';
break;
case 5:
$rune_stats = 500; 
$rune_color = '#FF8E94';
break;
case 6:
$rune_stats = 1000; 
$rune_color = '#FE7E01';
break;
case 7:
$rune_stats = 2000; 
$rune_color = 'aqua';
break;
case 7:
$rune_stats = 5000; 
$rune_color = '#960028';
break;
}
/*
echo '<br/><img src="/images/ico/rune/small_'.$row['rune'].'.png" alt="*"/> <font color="'.$rune_color.'">+'.$rune_stats.' к параметрам </font><br/>';

*/
}
/*
    echo '</small></td>
</tr></table>
<div align="center">';

//if(!$user['w_'.$item['w']]) 
echo ' 
'.(($user['level'] < $item['level']) ? '<div class="link_center_h"><a> с '.$item['level'].' уровня </a></div>':'
<div class="link_center"><a href="/inv/wear/'.$row['id'].'/">Надеть</a></div>').' ';
echo '</div></div>';
if($i < mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user` = \''.$user['id'].'\' AND `equip` = \'0\''),0))echo '<div class="line"></div>';
*/


  echo '
  <div class="bdr cnr bg_blue mb2">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="fl ml5 mt5 mr5 w48px"> 
            <div class="fl h48"> 
                          <a href="/item/'.$row['id'].'/">
  <td width="15%"><img src="/images/items/'.$row['item'].'.png" width=48></td>
                       <a> 
   
            </div> 
            <div class="clb"></div> 
           </div> 
           <div class="ml58 mt5 mb5 sh small"> 
              <a href="/item/'.$row['id'].'/">
              '.$item['name'].'
              <a> 
              <font color="#30c030">+'.( $row['_str'] + $row['_vit'] + $row['_def'] ).'</font>

           </div> 
           <div class="ml58 mt5 mb5 sh small"> 
             <td><img src="/images/ico/quality/'.$item['quality'].'.png" width=20> 
  <font color="'.$quality_color[$item['quality']].'">'.$quality[$item['quality']].' </font> 

           <br/><img src="/images/ico/rune/'.$row['rune'].'.png" width=20> <font color="'.$rune_color.'">+'.$rune_stats.' к параметрам </font><br/>
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
  <div class="bntf">
   <div class="small">
    <div class="nl">
    </div>
   </div>
  </div> 
   <div>
    <div></div>
   </div>
  </div>';

  }

}else{
}

echo'<a class=mbtn mb2 href="/inv/sell_clean/5/"><img src="/images/ico/quality/5.png" alt=""/>  Разобрать легендарные вещи</a>
<a class=mbtn mb2 href="/inv/sell_clean/4/"><img src="/images/ico/quality/4.png" alt=""/>  Разобрать эпические вещи</a>
<a class=mbtn mb2 href="/inv/sell_clean/3/"><img src="/images/ico/quality/3.png" alt=""/>  Разобрать редкие вещи</a>
<a class=mbtn mb2 href="/inv/sell_clean/2/"><img src="/images/ico/quality/2.png" alt=""/>  Разобрать необычные вещи</a>
<a class=mbtn mb2 href="/inv/sell_clean/1/"><img src="/images/ico/quality/1.png" alt=""/>  Разобрать обычные вещи</a>
<div class="line"></div>';






include './system/f.php';
?>