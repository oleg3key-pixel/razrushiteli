<?php
include '../system/common.php';
include '../system/functions.php';
include '../system/user.php';
if(!$user){ header('location:/'); exit; }

$title='Премиум-аккаунт';
include '../system/h.php';
echo '<div class="ribbon mb2"><div class="rl"><div class="rr">Премиум-аккаунт</div></div></div>';

$id = _string(_num($_GET['id'])); // тариф 1..6 (как в старом)

$plans = [
  1 => ['cost'=>90,  'days'=>1],
  2 => ['cost'=>250, 'days'=>3],
  3 => ['cost'=>500, 'days'=>7],
  4 => ['cost'=>1200,'days'=>14],
  5 => ['cost'=>2500,'days'=>30],
  6 => ['cost'=>7000,'days'=>90],
];

$premium = mysqli_fetch_assoc(mysqli_query($GLOBALS['mysqli'], "SELECT * FROM `premium` WHERE `user`='".$user['id']."'"));

if($id && isset($plans[$id])){
  $cost = $plans[$id]['cost'];
  $time = 86400 * $plans[$id]['days'];

  if($user['g'] < $cost){
    $_SESSION['mes']=mes('Недостаточно золота!');
    header('location:/shop/premium.php'); exit;
  }

  if($premium){
    mysqli_query($GLOBALS['mysqli'], "UPDATE `users` SET `g`=`g`-$cost WHERE `id`='".$user['id']."'");
    mysqli_query($GLOBALS['mysqli'], "UPDATE `premium` SET `time`=`time`+$time WHERE `user`='".$user['id']."'");
    $_SESSION['mes']=mes('Вы успешно продлили премиум!');
  } else {
    mysqli_query($GLOBALS['mysqli'], "UPDATE `users` SET `g`=`g`-$cost WHERE `id`='".$user['id']."'");
    mysqli_query($GLOBALS['mysqli'], "INSERT INTO `premium` (`user`,`time`) VALUES ('".$user['id']."','".(time()+$time)."')");
    $_SESSION['mes']=mes('Премиум активирован!');
  }
  header('location:/shop/premium.php'); exit;
}

// Вывод тарифов
foreach($plans as $pid=>$p){
  echo '
  <div class="bdr cnr bg_blue mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
    <table width="100%"><tr>
      <td><b>'.$p['days'].' дн.</b></td>
      <td width="1%" align="right"><a class="mbtn mb2" href="/shop/premium.php?id='.$pid.'"><img class="icon" src="/view/image/icons/png/gold.png"> '.$p['cost'].'</a></td>
    </tr></table>
  </div></div></div></div></div></div></div></div></div>';
}

echo '<div class="empty_block cntr"><a href="/shop/"><img class="icon" src="/view/image/icons/png/back.png"> Назад</a></div>';
include '../system/f.php';
