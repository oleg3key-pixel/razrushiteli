<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

}

$title = 'Восстановление Пароля';    

include './system/h.php';
    
    if (isset($_POST['submit'])) {
$login = (isset($_POST['login']) AND !empty($_POST['login'])) ? mysql_real_escape_string(addslashes(htmlspecialchars($_POST['login']))) : false;
if (isset($_POST['submit'])) { 
$email = (isset($_POST['email']) AND !empty($_POST['email'])) ? mysql_real_escape_string(addslashes(htmlspecialchars($_POST['email']))) : false;
        
if ($login) {
        if ($email) {
            
$query = mysql_fetch_assoc(mysql_query("SELECT `id`, `login`, `email` FROM `users` WHERE `login` = '$login' LIMIT 1"));
            $query = mysql_fetch_assoc(mysql_query("SELECT `id`, `login`, `email` FROM `users` WHERE `email` = '$email' LIMIT 1"));
            
            if ($query AND !empty($query['email'])) {
                
                /* Функция сгенерирует рандомный пароль длинною 8 символов*/
function generatePassword($length = 8){
  $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
  $numChars = strlen($chars);
  $string = '';
  for ($i = 0; $i < $length; $i++) {
    $string .= substr($chars, rand(1, $numChars) - 1, 1);
  }
  return $string;
}
$rou = generatePassword(8) ;
                mysql_query("UPDATE `users` SET `password` ='$rou' WHERE `id` = '".$query[id]."'");
                $title = 'Восстановление пароля';
                $to = $query['email'];
$from = 'support@trush.pw';
                $text = 'Здравствуйте, '.$login.'!Прежде всего выражаем благодарность вам за что вы нас поддерживаете и играете!:)Вы выполнили операцию восстановления пароля в игре Уничтожители <br><br>Ваши данные для входа: <br><br>Логин: '.$login.' <br><br>Пароль: '.$rou.' ! P.S Если вы не выполняли данной операци то просто проигноируйте письмо!
______________________________________________
Пароль сгенерировался автоматически после авторизации обязательно смените его! Удачи вам в сражениях!  С уважением Администрация игры Уничтожители ';
                
                mail($to, $title, $text, 'From:'.$from);
                echo '<div class="nfl small cntr p5 mt5 mb5 mlra lngreen"><center>Спасибо! На указанный Email отправлено письмо с ссылкой для смены пароля.</center></div>';
                
} else echo '<div class="nfl small cntr p5 mt5 mb5 mlra error1">Персонаж не найден, либо неуказан e-mail при регистрации</div>';

} else echo '<div class="nfl small cntr p6 mt6 mb6 mlra error2">Ошибка, неверно указан e-mail персонажа ! </div>';
            
} else echo '<div class="nfl small cntr p5 mt5 mb5 mlra error1">Персонаж не найден, либо неверно указан e-mail !</div>';
        
    }
    
}
    
?>    
  
  
  
  
  <div class="ribbon mb2"><div class="rl"><div class="rr">
	Восстановление пароля</div></div></div>


<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="ml10 mt5 mb5 mr10 sh cntr">
		<form action="/pass.php" method="POST">
			<div class="mb5"></div>
			Введите логин героя<br>			<div class="mb2"></div>
			<input type="text" name="login" value="<?php echo (isset($_POST['login']) ? $_POST['login'] : ''); ?>">
			<div class="mb5"></div>
			Введите e-mail, который вводили при сохранении героя<br>			<div class="mb2"></div>
			<input type="text" name="email" value="<?php echo (isset($_POST['email']) ? $_POST['email'] : ''); ?>">
			<div class="mt5"></div>
			<span class="ubtn inbl green"><span class="ul"><input class="ur" type="submit" name="submit" value="Восстановить"></span></span>
		</form>
	</div>
</div></div></div></div></div></div></div></div></div>

<div class="hr_g mb2"><div><div></div></div></div>
<div class="bntf"><div class="nl"><div class="nr cntr lyell lh1 p5 sh small">
	Отправка письма занимает до 2 минут. Если письмо не пришло, проверьте папку со спамом. Если письма там нет, попробуйте еще раз или обратитесь в службу поддержки.</div></div></div>
<div class="hr_g mb2"><div><div></div></div></div>

<div class="hr_g mb2 mt10"><div><div></div></div></div>
<a class="mbtn mb2" href="/"><img class="icon" src="http://144.76.127.94/view/image/icons/home.png"> Главная</a><div class="hr_g mb2"><div><div></div></div></div>










<?php include './system/f.php'; ?>