<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user){

  header('location: /');
    
exit;

}

switch($_GET['action']) {
  default:

    $title = 'Кузница';    

include './system/h.php';  

?><div class="main">

<div class='title'><?=$title?></div>
 <div class='line'></div>
<div class='menu'>
  <center><img src='/images/town/smith.png' alt='*'/></center>
  <center><font color='#9bc'>В кузнице можно улучшить свое снаряжение</font></center>
</div>
 <div class='line'></div>
<div class='list'>
  <a href='/smith/runes/'><img src='/images/icon/rune.png' alt='*'/> Торговец рунами</a><br/><small>Улучшение вещей с помощью рун</small><hr>
 <a href='/smith/smith/'><img src='/images/icon/smith.png' alt='*'/> Заточка вещей</a><br/><small>Требуются ресурсы</small><hr>
  <a href='/smith/bonus/'><img src='/images/icon/smith.png' alt='*'/> Бонус вещей</a><br/><small>Улучшение бонуса вещей</small>
</div>

<?
  
include './system/f.php';

  break;
  
  case 'runes':

    $title = 'Торговец рунами';    

include './system/h.php';  

?>

<div class='title'><?=$title?></div>
 <div class='line'></div>

<?

$id = _string(_num($_GET['id']));


/*
Добавить вот этот код
*/
  $_listGet = array(1 => 75, 2 => 150, 3 => 250, 4 => 600, 5 => 1000);
  

if($id) {
/*
Заменить вот этот код
*/
  $inv = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$id.'" AND `equip` != "10" AND `rune` < 6');
  $inv = mysql_fetch_array($inv);
 
  if(!$inv) {

    header('location: /smith/runes/');
    
  exit;

  }
 
  $item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$inv['item'].'"');    
  $item = mysql_fetch_array($item);

    switch($item['w']) {
    
      case 1:
      $rune_stat = 'str';
      $stat = 'силе';
       break;
      case 2:
      $rune_stat = 'vit'; 
      $stat = 'жизни';
       break;
      case 3:
      $rune_stat = 'def'; 
      $stat = 'броне';
       break;
      case 4:
      $rune_stat = 'agi'; 
      $stat = 'удаче';
       break;
      case 5:
      $rune_stat = 'str'; 
      $stat = 'силе';
       break;
      case 6:
      $rune_stat = 'str'; 
      $stat = 'силе';
       break;
      case 7:
      $rune_stat = 'def'; 
      $stat = 'броне';
       break;
      case 8:
      $rune_stat = 'vit'; 
      $stat = 'жизни';
       break;

    }

$rune = _string(_num($_GET['rune']));
  if($rune && $rune > 0 && $rune < 6) {
  
    switch($rune) {
      case 1:
           $cost = 75;
     $rune_stats = 75;
       break;
      case 2:
           $cost = 400;
     $rune_stats = 150;
       break;
      case 3:
           $cost = 1600;
     $rune_stats = 250;
       break;
      case 4:
           $cost = 10000;
     $rune_stats = 600;
       break;
      case 5:
           $cost = 25000;
     $rune_stats = 1000;
       break;
    }
  
  /*
Заменить вот этот код
*/
  
  if($cost && $inv['rune'] < $rune && $user['g'] >= $cost) {
	  
	  		  $_arrq = array(1 => 75, 2=> 150, 3=> 250, 4=> 600, 5=> 1000);
			  
	  if($inv['rune'] > 0) {
		  
		  
		  		  mysql_query('UPDATE `inv` SET `_'.$rune_stat.'` = "'.($inv['_'.$rune_stat] - $_arrq[$inv['rune']]).'", `rune` = "0"   WHERE `id` = "'.$inv['id'].'"');
						exit(header('Location: /smith/runes/'.$inv['id'].'/'.($inv['rune'] + 1).'/'));
	  	
		
	  }else{
		  			  mysql_query('UPDATE `inv`   SET `_'.$rune_stat.'` = "'.($inv['_'.$rune_stat] + $rune_stats).'",
                                               `rune` = "'.$rune.'" WHERE `id` = "'.$inv['id'].'"');
			if($inv[equip]==1) {	
mysql_query("UPDATE `users` SET `".$rune_stat."` = `".$rune_stat."` + '".$rune_stats."'  WHERE `id` = ".$user[id]."");
}						   
	if($user['g'] > $cost) {										    mysql_query('UPDATE `users` SET `g` = "'.($user['g'] - $cost).'" WHERE `id` = "'.$user['id'].'"');
											   
			}	
$_SESSION['msg'] = '<center><img src="/images/icon/ok.png">Руна установлена</center>';		exit(header('Location: /item/'.$inv['id'].'/'));

		  
	  }

    
  
  }
  else
  {
  
  
  }
  
  }


/*
Заменить вот этот код
*/
?>

<div class='content'>
<table cellpadding='0' cellspacing='0'>
<tr>
  <td><img src='/itemImage.php?id=<?=$item['id']?>&smith=<?=$inv['smith']?>' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><img src='/images/icon/quality/<?=$item['quality']?>.png' alt="*"/> <a href='/item/<?=$inv['id']?>/'><?=$item['name']?></a><br/>
  <?
  if($inv['rune'] > 0) {
	  ?>
	  <img src='/images/icon/rune.png' alt='*'/> Руна: <?=($inv['rune'] ? '<img src="/images/icon/quality/'.$inv['rune'].'.png" alt="*"/> <font color="#9c9">+'.$_listGet[$inv['rune']].'</font> '.$stat:'<font color="#999">отсутствует</font>')?><br/>
	  <?
  }
  ?>
  </td></tr></table>
  </div><div class='line'></div>

<div class='menu'>

<?

  for($i = 1; $i < 6; $i++) {

  switch($i) {
    case 1:
      $quality = 'Обычное качество'; 
$quality_color = "#6c3";
         $cost = 75;
   $rune_stats = 75;
     break;
    case 2:
      $quality = 'Редкое качество'; 
$quality_color = "#69c";
         $cost = 400;
   $rune_stats = 150;
     break;
    case 3:
      $quality = 'Эпическое качество'; 
$quality_color = "#c6f";
         $cost = 1600;
   $rune_stats = 250;
     break;
    case 4:
      $quality = 'Легендарное качество'; 
$quality_color = "#f60";
         $cost = 10000;
   $rune_stats = 600;
     break;
    case 5:
      $quality = 'Божественное качество'; 
$quality_color = "#999";
         $cost = 25000;
   $rune_stats = 1000;
     break;
  }

/*
Заменить вот этот код
*/
  if($inv['rune'] < $i) {
?>

  <table cellpadding='0' cellspacing='0'>
  <tr>
  <td><img src='/images/runes/<?=$rune_stat?>.png' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><img src='/images/icon/quality/<?=$i?>.png' alt='*'/> <font color='<?=$quality_color?>'><?=$quality?></font>
  <br/>
  Бонус: <img src='/images/icon/<?=$rune_stat?>.png' alt='*'/> <font color='#9c9'>+<?=$rune_stats?></font> к <?=$stat?>
  </td></tr></table>
  <br/>
  <center><span class='btn'><span class='end'><a class='label' href='/smith/runes/<?=$inv['id']?>/<?=$i?>/'>Купить за <img src='/images/icon/gold.png' alt='*'/> <?=$cost?> золота</a></span></span></center>

<?
  }

  }
  
?>

  
</div>

<?

}
else
{

?>

<div class='menu'>

  <center><img src='/images/town/rune.png' alt='*'/></center>
  <center><font color='#9bc'>Магические свойства рун улучшат ваши вещи!</font></center>

</div><div class='line'></div>

<?
/*
Заменить вот этот код
*/
    $q = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `equip` = "0" AND `rune` < 6');
$items = mysql_result($q,0);

  if($items > 0) {

?>

<div class='menu'>

<?
/*
Заменить вот этот код
*/
$q = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `rune` < 6');

  while($row = mysql_fetch_array($q)) {

  $item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$row['item'].'"');
  $item = mysql_fetch_array($item);

?>

<table cellpadding='0' cellspacing='0'>
<tr>
  <td><img src='/itemImage.php?id=<?=$row['item']?>&smith=<?=$row['smith']?>' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><img src='/images/icon/quality/<?=$item['quality']?>.png' alt='*'/> <a href='/item/<?=$row['id']?>/'><?=$item['name']?></a>

<?

  switch($item['quality']) {
    case 0:
  $bonus = 0;
      $quality = 'Простой';
$quality_color = "#986";
     break;
    case 1:
  $bonus = 5;
      $quality = 'Обычный';
$quality_color = "#6c3";
     break;

    case 2:
 $bonus = 10;
      $quality = 'Редкий';
$quality_color = "#69c";
     break;

    case 3:
 $bonus = 15;
 
      $quality = 'Эпический';
$quality_color = "#c6f";
     break;

    case 4:
 $bonus = 20;
 
      $quality = 'Легенарный';
$quality_color = "#f60";
     break;


    case 5:
 $bonus = 50;
      $quality = 'Божественный';
$quality_color = "#999";
     break;


    case 6:
 $bonus = 65; 
      $quality = 'Сверх Божественный';
$quality_color = "#999";
     break;

  }

?>

<br/>
<small><font color="<?=$quality_color?>"><?=$quality?> [<?=$row['bonus']?>/<?=$bonus?>]</font></small>
  <?
  if($row['rune'] > 0) {
	  ?>
	  <br /><img src='/images/icon/rune.png' alt='*'/> Руна: <img src="/images/icon/quality/<?=$row['rune'];?>.png" alt="*"/> <font color="#9c9">+<?=$_listGet[$row['rune']];?></font> <?=$stat;?><br/>
	  <?
  }
  ?>
  </td></tr></table><br/>
  
  <div align='center'><a href='/smith/runes/<?=$row['id']?>/' class='button'>Выбрать</a></div>

<?

  }

?>

 

</div>

<?

  }
  else
  {
  
?>

<div class='content' align='center'>
У вас нет подходящих вещей для <img src='/images/icon/rune.png' alt='*'/> Улучшения<br/>
Вещи можно купить в <img src='/images/icon/equip.png' alt='*'/> <a>Магазине</a><br/><br/>
<a href='/shop.php' class='button'>Магазин снаряжения</a>
</div>

<?
  
  }

}

include './system/f.php';

  break;

  case 'bonus':

    $title = 'Увеличение бонуса вещей';    

include './system/h.php';  

?>

<div class='title'><?=$title?></div>
 <div class='line'></div>

<?

$id = _string(_num($_GET['id']));

if($id) {

  $inv = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$id.'" AND `equip` != "10"');
  $inv = mysql_fetch_array($inv);
 
  if(!$inv) {

    header('location: /');
    
  exit;

  }
 
  $item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$inv['item'].'"');    
  $item = mysql_fetch_array($item);

  switch($item['quality']) {
    case 0:
  $bonus = 0;
      $quality = 'Простой';
$quality_color = "#986";
      $cost = 0;
     break;
    case 1:
  $bonus = 5;
      $quality = 'Обычный';
$quality_color = "#6c3";
    if($inv['bonus'] == 0) {
      $cost = 5;
    }
    else
    {
      $cost = $inv['bonus'] * 5;
    }

     break;

    case 2:
 $bonus = 10;
      $quality = 'Редкий';
$quality_color = "#69c";
    if($inv['bonus'] == 0) {
      $cost = 5;
    }
    else
    {
      $cost = $inv['bonus'] * 5;
    }
     break;

    case 3:
 $bonus = 15;
 
      $quality = 'Эпический';
$quality_color = "#c6f";

    if($inv['bonus'] == 10) {
      $cost = 100;
    }
    else
    {
      $cost = ($inv['bonus'] - 10) * 100;
    }    

     break;

    case 4:
 $bonus = 20;
 
      $quality = 'Легенарный';
$quality_color = "#f60";

    if($inv['bonus'] == 10) {
      $cost = 100;
    }
    else
    {
      $cost = ($inv['bonus'] - 10) * 100;
    }    

     break;


    case 5:
 $bonus = 50;
      $quality = 'Божественный';
$quality_color = "#999";
    if($inv['bonus'] == 10) {
      $cost = 100;
    }
    else
    {
      $cost = ($inv['bonus'] - 10) * 100;
    }    

     break;


    case 6:
 $bonus = 65; 
      $quality = 'Сверх Божественный';
$quality_color = "#999";
    if($inv['bonus'] == 10) {
      $cost = 100;
    }
    else
    {
      $cost = 100 + ($inv['bonus'] - 10) * 100;
    }    
     break;

  }
  
  if($inv['bonus'] == $bonus) {
    
    header('location: /smith/bonus/');
  
  exit;
  
  }

?>

<div class='content'>
<table cellpadding='0' cellspacing='0'>
<tr>
  <td><img src='/itemImage.php?id=<?=$item['id']?>&smith=<?=$inv['smith']?>' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><img src='/images/icon/quality/<?=$item['quality']?>.png' alt="*"/> <a href='/item/<?=$inv['id']?>/'><?=$item['name']?></a><br/>
  <small><font color="<?=$quality_color?>"><?=$quality?> [<?=$inv['bonus']?>/<?=$bonus?>]</font></small>
  </td></tr></table>
  </div><div class='line'></div>

<div class='content'>
<img src='/images/icon/quality/<?=$item['quality']?>.png' alt="*"/> Бонус вещи: [<?=$inv['bonus']?>/<?=$bonus?>]
</div>

<?

if($_GET['do'] == true && $user['g'] >= $cost) {

$_bonus = 0;

  switch($item['quality']) {
        case 0:
       $_bonus += 0;
        break;
        case 1:
       $_bonus += 4.8;
        break;
        case 2:
       $_bonus += 6;
        break;
        case 3:
       $_bonus +=6.8;
        break;
        case 4:
       $_bonus += 8;
        break;
        case 5:
       $_bonus += 16;
        break;
        case 6:
       $_bonus += 16;
        break;
      }

  mysql_query('UPDATE `users` SET `g` = "'.($user['g'] - $cost).'" WHERE `id` = "'.$user['id'].'"');
mysql_query('UPDATE `inv` SET `bonus` = `bonus` + 1,
                               `_str` = "'.($inv['_str'] + $_bonus).'",
                               `_vit` = "'.($inv['_vit'] + $_bonus).'",
                               `_agi` = "'.($inv['_agi'] + $_bonus).'",
                               `_def` = "'.($inv['_def'] + $_bonus).'" WHERE `id` = "'.$inv['id'].'"');
if($inv[equip] == 1) {
mysql_query("UPDATE `users` SET `str` = `str` + '".$_bonus."',`vit` = `vit` + '".$_bonus."',`agi` = `agi` + '".$_bonus."',`def` = `def` + '".$_bonus."' WHERE `id` = ".$user[id]."");
}
  header('location: /item/'.$inv['id'].'/');

}

?>

<div class='line'></div>
<div class='content' align='center'>

  <a href='/smith/bonus/<?=$id?>/?do=true' class='button'>Улучшить за <img src='/images/icon/gold.png' alt='*'/> <?=$cost?></a>

</div>

<?

}
else
{

?>

<div class='content' align='center'>
<font color='#9bc'>Каждая единица бонуса дает +5% к параметрам вещи</font>
</div><div class='line'></div>

<?

    $q = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `equip` = "0"');
$items = mysql_result($q,0);

  if($items > 0) {

?>

<div class='menu'>

<?
  
  $i = 0;
  
$q = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'"');

  while($row = mysql_fetch_array($q)) {

  $item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$row['item'].'"');
  $item = mysql_fetch_array($item);

  switch($item['quality']) {
    case 0:
  $bonus = 0;
      $quality = 'Простой';
$quality_color = "#986";
     break;
    case 1:
  $bonus = 5;
      $quality = 'Обычный';
$quality_color = "#6c3";
     break;

    case 2:
 $bonus = 10;
      $quality = 'Редкий';
$quality_color = "#69c";
     break;

    case 3:
 $bonus = 15;
 
      $quality = 'Эпический';
$quality_color = "#c6f";
     break;

    case 4:
 $bonus = 20;
 
      $quality = 'Легенарный';
$quality_color = "#f60";
     break;


    case 5:
 $bonus = 50;
      $quality = 'Божественный';
$quality_color = "#999";
     break;


    case 6:
 $bonus = 65; 
      $quality = 'Сверх Божественный';
$quality_color = "#999";
     break;

  }

  if($row['bonus'] < $bonus) {
  
  $i++;

?>

<li><table cellpadding='0' cellspacing='0'>
<tr>
  <td><img src='/itemImage.php?id=<?=$row['item']?>&smith=<?=$row['smith']?>' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><img src='/images/icon/quality/<?=$item['quality']?>.png' alt='*'/> <a href='/item/<?=$row['id']?>/'><?=$item['name']?></a>
<br/>
<small><font color="<?=$quality_color?>"><?=$quality?> [<?=$row['bonus']?>/<?=$bonus?>]</font></small>
  </td></tr></table><br/>
  
  <div align='center'><a href='/smith/bonus/<?=$row['id']?>/' class='button'>Выбрать</a></div>
</li>

<?

  }

  }

  if($i == 0) {

?>

<li align='center'><font color='#909090'>Подходящих вещей нет</font></li>

<?
  
  }

?>


  <li class='no_b'></li>

</div>

<?

  }
  else
  {
  
?>

<div class='content' align='center'>
<font color='#999'>Подходящих вещей нет!</font>
</div>

<?
  
  }

}

include './system/f.php';

  break;

  case 'smith':

    $title = 'Повышение заточки';    

include './system/h.php';  

?>
<?
if(isset($_SESSION['ud'])){
echo smiles($_SESSION['ud']);
unset($_SESSION['ud']);
}
?>
<?
if(isset($_SESSION['msg'])){
echo smiles($_SESSION['msg']);
unset($_SESSION['msg']);
}
?>



<?
if(isset($_SESSION['ude'])){
echo smiles($_SESSION['ude']);
unset($_SESSION['ude']);
}
?>

<div class='title'><?=$title?></div>

<?

$id = _string(_num($_GET['id']));

if($id) {

  $inv = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `id` = "'.$id.'" AND `equip` != "10" AND `smith` < 20');
  $inv = mysql_fetch_array($inv);
 
  if(!$inv) {

    header('location: /smith/smith/');
    
  exit;

  }
 
  $item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$inv['item'].'"');    
  $item = mysql_fetch_array($item);

  switch($item['quality']) {
    case 0:
  $bonus = 0;
      $quality = 'Простой';
$quality_color = "#986";
     break;
    case 1:
  $bonus = 5;
      $quality = 'Обычный';
$quality_color = "#6c3";
     break;

    case 2:
 $bonus = 10;
      $quality = 'Редкий';
$quality_color = "#69c";
     break;

    case 3:
 $bonus = 15;
 
      $quality = 'Эпический';
$quality_color = "#c6f";
     break;

    case 4:
 $bonus = 20;
 
      $quality = 'Легенарный';
$quality_color = "#f60";
     break;


    case 5:
 $bonus = 50;
      $quality = 'Божественный';
$quality_color = "#999";
     break;


    case 6:
 $bonus = 65; 
      $quality = 'Сверх Божественный';
$quality_color = "#999";
     break;

  }





  switch($inv['smith']) {
    case 0:
    $chanse = 90;
     $smith = 24;

     break;
    case 1:
    $chanse = 85;
     $smith = 28;

     break;
    case 2:
    $chanse = 80;
     $smith = 32;

     break;
    case 3:
    $chanse = 75;
     $smith = 36;
     break;
    case 4:
    $chanse = 70;
     $smith = 40;
     break;
    case 5:
    $chanse = 65;
     $smith = 44;
     break;
    case 6:
    $chanse = 60;
     $smith = 48;
     break;
    case 7:
    $chanse = 55;
     $smith = 52;
     break;
    case 8:
    $chanse = 50;
     $smith = 56;
     break;
    case 9:
    $chanse = 45;
     $smith = 60;
     break;
    case 10:
    $chanse = 40;
     $smith = 64;
     break;
    case 11:
    $chanse = 35;
     $smith = 68;
     break;
    case 12:
    $chanse = 30;
     $smith = 72;
     break;
    case 13:
    $chanse = 25;
     $smith = 76;
     break;
    case 14:
    $chanse = 20;
     $smith = 80;
     break;
    case 15:
    $chanse = 20;
     $smith = 84;
     break;
    case 16:
    $chanse = 20;
     $smith = 88;
     break;
    case 17:
    $chanse = 20;
     $smith = 92;
     break;
    case 18:
    $chanse = 20;
     $smith = 96;
     break;
    case 19:
    $chanse = 20;
     $smith =100;
     break;
  }


    $res_1 = 1 + $inv['smith'];
    $res_2 = 2 + ($inv['smith'] * 2);
    $res_3 = 2 + ($inv['smith'] * 2);
    $res_4 = 2 + ($inv['smith'] * 2);
    $res_5 = 2 + ($inv['smith'] * 2);
      
    $s = 1000 + ($inv['smith'] * 1000);

    $sack = mysql_query('SELECT * FROM `sack` WHERE `user` = "'.$user['id'].'"');      
    $sack = mysql_fetch_array($sack);

  if($_GET['start'] == true) {
  
    if($sack[1] < $res_1 OR $sack[2] < $res_2 OR $sack[3] < $res_3 OR $sack[4] < $res_4 OR $sack[5] < $res_5) {
    
      header('location: /smith/smith/'.$inv['id'].'/');
    
    exit;
    
    }
  
    mysql_query('UPDATE `sack` SET `1` = `1` - '.$res_1.',
                                   `2` = `2` - '.$res_2.',
                                   `3` = `3` - '.$res_3.',
                                   `4` = `4` - '.$res_4.',
                                   `5` = `5` - '.$res_5.' WHERE `user` = "'.$user['id'].'"');

   
    header('location:?');
?>

<div class='block'>

<?

  if(rand(1,100) < $chanse) {

mysql_query('UPDATE `inv` SET `smith` = `smith` + 1,
                               `_str` = "'.($inv['_str'] + $smith).'",
                               `_vit` = "'.($inv['_vit'] + $smith).'",
                               `_agi` = "'.($inv['_agi'] + $smith).'",
                               `_def` = "'.($inv['_def'] + $smith).'" WHERE `id` = "'.$inv['id'].'"');
if($inv[equip] == 1) {
mysql_query("UPDATE `users` SET `str` = `str` + '".($smith / 4)."',`def` = `def` + '".($smith / 4)."',`agi` = `agi` + '".($smith / 4)."',`vit` = `vit` + '".($smith / 4)."' WHERE `id` = ".$user[id]."");
}
?>
<?
$_SESSION['ud']=
"<center>
  <font color='#90c090'><b>Удача!</b></font>
 <div class='pvp_fon'></div>
  Вещь заточилась<br/>
  <font color='#90c090'>+ $smith</font> к параметрам вещи</center>";
?>
<?
  
  }
  else
  {

?>
<?
$_SESSION['ude']=
"<center>
  <font color='#c06060'><b>Неудача!</b></font></center><br/>";

?>

<? 
  
  }

?>


</div>

<?

  }
  else
  {
  
?>

 <div class='line'></div>

<?
  
  }

?>

<div class='pvp_fon'>
<table cellpadding='0' cellspacing='0'>
<tr>
  <td><img src='/itemImage.php?id=<?=$item['id']?>&smith=<?=$inv['smith']?>' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><img src='/images/icon/quality/<?=$item['quality']?>.png' alt="*"/> <a href='/item/<?=$inv['id']?>/'><?=$item['name']?></a>

<?
  if($inv['smith'] > 0) {
?>  

<font color='#9c9'>+<?=$inv['smith']?></font>

<?

  }

?>
  
  <br/>
  <small><font color="<?=$quality_color?>"><?=$quality?> [<?=$inv['bonus']?>/<?=$bonus?>]</font></small>
  </td></tr></table>
  </div><div class='line'></div>

  <div class='pvp_fon'>
  
  <div align='center'>Шанс заточить до <font color='#90c090'>+<?=($inv['smith'] + 1)?></font>: <?=$chanse?>%<br/>
  <font color='#90c090'>+<?=$smith?></font> к параметрам вещи<br/><br/>
  <a href='/smith/smith/<?=$inv['id']?>/?start=true' class='button'><img src='/images/icon/smith.png' alt='*'/> Заточить</a>
  </div><br/><hr>
<center>
 Для заточки на <font color='#90c090'>+<?=($inv['smith'] + 1)?></font> требуется:</center><br/><hr>
 <img src='/images/icon/res/1.png' alt='*'/>  <font color='lime'>Алмаз 
<?
if($sack[1] >=$res_1) {
?>(
Хватает )</font>
<?
}
?>
<?
if($sack[1] <=$res_1) {
?>
<font color='red'>(
Нехватает)</font>
<?
}
?>
нужно <?=$res_1?><hr>
 <font color='lime'><img src='/images/icon/res/2.png' alt='*'/> Корунд
<?
if($sack[2] >=$res_2) {
?>
( Хватает )</font>
<?
}
?>
<?
if($sack[2] <=$res_2) {
?>
<font color='red'>(
Нехватает)</font>
<?
}
?>
нужно <?=$res_2?><hr>
 <font color='lime'><img src='/images/icon/res/3.png' alt='*'/> Обсидиан
<?
if($sack[3] >=$res_3) {
?>
( Хватает )</font>
<?
}
?>
<?
if($sack[3] <=$res_3) {
?>
<font color='red'>(
Нехватает)</font>
<?
}
?>
нужно <?=$res_3?><hr>
  <font color='lime'><img src='/images/icon/res/4.png' alt='*'/> Графит
<?
if($sack[4] >=$res_4) {
?>
( Хватает )</font></font>
<?
}
?>
<?
if($sack[4] <=$res_4) {
?>
<font color='red'>(
Нехватает)</font>
<?
}
?>
нужно <?=$res_4?><hr>
  <font color='lime'><img src='/images/icon/res/5.png' alt='*'/> Оникс
<?
if($sack[5] >=$res_4) {
?>
( Хватает )</font>
<?
}
?>
<?
if($sack[5] <=$res_5) {
?>
<font color='red'>(
Нехватает)</font>
<?
}
?>
 нужно <?=$res_5?><hr>
  </div>
  
<?

}
else
{

?>

 <div class='line'></div>

<center>
<font color='#9bc'>Заточка улучшает все параметры вещи!</font>
</center

<?

    $q = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `equip` = "0" AND `smith` < 20');
$items = mysql_result($q,0);

  if($items > 0) {

?>

<div class='menu'>

<?
  
$q = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$user['id'].'" AND `smith` < 20');

  while($row = mysql_fetch_array($q)) {

  $item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$row['item'].'"');
  $item = mysql_fetch_array($item);

  switch($item['quality']) {
    case 0:
  $bonus = 0;
      $quality = 'Простой';
$quality_color = "#986";
     break;
    case 1:
  $bonus = 5;
      $quality = 'Обычный';
$quality_color = "#6c3";
     break;

    case 2:
 $bonus = 10;
      $quality = 'Редкий';
$quality_color = "#69c";
     break;

    case 3:
 $bonus = 15;
 
      $quality = 'Эпический';
$quality_color = "#c6f";
     break;

    case 4:
 $bonus = 20;
 
      $quality = 'Легенарный';
$quality_color = "#f60";
     break;


    case 5:
 $bonus = 50;
      $quality = 'Божественный';
$quality_color = "#999";
     break;


    case 6:
 $bonus = 65; 
      $quality = 'Сверх Божественный';
$quality_color = "#999";
     break;

  }
  
?>

<table cellpadding='0' cellspacing='0'>
<tr>
  <td><img src='/itemImage.php?id=<?=$row['item']?>&smith=<?=$row['smith']?>' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><img src='/images/icon/quality/<?=$item['quality']?>.png' alt='*'/> <a href='/item/<?=$row['id']?>/'><?=$item['name']?></a>
<?
  if($row['smith'] > 0) {
?>  

<font color='#9c9'>+<?=$row['smith']?></font>

<?

  }

?>
<br/>
<small><font color="<?=$quality_color?>"><?=$quality?> [<?=$row['bonus']?>/<?=$bonus?>]</font></small>
  </td></tr></table><br/>
  
  <div align='center'><a href='/smith/smith/<?=$row['id']?>/' class='button'>Выбрать</a></div>
</

<?

  }

?>


  

</div>

<?

  }
  else
  {
  
?>

<div class='content' align='center'>
<font color='#999'>Подходящих вещей нет!</font>
</div>

<?
  
  }

}

include './system/f.php';

  break;

}

?>