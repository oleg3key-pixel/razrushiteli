<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';
    
if(!$user) {//Переадресация для не авторизованных
header('location: /');    
exit;}


switch($_GET['action']) {
default:

$title = 'Рейтинг кланов';    
include './system/h.php';  



echo' '.$_SESSION['mes'].'  ';
    $_SESSION['mes']=NULL; //Удаляем сесию

$max = 10;
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `clans`'),0);
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));

if($page > $pages) {$page = $pages;}
if($page < 1) {$page = 1;}
$start = $page * $max - $max;

if($page == 1) {$i = $page - 1;}
elseif($page == 2) {
$i = ($page + 9);
}else{$i = ($page * 10) - 9;}



echo '  <div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Рейтинг лучших
    </div>
   </div>
  </div> 
  <div class="bdr bg_main mb2">
   <div class="light">
    <div class="wr1">
     <div class="wr2">
      <div class="wr3">
       <div class="wr4">
        <div class="wr5">
         <div class="wr6">
          <div class="wr7">
           <div class="wr8"> 
            <div class="cntr mt10"> ';

echo ' <div class="hr_arr mlr10 mb-3">
             <div class="alf">
              <div class="art">
               <div class="acn"></div>
              </div>
             </div>
            </div> 
            <div class="pt3 mlr10 cntr"> 
             <div class="fl w25 inbl spr2bg r"> 
              <a href="/rating.php" class="pt3 inbl"> Игроки </a> 
             </div> 
             <div class="fl w25 inbl spr2bg r"> 
              <span class="slct"><span class="send"><span class="sttl"> Кланы </span></span></span> 
             </div> 
             <div class="fl w25 inbl spr2bg r"> 
              <a href="?" class="pt3 inbl"> Колизей </a> 
             </div> 
             <div class="fr w25 inbl"> 
              <a href="/rating_valor.php" class="pt3 inbl"> Доблесть </a> 
             </div> 
             <div class="clb"></div> 
            </div> 
            <div class="hr_arr mlr10">
             <div class="alf">
              <div class="art">
               <div class="acn"></div>
              </div>
             </div>
            </div> 
            <table class="cntr wa mlra mb10"> 
             <tbody>
              <tr> 
               <td class="p5">Место</td> 
               <td class="p5">Название</td> 
               <td class="p5">Уровень</td> 
              </tr>';
 $q = mysql_query('SELECT * FROM `clans` ORDER BY `level` DESC,`exp` DESC LIMIT '.$start.', '.$max.'');
 while($row = mysql_fetch_array($q)) { 
 $i++;
         
              
echo '           <tr>
               <td class="yell">'.$i.'</td>
               <td class="lft"><img src="/images/ico/gerb/herb'.$row['gerb'].'.png" width=20 height=20> <a href="/clan/'.$row['id'].'" class="">'.$row['name'].'</a></td>
               <td class="yell">'.$row['level'].'</td>
              </tr>
              <tr>
              </tr>';
 }
echo '           </tbody>
            </table>
            <div class="hr_arr mt5 mlr10">
             <div class="alf">
              <div class="art">
               <div class="acn"></div>
              </div>
             </div>
            </div>
            <div class="pgn">
             <span class="pag">';
             echo''.pages('?').'';//Вывод страниц
echo '       </span> </div>
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
   </div>
  </div> 
  <div class="hr_g mb2">
   <div>
    <div></div>
   </div>
  </div> 
  <div class="bntf">
   <div class="nl">
    <div class="nr cntr lyell lh1 p5 sh small">
      Рейтинг лучших кланов
     <br>Обновляется каждые 10 минут
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
  </div> 
   <div>
    <div></div>
   </div>
  </div>';
  
  /*

     echo' '.$_SESSION['mes'].'  ';
    $_SESSION['mes']=NULL; //Удаляем сесию

$max = 10;
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `clans`'),0);
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));

if($page > $pages) {$page = $pages;}
if($page < 1) {$page = 1;}
$start = $page * $max - $max;

if($page == 1) {$i = $page - 1;}
elseif($page == 2) {
$i = ($page + 9);
}else{$i = ($page * 10) - 9;}




$q = mysql_query('SELECT * FROM `clans` ORDER BY `level` DESC,`exp` DESC LIMIT '.$start.', '.$max.'');  while($row = mysql_fetch_array($q)) { $i++;




echo'
<div class="empty_block">
<table cellpadding="0" cellspacing="0">
<tr>
<td width="15%">
<img src="/images/ico/gerb/'.$row['gerb'].'.png" alt="*"/>
/td>
<td><img src="/images/ico/png/clan.png" alt="*" width="18"/> <a href="/clan.php?id='.$row['id'].'">'.$row['name'].'</a><br/>
<img src="/images/ico/png/clan_level.png" width="18"/> Уровень: <b>'.$row['level'].'</b><br/>
<img src="/images/ico/png/exp.png" alt="*" width="18"/> Опыт: '.n_f($row['exp']).'</td>
</tr></table>
</div><div class="line"></div>';
}

echo''.pages('?').'';//Вывод страниц
echo'<div class="line"></div>';
if(!$clan){
echo'<div class="block_link"><a href="/clans/create/"><img src="/images/ico/png/clan_created.png" alt="*"/> Создать клан</a></div>
<div class="line"></div>';}


*/
include './system/f.php';
break;


case 'create':
$title = 'Создать клан';    
include './system/h.php';  
$cost = 5000;

  if($clan) {
header("Location: /clans/");
$_SESSION['mes'] = mes('Для создания клана необходимо выйти из уже существующего!');
exit;


  }else{
  


  if(isset($_REQUEST['ok'])){
$name = _string($_POST['name']);
	
    $clans = mysql_query('SELECT * FROM `clans` WHERE `name` = "'.$name.'"');
    $clans = mysql_fetch_array($clans);
  
  
  

  if(empty($name) or mb_strlen($name) < 3) {
header('Location: /clans/create/');
$_SESSION['mes'] = mes('Слишком короткое название!');
exit; }

     if($cost > $user[g]) {
header('Location: /clans/create/');
$_SESSION['mes'] = mes('Недостаточно золота!');
exit; }  
  
$clans = mysql_query('SELECT * FROM `clans` WHERE `name` = "'.$name.'"');
$clans = mysql_fetch_array($clans);
    
    
  if($clans[name] == $name) {
header('Location: /clans/create/');
$_SESSION['mes'] = mes('Клан с таким названием уже существует!');
exit; }  
  

mysql_query('UPDATE `users` SET `g` = "'.($user['g'] - $cost).'" WHERE `id` = "'.$user['id'].'"');
mysql_query('INSERT INTO `clans` (`name`,`r`) VALUES ("'.$name.'", "'.$user['r'].'")');
$clan_id = mysql_insert_id();
mysql_query('INSERT INTO `clan_memb` (`clan`,`user`,`v`,`rank`, `time`,`last_update`) VALUES ("'.$clan_id.'", "'.$user['id'].'", "10", "5", "'.time().'","'.(time() + ((60 * 60) * 24)).'")');
$text=' <a class="tdn lwhite" href="/user/'.$user['id'].'">'.nick($user['id']).'</a> <font color="#7afe4e">основал клан '.$name.'</font> '; //Текст уведомления
mysql_query("INSERT INTO `clan_history` SET `clan`='".$clan_id."',`text`='".$text."',`time`='".time()."'"); //Отправляем уведомление
mysql_query('DELETE FROM `clans_z` WHERE `user` = "'.$user['id'].'"'); 
header('location: /clan.php');
}




     echo' '.$_SESSION['mes'].'  ';
    $_SESSION['mes']=NULL; //Удаляем сесию
echo'



  <form action="" method="post">
<div class="ribbon mb2"><div class="rl"><div class="rr">
	Создать клан</div></div></div>
<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
		<div class="mt5 mb10 mlr10 sh cntr lblue">
			Введите название клана<div class="mb5"></div>
			<input type="text" size="23" maxlength="20" name="name"><div class="mb5"></div>
		</div>
	</div></div></div></div></div></div></div></div></div><br>
<div class="cntr mb10 mt-5"><div class="ubtn inbl green mt-5"><div class="ul"><input class="ur" type="submit" name="ok" value="Создать клан"></div></div></div>
<div class="hr_g mb2"><div><div></div></div></div>
<div class="bntf"><div class="nl"><div class="nr cntr lyell lh1 p5 sh small"><ul class="mt5 mb5"><li class="lft mb2">Стоимость создания клана <img src="http://144.76.127.94/view/image/icons/gold.png" class="icon">5.000</li><li class="lft">Название клана должно быть от 5 до 20 символов</li></ul></div></div></div>
<div class="hr_g mb2"><div><div></div></div></div>
</form>
<a href="/clans.php" class="mbtn mb2"><img src="http://144.76.127.94/view/image/icons/back.png" class="icon"> Назад в кланы</a>';
}
 
 
include './system/f.php';
break; 
}
?>