<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();

require_once './system/common.php';
require_once './system/functions.php';
require_once './system/user.php';
require_once './system/h.php';

global $mysqli;
$title = 'Главная';

// Если не вошёл — на страницу входа
if(!$user) {
    header('Location: /');
    exit;
}

// --- ежедневный бонус ---
$bonus_date = date('d.m.Y');
$bonus_gold = 50;
if ($bonus_date != $user['bonus_date']) {
    $stmt = $mysqli->prepare("UPDATE `users` SET `g` = `g` + ?, `bonus_date` = ?, `lair_gold` = '0', `open_sunduk` = '1' WHERE `id` = ?");
    $stmt->bind_param('ssi', $bonus_gold, $bonus_date, $user['id']);
    $stmt->execute();
    $stmt->close();

    echo '<div class="bntf"><div class="nl"><div class="nr cntr lyell lh1 p5 sh">
        <span class="win">Ежедневный подарок:
        <img class="icon" src="/view/image/icons/png/gold.png"> '.$bonus_gold.'
        <br>Приходи завтра и получишь ещё золота!</span>
    </div></div></div><div class="hr_g mb2"><div><div></div></div></div>';
}

// --- босс Алуко ---
$aluko = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM `aluko` ORDER BY `id` LIMIT 1"));
if ($aluko && $aluko['health'] > 0) {
    echo '
    <div class="bdr bg_blue mb2">
        <div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5">
            <div class="wr6"><div class="wr7"><div class="wr8">
                <div class="ml10 mt5 mr10 mb5 cntr">
                    <img src="/view/image/png/dragons.png" width="80"><br>
                    <b>На помощь!</b> <font color="#ff3030">Алуко</font> напал на королевство!<br>
                    <div class="cntr mt5 mb5">
                        <a href="/drakon.php" class="ubtn blue inbl"><span class="ul"><span class="ur">Атаковать Алуко</span></span></a>
                    </div>
                </div>
            </div></div></div></div></div>
        </div></div></div>
    </div>
    <div class="hr_g mb2"><div><div></div></div></div>';
}

// --- Основное меню ---
echo '
<div class="cntr">
    <a class="mbtn mb2" href="/user.php"><img class="icon" src="/view/image/icons/png/hero.png"> Мой герой</a>
    <a class="mbtn mb2" href="/task.php"><img class="icon" src="/view/image/icons/png/quest.png"> Задания</a>
    <a class="mbtn mb2" href="/arena.php"><img class="icon" src="/view/image/icons/png/arena.png"> Арена</a>
    <a class="mbtn mb2" href="/coliseum.php"><img class="icon" src="/view/image/icons/png/coliseum.png"> Колизей</a>
    <a class="mbtn mb2" href="/lair.php"><img class="icon" src="/view/image/icons/png/dragons.png"> Логово монстров</a>
    <a class="mbtn mb2" href="/cw.php"><img class="icon" src="/view/image/icons/png/clanwar.png"> Войны кланов</a>
    <a class="mbtn mb2" href="/travel.php"><img class="icon" src="/view/image/icons/png/invasion.png"> Вторжение</a>
</div>

<div class="hr_g mb2"><div><div></div></div></div>

<div class="cntr">
    <a class="mbtn mb2" href="/shop/index.php"><img class="icon" src="/view/image/icons/png/shop.png"> Магазин</a>
    <a class="mbtn mb2" href="/friends.php"><img class="icon" src="/view/image/icons/png/friend.png"> Друзья</a>
    <a class="mbtn mb2" href="/zags.php"><img class="icon" src="/view/image/icons/png/zags.png"> ЗАГС</a>
    <a class="mbtn mb2" href="/rating.php"><img class="icon" src="/view/image/icons/png/records.png"> Рейтинг</a>
</div>

<div class="hr_g mb2"><div><div></div></div></div>

<div class="cntr">
    <a class="mbtn mb2" href="/chat.php"><img class="icon" src="/view/image/icons/png/chat.png"> Чат</a>
    <a class="mbtn mb2" href="/forum.php"><img class="icon" src="/view/image/icons/png/forum.png"> Форум</a>
    <a class="mbtn mb2" href="/settings.php"><img class="icon" src="/view/image/icons/png/settings.png"> Настройки</a>
</div>

<div class="hr_g mb2"><div><div></div></div></div>
';

// --- Активные задания ---
$q_tasks = mysqli_query($mysqli, "SELECT * FROM `task_user` WHERE `user` = '{$user['id']}' AND `end` = 0 ORDER BY `id` DESC LIMIT 5");
if ($q_tasks && mysqli_num_rows($q_tasks) > 0) {
    echo '<div class="ribbon mb2"><div class="rl"><div class="rr">Активные задания</div></div></div>';
    while ($t = mysqli_fetch_assoc($q_tasks)) {
        $task = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM `task_list` WHERE `id` = '{$t['task']}'"));
        if (!$task) continue;
        $progress = min(100, round(($t['progress'] / $task['count']) * 100));
        echo '
        <div class="bdr bg_blue mb5">
            <div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4">
                <div class="ml10 mr10 mt5 mb5 small">
                    <b>'.$task['name'].'</b><br>
                    '.$t['progress'].' / '.$task['count'].'<br>
                    <div class="prg-bar"><div class="prg-blue" style="width: '.$progress.'%;"></div></div>
                    <div class="cntr mt5"><a href="/task.php?id='.$task['id'].'" class="ubtn inbl s green"><span class="ul"><span class="ur">Перейти</span></span></a></div>
                </div>
            </div></div></div></div>
        </div>';
    }
    echo '<div class="hr_g mb2"><div><div></div></div></div>';
}

// --- Баланс ---
echo '
<div class="cntr small lorange">
    <img class="icon" src="/view/image/icons/png/gold.png"> '.n_f($user['g']).' |
    <img class="icon" src="/view/image/icons/png/silver.png"> '.n_f($user['s']).' |
    <img class="icon" src="/view/image/icons/png/keys.png"> '.n_f($user['maze_kluch']).'
</div>
';

// --- Выход ---
echo '<div class="cntr mt10">
    <a class="mbtn red" href="/?exit"><img class="icon" src="/view/image/icons/png/logout.png"> Выйти</a>
</div>';

require_once './system/f.php';
?>
