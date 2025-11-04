<?php
include '../system/common.php';
include '../system/functions.php';
include '../system/user.php';
if(!$user){ header('location:/'); exit; }

$title = 'Снаряжение';
include '../system/h.php';

echo '<div class="ribbon mb2"><div class="rl"><div class="rr">Снаряжение</div></div></div>';

// Фильтр по качеству, ограничения уровня такие же как в старом shop.php
$quality = _string(_num($_GET['quality']));
if($quality){
  if( ($quality==1 && $user['level']<1) ||
      ($quality==2 && $user['level']<7) ||
      ($quality==3 && $user['level']<12) ||
      ($quality==4 && $user['level']<23) ||
      ($quality==5 && $user['level']<32) ||
      ($quality==6 && $user['level']<44) ||
      ($quality==7 && $user['level']<55) ||
      ($quality==8 && $user['level']<100) ) {
    $_SESSION['mes']=mes('Маленький уровень');
    header('location:/shop/items.php'); exit;
  }
}

$mapQ = [1=>'Обычный',2=>'Необычный',3=>'Редкий',4=>'Эпический',5=>'Легендарный',6=>'Мифический',7=>'Реликтовный',8=>'Древний'];
$colorQ=[1=>'#999',2=>'#B1D689',3=>'#6BA0E7',4=>'#C780DB',5=>'#FF8E94',6=>'#FE7E01',7=>'aqua',8=>'#A0522D'];

// Панель фильтров по качеству
echo '<div class="empty_block cntr">';
foreach($mapQ as $q=>$name){
  $link = '/shop/items.php?quality='.$q;
  $active = ($quality==$q)?' style="text-decoration:underline"':'';
  echo '<a class="mr10" href="'.$link.'"'.$active.'><font color="'.$colorQ[$q].'">'.$name.'</font></a>';
}
echo '</div><div class="line"></div>';

$where = "WHERE `type`='items'";
if($quality) $where .= " AND `quality`='".intval($quality)."'";

// Здесь ожидается, что таблица `shop` хранит записи товаров для магазина,
// и в ней есть: id, id (или id_item) предмета, price, currency (g/s), quality и т.д.
// В твоём старом файле использовались поля `shop.id` и затем брался `items` через `shop['id']`.
// Повторим это поведение:
$q = mysqli_query($GLOBALS['mysqli'], "SELECT * FROM `shop` $where ORDER BY `id` ASC");

if(!$q || mysqli_num_rows($q)==0){
  echo '<div class="empty_block cntr">Нет предметов</div>';
} else {
  while($row = mysqli_fetch_assoc($q)){
    // Старый код: $item = SELECT * FROM items WHERE id = $shop['id']
    $item = mysqli_fetch_assoc(mysqli_query($GLOBALS['mysqli'], "SELECT * FROM `items` WHERE `id` = '".$row['id']."'"));
    if(!$item) continue;

    echo '
    <div class="bdr cnr bg_blue mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
      <table width="100%"><tr>
        <td width="15%"><img src="/view/image/items/'.$item['id'].'.png" width="48" height="48"/></td>
        <td>
          <b>'.$item['name'].'</b><br/>
          <small><img class="icon" src="/view/image/icons/png/up.png" width="12"/> '.$item['level'].' ур, 
          <font color="'.$colorQ[(int)$item['quality']].'">'.$mapQ[(int)$item['quality']].'</font></small>
        </td>
        <td width="1%" align="right">
          <a class="mbtn mb2" href="/shop/item.php?id='.$row['id'].'">
            <img class="icon" src="/view/image/icons/png/arrow.png"/> Подробнее
          </a>
        </td>
      </tr></table>
    </div></div></div></div></div></div></div></div></div>';
  }
}

echo '<div class="empty_block cntr"><a href="/shop/"><img class="icon" src="/view/image/icons/png/back.png"> Назад в магазин</a></div>';
include '../system/f.php';
