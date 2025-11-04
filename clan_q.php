<?
/*автор Козлов Евгений
любое распространение без прав автора запрещается
будте умнее, пусть будет у вас что то унекальное, а не копия копий.
https://vk.com/id159303176 
*/
include './system/common.php';
include './system/functions.php';
include './system/user.php';
if(!$user) {
header('location: /');
exit;
}
$id = _string(_num($_GET['id']));
if(!$id && $clan) {
    $id = $clan['id'];
}
$i = mysql_fetch_array(mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$id.'" LIMIT 1'));
	if(!$i) {
	header('location: /clans/');
	exit;
	}
	$title = 'Клановые задания';    
include './system/h.php';
if(date('w') != 1 AND date('w') != 7){
	$clans_q = mysql_fetch_array(mysql_query('SELECT * FROM `clans_q` WHERE `clans` = "'.$id.'" LIMIT 1'));
	if(!$clans_q){
	mysql_query('INSERT INTO `clans_q` SET `clans` = "'.$id.'"');
	mysql_query('UPDATE `clan_memb` SET `plat` = "0" WHERE `clan` = "'.$id.'"');
	mysql_query('UPDATE `clans` SET `plat` = "0", `plat_drag` = "0" WHERE `id` = "'.$id.'"');
	header('location: /clan/'.$id.'/quest/');
	}
if (isset($_SESSION['ok'])){
echo "<div class='ok'><center> ".$_SESSION['ok']."</center></div>";
$_SESSION['ok']=NULL;
}
if (isset($_SESSION['err'])){
echo "<div class='ok'><center> ".$_SESSION['err']."</center></div>";
$_SESSION['err']=NULL;
}
echo '

<div class="bdr cnr mb10 bg_green mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="fl ml10 mt5 mb5 mr10 sh"><img class="task_img" src="http://144.76.127.94/view/image/task/clan_task.png" width="80px"></div>

		<div class="ml10 mt5 mb5 mr10 sh small">
		<span class="medium lwhite bold tdn">Выполняй задания и добывай алмазы для клана</span><br>
	</div>

	<div class="ml10 mt5 mb5 mr10 sh lorange small">
		Собрано алмазов: <img src="http://144.76.127.94/view/image/icons/diamond.png" class="icon">  '.($clan['plat']).' 	</div>
		<div class="clb"></div>
</div></div></div></div></div></div></div></div></div>



';
$locainfo = array("","<div class='ml10 mt5 mb5 mr10 sh small cntr'>
				<span class='medium lwhite tdn'><img src='http://144.76.127.94/view/image/icons/task.png' class=icon> Проведи 1.000 боев на арене.</span></div><div class='ml10 mb5 mr10 sh small cntr'><span class='green2'>Прогресс: ".$clans_q['q_1']." из 1.000</span></div>",
						"<div class='ml10 mt5 mb5 mr10 sh small cntr'>
				<span class='medium lwhite tdn'><img src='http://144.76.127.94/view/image/icons/task.png' class=icon> Проведи 2.500 боев на арене.</span></div><div class='ml10 mb5 mr10 sh small cntr'><span class='green2'>Прогресс: ".$clans_q['q_2']." из 2.500</span></div>",
						"<div class='ml10 mt5 mb5 mr10 sh small cntr'>
				<span class='medium lwhite tdn'><img src='http://144.76.127.94/view/image/icons/task.png' class=icon> Проведи 100 боев в подземелье.</span></div><div class='ml10 mb5 mr10 sh small cntr'><span class='green2'>Прогресс: ".$clans_q['q_3']." из 100</span></div>",
						"<div class='ml10 mt5 mb5 mr10 sh small cntr'>
				<span class='medium lwhite tdn'><img src='http://144.76.127.94/view/image/icons/task.png' class=icon> Проведи 250 боев в подземелье.</span></div><div class='ml10 mb5 mr10 sh small cntr'><span class='green2'>Прогресс: ".$clans_q['q_4']." из 250</span></div>",
						"<div class='ml10 mt5 mb5 mr10 sh small cntr'>
				<span class='medium lwhite tdn'><img src='http://144.76.127.94/view/image/icons/task.png' class=icon> Пополни казну на 300 золота.</span></div><div class='ml10 mb5 mr10 sh small cntr'><span class='green2'>Прогресс: ".$clans_q['q_5']." из 300</span></div>",
						"<div class='ml10 mt5 mb5 mr10 sh small cntr'>
				<span class='medium lwhite tdn'><img src='http://144.76.127.94/view/image/icons/task.png' class=icon> Пополни казну на 300.000 серебра.</span></div><div class='ml10 mb5 mr10 sh small cntr'><span class='green2'>Прогресс: ".$clans_q['q_6']." из 300.000 </span></div>",
						"<div class='ml10 mt5 mb5 mr10 sh small cntr'>
				<span class='medium lwhite tdn'><img src='http://144.76.127.94/view/image/icons/task.png' class=icon> Набери 1.000.000 опыта.</span></div><div class='ml10 mb5 mr10 sh small cntr'><span class='green2'>Прогресс: ".$clans_q['q_7']." из 1.000.000 </span></div>",
						"<div class='ml10 mt5 mb5 mr10 sh small cntr'>
				<span class='medium lwhite tdn'><img src='http://144.76.127.94/view/image/icons/task.png' class=icon> Набери 500.000 серебра.</span></div><div class='ml10 mb5 mr10 sh small cntr'><span class='green2'>Прогресс: ".$clans_q['q_8']." из 500.000 </span></div>",
						"<div class='ml10 mt5 mb5 mr10 sh small cntr'>
				<span class='medium lwhite tdn'><img src='http://144.76.127.94/view/image/icons/task.png' class=icon> Набери Собери 25 ключиков.</span></div><div class='ml10 mb5 mr10 sh small cntr'><span class='green2'>Прогресс: ".$clans_q['q_9']." из 25 </span></div>",
						"<div class='ml10 mt5 mb5 mr10 sh small cntr'>
				<span class='medium lwhite tdn'><img src='http://144.76.127.94/view/image/icons/task.png' class=icon> Собери 80 ключиков.</span></div><div class='ml10 mb5 mr10 sh small cntr'><span class='green2'>Прогресс: ".$clans_q['q_10']." из 80 </span></div>"
				);//наш прогрес
$locainfo_q = array("","1000","2500","100","250","300","300000","100000","50000","25","80");//сколько осталось
$self = array("","arena","arena","lair","lair","clan/money","clan/money","arena","arena","task/daily","task/daily");//ссылки на локации
$locainfo_end = array("","Проведи 1000 боев на арене.</br>Будет тоступно через "._time($clans_q['1_time'] - time())."",
						"Проведи 2500 боев на арене.</br>Будет тоступно через "._time($clans_q['2_time'] - time())."",
						"Проведи 100 в подземелье.</br>Будет тоступно через "._time($clans_q['3_time'] - time())."",
						"Проведи 250 боев в подземелье.</br>Будет тоступно через "._time($clans_q['4_time'] - time())."",
						"Пополни казну на 300 золота.</br>Будет тоступно через "._time($clans_q['5_time'] - time())."",
						"Пополни казну на 300.000 серебра.</br>Будет тоступно через "._time($clans_q['6_time'] - time())."",
						"Набери 1000000 опыта.</br>Будет тоступно через "._time($clans_q['7_time'] - time())."",
						"Набери 500000 серебра.</br>Будет тоступно через "._time($clans_q['8_time'] - time())."",
						"Собери 25 ключиков.</br>Будет тоступно через "._time($clans_q['9_time'] - time())."",
						"Собери 80 ключиков..</br>Будет тоступно через "._time($clans_q['10_time'] - time())."

						");//время до обнуления
$gold = array("","100","100","100","100","100","100","100","100","100","100"); //золото награда
$silver = array("","10000","10000","10000","10000","10000","10000","10000","10000","10000","10000"); //серебро 
$exp = array("","10000","10000","10000","10000","10000","10000","10000","10000","10000","10000"); //опыт
$kristall = rand(5,30);
	for($a = 1; $a < 11; $a++){
	if(isset($_GET['go'])){
		
	$go = abs(intval($_GET['go']));
	if($go == $a){
		if($clans_q['user_'.$a] != 0) {
			$_SESSION['err'] = "Нельзя";
	header('location:/clan/'.$id.'/quest/');
			exit;
		}
		if($clans_q[$a.'_time'] != 0) {
			$_SESSION['err'] = "Нельзя";
	header('location:/clan/'.$id.'/quest/');
			exit;
		}
	mysql_query('UPDATE `clans_q` SET `user_'.$a.'` = "'.$user['id'].'" WHERE `clans` = "'.$id.'"');
	mysql_query('INSERT INTO `clan_q_user` SET `clans` = "'.$id.'", `user` = "'.$user['id'].'", `time` = "'.(time() + 86400 * 3).'"');
	//время 2 дня на выполнение 
	header("location:/".$self[$a]."/");
	}
	}
	if(isset($_GET['go2'])){
	$go = abs(intval($_GET['go2']));
	if($go == $a){
		if ($clans_q['user_'.$a.'_p'] != 0) {
			$_SESSION['err'] = "Нельзя";
	header('location:/clan/'.$id.'/quest/');
			exit;
		}
	mysql_query('UPDATE `clans_q` SET `user_'.$a.'_p` = "'.$user['id'].'" WHERE `clans` = "'.$id.'"');
	header("location:/".$self[$a]."/");
	}
	}
	$clans_user = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$clans_q['user_'.$a].'" LIMIT 1'));
	$clans_user_p = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$clans_q['user_'.$a.'_p'].'" LIMIT 1'));
	if(isset($_GET['end'])){
		
	$end = abs(intval($_GET['end']));
	if($end == $a){
		if ($clans_q['user_'.$a] != $user['id']) {
			$_SESSION['err'] = "Нельзя";
	header('location:/clan/'.$id.'/quest/');
			exit;
		}
	mysql_query('UPDATE `clans_q` SET `user_'.$a.'` = "0", `user_'.$a.'_p` = "0", `q_'.$a.'` = "0" WHERE `clans` = "'.$id.'"');
	mysql_query('DELETE FROM `clan_q_user` WHERE `clans` = "'.$id.'" AND `user` = "'.$clans_q['user_'.$a].'"');
	header('location:/clan/'.$id.'/quest/');
	}
	}
	if(isset($_GET['end2'])){
		
	$end = abs(intval($_GET['end2']));
	if($end == $a){
		if ($clans_q['user_'.$a.'_p'] != $user['id']) {
			$_SESSION['err'] = "Нельзя";
	header('location:/clan/'.$id.'/quest/');
			exit;
		}
	mysql_query('UPDATE `clans_q` SET  `user_'.$a.'_p` = "0" WHERE `user_'.$a.'_p` = "'.$user['id'].'"');
	mysql_query('DELETE FROM `clan_q_user` WHERE `clans` = "'.$id.'" AND `user` = "'.$clans_q['user_'.$a.'_p'].'"');
	header('location:/clan/'.$id.'/quest/');
	}
	}
	if(isset($_GET['enter'])){
	$enter = abs(intval($_GET['enter']));
	if($enter == $a){
		if ($clans_q['user_'.$a] != $user['id']) {
			$_SESSION['err'] = "Нельзя";
	header('location:/clan/'.$id.'/quest/');
			exit;
		}
	if($clans_q['user_'.$a.'_p'] == 0){
	$text = "".nick($user['id'])."</a> выполнил задание, + <img src='http://144.76.127.94/view/image/icons/diamond.png' class=icon> ".$kristall."  алмазов";
	}else{
	$text = " ".nick($clans_user_p['id'])."</a> и  ".nick($clans_user_p['id'])." </a> выполнили задание, +  <img src='http://144.76.127.94/view/image/icons/diamond.png' class=icon> ".$kristall."  алмазов";
	}
	mysql_query("INSERT INTO `clan_chat` (`clan`, `user`,`text`, `time`) VALUES ('".$id."', '0','".$text."','".time()."')"); 
	mysql_query('UPDATE `clans_q` SET `user_'.$a.'` = "0", `user_'.$a.'_p` = "0", `q_'.$a.'` = "0", `'.$a.'_time` = "'.(time() + 3600 * 10).'" WHERE `clans` = "'.$id.'"');
	mysql_query('UPDATE `users` SET `g` = `g` + "'.$gold[$a].'", `exp` = `exp` + "'.$exp[$a].'" WHERE `id` = "'.$user['id'].'"');
	mysql_query('UPDATE `clans` SET `plat` = `plat` + "'.$kristall.'", `plat_drag` = `plat_drag` + "'.$kristall.'" WHERE `id` = "'.$id.'"');
	mysql_query('UPDATE `clan_memb` SET `plat` = `plat` + "'.$kristall.'" WHERE `user` = "'.$user['id'].'"');
	mysql_query('DELETE FROM `clan_q_user` WHERE `clans` = "'.$id.'" AND `user` = "'.$clans_q['user_'.$a].'"');
	$_SESSION['ok'] = "<div class='bntf'><div class='nl'><div class='nr cntr lyell lh1 p5 sh small'> Награда: <img src='/images/ico/png/gold.png' class=icon> $gold[$a] <img src='/images/ico/png/exp.png' class=icon> $exp[$a] <img src='http://144.76.127.94/view/image/icons/diamond.png' class=icon> $kristall</div></div></div><div class='hr_g mb2'><div><div></div></div></div>";
	header('location:/clan/'.$id.'/quest/');
	}
	}
	$progres = round(($clans_q['q_'.$a]/$locainfo_q[$a])*100);
	$q = mysql_num_rows(mysql_query ('SELECT * FROM `clan_q_user` WHERE `user` = "'.$user['id'].'" AND `clans` = "'.$id.'"'));
	$time_user = mysql_fetch_array(mysql_query ('SELECT * FROM `clan_q_user` WHERE `user` = "'.$clans_q['user_'.$a].'" AND `clans` = "'.$id.'"'));
	if($clans_q[$a.'_time'] < time() AND $clans_q[$a.'_time'] != 0){
	mysql_query('UPDATE `clans_q` SET `'.$a.'_time` = "0" WHERE `clans` = "'.$id.'"');
	header('location: /clan/'.$id.'/quest/');
	}
	if($time_user['time'] < time() AND $time_user['time'] != 0){
	mysql_query('DELETE FROM `clan_q_user` WHERE `clans` = "'.$id.'" AND `user` = "'.$clans_q['user_'.$a].'"');
	mysql_query('UPDATE `clans_q` SET `user_'.$a.'` = "0", `user_'.$a.'_p` = "0", `q_'.$a.'` = "0" WHERE `clans` = "'.$id.'"');
	header('location: /clan/'.$id.'/quest/');
	}
	if($clans_q['q_'.$a] > $locainfo_q[$a]){
	mysql_query('UPDATE `clans_q` SET `q_'.$a.'` = "'.$locainfo_q[$a].'" WHERE `clans` = "'.$id.'"');
	header('location: /clan/'.$id.'/quest/');
	}
    if ($q!=0) {

echo "".($clans_q['user_'.$a] == $user['id']) ? "
<div class='bdr bg_blue mb2'><div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'><div class='ml10 mt5 mr10 mb5 cntr'>
".$locainfo[$a]."
Выполняет: ".nick($clans_user['id'])." </a>
".($clans_q['user_'.$a.'_p'] != 0 ? " ".nick($clans_user_p['id'])."</a>":"")."<br>
<font color=lime>Осталось: ".(_time($time_user['time'] - time()))."</font>
 ".($clans_q['q_'.$a] == $locainfo_q[$a] ? "<br/><center>Задание выполнено</center><br/>
<div class='cntr'><a href='?enter=".$a."' class='ubtn inbl  red mb10'><span class='ul'><span class='ur'>Завершить</span></span></a></div><br> 
":" 
<br><div class='cntr'><a href='/".$self[$a]."/' class='ubtn inbl  green mb10'><span class='ul'><span class='ur'>Продолжить</span></span></a></div><br> 
<div class='cntr'><a href='?end=".$a."' class='ubtn inbl  red mb10'><span class='ul'><span class='ur'>Отменить</span></span></a></div> ")." <div class='clb'></div></div></div></div></div></div></div></div></div></div></div></div></div></div>
 ":"".($clans_q[$a.'_time'] ==0 ? "
 
<div class='bdr bg_blue mb2'><div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'><div class='ml10 mt5 mr10 mb5 cntr'> ".$locainfo[$a]."</br></div>
":"")." ".($clans_q['user_'.$a.'_p'] != 0 ? "Выполняет: ".nick($clans_user['id'])." </a> ".nick($clans_user_p['id'])." ".$clans_user_p['login']."</a>
<font color=lime>Осталось: ".(_time($time_user['time'] - time()))."</font><br/><br/>
<div class='cntr'><a href='/".$self[$a]."/' class='ubtn inbl  green mb10'><span class='ul'><span class='ur'>Продолжить</span></span></a></div><br>":" ")."<div class='clb'></div></div></div></div></div></div></div></div></div></div></div></div></div></div>";

    }else{


echo "".($clans_q['user_'.$a] != 0) ? "
<div class='bdr bg_blue mb2'><div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'><div class='ml10 mt5 mr10 mb5 cntr'> ".$locainfo[$a]."
Выполняет:  ".nick($clans_user['id'])." </a> 
".($clans_q['user_'.$a.'_p'] != 0 ? " ".nick($clans_user_p['id'])." </a> " :"")."<br><font color=lime>Осталось: ".(_time($time_user['time'] - time()))."</font><br/><br/>".($clans_q['q_'.$a] == $locainfo_q[$a] ? "<center>Задание выполнено</center>":" ".($clans_q['user_'.$a.'_p'] != 0 ? "

<div class='cntr'><a href='/".$self[$a]."/' class='ubtn inbl  green mb10'><span class='ul'><span class='ur'>Продолжить</span></span></a></div><br>
<div class='cntr'><a href='?end2=".$a."' class='ubtn inbl  red mb10'><span class='ul'><span class='ur'>Отменить</span></span></a></div><br>":"
<div class='cntr'><a href='?go2=".$a."' class='ubtn inbl  green mb10'><span class='ul'><span class='ur'>Помочь</span></span></a></div><br>


")."")."":"".($clans_q[$a.'_time'] ==0 ? "
<div class='bdr bg_blue mb2'><div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'><div class='ml10 mt5 mr10 mb5 cntr'>".$locainfo[$a]."
<br><div class='cntr'><a href='?go=".$a."' class='ubtn inbl  green mb10'><span class='ul'><span class='ur'>Выполнить</span></span></a></div>":"")."<div class='clb'></div></div></div></div></div></div></div></div></div></div></div></div></div></div>";
  echo "<div class='clb'></div></div></div></div></div></div></div></div></div></div></div></div></div></div>";

	}
 
    }
  
    
	for($a = 1; $a < 9; $a++){	
	    

	    
	echo "".($clans_q[$a.'_time'] != 0 ? "
<div class='bdr cnr bg_blue mb10'><div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'><div class='ml10 mt5 mb2 mr10 sh small cntr'><div class='cntr'><span class='inbl grey1 mb5 small'>
".$locainfo_end[$a]."</span></div><div class='clb'></div></div></div></div></div></div></div></div></div></div></div></div>": "")."";

	}
	
	
	
	
?>
<div class="hr_g mb2 mt10"><div><div></div></div></div>
<div class="bntf"><div class="small"><div class="nl"><div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">
	За каждое выполненное задание клан получает от 5 до 30 алмазов (случайно), а герой золото и серебро в награду<br></div></div></div></div>
<?
	
	
}else{
$i_user = 0;
$q = mysql_query('SELECT * FROM `clan_memb` WHERE `plat` > "0"  AND `clan` = "'.$id.'" ORDER BY `plat` DESC');
while($pomog = mysql_fetch_array($q)){
$clans_user = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$pomog['user'].'"'));
$i_user++;
$messages_user_dmg.="".$i_user.". <img src='/images/icon/race/".$clans_user['r'].($clans_user['online'] > time() - 300 ? "":"-off").".png' alt='*'/> <a href='/user/".$clans_user['id']."/'>".$clans_user['login']."</a>  <img src='/images/icon/crys/diamond.png' alt='*'/> ".$pomog['plat']."</br>";
}
$gold = ($i['plat'] * 20);
$silver = ($i['plat'] * 200);
echo'<div class="resours"><center><b>Помогли клану:</b><br>';	
if($clans_user == 0) echo "Нет не кого";
echo "Всего клан зароботал <img src='/images/ico/png/diamond.png' class=icon> ".$i['plat']."</br>";
echo "Награда <img src='/images/icon/png/gold.png' class=icon> ".$gold." <img src='/images/ico/png/silver.png' class=icon> ".$silver."</br>";				
echo''.$messages_user_dmg.'</center></div>';
}
include './system/f.php';
?>