<?php
include './system/common.php';
include './system/functions.php';
include './system/user.php';

if(!$user) {
  header('location: /');
  exit;
}

// Безопасно фильтруем ID
$id = _string(_num($_GET['id']));

// Получаем товар из магазина
$shop = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM `shop` WHERE `id` = '$id'"));
if(!$shop) {
  header('location: /');
  exit;
}

// Получаем предмет по ID из shop
$item = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM `items` WHERE `id` = '".$shop['item']."'"));
if(!$item) {
  header('location: /');
  exit;
}

$title = $item['name'];
include './system/h.php';

// Качество
$quality = [
  1=>'Обычный',
  2=>'Необычный',
  3=>'Редкий',
  4=>'Эпический',
  5=>'Легендарный',
  6=>'Мифический'
];
$quality_color = [
  1=>'#999999',
  2=>'#B1D689',
  3=>'#6BA0E7',
  4=>'#C780DB',
  5=>'#FF8E94',
  6=>'#FE7E01'
];
$w = [
  1=>'Голова',
  2=>'Плечи',
  3=>'Торс',
  4=>'Перчатки',
  5=>'Левая рука',
  6=>'Правая рука',
  7=>'Ноги',
  8=>'Обувь'
];

// Отображение
echo '<div class="title">'.$title.'</div>
<div class="empty_block">
<table cellpadding="0" cellspacing="0">
<tr>
  <td width="15%"><img src="/view/image/items/'.$item['id'].'.png" alt="*"/></td>
  <td><img src="/view/image/icons/quality/'.$item['quality'].'.png" alt="*"/> 
  <font color="#fff">'.$item['name'].'</font>
  <br/><small>
    <font color="#'.(($user['level'] < $item['skill']) ? 'c06060' : 'ffffff').'">
      <img src="/view/image/icons/png/up.png" alt="*" width="12"/>'.$item['skill'].' ур, 
    </font>
    <font color="'.$quality_color[$item['quality']].'">'.$quality[$item['quality']].'</font>, '.$w[$item['w']].'
  </small></td>
</tr>
</table>
</div>
<div class="line"></div>
<div class="empty_block">';

// Экипированный предмет
$equip_item = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM `inv` WHERE `id` = '".$user['w_'.$item['w']]."'"));
$diff = 0;

// Сила
echo '<img src="/view/image/icons/png/strength.png" alt="*"/> Сила: <font color="'.($shop['_str'] > $equip_item['_str'] ? '#3c3' : '#c66').'">'.$shop['_str'].'</font><br/>';

// Жизнь
echo '<img src="/view/image/icons/png/health.png" alt="*"/> Здоровье: <font color="'.($shop['_vit'] > $equip_item['_vit'] ? '#3c3' : '#c66').'">'.$shop['_vit'].'</font><br/>';

// Защита
echo '<img src="/view/image/icons/png/defense.png" alt="*"/> Броня: <font color="'.($shop['_def'] > $equip_item['_def'] ? '#3c3' : '#c66').'">'.$shop['_def'].'</font><br/>';

if($shop['_str'] > $equip_item['_str'] || $shop['_vit'] > $equip_item['_vit'] || $shop['_def'] > $equip_item['_def']) {
  $diff = ($shop['_str'] - $equip_item['_str']) + ($shop['_vit'] - $equip_item['_vit']) + ($shop['_def'] - $equip_item['_def']);
  echo '<font color="#3c3">Лучше +'.$diff.'</font>';
}

echo '</div>
<div class="line"></div>
<div class="block_link"><a href="/shop/"><img src="/view/image/icons/png/back.png" alt="*"/> Вернуться </a></div>
<div class="line"></div>';

include './system/f.php';
?>
