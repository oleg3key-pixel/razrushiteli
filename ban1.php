<?

include './system/common.php'; 
include './system/functions.php';
include './system/user.php';
    
if(!$user) { 
header('location: /'); 
exit;}

$act = isset($_GET['act']) ? $_GET['act'] : null;
switch($act)
{
default: //Главнвя
$id = abs(intval($_GET['id']));
$ban = mysql_fetch_assoc(mysql_query("SELECT * FROM `ban` WHERE `user` = '".$id."'"));
if(isset($ban['user']))
{
  if($user['access'] < '1'){
     header("Location: /");
     $_SESSION['mes'] = mes('Произошла ошибка!');
     exit;   
}

}

 if(isset($_REQUEST['submit'])) { //Если нажимаем Да
$text = _string($_POST['text']);
$time = _string($_POST['time']);
    $users = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"');
    $users = mysql_fetch_array($users);
    
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `ban` WHERE `user` = "'.$users['id'].'"'),0);
  if($count == 0) {
      if(mb_strlen($text) < 4){
      header('Location: /ban1/'.$id.'');
     $_SESSION['mes'] = mes('Вы не ввели причину!');
     exit;  }
  if($users['access'] >= $user['access']){
      header('Location: /ban1/'.$id.'');
     $_SESSION['mes'] = mes('У вас недостаточно прав!');
     exit;  }
        
    mysql_query('INSERT INTO `ban` (`user`,
                                    `time`,
                                    `login`,
                                    `text`,
									`who`,
                                      `ip`) VALUES ("'.$users['id'].'",
                                                      "'.(time() + $time).'",
                                                      "'.$users['login'].'",
			                                               "'.$text.'",
											        "'.$user['id'].'",
                                                    "'.$users['ip'].'")');


   
$_SESSION['mes'] = mes('Персонаж забанен');	
header('location: /ban1/'.$id.'');
    

$top_ban_us.= '<font color=green><span class="login">Игрок <a class="tdn lwhite" href=/user/'.$users['id'].'>'.$users['login'].'</a> был забанен<br>Причина: <font color=red>'.$text.'</font></font>'; 
mysql_query("INSERT INTO `chat` SET `user`='2', `text`='".$top_ban_us."', `time`='".time()."'");


exit;
}else{
$_SESSION['mes'] = mes('Персонаж уже забанен');	
header('location: /ban1/'.$id.'');
exit;
}

}
$title='Забанить';
include './system/h.php';

     echo' '.$_SESSION['mes'].'  ';
    $_SESSION['mes']=NULL; //Удаляем сесию
echo '<div class="line"></div>
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
<form action="/ban1/'.$id.'" method="post">
Причина<br/>
<textarea name="text" style="width: 70%;"> '.($to ? $_to['login'].', ':'').' </textarea><br/>
<br>
Время<br/>
<select name="time"/>
<option value="600"> 10 минут </option> 
<option value="1800"> 30 минут </option> 
<option value="3600"> 1 час </option> 
<option value="7200"> 2 час </option> 
<option value="10800"> 3 час </option> 
<option value="14400"> 4 час </option> 
<option value="18000"> 5 час </option> 
<option value="21600"> 6 час </option> 
<option value="25200"> 7 час </option> 
<option value="28800"> 8 час </option> 
<option value="32400"> 9 час </option> 
<option value="36000"> 10 час </option> 
<option value="39600"> 11 час </option> 
<option value="43200"> 12 час </option> 
<option value="86400"> 1 день </option> 
<option value="259200"> 3 дня </option> 
<option value="604800"> 7 дней </option> 
<option value="2592000"> 1 месяц </option> 
<option value="15552000"> 6 месяцев </option> 
<option value="31104000"> 1 год </option> 

</select/> 
<br><br>
<span class="ubtn inbl green"><span class="ul"><input class="ur" type="submit" name="submit" value="Сохранить"></span></span>
</form>
<div class="line"></div>
</div></div></div></div></div></div></div></div>
</div></div></div></div></div></div></div></div>

<div class="block_link"><a class=mbtn mb2 href="/ban1/list/"><img src="/images/ico/png/black.png" alt="*"/> Все забаненные ('.mysql_result(mysql_query('SELECT COUNT(*) FROM `ban` WHERE `time` > "'.time().'"'),0).') </a></div>
<div class="line"></div>';
break;


case 'list':
$title='Все забаненные';
include './system/h.php';
echo '<div class="ribbon mb2">
   <div class="rl">
    <div class="rr">Список забаненных</div></div></div>';
    
echo' '.$_SESSION['mes'].'  ';
$_SESSION['mes']=NULL; //Удаляем сесию
    
$max = 10;
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `ban` WHERE `time` > "'.time().'"'),0);
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));

if($page > $pages) {$page = $pages;}
if($page < 1) {$page = 1;}
$start = $page * $max - $max;


if($count > 0) {
$id = _string(_num($_GET['id']));

  if($id) { 
  $ban = mysql_query('SELECT * FROM `ban` WHERE `id` = "'.$id.'"');
  $ban = mysql_fetch_array($ban);
  
  if(!$ban) {
$_SESSION['mes'] = mes('Игрок не забанен!');	
header('location: /ban1/list/?page='.$page);
exit;}
  

/*
  if($_GET['delete'] == true) {
$_SESSION['mes'] = mes('С игрока снята блокировка!');	
mysql_query('DELETE FROM `ban` WHERE `id` = "'.$id.'"');
header('location: /ban1/list/?page='.$page);
} 
  }

*/

}
$q = mysql_query('SELECT * FROM `ban` WHERE `time` > "'.time().'" ORDER BY `id` DESC LIMIT '.$start.', '.$max.'');
while($row = mysql_fetch_array($q)) {

  $u = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'"');
  $u = mysql_fetch_array($u);

echo'<div class="line"></div>
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
<span style="float: right;"></span>
<a href="/user/'.$u['id'].'/">'.nick($u['id']).'</a>
  <br/>
  Причина: '.$row['text'].' </br>
  Осталось: '._time($row['time'] - time()).'

<div class="line"></div>
</div></div></div></div></div></div></div></div>
</div></div></div></div></div></div></div></div>';
}

echo pages('/ban1/list/?');
echo'<div class="line"></div>';
 
}else{
echo' <div class="hr_g mb10"><div><div></div></div></div><div class="bntf"><div class="small"><div class="nl"><div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">Список пуст</div></div></div></div></div>';
}

break;


}
include './system/f.php';
?>