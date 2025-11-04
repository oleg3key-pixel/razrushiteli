<?

///////////////////////////////////////
////////////////////ГЛАВЫ//////////////
///////////////////////////////////////

$task_id=1;// Убей оборотня в пещере
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>4){$lair=1;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $user['lair'] > '4'){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////
$task_id=2;// Убей 3 волков
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>1){$lair=1;}
if($user['lair']>2){$lair=2;}
if($user['lair']>3){$lair=3;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
///////////////////////////
$task_id=3;// Улучши амулет до 2
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$user['amulet'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////
$task_id=5;// Тренируй силу до 15
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['_str'] < '15'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.($user['_str']*3).'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=15 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$item_6=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `quality` >= "1" AND `equip`="1" '),0);
$task_id=6;// Надень 8 простых вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$item_6.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////
$task_id=8;// Набери 125 здоровья
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['vit'] < '125'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.$user['vit'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=125 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////







$task_id=9;// Убей горного тролля
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>8){$lair=1;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $user['lair'] > '8'){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////
$task_id=10;// Убей 3 орков
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>5){$lair=1;}
if($user['lair']>6){$lair=2;}
if($user['lair']>7){$lair=3;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////
$task_id=11;// Тренируй броню до 30
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['_def'] < '30'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.($user['_def']*3).'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=30 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$task_id=13;// Набери 330 здоровья
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['vit'] < '330'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.$user['vit'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=330 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$item_14=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `quality` >= "2" AND `equip`="1" '),0);
$task_id=14;// Надень 6 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$item_14.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////
$item_16=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `smith` >= "1" AND `equip`="1" '),0);
$task_id=16;// Заточи все вещи на +1
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$item_16.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////





$task_id=18;// Улучши амулет до 5
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$user['amulet'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////
$item_19=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `quality` >= "3" AND `equip`="1" '),0);
$task_id=19;// Надень 6 редкого вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$item_19.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////
$task_id=17;// Убей оборотня в пещере
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>12){$lair=1;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $user['lair'] > '12'){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////
$task_id=26;// Убей 3 волков
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>9){$lair=1;}
if($user['lair']>10){$lair=2;}
if($user['lair']>11){$lair=3;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
///////////////////////////
$item_21=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `smith` >= "5" AND `equip`="1" '),0);
$task_id=21;// Заточи все вещи на +5
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$item_21.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////
$task_id=24;// Набери 600 силы
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['str'] < '600'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.$user['str'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=600 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$task_id=25;// Тренируй здоровье до 35
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['_vit'] < '35'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.($user['_vit']*3).'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=35 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$item_23=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `rune` >= "1" AND `equip`="1" '),0);
$task_id=23;// Установи 2 руны обычного качества и выше
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($item_23 <= 2)
{$run=item_23;}
else{$run=2;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$run.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////////





$task_id=27;// Убей оборотня в пещере
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>16){$lair=1;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $user['lair'] > '16'){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////
$task_id=26;// Убей 3 волков
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>13){$lair=1;}
if($user['lair']>14){$lair=2;}
if($user['lair']>15){$lair=3;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
///////////////////////////
$task_id=28;// Набери 1100 здоровья
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['vit'] < '1100'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.$user['vit'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=1100 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$item_30=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `quality` >= "4" AND `equip`="1" '),0);
$task_id=30;// Надень 6 эпических вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$item_30.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////
$task_id=29;// Улучши амулет до 7
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$user['amulet'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////
$task_id=33;// Тренируй силу до 40
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['_str'] < '40'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.($user['_str']*3).'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=40 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$item_32=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `rune` >= "1" AND `equip`="1" '),0);
$task_id=32;// Установи 4 руны обычного качества и выше
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($item_32 <= 4)
{$run=item_32;}
else{$run=4;}

$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$run.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////////
$item_34=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `smith` >= "6" AND `equip`="1" '),0);
$task_id=34;// Заточи все вещи на +6
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$item_34.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////






$item_41=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `rune` >= "2" AND `equip`="1" '),0);
$task_id=41;// Установи 2 руны необычного качества и выше
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($item_41 <= 2)
{$run=item_41;}
else{$run=2;}

$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$run.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////////
$task_id=36;// Улучши амулет до 9
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$user['amulet'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////
$task_id=40;// Убей оборотня в пещере
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>19){$lair=1;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $user['lair'] > '19'){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////
$task_id=39;// Убей 3 волков
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>16){$lair=1;}
if($user['lair']>17){$lair=2;}
if($user['lair']>18){$lair=3;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
///////////////////////////
$item_44=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `smith` >= "8" AND `equip`="1" '),0);
$task_id=44;// Заточи все вещи на +8
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$item_44.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////
$task_id=42;// Набери 1500 брони
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['def'] < '1500'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.$user['def'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=1500 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$task_id=43;// Тренируй силу до 45
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['_vit'] < '45'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.($user['_vit']*3).'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=45 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$item_45=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `quality` >= "5" AND `equip`="1" '),0);
$task_id=45;// Надень 6 необычных вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$item_45.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////




$task_id=47;// Убей оборотня в пещере
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>24){$lair=1;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $user['lair'] > '24'){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////
$task_id=46;// Убей 3 волков
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>21){$lair=1;}
if($user['lair']>22){$lair=2;}
if($user['lair']>23){$lair=3;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
///////////////////////////
$task_id=48;// Набери 1500 брони
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['str'] < '2000'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.$user['str'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=2000 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$task_id=49;// Тренируй силу до 45
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['_def'] < '50'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.($user['_def']*3).'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=50 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$item_50=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `rune` >= "3" AND `equip`="1" '),0);
$task_id=50;// Установи 4 руны обычного качества и выше
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($item_50 <= 4)
{$run=item_50;}
else{$run=4;}

$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$run.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////////
$item_51=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `smith` >= "12" AND `equip`="1" '),0);
$task_id=51;// Заточи все вещи на +6
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$item_51.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////
$task_id=54;// Улучши амулет до 9
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$user['amulet'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////





$task_id=56;// Убей оборотня в пещере
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>28){$lair=1;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $user['lair'] > '28'){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////
$task_id=55;// Убей 3 волков
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>25){$lair=1;}
if($user['lair']>26){$lair=2;}
if($user['lair']>27){$lair=3;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
///////////////////////////
$task_id=58;// Набери 1500 брони
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['vit'] < '2500'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.$user['vit'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=2500 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$item_60=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `quality` >= "5" AND `equip`="1" '),0);
$task_id=60;// Надень 6 эпических вещей
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$item_60.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////
$item_61=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `smith` >= "18" AND `equip`="1" '),0);
$task_id=61;// Заточи все вещи на +6
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$item_61.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////
$item_62=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `rune` >= "3" AND `equip`="1" '),0);
$task_id=62;// Установи 4 руны обычного качества и выше
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($item_62 <= 6)
{$run=item_62;}
else{$run=6;}

$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$run.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////////


$task_id=63;// Тренируй силу до 45
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['_def'] < '90'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.($user['_def']*3).'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=90 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$task_id=64;// Улучши амулет до 9
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$user['amulet'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////


$task_id=66;// Убей оборотня в пещере
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>32){$lair=1;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $user['lair'] > '32'){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////
$task_id=65;// Убей 3 волков
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>29){$lair=1;}
if($user['lair']>30){$lair=2;}
if($user['lair']>31){$lair=3;}

$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
///////////////////////////
$task_id=68;// Тренируй силу до 45
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['_vit'] < '120'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.($user['_vit']*3).'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=120 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$task_id=69;// Улучши амулет до 9
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$user['amulet'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////
$item_70=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `rune` >= "4" AND `equip`="1" '),0);
$task_id=70;// Установи 4 руны обычного качества и выше
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($item_70 <= 2)
{$run=item_70;}
else{$run=2;}

$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$run.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////////
$task_id=71;// Набери 1500 брони
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['str'] < '3100'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.$user['str'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=3100 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////




$task_id=74;// Убей оборотня в пещере
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>36){$lair=1;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $user['lair'] > '36'){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////
$task_id=73;// Убей 3 волков
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>33){$lair=1;}
if($user['lair']>34){$lair=2;}
if($user['lair']>35){$lair=3;}

$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
///////////////////////////
$task_id=75;// Тренируй силу до 45
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['_def'] < '135'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.($user['_def']*3).'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=135 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////

$task_id=76;// Набери 1500 брони
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['vit'] < '3750'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.$user['vit'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=3750 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$task_id=77;// Улучши амулет до 9
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$user['amulet'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////
$item_79=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `smith` >= "25" AND `equip`="1" '),0);
$task_id=79;// Заточи все вещи на +6
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$item_79.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////
$item_80=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `rune` >= "4" AND `equip`="1" '),0);
$task_id=80;// Установи 4 руны обычного качества и выше
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($item_80 <= 4)
{$run=item_80;}
else{$run=4;}

$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$run.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////////

$task_id=81;// Тренируй силу до 45
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['_str'] < '150'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.($user['_str']*3).'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=150 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$item_82=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `rune` >= "4" AND `equip`="1" '),0);
$task_id=82;// Установи 4 руны обычного качества и выше
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($item_82 <= 6)
{$run=item_82;}
else{$run=6;}

$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$run.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////////
$task_id=83;// Улучши амулет до 9
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$user['amulet'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////
$item_84=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `smith` >= "28" AND `equip`="1" '),0);
$task_id=84;// Заточи все вещи на +6
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$item_84.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////
$task_id=86;// Убей оборотня в пещере
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>40){$lair=1;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $user['lair'] > '40'){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////
$task_id=85;// Убей 3 волков
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>37){$lair=1;}
if($user['lair']>38){$lair=2;}
if($user['lair']>39){$lair=3;}

$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
///////////////////////////
$task_id=87;// Набери 1500 брони
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['def'] < '4300'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.$user['def'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=4300 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$task_id=90;// Прокачай все умения до 1 уровня
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['ability_1']>=30){$ability+=1;}
if($user['ability_2']>=30){$ability+=1;}
if($user['ability_3']>=30){$ability+=1;}
if($user['ability_4']>=30){$ability+=1;}
if($user['ability_5']>=30){$ability+=1;}
if($user['ability_6']>=30){$ability+=1;}
if($user['ability_7']>=30){$ability+=1;}
if($user['ability_8']>=30){$ability+=1;}
if($user['ability_9']>=30){$ability+=1;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$ability.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////


$task_id=91;// Прокачай все умения до 1 уровня
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['ability_1']>=35){$ability+=1;}
if($user['ability_2']>=35){$ability+=1;}
if($user['ability_3']>=35){$ability+=1;}
if($user['ability_4']>=35){$ability+=1;}
if($user['ability_5']>=35){$ability+=1;}
if($user['ability_6']>=35){$ability+=1;}
if($user['ability_7']>=35){$ability+=1;}
if($user['ability_8']>=35){$ability+=1;}
if($user['ability_9']>=35){$ability+=1;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$ability.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////
$task_id=92;// Тренируй силу до 45
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['_def'] < '165'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.($user['_def']*3).'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=165 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$task_id=93;// Тренируй силу до 45
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['_vit'] < '165'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.($user['_vit']*3).'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=165 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$task_id=95;// Убей оборотня в пещере
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>44){$lair=1;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $user['lair'] > '44'){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////
$task_id=94;// Убей 3 волков
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>41){$lair=1;}
if($user['lair']>42){$lair=2;}
if($user['lair']>43){$lair=3;}

$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
///////////////////////////
$task_id=96;// Набери 1500 брони
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['str'] < '5000'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.$user['str'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=5000 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$item_97=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `smith` >= "32" AND `equip`="1" '),0);
$task_id=97;// Заточи все вещи на +6
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$item_97.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////
$task_id=100;// Улучши амулет до 9
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$user['amulet'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////
$item_101=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `rune` >= "4" AND `equip`="1" '),0);
$task_id=101;// Установи 4 руны обычного качества и выше
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($item_101 <= 7)
{$run=item_101;}
else{$run=8;}

$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$run.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////////


$task_id=102;// Улучши амулет до 9
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$user['amulet'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////
$task_id=103;// Тренируй силу до 45
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['_str'] < '180'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.($user['_str']*3).'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=180 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$task_id=104;// Прокачай все умения до 1 уровня
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['ability_1']>=38){$ability+=1;}
if($user['ability_2']>=38){$ability+=1;}
if($user['ability_3']>=38){$ability+=1;}
if($user['ability_4']>=38){$ability+=1;}
if($user['ability_5']>=38){$ability+=1;}
if($user['ability_6']>=38){$ability+=1;}
if($user['ability_7']>=38){$ability+=1;}
if($user['ability_8']>=38){$ability+=1;}
if($user['ability_9']>=38){$ability+=1;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$ability.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////
$task_id=105;// Тренируй силу до 45
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['_vit'] < '180'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.($user['_vit']*3).'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=180 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$task_id=107;// Убей оборотня в пещере
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>48){$lair=1;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $user['lair'] > '48'){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////
$task_id=106;// Убей 3 волков
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>45){$lair=1;}
if($user['lair']>46){$lair=2;}
if($user['lair']>47){$lair=3;}

$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
///////////////////////////
$task_id=108;// Набери 1500 брони
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['def'] < '5500'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.$user['def'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=5500 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$item_110=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `smith` >= "36" AND `equip`="1" '),0);
$task_id=110;// Заточи все вещи на +6
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$item_110.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////
$task_id=111;// Набери 1500 брони
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['vit'] < '5900'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.$user['vit'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=5900 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$item_112=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `rune` >= "5" AND `equip`="1" '),0);
$task_id=112;// Установи 4 руны обычного качества и выше
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($item_112 <= 7)
{$run=item_112;}
else{$run=2;}

$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$run.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////////




$task_id=114;// Набери 1500 брони
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['str'] < '6300'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.$user['str'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=6300 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$task_id=115;// Улучши амулет до 9
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$user['amulet'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////
$item_116=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `smith` >= "39" AND `equip`="1" '),0);
$task_id=116;// Заточи все вещи на +6
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$item_116.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////
$task_id=117;// Тренируй силу до 45
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['_def'] < '195'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.($user['_def']*3).'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=195 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$task_id=118;// Прокачай все умения до 1 уровня
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['ability_1']>=40){$ability+=1;}
if($user['ability_2']>=40){$ability+=1;}
if($user['ability_3']>=40){$ability+=1;}
if($user['ability_4']>=40){$ability+=1;}
if($user['ability_5']>=40){$ability+=1;}
if($user['ability_6']>=40){$ability+=1;}
if($user['ability_7']>=40){$ability+=1;}
if($user['ability_8']>=40){$ability+=1;}
if($user['ability_9']>=40){$ability+=1;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$ability.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////
$task_id=119;// Тренируй силу до 45
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['_vit'] < '195'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.($user['_vit']*3).'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=195 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$item_120=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `rune` >= "5" AND `equip`="1" '),0);
$task_id=120;// Установи 4 руны обычного качества и выше
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($item_120 <= 7)
{$run=item_120;}
else{$run=4;}

$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$run.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////////
$task_id=122;// Убей оборотня в пещере
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>52){$lair=1;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $user['lair'] > '52'){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////
$task_id=121;// Убей 3 волков
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>49){$lair=1;}
if($user['lair']>50){$lair=2;}
if($user['lair']>51){$lair=3;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
///////////////////////////


$item_123=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `rune` >= "5" AND `equip`="1" '),0);
$task_id=123;// Установи 4 руны обычного качества и выше
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($item_123 <= 7)
{$run=item_123;}
else{$run=5;}

$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$run.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////////
$task_id=124;// Набери 1500 брони
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['vit'] < '6900'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.$user['vit'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=6900 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$task_id=125;// Прокачай все умения до 1 уровня
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['ability_1']>=44){$ability+=1;}
if($user['ability_2']>=44){$ability+=1;}
if($user['ability_3']>=44){$ability+=1;}
if($user['ability_4']>=44){$ability+=1;}
if($user['ability_5']>=44){$ability+=1;}
if($user['ability_6']>=44){$ability+=1;}
if($user['ability_7']>=44){$ability+=1;}
if($user['ability_8']>=44){$ability+=1;}
if($user['ability_9']>=44){$ability+=1;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$ability.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////
$task_id=127;// Тренируй силу до 45
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['_def'] < '210'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.($user['_def']*3).'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=210 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$task_id=129;// Убей оборотня в пещере
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>56){$lair=1;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $user['lair'] > '56'){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////
$task_id=128;// Убей 3 волков
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>53){$lair=1;}
if($user['lair']>54){$lair=2;}
if($user['lair']>55){$lair=3;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
///////////////////////////






$item_130=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `rune` >= "5" AND `equip`="1" '),0);
$task_id=130;// Установи 4 руны обычного качества и выше
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($item_130 <= 7)
{$run=item_130;}
else{$run=6;}

$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$run.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////////
$task_id=131;// Набери 1500 брони
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['str'] < '7400'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.$user['str'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=7400 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$task_id=132;// Прокачай все умения до 1 уровня
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['ability_1']>=50){$ability+=1;}
if($user['ability_2']>=50){$ability+=1;}
if($user['ability_3']>=50){$ability+=1;}
if($user['ability_4']>=50){$ability+=1;}
if($user['ability_5']>=50){$ability+=1;}
if($user['ability_6']>=50){$ability+=1;}
if($user['ability_7']>=50){$ability+=1;}
if($user['ability_8']>=50){$ability+=1;}
if($user['ability_9']>=50){$ability+=1;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$ability.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////
$item_133=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `smith` >= "48" AND `equip`="1" '),0);
$task_id=133;// Заточи все вещи на +6
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$item_133.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////
$task_id=134;// Тренируй силу до 45
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['_def'] < '215'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.($user['_def']*3).'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=215 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$task_id=135;// Тренируй силу до 45
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['_vit'] < '225'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.($user['_vit']*3).'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=225 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$task_id=140;// Убей оборотня в пещере
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>60){$lair=1;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $user['lair'] > '60'){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////
$task_id=139;// Убей 3 волков
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>57){$lair=1;}
if($user['lair']>58){$lair=2;}
if($user['lair']>59){$lair=3;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
///////////////////////////

$item_141=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `rune` >= "5" AND `equip`="1" '),0);
$task_id=141;// Установи 4 руны обычного качества и выше
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($item_141 <= 7)
{$run=item_141;}
else{$run=8;}

$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$run.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////////

$task_id=142;// Набери 1500 брони
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['def'] < '7700'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.$user['def'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=7700 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$task_id=143;// Набери 1500 брони
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['vit'] < '7700'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.$user['vit'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=7700 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$task_id=144;// Прокачай все умения до 1 уровня
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['ability_1']>=55){$ability+=1;}
if($user['ability_2']>=55){$ability+=1;}
if($user['ability_3']>=55){$ability+=1;}
if($user['ability_4']>=55){$ability+=1;}
if($user['ability_5']>=55){$ability+=1;}
if($user['ability_6']>=55){$ability+=1;}
if($user['ability_7']>=55){$ability+=1;}
if($user['ability_8']>=55){$ability+=1;}
if($user['ability_9']>=55){$ability+=1;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$ability.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////
$task_id=145;// Тренируй силу до 45
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['_str'] < '230'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.($user['_str']*3).'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=230 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$task_id=146;// Улучши амулет до 9
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$user['amulet'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////

$task_id=150;// Убей оборотня в пещере
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>64){$lair=1;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $user['lair'] > '64'){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////
$task_id=149;// Убей 3 волков
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>61){$lair=1;}
if($user['lair']>62){$lair=2;}
if($user['lair']>63){$lair=3;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
///////////////////////////




$task_id=151;// Убей 3 волков
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>65){$lair=1;}
if($user['lair']>66){$lair=2;}
if($user['lair']>67){$lair=3;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
///////////////////////////


$task_id=152;// Набери 1500 брони
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['str'] < '8600'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.$user['str'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=8600 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////



$task_id=153;// Улучши амулет до 9
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$user['amulet'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////


$task_id=154;// Набери 1500 брони
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['valor'] < '45'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.$user['valor'].'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=45 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////

$task_id=155;// Прокачай все умения до 1 уровня
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['ability_1']>=60){$ability+=1;}
if($user['ability_2']>=60){$ability+=1;}
if($user['ability_3']>=60){$ability+=1;}
if($user['ability_4']>=60){$ability+=1;}
if($user['ability_5']>=60){$ability+=1;}
if($user['ability_6']>=60){$ability+=1;}
if($user['ability_7']>=60){$ability+=1;}
if($user['ability_8']>=60){$ability+=1;}
if($user['ability_9']>=60){$ability+=1;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$ability.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////


$task_id=156;// Тренируй силу до 45
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['_def'] < '240'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.($user['_def']*3).'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=240 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////
$task_id=157;// Тренируй силу до 45
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){ 
if($user['_vit'] < '260'){                           
mysql_query ('UPDATE `task_user` SET `how`="'.($user['_vit']*3).'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}else{
mysql_query ('UPDATE `task_user` SET `how`=260 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}}
/////////////////////////

$task_id=158;// Убей оборотня в пещере
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
if($user['lair']>68){$lair=1;}
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how'] AND $user['lair'] > '68'){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$lair.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////


$item_161=mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user`= "'.$user['id'].'" AND `smith` >= "60" AND `equip`="1" '),0);
$task_id=161;// Заточи все вещи на +6
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                          
mysql_query ('UPDATE `task_user` SET `how`="'.$item_161.'" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
////////////////////////////






































?>
