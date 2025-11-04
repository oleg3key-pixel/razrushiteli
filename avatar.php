<?
include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';

include './system/h.php';



$id = _string(_num($_GET['id']));

if(!$id && $user) {
    $id = $user['id'];
}

  $i = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"');
  $i = mysql_fetch_array($i);



$w_1 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$i['id'].'" AND `id` = "'.$i['w_1'].'"');
$w_1 = mysql_fetch_array($w_1);
if(!$w_1) {
  $w_1['item'] = 0;
}
$w_1_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_1['item'].'"');
$w_1_item = mysql_fetch_array($w_1_item);

$w_2 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$i['id'].'" AND `id` = "'.$i['w_2'].'"');
$w_2 = mysql_fetch_array($w_2);
if(!$w_2) {
  $w_2['item'] = 0;
}

$w_2_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_2['item'].'"');
$w_2_item = mysql_fetch_array($w_2_item);

$w_3 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$i['id'].'" AND `id` = "'.$i['w_3'].'"');
$w_3 = mysql_fetch_array($w_3);
if(!$w_3) {
  $w_3['item'] = 0;
}

$w_3_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_3['item'].'"');
$w_3_item = mysql_fetch_array($w_3_item);


$w_4 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$i['id'].'" AND `id` = "'.$i['w_4'].'"');
$w_4 = mysql_fetch_array($w_4);

if(!$w_4) {
  $w_4['item'] = 0;
}

$w_4_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_4['item'].'"');
$w_4_item = mysql_fetch_array($w_4_item);

$w_5 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$i['id'].'" AND `id` = "'.$i['w_5'].'"');
$w_5 = mysql_fetch_array($w_5);
if(!$w_5) {
  $w_5['item'] = 0;
}
$w_5_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_5['item'].'"');
$w_5_item = mysql_fetch_array($w_5_item);

$w_6 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$i['id'].'" AND `id` = "'.$i['w_6'].'"');
$w_6 = mysql_fetch_array($w_6);
if(!$w_6) {
  $w_6['item'] = 0;
}
$w_6_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_6['item'].'"');
$w_6_item = mysql_fetch_array($w_6_item);

$w_7 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$i['id'].'" AND `id` = "'.$i['w_7'].'"');
$w_7 = mysql_fetch_array($w_7);
if(!$w_7) {
  $w_7['item'] = 0;
}
$w_7_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_7['item'].'"');
$w_7_item = mysql_fetch_array($w_7_item);

$w_8 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$i['id'].'" AND `id` = "'.$i['w_8'].'"');
$w_8 = mysql_fetch_array($w_8);
if(!$w_8) {
  $w_8['item'] = 0;
}
$w_8_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_8['item'].'"');
$w_8_item = mysql_fetch_array($w_8_item);




echo '  <div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Мой герой
    </div>
   </div>
  </div> ';

echo '<center>
<img src="/manekenImage.php?g='.$i['sex'].
'&w_1='.$w_1['item'].
'&w_2='.$w_2['item'].
'&w_3='.$w_3['item'].
'&w_4='.$w_4['item'].
'&w_5='.$w_5['item'].
'&w_6='.$w_6['item'].
'&w_7='.$w_7['item'].
'&w_8='.$w_8['item'].'"
width="60%"></center>';


echo '<div class="hr_g mb2"><div><div></div></div></div><a class="mbtn mb2" href=/user/'.$i['id'].'><img class="icon" src="/view/image/icons/png/back.png"> Назад в профиль</a><br>
<div class="hr_g mb2"><div><div></div></div></div><div class="bntf"><div class="small"><div class="nl"><div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">
Самое лучшее снаряжение всегда можно купить в магазине</div></div></div></div>';








include ('./system/f.php');


