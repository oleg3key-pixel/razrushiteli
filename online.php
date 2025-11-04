<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';
    
if(!$user) {
header('location: /');    
exit;}

$action = _string($_GET['action']);

switch($action) {
default:
    
$title = 'Игроки онлайн';
include './system/h.php';  






echo '<div class="bdr bg_main mb2"><div class="light"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="spr2bg pt3 mlr10 cntr">
		<div class="w49 fl">
							<span class="slct"><span class="send"><span class="sttl">
					Все				</span></span></span>
					</div>
		<div class="w49 fr">
							<a href="/online/no_clan" class="pt3 inbl">
					Без клана				</a>
					</div>
		<div class="clb"></div>
	</div>
	<div class="hr_arr mlr10 mb5"><div class="alf"><div class="art"><div class="acn"></div></div></div></div>
	<div class="w200px cntr mrauto"><table class="cntr wa mlra mb5">

					<tbody><tr>
				<td class="p5 lft">Имя</td>
				<td class="p5">Рейтинг</td>';


	$max = 20;
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `users` WHERE `online` > "'.(time() - 10800).'"'),0);
if($count > '10000'){ $count=10000;}
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));

if($page > $pages) {$page = $pages;}
if($page < 1) {$page = 1;}
$start = $page * $max - $max;

$i = ($page * 10 - 10 );	


$q = mysql_query('SELECT * FROM `users` WHERE `online` > "'.(time() - 10800).'" ORDER BY `str`+`vit`+`def`  DESC LIMIT '.$start.', '.$max.'');
while($row = mysql_fetch_array($q)) {//Вывод игроков
$mmm=array($row['vit'],$row['str'],$row['def']);//Додаем параметры
$i++; 
echo '<tr><td class="lft nwr"> <a class="tdn lwhite" href="/user/'.$row['id'].'/">  '.nick($row['id']).'</a></td><td class="yell lft pl5">'.array_sum($mmm).'</td>';
}




	


echo '</tr></tbody></table></div><div class="hr_arr mt5 mlr10"><div class="alf"><div class="art"><div class="acn"></div></div></div></div></div></div></div></div></div></div></div></div></div></div><div class="hr_g"><div><div></div></div></div>';
echo '<div class="bdr bg_blue mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="ml10 mt5 mr10 mb5 cntr">';
echo''.pages('?').'';
echo '</div></div></div></div></div></div></div></div></div></div></div></div>
<div class="hr_g"><div><div></div></div></div><div class="bntf"><div class="small"><div class="nl"><div class="nr cntr lyell lh1 p5 sh"><img src="http://144.76.127.94/view/image/icons/hero_on_0.png" alt="online" class="icon"> <img src="http://144.76.127.94/view/image/icons/hero_on_1.png" alt="online" class="icon"> - игрок проявлял активность за последние 60 минут</div></div></div></div>
';


include './system/f.php';
break;








case 'no_clan':
$title = 'Игроки онлайн';
include './system/h.php';  
echo '<div class="bdr bg_main mb2"><div class="light"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="spr2bg pt3 mlr10 cntr">
		<div class="w49 fl">
							<a href="/online" class="pt3 inbl">
					Все				</a>
					</div>
		<div class="w49 fr">
							<span class="slct"><span class="send"><span class="sttl">
					Без клана				</span></span></span>
					</div>
		<div class="clb"></div>
	</div>
	<div class="hr_arr mlr10 mb5"><div class="alf"><div class="art"><div class="acn"></div></div></div></div>
	<div class="w200px cntr mrauto"><table class="cntr wa mlra mb5">';
$max = 25;
$count = mysql_num_rows(mysql_query("SELECT `id` FROM `users` WHERE (SELECT COUNT(`user`) FROM `clans_z` WHERE `user` = `users`. `id`)  = 1  and `users`.`online` > '".(time() - 10800)."'")); 
$pages = ceil($count/$max); 
$page = _string(_num($_GET['page'])); 
if($page > $pages) { 
$page = $pages; 
} 
if($page < 1) { 
$page = 1; 
} 
$start = $page * $max - $max; 
$q = "SELECT * FROM `users` WHERE (SELECT COUNT(`user`) FROM `clans_z` WHERE `user` = `users`. `id`)  = 1  and `users`.`online` > '".(time() - 10800)."' ORDER BY `online` DESC LIMIT ".$start.", ".$max.""; 
$q = mysql_query($q);
while($row = mysql_fetch_array($q)) {//Вывод игроков
$mmm=array($row['vit'],$row['str'],$row['def']);//Додаем параметры
$i++; 
echo '<tr><td class="lft nwr"> <a class="tdn lwhite" href="/user/'.$row['id'].'/">  '.nick($row['id']).'</a></td><td class="yell lft pl5">'.array_sum($mmm).' <a href=/user/'.$row['id'].'/?clan_invite=true><img width=16 class=icon src=http://144.76.125.123/view/image/icons/plus.png></a></td>';
}


					echo '<tbody><tr>
				<td class="p5 lft">Имя</td>
				<td class="p5">Рейтинг</td>
			</tr>';

$max = 25;
$count = mysql_num_rows(mysql_query("SELECT `id` FROM `users` WHERE (SELECT COUNT(`user`) FROM `clan_memb` WHERE `user` = `users`.`id`)  = 0  and `users`.`online` > '".(time() - 10800)."'")); 
$pages = ceil($count/$max); 
$page = _string(_num($_GET['page'])); 
if($page > $pages) { 
$page = $pages; 
} 
if($page < 1) { 
$page = 1; 
} 
$start = $page * $max - $max; 
$q = "SELECT * FROM `users` WHERE (SELECT COUNT(`user`) FROM `clan_memb` WHERE `user` = `users`.`id`)  = 0  and `users`.`online` > '".(time() - 10800)."' ORDER BY `online` DESC LIMIT ".$start.", ".$max.""; 
$q = mysql_query($q);
while($row = mysql_fetch_array($q)) {//Вывод игроков
$mmm=array($row['vit'],$row['str'],$row['def']);//Додаем параметры
$i++; 
echo '<tr><td class="lft nwr"> <a class="tdn lwhite" href="/user/'.$row['id'].'/">  '.nick($row['id']).'</a></td><td class="yell lft pl5">'.array_sum($mmm).'</td>';
}

if($count == '0'){
echo'<div class=small><a>Все игроки разбежались по кланам</a></div><br><br>';
}



echo '</tr></tbody></table></div><div class="hr_arr mt5 mlr10"><div class="alf"><div class="art"><div class="acn"></div></div></div></div></div></div></div></div></div></div></div></div></div></div><div class="hr_g"><div><div></div></div></div>';


echo '<div class="bdr bg_blue mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="ml10 mt5 mr10 mb5 cntr">';



echo''.pages('?').'';
echo '</div></div></div></div></div></div></div></div></div></div></div></div>
<div class="hr_g"><div><div></div></div></div><div class="bntf"><div class="small"><div class="nl"><div class="nr cntr lyell lh1 p5 sh"><img src="http://144.76.127.94/view/image/icons/hero_on_0.png" alt="online" class="icon"> <img src="http://144.76.127.94/view/image/icons/hero_on_1.png" alt="online" class="icon"> - игрок проявлял активность за последние 10 минут</div></div></div></div>';



include './system/f.php';
break;


  

case 'search':
$title = 'Поиск игрока';
include './system/h.php';  


$login = _string($_POST['login']);
  if(isset($_REQUEST['search'])){
$users = mysql_query('SELECT * FROM `users` WHERE `login` = "'.$login.'"');
$users = mysql_fetch_array($users);
  
  if($users) {
header('location: /user/'.$users['id'].'/');
}else{
	if(empty($login) or mb_strlen($login,'UTF-8') < 3){
header("Location: ?");
$_SESSION['mes'] = mes('Персонаж с таким именем не был найден!');
exit;}
}
}

     echo' '.$_SESSION['mes'].'  ';
    $_SESSION['mes']=NULL; //Удаляем сесию
echo '<div class="ribbon mb2"><div class="rl"><div class="rr">
	Поиск героя</div></div></div>



<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="ml10 mt5 mb5 mr10 sh cntr">
		<form action="/online/search/" method="post">
			Введите имя героя			<div class="mb5"></div>
			<input type="text"name="login" value="">
			<div class="mb5"></div>
			<span class="ubtn inbl green"><span class="ul"><input class="ur" name="search" type="submit" value="Поиск"></span></span>
			<div class="mb10"></div>
		</form>
	</div>
</div></div></div></div></div></div></div></div></div>
<a href="/online" class="mbtn mb2"><img src="/view/image/icons/back.png" class="icon"> Назад к онлайн</a>';
/*
echo'<div class="title">'.$title.'</div>';
     echo' '.$_SESSION['mes'].'  ';
    $_SESSION['mes']=NULL; //Удаляем сесию
echo'<div class="empty_block item_center">
  <form action="/online/search/" method="post">
    Имя персонажа:<br/><input name="login"/><br/>
    <input name="search" class="button" type="submit" value="Поиск"/>
  </form>
</div>';

echo'<div class="line"></div>
<div class="block_link"><a href="/online/"><img src="/view/image/icons/png/back.png"> Вернуться</a></div>
<div class="line"></div>';
*/

include './system/f.php';
break;
  
}
?>