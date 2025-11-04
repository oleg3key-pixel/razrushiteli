<?   
include './system/common.php';
include './system/functions.php';
include './system/user.php';
    
if(!$user) {
header('location: /');
exit;}

$id = _string(_num($_GET['id']));

if($id) {

$ho = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = \''.$id.'\''));

  if(!$ho OR $id == $user['id']) {
header('location: /mail/');   
exit;}
if(isset($_GET['gift'])){//Если отправляем подарок
}else{
}
include './system/h.php';


$_s = 1;
$text = _string($_POST['text']);  
  if(isset($_REQUEST['text'])) {
	  $antiflood = mysql_fetch_array(mysql_query('SELECT * FROM `mail` WHERE `from` = \''.$user['id'].'\' ORDER BY `time` DESC LIMIT 1'));
  if(!isset($_GET['gift'])){
  if(empty($text) or mb_strlen($text,'UTF-8') < 1){
header('Location: /mail/'.$ho['id'].'');
$_SESSION['mes'] = mes('Пустое сообщение!');
exit;}

  if($user['level'] < 25 AND $user['access'] == 0) {  echo '<div class="empty_block item_center"> Писать в почту можно с <img src="/images/ico/png/up.png" alt="*"> 25 уровня</div><div class="line"></div>';
      }else{
}

  if(time() - $antiflood['time'] < 10){
header('Location: /mail/'.$ho['r'].'');
$_SESSION['mes'] = mes('Нельзя писать так часто!');
exit;}
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
'Сереженька сосет, пидр ебанный',
'Серёжа хуесос сосет за 10 рублей а вы лохи и игра ваша закроется!!!!');

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


if(isset($_GET['gift'])){//Если отправляем подарок
$gifts=abs(intval($_GET['gift']));
$privacy = abs(intval($_POST['privacy']));  
$gift = mysql_fetch_array(mysql_query('SELECT * FROM `gifts` WHERE `id` = "'.$gifts.'"'));
$text_msg='<center>[img=60]/images/gift/'.$gift['img'].'.png[/img]</center> '.$text.' ';
mysql_query('INSERT INTO `mail` (`from`, `to`, `text`,`time`) VALUES ("'.$user['id'].'", "'.$ho['id'].'", "'.$text_msg.'", "'.time().'")');	

  mysql_query('UPDATE `users` SET `g` = `g` - "10" WHERE `id` = "'.$user['id'].'" ');
  mysql_query("INSERT INTO `gifts_user` SET `user` = '".$user['id']."', `komy` = '".$ho['id']."', `time` = '".time()."', `img` = '".$gift['img']."', `text` = '".$text."', `privacy` = '".$privacy."' ");
}else{//Простое сообщение

mysql_query('UPDATE `users` SET `s` = `s` - '.$_s.' WHERE `id` = "'.$user['id'].'" ');
mysql_query('INSERT INTO `mail` (`from`, `to`, `text`,`time`) VALUES ("'.$user['id'].'", "'.$ho['id'].'", "'.$text.'", "'.time().'")');
}
   if(mysql_result(mysql_query('SELECT COUNT(*) FROM `contacts` WHERE `ho` = "'.$user['id'].'" AND `user` = "'.$ho['id'].'"'),0) == 0) {//Проверяем есть ли контакт
 if(mysql_result(mysql_query('SELECT * FROM `contacts` WHERE `ho` = "'.$user['id'].'" AND `user` = "'.$ho['id'].'" '),0) == 0) {
mysql_query('INSERT INTO `contacts` (`ho`, `user`, `time`) VALUES ("'.$user['id'].'", "'.$ho['id'].'", "'.time().'")');
 }
}
  if(mysql_result(mysql_query('SELECT COUNT(*) FROM `contacts` WHERE `user` = \''.$user['id'].'\' AND `ho` = \''.$ho['id'].'\''),0) == 0) {//Проверяем есть ли контакт
  if(mysql_result(mysql_query('SELECT * FROM `contacts` WHERE `ho` = "'.$ho['id'].'" AND `user` = "'.$user['id'].'" '),0) == 0) {
mysql_query('INSERT INTO `contacts` (`user`, `ho`, `time`) VALUES ("'.$user['id'].'", "'.$ho['id'].'", "'.time().'")');
  }
}

                                                 
mysql_query('UPDATE `contacts` SET `time` = \''.time().'\' WHERE `user` = \''.$user['id'].'\' AND `ho` = \''.$ho['id'].'\'');   
mysql_query('UPDATE `contacts` SET `time` = \''.time().'\' WHERE `ho` = \''.$user['id'].'\' AND `user` = \''.$ho['id'].'\'');
     
header('location: /mail/'.$ho['id'].'/'); 
if(isset($_GET['gift'])){
}else{
}
exit;   
  }



     echo' '.$_SESSION['mes'].'  ';
    $_SESSION['mes']=NULL; //Удаляем сесию
	
	 if(isset($_GET['gift'])){//Если отправляем подарок
 $gifts=abs(intval($_GET['gift']));
 $gift = mysql_fetch_array(mysql_query('SELECT * FROM `gifts` WHERE `id` = "'.$gifts.'"'));


if(time() - $antiflood['time'] < 90){
header('Location: /mail/'.$ho['r'].'');
$_SESSION['mes'] = mes('Нельзя отправлять подарки так часто!');
exit;}
  
 
 
  if($user['level'] < 205)
echo '  <div class="bdr bg_blue">
    <div class="wr1">
     <div class="wr2">
      <div class="wr3">
       <div class="wr4">
        <div class="wr5">
         <div class="wr6">
          <div class="wr7">
           <div class="wr8"> 
            <div class="ml10 mt5 mb5 mr10 sh cntr"> 
 <form action="/mail/'.$ho['id'].'?gift='.$gifts.'" method="post">
<img src="/images/gift/'.$gift['img'].'.png" alt="*"/>
              <br>
              <div class="small">
               цена  '.$gift['g'].' золота

              </div>(Сообщение, не обязательно)
              <input type="hidden" name="gift_id" value="4">
              <br> 
                  <textarea               id="sml" rows="5" class="lbfld ha w96 mt5"  name="text" ></textarea><br/>
              <input type="hidden" name="page" value="1"> 
              </from>
    <input     class="fl ml5 ibtn plr10 mt10 mb5"     name="send_message" value="Отправить" type="submit">
              <div class="fr mt10 ml10 mr5">
              </div>                     </div>
                    </div>
                    </div>
                    </div>
                    </div>

              <div class="clb mb5"></div></div></div></div></div></div></div></div></div>';
              
 {}

   
	 }else{//Простое сообщение
if($ho['id']!='2'){


echo '  <div id="post_msg_block_gifts_no"> 
   <div class="ribbon mb2">
    <div class="rl">
     <div class="rr">
       Почта для '.$ho['login'].'
     </div>
    </div>
   </div>';
   ?>
   <script type="text/javascript">
   
	function sml(id, html) {
		var e = document.getElementById(id);
		if (e != null) {
			e.value += ' ' + html + ' ';
			e.focus();
		}
	}
	function smiles() {
		var e = document.getElementById('smiles');
		if (e != null) {
			if (e.style.display == 'block') e.style.display = 'none';
			else e.style.display = 'block';
		}
	}

</script> 
<?

if($ho['mailclosed']==1) {
echo '<div class="bntf">  <div class="small">  <div class="nl">     <div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">Пользователь '.$ho[login].' закрыл свою почту!   </div>   </div>  </div> </div> ';
}
if($user[level]<1) {
echo '<div class="bntf">  <div class="small">  <div class="nl">     <div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">Писать в почту можно с 30 уровня  </div>   </div>  </div> </div> ';
}

if($user['maill']==1) {
echo "<center><font color='lime'>Вы забанены в почте</font></center>";
}
  if($ho['r'] != $user['r']) $_s = 100; else $_s = 1;


  $text = _string($_POST['text']);

  if($text) {

    $antiflood = mysql_fetch_array(mysql_query('SELECT * FROM `mail` WHERE `from` = \''.$user['id'].'\' ORDER BY `time` DESC LIMIT 1'));
  
    if(time() - $antiflood['time'] < 5) $errors[] = 'Писать можно 1 раз в 5 секунд';

}}
if($_GET[the]==act) {
mysql_query("INSERT INTO `blacklist` (`user`,`user2`)VALUES('$user[id]','$ho[id]')");

$_SESSION['chok'] = '<center> <font color="green"><img src="/images/icon/ok.png"> ('.$ho[login].')
добавлен в ваш чёрный список </center>';

header('location:?');
}
if($_GET[the]==act3) {
mysql_query("INSERT INTO `friends` (`user`,`user2`)VALUES('$user[id]','$ho[id]')");

$_SESSION['chok2'] = '<center> <font color="lime"><img src="/images/icon/ok.png"> ('.$ho[login].')
добавлен в список друзей </center>';

header('location:?');
}

if($_GET[the]==act2) {
mysql_query("DELETE FROM `blacklist` WHERE `user2` = ".$ho[id]."");

$_SESSION['choke'] = '<center> <font color="green"><img src="/images/icon/ok.png"> ('.$ho[login].')
Удален с вашего чёрного списка</center>';

header('location:?');
}


if($_GET[the]==act4) {
mysql_query("DELETE FROM `friends` WHERE `user2` = ".$ho[id]."");

$_SESSION['choke2'] = '<center> <font color="lime"><img src="/images/icon/ok.png"> ('.$ho[login].')
Удален с списка друзей</center>';

header('location:?');
}
if($ho['id'] != 2){ 
if($user['id'] !=9930) {
if($ho['mailclosed'] !=1) {
if($user['maill']==0) {
if($user[level]>1) {






if(mysql_result(mysql_query('SELECT COUNT(*) FROM `blacklist` WHERE `user2` = \''.$user['id'].'\' AND `user` = \''.$ho['id'].'\''),0) != 0){
echo '<div class="bntf">  <div class="small">  <div class="nl">     <div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">Пользователь '.$ho[login].' добавил вас черный список!   </div>   </div>  </div> </div> ';
    
    
}else{


echo '
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
                                   <form action="/mail/'.$ho['id'].'/" method="post">






    <textarea id="sml"  rows="5" class="lbfld ha w96 mt5" name="text"></textarea><br/>
    <input     class="fl ml5 ibtn plr10 mt10 mb5" name="send_message" value="Отправить" type="submit">


			<a id="use_choose_gifts" class="fr mr10 mt10" href="/choose_gifts/'.$ho['id'].'?tip=0/"><img class="icon" height="35" src="http://144.76.127.94/view/image/icons/biggift.png"></a>
			<div class="clb mb5"></div>
</from>
              <div class="fr mt10 ml10 mr5">
              </div> 
              <div class="clb mb5"></div> 
              <span class="small">Стоимость сообщения <img class="icon" src="http://144.76.127.94/view/image/icons/silver.png">10</span> 
              
              
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
   </div></div></div></div></div></div></div></div></div> ';

}}}}}






}
	 }
$max = 35;
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `mail` WHERE `from` = "'.$user['id'].'" AND `to` = "'.$ho['id'].'" OR `to` = "'.$user['id'].'" AND `from` = "'.$ho['id'].'"'),0);
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));

if($page > $pages) $page = $pages;
if($page < 1) $page = 1;
$start = $page * $max - $max;
;
if($count > 0) {
$col = array('#ffffff', '#f09060', '#90c0c0');
$q = mysql_query('SELECT * FROM `mail` WHERE `from` = \''.$user['id'].'\' AND `to` = \''.$ho['id'].'\' OR `to` = \''.$user['id'].'\' AND `from` = \''.$ho['id'].'\' ORDER BY `time` DESC LIMIT '.$start.', '.$max.'');

while($row = mysql_fetch_array($q)) {
$from = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = \''.$row['from'].'\''));
echo ' <div id="post_message_box"> 
    <div class="bdr bg_green">
     <div class="wr1">
      <div class="wr2">
       <div class="wr3">
        <div class="wr4">
         <div class="wr5">
          <div class="wr6">
           <div class="wr7">
            <div class="wr8"> 
             <div class="ml10 mt5 mb2 mr10 sh">
              <span class="tdn lblue">
              <a class="tdn lwhite" href="/user/'.$from['id'].'/"> '.nick($from['id']).' </a><br/></span> 
              <span class="grey1 small fr">'.vremja($row['time']).'</span> 
             </div> 
             <div class="ml10 mt2 mb5 mr10 sh"> 
              <br><span class="lblue"><b><font color=lime>'.bbcode(smile($row['text'])).'</font></b></span> 
             </div> 
            </div>
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    
     
    </div></div></div></div></div></div></div></div> ';
    
    


if($row['to'] == $user['id'] && $row['read'] == 0) mysql_query('UPDATE `mail` SET `read` = \'1\' WHERE `id` = \''.$row['id'].'\'');
}

echo ''.pages('/mail/'.$id.'/?').'
<div class="line"></div>';
}else{
echo '<div class="line"></div><div class="line"></div>';
}
if($i['id'] > '1') {
echo '
<a class="mbtn mb2" href=/choose_gifts/'.$ho['id'].'?tip=0/"><img class="icon" src="/images/ico/png/gift_s.png"> Отправить подарок</a>
<a class="mbtn mb2" href="/mail"><img class="icon" src="/images/ico/png/back.png"> Вернутся к диалогам</a>
';
}

if(mysql_result(mysql_query('SELECT COUNT(*) FROM `blacklist` WHERE `user` = \''.$user['id'].'\' AND `user2` = \''.$ho[id].'\''),0) == 0){
?>
<a class="mbtn mb2" href="?the=act"><span class="end"><span class="label"><img src=http://144.76.127.94/view/image/icons/black.png class=icon> Добавить в ЧС</span></span></a>
<?
}else{
echo "<a class='mbtn mb2' href='?the=act2'><span class='end'><span class='label'><img src=http://144.76.127.94/view/image/icons/black.png class=icon> Удалить в ЧС</span></span></a>";
}
?>
<?
if(mysql_result(mysql_query('SELECT COUNT(*) FROM `friends` WHERE `user` = \''.$user['id'].'\' AND `user2` = \''.$ho[id].'\''),0) == 0){
?>
<a class="mbtn mb2" href="?the=act3"><span class="end"><span class="label"><img src=http://144.76.127.94/view/image/icons/friend.png class=icon> Добавить в друзья</span></span></a>
<?
}else{
echo "<a class='mbtn mb2' href='?the=act4'><span class='end'><span class='label'><img src=http://144.76.127.94/view/image/icons/friend.png class=icon> Удалить из друзей</span></span></a>";
}
?></center>
<?






include './system/f.php';
}else{
  
  
  
  
$title = 'Почта';    
include './system/h.php';

$max = 15;
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `contacts` WHERE `user` = \''.$user['id'].'\''),0);
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));

if($page > $pages) $page = $pages;
if($page < 1) $page = 1;
$start = $page * $max - $max;

  if($count > 0) {

  


/*
echo ' 
 <div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Почта
    </div>
   </div>
  </div> ';
  
      $q = mysql_query('SELECT * FROM `contacts` WHERE `user` = \''.$user['id'].'\' ORDER BY `time` DESC LIMIT '.$start.', '.$max.'');

      while($row = mysql_fetch_array($q)) {

        $ho = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = \''.$row['ho'].'\''));
      $lost = mysql_fetch_array(mysql_query('SELECT * FROM `mail` WHERE `from` = \''.$user['id'].'\' AND `to` = \''.$row['ho'].'\' OR `to` = \''.$user['id'].'\' AND `from` = \''.$row['ho'].'\' ORDER BY `time` DESC LIMIT 1'));

      echo '<div class="bdr cnr bg_blue mb2">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div id="view_posters_box"> 
            <div class="ml10 mt5 mr5"> 
            
            
      <a href="/mail/'.$row['ho'].'/">';
       
	  
      echo ''.nick($row['ho']).'<span style="float: right; color: '.(($lost['read'] == 0 AND $lost['from'] == $row['ho'] AND $lost['to'] = $user['id']) ? '#90c090':'#909090').';"> <small>'.vremja($row['time']).'</small> </span>';
  
      $new = mysql_result(mysql_query('SELECT COUNT(*) FROM `mail` WHERE `from` = "'.$row['ho'].'" AND `to` = "'.$user['id'].'" AND `read` = "0" '),0);
       if($new != 0) echo '<font color="#90c090"> <small> +'.$new.' </small></font>';
       
  
    if($lost){ echo '<br/>  
    <font color="'.(($lost['read'] == 0 AND $lost['to'] == $user['id']) ? '#90c090':'#909090').'"> '.(mb_strlen(bbcode(smile($lost['text'])),'UTF-8') >= 255 ? mb_substr(bbcode(smile($lost['text'])),0, 255, 'UTF-8').'...':bbcode(smile($lost['text']))).' </font>';

echo '</font></a>
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
*/
echo '<div class="hr_g mb2"><div><div></div></div></div></div>
<div class="ribbon mb2"><div class="rl"><div class="rr">
Почта</div></div></div>';

      $q = mysql_query('SELECT * FROM `contacts` WHERE `user` = \''.$user['id'].'\' ORDER BY `time` DESC LIMIT '.$start.', '.$max.'');

      while($row = mysql_fetch_array($q)) {

        $ho = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = \''.$row['ho'].'\''));
      $lost = mysql_fetch_array(mysql_query('SELECT * FROM `mail` WHERE `from` = \''.$user['id'].'\' AND `to` = \''.$row['ho'].'\' OR `to` = \''.$user['id'].'\' AND `from` = \''.$row['ho'].'\' ORDER BY `time` DESC LIMIT 1'));




echo '<div class="bdr cnr bg_blue mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">

<div id="view_posters_box">            <div class="ml10 mt5 mr5">';

      echo 'Диалог с <a><a class="tdn lwhite" href=/mail/'.$row['ho'].'> '.nick($row['ho']).'  </a><span style="float: right; color: '.(($lost['read'] == 0 AND $lost['from'] == $row['ho'] AND $lost['to'] = $user['id']) ? '#90c090':'#909090').';"> </span></a>';
      $new = mysql_result(mysql_query('SELECT COUNT(*) FROM `mail` WHERE `from` = "'.$row['ho'].'" AND `to` = "'.$user['id'].'" AND `read` = "0" '),0);
       if($new != 0) echo '<font color="#90c090"> <small><b>(+'.$new.')</b></small></font>';
                  
                 echo '</a><span class="grey1 small"><span class="nwr fr">'.vremja($row['time']).'</span></span>            </div>
        </div><div id="view_posters_pgn"></div></div></div></div></div></div></div></div></div></div>';
}





/*
echo '<div class="hr_g mb2"><div><div></div></div></div>
<a class="mbtn mb2" href="/friend_list"><img class="icon" src="http://144.76.127.94/view/image/icons/friend.png"> Список друзей</a>
<a class="mbtn mb2" href="/black_list"><img class="icon" src="http://144.76.127.94/view/image/icons/black.png"> Черный список</a>
<a class="mbtn mb2" href="/delete_all"><img class="icon" src="http://144.76.127.94/view/image/icons/delete_all.png"> Удалить все прочитанные</a>
<a class="mbtn mb2" href="/mark_all"><img class="icon" src="http://144.76.127.94/view/image/icons/delete_all.png"> Отметить все как прочитанные</a><div class="hr_g mb2"><div><div></div></div></div>
<div class="hr_g mb2 mt10"><div><div></div></div></div>';
*/


}else{  
}

?>
<a class=mbtn mb2 href='/mail/2'><img src=http://144.76.127.94/view/image/icons/post.png class=icon> Системный бот!</a>
<a class=mbtn mb2 href='/friends.php'><img src=http://144.76.127.94/view/image/icons/friend.png class=icon> Список друзей</a>
<a class=mbtn mb2 href='/blacklist.php'><img src=http://144.76.127.94/view/image/icons/black.png class=icon> Чёрный список</a>
<div class="hr_g mb2">
   <div>
    <div></div>
   </div>
  </div>
<div class="bntf">
   <div class="small">
    <div class="nl">
     <div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">
Строка системный бот поможет прочитать сообщение, которого нету в почте!
     </div>
    </div>
   </div>
  </div>



<?
if($_GET['act']==truncate) {
//<a class=mbtn mb2 href="?act=truncate"><img src=http://144.76.127.94/view/image/icons/delete_all.png class=icon> Очистить сообщения</a> 

mysql_query("DELETE FROM `contacts` WHERE `user` = '".$user[id]."'");
mysql_query("DELETE FROM `contacts` WHERE `ho` = '".$user[id]."'");
mysql_query("DELETE FROM `contacts` WHERE `from` = '".$user[id]."'");
header('location:?');

?>

<?

}

include './system/f.php';
}

?>