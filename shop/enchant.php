<?php
include '../system/common.php';
include '../system/functions.php';
include '../system/user.php';
if(!$user){ header('location:/'); exit; }

$title='Хижина чародея';
include '../system/h.php';
echo '<div class="ribbon mb2"><div class="rl"><div class="rr">Хижина чародея</div></div></div>';

$id = _string(_num($_GET['id'])); // inv.id надетой вещи

if($id){
  $inv = mysqli_fetch_assoc(mysqli_query($GLOBALS['mysqli'], "SELECT * FROM `inv` WHERE `user`='".$user['id']."' AND `id`='$id' AND `equip`='1'"));
  if(!$inv){ $_SESSION['mes']=mes('Вещь не одета!'); header('location:/shop/enchant.php'); exit; }

  $item = mysqli_fetch_assoc(mysqli_query($GLOBALS['mysqli'], "SELECT * FROM `items` WHERE `id`='".$inv['item']."'"));
  if(!$item){ $_SESSION['mes']=mes('Ошибка предмета'); header('location:/shop/enchant.php'); exit; }

  $zachar = (int)$inv['zachar']; // текущий уровень чар (как в старом)
  $cost = 200 + $zachar*200;

  if(isset($_GET['start'])){
    if($user['g'] < $cost){
      $_SESSION['mes']=mes('Недостаточно золота!');
      header('location:/shop/enchant.php?id='.$id); exit;
    }
    mysqli_query($GLOBALS['mysqli'], "UPDATE `users` SET `g`=`g`-$cost WHERE `id`='".$user['id']."'");
    mysqli_query($GLOBALS['mysqli'], "UPDATE `inv` SET `zachar`=`zachar`+1 WHERE `id`='".$inv['id']."'");
    $_SESSION['mes']=mes('Уровень чар повышен до '.($zachar+1));
    header('location:/shop/enchant.php'); exit;
  }

  echo '<div class="empty_block"><table width="100%"><tr>
    <td width="15%"><img src="/view/image/items/'.$item['id'].'.png" width="48" height="48"/></td>
    <td><b>'.$item['name'].'</b><br/><small>Уровень чар: '.$zachar.'</small></td>
  </tr></table></div><div class="line"></div>';

  echo '<div class="empty_block cntr">
    <a class="mbtn mb2" href="/shop/enchant.php?id='.$id.'&start=1">
      <img class="icon" src="/view/image/icons/png/gold.png"> Улучшить за '.$cost.'
    </a>
  </div>';

} else {
  $q = mysqli_query($GLOBALS['mysqli'], "SELECT inv.*, items.name AS iname, items.id AS iid FROM `inv` AS inv JOIN `items` AS items ON items.id=inv.item WHERE inv.user='".$user['id']."' AND inv.equip='1'");
  if(!$q || mysqli_num_rows($q)==0){
    echo '<div class="empty_block cntr">Наденьте вещь, чтобы зачаровать её</div>';
  } else {
    while($r = mysqli_fetch_assoc($q)){
      echo '
      <div class="bdr cnr bg_blue mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
        <table width="100%"><tr>
          <td width="15%"><img src="/view/image/items/'.$r['iid'].'.png" width="48" height="48"/></td>
          <td><b>'.$r['iname'].'</b><br/><small>Уровень чар: '.$r['zachar'].'</small></td>
          <td width="1%" align="right"><a class="mbtn mb2" href="/shop/enchant.php?id='.$r['id'].'"><img class="icon" src="/view/image/icons/png/arrow.png"> Выбрать</a></td>
        </tr></table>
      </div></div></div></div></div></div></div></div></div>';
    }
  }
}

echo '<div class="empty_block cntr"><a href="/shop/"><img class="icon" src="/view/image/icons/png/back.png"> Назад</a></div>';
include '../system/f.php';
