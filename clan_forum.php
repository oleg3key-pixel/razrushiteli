<?
include './system/common.php';  
include './system/functions.php';
include './system/user.php';
    
$act = isset($_GET['act']) ? $_GET['act'] : null;
switch($act) {
default:
 $id = _string(_num($_GET['id']));
 $clan_memb = mysql_fetch_array(mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$user['id'].'" '));
  $sub = mysql_fetch_array(mysql_query('SELECT * FROM `clan_forum_sub` WHERE `clan` = "'.$id.'" '));
 $us = mysql_fetch_array(mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$id.'" '));
      $title = 'Форум клана '.$us['name'].'';    
include './system/h.php';
echo '<div class="ribbon mb2"><div class="rl"><div class="rr">'.$title.'</div></div></div>';
 
 
$max = 10;
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_forum_sub` WHERE `clan` = "'.$id.'" '),0);
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));

if($page > $pages) $page = $pages;
if($page < 1) $page = 1;
$start = $page * $max - $max;



if(!$id) {
header('Location: /');
exit;}

if($count > 0) {
$q = mysql_query('SELECT * FROM `clan_forum_sub` WHERE `clan` = "'.$id.'" ORDER BY `id` DESC LIMIT '.$start.', '.$max.'');
while($row = mysql_fetch_array($q)) {
echo '
<table> <tbody><tr>
<td><a class=mbtn mb2 href="/clan_forum/sub/'.$row['id'].'/">  
<img src="/images/ico/png/forum.png" class=icon> '.$row['name'].' </a> </td>';
if($clan_memb['rank'] >= '3' && $clan_memb['clan'] == $id){//Доступно для лидера и генерала
echo' <td width="10%"><a class=mbtn mb2 href="/clan_forum/edit_sub/'.$row['id'].'/"><img src=http://144.76.125.123/view/image/icons/edit_forum.png class=icon></a></td> <td width="10%"><a class=mbtn mb2 href="/clan_forum/del_sub/'.$row['id'].'/"><img src=http://144.76.125.123/view/image/icons/delete_all.png class=icon></a></td>';
}
echo'</tr></tbody></table>';
}
//  echo ' '.pages('/clan_forum/'.$id.'/?').'
// <div class="line"></div>';

}else{
 echo'<div class="bntf"><div class="small"><div class="nl"><div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">Список разделов пуст</div></div></div></div>';

}
if($clan_memb['rank'] >= '5' && $clan_memb['clan'] == $id ){//Создавать может лидер и генерал
echo'<a class=mbtn mb2 href="/clan_forum/add_sub/'.$id.'/"><img src="/images/ico/png/chat_new.png" class=icon> Создать раздел </a> </div>
<div class="line"></div>';
}

break;	


case 'sub':	


 $id = _string(_num($_GET['id']));
  $clan_memb = mysql_fetch_array(mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$user['id'].'" '));
   $sub = mysql_fetch_array(mysql_query('SELECT * FROM `clan_forum_sub` WHERE `id` = "'.$id.'" '));
 $clan_forum_topic = mysql_fetch_array(mysql_query('SELECT * FROM `clan_forum_topic` WHERE `sub` = "'.$id.'" '));
      $title = ''.$sub['name'].'';    
include './system/h.php';
echo '<div class="ribbon mb2"><div class="rl"><div class="rr">'.$title.'</div></div></div>';
 
 
$max = 10;
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_forum_topic` WHERE `sub` = "'.$id.'" '),0);
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));

if($page > $pages) $page = $pages;
if($page < 1) $page = 1;
$start = $page * $max - $max;



if(!$id) {
header('Location: /');
exit;}

if($count > 0) {
$q = mysql_query('SELECT * FROM `clan_forum_topic` WHERE `sub` = "'.$id.'" ORDER BY `stick` DESC, `id` DESC LIMIT '.$start.', '.$max.'');
while($row = mysql_fetch_array($q)) {
echo '
<table> <tbody><tr>
<td><a class=mbtn mb2 href="/clan_forum/topic/'.$row['id'].'/"><img src="/images/ico/png/forum.png" class=icon>  
'.($row['stick'] == 1 ? '<font color="#fff">'.$row['name'].'</font>':''.$row['name'].'').'</a></td>';
if($clan_memb['rank'] >= '3' && $clan_memb['clan'] == $sub['clan']){//Доступно для лидера и генерала
echo' <td width="10%"><a class=mbtn mb2 href="/clan_forum/edit_topic/'.$row['id'].'/"><img src=http://144.76.125.123/view/image/icons/edit_forum.png class=icon></a></td>
<td width="10%"><a class=mbtn mb2 href="/clan_forum/del_topic/'.$row['id'].'/"><img src=http://144.76.125.123/view/image/icons/delete_all.png class=icon></a></td>';
}
echo'</tr></tbody></table>';
}
  echo ''.pages('/clan_forum/sub/'.$id.'/?').'
  <div class="line"></div>';
}else{
 echo'<div class="bntf"><div class="small"><div class="nl"><div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">Список топиков пуст</div></div></div></div><div class="hr_g mb2"><div><div></div></div></div>';
}

if($clan_memb['rank'] >= $sub['rank'] && $clan_memb['clan'] == $sub['clan']){ //Создавть могут все кто имеет допустимый ранг
echo' <div class="block_link"><a class=mbtn mb2 href="/clan_forum/add_topic/'.$id.'/"><img src="/images/ico/png/chat_new.png" class=icon> Создать топик </a></div>
<div class="line"></div>';
}
echo'
<div class="block_link"><a class=mbtn mb2 href="/clan_forum/'.$sub['clan'].'"><img src="/images/ico/png/back.png" class=icon> Назад к форумам </a></div>
<div class="line"></div>';
break;	


case 'topic':	


 $id = _string(_num($_GET['id']));
  $clan_memb = mysql_fetch_array(mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$user['id'].'" '));

 $topic = mysql_fetch_array(mysql_query('SELECT * FROM `clan_forum_topic` WHERE `id` = "'.$id.'" '));
      $sub = mysql_fetch_array(mysql_query('SELECT * FROM `clan_forum_sub` WHERE `id` = "'.$topic['sub'].'" '));
  $us = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$topic['user'].'" '));
      $title = ''.$topic['name'].'';    
include './system/h.php';
echo '<div class="ribbon mb2"><div class="rl"><div class="rr">'.$title.'</div></div></div>';

 
if(!$id) {
header('Location: /');
exit;}


if($clan_memb['rank'] >= 3 && $clan_memb['clan'] == $sub['clan']) {
  
  if($_GET['stick'] == true) {
mysql_query('UPDATE `clan_forum_topic` SET `stick` = "'.($topic['stick'] == 0 ? 1:0).'" WHERE `id` = "'.$topic['id'].'"');
header('location: /clan_forum/topic/'.$topic['id'].'/');
}
  
  if($_GET['close'] == true) {
mysql_query('UPDATE `clan_forum_topic` SET `close` = "'.($topic['close'] == 0 ? 1:0).'" WHERE `id` = "'.$topic['id'].'"');
header('location: /clan_forum/topic/'.$topic['id'].'/');
}

  if($_GET['delete'] == true) {
$q = mysql_query('SELECT * FROM `clan_forum_comments` WHERE `topic` = "'.$topic['id'].'"');
while($row = mysql_fetch_array($q)) {
mysql_query('DELETE FROM `clan_forum_comments` WHERE `id` = "'.$row['id'].'"');
}

header('location: /clan_forum/sub/'.$topic['sub'].'/');
mysql_query('DELETE FROM `clan_forum_topic` WHERE `id` = "'.$topic['id'].'"');
}



$q = mysql_query('SELECT * FROM `clan_forum_topic` WHERE `id` = "'.$id.'" ORDER BY `id` DESC LIMIT 1');
while($row = mysql_fetch_array($q)) {
echo'<div class="empty_block">


<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">

<span id="msg15330958"></span>
	<div class="ml10 mt5 mb2 mr10 sh">
		<a href="/user/'.$us['id'].'/" class="tdn lwhite"> '.nick($us['id']).' </a>
		<span class="grey1 small">'._times(time() -$row['time']).' назад</span>
	</div>
	<div class="ml10 mt2 mb5 mr10 sh">
		<span class="lblue "><font color="'.color($us['id']).'">'.bbcode(smile($row['text'])).'</font></span>  <span style="display: none"><br><span class="grey1 small">[ <a class="grey1 small" href="/message_delete?id=15330958&amp;page=1&amp;thread=884974">x</a> | <a class="grey1 small" href="/message_edit?id=15330958&amp;page=1&amp;thread=884974">правка</a>]</span></span>
	</div></div></div></div></div></div></div></div></div></div>';







echo'<a class=mbtn mb2 href="/clan_forum/topic/'.$topic['id'].'/?stick=true"> '.($topic['stick'] == 0 ? 'Закрепить':'Открепить').' </a>
<a class=mbtn mb2 href="/clan_forum/topic/'.$topic['id'],'/?close=true"> '.($topic['close'] == 0 ? 'Закрыть':'Открыть').' </a>
<a class=mbtn mb2 href="/clan_forum/topic/'.$topic['id'].'?delete=true">Удалить</a>';


}


    
}

/////////////////////////////////// Коментарии
//////////////////////////////////
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_forum_comments` WHERE `topic` = "'.$topic['id'].'"'),0);

 echo'<div class="empty_block item_center">';

  if($topic['close'] == 0) {//Написать коментарий
$text = _string($_POST['text']);
$to = _string(_num($_GET['to']));

  if($to) {
$_to = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$to.'"');
$_to = mysql_fetch_array($_to);
  
  if(!$_to OR $_to['id'] == $user['id']) {
header('location: /clan_forum/topic/'.$id.'/?page='.$page); 
exit;
  }
}

  if($_to) {
$text = str_replace($_to['login'].', ', '', $text);
}

  if($text) {
mysql_query('INSERT INTO `clan_forum_comments` (`topic`,`user`,`to`,`text`,`time`) VALUES ("'.$topic['id'].'", "'.$user['id'].'", "'.$_to['id'].'", "'.$text.'", "'.time().'")');
header('location: /clan_forum/topic/'.$topic['id'].'/?page='.$pages);
}

















 echo'
<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="ml10 mt5 mb5 mr10 sh cntr">

	<div class="cntr mb5 small grey1">
		<img class="icon" src="http://144.76.127.94/view/image/art/ico16-grey_smile.png" width="16" height="16" alt=":)"> <a class="tdn lwhite" class="grey1" href="/game/smiles">Смайлики</a>
					<span class="delimiter"> | </span><a class="tdn lwhite" class="grey1" href="/game/bb_code">BB-коды</a>
			</div>
			<form action="/clan_forum/topic/'.$topic['id'].'/?page='.$page.'&to='.$to.'"  method="post" class="mr5">
			<textarea class="lbfld w100" name="text" rows="5">'.($to ? $_to['login'].', ':'').'</textarea>
			<div class="mb5"></div>
			<input type="hidden" name="answer_id" value="0">
			<input type="hidden" name="thread_id" value="884974">
			<input type="submit" class="ibtn" value="Отправить">
		</form>
		</div>
	</div></div></div></div></div></div></div></div></div>
	
	
	
</form>';
}else{
 echo'<div class="hr_g mb2"><div><div></div></div></div><div class="bntf"><div class="small"><div class="nl"><div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">Топик закрыт</div></div></div></div>';
}
  echo'</div><div class="line"></div>';

  
  
  if($count > 0) {//Вывод коментариев
$max = 10;
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));

 if($page > $pages) {$page = $pages;}
 if($page < 1) {$page = 1;}
$start = $page * $max - $max;

$q = mysql_query('SELECT * FROM `clan_forum_comments` WHERE `topic` = "'.$topic['id'].'" ORDER BY `id` LIMIT '.$start.', '.$max.'');

  while($row = mysql_fetch_array($q)) {

  $comment_user = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'"');
  $comment_user = mysql_fetch_array($comment_user);



echo'<div class="empty_block">
<a href="/user/'.$comment_user['id'].'/">'.nick($comment_user['id']).'</a>
<a href="/clan_forum/topic/'.$topic['id'].'/?page='.$page.'&to='.$comment_user['id'].'">(&#187;)</a>';
 if($clan_memb['rank'] >= 3 && $clan_memb['clan'] == $sub['clan']) {//Доступно для генирала и лидера
$comment = _string(_num($_GET['comment']));

  if($comment) {
mysql_query('DELETE FROM `clan_forum_comments` WHERE `id` = "'.$comment.'"');
header('location: /clan_forum/topic/'.$topic['id'].'/?page='.$page);}
echo' <a href="/clan_forum/topic/'.$topic['id'].'/?page='.$page.'&comment='.$row['id'].'">[x]</a>';
}
echo'<span style="float: right;"><small>'._times(time() - $row['time']).'</small></span><br/>';



    if($row['to']) {
$__to = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['to'].'"');
$__to = mysql_fetch_array($__to);

if($__to['id'] == $user['id']) {
echo' <font color="#90c090">';
}
echo' '.$__to['login'].', ';
if($__to['id'] == $user['id']) {
echo' </font>';
 }
}



echo'<font color="'.color($comment_user['id']).'">
 '.bbcode(smile($row['text'])).' 
</font>
</div><div class="line"></div>';
  }
	echo''.pages('/clan_forum/topic/'.$topic['id'].'/?').''; 
}else{
}

echo'<div class="hr_g mb2"><div><div></div></div></div>
<div class="block_link"><a class=mbtn mb2 href="/clan_forum/sub/'.$sub['id'].'"><img src="/images/ico/png/back.png" class=icon> Назад к топикам </a></div>';
break;	






case 'add_sub':
 $id = _string(_num($_GET['id']));
  $clan_memb = mysql_fetch_array(mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$user['id'].'" '));

$title = 'Создать раздел';    
include './system/h.php';

 if($id != $clan_memb['clan']) {//Пепенаправляем,  если не ваш клан
header('location: /clan_forum/'.$clan_memb['clan'].'/');
exit;}


echo '<div class="ribbon mb2"><div class="rl"><div class="rr">'.$title.'</div></div></div>';



$name = _string($_POST['name']);
$rank = _string(_num($_POST['rank']));
  
    if(isset($_REQUEST['submit'])){
          if(empty($name) or mb_strlen($name,'UTF-8') < 1){
header("Location: ?");
$_SESSION['mes'] = mes('Введите название!');
header('location: /clan_forum/add_sub/'.$id.'/');
exit;}    


mysql_query('INSERT INTO `clan_forum_sub` (`name`, `clan`, `rank`) VALUES ("'.$name.'", "'.$clan_memb['clan'].'", "'.$rank.'")');
$sub_id = mysql_insert_id();
$_SESSION['mes'] = mes('Раздел успешно добавлен!');
header('location: /clan_forum/sub/'.$sub_id.'/');
exit;
  }
  
  
    echo' '.$_SESSION['mes'].'  ';
    $_SESSION['mes']=NULL; //Удаляем сесию
echo'<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="ml10 mt5 mb5 mr10 sh cntr">
  
  <form action="/clan_forum/add_sub/'.$id.'/" method="post">
  Название раздела<br/>
  <input type="text" maxlength="30" class="lbfld h25 w100" name="name" value="">
  Создавать топики могут<br/>
  <div class="mt5"><input type="radio" name="rank" id="0" value="0"><label for="0">Все игроки</label></div>
  <div class="mt5"><input type="radio" name="rank" id="1" value="1"><label for="1">Ветераны</label></div>
  <div class="mt5"><input type="radio" name="rank" id="2" value="2"><label for="2">Офицеры</label></div>
  <div class="mt5"><input type="radio" name="rank" id="3" value="3"><label for="3">Генералы</label></div>
  <div class="mt5"><input type="radio" name="rank" id="4" value="4"><label for="4">Маршал</label></div>
  <div class="mt5"><input type="radio" name="rank" id="5" value="5"><label for="5">Лидер</label></div>
<br/>
<input type="submit" name="submit" class="ibtn" value="Сохрнить">
  </form>
  </div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div>';
  
echo'<div class="line"></div>
<div class="block_link"><a class=mbtn mb2  href="/clan_forum/'.$clan_memb['clan'].'"><img src="/images/ico/png/back.png" class=icon> Назад в форум </a></div>
<div class="line"></div>';
break;	

case 'edit_sub':
 $id = _string(_num($_GET['id']));
  $clan_memb = mysql_fetch_array(mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$user['id'].'" '));
 $sub = mysql_fetch_array(mysql_query('SELECT * FROM `clan_forum_sub` WHERE `id` = "'.$id.'" '));
 
  $us = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$sub['user'].'" '));
$title = 'Изменить раздел';    
include './system/h.php';

 if($sub['clan'] != $clan_memb['clan']) {//Пепенаправляем,  если не ваш клан
header('location: /clan_forum/'.$clan_memb['clan'].'/');
exit;}



echo '<div class="ribbon mb2"><div class="rl"><div class="rr">'.$title.'</div></div></div>';


$name = _string($_POST['name']);
  if($name) {
mysql_query('UPDATE `clan_forum_sub` SET `name` = "'.$name.'" WHERE `id` = "'.$sub['id'].'"');
header('location: /clan_forum/edit_sub/'.$sub['id'].'/');
}
  
echo'
<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="ml10 mt5 mb5 mr10 sh cntr">
	<form action="/clan_forum/edit_sub/'.$sub['id'].'/" method="post">
  Название раздела<br/>
  <input type="text" maxlength="30" class="lbfld h25 w100" name="name" value="'.$sub['name'].'">
  <input  type="submit" class="ibtn" value="Сохранить"/>
  </form>
  </div>	</div>
	</div></div></div></div></div></div></div></div></div>';
  echo'<div class="line"></div>
<div class="block_link"><a class=mbtn mb2 href="/clan_forum/'.$clan_memb['clan'].'"><img src="/images/ico/png/back.png" class=icon> Назад в форум </a></div>';
break;	


case 'del_sub':
 $id = _string(_num($_GET['id']));
  $clan_memb = mysql_fetch_array(mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$user['id'].'" '));
 $sub = mysql_fetch_array(mysql_query('SELECT * FROM `clan_forum_sub` WHERE `id` = "'.$id.'" '));
 
$title = 'Изменить раздел';    
include './system/h.php';
echo '<div class="ribbon mb2"><div class="rl"><div class="rr">'.$title.'</div></div></div>';


 if($sub['clan'] != $clan_memb['clan']) {//Пепенаправляем,  если не ваш клан
header('location: /clan_forum/'.$clan_memb['clan'].'/');
exit;}




  if($_GET['delete'] == true) {
  
$q = mysql_query('SELECT * FROM `clan_forum_topic` WHERE `sub` = "'.$sub['id'].'"');
while($row = mysql_fetch_array($q)) {
mysql_query('DELETE FROM `clan_forum_comments` WHERE `topic` = "'.$row['id'].'"');
}
    
mysql_query('DELETE FROM `clan_forum_topic` WHERE `sub` = "'.$sub['id'].'"');   
mysql_query('DELETE FROM `clan_forum_sub` WHERE `id` = "'.$sub['id'].'"');
header('location: /clan_forum/'.$clan_memb['clan'].'/'); 
}


  
echo'
<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="ml10 mt5 mb5 mr10 sh cntr">
 
  Вы дейстаительно хотите удалить<br>'.$sub['name'].' ? <br/></div> </div> </div> </div> </div> </div> </div> </div> </div> </div> </div> </div> </div> </div>
  <div class="link_center"><a class=mbtn mb2 href="/clan_forum/del_sub/?delete=true&id='.$sub['id'].'/"><img src=http://144.76.125.123/view/image/icons/ok.png class=icon> Да</a></div>
  <div class="link_center_h"><a class=mbtn mb2 href="/clan_forum/'.$sub['clan'].'/"> <img src=http://144.76.125.123/view/image/icons/error.png class=icon> Нет</a></div>
  ';
break;	







case 'add_topic':
 $id = _string(_num($_GET['id']));
  $clan_memb = mysql_fetch_array(mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$user['id'].'" '));
  $sub = mysql_fetch_array(mysql_query('SELECT * FROM `clan_forum_sub` WHERE `id` = "'.$id.'" '));
  
  
      $title = 'Создать топик';    
include './system/h.php';
echo '<div class="ribbon mb2"><div class="rl"><div class="rr">'.$title.'</div></div></div>';

 if($sub['clan'] != $clan_memb['clan']) {//Пепенаправляем, если не ваш клан
header('location: /clan_forum/sub/'.$sub['id'].'/');
exit;}



$name = _string($_POST['name']);
$text = _string($_POST['text']);
  if(isset($_REQUEST['submit'])) {
	  
    if(empty($name) or mb_strlen($name,'UTF-8') < 1 AND empty($text) or mb_strlen($text,'UTF-8') < 1){
header("Location: ?");
$_SESSION['mes'] = mes('Одно из полей не заполнено!');
header('location: /clan_forum/add_topic/'.$sub['id'].'/');
exit;} 
	  
      mysql_query('INSERT INTO `clan_forum_topic` (`sub`,
											 `clan`,
                                             `name`,
                                             `user`,
                                             `text`,
                                             `time`) VALUES ("'.$id.'",
															"'.$clan_memb['clan'].'",
                                                            "'.$name.'",
															"'.$user['id'].'",
                                                            "'.$text.'",
                                                            "'.time().'")');
  
$topic_id = mysql_insert_id();
$_SESSION['mes'] = mes('Топик успешно создан!');
header('location: /clan_forum/topic/'.$topic_id.'/');
exit;
}
  
  echo' '.$_SESSION['mes'].'  ';
    $_SESSION['mes']=NULL; //Удаляем сесию
echo'



<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="ml10 mt5 mb5 mr10 sh cntr">

		<form action="/clan_forum/add_topic/'.$id.'/" method="POST" class="mr5">
			<span class="thread_name">Заголовок</span>			<div class="mb5"></div>
			<input maxlength="30" class="lbfld h25 w100" name="name" value="">
			<div class="mb5"></div>
			<span class="thread_name">Содержание</span>			<div class="mb5"></div>
			<textarea class="lbfld w100" name="text" rows="5"></textarea>
			<div class="mb5"></div>
  <input class="ibtn" name="submit" type="submit" value="Создать топик"/>

					</form>

	</div>
	</div></div></div></div></div></div></div></div></div>


';
  echo'<div class="line"></div>
<div class="block_link"><a class=mbtn mb2 href="/clan_forum/sub/'.$sub['id'].'"><img src="/images/ico/png/back.png" class=icon> Назад к форумам </a></div>
<div class="line"></div>';
break;	

case 'edit_topic':
 $id = _string(_num($_GET['id']));
  $clan_memb = mysql_fetch_array(mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$user['id'].'" '));
 $topic = mysql_fetch_array(mysql_query('SELECT * FROM `clan_forum_topic` WHERE `id` = "'.$id.'" '));
  $sub = mysql_fetch_array(mysql_query('SELECT * FROM `clan_forum_sub` WHERE `id` = "'.$topic['sub'].'" '));
      $title = 'Изменить топик';    
include './system/h.php';
echo '<div class="ribbon mb2"><div class="rl"><div class="rr">'.$title.'</div></div></div>';

 if($sub['clan'] != $clan_memb['clan']) {//Пепенаправляем, если не ваш клан
header('location: /clan_forum/sub/'.$sub['id'].'/');
exit;}


  
$name = _string($_POST['name']);
$text = _string($_POST['text']);
  if($name && $text) {
mysql_query('UPDATE `clan_forum_topic` SET `name` = "'.$name.'", `text` = "'.$text.'" WHERE `id` = "'.$topic['id'].'"');
header('location: /clan_forum/edit_topic/'.$topic['id'].'/');
}
  
echo'
<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="ml10 mt5 mb5 mr10 sh cntr">
  <form action="/clan_forum/edit_topic/'.$topic['id'].'/" method="post">
  Заголовок<br/>
  <input type="text" maxlength="30" class="lbfld h25 w100" name="name" value="'.$topic['name'].'">

  Содержание<br/>
  <textarea class="lbfld w100" name="text" rows="5">'.$topic['text'].'</textarea>
  <input type="submit" class="ibtn" value="Сохранить">
  </form>
</div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div>';
  echo'<div class="line"></div>
<div class="block_link"><a class=mbtn mb2 href="/clan_forum/sub/'.$sub['id'].'"><img src="/images/ico/png/back.png" class=icon> Назад к форумам </a></div>
<div class="line"></div>';
break;	


case 'del_topic':
 $id = _string(_num($_GET['id']));
  $clan_memb = mysql_fetch_array(mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$user['id'].'" '));
 $topic = mysql_fetch_array(mysql_query('SELECT * FROM `clan_forum_topic` WHERE `id` = "'.$id.'" '));
  $sub = mysql_fetch_array(mysql_query('SELECT * FROM `clan_forum_sub` WHERE `id` = "'.$topic['sub'].'" '));
      $title = 'Изменить топик';    
include './system/h.php';
echo '<div class="ribbon mb2"><div class="rl"><div class="rr">'.$title.'</div></div></div>';

 if($sub['clan'] != $clan_memb['clan']) {//Пепенаправляем, если не ваш клан
header('location: /clan_forum/sub/'.$sub['id'].'/');
exit;}



if($_GET['delete'] == true) {
$q = mysql_query('SELECT * FROM `clan_forum_comments` WHERE `topic` = "'.$topic['id'].'"');
while($row = mysql_fetch_array($q)) {
mysql_query('DELETE FROM `clan_forum_comments` WHERE `id` = "'.$row['id'].'"');
}

header('location: /clan_forum/sub/'.$topic['sub'].'/');
mysql_query('DELETE FROM `clan_forum_topic` WHERE `id` = "'.$topic['id'].'"');
}
  
echo'
  <div class="empty_block item_center">
 
  Вы дейстаительно хотите удалить топик: "'.$topic['name'].'"? <br/>
  <div class="link_center"><a href="/clan_forum/del_topic/?delete=true&id='.$topic['id'].'">Да</a></div>
  <div class="link_center_h"><a href="/clan_forum/sub/'.$topic['sub'].'">Нет</a></div>
  </div>
  <div class="line"></div>';
break;	






}
include './system/f.php';
?>