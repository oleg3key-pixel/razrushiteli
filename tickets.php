<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';
    
if(!$user) {
header('location: /');
exit;}


switch ($_GET['act'])
{
  default;
$title = 'Служба поддержки';
include './system/h.php';  
echo '  <div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Служба поддержки
    </div>
   </div>
  </div>';


	
$_title=_string($_POST['title']);
$_sms=_string($_POST['sms']);

  if(isset($_REQUEST['submit'])){

  if(empty($_title) or mb_strlen($_title,'UTF-8') < 1){
header("Location: ?");
$_SESSION['mes'] = mes('<div class="bntf"><div class="small"><div class="nl"><div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">Пустое название!<div><div></div></div></div>');
exit;}
  if(empty($_sms) or mb_strlen($_sms,'UTF-8') < 1){
header("Location: ?");
$_SESSION['mes'] = mes('<div class="bntf"><div class="small"><div class="nl"><div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">Пустое описание!<div><div></div></div></div>');
exit;}

mysql_query("INSERT INTO `ticket` SET `user`='".$user['id']."',`text`='$_sms',`title`='$_title',`status`='new', `user_read` = '1', `admin_read`= '0', `time`='".time()."' ")OR DIE(mysql_error());
$_SESSION['mes'] = mes('<div class="bntf"><div class="small"><div class="nl"><div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">Сообщение отправленно!<div><div></div></div></div>');
header('location: /tickets/');
exit;  
}

	

/*
  <div class="bdr bg_blue mb2 cntr">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="mt10 mlr10 mb5 ">
<Form action="?" method="post"/>
Название</br>
 <input name="title" style="width: 55%;"/><br/>
 Описание</br>
<textarea name="sms" style="width: 55%;"/></textarea><br>
<input class="ibtn w90px" name="submit" value="Отправить обращение" type="submit">
  <input class="button" name="submit" type="submit" value="Создать тиккет"/>
</form>
</div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div>
<div class="line"></div>
*/

     echo' '.$_SESSION['mes'].'  ';
    $_SESSION['mes']=NULL; //Удаляем сесию
echo'




<div class="hr_g mb2"><div><div></div></div></div>
<div class="bntf"><div class="small"><div class="nl"><div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">
		Напишите свой вопрос. Чем подробнее и понятнее вы напишете вопрос, тем быстрее и точнее получите ответ.	</div>
</div></div></div>
<div class="hr_g mb2"><div><div></div></div></div>

<form action="?" method="POST" class="mt10 mr5">
<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
<div class="ml10 mt5 mb5 mr10 sh cntr">
    <div class="pb5">
    Название вопроса
    <textarea class="lbfld h25 w100" name="title" value="" size="20" maxlength="265"  ></textarea><br/>
<br>
Описание вопроса
        <textarea rows="6" class="lbfld ha w96 mt5" name="sms"></textarea>
        <input type="hidden" name="category" value="cat_common">
        <input type="hidden" name="type_pay" value="">
        <input type="hidden" name="data_phone" value="">
    </div>
    <div class="mb5">
        <span class="ubtn inbl green pt"><span class="ul"><input class="ur" style="font-size: 16px; font-family: arial" name="submit" value="Написать" type="submit"></span></span>
    </div>
</div>
</div></div></div></div></div></div></div></div></div>
</form>






';
$question = mysql_num_rows( mysql_query('SELECT * FROM `ticket` WHERE `user` = "'.$user['id'].'" ') );
	  echo '<div class="hr_g mb2"><div><div></div></div></div><div class="block_link"><a class=mbtn mb2 href="/tickets/my_question">Мои обращения ('.$question.')</a></div>
	 <div class="line"></div>';
include './system/f.php';
break;


case 'my_question';

$title = 'Мои обращения';
include './system/h.php';  
echo '  <div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Мои обращения
    </div>
   </div>
  </div>';


$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `ticket` WHERE `user`="'.$user['id'].'" ORDER BY `id`'),0);
$max = 10;
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));

 if($page > $pages) {$page = $pages;}
 if($page < 1) {$page = 1;}
$start = $page * $max - $max;



$my_requests=mysql_query("SELECT  * FROM `ticket` WHERE `user`='".$user['id']."' ORDER BY `id` DESC LIMIT ".$start.", ".$max." ");

if(mysql_num_rows($my_requests)==0){
echo'
<div class="empty_block item_center">
Нет обращений! </div>
<div class="line"></div>';



}elseif(mysql_num_rows($my_requests)>0)
{

	while ($req=mysql_fetch_array($my_requests))
	{
$all_answer = mysql_fetch_array(mysql_query('SELECT * FROM `ticket_answer` WHERE `ticket` = "'.$req['id'].'" ORDER BY `time` DESC'));
if($all_answer['time']>'0'){
$time=vremja($all_answer['time']);
}else{
$time=vremja($req['time']);	
}
		switch ($req[status])
		{
case 'new';
$status="<font color='orange'>Ожидание</font>";
break;
case 'read';
$status="<font color='green'>Есть ответ</font>";
break;
case 'close';
$status="<font color='red'>Тема закрыта</font>";
break;
case 'user';
$status="<font color='yellow'>В ожидании</font>";
break;
}

			  
echo'<a class=mbtn mb2 href="/tickets/view/'.$req['id'].'">'.$req['title'].' ('.$status.') <span style="float: right;"><small>'.$time.'</small></span></a>';

	}


echo''.pages('/tickets/my_question/?').''; 
}

include './system/f.php'; 
break;


case 'admin_question';
$title = 'Служба поддержки';
include './system/h.php';  
echo '<div class="title">'.$title.'</div>';

if($user['access']<"2"){
header("Location:/");
exit;}



$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `ticket` ORDER BY `id`'),0);
$max = 10;
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));

 if($page > $pages) {$page = $pages;}
 if($page < 1) {$page = 1;}
$start = $page * $max - $max;



$all=mysql_query("SELECT  * FROM `ticket` ORDER BY `id` DESC LIMIT ".$start.", ".$max." ");




if(mysql_num_rows($all)==0){
echo'
<div class="empty_block item_center">
Нет обращений! </div>
<div class="line"></div>';


}elseif(mysql_num_rows($all)>0)
{

echo "<div class='menuList'>";
	while ($at=mysql_fetch_array($all))
	{

$all_answer = mysql_fetch_array(mysql_query('SELECT * FROM `ticket_answer` WHERE `ticket` = "'.$at['id'].'" ORDER BY `time` DESC'));
if($all_answer['time']>'0'){
$time=vremja($all_answer['time']);
}else{
$time=vremja($at['time']);	
}
switch ($at[status]){
case 'new';
$status="<font color='green'>Новый вопрос</font>";
break;
case 'read';
$status="<font color='yellow'>В ожидании</font>";
break;
case 'close';
$status="<font color='red'>Закрыт</font>";
break;
case 'user';
$status="<font color='green'>Ответил пользователь</font>";
break;
}

  
echo'<div class="block_link">
<a href="/tickets/admin_view/'.$at['id'].'"> '.$at['title'].' ('.$status.') <span style="float: right;"><small>'.$time.'</small></span></a></div>
<div class="line"></div>';
		






	}
echo''.pages('/tickets/admin_question/?').''; 
	echo "</div>";





}
echo'
<div class="block_link"><a href="/adm"><img src="/images/ico/png/back.png" width="18">Вернуться</a></div>
<div class="line"></div>';
include './system/f.php';
break;




case 'view';
$id=trim(htmlspecialchars($_GET['id']));
$tik=mysql_fetch_array(mysql_query("SELECT * FROM `ticket` WHERE `id`='$id'  and `user`='".mysql_real_escape_string($user['id'])."'"));

if($tik[user_read] == '0'){//Если игрок прочитал
mysql_query("UPDATE `ticket` SET `user_read`='1' WHERE `id`='".mysql_real_escape_string($tik['id'])."'");
}

$title = $tik['title'];
include './system/h.php';  
echo '<div class="title">'.$title.'</div>';
     echo' '.$_SESSION['mes'].'  ';
    $_SESSION['mes']=NULL; //Удаляем сесию


	if($tik){ 
		
if($_GET['close']=='true' && $user['id']==''.$tik['user'].''){//Закрыть
mysql_query("UPDATE `ticket` SET `status`='close' WHERE `id`='".mysql_real_escape_string($tik['id'])."'");
$_SESSION['mes'] = mes('Тиккет закрыт!');
header('location: /tickets/view/'.$id.'');
exit;  }




$sms=_string($_POST['sms']);	
  if(isset($_REQUEST['submit'])){

  if(empty($sms) or mb_strlen($sms,'UTF-8') < 1){
header("Location: ?");
$_SESSION['mes'] = mes('Пустое сообщение!');
exit;}
if($tik['status']=="close"){
header("Location: ?");
$_SESSION['mes'] = mes('Тиккет закрыт!');
exit;}	
				

mysql_query("INSERT INTO `ticket_answer` SET `text`='".mysql_real_escape_string($sms)."',`user`='".$user['id']."',`ticket`='".mysql_real_escape_string($tik['id'])."', `time` = '".time()."' ");
mysql_query("UPDATE `ticket` SET `status`='user', `admin_read`='0' WHERE `id`='".mysql_real_escape_string($tik['id'])."'");

header("Location: ?");
$_SESSION['mes'] = mes('Сообщение добавлено!');
exit;
}




echo'<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
<div class="ml10 mt5 mb5 mr10 sh ">
    <div class="pb5">
<a href="/user/'.$tik['user'].'/"> '.nick($tik['user']).' </a>';
echo'<span style="float: right;"><small>'.vremja($tik['time']).'</small></span>
<br/>';
echo'<font color="'.color($tik[user]).'">
'.bbcode(smile($tik['text'])).'
</font>
</div></div></div></div></div></div></div></div></div></div></div></div>';




	if($tik['status']=="close"){

echo'<div class="empty_block item_center">
Тикет закрыт!
</div>';

}else{
echo'<div class="empty_block item_center">
			<Form  action="/tickets/view/'.$tik['id'].'" method="post"/>
			Сообщение:</br>
			<textarea name="sms" style="width: 70%;"/></textarea><br>
  			<input name="submit" class="button" type="submit" value="Отправить"/>
			</form></div>';


}

			
echo'<div class="line"></div>';

	
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `ticket_answer` WHERE `ticket` = "'.$tik['id'].'"'),0);
$max = 10;
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));

 if($page > $pages) {$page = $pages;}
 if($page < 1) {$page = 1;}
$start = $page * $max - $max;



$answer=mysql_query("SELECT  * FROM `ticket_answer` WHERE `ticket`='".$tik['id']."' ORDER BY `time` DESC LIMIT ".$start.", ".$max." ");

	if(mysql_num_rows($answer)==0){	
echo'<div class="empty_block item_center">
Сообщений не найдено
</div>
<div class="line"></div>';

	
	}elseif(mysql_num_rows($answer)>0)
	{

			while ($feed=mysql_fetch_array($answer))
			{
			  
echo'<div class="empty_block">
<a href="/user/'.$feed['user'].'/"> '.nick($feed['user']).' </a>';
echo'<span style="float: right;"><small>'.vremja($feed['time']).'</small></span>
<br/>';
echo'<font color="'.color($feed[user]).'">
'.bbcode(smile($feed['text'])).'
</font>
</div>
<div class="line"></div>';	

}
echo''.pages('/tickets/view/'.$tik['id'].'/?').''; 
	}

}elseif(!$tik){
header("Location:/tickets");
exit;}



include './system/f.php';
break;




case 'admin_view';
$id=trim(htmlspecialchars($_GET['id']));
$tik=mysql_fetch_array(mysql_query("SELECT * FROM `ticket` WHERE `id`='$id' "));	

if($tik[admin_read] == '0'){//Если администрация прочитала
mysql_query("UPDATE `ticket` SET `admin_read`='1' WHERE `id`='".mysql_real_escape_string($tik['id'])."'");
}

$title = $tik['title'];
include './system/h.php';  
echo '

<div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      '.$title.'
    </div>
   </div>
  </div> ';
     echo' '.$_SESSION['mes'].'  ';
    $_SESSION['mes']=NULL; //Удаляем сесию


	if($tik){ 
		
if($_GET['close']=="true"){//Закрыть/Открыть
	if($tik['status']!="close"){
mysql_query("UPDATE `ticket` SET `status`='close' WHERE `id`='".mysql_real_escape_string($tik['id'])."'");
$_SESSION['mes'] = mes('Тиккет закрыт!');
}else{
mysql_query("UPDATE `ticket` SET `status`='read' WHERE `id`='".mysql_real_escape_string($tik['id'])."'");	
$_SESSION['mes'] = mes('Тиккет открыт!');
}
header('location: /tickets/admin_view/'.$id.'');
exit;  }

	if($_GET['delete']=="true" && $user['access']>="2"){//Удалить
mysql_query("DELETE FROM `ticket` WHERE `id` = '".$tik['id']."'");
$_SESSION['mes'] = mes('Тиккет удален!');
header('location: /tickets/admin_question/');
exit;  
}

$sms=_string($_POST['sms']);	
  if(isset($_REQUEST['submit'])){

  if(empty($sms) or mb_strlen($sms,'UTF-8') < 1){
header("Location: ?");
$_SESSION['mes'] = mes('Пустое сообщение!');
exit;}
if($tik['status']=="close"){
header("Location: ?");
$_SESSION['mes'] = mes('Тиккет закрыт!');
exit;}	
				

mysql_query("INSERT INTO `ticket_answer` SET `text`='".mysql_real_escape_string($sms)."',`user`='".$user['id']."',`ticket`='".mysql_real_escape_string($tik['id'])."', `time` = '".time()."' ");
mysql_query("UPDATE `ticket` SET `status`='read', `user_read`='0' WHERE `id`='".mysql_real_escape_string($tik['id'])."'");

header("Location: ?");
$_SESSION['mes'] = mes('Сообщение добавлено!');
exit;
}



echo'';

echo'<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
<div class="ml10 mt5 mb5 mr10 sh">
    <div class="pb5">
    <span style="float: right;"><small>'.vremja($tik['time']).'</small></span>
<a href="/user/'.$tik['user'].'/"> '.nick($tik['user']).' </a><br>
<br><br>'.($tik['status'] != close ? ' <div class="cntr p_relative"><a href="/tickets/admin_view/'.$tik['id'].'?close=true" class="ubtn inbl mt-15 mb2 red"><span class="ul"><span class="ur">Закрыть обращение</span></span></a></div> ':' <div class="cntr p_relative"><a href="/tickets/admin_view/'.$tik['id'].'?close=true" class="ubtn inbl mt-15 mb2 green"><span class="ul"><span class="ur">Открыть обращение</span></span></a></div>').'<br>';
  if($user['access'] > 0) {//Удаляем сообщение
echo'<div class="cntr p_relative"><a href="/tickets/admin_view/'.$tik['id'].'?delete=true" class="ubtn inbl mt-15 mb2 red"><span class="ul"><span class="ur">Удалить обращение</span></span></a></div><br>

';}

echo'<font color="'.color($tik[user]).'">
'.bbcode(smile($tik['text'])).'
</font></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div>';




	if($tik['status']=="close"){

echo'<div class="bntf"><div class="nl"><div class="nr cntr lyell lh1 p5 sh"><div class="bntf"><div class="nl"><div class="nr cntr lyell lh1 sh"><div class="mb5 lyell">
Тикет закрыт!
</div></div></div></div></div></div></div></div></div></div></div></div></div></div>';

}else{
echo'<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
<div class="ml10 mt5 mb5 mr10 sh cntr">
    <div class="pb5">
			<Form  action="/tickets/admin_view/'.$tik['id'].'" method="post"/>
			Сообщение:</br>
			<textarea name="sms" style="width: 70%;"/></textarea><br>
<br><input class="fl ml5 ibtn plr10 mt10 mb5" name="submit"  type="submit" value="Отправить"><br><br>
 
  			
			</form></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div>';


}

$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `ticket_answer` WHERE `ticket` = "'.$tik['id'].'"'),0);
$max = 10;
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));

 if($page > $pages) {$page = $pages;}
 if($page < 1) {$page = 1;}
$start = $page * $max - $max;



$answer=mysql_query("SELECT  * FROM `ticket_answer` WHERE `ticket`='".$tik['id']."' ORDER BY `time` DESC LIMIT ".$start.", ".$max." ");



	if(mysql_num_rows($answer)==0){	
echo'<div class="bntf"><div class="nl"><div class="nr cntr lyell lh1 p5 sh"><div class="bntf"><div class="nl"><div class="nr cntr lyell lh1 sh"><div class="mb5 lyell">
Сообщений не найдено
</div></div></div></div></div></div></div></div></div></div></div></div>';

	
	}elseif(mysql_num_rows($answer)>0){
while ($feed=mysql_fetch_array($answer)){

$comment = _string(_num($_GET['comment']));
  if($comment) {
mysql_query('DELETE FROM `ticket_answer` WHERE `id` = "'.$comment.'"');
header('location: /tickets/admin_view/'.$tik['id'].'/?page='.$page);
$_SESSION['mes'] = mes('Сообщение удалено!');
exit;}


echo'<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
<div class="ml10 mt5 mb5 mr10 sh ">
    <div class="pb5">
<a href="/user/'.$feed['user'].'/"> '.nick($feed['user']).' </a>';
echo' <a href="/tickets/admin_view/'.$tik['id'].'/?page='.$page.'&comment='.$feed['id'].'">[x]</a>';
echo'<span style="float: right;"><small>'.vremja($feed['time']).'</small></span>
<br/>';
echo'<font color="'.color($feed[user]).'">
'.bbcode(smile($feed['text'])).'
</font></div></div></div></div></div></div></div></div></div></div></div></div>';	

}
echo'<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
<div class="ml10 mt5 mb5 mr10 sh cntr">
    <div class="pb5">';
    
echo'    '.pages('/tickets/admin_view/'.$tik['id'].'/?').'';
    
echo'    </div></div></div></div></div></div></div></div></div></div></div></div>'; 

	}

}elseif(!$tik){
header("Location:/tickets");
exit;}



include './system/f.php';
break;



}



?>