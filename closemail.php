<?php

/**
 *
 * @author Денис Коновалов
 */

include './system/common.php';
include './system/functions.php';
include './system/user.php';
    
if (!isset ($user)) {
    header('location: /');
    exit;
}

$title = 'Настройки почты';
include './system/h.php';

if(isset($_POST['submit'])){

$mail = intval($_POST['mail']);

mysql_query("UPDATE users SET mailclosed='$mail' WHERE id ='".$user['id']."'") or die(mysql_error());

echo '<center>Сохранено!</center>';

}



echo '


<center>Режим почты
<br/>

<form action="" method="POST">  <input type="radio" name="mail" value="0" checked /> Открытый <input type="radio" name="mail" value="1" />Закрытый <br/><input type="submit" name="submit" value="Установить"></form></center>


';

include './system/f.php';
echo'<center><a href="http://statok.net/go/14883"><img src="http://statok.net/imageOther/14883" alt="Statok.net" /></a></center>';