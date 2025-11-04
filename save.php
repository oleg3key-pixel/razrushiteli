<?
    
include './system/common.php';  
include './system/functions.php';     
include './system/h.php';     
   
if(!$user) { 
$title = 'Возвращение домой';
$act = isset($_GET['act']) ? $_GET['act'] : null;
switch($act){



case 'save':




















$sex = _string($_POST['sex']);
if(isset($_REQUEST['reg']))
{
 
$login = _string($_POST['login']);
$password = _string($_POST['password']);
$email = _string($_POST['email']);



   if(empty($login) or empty($password)  or empty($email)){
      header("Location: /start.php?act=save");
     $_SESSION['mes'] = mes('Одно из полей не заполнено');
     exit;  
}


$sql = mysql_query("SELECT COUNT(`id`) FROM `users` WHERE `login` = '".$login."'"); 
if(mysql_result($sql, 0)){
      header("Location: /start/save");


     $_SESSION['mes'] = mes('Такой ник уже существует!');
     exit;  
}

$sql = mysql_query("SELECT COUNT(`id`) FROM `users` WHERE `email` = '".$email."'"); 
if(mysql_result($sql, 0)){
      header("Location: /start/save");


     $_SESSION['mes'] = mes('Такой E-Mail уже зарегестрирован!');
     exit;  
}







if(mb_strlen($login) > 32 or mb_strlen($login) < 3){
      header("Location: /start/save");
     $_SESSION['mes'] = mes('Логин должен состоять от 3 до 32 символов!');
     exit;  
}
if(mb_strlen($password) > 32 or mb_strlen($password) < 3){
      header("Location: /start/save");
     $_SESSION['mes'] = mes('Пароль должен состоять от 3 до 32 символов!');
     exit;  
}

if(mb_strlen($sex) < 1){
      header("Location: /start/save");
     $_SESSION['mes'] = mes('Вы не выбрали пол!');
     exit;     
}


 if(mysql_num_rows(mysql_query('SELECT * FROM `users` WHERE `ip` = \''.$_SERVER['REMOTE_ADDR'].'\'')) != 0){ 
 $_SESSION['msg'] = 'У вас уже есть аккаунт.';
echo'<div class="bntf"><div class="small"><div class="nl"><div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">У вас уже есть аккаунт!</div></div></div></div>
<div class="hr_g mb2 mt10">
   <div>
    <div></div>
   </div>
  </div>';
 exit;
        }

  if(mysql_query('INSERT INTO `users` (`login`,
                                    `password`,
                                    `email`,
									`sex`,
									`g`,
									`s`,
									`exp`,
									`str`,
									`vit`,
									`def`,
									`bonus_date`) VALUEs ("'.$login.'",
                                                   "'.$_POST['password'].'",
                                                   "'.($_POST['email']).'",
												   "'.$sex.'",
												   "1000000",
												   "10000000",
												   "0",
												   "39",
												   "39",
												   "39",
												   "'.date('d.m.Y').'" )')) {
/*
if($_SESSION['ref']){
$id = mysql_insert_id();
mysql_query("update `users` set `id_partner` = '".$_SESSION['ref']."' where (`id` = '".$id."')");
}
*/
$id = mysql_insert_id();                                   
setCookie('id', $id, time() + 86400, '/');
setCookie('password',$_POST['password'], time() + 86400, '/');

$text='Добро пожаловать в игру. Спасибо за регистрацию. Приведи к нам 10 своих друзей, и получишь хорошую награду!';
mysql_query('INSERT INTO `mail` (`from`, `to`, `text`,`time`, `read`) VALUES ("2", "'.$id.'", "'.$text.'", "'.time().'", "0")');
mysql_query('INSERT INTO `contacts` (`ho`, `user`, `time`) VALUES ("2", "'.$id.'", "'.time().'")');
mysql_query('INSERT INTO `contacts` (`user`, `ho`, `time`) VALUES ("2", "'.$id.'", "'.time().'")');
}



header('location: /');
exit;  
}

echo ''.$_SESSION['mes'].' ';
    $_SESSION['mes']=NULL; //Удаляем сесию
	





  




echo'
<div class="ribbon mb2"><div class="rl"><div class="rr">Сохранение</div></div></div>




<form action="" method="POST">
<div class="bdr bg_blue mb10"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
<div class="ml10 mt5 mb5 mr10 sh cntr">
Имя <div class="mb2"></div><input type="text" name="login" value=""/>
<div class="mb5"></div>
Пароль<div class="mb2"></div><input type="password" name="password" value=""/>
<div class="mb5"></div>
E-mail<div class="mb2"></div><input type="text" name="email" value=""><br>
<span class="small grey1">Введите <span class="text_red">правильный</span> e-mail, иначе вы не сможете восстановить вашего героя!</span>
<div class="mb5"></div>
Пол:
<input id="sex0" type="radio" name="sex" value="0" checked="checked"><label for="gender0" class="small">Мужской</label>
<input id="sex1" type="radio" name="sex" value="1"><label for="gender1" class="small">Женский</label>
<div class="mb2"></div>
</div>
</div></div></div></div></div></div></div></div></div><br>
<div class="cntr"><span class="ubtn inbl mt-15 green"><span class="ul"><input class="ur" type="submit" name="reg" value="Сохранить"></span></span></div> 
<br><br>';


























break;
}


include './system/f.php';
exit;
} 

?>