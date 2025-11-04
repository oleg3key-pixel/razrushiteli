<?
include './system/common.php';  
include './system/functions.php';
include './system/user.php';
    
if(!$user) {
header('location: /');
exit;}
    
$act = isset($_GET['act']) ? $_GET['act'] : null;
switch($act) {
default:
$title = 'Форум';    
include './system/h.php';
echo '  <div class="ribbon mb2"> <div class="rl">  <div class="rr"> '.$title.'   </div> </div> </div> ';

   echo' '.$_SESSION['mes'].'  ';
   $_SESSION['mes']=NULL; //Удаляем сесию
    
$max = 10;
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `forum_sub`'),0);
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));

if($page > $pages) $page = $pages;
if($page < 1) $page = 1;
$start = $page * $max - $max;

/*
if($count > 0) {
$q = mysql_query('SELECT * FROM `forum_sub` WHERE `id` != "7" ORDER BY `id` ASC LIMIT '.$start.', '.$max.'');
while($row = mysql_fetch_array($q)) {
echo '<div class="block_link">
<table> <tbody><tr>
<td><a href="/forum/sub/'.$row['id'].'/">  
<img src="/images/ico/png/forum.png" alt="*"> '.$row['name'].' </a> </td>';
if($user['access'] >= '2'){//Доступно для админа и создателя
echo' <td width="10%"><a href="/forum/edit_sub/'.$row['id'].'/">изменить</a></td>
<td width="10%"><a href="/forum/del_sub/'.$row['id'].'/">удалить</a></td>';
}
echo'</tr>
</tbody></table></div>
<div class="line"></div>';
}
  echo ' '.pages('/forum/'.$id.'/?').'
  <div class="line"></div>';

}else{
echo '<div class="empty_block item_center"> Нет разделов </div>
<div class="line"></div>';
}
if($user['access'] >= '2'){//Создавать может админ и создатель
echo' <div class="block_link"><a href="/forum/add_sub/"><img src="/images/ico/png/chat_new.png" alt="*"> Создать раздел </a> </div>
<div class="line"></div>';
}

break;	
*/


if($count > 0) {
$q = mysql_query('SELECT * FROM `forum_sub` WHERE `id` != "7" ORDER BY `id` ASC LIMIT '.$start.', '.$max.'');
while($row = mysql_fetch_array($q)) {
echo '<div class="block_link">
<table> <tbody><tr>
<td><a class = mbtn mb2 href="/forum/sub/'.$row['id'].'/">  
<img src="/images/ico/png/forum.png" alt="*"> '.$row['name'].' </a> </td>';
/*
if($user['access'] >= '2'){//Доступно для админа и создателя
echo' <td width="10%"><a href="/forum/edit_sub/'.$row['id'].'/">изменить</a></td>
<td width="10%"><a href="/forum/del_sub/'.$row['id'].'/">удалить</a></td>';
}
*/
echo'</tr>
</tbody></table></div>';
}
echo '<center>';
echo ' </center>';

}else{
echo '<div class="empty_block item_center"> Нет разделов </div>
<div class="line"></div>';
}
if($user['access'] >= '2'){//Создавать может админ и создатель
echo' <div class="block_link"><a class=mbtn mb2 href="/forum/add_sub/"><img src="/images/ico/png/chat_new.png" alt="*"> Создать раздел </a> </div>
<div class="line"></div>';
}

break;	





case 'sub':	
	$id = _string(_num($_GET['id']));
	$sub = mysql_fetch_array(mysql_query('SELECT * FROM `forum_sub` WHERE `id` = "'.$id.'" '));
$title = ''.$sub['name'].'';    
include './system/h.php';
echo '  <div class="ribbon mb2"> <div class="rl">  <div class="rr"> '.$title.'   </div> </div> </div> ';
   echo' '.$_SESSION['mes'].'  ';
    $_SESSION['mes']=NULL; //Удаляем сесию
 
$max = 10;
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `forum_topic` WHERE `sub` = "'.$id.'" '),0);
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));

if($page > $pages) $page = $pages;
if($page < 1) $page = 1;
$start = $page * $max - $max;



if(!$id) {//Переадресация если нет такого раздела
header('Location: /forum/');
exit;}

if($_GET['notified'] == true && $id == '1') { //Убираем уведомление с главной
mysql_query('UPDATE  `users` SET `notified` = "1" ');
header('Location: /forum/sub/1');
exit;}

if($count > 0) {
$q = mysql_query('SELECT * FROM `forum_topic` WHERE `sub` = "'.$id.'" ORDER BY `stick` DESC, `id` DESC LIMIT '.$start.', '.$max.'');
while($row = mysql_fetch_array($q)) {
echo '<div class="block_link">
<table> <tbody><tr>
<td><a class="mbtn mb2" href="/forum/topic/'.$row['id'].'/"><img src="/images/ico/png/forum.png" alt="*">  
'.($row['stick'] == 1 ? '<font color="#fff">'.$row['name'].'</font>':''.$row['name'].'').'</a></td>';



echo'</tr>
</tbody></table></div>
<div class="line"></div>';
}

/*

if($count > 0) {
$q = mysql_query('SELECT * FROM `forum_sub` WHERE `id` != "7" ORDER BY `id` ASC LIMIT '.$start.', '.$max.'');
while($row = mysql_fetch_array($q)) {
echo '<div class="block_link">
<table> <tbody><tr>
<td><a class = mbtn mb2 href="/forum/sub/'.$row['id'].'/">  
<img src="/images/ico/png/forum.png" alt="*"> '.$row['name'].' </a> </td>';
/*
if($user['access'] >= '2'){//Доступно для админа и создателя
echo' <td width="10%"><a href="/forum/edit_sub/'.$row['id'].'/">изменить</a></td>
<td width="10%"><a href="/forum/del_sub/'.$row['id'].'/">удалить</a></td>';
}


echo'</tr>
</tbody></table></div>';
}


if($count > 0) {
$q = mysql_query('SELECT * FROM `forum_topic` WHERE `sub` = "'.$id.'" ORDER BY `stick` DESC, `id` DESC LIMIT '.$start.', '.$max.'');
while($row = mysql_fetch_array($q)) {
echo '<div class="block_link">
<table> <tbody><tr>
<td><a href="/forum/topic/'.$row['id'].'/"><img src="/images/ico/png/forum.png" alt="*">  
'.($row['stick'] == 1 ? '<font color="#fff">'.$row['name'].'</font>':''.$row['name'].'').'</a></td>';
if($user['access'] >= '2'){//Доступно для админа и создателя
echo' <td width="10%"><a href="/forum/edit_topic/'.$row['id'].'/">изменить</a></td>
<td width="10%"><a href="/forum/del_topic/'.$row['id'].'/">удалить</a></td>';
}
echo'</tr>
</tbody></table></div>
<div class="line"></div>';
}
*/
echo '<center>';
  echo ''.pages('/forum/sub/'.$id.'/?').'
  <div class="line"></div>';
  echo '</center>';
  
  
}else{
}

if($user['access'] >= $sub['access']){ //Доступно для тех у кого достаточно прав
echo' 
'.($user['level'] >= '3' ? '<div class="block_link"><a class=mbtn mb2 href="/forum/add_topic/'.$id.'/"><img src="/images/ico/png/chat_new.png" alt="*"> Создать топик </a></div>':'<div class="empty_block"><img src="/images/ico/png/chat_new.png" alt="*"> Нужен 3-й уровень</div>').'
<div class="line"></div>';
}
echo'
<div class="block_link"><a class=mbtn m2 href="/forum/"><img src="/images/ico/png/back.png" alt="*"> Назад к форумам </a></div>
<div class="line"></div>';
break;	




case 'topic':	
	$id = _string(_num($_GET['id']));
	$topic = mysql_fetch_array(mysql_query('SELECT * FROM `forum_topic` WHERE `id` = "'.$id.'" '));
	$sub = mysql_fetch_array(mysql_query('SELECT * FROM `forum_sub` WHERE `id` = "'.$topic['sub'].'" '));
	$us = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$topic['user'].'" '));
$title = ''.$topic['name'].'';    
include './system/h.php';
echo   '<div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      '.$title.'
    </div>
   </div>
  </div>
<div class="line"></div>';

if(!$id) {
header('Location: /');
exit;}

   echo' '.$_SESSION['mes'].'  ';
   $_SESSION['mes']=NULL; //Удаляем сесию

if($user['access'] >= 2) {//Доступно для админа и создателя
  
  if($_GET['stick'] == true) {
mysql_query('UPDATE `forum_topic` SET `stick` = "'.($topic['stick'] == 0 ? 1:0).'" WHERE `id` = "'.$topic['id'].'"');
header('location: /forum/topic/'.$topic['id'].'/');
}
  
  if($_GET['close'] == true) {
mysql_query('UPDATE `forum_topic` SET `close` = "'.($topic['close'] == 0 ? 1:0).'" WHERE `id` = "'.$topic['id'].'"');
header('location: /forum/topic/'.$topic['id'].'/');
}

  if($_GET['delete'] == true) {
$q = mysql_query('SELECT * FROM `forum_comments` WHERE `topic` = "'.$topic['id'].'"');
while($row = mysql_fetch_array($q)) {
mysql_query('DELETE FROM `forum_comments` WHERE `id` = "'.$row['id'].'"');
}

header('location: /forum/sub/'.$topic['sub'].'/');
mysql_query('DELETE FROM `forum_topic` WHERE `id` = "'.$topic['id'].'"');
}



/*
echo'
<div class="empty_block">
<a href="/forum/topic/'.$topic['id'].'/?stick=true"> '.($topic['stick'] == 0 ? 'Закрепить':'Открепить').' </a> | 
<a href="/forum/topic/'.$topic['id'],'/?close=true"> '.($topic['close'] == 0 ? 'Закрыть':'Открыть').' </a> | 
<a href="/forum/topic/'.$topic['id'].'?delete=true">Удалить</a>
</div>
 <div class="line"></div>';


}

$q = mysql_query('SELECT * FROM `forum_topic` WHERE `id` = "'.$id.'" ORDER BY `id` DESC LIMIT 1');
while($row = mysql_fetch_array($q)) {
echo'<div class="empty_block">
<a href="/user/'.$us['id'].'/"> '.nick($us['id']).' </a>  <span style="float: right;"><small>'._times(time() - $row['time']).'</small></span> <br>
<font color="'.color($us['id']).'">
'.bbcode(smile($row['text'])).'
</font></div>
<div class="line"></div>';
}

*/
}

$q = mysql_query('SELECT * FROM `forum_topic` WHERE `id` = "'.$id.'" ORDER BY `id` DESC LIMIT 1');
while($row = mysql_fetch_array($q)) {
echo'  <div class="bdr bg_blue">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <span id="msg14639856"></span> 
           <div class="ml10 mt5 mb2 mr10 sh"> 
           <a href="/user/'.$us['id'].'/" class="tdn lwhite">'.nick($us['id']).' </a>
            <span class="grey1 small">'._times(time() - $row['time']).'</span> 
           </div> 
           <div class="ml10 mt2 mb5 mr10 sh"> 
            <span class="lblue ">
<font color="'.color($us['id']).'">'.bbcode(smile($row['text'])).'</font>             </div>
            </span> 
            <span style="display: inline"></span> 
           </div>
            <div class="alf">
             <div class="art">
              <div class="acn"></div>
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
           </div>';
           
  echo'<div class="empty_block"> 
  <a class=mbtn mb2 href="/forum/topic/'.$topic['id'].'/?stick=true"> '.($topic['stick'] == 0 ? 'Закрепить':'Открепить').' </a>
  <a class=mbtn mb2 href="/forum/topic/'.$topic['id'],'/?close=true"> '.($topic['close'] == 0 ? 'Закрыть':'Открыть').' </a>';
if($user['access'] >= '2'){//Доступно для админа и создателя
echo' <td width="15%"><a class=mbtn mb2 href="/forum/edit_topic/'.$row['id'].'/">изменить</a></td><td width="15%"><a class=mbtn mb2 href="/forum/del_topic/'.$row['id'].'/">удалить</a></td>';
}
           
}






$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `forum_comments` WHERE `topic` = "'.$topic['id'].'"'),0);

echo'  ';
 echo'  <div class="bdr bg_blue">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8">';

  if($topic['close'] == 0) {//Написать коментарий
$text = _string($_POST['text']);
$to = _string(_num($_GET['to']));

  if($to) {
$_to = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$to.'"');
$_to = mysql_fetch_array($_to);
  
  if(!$_to OR $_to['id'] == $user['id']) {
header('location: /forum/topic/'.$id.'/?page='.$page); 
exit;
  }
}

  if($_to) {
$text = str_replace($_to['login'].', ', '', $text);
}

  if($text) {
mysql_query('INSERT INTO `forum_comments` (`topic`,`user`,`to`,`text`,`time`) VALUES ("'.$topic['id'].'", "'.$user['id'].'", "'.$_to['id'].'", "'.$text.'", "'.time().'")');
header('location: /forum/topic/'.$topic['id'].'/?page='.$pages);
}
echo '<center>';
 echo'<form action="/forum/topic/'.$topic['id'].'/?page='.$page.'&to='.$to.'" method="post">
<textarea class="lbfld w100" name="text" rows="5">'.($to ? $_to['login'].', ':'').'</textarea><br/>
<input class="ibtn" type="submit" value="Отправить"/>
</div></div>
</div></div>
</div></div>
</div></div>
</div></div>
</div></div>
</form>';
echo '</div>';
}else{
}
echo '</div></div>
</div></div>
</div></div>
</div></div>
</div></div>
';
  
  
  if($count > 0) {//Вывод коментариев
$max = 10;
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));

 if($page > $pages) {$page = $pages;}
 if($page < 1) {$page = 1;}
$start = $page * $max - $max;

$q = mysql_query('SELECT * FROM `forum_comments` WHERE `topic` = "'.$topic['id'].'" ORDER BY `id` LIMIT '.$start.', '.$max.'');

  while($row = mysql_fetch_array($q)) {

  $comment_user = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'"');
  $comment_user = mysql_fetch_array($comment_user);



echo'
  <div class="bdr bg_blue">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 


<span style="display: inline"></span> 
           </div>
            <div class="alf">
             <div class="art">
              <div class="acn"></div>
             </div>
            </div>
           </div>
           <span id="msg14639857"></span> 
           <div class="ml10 mt5 mb2 mr10 sh"> 
            <a href="/user/'.$comment_user['id'].'/" class="tdn lwhite">'.nick($comment_user['id']).'</a> 
            <span class="lblue"><a class="lwhite" href="/forum/topic/'.$topic['id'].'/?page='.$page.'&to='.$comment_user['id'].'">(&#187;)</a></span> 
            <span class="grey1 small"> '._times(time() - $row['time']).'</span> 
           </div> 
           <div class="ml10 mt2 mb5 mr10 sh"> 
            <span class="lblue "><font color="'.color($comment_user['id']).'"> '.bbcode(smile($row['text'])).' </font><br><br>
</span>';

 echo '    <span style="display: inline"></span> 
           </div>
            <div class="alf">
             <div class="art">
              <div class="acn"></div>
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
           </div>';

  
  
  }
  
  echo '<center>';
	echo''.pages('/forum/topic/'.$topic['id'].'/?').''; 
	echo '</center>';


}

echo'<div class="line"></div>
<div class="block_link"><a class=mbtn mb2 href="/forum/sub/'.$sub['id'].'"><img src="/images/ico/png/back.png" alt="*"> Назад к топикам </a></div>
<div class="line"></div>';
break;	







case 'add_sub':
	$id = _string(_num($_GET['id']));
$title = 'Создать раздел';    
include './system/h.php';
echo '<div class="title">'.$title.'</div>';
 if($user['access'] < 2) {//Пепенаправляем  если не админ или не создатель
$_SESSION['mes'] = mes('У вас недостаточно прав!');
header('location: /forum/');
exit;}

$name = _string($_POST['name']);
$access = _string(_num($_POST['access']));
  if(isset($_REQUEST['submit'])  && $user['access'] >= 2){
          if(empty($name) or mb_strlen($name,'UTF-8') < 1){
header("Location: ?");
$_SESSION['mes'] = mes('Введите название!');
header('location: /forum/add_sub/');
exit;}    


mysql_query('INSERT INTO `forum_sub` (`name`, `access`) VALUES ("'.$name.'", "'.$access.'")');
$sub_id = mysql_insert_id();
$_SESSION['mes'] = mes('Раздел успешно добавлен!');
header('location: /forum/sub/'.$sub_id.'/');
exit;
  }
  
  echo' '.$_SESSION['mes'].'  ';
    $_SESSION['mes']=NULL; //Удаляем сесию
echo'<div class="empty_block item_center">
  <form action="/forum/add_sub/" method="post">
  Название раздела:<br/>
  <input name="name"/><br/>
  Создавать топики могут:<br/>
  <select name="access">
  <option value="0">Все</option>
  <option value="1">Модератор</option>
  <option value="2">Админи</option>
  <option value="3">Создатель</option>
  </select><br/>
  <input class="button" name="submit" type="submit" value="Сохранить"/>
  </form>
  </div>';
  
echo'<div class="line"></div>
<div class="block_link"><a href="/forum/"><img src="/images/ico/png/back.png" alt="*"> Назад в форум </a></div>
<div class="line"></div>';
break;	

case 'edit_sub':
 $id = _string(_num($_GET['id']));
 $sub = mysql_fetch_array(mysql_query('SELECT * FROM `forum_sub` WHERE `id` = "'.$id.'" '));
 
$title = 'Изменить раздел';    
include './system/h.php';
echo '<div class="title">'.$title.'</div>';
 if($user['access'] < 2) {//Пепенаправляем  если не админ или не создатель
$_SESSION['mes'] = mes('У вас недостаточно прав!');
header('location: /forum/');
exit;}

$name = _string($_POST['name']);
$access = _string(_num($_POST['access']));
  if(isset($_REQUEST['submit'])  && $user['access'] >= 2){
mysql_query('UPDATE `forum_sub` SET `name` = "'.$name.'", `access` = "'.$access.'" WHERE `id` = "'.$sub['id'].'"');
$_SESSION['mes'] = mes('Раздел успешно отредактирован!');
header('location: /forum/edit_sub/'.$sub['id'].'/');
exit;
}

  echo' '.$_SESSION['mes'].'  ';
    $_SESSION['mes']=NULL; //Удаляем сесию
echo'
  <div class="empty_block item_center">
  <form action="/forum/edit_sub/'.$sub['id'].'
  
  /" method="post">
  Название раздела:<br/>
  <input name="name" value="'.$sub['name'].'"/><br/>
    Создавать топики могут:<br/>
  <select name="access">
  <option value="0">Все</option>
  <option value="1">Модератор</option>
  <option value="2">Админи</option>
  <option value="3">Создатель</option>
  </select><br/>
  <input name="submit" class="button" type="submit" value="Сохранить"/>
  </form>
  </div>';
  echo'<div class="line"></div>
<div class="block_link"><a href="/forum/"><img src="/images/ico/png/back.png" alt="*"> Назад в форум </a></div>
<div class="line"></div>';
break;	


case 'del_sub':
 $id = _string(_num($_GET['id']));
 $sub = mysql_fetch_array(mysql_query('SELECT * FROM `forum_sub` WHERE `id` = "'.$id.'" '));
 
$title = 'Изменить раздел';    
include './system/h.php';
echo '<div class="title">'.$title.'</div>';


 if($user['access'] < 2) {//Пепенаправляем  если не админ или не создатель
$_SESSION['mes'] = mes('У вас недостаточно прав!');
header('location: /forum/');
exit;}




  if($_GET['delete'] == true) {
  
$q = mysql_query('SELECT * FROM `forum_topic` WHERE `sub` = "'.$sub['id'].'"');
while($row = mysql_fetch_array($q)) {
mysql_query('DELETE FROM `forum_comments` WHERE `topic` = "'.$row['id'].'"');
}
    
mysql_query('DELETE FROM `forum_topic` WHERE `sub` = "'.$sub['id'].'"');   
mysql_query('DELETE FROM `forum_sub` WHERE `id` = "'.$sub['id'].'"');
$_SESSION['mes'] = mes('Раздел удален!');
header('location: /forum/'); 
exit;
}


  
echo'
  <div class="empty_block item_center">
 
  Вы дейстаительно хотите удалить раздел: "'.$sub['name'].'"? <br/>
  <div class="link_center"><a href="/forum/del_sub/?delete=true&id='.$sub['id'].'/">Да</a></div>
  <div class="link_center_h"><a href="/forum/">Нет</a></div>
  </div>
  <div class="line"></div>';
break;	







case 'add_topic':
 $id = _string(_num($_GET['id']));
 $sub = mysql_fetch_array(mysql_query('SELECT * FROM `forum_sub` WHERE `id` = "'.$id.'" '));
  
   if($user['access'] < $sub['access']) {//Пепенаправляем, если должность меньше админа
$_SESSION['mes'] = mes('У вас недостаточно прав!');
header('location: /forum/sub/'.$sub['id'].'/');
exit;}
  
      $title = 'Создать топик';    
include './system/h.php';
echo '  <div class="ribbon mb2"> <div class="rl">  <div class="rr"> '.$title.'   </div> </div> </div> ';





$name = $_POST['name'];
$text = _string($_POST['text']);

  if(isset($_REQUEST['submit'])  && $user['level'] >= 3){
$antiflood = mysql_fetch_array(mysql_query('SELECT * FROM `forum_topic` WHERE `user` = \''.$user['id'].'\' ORDER BY `time` DESC LIMIT 1'));
 
    if(empty($name) or mb_strlen($name,'UTF-8') < 1 AND empty($text) or mb_strlen($text,'UTF-8') < 1){
header("Location: ?");
$_SESSION['mes'] = mes('Одно из полей не заполнено!');
header('location: /forum/add_topic/'.$sub['id'].'/');
exit;}    
      
   if(time() - $antiflood['time'] < 1){
header("Location: ?");
$_SESSION['mes'] = mes('Нельзя создавать топики так часто!');
exit;}     
      
	  if($sub['id'] == '1') { //Добавляем уведомление с главной
mysql_query('UPDATE  `users` SET `notified` = "0" ');
}
      mysql_query('INSERT INTO `forum_topic` (`sub`,
                                             `name`,
                                             `user`,
                                             `text`,
                                             `time`) VALUES ("'.$sub['id'].'",
                                                                  "'.$name.'",
                                                            "'.$user['id'].'",
                                                                  "'.$text.'",
                                                                 "'.time().'")');
  
$topic_id = mysql_insert_id();
$_SESSION['mes'] = mes('Топик успешно создан!');
header('location: /forum/topic/'.$topic_id.'/');
exit;
}
  
  
echo' '.$_SESSION['mes'].'  ';
    $_SESSION['mes']=NULL; //Удаляем сесию
 
echo'
<div class="bdr bg_blue">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="ml10 mt5 mb5 mr10 sh cntr"> 
  <form action="/forum/add_topic/'.$id.'/" method="post">

<span class="thread_name">Заголовок</span> 
             <div class="mb5"></div> 

  <input maxlength="30" class="lbfld h25 w100" name="name"/><br/>
  
  <div class="mb5"></div> 
             <span class="thread_name">Содержание</span> 
             <div class="mb5"></div> 
  <textarea name="text" class="lbfld w100" rows="5"></textarea><br/>
  <input class="ibtn" name="submit" type="submit" value="Создать"/>
  </form>
</div>
            </form> 
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
   <div>
    <div></div>
   </div>
  </div> ';

  echo'<div class="line"></div>
<div class="block_link"><a class=mbtn mb2 href="/forum/sub/'.$sub['id'].'"><img src="/images/ico/png/back.png" alt="*"> Назад к форумам </a></div>';




    
  
  
  
break;	



case 'edit_topic':
 $id = _string(_num($_GET['id']));

 $topic = mysql_fetch_array(mysql_query('SELECT * FROM `forum_topic` WHERE `id` = "'.$id.'" '));
  $sub = mysql_fetch_array(mysql_query('SELECT * FROM `forum_sub` WHERE `id` = "'.$topic['sub'].'" '));
      $title = 'Изменить топик';    
include './system/h.php';
echo '<div class="title">'.$title.'</div>';

 if($user['access'] < '2') {//Пепенаправляем, если должность меньше админа
$_SESSION['mes'] = mes('У вас недостаточно прав!');
header('location: /forum/sub/'.$sub['id'].'/');
exit;}


  
$name = _string($_POST['name']);
$text = _string($_POST['text']);

  if(isset($_REQUEST['submit'])  && $user['level'] >= 3){
      
    if(empty($name) or mb_strlen($name,'UTF-8') < 1 AND empty($text) or mb_strlen($text,'UTF-8') < 1){
header("Location: ?");
$_SESSION['mes'] = mes('Одно из полей не заполнено!');
header('location: /forum/add_topic/'.$sub['id'].'/');
exit;}    
       
      
mysql_query('UPDATE `forum_topic` SET `name` = "'.$name.'", `text` = "'.$text.'" WHERE `id` = "'.$topic['id'].'"');
$_SESSION['mes'] = mes('Топик успешно отредактирован!');
header('location: /forum/edit_topic/'.$topic['id'].'/');
exit;
}
  
  
    
echo' '.$_SESSION['mes'].'  ';
    $_SESSION['mes']=NULL; //Удаляем сесию
echo'
<div class="empty_block item_center">
  <form action="/forum/edit_topic/'.$topic['id'].'/" method="post">
  Название топика:<br/>
  <input name="name" value="'.$topic['name'].'"/><br/>
  
  Оглавление:<br/>
  <textarea name="text" style="width: 65%;"/>'.$topic['text'].'</textarea><br/>
  <input class="button" name="submit" type="submit" value="Изменить"/>
  </form>
</div>';
  echo'<div class="line"></div>
<div class="block_link"><a href="/forum/sub/'.$sub['id'].'"><img src="/images/ico/png/back.png" alt="*"> Назад к форумам </a></div>
<div class="line"></div>';
break;	


case 'del_topic':
 $id = _string(_num($_GET['id']));
 $topic = mysql_fetch_array(mysql_query('SELECT * FROM `forum_topic` WHERE `id` = "'.$id.'" '));
 $sub = mysql_fetch_array(mysql_query('SELECT * FROM `forum_sub` WHERE `id` = "'.$topic['sub'].'" '));
      $title = 'Изменить топик';    
include './system/h.php';
echo '<div class="title">'.$title.'</div>';

 if($user['access'] < '2') {//Пепенаправляем, если не админ и выше
$_SESSION['mes'] = mes('У вас недостаточно прав!');
header('location: /forum/sub/'.$sub['id'].'/');
exit;}



if($_GET['delete'] == true) {
$q = mysql_query('SELECT * FROM `forum_comments` WHERE `topic` = "'.$topic['id'].'"');
while($row = mysql_fetch_array($q)) {
mysql_query('DELETE FROM `forum_comments` WHERE `id` = "'.$row['id'].'"');
}

header('location: /forum/sub/'.$topic['sub'].'/');
mysql_query('DELETE FROM `forum_topic` WHERE `id` = "'.$topic['id'].'"');
$_SESSION['mes'] = mes('Топик удален!');
exit;
}
  
echo'
  <div class="empty_block item_center">
 
  Вы дейстаительно хотите удалить топик: "'.$topic['name'].'"? <br/>
  <div class="link_center"><a href="/forum/del_topic/?delete=true&id='.$topic['id'].'">Да</a></div>
  <div class="link_center_h"><a href="/forum/sub/'.$topic['sub'].'">Нет</a></div>
  </div>
  <div class="line"></div>';
break;	






}
include './system/f.php';
?>