<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';
include './system/h.php';  

if($_GET['open'] == 1) {
$rand = rand(1,4);
mysql_query("update `users` set `g` = `g` - 1000 where `id` = '".$user['id']."' ");
$nagrada1 = rand(1000,10000);
$nagrada2 = rand(1000,100000);
$nagrada3 = rand(1000,1000000);
$nagrada4 = rand(1000,10000);
    
if($rand == 1) {
mysql_query("update `users` set `g` = `g` + '".$nagrada1."', `open_sunduk` = `open_sunduk` + '1' where `id` = '".$user['id']."'");
echo'
<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
				<div class="mt10 mb10 mr10 sh cntr">
				
				<img src="/images/sunduk/2.png"><br><br><font color=gold>Золотой сундук открыт<br> В нём вы нашли: <img src=http://144.76.127.94/view/image/icons/gold.png class=icon> '.$nagrada1.' золота</font>
</div>
				<div class="clb"></div>
			</div></div></div></div></div></div></div></div></div></div></div></div></div></div>
			</div>
			<div class="hr_g mb2 mt10"><div><div></div></div></div><a class="mbtn mb2" href="/sunduk.php"><img class="icon" src="http://144.76.127.94/view/image/icons/back.png"> Назад к сундучкам!</a>';
include './system/f.php';
exit;}
if($rand == 2) {
mysql_query("update `users` set `s` = `s` + '".$nagrada2."', `open_sunduk` = `open_sunduk` + '1' where `id` = '".$user['id']."'");
echo'
<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
				<div class="mt10 mb10 mr10 sh cntr">
				<img src="/images/sunduk/2.png"><br><br><font color=gold>Золотой сундук открыт<br> В нём вы нашли: <img src=http://144.76.127.94/view/image/icons/silver.png class=icon> '.$nagrada2.' серебра</font>
</div>
				<div class="clb"></div>
			</div></div></div></div></div></div></div></div></div></div></div></div></div></div>
			</div>
			<div class="hr_g mb2 mt10"><div><div></div></div></div><a class="mbtn mb2" href="/sunduk.php"><img class="icon" src="http://144.76.127.94/view/image/icons/back.png"> Назад к сундучкам!</a>';
include './system/f.php';
exit;}
if($rand == 3) {
mysql_query("update `users` set `exp` = `exp` + '".$nagrada3."', `open_sunduk` = `open_sunduk` + '1' where `id` = '".$user['id']."'");
echo'
<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
				<div class="mt10 mb10 mr10 sh cntr">
				<img src="/images/sunduk/2.png"><br><br><font color=gold>Золотой сундук открыт<br> В нём вы нашли: <img src=http://144.76.127.94/view/image/icons/expirience.png class=icon> '.$nagrada3.' опыта</font>
</div>
				<div class="clb"></div>
			</div></div></div></div></div></div></div></div></div></div></div></div></div></div>
			</div>
			<div class="hr_g mb2 mt10"><div><div></div></div></div><a class="mbtn mb2" href="/sunduk.php"><img class="icon" src="http://144.76.127.94/view/image/icons/back.png"> Назад к сундучкам!</a>';
include './system/f.php';
exit;}
if($rand == 4) {
mysql_query("update `users` set `valor_exp` = `valor_exp` + '".$nagrada4."', `open_sunduk` = `open_sunduk` + '1' where `id` = '".$user['id']."'");
echo'
<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
				<div class="mt10 mb10 mr10 sh cntr">
				<img src="/images/sunduk/2.png"><br><br><font color=gold>Золотой сундук открыт<br> В нём вы нашли: <img src=http://144.76.127.94/view/image/icons/valor_exp.png class=icon> '.$nagrada4.' доблести</font>
</div>
				<div class="clb"></div>
			</div></div></div></div></div></div></div></div>
			</div>
			<div class="hr_g mb2 mt10"><div><div></div></div></div><a class="mbtn mb2" href="/sunduk.php"><img class="icon" src="http://144.76.127.94/view/image/icons/back.png"> Назад к сундучкам!</a>';
include './system/f.php';
exit;}




}
echo'<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8"><div class="mt10 mb10 mr10 sh cntr">';
if($user['open_sunduk'] < 2) echo '<img src=/images/sunduk/1.png>';
if($user['open_sunduk'] > 1) echo '<img src=/images/sunduk/2.png>';
if($user['open_sunduk'] < 3) echo '<img src=/images/sunduk/1.png>';
if($user['open_sunduk'] > 2) echo '<img src=/images/sunduk/2.png>';
if($user['open_sunduk'] < 4) echo '<img src=/images/sunduk/1.png>';
if($user['open_sunduk'] > 3) echo '<img src=/images/sunduk/2.png>';
echo'<div class="clb"></div></div></div></div></div></div></div></div></div></div></div></div></div>';
if($user['open_sunduk'] < 4) echo '<br><div class="cntr"><a href="?open=1" class="ubtn inbl mt-15 green mb5"><span class="ul"><span class="ur">Открыть <img src=http://144.76.127.94/view/image/icons/gold.png class=icon> 1000</span></span></a></div>';
if($user['open_sunduk'] == 4) echo '<div class="hr_g mb2"><div><div></div></div></div><div class="bntf"><div class="small"><div class="nl"><div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh"><font color=gold>Все сундуки открыты. Приходите завтра! </font></div></div></div></div>';
include './system/f.php';
?>