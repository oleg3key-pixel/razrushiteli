<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

if (!function_exists('session_status') || session_status() == 0) {
    if (!isset($_SESSION)) {
        session_start();
    }
}
ob_start();

global $mysqli, $user;
if (!isset($user)) $user = null;

// ======== БАЗОВЫЕ ФУНКЦИИ ========

function _string($string) {
    global $mysqli;
    $string = trim($string);
    if ($mysqli) {
        $string = mysqli_real_escape_string($mysqli, $string);
    }
    return htmlspecialchars($string, ENT_QUOTES);
}

function _num($i) {
    return (int)abs($i);
}

function n_f($i) {
    if ($i >= 1000000000000000) return round($i / 1000000000000000, 1) . 'x';
    if ($i >= 1000000000000) return round($i / 1000000000000, 1) . 'v';
    if ($i >= 1000000000) return round($i / 1000000000, 1) . 'g';
    if ($i >= 1000000) return round($i / 1000000, 1) . 'm';
    if ($i >= 1000) return round($i / 1000, 1) . 'k';
    return number_format($i, 0, '', '\'');
}

// ======== СТРАНИЦЫ ========

function page($k_page = 1) {
    $page = 1;
    if (isset($_GET['page'])) {
        if ($_GET['page'] == 'end') $page = intval($k_page);
        elseif (is_numeric($_GET['page'])) $page = intval($_GET['page']);
    }
    if ($page < 1) $page = 1;
    if ($page > $k_page) $page = $k_page;
    return $page;
}

function k_page($k_post = 0, $k_p_str = 10) {
    if ($k_post != 0) {
        return ceil($k_post / $k_p_str);
    } else return 1;
}

// ======== ВРЕМЯ ========

function _time($i) {
    if ($i < 0) $i = 0;
    $d = floor($i / 86400);
    $h = floor(($i % 86400) / 3600);
    $m = floor(($i % 3600) / 60);
    $s = $i % 60;
    return ($d ? $d . 'д ' : '') . ($h ? $h . 'ч ' : '') . ($m ? $m . 'м ' : '') . ($s ? $s . 'с' : '');
}

function _times($i) {
    $d = floor($i / 86400);
    $h = floor(($i % 86400) / 3600);
    $m = floor(($i % 3600) / 60);
    $s = $i % 60;
    if ($d > 0) return $d . ' д';
    if ($h > 0) return $h . ' ч';
    if ($m > 0) return $m . ' мин';
    return $s . ' сек';
}

function vremja($time = null) {
    if (!$time) $time = time();
    $data = date('j.n.y', $time);
    if ($data == date('j.n.y')) return date('G:i', $time);
    if ($data == date('j.n.y', time() - 86400)) return 'Вчера в ' . date('G:i', $time);
    $m = array('', 'Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек');
    return date('j ' . $m[date('n', $time)] . ' в G:i', $time);
}

// ======== BBCode и смайлы ========

function bbcode($msg) {
    $msg = stripslashes($msg);
    $patterns = array(
        '#\[b\](.*?)\[\/b\]#si' => '<b>\1</b>',
        '#\[i\](.*?)\[\/i\]#si' => '<i>\1</i>',
        '#\[u\](.*?)\[\/u\]#si' => '<u>\1</u>',
        '#\[center\](.*?)\[\/center\]#si' => '<center>\1</center>',
        '#\[small\](.*?)\[\/small\]#si' => '<small>\1</small>',
        '#\[red\](.*?)\[\/red\]#si' => '<span style="color:red">\1</span>',
        '#\[lime\](.*?)\[\/lime\]#si' => '<span style="color:lime">\1</span>',
        '#\[blue\](.*?)\[\/blue\]#si' => '<span style="color:blue">\1</span>',
        '#\[yellow\](.*?)\[\/yellow\]#si' => '<span style="color:yellow">\1</span>',
        '#\[orange\](.*?)\[\/orange\]#si' => '<span style="color:orange">\1</span>'
    );
    foreach ($patterns as $pattern => $replace) {
        $msg = preg_replace($pattern, $replace, $msg);
    }
    return nl2br($msg);
}

function smile($msg) {
    $smiles = array(
        ':)' => '1.gif', ':(' => '2.gif', ';)' => '3.gif', ':D' => '4.gif',
        ':-)' => '9.gif', ':p' => '10.gif', ':-o' => '11.gif', ':mad:' => '14.gif'
    );
    foreach ($smiles as $s => $img) {
        $msg = str_replace($s, '<img class="icon" src="/image/icons/smiles/'.$img.'" alt="'.$s.'"/>', $msg);
    }
    return $msg;
}

// ======== РАБОТА С ПОЛЬЗОВАТЕЛЯМИ ========

function nick($id) {
    global $mysqli;
    $id = intval($id);
    $res = mysqli_query($mysqli, "SELECT * FROM `users` WHERE `id` = '$id' LIMIT 1");
    if (!$res) return '[Ошибка SQL]';
    $u = mysqli_fetch_assoc($res);
    if (!$u) return '[Удален]';
    $online = ($u['online'] > time() - 3600);
    $sex = $u['sex'];
    if ($online) {
        $icon = $sex ? '/view/image/icons/png/hero_on_2.png' : '/view/image/icons/png/hero_on_1.png';
    } else {
        $icon = $sex ? '/view/image/icons/png/hero_off_2.png' : '/view/image/icons/png/hero_off_1.png';
    }
    return '<img src="'.$icon.'" class="icon"> <b>'.$u['login'].'</b>';
}

function color($id) {
    global $mysqli;
    $id = intval($id);
    $res = mysqli_query($mysqli, "SELECT `access`, `id` FROM `users` WHERE `id` = '$id' LIMIT 1");
    if (!$res) return '#bce4f4';
    $u = mysqli_fetch_assoc($res);
    if (!$u) return '#bce4f4';
    $map = array(
        0 => '#bce4f4',
        1 => '#eff0a1',
        2 => '#eff0a1',
        3 => '#eff0a1',
        4 => '#eff0a1',
        5 => '#eff0a1'
    );
    if ($u['id'] == 2) return '#B2CDAE';
    return isset($map[$u['access']]) ? $map[$u['access']] : '#bce4f4';
}

// ======== SQL ОБЁРТКА ========

function f($query) {
    global $mysqli;
    $result = mysqli_query($mysqli, $query);
    if (!$result) {
        die('Ошибка SQL: ' . mysqli_error($mysqli));
    }
    return $result;
}
// --- Функция системных сообщений (старый стиль) ---
if (!function_exists('mes')) {
    function mes($text) {
        return '
        <div class="bntf">
            <div class="nl">
                <div class="nr cntr lyell lh1 p5 sh">'.$text.'</div>
            </div>
        </div>';
    }
}

function pages($link) {
    global $page, $pages;
    if ($pages <= 1) return;

    $output = '<div class="pages">';
    if ($page > 1) $output .= '<a href="'.$link.'page='.($page-1).'" class="page">«</a> ';
    for ($i = 1; $i <= $pages; $i++) {
        if ($i == $page)
            $output .= '<span class="page active">'.$i.'</span> ';
        else
            $output .= '<a href="'.$link.'page='.$i.'" class="page">'.$i.'</a> ';
    }
    if ($page < $pages) $output .= '<a href="'.$link.'page='.($page+1).'" class="page">»</a>';
    $output .= '</div>';
    return $output;
}

?>
