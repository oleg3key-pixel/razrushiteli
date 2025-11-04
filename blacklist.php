<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}
    
    $title = 'Черный список';


include './system/h.php'; 
?>
  <div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Черный список
    </div>
   </div>
  </div> <?
 $max = 10; 
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `blacklist` WHERE `user` = \''.$user['id'].'\''),0);
  $pages = ceil($count/$max); 
   $page = _string(_num($_GET['page']));

  if($page > $pages) $page = $pages; 
   
  if($page < 1) $page = 1; 
     
  $start = $page * $max - $max; 

  if($count > 0) { 

    
    $q = mysql_query('SELECT * FROM `blacklist` WHERE `user` = \''.$user['id'].'\' ORDER BY `time` DESC LIMIT '.$start.', '.$max.'');

    while($row = mysql_fetch_array($q)) {
$ho = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = \''.$row['user2'].'\''));
?>

 </div> 
  <div class="bdr bg_blue">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="ml10 mt5 mb5 mr10 sh"> 

            <a href="/user/<?=$ho['id']?>/"> <?=nick($ho['id'])?></a> 
            <a href='/blacklist.php/?delete=<?=$ho['id']?>'><img src="http://144.76.127.94/view/image/icons/error.png" class="icon"></a>
            <br> 
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
  <?



/*
?><div class='block_zero'><a href='/user/
<?=$ho['id']?>

<img src='/images/icon/race/<?=$ho['r']?>.png' alt=''/> 
<?=$ho['login']?>
a>, <img src='/images/icon/level.png' alt=''/> <?=$ho['level']?> ур <span class='medium'>( 
<a href='/blacklist.php/?delete=<?=$ho['id']?>'>
Удалить</a> )</span><br/>
</div>
<div class='dot-line'></div>
<?
*/
    }

  echo '
<div class=\'block_zero\'>
'.pages('/blacklist.php?').'</div>';

  }
  else
  {

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
             Ваш черный список пуст 
           </div> 
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div> ';
  }
?>
<div class='dot-line'></div>
<?

$name = _string($_POST['name']);
$name = strToLower($name);
if(isset($_GET['add'])){
if(mysql_result(mysql_query('SELECT COUNT(*) FROM `friends` WHERE `user` = \''.$user['id'].'\' AND `user2` = \''.$name.'\''),0) != 0){
mysql_query('DELETE FROM `friends` WHERE `user` = "'.$user['id'].'" AND `user2` = "'.$name.'"');
}
if(mysql_result(mysql_query('SELECT COUNT(*) FROM `blacklist` WHERE `user` = \''.$user['id'].'\' AND `user2` = \''.$name.'\''),0) != 0){
 echo'Данный игрок уже в вашем чёрном списке';  
}else{
if($user['id'] == $name){
echo'<center>Себя нельзя добавлять в чёрный список</center>';
}else{
if($name == 0){
echo'<center>Введите ID игрока</center>';
}else{
mysql_query("INSERT INTO `blacklist` (`user`,`user2`)VALUES('$user[id]','$name')");
header('location:/blacklist.php?');
}
}
}
}

$what = $ho['id'];
if(isset($_GET['delete']) == $what){ 
    mysql_query('DELETE FROM `blacklist` WHERE `user` = "'.$user['id'].'" AND `user2` = "'.$ho['id'].'"');

  } 
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
           <div class="ml10 mb5 mr10 sh cntr"> 
            <form action="?add" method="post">
              ID игрока: 
             <div class="mb5"></div> 
               <input name="name" class="text">
             <div></div> 
             <span class="ubtn inbl green"><span class="ul"><input class="ur" type="submit" value="Добавить"></span></span>
             <br> 
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
  <div class="hr_g mb2">
   <div>
    <div></div>
   </div>
  </div> 
  <div class="bntf">
   <div class="small">
    <div class="nl">
     <div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">
       Игроки из черного списка не смогут отправлять вам письма
     </div>
    </div>
   </div>
  </div> 
  <div class="hr_g mb2">
   <div>
    <div></div>
   </div>
  </div> 
  <a class="mbtn mb2" href="/mail.php"><img src="http://144.76.127.94/view/image/icons/back.png" class="icon"> Почта</a> 
   <div>
    <div></div>
   </div>
  </div> 
   <div>
    <div></div>
   </div>
  </div> ';
/*
?>
<div class='block_zero' align='left'>
  <form action='?add' method='post'>
<br/
Введите ID игрока:
<br/>
  <input name='name' class='text'>
<br/>
  <span class='btn'><span class='end'><input class='label' type='submit' value='Добавить'>Добавить</span></span><br/>
  </form>
</div>
*/
include './system/f.php';  