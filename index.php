<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();

require_once './system/common.php';
require_once './system/functions.php';
require_once './system/user.php';
require_once './system/h.php';

global $mysqli;

$title = 'Разрушители';

// --- Если пользователь вошёл ---
if ($user) {

    // если игрок уже авторизован — перекидываем на полноценную главную
    header('Location: /main.php');
    exit;

// --- Если пользователь не вошёл ---
} else {

    $login = isset($_POST['login']) ? trim(strtolower($_POST['login'])) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (isset($_POST['ok'])) {
        $stmt = $mysqli->prepare("SELECT * FROM `users` WHERE `login` = ? AND `password` = ? LIMIT 1");
        $stmt->bind_param('ss', $login, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            setcookie('id', $user['id'], time() + 86400 * 30, '/');
            setcookie('password', $user['password'], time() + 86400 * 30, '/');
            header('Location: /main.php');
            exit;
        } else {
            $_SESSION['mes'] = 'Неправильный логин или пароль!';
            header('Location: /');
            exit;
        }
        $stmt->close();
    }
    ?>

    <!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN"
        "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="author" content="MegaMobile"/>
        <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1"/>
        <link rel="icon" href="/view/image/icons/favicon.png" type="image/png">
        <link rel="stylesheet" type="text/css" href="/view/style/index.css"/>
        <title>Разрушители — онлайн игра</title>
    </head>
    <body>
    <div class="bdr bg_blue mb2">
      <div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
        <div class="ml10 mb10 mr10 small cntr sh">
          <img src="/view/image/welcome.jpg" width="200" height="190"><br>
          Непрекращающиеся сражения до последней капли крови!<br>
          Опасные походы и приключения!<br>
          Начни путь великого героя!
        </div>
        <div class="clb"></div>
      </div></div></div></div></div></div></div></div>
    </div>

    <div class="cntr">
        <a href="/start.php?act=save" class="ubtn mt-15 inbl green mb5">
          <span class="ul"><span class="ur">Начать игру</span></span>
        </a>
    </div>

    <?php
    echo '<div class="bdr bg_blue mb2">
        <div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
        <div class="ml10 mb10 mr10 small cntr sh">';
    if (!empty($_SESSION['mes'])) {
        echo '<b style="color:red">'.$_SESSION['mes'].'</b>';
        $_SESSION['mes'] = null;
    }
    echo '<form action="/" method="post">
        Ваш логин:<br/><input name="login" type="text"/><br/>
        Ваш пароль:<br/><input name="password" type="password"/><br/><br/>
        <span class="ubtn inbl green">
          <span class="ul"><input class="ur" type="submit" name="ok" value="Войти"/></span>
        </span>
      </form>
      <div class="mt10 small">
        <a href="/pass.php" class="darkgreen_link">Забыли пароль?</a>
      </div>
      </div></div></div></div></div></div></div></div></div></div>';
}

include './system/f.php';
?>
