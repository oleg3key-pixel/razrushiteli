<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function fatal_handler() {
    $error = error_get_last();
    if ($error !== NULL) {
        echo "<pre style='color:red;'>FATAL ERROR:\n";
        print_r($error);
        echo "</pre>";
    }
}
register_shutdown_function('fatal_handler');

error_reporting(E_ALL);
ini_set('display_errors', 1);

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ob_start();

if (!isset($mysqli)) {
    global $mysqli;
}

if (!isset($user)) $user = null;
if (!isset($totem)) $totem = null;
if (!isset($clan)) $clan = null;

list($msec, $sec) = explode(chr(32), microtime());
$gtime = $sec + $msec;
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="author" content="Overmobile">
    <meta name="keywords" content="уничтожители, онлайн игра, overmobile, mmorpg, фэнтези">
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
    <link rel="icon" href="/view/image/style/favicon.png?1" type="image/png">
    <link rel="stylesheet" href="/view/style/style.css" type="text/css" media="all">
    <script src="/view/js/main.js" type="text/javascript"></script>
    <title>Уничтожители</title>
</head>
<body id="bg">

<?php
// ======== ФУНКЦИИ ========

// Опыт тотема
function texp($level) {
    $table = [
        1=>1,2=>3,3=>6,4=>9,5=>12,6=>15,7=>18,8=>21,9=>24,
        10=>27,11=>50,12=>80,13=>130,14=>200,15=>350,
        16=>500,17=>650,18=>800,19=>950,20=>1200
    ];
    return isset($table[$level]) ? $table[$level] : 0;
}

// Опыт клана
function clan_exp($i) {
    $levels = [
        1=>3000,2=>5800,3=>11000,4=>20100,5=>30940,6=>70320,7=>130460,8=>204490,9=>440080,
        10=>780460,11=>1380080,12=>2402050,13=>4132030,14=>7024900,15=>11801080,16=>19590090,
        17=>32129000,18=>52048090,19=>83278020,20=>13157905,21=>20526040,22=>31610065,23=>48048018,
        24=>72072027,25=>106660695,26=>155730374,27=>224250658,28=>318444034,29=>445802207,30=>601500000
    ];
    return isset($levels[$i]) ? $levels[$i] : 0;
}

// Опыт доблести
function valor_exp($i) {
    $base = 400;
    return $base * pow(1.2, $i);
}

// ======== ТЕЛО СТРАНИЦЫ ========

if ($user) {

    // опыт тотема
    if ($totem) {
        $texp = texp($totem['level']);
        $exp_progress = round(100 / ($texp / max(1, $totem['exp'])));
        if ($exp_progress > 100) $exp_progress = 100;

        if ($totem['level'] < 20 && $totem['exp'] >= $texp) {
            $mysqli->query("UPDATE `totem` SET `level` = `level` + 1, `exp` = 0 WHERE `id` = 1");
        }
    }

    // опыт персонажа
    $exp = 1000 + ($user['level'] * 500);
    $exp_progress = round(100 / ($exp / max(1, $user['exp'])));
    if ($exp_progress > 100) $exp_progress = 100;

    // уровень
    if ($user['level'] < 140 && $user['exp'] >= $exp) {
        $g = $user['level'] * 25;
        $mysqli->query("UPDATE `users` SET `level` = `level` + 1, `exp` = 0, `g` = `g` + $g WHERE `id` = {$user['id']}");
        echo '<div class="bdr bg_blue cntr"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4">
        <font color="#f05010">Вы получили новый уровень!</font><br>
        <font color="#90b0c0">Награда:</font> <img src="/view/image/icons/png/gold.png" width="18"> '.$g.'
        </div></div></div></div></div>';
    }

    // письма
    $res = $mysqli->query("SELECT COUNT(id) AS c FROM `mail` WHERE `to` = '{$user['id']}' AND `read` = '0'");
    $mail = $res ? (int)$res->fetch_assoc()['c'] : 0;

    // отображение характеристик
    echo '
    <div class="cntr small lorange mt5 mb5">
        <img class="icon" src="/view/image/icons/png/strength.png"> '.$user['str'].'
        <img class="icon" src="/view/image/icons/png/health.png"> '.$user['vit'].'
        <img class="icon" src="/view/image/icons/png/defense.png"> '.$user['def'].'
        '.($mail > 0 ? '<a class="fr" href="/mail/"><img src="/view/image/icons/png/post.png"></a>' : '').'
    </div>
    <div class="hr_g mb2"></div>
    <table class="small yell h25 bgc_prg">
      <tr>
        <td class="va_m plr10"><img src="/view/image/icons/png/up.png" height="16"> '.n_f($user['level']).'</td>
        <td class="va_m w100">
          <div class="prg-bar"><div class="prg-blue" style="width: '.$exp_progress.'%;"></div></div>
        </td>
        <td class="va_m plr10">'.$exp_progress.'%</td>
      </tr>
    </table>
    <div class="hr_g mb2"></div>';
}
?>
