<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';

$title = 'Обменник';

include './system/h.php';

if(!$user) {
header('location:/');
exit();
}
$users = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id`='".$user['lair_gold']."' ")); 
$lair_mobs = mysql_fetch_assoc(mysql_query("SELECT * FROM `lair_mobs` WHERE `id`='".$user['lair']."' ")); 
$lair = mysql_fetch_assoc(mysql_query("SELECT * FROM `lair` WHERE `id`='".$lair_mobs['glava']."' ")); 
$lair_users = mysql_fetch_assoc(mysql_query("SELECT * FROM `lair_users` WHERE `user_id`='".$user['id']."' ")); 

echo '<div class="bdr bg_main mb2"><div class="light"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8 cntr small">
	<div class="ml5 mr5 mt5 mb10">
		<div class="mb5 lorange">';

if($user['lair_gold'] < $lair_mobs['gold']) {	
echo 'Сегодня в Подземельях осталось еще <img class="icon" src="http://144.76.127.94/view/image/icons/gold.png"> '. ( $lair_mobs['gold']  - $user['lair_gold']) .'  золота</div>';
}else{
echo 'в Подземельях сегодня больше нет <img class="icon" src="http://144.76.127.94/view/image/icons/gold.png">золота		</div>';
}
if($user['lair_gold'] < $lair_mobs['gold']) {
echo '<br><div class="cntr mt5"><a href="/lair_ob.php?act=gold1" class="ubtn green inbl mt-15 mb5"><span class="ul"><span class="ur">Получить за <img class="icon" src="http://144.76.127.94/view/image/icons/silver.png"> '. (1000 * $lair_mobs['gold']  - $user['lair_gold']*1000).' </span></span></a></div>';
}
echo '<div class="ml5 mr5 mt5 cntr">
		<img src="http://144.76.127.94/view/image/lair/lair'.$lair_mobs['img'].'_nowin.jpg" alt="">
	</div><br>
</div></div></div></div></div></div></div></div></div></div></div></div></div></div>
<div class="hr_g mb2"><div><div></div></div></div>
<div class="bntf"><div class="small"><div class="nl"><div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">
	Здесь можно забрать все оставшееся на сегодня золото досрочно, без боев, но за серебро.</div></div></div></div>
<div class="hr_g mb2"><div><div></div></div></div>
<a href="/buy_gold.php" class="mbtn mb2"><img class="icon" src="http://144.76.127.94/view/image/icons/back.png"> Назад к золоту</a>';

if($_GET['act']==gold1) {
if($user['s']> 1000 * $user['lair_gold']) {
if($user['lair_gold'] < $lair_mobs['gold']) {
mysql_query("UPDATE `users` SET `s` = `s` - ". 1000 * $user['lair_gold'].", `g` = `g` + ".$lair_mobs['gold'].", `lair_gold` = `lair_gold` + ".$lair_mobs['gold']." WHERE `id` = ".$user['id']."");
echo' <div class="hr_g mb2"><div><div></div></div></div><div class="bntf"><div class="nl"><div class="nr cntr lyell lh1 p5 sh"><span class="win">Вы получили <img class="icon" src="http://144.76.127.94/view/image/icons/gold.png"> '.$lair_mobs['gold'].' Золота</span></div></div></div><div class="hr_g mb2"><div><div></div></div></div>';
header('location: /index.php');
}
}
}
include './system/f.php';
?>