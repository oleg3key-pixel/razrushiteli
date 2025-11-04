<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';
    
if(!$user) {
header('location: /');
exit;}


$action = isset($_GET['action']) ? $_GET['action'] : null;
switch($action)
{
default:

$title = 'Настройки';    
include './system/h.php';  

echo '  <div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Настройки
    </div>
   </div>
  </div> 
  <div class="bdr cnr bg_blue cntr mb2">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="mt5 mb5"> 
            <a href="/settings/login" class="ubtn inbl green mb10 w200px"><span class="ul"><span class="ur lft"><img class="icon" src="http://144.76.127.94/view/image/icons/edit_name.png">Изменить имя</span></span></a>
            <br> 
            <a href="/settings/gender" class="ubtn inbl green mb10 w200px lft"><span class="ul"><span class="ur lft"><img class="icon" src="http://144.76.127.94/view/image/icons/gender.png">Сменить свой пол</span></span></a>
            <br> 
            <a href="/settings/password" class="ubtn inbl green mb10 w200px lft"><span class="ul"><span class="ur lft"><img class="icon" src="http://144.76.127.94/view/image/icons/password.png">Изменить пароль</span></span></a>
            <br> 
            <a href="/?exit" class="ubtn inbl green mb10 w200px lft"><span class="ul"><span class="ur lft"><img class="icon" src="http://144.76.127.94/view/image/icons/logout.png">Выйти</span></span></a>
            <br> 
           </div> 
           <div class="cntr mb5">
             ID вашего героя: '.$user['id'].'
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
break;


case 'login':
$title = 'Сменить логин';    
include './system/h.php';
echo '<div class="title">'.$title.'</div>';

$login = _string($_POST['login']);

  if(isset($_REQUEST['login'])){
	  
     if(mb_strlen($login) > 40 or mb_strlen($login) < 3){
header('Location: /settings/login/');
$_SESSION['mes'] = mes('Логин должен состоять от 3 до 40 символов!');
exit; }  

     if (!preg_match('/[a-z0-9а-я]{2,20}/i', $login)){
header("Location:/settings/login/");
$_SESSION['mes'] = mes('Кириллица запрещена в логине!');
exit;} 

	 if(mysql_result(mysql_query('SELECT COUNT(*) FROM `users` WHERE `login` = \''.$login.'\''),0) != 0){
header('Location: /settings/login/');
$_SESSION['mes'] = mes('Персонаж с такими именем уже зарегестрирован!');
exit; }  	  
	 if($user['g'] < 250) {
header('Location: /settings/login/');
$_SESSION['mes'] = mes('Недостаточно золота!');
exit; }    


mysql_query('UPDATE `users` SET `login` = \''.$login.'\',`g` = `g` - 250 WHERE `id` = \''.$user['id'].'\'');
$_SESSION['mes'] = mes('Ваш логин успешно изменен!');
header('location: /settings/login/');
exit;  
  

}

     echo' '.$_SESSION['mes'].'  ';
    $_SESSION['mes']=NULL; //Удаляем сесию
	
    echo' <div class="empty_block item_center">
<form action="/settings/login/" method="post">
Введите новый логин:<br/>
<input name="login"/><br/>
<input class="button" type="submit" value="Сменить"/>
</form>
<font color="#999"><small>Цена: <img src="/images/ico/png/gold.png" alt="*" width="18"/> 250 золота <br/>
Логин должен состоять от 3 до 12 символов</small></font>
</div><div class="line"></div>

<div class="block_link"><a href="/settings/"><img src="/images/ico/png/back.png"> Вернуться в настройки</a></div>
<div class="line"></div>';
break;	
	

case 'password'://Сменить пароль
$title = 'Сменить пароль';    
include './system/h.php';

if(isset($_REQUEST['upspass'])) {

$np = _string($_POST['np']);
$npp = _string($_POST['npp']);
$hp = _string($_POST['hp']);

if(empty($np) or empty($npp)) {
  header("Location:/settings/password/");
  $_SESSION['mes'] = mes('Одно из полей не заполнено!');
  exit;}
/*
if($np != $npp){
  header("Location:/settings/password/");
  $_SESSION['mes'] = mes('Пароли не совпадают!');
  exit;}
*/
if(mb_strlen($hp) < 0 or mb_strlen($np) < 6) {
  header("Location:/settings/password/");
  $_SESSION['mes'] = mes('Слишком короткий пароль!');
  exit;}

if (!preg_match('/[a-z0-9]{2,20}/i', $np)) {
  header("Location:/settings/password/");
  $_SESSION['mes'] = mes('Кириллица запрещена!');
  exit;}
/*
if (!preg_match('/[a-z0-9]{2,20}/i', $hp)) {
  header("Location:/settings/password/");
  $_SESSION['mes'] = mes('Кириллица запрещена!');
  exit;}

$sql = mysql_fetch_assoc(mysql_query("SELECT `password` FROM `users` WHERE `id` = '".$user['id']."'"));
if($sql['password'] != ($_POST['hp'])) {
  header("Location:/settings/password/");
  $_SESSION['mes'] = mes('Неверый пароль!');
  exit; }
*/

mysql_query('UPDATE `users` SET `password` = \''.$_POST['np'].'\' WHERE `id` = \''.$user['id'].'\'');
setCookie('password', ($_POST['np']), time() + 86400, '/');
	
  header("Location:/settings/password/");
  $_SESSION['mes'] = mes('Пароль успешно изменен!');
  exit; 
}

     echo' '.$_SESSION['mes'].'  ';
    $_SESSION['mes']=NULL; //Удаляем сесию
echo ' <div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Смена пароля
    </div>
   </div>
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
           <div class="ml10 mt5 mb5 mr10 sh cntr"> 
            <form action="" method="POST">
              Введите новый пароль
             <br> 
             <div class="mb2"></div> 
             <input type="password" name="np" value=""> <br><br>
              Повторите новый пароль 
             <br>
             <input type="password" name="npp" value=""> <br><br>
             <div class="mt5"></div> 
             <span class="ubtn inbl green"><span class="ul"><input class="ur" name="upspass" type="submit" value="Изменить"></span></span> 
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
  </div> ';
  /*
echo'<div class="empty_block item_center">
<form action="" method="POST">
*Старый пароль:<br /><input type="password" name="hp" maxlength="25" /><br />
*Новый пароль:<br /><input type="password" name="np" maxlength="25" /><br />
*Повторите пароль:<br /><input type="password" name="npp" maxlength="25" /><br />
<input class="button" type="submit" name="upspass" value="Изменить" />
</form></div><div class="line"></div>

<div class="block_link"><a href="/settings/"><img src="/images/ico/png/back.png"> Вернуться в настройки</a></div>
<div class="line"></div>';
*/
break;


case 'gender'://Сменить пароль
$title = 'Сменить сторону';    
include './system/h.php';
echo '<div class="title">'.$title.'</div>';


    if($_GET['change'] == true) { 
if($user['g'] >= 50){
mysql_query('UPDATE `users` SET `sex` = "'.($user['sex'] == 0 ? 1:0).'", `g` = `g` - 50 WHERE `id` = "'.$user['id'].'"');
header('location: /settings/gender/');
$_SESSION['mes'] = mes('Пол успешно изменен!');
exit;
}else{
header("Location:/settings/gender/");
$_SESSION['mes'] = mes('Недостаточно золота!');
exit; 
 }
}
	     echo' '.$_SESSION['mes'].'  ';
    $_SESSION['mes']=NULL; //Удаляем сесию
	
    echo '<div class="empty_block item_center">
Текущая пол: '.($user['sex'] == 0 ? '<img src="/images/ico/png/hero_on_1.png" alt="*"/> Мужской':'<img src="/images/ico/png/hero_on_2.png" alt="*"/> Женский').'<br/>
Желаете сменить пол на  '.($user['sex'] == 0 ? '<img src="/images/ico/png/hero_on_2.png" alt="*"/> Женский':'<img src="/images/ico/png/hero_on_1.png" alt="*"/> Мужской').'?<br/>
<div class="link_center"><a href="/settings/gender/?change=true">Да, сменить</a></div>
<font color="#999"><small>Цена: <img src="/images/ico/png/gold.png" alt="*" idth="18"/> 50 золота </small></font>
</div><div class="line"></div>
 
<div class="block_link"><a href="/settings/"><img src="/images/ico/png/back.png"> Вернуться в настройки</a></div>
<div class="line"></div>';
break;



case 'email':
$title = 'Сменить email';    
include './system/h.php';
echo '<div class="title">'.$title.'</div>';

$email = _string($_POST['email']);

  if(isset($_REQUEST['email'])){
     
     if(empty($email) or mb_strlen($email) < 5) {
header('Location: /settings/email/');
$_SESSION['mes'] = mes('Слишком короткий email!');
exit; }   
   if(mysql_result(mysql_query('SELECT COUNT(*) FROM `users` WHERE `email` = \''.$email.'\''),0) != 0){
header('Location: /settings/email/');
$_SESSION['mes'] = mes('Персонаж с такими email уже зарегестрирован!');
exit; }     
   if($user['g'] < 2000) {
header('Location: /settings/email/');
$_SESSION['mes'] = mes('Недостаточно золота!');
exit; }    


mysql_query('UPDATE `users` SET `email` = \''.$email.'\',
                                     `g` = `g` - 2000 WHERE `id` = \''.$user['id'].'\'');
$_SESSION['mes'] = mes('Ваш email успешно изменен!');
header('location: /settings/email/');
exit;  
  

}

     echo' '.$_SESSION['mes'].'  ';
    $_SESSION['mes']=NULL; //Удаляем сесию
  
    echo' <div class="empty_block item_center">
<form action="/settings/email/" method="post">
Введите новый email:<br/>
<input name="email"/><br/>
<input class="button" type="submit" value="Сменить"/>
</form>
<font color="#999"><small>Цена: <img src="/images/ico/png/gold.png" alt="*" width="18"/> 2000 золота </small></font>
</div><div class="line"></div>

<div class="block_link"><a href="/settings/"><img src="/images/ico/png/back.png"> Вернуться в настройки</a></div>
<div class="line"></div>';
break;



}
include './system/f.php';

?>