<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', 1);

include '../system/common.php';
include '../system/functions.php';
include '../system/user.php';

if(!$user) {
    header('Location: /');
    exit;
}

$title = 'Магазин';
include '../system/h.php';

// Заголовок
echo '
<div class="ribbon mb2"><div class="rl"><div class="rr">Магазин</div></div></div>';

// Категории магазина
$cats = [
    ['/view/image/icons/shop/items.png',    'Снаряжение',       'лучшее оружие и доспехи',       '/shop/items.php'],
    ['/view/image/icons/shop/complect.png', 'Комплекты',        'готовые наборы экипировки',     '/shop/complect.php'],
    ['/view/image/icons/shop/amulet.png',   'Амулеты',          'для арены и подземелий',        '/shop/amulet.php'],
    ['/view/image/icons/shop/runes.png',    'Торговец рунами',  'установка рун на вещи',         '/shop/runes.php'],
    ['/view/image/icons/shop/enchant.png',  'Хижина чародея',   'наложение чар на вещи',         '/shop/enchant.php'],
    ['/view/image/icons/shop/smith.png',    'Кузнец',           'заточка вещей',                 '/shop/smith.php'],
    ['/view/image/icons/shop/skills.png',   'Умения',           'боевые умения',                 '/ability/'.$user['id'].'/'],
    ['/view/image/icons/shop/premium.png',  'Премиум-аккаунт',  'уникальные бонусы',             '/shop/premium.php']
];

// Вывод категорий
foreach ($cats as $c) {
    $icon  = $c[0];
    $title = $c[1];
    $desc  = $c[2];
    $link  = $c[3];

    echo '
    <div class="bdr cnr bg_blue mb2">
        <div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4">
        <div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
            <a href="'.$link.'">
                <table width="100%">
                    <tr>
                        <td width="15%"><img src="'.$icon.'" width="48" height="48" alt="*"></td>
                        <td>
                            <b>'.$title.'</b><br>
                            <small>'.$desc.'</small>
                        </td>
                        <td width="5%" align="right">
                            <img src="/view/image/icons/png/arrow.png" width="16" alt="→">
                        </td>
                    </tr>
                </table>
            </a>
        </div></div></div></div></div></div></div></div>
    ';
}

// Кнопка назад
echo '
<div class="empty_block cntr">
    <a href="/"><img class="icon" src="/view/image/icons/png/back.png" alt="*"> На главную</a>
</div>
';

include '../system/f.php';
?>
