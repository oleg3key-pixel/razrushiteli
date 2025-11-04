<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';
    
if(!$user) {//Переадресация для не авторизованных
header('location: /');    
exit;}




/*
$max = 10;
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `users`'),0);
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));

if($page > $pages) {$page = $pages;}
if($page < 1) {$page = 1;}
$start = $page * $max - $max;

if($page == 1) {$i = $page - 1;}
elseif($page == 2) {
$i = ($page + 9);
}else{$i = ($page * 10) - 9;}
*/





$max = 10;
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `users`'),0);
if($count > '100'){ $count=100;}
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));

if($page > $pages) {$page = $pages;}
if($page < 1) {$page = 1;}
$start = $page * $max - $max;

$i = ($page * 10 - 10 );




$q = mysql_query('SELECT * FROM `users` ORDER BY `valor`DESC LIMIT '.$start.', '.$max.'');
include './system/h.php';  

/*
echo'<div class="block_link"><a href="/user/'.$row['id'].'/">'; 
if($user['id'] == $row[id])echo ' <font color="lime"> '.$i.'. </font>';
else echo ''.$i.'';
echo''.nick($row['id']).' ';

*/



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
            
            
            <div class="pt3 cntr"> 
             <div class="fl w25 inbl spr2bg r"> 
              <a href="/rating.php" class="pt3 inbl"> Игроки </a> 
             </div> 
             <div class="fl w25 inbl spr2bg r"> 
              <a href="/clans.php" class="pt3 inbl"> Кланы </a> 
             </div> 
             <div class="fl w25 inbl spr2bg r"> 
              <a href="/rating_coliseum.php" class="pt3 inbl"> Колизей </a> 
             </div> 
             <div class="fr w25 inbl"> 
              <span class="slct"><span class="send"><span class="sttl"> Доблесть </span></span></span> 
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
               <td class="p5">Имя</td> 
               <td class="p5">Уровень</td> 
              </tr>';

           while($row = mysql_fetch_array($q)) {//Вывод игроков
            $a=array($row['valor']);//Додаем Уровень
$i++;


   
echo '           <tr>
               <td class="yell">'.$i.'</td>
               <td class="lft"><a href="/user/'.$row['id'].'" class="">'.$row['login'].'</a></td>
               <td class="yell">'.array_sum($a).'</td>
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
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `users`'),0);
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));

if($page > $pages) {$page = $pages;}
if($page < 1) {$page = 1;}
$start = $page * $max - $max;

if($page == 1) {$i = $page - 1;}
elseif($page == 2) {
$i = ($page + 9);
}else{$i = ($page * 10) - 9;}




$q = mysql_query('SELECT * FROM `users` ORDER BY `level` DESC,`exp` DESC LIMIT '.$start.', '.$max.'');  while($row = mysql_fetch_array($q)) { $i++;




echo'
<div class="empty_block">
<table cellpadding="0" cellspacing="0">
<tr>
<td width="15%">
<img src="/images/ico/gerb/'.$row['gerb'].'.png" alt="*"/>
/td>
<td><img src="/images/ico/png/user.png" alt="*" width="18"/> <a href="/user.php?id='.$row['id'].'">'.$row['name'].'</a><br/>
<img src="/images/ico/png/user_level.png" width="18"/> Уровень: <b>'.$row['level'].'</b><br/>
<img src="/images/ico/png/exp.png" alt="*" width="18"/> Опыт: '.n_f($row['exp']).'</td>
</tr></table>
</div><div class="line"></div>';
}

echo''.pages('?').'';//Вывод страниц
echo'<div class="line"></div>';
if(!$user){
echo'<div class="block_link"><a href="/users/create/"><img src="/images/ico/png/user_created.png" alt="*"/> Создать клан</a></div>
<div class="line"></div>';}



include './system/f.php';
break;


case 'create':
$title = 'Создать клан';    
include './system/h.php';  
$cost = 1000;

  if($user) {
header("Location: /users/");
$_SESSION['mes'] = mes('Для создания клана необходимо выйти из уже существующего!');
exit;


  }else{
  


  if(isset($_REQUEST['ok'])){
$name = _string($_POST['name']);
	
    $users = mysql_query('SELECT * FROM `users` WHERE `name` = "'.$name.'"');
    $users = mysql_fetch_array($users);
  
  
  

  if(empty($name) or mb_strlen($name) < 3) {
header('Location: /users/create/');
$_SESSION['mes'] = mes('Слишком короткое название!');
exit; }

     if($cost > $user[g]) {
header('Location: /users/create/');
$_SESSION['mes'] = mes('Недостаточно золота!');
exit; }  
  
$users = mysql_query('SELECT * FROM `users` WHERE `name` = "'.$name.'"');
$users = mysql_fetch_array($users);
    
    
  if($users[name] == $name) {
header('Location: /users/create/');
$_SESSION['mes'] = mes('Клан с таким названием уже существует!');
exit; }  
  

mysql_query('UPDATE `users` SET `g` = "'.($user['g'] - $cost).'" WHERE `id` = "'.$user['id'].'"');
mysql_query('INSERT INTO `users` (`name`,`r`) VALUES ("'.$name.'", "'.$user['r'].'")');
$user_id = mysql_insert_id();
mysql_query('INSERT INTO `user_memb` (`user`,`user`,`v`,`rank`, `time`,`last_update`) VALUES ("'.$user_id.'", "'.$user['id'].'", "10", "5", "'.time().'","'.(time() + ((60 * 60) * 24)).'")');
$text=' <a href="/user/'.$user['id'].'">'.nick($user['id']).'</a> <font color="#7afe4e">основал клан '.$name.'</font> '; //Текст уведомления
mysql_query("INSERT INTO `user_history` SET `user`='".$user_id."',`text`='".$text."',`time`='".time()."'"); //Отправляем уведомление
header('location: /user.php');
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
<div class="bntf"><div class="nl"><div class="nr cntr lyell lh1 p5 sh small"><ul class="mt5 mb5"><li class="lft mb2">Стоимость создания клана <img src="http://144.76.127.94/view/image/icons/gold.png" class="icon">1000</li><li class="lft">Название клана должно быть от 5 до 20 символов</li></ul></div></div></div>
<div class="hr_g mb2"><div><div></div></div></div>
</form>
<a href="/users.php" class="mbtn mb2"><img src="http://144.76.127.94/view/image/icons/back.png" class="icon"> Назад в кланы</a>';
}
*/

 
include './system/f.php';

?>