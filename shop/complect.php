<?php
// complect.php — покупка наборов экипировки из таблицы `complects`

include './system/common.php';
include './system/functions.php';
include './system/user.php';

if (empty($user)) { header('location: /'); exit; }

// =============== helpers ===============
function qf($sql){ $q = mysql_query($sql); return $q ? $q : false; }
function fa($res){ return $res ? mysql_fetch_array($res) : null; }
function frow($sql){ return fa(qf($sql)); }
function nf($x){ return n_f((int)$x); }

// аккуратно берем int
$id = isset($_GET['id']) ? _num($_GET['id']) : 0;

// ===== страница списка комплектов =====
if ($id <= 0) {
  $title = 'Комплекты';
  include './system/h.php';

  echo '  <div class="ribbon mb2"><div class="rl"><div class="rr">Магазин</div></div></div>';

  echo '<div class="bdr bg_main mb2"><div class="light"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">';
  echo '<div class="yell mlr10 mt5 mb5"><b>Комплекты снаряжения</b></div>';

  $q = qf('SELECT * FROM `complects` ORDER BY `id` ASC');
  while ($row = fa($q)) {
      // посчитаем цену сразу (сумма shop.cost по всем w_1..w_8)
      $sumCost = 0;
      $itemsIds = [];
      for ($w=1; $w<=8; $w++) {
        $iid = (int)$row['w_'.$w];
        if ($iid > 0) { 
          $itemsIds[] = $iid;
          $shop = frow('SELECT `cost` FROM `shop` WHERE `id` = "'.$iid.'"');
          if ($shop) $sumCost += (int)$shop['cost'];
        }
      }

      // небольшая строка мини-иконок
      $icons = '';
      foreach ($itemsIds as $iid) {
        $path = '/view/image/items/'.$iid.'.png';
        $icons .= '<img src="'.$path.'" width="22" height="22" class="icon" style="margin-right:2px" alt="">';
      }

      echo '
      <div class="empty_block">
        <table cellpadding="0" cellspacing="0" width="100%">
          <tr>
            <td width="48">
              <img src="/view/image/icons/quality/'.(int)$row['quality'].'.png" width="24" height="24" class="icon" alt="*">
            </td>
            <td>
              <a class="tdn lwhite" href="/complect/'.$row['id'].'/"><b>'.$row['name'].'</b></a><br>
              <small>'.$icons.'</small>
            </td>
            <td style="text-align:right; white-space:nowrap;">
              <img class="icon" src="/view/image/icons/png/gold.png"> <b>'.nf($sumCost).'</b>
              <div><a class="tdn lwhite" href="/complect/'.$row['id'].'/"><u>Подробнее</u></a></div>
            </td>
          </tr>
        </table>
      </div>
      <div class="line"></div>
      ';
  }

  echo '</div></div></div></div></div></div></div></div></div>';
  echo '<div class="block_link"><a class="mbtn mb2" href="/shop/"><img class="icon" src="/view/image/icons/png/back.png"> Назад в магазин</a></div>';
  include './system/f.php';
  exit;
}

// ===== страница одного комплекта =====
$set = frow('SELECT * FROM `complects` WHERE `id` = "'.$id.'" LIMIT 1');
if (!$set) { header('location: /complect/'); exit; }

$title = $set['name'];
include './system/h.php';

echo '  <div class="ribbon mb2"><div class="rl"><div class="rr">'.$title.'</div></div></div>';

// Собираем список предметов, их метаданные и цены
$items = [];
$totalCost = 0;
$minReqLevel = 0;
for ($w=1; $w<=8; $w++) {
  $iid = (int)$set['w_'.$w];
  if ($iid <= 0) continue;

  $it  = frow('SELECT * FROM `items` WHERE `id` = "'.$iid.'" LIMIT 1');
  $shop= frow('SELECT * FROM `shop`  WHERE `id` = "'.$iid.'" LIMIT 1');

  if (!$it || !$shop) continue;

  $items[] = [
    'slot'   => $w,
    'id'     => $iid,
    'name'   => $it['name'],
    'quality'=> (int)$it['quality'],
    'level'  => (int)$it['level'],
    'cost'   => (int)$shop['cost'],
    '_str'   => (int)$shop['str'],
    '_vit'   => (int)$shop['vit'],
    '_def'   => (int)$shop['def'],
  ];
  $totalCost += (int)$shop['cost'];
  if ($it['level'] > $minReqLevel) $minReqLevel = (int)$it['level'];
}

// обработка покупки
if (isset($_GET['buy']) && $_GET['buy'] == '1') {

  // проверка уровня на каждый предмет
  $levelOk = true;
  foreach ($items as $it) {
    if ($user['level'] < $it['level']) { $levelOk = false; break; }
  }

  if (!$levelOk) {
    echo mes('<b><font color=red>Недостаточный уровень.</font></b> Для некоторых предметов требуется уровень не ниже <b>'.$minReqLevel.'</b>.');
  } else if ($user['g'] < $totalCost) {
    echo mes('<b><font color=red>Недостаточно золота.</font></b> Нужно <img class=icon src=/view/image/icons/png/gold.png> '.nf($totalCost).'.');
  } else {
    // списываем золото
    qf('UPDATE `users` SET `g` = `g` - '.$totalCost.' WHERE `id` = "'.$user['id'].'" LIMIT 1');

    // добавляем вещи в инвентарь
    foreach ($items as $it) {
      // по твоей базе в инв есть поля _str/_vit/_def, equip, new, rune/zachar/smith — заполним нулями
      // если в конкретной базе некоторых полей нет, можно будет убрать из списка
      qf('INSERT INTO `inv` 
          (`user`,`item`,`_str`,`_vit`,`_def`,`equip`,`zachar`,`rune`,`smith`,`new`) 
          VALUES 
          ("'.$user['id'].'","'.$it['id'].'","'.$it['_str'].'","'.$it['_vit'].'","'.$it['_def'].'","0","0","0","0","0")');
    }

    echo mes('<b><font color=lime>Комплект куплен!</font></b> Все предметы добавлены в <a class=tdn lwhite href="/inv/"><u>сумку</u></a>.');
    // обновим деньги в текущей сессии (если используется $user из include, он не обновится сам)
    $user = frow('SELECT * FROM `users` WHERE `id` = "'.$user['id'].'" LIMIT 1');
  }
}

// шапка и требования
echo '<div class="bdr bg_main mb2"><div class="light"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">';
echo '<div class="empty_block"><b>'.$set['name'].'</b><br><small>Требуемый уровень: '.$minReqLevel.'+</small></div>';
echo '<div class="line"></div>';

// список предметов комплекта
foreach ($items as $it) {

  $slotNames = [1=>'Голова',2=>'Плечи',3=>'Торс',4=>'Перчатки',5=>'Левая рука',6=>'Правая рука',7=>'Ноги',8=>'Обувь'];
  $slotTitle = isset($slotNames[$it['slot']]) ? $slotNames[$it['slot']] : ('Слот '.$it['slot']);

  echo '
    <div class="empty_block">
      <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
          <td width="52">
            <img src="/view/image/items/'.$it['id'].'.png" width="48" height="48" alt="">
          </td>
          <td>
            <b>'.$it['name'].'</b> <small>(ур. '.$it['level'].', '.$slotTitle.')</small><br>
            <small>
              <img class="icon" src="/view/image/icons/png/attack.png"> '.$it['_str'].' 
              <img class="icon" src="/view/image/icons/png/health.png"> '.$it['_vit'].' 
              <img class="icon" src="/view/image/icons/png/defense.png"> '.$it['_def'].'
            </small>
          </td>
          <td style="text-align:right; white-space:nowrap;">
            <img class="icon" src="/view/image/icons/png/gold.png"> '.nf($it['cost']).'
          </td>
        </tr>
      </table>
    </div>
    <div class="line"></div>
  ';
}

echo '
  <div class="empty_block" style="text-align:right">
    Итого: <img class="icon" src="/view/image/icons/png/gold.png"> <b>'.nf($totalCost).'</b>
  </div>
';

echo '</div></div></div></div></div></div></div></div></div>';

// кнопки
echo '<div class="block_link"><a class="mbtn mb2" href="/complect/"><img class="icon" src="/view/image/icons/png/back.png"> Все комплекты</a></div>';

$canBuy = ($user['g'] >= $totalCost && $user['level'] >= $minReqLevel);
echo '<div class="block_link"><a class="mbtn mb2'.($canBuy?'':' dis').'" href="/complect/'.$set['id'].'/?buy=1">
<img class="icon" src="/view/image/icons/png/shop.png"> Купить комплект</a></div>';

include './system/f.php';
?>
