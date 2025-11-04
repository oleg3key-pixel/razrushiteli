<?php
include '../system/common.php';
include '../system/functions.php';
include '../system/user.php';
if(!$user){ header('location:/'); exit; }

$title='Торговец рунами';
include '../system/h.php';
echo '<div class="ribbon mb2"><div class="rl"><div class="rr">Торговец рунами</div></div></div>';

// Выбор надетой вещи
$id = _string(_num($_GET['id']));    // inv.id надетой вещи
$rune = _string(_num($_GET['rune'])); // id руны (1..8, как в старом)

if($id){
  $inv = mysqli_fetch_assoc(mysqli_query($GLOBALS['mysqli'], "SELECT * FROM `inv` WHERE `user`='".$user['id']."' AND `id`='$id' AND `equip`='1'"));
  if(!$inv){
    $_SESSION['mes']=mes('Вещь не одета!');
    header('location:/shop/runes.php'); exit;
  }
  $item = mysqli_fetch_assoc(mysqli_query($GLOBALS['mysqli'], "SELECT * FROM `items` WHERE `id`='".$inv['item']."'"));
  if(!$item){
    $_SESSION['mes']=mes('Ошибка предмета');
    header('location:/shop/runes.php'); exit;
  }

  if($rune>=1 && $rune<=8){
    // цены/бонусы как в старом коде
    $runeCost = [1=>100,2=>300,3=>700,4=>1500,5=>3000,6=>6000,7=>12000,8=>25000]; // пример
    $runeBonus= [1=>15, 2=>30, 3=>60, 4=>200, 5=>500, 6=>1000, 7=>1500, 8=>2000];

    $cost = $runeCost[$rune];
    if($user['g'] < $cost){
      $_SESSION['mes']=mes('Недостаточно золота!');
      header('location:/shop/runes.php?id='.$id); exit;
    }

    // Наносим руну на вещь
    mysqli_query($GLOBALS['mysqli'], "UPDATE `inv` SET `rune`='$rune' WHERE `id`='".$inv['id']."'");
    mysqli_query($GLOBALS['mysqli'], "UPDATE `users` SET `g`=`g`-$cost WHERE `id`='".$user['id']."'");

    $_SESSION['mes']=mes('Руна установлена!');
    header('location:/shop/runes.php'); exit;
  }

  // карточка выбранной вещи + выбор руны
  echo '<div class="empty_block">
  <table width="100%"><tr>
    <td width="15%"><img src="/view/image/items/'.$item['id'].'.png" width="48" height="48"/></td>
    <td><b>'.$item['name'].'</b><br/><small>Слот: '.$item['w'].'</small></td>
  </tr></table>
  </div><div class="line"></div>';

  echo '<div class="empty_block cntr">Выберите руну:</div>';
  for($i=1;$i<=8;$i++){
    echo '
    <div class="bdr cnr bg_blue mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
      <table width="100%"><tr>
        <td width="15%"><img src="/view/image/icons/rune/'.$i.'.png" width="35" height="35"/></td>
        <td><b>Руна '.$i.'</b><br/><small>+бонус к параметрам</small></td>
        <td width="1%" align="right"><a class="mbtn mb2" href="/shop/runes.php?id='.$inv['id'].'&rune='.$i.'"><img class="icon" src="/view/image/icons/png/gold.png"> Купить</a></td>
      </tr></table>
    </div></div></div></div></div></div></div></div></div>';
  }

} else {
  // список надетых вещей для выбора
  $q = mysqli_query($GLOBALS['mysqli'], "SELECT inv.*, items.name AS iname, items.id AS iid FROM `inv` AS inv JOIN `items` AS items ON items.id=inv.item WHERE inv.user='".$user['id']."' AND inv.equip='1'");
  if(!$q || mysqli_num_rows($q)==0){
    echo '<div class="empty_block cntr">Наденьте вещь, чтобы установить на неё руну</div>';
  } else {
    while($r = mysqli_fetch_assoc($q)){
      echo '
      <div class="bdr cnr bg_blue mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
        <table width="100%"><tr>
          <td width="15%"><img src="/view/image/items/'.$r['iid'].'.png" width="48" height="48"/></td>
          <td><b>'.$r['iname'].'</b></td>
          <td width="1%" align="right"><a class="mbtn mb2" href="/shop/runes.php?id='.$r['id'].'"><img class="icon" src="/view/image/icons/png/arrow.png"> Выбрать</a></td>
        </tr></table>
      </div></div></div></div></div></div></div></div></div>';
    }
  }
}

echo '<div class="empty_block cntr"><a href="/shop/"><img class="icon" src="/view/image/icons/png/back.png"> Назад</a></div>';
include '../system/f.php';
