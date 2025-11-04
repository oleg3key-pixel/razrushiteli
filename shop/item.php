<?php
include '../system/common.php';
include '../system/functions.php';
include '../system/user.php';
if(!$user){ header('location:/'); exit; }

$id = _string(_num($_GET['id'])); // id записи из shop
$shop = mysqli_fetch_assoc(mysqli_query($GLOBALS['mysqli'], "SELECT * FROM `shop` WHERE `id`='$id'"));
if(!$shop){ header('location:/shop/items.php'); exit; }

$item = mysqli_fetch_assoc(mysqli_query($GLOBALS['mysqli'], "SELECT * FROM `items` WHERE `id`='".$shop['id']."'"));
if(!$item){ header('location:/shop/items.php'); exit; }

$title = $item['name'];
include '../system/h.php';

$mapQ = [1=>'Обычный',2=>'Необычный',3=>'Редкий',4=>'Эпический',5=>'Легендарный',6=>'Мифический',7=>'Реликтовный',8=>'Древний'];
$colorQ=[1=>'#999',2=>'#B1D689',3=>'#6BA0E7',4=>'#C780DB',5=>'#FF8E94',6=>'#FE7E01',7=>'aqua',8=>'#A0522D'];

echo '<div class="title">'.$title.'</div>';
echo '<div class="empty_block"><table width="100%"><tr>
  <td width="15%"><img src="/view/image/items/'.$item['id'].'.png" width="48" height="48"/></td>
  <td>
    <img src="/view/image/icons/quality/'.$item['quality'].'.png" class="icon"/>
    <font color="#fff"> '.$item['name'].' </font><br/>
    <small><font color="#fff"><img class="icon" src="/view/image/icons/png/up.png" width="12"/> '.$item['level'].' ур, </font>
    <font color="'.$colorQ[(int)$item['quality']].'">'.$mapQ[(int)$item['quality']].'</font></small>
  </td>
</tr></table></div><div class="line"></div>';

// Покупка
if(isset($_GET['buy'])){
  // Валюта — как в старом: gold/silver (g/s)
  $cost = (int)$shop['price'];
  $curr = ($shop['currency']=='s' ? 's' : 'g');

  if($user[$curr] < $cost){
    $_SESSION['mes']=mes('Недостаточно '.($curr=='g'?'золота':'серебра').'!');
    header('location:/shop/item.php?id='.$id); exit;
  }

  // Добавляем в инвентарь (equip=0)
  mysqli_query($GLOBALS['mysqli'], "INSERT INTO `inv`(`user`,`item`,`equip`) VALUES ('".$user['id']."','".$item['id']."','0')");
  // Списываем деньги
  mysqli_query($GLOBALS['mysqli'], "UPDATE `users` SET `$curr`=`$curr`-$cost WHERE `id`='".$user['id']."'");

  $_SESSION['mes']=mes('Вещь успешно куплена!');
  header('location:/inv/'); exit;
}

echo '<div class="empty_block cntr">
  <a class="mbtn mb2" href="/shop/item.php?id='.$id.'&buy=1">
    <img class="icon" src="/view/image/icons/png/'.($shop['currency']=='s'?'silver':'gold').'.png">
    Купить за '.$shop['price'].'
  </a>
</div>';

echo '<div class="line"></div><div class="empty_block cntr"><a href="/shop/items.php"><img class="icon" src="/view/image/icons/png/back.png"> Назад</a></div>';
include '../system/f.php';
