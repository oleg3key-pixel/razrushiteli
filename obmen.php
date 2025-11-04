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

?>

	<div class="ribbon mb2"><div class="rl"><div class="rr">
	Покупка серебра</div></div></div>	

<div class="bdr bg_main mb2"><div class="light"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8 cntr small">

	
		
		

		<div class="ml5 mr5 mt5 mb-3 shop_lgt">
			<div class="mb5 lorange"><img class="icon" src="http://144.76.127.94/view/image/icons/silver.png">5.000 Серебра</div>
			<div class="cntr"><a href="/obmen.php?act=silver1" class="ubtn green inbl mt15 mb5"><span class="ul"><span class="ur">Купить за  <img class="icon" src="http://144.76.127.94/view/image/icons/gold.png">1</span></span></a></div>
		</div>

	
		
					<div class="hr_arr mt-5 mlr10"><div class="alf"><div class="art"><div class="acn"></div></div></div></div>
		

		<div class="ml5 mr5 mt5 mb-3 shop_lgt">
			<div class="mb5 lorange"><img class="icon" src="http://144.76.127.94/view/image/icons/silver.png">50.000 Серебра</div>
			<div class="cntr"><a href="/obmen.php?act=silver2" class="ubtn green inbl mt15 mb5"><span class="ul"><span class="ur">Купить за  <img class="icon" src="http://144.76.127.94/view/image/icons/gold.png">10</span></span></a></div>
		</div>

	
		
					<div class="hr_arr mt-5 mlr10"><div class="alf"><div class="art"><div class="acn"></div></div></div></div>
		

		<div class="ml5 mr5 mt5 mb-3 shop_lgt">
			<div class="mb5 lorange"><img class="icon" src="http://144.76.127.94/view/image/icons/silver.png">500.000 Серебра</div>
			<div class="cntr"><a href="/obmen.php?act=silver3" class="ubtn green inbl mt15 mb5"><span class="ul"><span class="ur">Купить за  <img class="icon" src="http://144.76.127.94/view/image/icons/gold.png">100</span></span></a></div>
		</div>

	
		
					<div class="hr_arr mt-5 mlr10"><div class="alf"><div class="art"><div class="acn"></div></div></div></div>
		

		<div class="ml5 mr5 mt5 mb-3 shop_lgt">
			<div class="mb5 lorange"><img class="icon" src="http://144.76.127.94/view/image/icons/silver.png">5.000.000 Серебра</div>
			<div class="cntr"><a href="/obmen.php?act=silver4" class="ubtn green inbl mt15 mb5"><span class="ul"><span class="ur">Купить за  <img class="icon" src="http://144.76.127.94/view/image/icons/gold.png">1000</span></span></a></div>
		</div>

		
					<div class="hr_arr mt-5 mlr10"><div class="alf"><div class="art"><div class="acn"></div></div></div></div>
		

		<div class="ml5 mr5 mt5 mb-3 shop_lgt">
			<div class="mb5 lorange"><img class="icon" src="http://144.76.127.94/view/image/icons/silver.png">50.000.000 Серебра</div>
			<div class="cntr"><a href="/obmen.php?act=silver5" class="ubtn green inbl mt15 mb5"><span class="ul"><span class="ur">Купить за  <img class="icon" src="http://144.76.127.94/view/image/icons/gold.png">10000</span></span></a></div>
		</div>

	
</div></div></div></div></div></div></div></div></div></div>

<div class="hr_g mb2"><div><div></div></div></div>
<a href="/buy_gold.php" class="mbtn mb2"><img class="icon" src="http://144.76.127.94/view/image/icons/back.png"> Назад к золоту</a>
<div class="hr_g mb2"><div><div></div></div></div>
<div class="bntf"><div class="small"><div class="nl"><div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">
	Здесь можно обменять золото на серебро. </div></div></div></div>

<?
if($_GET['act']==silver1) {
if($user['g']>0) {
mysql_query("UPDATE `users` SET `g` = `g` - 1, `s` = `s` + 5000 WHERE `id` = ".$user['id']."");
header('location:?');
}
}
?>


<?
if($_GET['act']==silver2) {
if($user['g']>9) {
mysql_query("UPDATE `users` SET `g` = `g` - 10,`s` = `s` + 50000 WHERE `id` = ".$user['id']."");
header('location:?');
}
}
?>




<?
if($_GET['act']==silver3) {
if($user['g']>99) {
mysql_query("UPDATE `users` SET `g` = `g` - 100,`s` = `s` + 500000 WHERE `id` = ".$user['id']."");
header('location:?');
}
}
?>
<?
if($_GET['act']==silver4) {
if($user['g']>999) {
mysql_query("UPDATE `users` SET `g` = `g` - 1000,`s` = `s` + 5000000 WHERE `id` = ".$user['id']."");
header('location:?');
}
}
?>
<?
if($_GET['act']==silver5) {
if($user['g']>999) {
mysql_query("UPDATE `users` SET `g` = `g` - 10000, `s` = `s` + 50000000 WHERE `id` = ".$user['id']."");
header('location:?');
}
}
?>
<?
include './system/f.php';
?>