<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';
    
if(!$user) {//Переадресация для не авторизованных
header('location: /');    
exit;}

$id = _string(_num($_GET['id']));

if(!$id && $clan) {
    $id = $clan['id'];
}

  $i = mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$id.'"');
  $i = mysql_fetch_array($i);

  if(!$i) { //Если не состоите в клане  
header('location: /v_clans.php'); 
exit;}



switch($_GET['action']) {
default:
  
include './system/h.php';




$max = 10;
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_memb` WHERE `clan` = "'.$i['id'].'"'),0);
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));

if($page > $pages) {$page = $pages;}
if($page < 1) {$page = 1;}
$start = $page * $max - $max;



$q = mysql_query('SELECT * FROM `clan_memb` WHERE `clan` = "'.$i['id'].'" ORDER BY `rank` DESC,`exp` DESC LIMIT '.$start.', '.$max.'');
  while($row = mysql_fetch_array($q)) {

  $memb = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'"');
  $memb = mysql_fetch_array($memb);

  switch($row['rank']) {
  
    case 0:
    $rank = 'Новичок';
     break;
    case 1:
    $rank = 'Ветеран';
     break;
    case 2:
    $rank = 'Офицер';
     break;
    case 3:
    $rank = 'Генерал';
     break;
    case 4:
    $rank = '<span class="yell">Маршал</span>';
     break;
    case 5:
    $rank = '<span class="yell">Лидер</span>';
     break;
  }}




if($i['gerb'] > 0){ 
echo ' <div class="mrauto w200px">
   <table class="inbl">
    <tbody>
     <tr>
               <td class="lft"><img src="/images/ico/gerb/herb'.$i['gerb'].'.png" width=48 height=48> <a href="/clan?id='.$row['id'].'" class="">'.$row['name'].'</a></td>
      <td>
       <div class="bold large mb ml5">
'.$i['name'].'
       </div>
       <div class="yell ml5">
        Уровень клана: 
        <span class="">'.$i['level'].'</span>
       </div></td>
     </tr>
    </tbody>
   </table>
  </div> ';
}









if($i['gerb'] < 1){ echo '<div class="ribbon mb2"><div class="rl"><div class="rr">'.$i['name'].'</div></div></div>';
}
		
	
echo '<div class="bdr bg_main mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">			<div class="mt5 mlr10 sh yell">';




if($i['gerb'] < 1){ echo '<span class="orange_dark2 font_16"><img class="icon" src="http://144.76.127.94/view/image/icons/clan_level.png" width="20"> Уровень клана: </span><span class="">'.$i['level'].'</span>					<br>';											
}


           $b=array(
          $i['built_1']
         ,$i['built_2']
         ,$i['built_3']
         ,$i['built_4']
         ,$i['built_5']
         ,$i['built_6']
         ,$i['built_7']
         ,$i['built_8']

           );


$built_progress = round(100/(120/array_sum($b)));

    
    if($built_progress > 100) {
$built_progress = 100;      
}


echo ' <span class="orange_dark2 font_16"><img class="icon" src="http://144.76.127.94/view/image/icons/calendar.png"> О клане:</span>
            <span class="green_dark">'.$i['description'].' </span> ';
            
            
					echo '<div class="cntr mt5 mb5">
						<img class="icon" src="http://144.76.127.94/view/image/builds/build1_1.png">
						<img class="icon" src="http://144.76.127.94/view/image/builds/build2_1.png">
						<img class="icon" src="http://144.76.127.94/view/image/builds/build3_1.png">
						<img class="icon" src="http://144.76.127.94/view/image/builds/build4_1.png">
						
						<img class="icon" src="http://144.76.127.94/view/image/builds/build5_1.png">
						<img class="icon" src="http://144.76.127.94/view/image/builds/build6_1.png">


					</div>
				
				<span class=""><img class="icon" src="http://144.76.127.94/view/image/icons/expirience.png" width="20"> Опыт клана:</span><span> '.n_f($i['exp']).' из '.n_f(clan_exp($i['level'])).' </span><br>';



if($clan['id'] == $i['id'] && $clan_memb['rank'] >= 0) {	
echo'<span class=""><img class="icon" src="http://144.76.127.94/view/image/icons/diamond.png" width="20"> Алмазов в казне:</span><span> <img class="icon" src="http://144.76.127.94/view/image/icons/diamond.png" width="20">'.n_f($i['plat_drag']).'</span></div></div></div></div></div></div></div></div></div><div class="hr_g mb2"><div><div></div></div></div>';
echo'<a class="mbtn mb2" href="/clan_q.php"><img src="http://144.76.127.94/view/image/menu/clan_task.png" class="icon">&nbsp;Клановые задания</a>';
}
if($clan['id'] == $i['id'] && $clan_memb['rank'] >= 0) {	
echo'<a class="mbtn mb2" href="/clan/clan_portal"><img class="icon" src="http://144.76.127.94/view/image/icons/dragons.png"> Сокровищницы драконов </a>';
if($clan['id'] == $i['id'] && $clan_memb['rank'] >= 0) {	
echo'<a class="mbtn mb2" href="/clan/built"><img class="icon" src="http://144.76.127.94/view/image/icons/clan.png"> Клановые строения  ('.$built_progress.'%) </a>';
if($clan['id'] == $i['id'] && $clan_memb['rank'] >= 0) {
echo '<a class="mbtn mb2" href="/tour.php"><img src="http://144.76.127.94/view/image/icons/tournaments.png" class="icon"> Турниры</a>';
if($clan['id'] == $i['id'] && $clan_memb['rank'] >= 0) {
echo '<a class="mbtn mb2" href="/clan/money/"><img class="icon" src="http://144.76.127.94/view/image/icons/clan_budget.png" width="20"> Казна: <img class="icon" src="http://144.76.127.94/view/image/icons/gold.png"> '.n_f($clan['g']).' <img class="icon" src="http://144.76.127.94/view/image/icons/silver.png"> '.n_f($clan['s']).'</a>';
if($clan['id'] == $i['id'] && $clan_memb['rank'] >= 0) {		
echo '<a class="mbtn mb2" href="/clan/chat"><img class="icon" src="http://144.76.127.94/view/image/icons/clan_chat.png"> Чат клана</a> '.($_chat > 0 ? '<font color="#3c3">(+)</font>':'').'</a>';
if($clan['id'] == $i['id'] && $clan_memb['rank'] >= 0) {
echo'<a class="mbtn mb2" href="/clan_forum/'.$i['id'].'/"><img class="icon" src="http://144.76.127.94/view/image/icons/forum.png"> Форум клана </a>';
if($clan['id'] == $i['id'] && $clan_memb['rank'] >= 0) {
echo'<a class="mbtn mb2" href="/clan/clan_history"><img class="icon" src="http://144.76.127.94/view/image/icons/clan_statistic.png"> История клана </a>';
if($clan['id'] == $i['id'] && $clan_memb['rank'] >= 0) {
echo '<a class="mbtn mb2" href="/clan/msg/"><img class="icon" src="http://144.76.127.94/view/image/icons/news.png"> Новое объявление</a>';
if($clan['id'] == $i['id'] && $clan_memb['rank'] >= 0) {
echo '<a class="mbtn mb2" href="/clan/settings/"><img class="icon" src="http://144.76.127.94/view/image/icons/clan_settings.png"> Настройки</a>';
    
}}}}}}}}}
$open_1 = mysql_num_rows(mysql_query("SELECT * FROM clan_poxod_open WHERE clan = '".$clan['id']."'"));  
if ($open_1 <= 0){ 
?>



<?

if($_GET['go_poxod'] == true && $clan_memb['rank'] == 4){
	
	mysql_query("INSERT INTO clan_poxod_open SET clan = '".$clan['id']."', start = '0', nagr = '0'");
	mysql_query("INSERT INTO clan_msg SET clan = '".$clan['id']."', user = '".$user['id']."', text = 'Начался поход кланов<br>', time = '".time()."'");	
	header('location: /clanland/');	
}
}










































echo '<div><div></div></div></div></div></div></div><div></div></div></div></div><div></div></div></div></div><div>';

if($clan['id'] != $i['id']){
echo'<a class="mbtn mb2" href="/stroy/'.$i[id].'"><img class="icon" src="http://144.76.127.94/view/image/icons/clan.png"> Клановые строения  ('.$built_progress.'%) </a>';
}
if($clan['id'] != $i['id']){
echo'<a class="mbtn mb2" href="/clan_forum/'.$i['id'].'/"><img class="icon" src="http://144.76.127.94/view/image/icons/forum.png"> Форум клана </a>';
}

echo '





<div class="bdr bg_main"><div class="light"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
		<div class="mt5 mb10 mlr10 sh yell">
							<span class="clan_desc">Состав клана ('.$count.')</span>									<a href="/clan?id=33373&amp;online=1"><img class="icon" src="http://144.76.127.94/view/image/icons/hero_off_0.png"></a>
									</div>
		<div class="mt5 mb10 mlr10 sh">
		
		
		
		
		';
$q = mysql_query('SELECT * FROM `clan_memb` WHERE `clan` = "'.$i['id'].'" ORDER BY `rank` DESC,`exp` DESC LIMIT '.$start.', '.$max.'');
  while($row = mysql_fetch_array($q)) {

  $memb = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'"');
  $memb = mysql_fetch_array($memb);

  switch($row['rank']) {
  
    case 0:
    $rank = 'Новичок';
     break;
    case 1:
    $rank = 'Ветеран';
     break;
    case 2:
    $rank = 'Офицер';
     break;
    case 3:
    $rank = 'Генерал';
     break;
    case 4:
    $rank = '<span class="yell">Маршал</span>';
     break;
    case 5:
    $rank = '<span class="yell">Лидер</span>';
     break;
  }


		
if($row['v'] < 49) {
	
if($clan && $clan['id'] == $i['id'] && $row['user'] != $user['id'] && $clan_memb['rank'] < 6 ) {
echo'<span style="float: right;"><a href="/clan/memb/'.$row['id'].'/"><img src=/images/ico/png/settings.png class=icon></a></span>';
}
echo' <img src=http://144.76.127.94/view/image/icons/excl.png class=icon> <a href=/user/'.$memb['id'].' class="tdn lwhite">'.$memb['login'].'</a> <font color=orange>('.n_f($row['exp']).')</font> '.$rank.'<br><br>';
}
if($row['v'] > 49) {
if($clan && $clan['id'] == $i['id'] && $row['user'] != $user['id'] && $clan_memb['rank'] < 6 ) {
echo'<span style="float: right;"><a href="/clan/memb/'.$row['id'].'/"><img src=/images/ico/png/settings.png class=icon></a></span>';
}
echo' <a href=/user/'.$memb['id'].' class="tdn lwhite"> '.nick($memb['id']).' </a> <font color=orange>('.n_f($row['exp']).')</font> '.$rank.'<br><br>';
}
}
echo '<center>';
echo' '.pages('/clan/'.$i['id'].'/?').'';
echo '</center><br>';

echo '<div><div></div></div></div></div></div></div><div></div></div></div></div><div></div></div></div></div></div>';


if($clan && $clan['id'] == $i['id']) {




}



include './system/f.php';
break;

  
  
  
  
  
case 'exit'://Выход из клана
$title = 'Выйти из клана';    
include './system/h.php';  
if(!$clan['id'] OR $clan['id'] != $i['id'] OR $clan_memb['rank'] == 6) {
header('location: /clan/');
exit;}

  if(isset($_REQUEST['ok'])){
$exit_clan='Вы покинули или были исключены из клана <br><img class=icon src=http://144.76.127.94/view/image/icons/clan.png> <a class="tdn lwhite" href="/clan/'.$clan['id'].'">'.$clan['name'].'</a><br> Бонусы от клановых строений перестали действовать.'; 
mysql_query("INSERT INTO `mail` SET `from` = '2', `to` = '".$user['id']."', `time` = '".time()."', `read` = '0', `text` = '".$exit_clan."'");
mysql_query('UPDATE `contacts` SET `time` = \''.time().'\' WHERE `user` = '.$user['id'].' AND `ho` = "2"');

$text=' <a class="tdn lwhite" href="/user/'.$user['id'].'">'.nick($user['id']).'</a> <font color="#FF2400">покинул клан</font> '; //Текст уведомления
mysql_query("INSERT INTO `clan_history` SET `clan`='".$i['id']."',`text`='".$text."',`time`='".time()."'"); //Отправляем уведомление                                              
mysql_query('DELETE FROM `clan_memb` WHERE `clan` = "'.$clan['id'].'" AND `user` = "'.$user['id'].'"');


$_SESSION['msg'] = msg('Вы успешно покинули клан!'); 




header('location: /clans/');
exit;}


echo '<div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
     Выйти из клана 
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
     <span class="orange_dark3">Действительно навсегда покинуть клан?</span>
     <br> 
     <div class="mt5"></div>
     <a href="/clan/exit/?ok" class="ubtn mb2 green_no inbl"><span class="ul"><span class="ur"><img class="icon" src="http://144.76.127.94/view/image/icons/ok.png"> Да, покинуть</span></span></a>
     <div class="mb5"></div> 
     <a class="grey1" href="/clan/"><img class="icon" src="http://144.76.127.94/view/image/icons/error.png">Нет, остаться</a>
    </div>
   </div>
  </div> 
   <div>
    <div></div>
   </div>
  </div> ';
  

/*
     echo '<div class="empty_block item_center">
Вы действительно хотите покинуть клан? <br/>
<a href="/clan/exit/?ok"> <input class="button" type="submit" value="Да"> </a>
<div class="link_center_h"><a href="/clan/"> Нет </a></div> </div>';
echo '<div class="line"></div>';
*/
include './system/f.php';
break;

case 'settings'://Настройки клана
$title = 'Настройки клана';    
include './system/h.php';  



if(!$clan['id'] OR $clan['id'] != $i['id']) {
header('location: /clan/');
exit;}
if($clan['id'] == $i['id'] && $clan_memb['rank'] >= 4) {
 echo'  <div class="block_link"><a class=mbtn mb2 href="/clan/settings/clan/"><img src="/images/ico/png/clan_settings.png" alt="*"/>  Настройки клана </a></div>';
}
if($clan['id'] == $i['id'] && $clan_memb['rank'] >= 4) {
 echo'  <div class="block_link"><a class=mbtn mb2 href="/clan/gerb/"><img src="http://game-mrush.ml//images/ico/gerb/herb7.png" width=20 height=20> Сменить герб </a></div>';
}



if($clan['id'] == $i['id'] && $clan_memb['rank'] != 6) {echo'  <div class="block_link"><a class=mbtn mb2 href="/clan/exit/"><img src="/images/ico/png/logout.png" alt="*"/> Покинуть клан</a></div>';}
include './system/f.php';
break;





case 'task'://Клановые задания
$title = 'Клановые задания';    
include './system/h.php';   
echo '<div class="title">'.$title.'</div>';
  $memb = mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$user['id'].'"');
  $memb = mysql_fetch_array($memb);

echo'<div class="empty_block">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding-top: 5px;">
<tbody><tr><td width="25%">
<center><img src="/images/ico/task/clan_task.png" alt="*" width="72"/></center>
</td>
<td width="75%">
<font color="#fff">Выполняй задания и добывай алмазы для клана </font></br>
Собрано алмазов: 68
</td>
</tr></tbody>
</table>
</div><div class="line"></div>';

////////////////////////////// Обновление новых квестов////////////////////////////
//Добавляем только ежеднемные задания 
$req_task = mysql_query ('select * from `clan_task_user` WHERE (`clan`="'.$memb['clan'].'") AND (`complete`="0")');
if (mysql_num_rows ($req_task) < 10) {
    // Обновление квестов
$req_task = mysql_query ('select * from `clan_task` ');
$i_task = 0;
while ($task__ = mysql_fetch_array ($req_task)) {
$q_task = mysql_query ('SELECT * FROM `clan_task_user` WHERE (`clan`="'.$memb['clan'].'") AND (`task`="'.$task__['id'].'") ');
if (mysql_num_rows ($q_task)==0) {
$i_task++;
if ($i_task <10) {
mysql_query ('INSERT INTO `clan_task_user` (`clan`, `task`) VALUES ("'.$memb['clan'].'", "'.$task__['id'].'") ');
}}}
}
////////////////////////////////////////////////////////////////////////

// Обновление неактивных квестов
$req = mysql_query ('select * from `clan_task_user` WHERE (`clan`="'.$memb['clan'].'") AND (`complete`="1") ');
if (mysql_num_rows ($req) < 10) {
    $i = 0;
    while ($clan_task_user = mysql_fetch_array ($req)) {
        
  if ($clan_task_user['time']<time ()) {
$i++;
if ($i < 10) {
mysql_query ('UPDATE `clan_task_user` SET `complete`="0",`how`="0" WHERE (`clan`="'.$memb['clan'].'") AND (`task`="'.$clan_task_user['task'].'") ');
   }
  }    
 }
}




  $id = _string(_num($_GET['task'])); //Оприделяем какое задание
$clan_task = mysql_fetch_array(mysql_query ('SELECT * FROM `clan_task` WHERE (`id`="'.$id.'")'));
$clan_task_user = mysql_fetch_array(mysql_query ('SELECT * FROM `clan_task_user` WHERE (`clan`="'.$memb['clan'].'") AND (`task`="'.$clan_task['id'].'")'));
  
  if($id){
	  if($clan_task_user['user'] == 0){
mysql_query ('UPDATE `clan_task_user` SET `user`="'.$user['id'].'", `time_task`="'.(time()+60*60*40).'" WHERE (`clan`="'.$memb['clan'].'") AND (`task`="'.$id.'")');
	  }elseif($clan_task_user['user_2'] == 0){
mysql_query ('UPDATE `clan_task_user` SET `user_2`="'.$user['id'].'" WHERE (`clan`="'.$memb['clan'].'") AND (`task`="'.$id.'") ');
	  }


header('location: /clan/task');
exit;
}



// Список невыполненных заданий
$req = mysql_query ('select * from `clan_task_user` WHERE (`clan`="'.$memb['clan'].'") AND (`complete`="0") ORDER BY `id` ASC');
if (mysql_num_rows ($req) == 0) {
    echo 'mkj';//Пишем, что нет заданий
}else{
    while ($clan_task_user = mysql_fetch_array ($req)) {        
        $clan_task = mysql_fetch_array(mysql_query ('SELECT * FROM `clan_task` WHERE (`id`="'.$clan_task_user['task'].'")'));
       
echo '<div class="empty_block">
<font color="#fff"> <img src="/images/ico/png/task.png" width="18"> '.$clan_task['name'].'</font><br/>
<font color="#90b0c0">';
  if ($clan_task_user['how']>=$clan_task['how']) {
    echo '  <img src="/images/ico/png/gold.png" alt="*" width="16"/> '.$clan_task['_gold'].'
            <img src="/images/ico/png/silver.png" alt="*" width="16"/> '.$clan_task['_silver'].'
            <img src="/images/ico/png/exp.png" alt="*" width="16"/> '.$clan_task['_exp'].' </br>'; 
}
echo'Прогресс: '.$clan_task_user['how'].' из '.$clan_task['how'].' </font><br/>';   
if($clan_task_user['user'] != 0){ echo' '.nick($clan_task_user['user']).' ';}
if($clan_task_user['user_2'] != 0){ echo' '.nick($clan_task_user['user_2']).' ';}
if($clan_task_user['time_task'] != 0){ echo' </br> Осталось: '._time($clan_task_user['time_task']-time()).' ';}


  if ($clan_task_user['how']>=$clan_task['how']) {
echo '<center><a href="/task?complete='.$clan_task['id'].'"> <input class="button" type="submit" value="Забрать награду"/></a></center>';     
}elseif($clan_task_user['user'] == 0){
	if(mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_task_user` WHERE `clan` = "'.$memb['clan'].'" AND `user` = "'.$user['id'].'" OR `user_2` = "'.$user['id'].'"'),0) == 0){
echo'<form action="/clan/task?task='.$clan_task_user['task'].'" method="post">
<center><input class="button" type="submit" value="Выполнить"/></center>
</form>';	
	}
}elseif($clan_task_user['user_2'] == 0 AND $clan_task_user['user'] != $user['id']){
	if(mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_task_user` WHERE `clan` = "'.$memb['clan'].'" AND `user` = "'.$user['id'].'" OR `user_2` = "'.$user['id'].'"'),0) == 0){
echo'<form action="/clan/task?task='.$clan_task_user['task'].'" method="post">
<center><input class="button" type="submit" value="Помочь с заданием"/></center>
</form>';
	}	
}
echo '</div>
<div class="line"></div>';
    }
}


// Список выполненных задани
$req = mysql_query ('select * from `clan_task_user` WHERE (`clan`="'.$memb['clan'].'") AND (`complete`="1") ');
if (mysql_num_rows ($req) != 0) {

    while ($clan_task_user = mysql_fetch_array ($req)) {
        $clan_task = mysql_fetch_array(mysql_query ('SELECT * FROM `clan_task` WHERE (`id`="'.$clan_task_user['task'].'")'));
			
echo '
<div class="empty_block"> '.$clan_task['name'].' </span><br/>
Будет доступно через: '._time($clan_task_user['time']-time()).' </div>
<div class="line"></div>';
   }
}
echo' <div class="empty_block item_center"> 
<font color="#90b0c0">За каждое выполненное задание клан получает от 1 до 10 алмазов (случайно), а герой золото и серебро в награду
Подробнее </font><a href="/task/dailyInfo"><font color="#fff">здесь</font></a>
</div><div class="line"></div>';


echo'<div class="block_link"><a href="/clan"><img src="/images/ico/png/back.png" alt="*"/> Назад в клан </a></div>
<div class="line"></div>';
include './system/f.php';
break;






case 'delete'://Распустить клан
$title = 'Распустить клан';    
include './system/h.php';  
echo'<div class="title">'.$title.'</div>';
if(!$clan['id'] OR $clan['id'] != $i['id'] OR $clan_memb['rank'] != 4) {
header('location: /clan/');
exit;}

  if(isset($_REQUEST['ok'])){

  $del = mysql_query('SELECT * FROM `clan_memb` WHERE `clan` = "'.$clan['id'].'"');
  $del = mysql_fetch_array($del);

$text='Ваш клан был распущен';
mysql_query("INSERT INTO `mail` SET `from`='2',`to`='".$del['user']."',`text`='".$text."',`time`='".time()."'");


   mysql_query("DELETE FROM `clans` WHERE `id` = '".$clan['id']."'");
   mysql_query("DELETE FROM `clan_chat` WHERE `clan` = '".$clan['id']."'");
   mysql_query("DELETE FROM `clan_memb` WHERE `clan` = '".$clan['id']."'");
   mysql_query("DELETE FROM `clan_msg` WHERE `clan` = '".$clan['id']."'");
$_SESSION['msg'] = msg('Вы успешно распустили клан!'); 
header('location: /clans/');
exit;}


     echo '<div class="empty_block item_center">
Вы действительно хотите Распустить клан? <br/>
<a href="/clan/settings/delete/?ok"> <input class="button" type="submit" value="Да"> </a>
<div class="link_center_h"><a href="/clan/"> Нет </a></div> </div>';
echo '<div class="line"></div>';

include './system/f.php';
break;

case 'msg'://Обьявления клана
$title = 'Новое обьявление';    
include './system/h.php';  
if(!$clan['id'] OR $clan['id'] != $i['id'] && $clan_memb['rank'] >= 3) {//Доступно для генирала и лидера клана
header('location: /clan/');
exit;}


  if(isset($_REQUEST['ok'])){
$text = _string($_POST['text']);	
  if(empty($text) or mb_strlen($text) < 3) {
header('Location: /clan/msg/');
$_SESSION['msg'] = msg('Слишком короткое cообщение!');
exit; }
  
mysql_query('INSERT INTO `clan_msg` (`clan`,
                                             `user`,
                                             `text`,
                                             `time`) VALUES ("'.$clan['id'].'",
                                                             "'.$user['id'].'",
                                                                   "'.$text.'",
                                                                   "'.time().'")');
header('location: /clan/');  
}
     echo' '.$_SESSION['msg'].'  ';
    $_SESSION['msg']=NULL; //Удаляем сесию

 echo' 
 
 
 <form action="/clan/msg/" method="post">

 <textarea               id="sml" rows="5" class="lbfld ha w96 mt5"  name="text" ></textarea><br/>  
 <input  class="fl ml5 ibtn plr10 mt10 mb5"   name="ok" value="Дать объявление" type="submit">

 </form>

 
 
<br><br>
 <div class="line"></div>';

include './system/f.php';
break;






case 'msg2'://Обьявления клана
$title = 'Новое обьявление';    
include './system/h.php';  

  if(isset($_REQUEST['ok'])){
$text = _string($_POST['text']);	
  if(empty($text) or mb_strlen($text) < 3) {
header('Location: /clan/msg2/');
$_SESSION['msg'] = msg('Слишком короткое cообщение!');
exit; }
  
mysql_query('INSERT INTO `user_msg` (
                                             `user`,
                                             `text`,
                                             `time`) VALUES (
                                                             "'.$user['id'].'",
                                                                   "'.$text.'",
                                                                   "'.time().'")');
header('location: /clan/');  
}
     echo' '.$_SESSION['msg'].'  ';
    $_SESSION['msg']=NULL; //Удаляем сесию

 echo' 
 
 
 <form action="/clan/msg2/" method="post">

 <textarea               id="sml" rows="5" class="lbfld ha w96 mt5"  name="text" ></textarea><br/>  
 <input  class="fl ml5 ibtn plr10 mt10 mb5"   name="ok" value="Дать объявление" type="submit">

 </form>

 
 
<br><br>
 <div class="line"></div>';

include './system/f.php';
break;






case 'clan'://Обьявления клана
$title = 'Новое обьявление';    
include './system/h.php';  

if(!$clan['id'] OR $clan['id'] != $i['id'] && $clan_memb['rank'] >= 3) {//Доступно для генирала и лидера клана
header('location: /clan/');
exit;}


  if(isset($_REQUEST['description'])){
$description = _string($_POST['description']);  
    if($clan['g'] < 0) {    
header('location: /clan/settings/clan/');   
$_SESSION['msg5'] = msg('Недостаточно золота!');
exit;}
    
mysql_query('UPDATE `clans` SET `g` = `g` - 0,
                                 `description` = "'.$description.'" WHERE `id` = "'.$clan['id'].'"');
 
$_SESSION['msg5'] = msg('Описание клана измененно!');
header('location: /clan/settings/clan/');
}

  
     echo' '.$_SESSION['msg5'].'  ';
    $_SESSION['msg5']=NULL; //Удаляем сесию
echo'  <div class="bntf">
   <div class="small">
    <div class="nl">
     <div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">
  <form action="/clan/settings/clan/" method="post">
Описание клана<br/>
  <input  name="description" value="'.$clan['description'].'"/><br/> 
  <input class="button"type="submit" value="Сохранить" name="">

  </form> 
</div></div></div></div></div>
 <div class="line"></div>';



  if(isset($_REQUEST['change_name'])){
$name = _string($_POST['name']);  
    if($clan['g'] < 500) {    
header('location: /clan/settings/clan/');   
$_SESSION['msg1'] = msg('Недостаточно золота!');
exit;}
    
	$sql = mysql_query("SELECT COUNT(`id`) FROM `clans` WHERE `name` = '".$name."'"); 
if(mysql_result($sql, 0)){
      header("Location: /clan/settings/clan/");
     $_SESSION['msg1'] = msg('Такое название клана уже есть!');
     exit;  
}

    

mysql_query('UPDATE `clans` SET `g` = `g` - 500,
                                 `name` = "'.$name.'" WHERE `id` = "'.$clan['id'].'"');
 
$_SESSION['msg1'] = msg('Название клана измененно!');
header('location: /clan/settings/clan/');
}

  if($_POST['change_rank_for_invite']) {
$rank = _string(_num($_POST['rank']));  
mysql_query('UPDATE `clans` SET `rank_for_invite` = "'.$rank.'" WHERE `id` = "'.$clan['id'].'"');
$_SESSION['msg2'] = msg('Настройки клана измененно!');
header('location: /clan/settings/clan/');
exit;  
}

  if($_POST['change_rank_for_delete']) {
$rank = _string(_num($_POST['rank']));
mysql_query('UPDATE `clans` SET `rank_for_delete` = "'.$rank.'" WHERE `id` = "'.$clan['id'].'"');
$_SESSION['msg3'] = msg('Настройки клана измененно!');
header('location: /clan/settings/clan/');
exit;  
}
  
  
     echo' '.$_SESSION['msg1'].'  ';
    $_SESSION['msg1']=NULL; //Удаляем сесию
echo'  <div class="bntf">
   <div class="small">
    <div class="nl">
     <div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">
  <form action="/clan/settings/clan/" method="post">
  Название клана: <br/>
  <input  name="name" value="'.$clan['name'].'"/><br/> 
  <input class="button"type="submit" value="Сохранить" name="change_name"/>
  <br/> <small>Стоимость <img src="/images/ico/png/gold.png" alt="*" width="16"/> 500 </small>
  </form> 
</div></div></div></div></div></div>
 <div class="line"></div>';

 
 
include './system/f.php';
break;


case 'money':
$title = 'Казна клана';    
include './system/h.php';  

if(!$clan['id'] OR $clan['id'] != $i['id']) {
header('location: /clan/');
exit;}



  if(isset($_REQUEST['ok'])){
$g = _string(_num($_POST['g']));
$s = _string(_num($_POST['s']));

    if($g <= '0' AND $s <= '0') {   
header('location: /clan/money/');
exit;}

    if($g > $user['g'] OR $s > $user['s']) {   
$_SESSION['msg'] = msg('У вас недостаточно ресурсов!');
header('location: /clan/money/');
exit;
}


	   if(date('w') != 0 AND date('w') != 7){


header('location: /clan/money/');
mysql_query('UPDATE `clans` SET `g` = `g` + '.$g.' WHERE `id` = "'.$clan['id'].'"');
mysql_query('UPDATE `users` SET `g` = `g` - '.$g.' WHERE `id` = "'.$user['id'].'"');  
mysql_query('UPDATE `clan_memb` SET `g` = `g` + '.$g.' WHERE `user` = "'.$user['id'].'"');  

mysql_query('UPDATE `clans` SET `s` = `s` + '.$s.' WHERE `id` = "'.$clan['id'].'"');
mysql_query('UPDATE `users` SET `s` = `s` - '.$s.' WHERE `id` = "'.$user['id'].'"');  
mysql_query('UPDATE `clan_memb` SET `s` = `s` + '.$s.' WHERE `user` = "'.$user['id'].'"');  



		$clans_q = mysql_fetch_array(mysql_query('SELECT * FROM `clans_q` WHERE `clans` = "'.$clan['id'].'"LIMIT 1'));
		if($clans_q['user_5'] == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_5` = "'.($clans_q['q_5'] >= "300" ? "300":($clans_q['q_5'] + $g)).'" WHERE `clans` = "'.$clan['id'].'"');
		}
		if($clans_q['user_6'] == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_6` = "'.($clans_q['q_6'] >= "300000" ? "300000":($clans_q['q_6'] + $s)).'" WHERE `clans` = "'.$clan['id'].'"');
		}
		if($clans_q['user_5_p']  == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_5` = "'.($clans_q['q_5'] >= "300" ? "300":($clans_q['q_5'] + $g)).'" WHERE `clans` = "'.$clan['id'].'"');
		}
		if($clans_q['user_6_p'] == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_6` = "'.($clans_q['q_6'] >= "300000" ? "300000":($clans_q['q_6'] + $s)).'" WHERE `clans` = "'.$clan['id'].'"');
		}
		




$_SESSION['msg'] = msg('Казна клана успешно пополнена!');
}

		
		
header('location: /clan/money/');
exit;
}



     echo' '.$_SESSION['msg'].'  ';
    $_SESSION['msg']=NULL; //Удаляем сесию
echo'<div class="bdr bg_main mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="mt5 mlr10 sh lorange">
		<span><img class="icon" src="http://144.76.127.94/view/image/icons/clan_budget.png" width="20"> Казна: <img class="icon" src="http://144.76.127.94/view/image/icons/gold.png">'.n_f($i['g']).' <img class="icon" src="http://144.76.127.94/view/image/icons/silver.png">'.n_f($i['s']).'</span>	

		<form action="/clan/money/" method="post">
			<img class="icon" src="http://144.76.127.94/view/image/icons/gold.png"><input type="text" class="lbfld mt5"name="g" value="0"/><br>
			<img class="icon" src="http://144.76.127.94/view/image/icons/silver.png"><input type="text" class="lbfld mt5" name="s" value="0"/><br>
			  <span class="ml10"><input class="ibtn ml10 mt5 mb5" name="ok" type="submit" value="Пополнить"/></span><br>
		</form>
	</div>
</div></div></div></div></div></div></div></div></div>
<div class="bdr bg_main mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="mt5 mlr10 sh lblue small">
		Доступное пополнение:<br><img class="icon" src="http://144.76.127.94/view/image/icons/gold.png">Золото: (100000)<br><img class="icon" src="http://144.76.127.94/view/image/icons/silver.png">Серебро: (100000000)</div>
</div></div></div></div></div></div></div></div></div>
<div class="hr_g mb2"><div><div></div></div></div>
<a class="mbtn mb2" href="/clan_stat/gold"><img class="icon" src="http://144.76.127.94/view/image/icons/clan_statistic.png" width="20"> Статистика пополнений</a>
';

include './system/f.php';
break;


case 'memb':
if(!$clan['id'] OR $clan['id'] == $i['id'] && $clan_memb['rank'] < 4) {
header('location: /clan/');
exit;}

$memb = _string(_num($_GET['memb']));

  $memb = mysql_query('SELECT * FROM `clan_memb` WHERE `clan` = "'.$clan['id'].'" AND `id` = "'.$memb.'"');
  $memb = mysql_fetch_array($memb);

  if(!$memb) {
header('location: /clan/');
exit;}
  
  $memb_user = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$memb['user'].'"');
  $memb_user = mysql_fetch_array($memb_user);
  
$title = $memb_user['login'];    
include './system/h.php';  
echo'<div class="ribbon mb2"><div class="rl"><div class="rr">
	Редактор игрока '.$title.'</div></div></div>';

    if($memb['rank'] != 4 && $memb['rank'] < $clan_memb['rank']) {
  
  
$march = mysql_fetch_assoc(mysql_query("SELECT * FROM `clan_memb` WHERE `rank` = '4' AND `id_clan` = '".$clan[id]."'"));
if($march && $memb[rank] == 4){
$_SESSION[msg] = 'В клане уже есть Маршал '.$march['login'];
header('Location: ?');
exit();
}  
  
  
  
  if($_GET['up'] == true) { 
mysql_query('UPDATE `clan_memb` SET `rank` = "'.($memb['rank'] + 1).'" WHERE `clan` = "'.$clan['id'].'" AND `id` = "'.$memb['id'].'"');
$text='<a class="tdn lwhite" href="/user/'.$memb['user'].'">'.nick($memb['user']).'</a> <span class="win"> был повышен </span> '; //Текст уведомления
mysql_query("INSERT INTO `clan_history` SET `clan`='".$clan['id']."',`text`='".$text."',`time`='".time()."'"); //Отправляем уведомление                                              

header('location: /clan/memb/'.$memb['id'].'/');
exit;
  }
 }

  if($memb['rank'] < $clan_memb['rank'] && $memb['rank'] > 0) {

  if($_GET['down'] == true) {
mysql_query('UPDATE `clan_memb` SET `rank` = "'.($memb['rank'] - 1).'" WHERE `clan` = "'.$clan['id'].'" AND `id` = "'.$memb['id'].'"');
$text='<a class="tdn lwhite" href="/user/'.$memb['user'].'">'.nick($memb['user']).'</a> <span class="lose"> был понижен </span> '; //Текст уведомления
mysql_query("INSERT INTO `clan_history` SET `clan`='".$clan['id']."',`text`='".$text."',`time`='".time()."'"); //Отправляем уведомление                                              

header('location: /clan/memb/'.$memb['id'].'/');
exit;
  }
 }

  switch($memb['rank']) {
  
    case 0:
    $rank = 'Новичек';
     break;
    case 1:
    $rank = 'Ветеран';
     break;
    case 2:
    $rank = 'Офицер';
     break;
    case 3:
    $rank = 'Генерал';
     break;
    case 4:
    $rank = '<span class="yell">Маршал</span>';
     break;
    case 5:
    $rank = '<span class="yell">Лидер</span>';
     break;
    
  }

       echo'<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
		<div class="mt5 mb10 mlr10 sh cntr lblue"></div>
       
       
     
       
       
       '.$_SESSION['msg'].'  ';
    $_SESSION['msg']=NULL; //Удаляем сесию

   if($memb['rank'] != 4 && $memb['rank'] < $clan_memb['rank']) {








echo'
<br><div class="cntr mb5"><a class="ubtn inbl mt-15 green mb2" href="/clan/memb/'.$memb['id'].'/?up=true"><span class="ul"><span class="ur">Повысить</span></span></a></div>';
   }

  if($memb['rank'] < $clan_memb['rank'] && $memb['rank'] > 0) {
echo'
<br><div class="cntr mb5"><a class="ubtn inbl mt-15 green mb2" href="/clan/memb/'.$memb['id'].'/?down=true"><span class="ul"><span class="ur">Понизить</span></span></a></div><br>';




}


?>



<?

  if($clan_memb['rank'] == 5) {
  
    if($_GET['lider'] == true) {    
mysql_query('UPDATE `clan_memb` SET `rank` = "5" WHERE `id` = "'.$memb['id'].'"');
mysql_query('UPDATE `clan_memb` SET `rank` = "4" WHERE `user` = "'.$user['id'].'"'); 

header('location: /clan/memb/'.$memb['id'].'/');
exit;
}

echo'
<br><div class="cntr mb5"><a class="ubtn inbl mt-15 red mb2" href="/clan/memb/'.$memb['id'].'/?lider=true"><span class="ul"><span class="ur">Передать лидерство</span></span></a></div>';

}


  if($memb['rank'] < $clan_memb['rank'] && $clan_memb['rank'] >= $clan['rank_for_delete']) {
  if($_GET['delete'] == true) {
mysql_query('DELETE FROM `clan_memb` WHERE `id` = "'.$memb['id'].'"');
header('location: /clan/');
exit;

}
  
 
echo'
<br><div class="cntr mb5"><a class="ubtn inbl mt-15 red mb2" href="/clan/memb/'.$memb['id'].'/?delete=true"><span class="ul"><span class="ur">Исключить</span></span></a></div>';
      
  }

echo'	</div></div></div></div></div></div></div></div></div>';
include './system/f.php';
break;

////////////////////////////////////////
////////////////////////////////
 




////////////////////////////////////////////////
/////////////////////////////////////////////////////


case 'gerb':
if($clan['id'] == 0 || $clan_memb['rank'] < 4){
header('location: /clan/');
exit;
}

$title = 'Клановый герб'; 
include './system/h.php'; 


if(isset($_POST['id'])) {
$id = _num($_POST['id']);
if($id > 1 || $id < 16) {
mysql_query("UPDATE `clans` SET `gerb` = '$id' WHERE `id` = '".$clan['id']."'");
header("Location: /clan/");
exit();
}

}


echo '<div class="ribbon mb2"><div class="rl"><div class="rr">
			Выберите герб</div></div></div>';
echo '<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
		<div class="mlr10 sh small lblue">
<form method="post" action="">';
for($i = 1; $i < 16; $i++) {

echo '<input type="radio" name="id" value="'.$i.'" /> 
<img src="/images/ico/gerb/herb'.$i.'.png" /></br></br>'; 

}
echo '
 </div>
		</div>
		</div></div></div></div></div></div></div></div></div>
		
	<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
		<div class="mlr10 sh small cntr lblue">	
		<div class="mt5 mr10 fl cntr"><input class="ibtn w90px" type="submit" value="Установить"></div>
</form><br><br> <br><br> </div>
		</div>
		</div></div></div></div></div></div></div></div></div>
</div><div class="line"></div>';
include './system/f.php'; 
break;



case 'chat':


$title = 'Клановый чат';
include './system/h.php';  
echo ' <div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Клановый чат
    </div>
   </div>
  </div> ';





$text = _string($_POST['text']);
$to = _string(_num($_GET['to']));

  if($to) {
$_to = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$to.'"');
$_to = mysql_fetch_array($_to); }
  
  
  
  
  if(isset($_REQUEST['text'])){
$antiflood = mysql_fetch_array(mysql_query('SELECT * FROM `clan_chat` WHERE `user` = \''.$user['id'].'\' ORDER BY `time` DESC LIMIT 1'));
  
  if(empty($text) or mb_strlen($text,'UTF-8') < 1){
header("Location: ?");
$_SESSION['msg'] = msg('Пустое сообщение!');
exit;}
  if(time() - $antiflood['time'] < 0){
header("Location: ?");
$_SESSION['msg'] = msg('Нельзя писать так часто!');
exit;}
    





mysql_query('INSERT INTO `clan_chat` (`clan`,`user`,`to`,`text`,`time`) VALUES ("'.$clan['id'].'","'.$user['id'].'",  "'.$_to['id'].'", "'.$text.'", "'.time().'")');
header('location: /clan/chat/');
$_SESSION['msg'] = msg('Сообщение отправленно!');
exit;  
}


  
  
     echo' '.$_SESSION['msg'].'  ';
    $_SESSION['msg']=NULL; //Удаляем сесию


        
        echo '  <div class="bdr bg_main mb2"> <div class="light">
    <div class="wr1">
     <div class="wr2">
      <div class="wr3">
       <div class="wr4">
        <div class="wr5">
         <div class="wr6">
          <div class="wr7">
           <div class="wr8"> 
              <form action="/clan/chat/?to='.$to.'" method="post">
             <div class="mt5 mlr10 lwhite"> 
              <div class="mr10"> 
              <textarea                class="lbfld h25 w100" name="text"                value="" size="20" maxlength="265"  >'.($to ? $_to['login'].', ':'').'</textarea><br/>

              </div> 
              <div class="mt5 mr5 fr">
               <a class="nd" href="/smile"> <img class="icon" height="30" src="http://144.76.127.94/view/image/icons/big_smile.png" alt=":)"> </a>
              </div> 
              <div class="mt5 mr10 fl">
              <input class="ibtn w90px" name="send_msgsage" value="Отправить" type="submit">
</form>
              </div> 
              <div class="mt10 small">
               <a class="grey1 ml10" href="/chat?page=1">Обновить</a>
              </div> 
              <input type="hidden" name="answer_id" value="0"> 
              <input type="hidden" name="page" value="1"> 
              <input type="hidden" name="clan_id" value="0"> 
             </div> 
             <div class="mb10"></div> 
             <div class="hr_arr mlr10 mb5">
              <div class="alf">
               <div class="art">
                <div class="acn"></div>
               </div>
              </div>
             </div> ';









?>

  

<?

$max = 10;
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_chat` WHERE `clan` = "'.$clan['id'].'"'),0);
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));

if($page > $pages) {$page = $pages;}
if($page < 1) {$page = 1;}
$start = $page * $max - $max;

if($count > 0) {
$q = mysql_query('SELECT * FROM `clan_chat` WHERE `clan` = "'.$clan['id'].'" ORDER BY `id` DESC LIMIT '.$start.', '.$max.'');
  while($row = mysql_fetch_array($q)) {
    	  echo'<div class="mlr10 lwhite" id="box_forum_chat">  <div class="mb5">
';
  if($row['to'] == $user['id'] && $row['read'] == 0) {
mysql_query('UPDATE `clan_chat` SET `read` = "1" WHERE `id` = "'.$row['id'].'"');  
}

  $sender = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'"');
  $sender = mysql_fetch_array($sender);

echo'<a class="tdn lwhite" href="/user/'.$sender['id'].'/">'.nick($sender['id']).'</a>';//Логин отправителя

  if($sender['id'] != $user['id']) {//Ответить на сообщение
echo'<a class="tdn lwhite" href="/clan/chat/?to=">(&#187;)</a>';
}
 if($clan_memb['rank'] >= 4) {//Доступно для лидера и маршала
$comment = _string(_num($_GET['comment']));

  if($comment) {
mysql_query('DELETE FROM `clan_chat` WHERE `clan` = "'.$clan['id'].'" AND `id` = "'.$comment.'"');
header('location: /clan/chat/?page='.$page);
$_SESSION['msg'] = msg('Сообщение удалено!');
exit;}
echo' <a href="/clan/chat/?page='.$page.'&comment='.$row['id'].'">[x]</a>';
}


echo'<span style="float: right;"><small>'.vremja($row['time']).'</small></span>';
echo'<br/>';


echo'<font color="'.color($sender[id]).'">';//Цвет сообщений
  

  if($row['to']) {//Если ответ вам
      $__to = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['to'].'"');
      $__to = mysql_fetch_array($__to);
if($__to['id'] == $user['id']) {
echo'<font color="#90c090">';
}else{
echo'<font color="'.color($sender[id]).'">';  
}
echo''.$__to['login'].',
</font>';
 
}




echo''.bbcode(smile($row['text'])).'';//Сообщение
echo'</font>';//Закрываем цвет сообщений



  echo '</div></div>';
}

}else{ 
echo '<div class="line"></div>
<div class="empty_block item_center"> Сообщений нет </div>
<div class="line"></div>';
}

echo '              <span style="display: inline"></span>
             </div>
            </div> 
            <div class="hr_arr mt2 mb2 mlr10">
             <div class="alf">
              <div class="art">
               <div class="acn"></div>
              </div>
             </div>
            </div>
            <div id="box_forum_chat_pgn" class="pgn nwr">';
            echo ''.pages('/chat/?').'';

 echo'           </div>
            <div class="hr_arr mt2 mb2 mlr10">
             <div class="alf">
              <div class="art">
               <div class="acn"></div>
              </div>
             </div>
            </div> 
            <div class="lh1 cntr mb5 small">
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
  <div class="hr_g mb2">
   <div>
    <div></div>
   </div>
  </div> 
  <div class="bntf">
   <div class="small">
    <div class="nl">
     <div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">
       Пожаловаться на нарушение 
      <a href="/about/rules2">правил чата</a> можно 
      <a href="/moderators?chat=1">Модераторам</a> 
     </div>
    </div>
   </div>
  </div> 
   <div>
    <div></div>
   </div>
  </div> 
   <div>
    <div></div>
   </div>
  </div> ';
  
  
  
 /*
echo''.pages('/clan/chat/?').'';
echo'<div class="line"></div>';
*/

include './system/f.php';
break;


case 'const'://Верность клану
$title = 'Верность клану';    
include './system/h.php';   
echo '<div class="ribbon mb2"><div class="rl"><div class="rr">
	Верность клану</div></div></div>';

  $i_clan_memb = mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$user['id'].'"');
  $i_clan_memb = mysql_fetch_array($i_clan_memb);
if($i_clan_memb['v'] >= '100') {
header('location: /user');
exit;}

echo'<div class="bdr bg_green mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="lorange small mr5 mt-5 mb5">
		<ul>
	<li>Влияет на получаемый клановый опыт</li>
	<li>Начальная верность 10%</li>
	<li>Каждый день в клане повышает верность на 3%</li>
	<li>Максимальная верность 150%</li>
	</ul>	</div>
</div></div></div></div></div></div></div></div></div>';


  if($i_clan_memb['v'] < '50') { $cost=10; }else{ $cost=100; }
  if($_GET['up'] == true){  
    if($user['g'] < $cost){
$_SESSION['msg'] = msg('Недостаточно золота!');  
header('location: /clan/const');
exit;}

if($i_clan_memb['v'] < '50') {  //Поднять до 50%
mysql_query('UPDATE  `users` SET `g` = `g` - "10" WHERE `id`="'.$user['id'].'" LIMIT 1');
mysql_query('UPDATE  `clan_memb` SET `v` = "50" WHERE `user`="'.$user['id'].'" LIMIT 1');
}else{//Поднять до 100%
mysql_query('UPDATE  `users` SET `g` = `g` - "100" WHERE `id`="'.$user['id'].'" LIMIT 1');
mysql_query('UPDATE  `clan_memb` SET `v` = "100" WHERE `user`="'.$user['id'].'" LIMIT 1');	
}
header('location: /clan/const');
exit; 
}
	echo' '.$_SESSION['msg'].'  ';
	$_SESSION['msg']=NULL; //Удаляем сесию
echo'<div class="bdr bg_main mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="cntr mlr10 mt5 mb5">
		Ваша верность клану '.$i_clan_memb['v'].'%
	</div>
</div></div></div></div></div></div></div></div></div>
';
if($i_clan_memb['v'] < '50') {//Поднять до 50%
  echo'<div class="bdr bg_main mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="lyell cntr mlr10 mt5 mb5">
		Поднять вашу верность до <span class="win">50%</span>
	</div>
	<div class="cntr mt10"><a href="/clan/const?up=true" class="ubtn inbl green mb5"><span class="ul"><span class="ur">Поднять за <img class="icon" src="https://static.mrush.mobi/view/image/icons/gold.png">10</span></span></a></div>
</div></div></div></div></div></div></div></div></div>';
}else{//Поднять до 100%
  echo'<div class="bdr bg_main mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="lyell cntr mlr10 mt5 mb5">
		Поднять вашу верность до <span class="win">100%</span>
	</div>
	<div class="cntr mt10"><a href="/clan/const?up=true" class="ubtn inbl green mb5"><span class="ul"><span class="ur">Поднять за <img class="icon" src="https://static.mrush.mobi/view/image/icons/gold.png">150</span></span></a></div>
</div></div></div></div></div></div></div></div></div>';
}
echo'</div>
<div class="hr_g mb2"><div><div></div></div></div>';
echo'<div class="block_link"><a class=mbtn mb2 href="/user"><img src="/images/ico/png/back.png" alt="*"/> Назад к профиль </a></div>';
include './system/f.php';
break;



case 'clan_history'://История клана
$title = 'История клана';    
include './system/h.php';   
echo ' <div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
	История клана 
    </div>
   </div>
  </div> ';


$max = 15;
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_history` WHERE `clan` = "'.$clan['id'].'"'),0);
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));

if($page > $pages) {$page = $pages;}
if($page < 1) {$page = 1;}
$start = $page * $max - $max;


?>
<div class="bdr bg_main mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
							<div class="mt5 mlr10 mb5 sh lblue">
<?
if($count > 0) {
$q = mysql_query('SELECT * FROM `clan_history` WHERE `clan` = "'.$clan['id'].'" ORDER BY `id` DESC LIMIT '.$start.', '.$max.'');
  while($row = mysql_fetch_array($q)) {



  $sender = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'"');
  $sender = mysql_fetch_array($sender);

echo '<span class="gray_color2">'.vremja($row['time']).' </span> <small> '.bbcode(smile($row['text'])).'</small><br>';


}
?>
</div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div>
<?
}

echo'<a class=mbtn mb2 href="/clan"><img src="/images/ico/png/back.png" class=icon> Назад в клан </a>';
include './system/f.php';
break;




case 'clan_portal'://Сокровища драконов
$title = 'Сокровища драконов';    
include './system/h.php';   
echo ' <div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Сокровища
    </div>
   </div>
  </div> ';
     echo' '.$_SESSION['msg'].'  ';
    $_SESSION['msg']=NULL; //Удаляем сесию
	
  $memb = mysql_fetch_array(mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$user['id'].'"'));
  $clan = mysql_fetch_array(mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$memb['clan'].'"'));

    $clan_lair = _string(_num($_GET['clan_lair'])); //Оприделяем какой дракон	
	$lair = mysql_fetch_array(mysql_query('SELECT * FROM `clan_lair` WHERE `id` = "'.$clan_lair.'" '));
$lair_boss = mysql_fetch_array(mysql_query('SELECT * FROM `clan_lair_boss` WHERE `clan` = "'.$memb['clan'].'" AND `dead` = "0" '));

	if($clan_lair==1){
if($memb['rank'] < 4){
$_SESSION['msg'] = msg('Открыть портал может маршал или лидер клана ');
header('location: /clan/clan_portal');
exit; } 

if(mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_lair_boss` WHERE `clan` = "'.$memb['clan'].'" AND `dead` = "0" '),0) != 0){
$_SESSION['msg'] = msg('У вас имеется открытый портал!');
header('location: /clan/clan_portal');
exit; } 
//Если нет дракона, записываем
mysql_query('INSERT INTO `clan_lair_boss`  (`clan`,
											`lair`,
											`str`,
											`vit`,
											`def`,
											`time`) VALUES  ("'.$memb['clan'].'", 
															"'.$clan_lair.'", 
															"'.$lair['lair_attack'].'", 
															"'.$lair['lair_hp'].'", 
															"'.$lair['lair_def'].'",
															"'.(time()+3600*30).'" )');
$text='Ваш клан открыл портал к сокровищам. Убейте дракона и заберите сокровища!';															
	mysql_query('INSERT INTO `clan_msg` (`clan`,
                                          `user`,
                                          `text`,
                                          `time`) VALUES ("'.$memb['clan'].'",
                                                          "0",
                                                          "'.$text.'",
                                                          "'.time().'")');
$_SESSION['msg'] = msg('Вы открыли портал в '.$lair['gde2'].'!');
mysql_query("DELETE FROM `clan_lair_memb` WHERE `clan` = '".$clan['id']."'"); //удаляем игроков из старого босса
mysql_query("UPDATE `clans` SET `plat_drag` = `plat_drag` - '75' WHERE `id` = '$clan[id]'"); 



header('location: /clan/clan_portal');
exit;
}
echo '<div class="bdr cnr bg_green">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="fl ml5 mt5 mr10 mb5"> 

<img src="/images/ico/clan_lair/location1.jpg">
</div>
<div class="ml100 mt5 mb2 mlr10 lwhite large">
<font color="#fff"><b>Пещера дракона</b></font>
</div>
<div class="ml100 mb2 mlr10 lorange small"> 
Охраняет зеленый дракон
</div>
'.($lair_boss['lair'] == 1 ? '</br><font color="#7afe4e">Портал открыт</font></td></tr></tbody></table>':'
</td></tr></tbody></table><br>
<center> '.($clan['plat_drag'] >= 75 ? '  <span class="ubtn inbl green mb5 mt-15"><span class="ul"><span class="ur"><a href="/clan/clan_portal?clan_lair=1"> Открыть за <img src="/images/ico/png/diamond.png" width="18">75 </a></span</span></span>':'  <span class="ubtn inbl grey mb5 mt-15"><span class="ul"><span class="ur">Открыть за <img src="/images/ico/png/diamond.png" width="18">75</span></span></span>').'</center>
').'
</div>           <div class="clb"></div> 
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>';                   


     echo' '.$_SESSION['msg'].'  ';
    $_SESSION['msg']=NULL; //Удаляем сесию
	
  $memb = mysql_fetch_array(mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$user['id'].'"'));
  $clan = mysql_fetch_array(mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$memb['clan'].'"'));

    $clan_lair = _string(_num($_GET['clan_lair'])); //Оприделяем какой дракон	
	$lair = mysql_fetch_array(mysql_query('SELECT * FROM `clan_lair` WHERE `id` = "'.$clan_lair.'" '));
$lair_boss = mysql_fetch_array(mysql_query('SELECT * FROM `clan_lair_boss` WHERE `clan` = "'.$memb['clan'].'" AND `dead` = "0" '));

	if($clan_lair==2){
if($memb['rank'] < 4){
$_SESSION['msg'] = msg('Открыть портал может маршал или лидер клана ');
header('location: /clan/clan_portal');
exit; } 

if(mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_lair_boss` WHERE `clan` = "'.$memb['clan'].'" AND `dead` = "0" '),0) != 0){
$_SESSION['msg'] = msg('У вас имеется открытый портал!');
header('location: /clan/clan_portal');
exit; } 
//Если нет дракона, записываем
mysql_query('INSERT INTO `clan_lair_boss`  (`clan`,
											`lair`,
											`str`,
											`vit`,
											`def`,
											`time`) VALUES  ("'.$memb['clan'].'", 
															"'.$clan_lair.'", 
															"'.$lair['lair_attack'].'", 
															"'.$lair['lair_hp'].'", 
															"'.$lair['lair_def'].'",
															"'.(time()+3600*30).'" )');
$text='Ваш клан открыл портал к сокровищам. Убейте дракона и заберите сокровища!';															
	mysql_query('INSERT INTO `clan_msg` (`clan`,
                                          `user`,
                                          `text`,
                                          `time`) VALUES ("'.$memb['clan'].'",
                                                          "0",
                                                          "'.$text.'",
                                                          "'.time().'")');
$_SESSION['msg'] = msg('Вы открыли портал в '.$lair['gde2'].'!');
mysql_query("DELETE FROM `clan_lair_memb` WHERE `clan` = '".$clan['id']."'"); //удаляем игроков из старого босса
mysql_query("UPDATE `clans` SET `plat_drag` = `plat_drag` - '125' WHERE `id` = '$clan[id]'"); 



header('location: /clan/clan_portal');
exit;
}
echo '<div class="bdr cnr bg_green">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="fl ml5 mt5 mr10 mb5"> 
<img src="/images/ico/clan_lair/location2.jpg">
</div>
<div class="ml100 mt5 mb2 mlr10 lwhite large">
<font color="#fff"><b>Казна гномов</b></font>
</div>
<div class="ml100 mb2 mlr10 lorange small"> 
Охраняет синий дракон
</div>

'.($lair_boss['lair'] == 2 ? '</br><font color="#7afe4e">Портал открыт</font></td></tr></tbody></table>':'
</td></tr></tbody></table><br>
<center> '.($clan['plat_drag'] >= 125 ? '  <span class="ubtn inbl green mb5 mt-15"><span class="ul"><span class="ur"><a href="/clan/clan_portal?clan_lair=2"> Открыть за <img src="/images/ico/png/diamond.png" width="18">125 </a></span</span></span>':'  <span class="ubtn inbl grey mb5 mt-15"><span class="ul"><span class="ur">Открыть за <img src="/images/ico/png/diamond.png" width="18">125</span></span></span>').'</center>
').'
</div>           <div class="clb"></div> 
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>';

echo' '.$_SESSION['msg'].'  ';
    $_SESSION['msg']=NULL; //Удаляем сесию
	
  $memb = mysql_fetch_array(mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$user['id'].'"'));
  $clan = mysql_fetch_array(mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$memb['clan'].'"'));

    $clan_lair = _string(_num($_GET['clan_lair'])); //Оприделяем какой дракон	
	$lair = mysql_fetch_array(mysql_query('SELECT * FROM `clan_lair` WHERE `id` = "'.$clan_lair.'" '));
$lair_boss = mysql_fetch_array(mysql_query('SELECT * FROM `clan_lair_boss` WHERE `clan` = "'.$memb['clan'].'" AND `dead` = "0" '));

	if($clan_lair==3){
if($memb['rank'] < 4){
$_SESSION['msg'] = msg('Открыть портал может маршал или лидер клана ');
header('location: /clan/clan_portal');
exit; } 

if(mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_lair_boss` WHERE `clan` = "'.$memb['clan'].'" AND `dead` = "0" '),0) != 0){
$_SESSION['msg'] = msg('У вас имеется открытый портал!');
header('location: /clan/clan_portal');
exit; } 
//Если нет дракона, записываем
mysql_query('INSERT INTO `clan_lair_boss`  (`clan`,
											`lair`,
											`str`,
											`vit`,
											`def`,
											`time`) VALUES  ("'.$memb['clan'].'", 
															"'.$clan_lair.'", 
															"'.$lair['lair_attack'].'", 
															"'.$lair['lair_hp'].'", 
															"'.$lair['lair_def'].'",
															"'.(time()+3600*30).'" )');
$text='Ваш клан открыл портал к сокровищам. Убейте дракона и заберите сокровища!';															
	mysql_query('INSERT INTO `clan_msg` (`clan`,
                                          `user`,
                                          `text`,
                                          `time`) VALUES ("'.$memb['clan'].'",
                                                          "0",
                                                          "'.$text.'",
                                                          "'.time().'")');
$_SESSION['msg'] = msg('Вы открыли портал в '.$lair['gde2'].'!');
mysql_query("DELETE FROM `clan_lair_memb` WHERE `clan` = '".$clan['id']."'"); //удаляем игроков из старого босса
mysql_query("UPDATE `clans` SET `plat_drag` = `plat_drag` - 175 WHERE `id` = '$clan[id]'"); 



header('location: /clan/clan_portal');
exit;
}
echo '<div class="bdr cnr bg_green">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="fl ml5 mt5 mr10 mb5"> 
<img src="/images/ico/clan_lair/location3.jpg">
</div>
<div class="ml100 mt5 mb2 mlr10 lwhite large">
<font color="#fff"><b>Сокровищница королей</b></font>
</div>
<div class="ml100 mb2 mlr10 lorange small"> 
Охраняет красный дракон
</div>

'.($lair_boss['lair'] == 3 ? '</br><font color="#7afe4e">Портал открыт</font></td></tr></tbody></table>':'
</td></tr></tbody></table><br>
<center> '.($clan['plat_drag'] >= 175 ? '  <span class="ubtn inbl green mb5 mt-15"><span class="ul"><span class="ur"><a href="/clan/clan_portal?clan_lair=3"> Открыть за <img src="/images/ico/png/diamond.png" width="18">175 </a></span</span></span>':'  <span class="ubtn inbl grey mb5 mt-15"><span class="ul"><span class="ur">Открыть за <img src="/images/ico/png/diamond.png" width="18">175</span></span></span>').'</center>
').'
</div>           <div class="clb"></div> 
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>';                                      

echo' '.$_SESSION['msg'].'  ';
    $_SESSION['msg']=NULL; //Удаляем сесию
	
  $memb = mysql_fetch_array(mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$user['id'].'"'));
  $clan = mysql_fetch_array(mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$memb['id_clan'].'"'));

    $clan_lair = _string(_num($_GET['clan_lair'])); //Оприделяем какой дракон	
	$lair = mysql_fetch_array(mysql_query('SELECT * FROM `clan_lair` WHERE `id` = "'.$clan_lair.'" '));
$lair_boss = mysql_fetch_array(mysql_query('SELECT * FROM `clan_lair_boss` WHERE `clan` = "'.$memb['id_clan'].'" AND `dead` = "0" '));

	if($clan_lair==4){
if($memb['rank'] < 4){
$_SESSION['msg'] = msg('Открыть портал может маршал или лидер клана ');
header('location: /clan/clan_portal');
exit; } 

if(mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_lair_boss` WHERE `clan` = "'.$memb['id_clan'].'" AND `dead` = "0" '),0) != 0){
$_SESSION['msg'] = msg('У вас имеется открытый портал!');
header('location: /clan/clan_portal');
exit; } 
//Если нет дракона, записываем
mysql_query('INSERT INTO `clan_lair_boss`  (`clan`,
											`lair`,
											`str`,
											`vit`,
											`def`,
											`time`) VALUES  ("'.$memb['id_clan'].'", 
															"'.$clan_lair.'", 
															"'.$lair['lair_attack'].'", 
															"'.$lair['lair_hp'].'", 
															"'.$lair['lair_def'].'",
															"'.(time()+3600*30).'" )');
$text='Ваш клан открыл портал к сокровищам. Убейте дракона и заберите сокровища!';															
	mysql_query('INSERT INTO `clan_msg` (`clan`,
                                          `user`,
                                          `text`,
                                          `time`) VALUES ("'.$memb['id_clan'].'",
                                                          "0",
                                                          "'.$text.'",
                                                          "'.time().'")');
$_SESSION['msg'] = msg('Вы открыли портал в '.$lair['gde2'].'!');
mysql_query("DELETE FROM `clan_lair_memb` WHERE `clan` = '".$clan['id']."'"); //удаляем игроков из старого босса
mysql_query("UPDATE `clans` SET `plat_drag` = `plat_drag` - 250 WHERE `id` = '$clan[id]'"); 



header('location: /clan/clan_portal');
exit;
}
echo '<div class="bdr cnr bg_green">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="fl ml5 mt5 mr10 mb5"> 
<img src="/images/ico/clan_lair/location4.jpg">
</div>
<div class="ml100 mt5 mb2 mlr10 lwhite large">
<font color="#fff"><b>Сокровищница богов</b></font>
</div>
<div class="ml100 mb2 mlr10 lorange small"> 
Охраняет чёрный дракон
</div>

'.($lair_boss['lair'] == 4 ? '</br><font color="#7afe4e">Портал открыт</font></td></tr></tbody></table>':'
</td></tr></tbody></table><br>
<center> '.($clan['plat_drag'] >= 250 ? '  <span class="ubtn inbl green mb5 mt-15"><span class="ul"><span class="ur"><a href="/clan/clan_portal?clan_lair=4"> Открыть за <img src="/images/ico/png/diamond.png" width="18">250 </a></span</span></span>':'  <span class="ubtn inbl grey mb5 mt-15"><span class="ul"><span class="ur">Открыть за <img src="/images/ico/png/diamond.png" width="18">250</span></span></span>').'</center>
').'
</div>           <div class="clb"></div> 
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>';

echo' '.$_SESSION['msg'].'  ';
    $_SESSION['msg']=NULL; //Удаляем сесию
	
  $memb = mysql_fetch_array(mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$user['id'].'"'));
  $clan = mysql_fetch_array(mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$memb['clan'].'"'));

    $clan_lair = _string(_num($_GET['clan_lair'])); //Оприделяем какой дракон	
	$lair = mysql_fetch_array(mysql_query('SELECT * FROM `clan_lair` WHERE `id` = "'.$clan_lair.'" '));
$lair_boss = mysql_fetch_array(mysql_query('SELECT * FROM `clan_lair_boss` WHERE `clan` = "'.$memb['clan'].'" AND `dead` = "0" '));

	if($clan_lair==5){
if($memb['rank'] < 4){
$_SESSION['msg'] = msg('Открыть портал может маршал или лидер клана ');
header('location: /clan/clan_portal');
exit; } 

if(mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_lair_boss` WHERE `clan` = "'.$memb['clan'].'" AND `dead` = "0" '),0) != 0){
$_SESSION['msg'] = msg('У вас имеется открытый портал!');
header('location: /clan/clan_portal');
exit; } 
//Если нет дракона, записываем
mysql_query('INSERT INTO `clan_lair_boss`  (`clan`,
											`lair`,
											`str`,
											`vit`,
											`def`,
											`time`) VALUES  ("'.$memb['clan'].'", 
															"'.$clan_lair.'", 
															"'.$lair['lair_attack'].'", 
															"'.$lair['lair_hp'].'", 
															"'.$lair['lair_def'].'",
															"'.(time()+3600*30).'" )');
$text='Ваш клан открыл портал к сокровищам. Убейте дракона и заберите сокровища!';															
	mysql_query('INSERT INTO `clan_msg` (`clan`,
                                          `user`,
                                          `text`,
                                          `time`) VALUES ("'.$memb['clan'].'",
                                                          "0",
                                                          "'.$text.'",
                                                          "'.time().'")');
$_SESSION['msg'] = msg('Вы открыли портал в '.$lair['gde2'].'!');
mysql_query("DELETE FROM `clan_lair_memb` WHERE `clan` = '".$clan['id']."'"); //удаляем игроков из старого босса
mysql_query("UPDATE `clans` SET `plat_drag` = `plat_drag` - 300 WHERE `id` = '$clan[id]'"); 



header('location: /clan/clan_portal');
exit;
}
echo ' <div class="bdr cnr bg_green">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="fl ml5 mt5 mr10 mb5"> 
<img src="/images/ico/clan_lair/location5.jpg">
</div>
<div class="ml100 mt5 mb2 mlr10 lwhite large">
<font color="#fff"><b>Золотая пещера</b></font>
</div>
<div class="ml100 mb2 mlr10 lorange small"> 
Охраняет золотой дракон
</div>

'.($lair_boss['lair'] == 5 ? '</br><font color="#7afe4e">Портал открыт</font></td></tr></tbody></table>':'
</td></tr></tbody></table><br>
<center> '.($clan['plat_drag'] >= 300 ? '  <span class="ubtn inbl green mb5 mt-15"><span class="ul"><span class="ur"><a href="/clan/clan_portal?clan_lair=5"> Открыть за <img src="/images/ico/png/diamond.png" width="18">300 </a></span</span></span>':'  <span class="ubtn inbl grey mb5 mt-15"><span class="ul"><span class="ur">Открыть за <img src="/images/ico/png/diamond.png" width="18">300</span></span></span>').'</center>
').'
</div>           <div class="clb"></div> 
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>';
  


echo' '.$_SESSION['msg'].'  ';
    $_SESSION['msg']=NULL; //Удаляем сесию
	
  $memb = mysql_fetch_array(mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$user['id'].'"'));
  $clan = mysql_fetch_array(mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$memb['clan'].'"'));

    $clan_lair = _string(_num($_GET['clan_lair'])); //Оприделяем какой дракон	
	$lair = mysql_fetch_array(mysql_query('SELECT * FROM `clan_lair` WHERE `id` = "'.$clan_lair.'" '));
$lair_boss = mysql_fetch_array(mysql_query('SELECT * FROM `clan_lair_boss` WHERE `clan` = "'.$memb['clan'].'" AND `dead` = "0" '));

	if($clan_lair==6){
if($memb['rank'] < 4){
$_SESSION['msg'] = msg('Открыть портал может маршал или лидер клана ');
header('location: /clan/clan_portal');
exit; } 

if(mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_lair_boss` WHERE `clan` = "'.$memb['clan'].'" AND `dead` = "0" '),0) != 0){
$_SESSION['msg'] = msg('У вас имеется открытый портал!');
header('location: /clan/clan_portal');
exit; } 
//Если нет дракона, записываем
mysql_query('INSERT INTO `clan_lair_boss`  (`clan`,
											`lair`,
											`str`,
											`vit`,
											`def`,
											`time`) VALUES  ("'.$memb['clan'].'", 
															"'.$clan_lair.'", 
															"'.$lair['lair_attack'].'", 
															"'.$lair['lair_hp'].'", 
															"'.$lair['lair_def'].'",
															"'.(time()+3600*30).'" )');
$text='Ваш клан открыл портал к сокровищам. Убейте дракона и заберите сокровища!';															
	mysql_query('INSERT INTO `clan_msg` (`clan`,
                                          `user`,
                                          `text`,
                                          `time`) VALUES ("'.$memb['clan'].'",
                                                          "0",
                                                          "'.$text.'",
                                                          "'.time().'")');
$_SESSION['msg'] = msg('Вы открыли портал в '.$lair['gde2'].'!');
mysql_query("DELETE FROM `clan_lair_memb` WHERE `clan` = '".$clan['id']."'"); //удаляем игроков из старого босса
mysql_query("UPDATE `clans` SET `plat_drag` = `plat_drag` - 450 WHERE `id` = '$clan[id]'"); 



header('location: /clan/clan_portal');
exit;
}
echo ' <div class="bdr cnr bg_green">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="fl ml5 mt5 mr10 mb5"> 
<img src="/images/ico/clan_lair/location6.jpg">
</div>
<div class="ml100 mt5 mb2 mlr10 lwhite large">
<font color="#fff"><b>Алмазная пещера</b></font>
</div>
<div class="ml100 mb2 mlr10 lorange small"> 
Охраняет ледяной дракон
</div>

'.($lair_boss['lair'] == 6 ? '</br><font color="#7afe4e">Портал открыт</font></td></tr></tbody></table>':'
</td></tr></tbody></table><br>
<center> '.($clan['plat_drag'] >= 450 ? '  <span class="ubtn inbl green mb5 mt-15"><span class="ul"><span class="ur"><a href="/clan/clan_portal?clan_lair=6"> Открыть за <img src="/images/ico/png/diamond.png" width="18">450 </a></span</span></span>':'  <span class="ubtn inbl grey mb5 mt-15"><span class="ul"><span class="ur">Открыть за <img src="/images/ico/png/diamond.png" width="18">450</span></span></span>').'</center>
').'
</div>           <div class="clb"></div> 
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>';




include './system/f.php';
break;


   case 'built': 
    $title = 'Статуя клана';     

include './system/h.php';   

if(!$clan['id'] OR $clan['id'] != $i['id']) {

  header('location: /clan/'); 

exit; 

} 

    $progress = round(100 / (50 / $i['built_1']));

  function cost($i) { 
     
    switch($i) { 
      case 0: 
      $cost = 1000;  
       break; 
      case 1: 
      $cost = 1000;  
       break; 
      case 2: 
      $cost = 500000;  
       break; 
      case 3: 
      $cost = 5000;  
       break; 
      case 4: 
      $cost = 5000000;  
       break; 
      case 5: 
      $cost = 15000;  
       break; 
      case 6: 
      $cost = 25000000;  
       break; 
      case 7: 
      $cost = 25000;  
       break; 
      case 8: 
      $cost = 50000000;  
       break; 
      case 9: 
      $cost = 50000;  
       break; 
      case 10: 
      $cost = 100000000;  
       break; 
      case 11: 
      $cost = 100000;  
       break; 
      case 12: 
      $cost = 1000000000;  
       break; 
      case 13: 
      $cost = 150000;  
       break; 
      case 14: 
      $cost = 2000000000;  
       break; 
      case 15: 
      $cost = 200000;  
       break; 
      case 16: 
      $cost = 3000000000;  
       break; 
      case 17: 
      $cost = 300000;  
       break; 
      case 18: 
      $cost = 5000000000;  
       break; 
      case 19: 
      $cost = 400000;  
       break; 
      case 20: 
      $cost = 10000000000;  
       break; 
      case 21: 
      $cost = 360000;  
       break; 
      case 22: 
      $cost = 720000;  
       break; 
      case 23: 
      $cost = 1080000;  
       break; 
      case 24: 
      $cost = 57600;  
       break; 
      case 25: 
      $cost = 420000;  
       break; 
      case 26: 
      $cost = 840000;  
       break; 
      case 27: 
      $cost = 1260000;  
       break; 
      case 28: 
      $cost = 115200;  
       break; 
      case 29: 
      $cost = 480000;  
       break; 
      case 30: 
      $cost = 960000;  
       break; 
      case 31: 
      $cost = 230400;  
       break; 
      case 32: 
      $cost = 540000;  
       break; 
      case 33: 
      $cost = 1080000;  
       break; 
      case 34: 
      $cost = 1620000; 
       break; 
     case 35: 
      $cost = 1620000; 
       break;

    } 
   
  return $cost; 
   
  } 
   
  function value($i) { 
   
    switch($i) { 
      case 0: 
      $value = 1;  
       break; 
      case 1: 
      $value = 1;  
       break; 
      case 2: 
      $value = 0;  
       break; 
      case 3: 
      $value = 1;  
       break; 
      case 4: 
      $value = 0;  
       break; 
      case 5: 
      $value = 1;  
       break; 
      case 6: 
      $value = 0;  
       break; 
      case 7: 
      $value = 1;  
       break; 
      case 8: 
      $value = 0;  
       break; 
      case 9: 
      $value = 1;  
       break; 
      case 10: 
      $value = 0;  
       break; 
      case 11: 
      $value = 1;  
       break; 
      case 12: 
      $value = 0;  
       break; 
      case 13: 
      $value = 1;  
       break; 
      case 14: 
      $value = 0;  
       break; 
      case 15: 
      $value = 1;  
       break; 
      case 16: 
      $value = 0;  
       break; 
      case 17: 
      $value = 1;  
       break; 
      case 18: 
      $value = 0;  
       break; 
      case 19: 
      $value = 1;  
       break; 
      case 20: 
      $value = 0;  
       break; 
      case 21: 
      $value = 0;  
       break; 
      case 22: 
      $value = 0;  
       break; 
      case 23: 
      $value = 0;  
       break; 
      case 24: 
      $value = 1;  
       break; 
      case 25: 
      $value = 0;  
       break; 
      case 26: 
      $value = 0;  
       break; 
      case 27: 
      $value = 0;  
       break; 
      case 28: 
      $value = 1;  
       break; 
      case 29: 
      $value = 0;  
       break; 
      case 30: 
      $value = 0;  
       break; 
      case 31: 
      $value = 1;  
       break; 
      case 32: 
      $value = 0;  
       break; 
      case 33: 
      $value = 0;  
       break; 
      case 34: 
      $value = 0;  
       break; 
      
} 
     
  return $value; 
       
  } 


?>
<div class="bdr bg_main mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8"><div class="mt8 ml5 mb5"><div class="fl ml5 sz0">
<a href=""><img class="item_icon" src="http://144.76.127.94/view/image/builds/build1_1.png"></a></div>
<div class="ml68 mt5"><a class="medium lwhite tdn" href="?"> Академия <span class="lwhite small">(<?=$i['built_1']?> из 20)</span></a></div><div class="ml68 mt5 lorange small">
Бонус: +<?=clan_bufff($i['built_1'])?>% к опыту в <a href=/lair>подземелье</a></div></div>
<div class="clb"></div></div></div></div></div></div></div></div></div></div>
<? 
if($i['built_1'] > 0) { 
}
if($i['id'] == $clan['id'] && $clan_memb['rank'] == 5) {
if($_GET['done'] == true) { 
if($i['built_1_time'] > time()) { 
header('location: /clan/'); 
exit; 
}
$_cost_done = 72;  
if($i['g'] >= $_cost_done)    { 
mysql_query('UPDATE `clans` SET `g` = "'.($i['g'] - $_cost_done).'", `built_1_time`= "'.(time()+(259200)).'" WHERE `id` = "'.$i['id'].'"');
header('location: /clan/built/'); 
exit; 
}}} 
if($i['id'] == $clan['id'] && $clan_memb['rank'] == 5 && $i['built_1'] < 20) {
if($_GET['up1'] == true) { 
if($i[(value($i['built_1']) == 1 ? 'g':'s')] >= cost($i['built_1'])) {
mysql_query('UPDATE `clans` SET `built_1` = `built_1` + 1,`'.(value($i['built_1']) == 1 ? 'g':'s').'` = `'.(value($i['built_1']) == 1 ? 'g':'s').'` - '.cost($i['built_1']).' WHERE `id` = "'.$i['id'].'"');
header('location: /clan/built/');
}} 
?> 
<br><div class="cntr"><a href="/clan/built/?up1=true" class="ubtn inbl green mb5 mt-15 ml5 mr5"><span class="ul"><span class="ur"><img src="/images/ico/png/<?=(value($i['built_1']) == 1 ? 'gold':'silver')?>.png" class=icon> <?=cost($i['built_1'])?></a></span></span></a></div>
<?
}




?>
<div class="bdr bg_main mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8"><div class="mt8 ml5 mb5"><div class="fl ml5 sz0">
<a href=""><img class="item_icon" src="http://144.76.127.94/view/image/builds/build2_1.png"></a></div>
<div class="ml68 mt5"><a class="medium lwhite tdn" href="?"> Архив знаний <span class="lwhite small">(<?=$i['built_2']?> из 20)</span></a></div><div class="ml68 mt5 lorange small">
Бонус: +<?=clan_bufff($i['built_2'])?>% к опыту на <a href=/arena>арене</a></div></div>
<div class="clb"></div></div></div></div></div></div></div></div></div></div>
<? 
if($i['built_2'] > 0) { 
}
if($i['id'] == $clan['id'] && $clan_memb['rank'] == 5) {
if($_GET['done'] == true) { 
if($i['built_2_time'] > time()) { 
header('location: /clan/'); 
exit; 
}
$_cost_done = 72;  
if($i['g'] >= $_cost_done)    { 
mysql_query('UPDATE `clans` SET `g` = "'.($i['g'] - $_cost_done).'", `built_2_time`= "'.(time()+(259200)).'" WHERE `id` = "'.$i['id'].'"');
header('location: /clan/built/'); 
exit; 
}}} 
if($i['id'] == $clan['id'] && $clan_memb['rank'] == 5 && $i['built_2'] < 20) {
if($_GET['up2'] == true) { 
if($i[(value($i['built_2']) == 1 ? 'g':'s')] >= cost($i['built_2'])) {
mysql_query('UPDATE `clans` SET `built_2` = `built_2` + 1,`'.(value($i['built_2']) == 1 ? 'g':'s').'` = `'.(value($i['built_2']) == 1 ? 'g':'s').'` - '.cost($i['built_2']).' WHERE `id` = "'.$i['id'].'"');
header('location: /clan/built/');
}} 
?> 
<br><div class="cntr"><a href="/clan/built/?up2=true" class="ubtn inbl green mb5 mt-15 ml5 mr5"><span class="ul"><span class="ur"><img src="/images/ico/png/<?=(value($i['built_2']) == 1 ? 'gold':'silver')?>.png" class=icon> <?=cost($i['built_2'])?></a></span></span></a></div>
<?
}



?>
<div class="bdr bg_main mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8"><div class="mt8 ml5 mb5"><div class="fl ml5 sz0">
<a href=""><img class="item_icon" src="http://144.76.127.94/view/image/builds/build3_1.png"></a></div>
<div class="ml68 mt5"><a class="medium lwhite tdn" href="?"> Магическая лавка <span class="lwhite small">(<?=$i['built_3']?> из 20)</span></a></div><div class="ml68 mt5 lorange small">
Бонус: +<?=clan_bufff($i['built_3'])?>% к серебру в <a href=/lair>подземелье</a></div></div>
<div class="clb"></div></div></div></div></div></div></div></div></div></div>
<? 
if($i['built_3'] > 0) { 
}
if($i['id'] == $clan['id'] && $clan_memb['rank'] == 5) {
if($_GET['done'] == true) { 
if($i['built_3_time'] > time()) { 
header('location: /clan/'); 
exit; 
}
$_cost_done = 72;  
if($i['g'] >= $_cost_done)    { 
mysql_query('UPDATE `clans` SET `g` = "'.($i['g'] - $_cost_done).'", `built_3_time`= "'.(time()+(259200)).'" WHERE `id` = "'.$i['id'].'"');
header('location: /clan/built/'); 
exit; 
}}} 
if($i['id'] == $clan['id'] && $clan_memb['rank'] == 5 && $i['built_3'] < 20) {
if($_GET['up3'] == true) { 
if($i[(value($i['built_3']) == 1 ? 'g':'s')] >= cost($i['built_3'])) {
mysql_query('UPDATE `clans` SET `built_3` = `built_3` + 1,`'.(value($i['built_3']) == 1 ? 'g':'s').'` = `'.(value($i['built_3']) == 1 ? 'g':'s').'` - '.cost($i['built_3']).' WHERE `id` = "'.$i['id'].'"');
header('location: /clan/built/');
}} 
?> 
<br><div class="cntr"><a href="/clan/built/?up3=true" class="ubtn inbl green mb5 mt-15 ml5 mr5"><span class="ul"><span class="ur"><img src="/images/ico/png/<?=(value($i['built_3']) == 1 ? 'gold':'silver')?>.png" class=icon> <?=cost($i['built_3'])?></a></span></span></a></div>
<?
}




?>
<div class="bdr bg_main mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8"><div class="mt8 ml5 mb5"><div class="fl ml5 sz0">
<a href=""><img class="item_icon" src="http://144.76.127.94/view/image/builds/build4_1.png"></a></div>
<div class="ml68 mt5"><a class="medium lwhite tdn" href="?"> Серебряный зал <span class="lwhite small">(<?=$i['built_4']?> из 20)</span></a></div><div class="ml68 mt5 lorange small">
Бонус: +<?=clan_bufff($i['built_4'])?>% к серебру на <a href=/arena>арене</a></div></div>
<div class="clb"></div></div></div></div></div></div></div></div></div></div>
<? 
if($i['built_4'] > 0) { 
}
if($i['id'] == $clan['id'] && $clan_memb['rank'] == 5) {
if($_GET['done'] == true) { 
if($i['built_4_time'] > time()) { 
header('location: /clan/'); 
exit; 
}
$_cost_done = 72;  
if($i['g'] >= $_cost_done)    { 
mysql_query('UPDATE `clans` SET `g` = "'.($i['g'] - $_cost_done).'", `built_4_time`= "'.(time()+(259200)).'" WHERE `id` = "'.$i['id'].'"');
header('location: /clan/built/'); 
exit; 
}}} 
if($i['id'] == $clan['id'] && $clan_memb['rank'] == 5 && $i['built_4'] < 20) {
if($_GET['up4'] == true) { 
if($i[(value($i['built_4']) == 1 ? 'g':'s')] >= cost($i['built_4'])) {
mysql_query('UPDATE `clans` SET `built_4` = `built_4` + 1,`'.(value($i['built_4']) == 1 ? 'g':'s').'` = `'.(value($i['built_4']) == 1 ? 'g':'s').'` - '.cost($i['built_4']).' WHERE `id` = "'.$i['id'].'"');
header('location: /clan/built/');
}} 
?> 
<br><div class="cntr"><a href="/clan/built/?up4=true" class="ubtn inbl green mb5 mt-15 ml5 mr5"><span class="ul"><span class="ur"><img src="/images/ico/png/<?=(value($i['built_4']) == 1 ? 'gold':'silver')?>.png" class=icon> <?=cost($i['built_4'])?></a></span></span></a></div>
<?
}



?>
<div class="bdr bg_main mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8"><div class="mt8 ml5 mb5"><div class="fl ml5 sz0">
<a href=""><img class="item_icon" src="http://144.76.127.94/view/image/builds/build5_1.png"></a></div>
<div class="ml68 mt5"><a class="medium lwhite tdn" href="?"> Зал славы <span class="lwhite small">(<?=$i['built_5']?> из 20)</span></a></div><div class="ml68 mt5 lorange small">
Бонус: +<?=clan_bufff($i['built_5'])?>% к доблести в <a href=/lair>подземелье</a></div></div>
<div class="clb"></div></div></div></div></div></div></div></div></div></div>
<? 
if($i['built_5'] > 0) { 
}
if($i['id'] == $clan['id'] && $clan_memb['rank'] == 5) {
if($_GET['done'] == true) { 
if($i['built_5_time'] > time()) { 
header('location: /clan/'); 
exit; 
}
$_cost_done = 72;  
if($i['g'] >= $_cost_done)    { 
mysql_query('UPDATE `clans` SET `g` = "'.($i['g'] - $_cost_done).'", `built_5_time`= "'.(time()+(259200)).'" WHERE `id` = "'.$i['id'].'"');
header('location: /clan/built/'); 
exit; 
}}} 
if($i['id'] == $clan['id'] && $clan_memb['rank'] == 5 && $i['built_5'] < 20) {
if($_GET['up5'] == true) { 
if($i[(value($i['built_5']) == 1 ? 'g':'s')] >= cost($i['built_5'])) {
mysql_query('UPDATE `clans` SET `built_5` = `built_5` + 1,`'.(value($i['built_5']) == 1 ? 'g':'s').'` = `'.(value($i['built_5']) == 1 ? 'g':'s').'` - '.cost($i['built_5']).' WHERE `id` = "'.$i['id'].'"');
header('location: /clan/built/');
}} 
?> 
<br><div class="cntr"><a href="/clan/built/?up5=true" class="ubtn inbl green mb5 mt-15 ml5 mr5"><span class="ul"><span class="ur"><img src="/images/ico/png/<?=(value($i['built_5']) == 1 ? 'gold':'silver')?>.png" class=icon> <?=cost($i['built_5'])?></a></span></span></a></div>
<?
}






?>
<div class="bdr bg_main mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8"><div class="mt8 ml5 mb5"><div class="fl ml5 sz0">
<a href=""><img class="item_icon" src="http://144.76.127.94/view/image/builds/build6_1.png"></a></div>
<div class="ml68 mt5"><a class="medium lwhite tdn" href="?"> Обелиск доблести <span class="lwhite small">(<?=$i['built_6']?> из 20)</span></a></div><div class="ml68 mt5 lorange small">
Бонус: +<?=clan_bufff($i['built_6'])?>% к доблести на <a href=/arena>арене</a></div></div>
<div class="clb"></div></div></div></div></div></div></div></div></div></div>
<? 
if($i['built_6'] > 0) { 
}
if($i['id'] == $clan['id'] && $clan_memb['rank'] == 5) {
if($_GET['done'] == true) { 
if($i['built_6_time'] > time()) { 
header('location: /clan/'); 
exit; 
}
$_cost_done = 72;  
if($i['g'] >= $_cost_done)    { 
mysql_query('UPDATE `clans` SET `g` = "'.($i['g'] - $_cost_done).'", `built_6_time`= "'.(time()+(259200)).'" WHERE `id` = "'.$i['id'].'"');
header('location: /clan/built/'); 
exit; 
}}} 
if($i['id'] == $clan['id'] && $clan_memb['rank'] == 5 && $i['built_6'] < 20) {
if($_GET['up6'] == true) { 
if($i[(value($i['built_6']) == 1 ? 'g':'s')] >= cost($i['built_6'])) {
mysql_query('UPDATE `clans` SET `built_6` = `built_6` + 1,`'.(value($i['built_6']) == 1 ? 'g':'s').'` = `'.(value($i['built_6']) == 1 ? 'g':'s').'` - '.cost($i['built_6']).' WHERE `id` = "'.$i['id'].'"');
header('location: /clan/built/');
}} 
?> 
<br><div class="cntr"><a href="/clan/built/?up6=true" class="ubtn inbl green mb5 mt-15 ml5 mr5"><span class="ul"><span class="ur"><img src="/images/ico/png/<?=(value($i['built_6']) == 1 ? 'gold':'silver')?>.png" class=icon> <?=cost($i['built_6'])?></a></span></span></a></div>
<?
}




/*
?>
<div class="bdr bg_main mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8"><div class="mt8 ml5 mb5"><div class="fl ml5 sz0">
<a href=""><img class="item_icon" src="http://144.76.127.94/view/image/builds/build7_1.png"></a></div>
<div class="ml68 mt5"><a class="medium lwhite tdn" href="?"> Дом герольдов <span class="lwhite small">(<?=$i['built_7']?> из 20)</span></a></div><div class="ml68 mt5 lorange small">
Бонус: +<?=clan_bufff($i['built_7'])?>% к алмазам в <a href=/lair>подземелье</a></div></div>
<div class="clb"></div></div></div></div></div></div></div></div></div></div>
<? 
if($i['built_7'] > 0) { 
}
if($i['id'] == $clan['id'] && $clan_memb['rank'] == 5) {
if($_GET['done'] == true) { 
if($i['built_7_time'] > time()) { 
header('location: /clan/'); 
exit; 
}
$_cost_done = 72;  
if($i['g'] >= $_cost_done)    { 
mysql_query('UPDATE `clans` SET `g` = "'.($i['g'] - $_cost_done).'", `built_7_time`= "'.(time()+(259200)).'" WHERE `id` = "'.$i['id'].'"');
header('location: /clan/built/'); 
exit; 
}}} 
if($i['id'] == $clan['id'] && $clan_memb['rank'] == 5 && $i['built_7'] < 20) {
if($_GET['up7'] == true) { 
if($i[(value($i['built_7']) == 1 ? 'g':'s')] >= cost($i['built_7'])) {
mysql_query('UPDATE `clans` SET `built_7` = `built_7` + 1,`'.(value($i['built_7']) == 1 ? 'g':'s').'` = `'.(value($i['built_7']) == 1 ? 'g':'s').'` - '.cost($i['built_7']).' WHERE `id` = "'.$i['id'].'"');
header('location: /clan/built/');
}} 
?> 
<br><div class="cntr"><a href="/clan/built/?up7=true" class="ubtn inbl green mb5 mt-15 ml5 mr5"><span class="ul"><span class="ur"><img src="/images/ico/png/<?=(value($i['built_7']) == 1 ? 'gold':'silver')?>.png" class=icon> <?=cost($i['built_7'])?></a></span></span></a></div>
<?
}


?>
<div class="bdr bg_main mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8"><div class="mt8 ml5 mb5"><div class="fl ml5 sz0">
<a href=""><img class="item_icon" src="http://144.76.127.94/view/image/builds/build8_1.png"></a></div>
<div class="ml68 mt5"><a class="medium lwhite tdn" href="?"> Цитадель герольдов <span class="lwhite small">(<?=$i['built_8']?> из 20)</span></a></div><div class="ml68 mt5 lorange small">
Бонус: +<?=clan_bufff($i['built_8'])?>% к алмазам на <a href=/arena>арене</a></div></div>
<div class="clb"></div></div></div></div></div></div></div></div></div></div>
<? 
if($i['built_8'] > 0) { 
}
if($i['id'] == $clan['id'] && $clan_memb['rank'] == 5) {
if($_GET['done'] == true) { 
if($i['built_8_time'] > time()) { 
header('location: /clan/'); 
exit; 
}
$_cost_done = 72;  
if($i['g'] >= $_cost_done)    { 
mysql_query('UPDATE `clans` SET `g` = "'.($i['g'] - $_cost_done).'", `built_8_time`= "'.(time()+(259200)).'" WHERE `id` = "'.$i['id'].'"');
header('location: /clan/built/'); 
exit; 
}}} 
if($i['id'] == $clan['id'] && $clan_memb['rank'] == 5 && $i['built_8'] < 20) {
if($_GET['up8'] == true) { 
if($i[(value($i['built_8']) == 1 ? 'g':'s')] >= cost($i['built_8'])) {
mysql_query('UPDATE `clans` SET `built_8` = `built_8` + 1,`'.(value($i['built_8']) == 1 ? 'g':'s').'` = `'.(value($i['built_8']) == 1 ? 'g':'s').'` - '.cost($i['built_8']).' WHERE `id` = "'.$i['id'].'"');
header('location: /clan/built/');
}} 
?> 
<br><div class="cntr"><a href="/clan/built/?up8=true" class="ubtn inbl green mb5 mt-15 ml5 mr5"><span class="ul"><span class="ur"><img src="/images/ico/png/<?=(value($i['built_8']) == 1 ? 'gold':'silver')?>.png" class=icon> <?=cost($i['built_8'])?></a></span></span></a></div>
<?
}

 
}

$open_1 = mysql_num_rows(mysql_query("SELECT * FROM clan_poxod_open WHERE clan = '".$clan['id']."'"));  
if ($open_1 <= 0){ 
?>



<?
*/
include './system/f.php'; 
  break;
if($_GET['go_poxod'] == true && $clan_memb['rank'] == 5){
	
	mysql_query("INSERT INTO clan_poxod_open SET clan = '".$clan['id']."', start = '0', nagr = '0'");
	mysql_query("INSERT INTO clan_msg SET clan = '".$clan['id']."', user = '".$user['id']."', text = 'Начался поход кланов<br>', time = '".time()."'");	
	header('location: /clanland/');	
}
}




?>