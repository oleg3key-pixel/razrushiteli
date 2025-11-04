<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__.'/system/db.php';
require_once __DIR__.'/system/common.php';
require_once __DIR__.'/system/functions.php';
require_once __DIR__.'/system/user.php';   // <— ПОДКЛЮЧАЕМ ДО вывода HTML!

// Если пользователь уже авторизован — уводим на главную
if ($user) {
    header('Location: /');
    exit;
}

require_once __DIR__.'/system/h.php';      // <— Шапку выводим только после возможного редиректа

$title = 'Возвращение домой';
$act = isset($_GET['act']) ? $_GET['act'] : null;

switch ($act) {
    case 'save':
        $sex      = _string($_POST['sex']);
        if (isset($_REQUEST['reg'])) {
            $login    = _string($_POST['login']);
            $password = _string($_POST['password']);
            $email    = _string($_POST['email']);

            if (empty($login) || empty($password) || empty($email)) {
                $_SESSION['mes'] = mes('Одно из полей не заполнено');
                header('Location: /start.php?act=save');
                exit;
            }

            $sql = mysqli_query($mysqli, "SELECT COUNT(`id`) FROM `users` WHERE `login` = '$login'");
            $row = mysqli_fetch_row($sql);
            if ($row[0] > 0) {
                $_SESSION['mes'] = mes('Такой ник уже существует!');
                header('Location: /start.php?act=save');
                exit;
            }

            $sql = mysqli_query($mysqli, "SELECT COUNT(`id`) FROM `users` WHERE `email` = '$email'");
            $row = mysqli_fetch_row($sql);
            if ($row[0] > 0) {
                $_SESSION['mes'] = mes('Такой E-Mail уже зарегистрирован!');
                header('Location: /start.php?act=save');
                exit;
            }

            if (mb_strlen($login) > 32 || mb_strlen($login) < 3) {
                $_SESSION['mes'] = mes('Логин должен состоять от 3 до 32 символов!');
                header('Location: /start.php?act=save');
                exit;
            }

            if (mb_strlen($password) > 32 || mb_strlen($password) < 3) {
                $_SESSION['mes'] = mes('Пароль должен состоять от 3 до 32 символов!');
                header('Location: /start.php?act=save');
                exit;
            }

            if (mb_strlen($sex) < 1) {
                $_SESSION['mes'] = mes('Вы не выбрали пол!');
                header('Location: /start.php?act=save');
                exit;
            }

            // регистрация
            $sql = "INSERT INTO `users`
                    (`login`,`password`,`email`,`sex`,`g`,`s`,`exp`,`str`,`vit`,`def`,`bonus_date`)
                    VALUES
                    ('$login','$password','$email','$sex','150000','1500000','0','39','39','39','".date('d.m.Y')."')";
            if (mysqli_query($mysqli, $sql)) {
                $id = mysqli_insert_id($mysqli);
                setcookie('id', $id, time() + 86400, '/');
                setcookie('password', $password, time() + 86400, '/');

                $text = 'Добро пожаловать в игру. Спасибо за регистрацию. Приведи к нам 10 своих друзей, и получишь хорошую награду!';
                mysqli_query($mysqli, "INSERT INTO `mail` (`from`,`to`,`text`,`time`,`read`) VALUES ('2','$id','$text','".time()."','0')");
                mysqli_query($mysqli, "INSERT INTO `contacts` (`ho`,`user`,`time`) VALUES ('2','$id','".time()."')");
                mysqli_query($mysqli, "INSERT INTO `contacts` (`user`,`ho`,`time`) VALUES ('2','$id','".time()."')");
            }

            header('Location: /');
            exit;
        }

        echo ''.$_SESSION['mes'].'';
        $_SESSION['mes'] = null;

        echo '
        <div class="ribbon mb2"><div class="rl"><div class="rr">Сохранение</div></div></div>
        <form action="" method="POST">
            <div class="bdr bg_blue mb10">
                <div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
                    <div class="ml10 mt5 mb5 mr10 sh cntr">
                        Имя <div class="mb2"></div><input type="text" name="login" value=""/>
                        <div class="mb5"></div>
                        Пароль<div class="mb2"></div><input type="password" name="password" value=""/>
                        <div class="mb5"></div>
                        E-mail<div class="mb2"></div><input type="text" name="email" value=""><br>
                        <span class="small grey1">Введите <span class="text_red">правильный</span> e-mail, иначе вы не сможете восстановить вашего героя!</span>
                        <div class="mb5"></div>
                        Пол:
                        <input id="sex0" type="radio" name="sex" value="0" checked="checked"><label for="sex0" class="small">Мужской</label>
                        <input id="sex1" type="radio" name="sex" value="1"><label for="sex1" class="small">Женский</label>
                    </div>
                </div></div></div></div></div></div></div></div></div><br>
            <div class="cntr"><span class="ubtn inbl mt-15 green"><span class="ul"><input class="ur" type="submit" name="reg" value="Сохранить"></span></span></div>
            <br><br>
        ';
        break;
}

require_once __DIR__.'/system/f.php';
exit;
