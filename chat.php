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

$title = 'Общий чат';
include './system/h.php';  
echo ' <div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Чат
    </div>
   </div>
  </div> ';


  if($user['level'] < 35 AND $user['access'] == 0) {
echo '<div class="empty_block item_center"> Писать в чат можно с <img src="/view/image/icons/png/up.png" alt="*"> 35 уровня</div>
<div class="line"></div>';
}else{

$text = _string($_POST['text']);
  $to = _string(_num($_GET['to']));

  if($to) {
$_to = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$to.'"');
$_to = mysql_fetch_array($_to);
  
  if(!$_to OR $_to['id'] == $user['id']) {
header('location: /chat/'.($_GET['clan'] == true ? 'clan/':''));
exit;}
  }
  
  
  
  
  if(isset($_REQUEST['text'])){
$antiflood = mysql_fetch_array(mysql_query('SELECT * FROM `chat` WHERE `user` = \''.$user['id'].'\' ORDER BY `time` DESC LIMIT 1'));
  
  if(empty($text) or mb_strlen($text,'UTF-8') < 1){
header("Location: ?");
$_SESSION['mes'] = mes('Пустое сообщение!');
exit;}
  if(time() - $antiflood['time'] < 0){
header("Location: ?");
$_SESSION['mes'] = mes('Писать можно раз в 10 секунд!');
exit;}
    
     if($_to) {
$text = str_replace($_to['login'].', ', '', $text);
}
      
$text = eregi_replace( "[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]", "<font color=red>*</font>", $text);
$arrReplace = array(
'соси','Соси',
' хуй',' Хуй',' нахуй',' Нахуй',
'сосёт','Сосёт',
'блядь','Блядь','блять','Блять',
'сука','Сука',
'пидар','Пидар',
'кидок','Кидок',
'кидало','Кидало',
'наёб','Наёб',
'чмошник','Чмошник',
'тварь','Тварь',
'ублюдок','Ублюдок',
'отсосёт','Отсосёт',
'отсосет','Отсосет',
'сосет','Сосет',
'сучки','Сучки',
'сучка','Сучка',
'наебалово','Наебалово',
'пизда','Пизда',
'пиздец','Пиздец',
'пиздуй','Пиздуй',
'ебись','Ебись',
'вьебись','Вьебись',
'долбоёб','Долбоёб',
'долбоёбы','Долбоёбы',
'суки','Сукм',
'долбоеб','Долбоеб',
'пиздабол','Пиздабол',
'гомосек','Гомосек',
'СЕРЁЖА',
'СЕРГЕЙ',
'СЕРЁГА',
'СЕРГО',
'lmrush.ru',
'.ru','.Ru','.Ru','.RU','.r u','.R u','.r U','.R U',
'.com','.Com','.COm','.COM','.CoM','.cOM','.cOm','.c o m','.C O M',
'.ml','.Ml','.mL','.ML','.m l','.M l','.m L','.M L',
'.tk','.Tk','.tK','.TK','.t k','.T k','.t K','.T K',
'.ga','.Ga','.gA','.GA','.g a','.G a','.g A','.G A',
'.mobi',
'.pw',
'.game',
'Серёжа создатель ебаный гомосек-а вы его сучки, долбитесь с ним пидарасы!!! Вам пизда понял Серёжа',
'Сереженька сосет, пидр ебанный');

$size = count($arrReplace);
  while($size--){//Сообщаем админу о срабатывании анти спама
if(substr_count($text, $arrReplace[$size])){
mysql_query("INSERT INTO `mail` SET `from`='2',`to`='1',`text`=' Пользователь ".$user['login']." | ID: ".$user['id']." нарушает правила игры! Сообщение: ".$text."',`time`='".time()."'");
mysql_query('INSERT INTO `block` (`user`, `time`, `login`, `text`, `who`, `ip`) SELECT "'.$user['id'].'", "1615598655", "'.$user['login'].'", "Нарушение правил игры!",  "2", "'.$user['ip'].'"');
$top_block_us.= '<font color=darkgrey><span class="login">Игрок <a class="tdn lwhite" href=/user/'.$user['id'].'>'.$user['login'].'</a> был заблокирован<br>Причина: <font color=red> Нарушение правил игры! </font></font>'; 
mysql_query("INSERT INTO `chat` SET `user`='1', `text`='".$top_block_us."', `time`='".time()."'");

break;
 }
}

$text = str_replace($arrReplace, '*', $text);
$typemsg=_string($_POST['typemsg']);
      if($user['access']>='2' && $typemsg=='sys'){//Если сообщение от системы
  
  mysql_query('INSERT INTO `chat` (`user`, `to`, `text`, `time`) VALUES ("2",  "'.$_to['id'].'", "'.$text.'", "'.time().'")');


}else{//Если от простого пользователя
mysql_query('INSERT INTO `chat` (`user`,`to`,`text`,`time`)
														VALUES ("'.$user['id'].'",  "'.$_to['id'].'", "'.$text.'", "'.time().'")');
}
      
header('location: /chat/'.($_GET['clan'] == true ? 'clan/':''));
$_SESSION['mes'] = mes('Сообщение отправленно!');
exit;  
}


  
  
     echo' '.$_SESSION['mes'].'  ';
    $_SESSION['mes']=NULL; //Удаляем сесию
    
  $ban = mysql_query('SELECT * FROM `ban` WHERE `user` = "'.$user['id'].'"');
  $ban = mysql_fetch_array($ban);
  

     if(!$ban){
      
        echo '  <div class="bdr bg_main mb2"> <div class="light">
    <div class="wr1">
     <div class="wr2">
      <div class="wr3">
       <div class="wr4">
        <div class="wr5">
         <div class="wr6">
          <div class="wr7">
           <div class="wr8"> 
              <form action="/chat/?to='.$to.'" method="post">
             <div class="mt5 mlr10 lwhite"> 
              <div class="mr10"> 
              <textarea                class="lbfld h25 w100" name="text"                value="" size="20" maxlength="265"  >'.($to ? $_to['login'].', ':'').'</textarea><br/>

              </div> 
              <div class="mt5 mr5 fr">
               <a class="nd" href="/smile"> <img class="icon" height="30" src="/view/image/icons/big_smile.png" alt=":)"> </a>
              </div> 
              <div class="mt5 mr10 fl">
              <input class="ibtn w90px" name="send_message" value="Отправить" type="submit">



              </div> 
              <div class="mt10 small">
               <a class="tdn lwhite" href="/chat?page=1">Обновить</a>
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
             </div> 
             ';  
             
             


}else{
echo'		
<div class="empty_block item_center">
<font color=khaki><b>На вас наложен бан!</font></b><br/>
Причина: '.$ban['text'].'</br>
Осталось: '._time($ban['time'] - time()).'</br>
Кто: '.nick($ban['who']).'</br>
</div><div class="line"></div>';  
}

}

?>

  

<?

$max = 15;
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `chat` '),0);
if($count >= 10000){ $count=10000;}
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));

if($page > $pages) {$page = $pages;}
if($page < 1) {$page = 1;}
$start = $page * $max - $max;

if($count > 0) {
$q = mysql_query('SELECT * FROM `chat` ORDER BY `id` DESC LIMIT '.$start.', '.$max.'');
  while($row = mysql_fetch_array($q)) {

  if($row['to'] == $user['id'] && $row['read'] == 0) {
mysql_query('UPDATE `chat` SET `read` = "1" WHERE `id` = "'.$row['id'].'"');  
}

  $sender = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'"');
  $sender = mysql_fetch_array($sender);
	  echo'<div class="mlr10 lwhite" id="box_forum_chat">  <div class="mb5">
';


echo'<a class="tdn lwhite" href="/user/'.$sender['id'].'/">'.nick($sender['id']).'</a>';//Логин отправителя

  if($sender['id'] != $user['id']) {//Ответить на сообщение
echo'<a class="tdn lwhite" href="/chat/?to='.$sender['id'].'">              <span class="lblue">(»)</span> </a>';
}
  if($user['access'] > 0) {//Удаляем сообщение
echo'<span style="float: right;">';
echo'<a class="tdn lwhite" href="/ban1/'.$sender['id'].'/"><img src=/view/image/icons/rules.png class=icon width=18></a> ';
echo'<a class="tdn lwhite" href="/ban2/'.$sender['id'].'/"><img src=/view/image/icons/black.png class=icon width=18></a> ';
echo'<a class="tdn lwhite" href="/chat/delmsg/'.$row['id'].'/"><img src=/view/image/icons/delete_forum.png class=icon width=18></a> ';}
echo'</small></span>';
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
echo''.$__to['login'].',</font>';
 
}




echo '
'.bbcode(smile($row['text'])).'';//Сообщение

    

echo'</font>';//Закрываем цвет сообщений



  echo'</div></div>
<div class="line"></div>';
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
      <a class="tdn lwhite" href="/rules2">правил чата</a> можно 
      <a class="tdn lwhite" href="/admins.php">Модераторам</a> 
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
break;


case 'delmsg':
$id = abs(intval($_GET['id']));
$top_ban_us.= '<font color=red><span class="login">Сообщение удалено  <a class="tdn lwhite" href=/user/1>модератором</a></font>'; 
$top_ban_user.= '1'; 
$gg = mysql_fetch_assoc(mysql_query("SELECT * FROM `chat` WHERE `id` = '".$id."'"));
if(isset($gg['id']))
{
  if($user['access'] < 1){
     header("Location: /chat");
     $_SESSION['mes'] = mes('Произошла ошибка!');
     exit;   
}
}else{
      header("Location: /chat");
     $_SESSION['mes'] = mes('Произошла ошибка!');
     exit;   
}

 if(isset($_REQUEST['submit'])) { //Если нажимаем Да
      header('Location: '.$HOME.'/chat');
mysql_query("UPDATE chat SET text = '".$gg[id]."' , text = '".$top_ban_us."' WHERE `id` = '".$gg[id]."'");
mysql_query("UPDATE chat SET user = '".nick($gg['user'])."' , user = '2' WHERE `id` = '".$gg[id]."'");
    

     $_SESSION['mes'] = mes('Сообщение удалено!');

     exit;   
}
include './system/h.php';







     echo '<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8"><div class="ml10 mt5 mb2 mr10 sh">
           Ник: '.nick($gg['user']).' <br/><br/> Время: '.vremja($gg['time']).' <br/><br/> Текст: '.bb(smile($gg['text'])).'</div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div>';
     echo '<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8"><div class="ml10 mt5 mb2 mr10 sh">

<form action="" name="message" method="POST"> 

<center><input class="ibtn w90px" type="submit" name="submit" value="Удалить!"></center>


</form></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div>';
	  echo '<a class=mbtn mb2 href="/chat"><img src="/view/image/icons/png/back.png" width="18">Вернуться</a>';


break;





}
include './system/f.php';

?>