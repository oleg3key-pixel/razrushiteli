<?php
include '../system/common.php';
include '../system/functions.php';
include '../system/user.php';
if(!$user){ header('location:/'); exit; }

$title='Амулеты';
include '../system/h.php';
echo '<div class="ribbon mb2"><div class="rl"><div class="rr">Амулеты</div></div></div>';

$amuletNow = mysqli_fetch_assoc(mysqli_query($GLOBALS['mysqli'], "SELECT * FROM `amulet` WHERE `id`='".$user['amulet']."'"));
$amuletNext= mysqli_fetch_assoc(mysqli_query($GLOBALS['mysqli'], "SELECT * FROM `amulet` WHERE `id`='".($user['amulet']+1)."'"));

if(isset($_GET['buy'])){
  if($user['amulet']>=200){
    $_SESSION['mes']=mes('У вас максимальный уровень амулета!'); header('location:/shop/amulet.php'); exit;
  }
  if($user['g'] < (int)$amuletNext['gold']){
    $_SESSION['mes']=mes('Недостаточно золота!'); header('location:/shop/amulet.php'); exit;
  }

  mysqli_query($GLOBALS['mysqli'], "UPDATE `users` SET `g`=`g`-".$amuletNext['gold']." WHERE `id`='".$user['id']."'");
  mysqli_query($GLOBALS['mysqli'], "UPDATE `users` SET `str`=`str`+".$amuletNext['stat'].", `vit`=`vit`+".$amuletNext['stat'].", `def`=`def`+".$amuletNext['stat'].", `amulet`=`amulet`+1 WHERE `id`='".$user['id']."'");

  $_SESSION['mes']=mes('Амулет улучшен!');
  header('location:/shop/amulet.php'); exit;
}

echo '<div class="empty_block cntr">
Текущий уровень амулета: '.$user['amulet'].'
</div><div class="line"></div>';

if($amuletNext){
  echo '<div class="empty_block cntr">
    <a class="mbtn mb2" href="/shop/amulet.php?buy=1">
      <img class="icon" src="/view/image/icons/png/gold.png"> Улучшить за '.$amuletNext['gold'].'
    </a>
  </div>';
} else {
  echo '<div class="empty_block cntr">Достигнут максимум</div>';
}

echo '<div class="empty_block cntr"><a href="/shop/"><img class="icon" src="/view/image/icons/png/back.png"> Назад</a></div>';
include '../system/f.php';
