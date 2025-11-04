<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


// root path
define ("ROOT", $_SERVER['DOCUMENT_ROOT']);

// load all system components
foreach (array (
				ROOT . "/system/common.php",
				ROOT . "/system/functions.php",
				ROOT . "/system/user.php"
) as $file) {
				require $file;
}


// require login
if (!isset ($user)) {
				header ("location: /");
exit;
}


// check
$query = mysql_query ("SELECT `clans`.`g` as `g`, `clan_memb`.* FROM `clan_memb` LEFT JOIN `clans` ON `clans`.`id`=`clan_memb`.`clan` WHERE (`clan_memb`.`user`='$user[id]')");
if (mysql_num_rows ($query)!=0)
				$c = mysql_fetch_array ($query);

// header
				$title = "Клановые войны";
				
$self = 'Клановые войны';
$inFight = mysql_num_rows(mysql_query("SELECT `id`,`self` FROM `users` 
                                    WHERE `self`='".($self)."' and 
                                    `online`>'".(time()-300)."'"));
				
require ROOT . "/system/h.php";

?>



<?php

// configurations
define ("TIME",   3600 * 12); // откат мероприятия (3  часа)
define ("DURATION", 600); // продолжительность мероприятия (30 минут)
define ("PRICE", 		  1000); // стоимость подачи заявки (1000 золота)
define ("ATTACK_DELAY", 2);
define ("_1st", 50000); // награда за первое место
define ("_2st", 40000); // за 2е
define ("_3st", 30000); // за 3е
define ("_4st", 20000); // за 2е
define ("_5st", 10000);

if (isset ($_SESSION['mes'])) {
?>
<div class="bdr cnr f mb2 bl nd">
<div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8" align='center'>
<?php
		foreach ($_SESSION['mes'] as $mes) {
				
?>

		<?=$mes?><br/>

<?php			
		}
		?>
</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
		<?php
unset ($_SESSION['mes']);
}

?>

<ul style='list-style:none;padding:0px;margin:0px;' class='menu'>

<?php

if (mysql_num_rows (mysql_query ("SELECT * FROM `cw_event`"))!=0) {
				$e = mysql_fetch_array (mysql_query ("SELECT * FROM `cw_event` ORDER BY `id` DESC LIMIT 1"));
				
				if ($e['start']==0 and $e['time']<=time ()) {
								mysql_query ("UPDATE `cw_event` SET `start`='1',`time`=`time`+" . DURATION . " WHERE (`id`='$e[id]')");
								header ('location: /cw');
				}
				if ($e['start']==1 and mysql_num_rows (mysql_query ("SELECT * FROM `cw_clans` WHERE (`id_event`='$e[id]')"))==1) {
								mysql_query ("UPDATE `cw_event` SET `end`='1' WHERE (`id`='$e[id]')");
								mysql_query ("INSERT INTO `cw_event` (`start`,`end`,`time`) VALUES ('0','0','" . (time ()+TIME). "')");
				}
				
				
				
                      
				if ($e['start']==1 and $e['end']==0 and $e['time']<=time ()) {
				    $date_cw=date('d.m.Y');
								mysql_query ("UPDATE `cw_event` SET `end`='1', `date` = '".$date_cw."'  WHERE (`id`='$e[id]')");
								mysql_query ("INSERT INTO `cw_event` (`start`,`end`,`time`) VALUES ('0','0','" . (time ()+TIME). "')");
								$mes = "<font color=red>Войны Кланов завершены!</font>";
								$i = 0;
								$q = mysql_query ("SELECT `clans`.*,`cw_clans`.`kp` FROM `cw_clans` LEFT JOIN `clans` ON `clans`.`id`=`cw_clans`.`id_clan` WHERE (`cw_clans`.`id_event`='$e[id]') ORDER BY `cw_clans`.`kp` DESC LIMIT 5");
while ($_c = mysql_fetch_array ($q)) {
$i++;
$topes_us.= ''.$i.'. <a class=tdn lwhite href=/clan/'.$_c['id'].'>  '.$_c['name'].'</a><br>Убили участников: '.$_c['kp'].'<br></font>';
}
mysql_query("INSERT INTO `cw_logs` SET `text`='Результаты прошлого сражения<br>Битва состоялась: ".$date_cw." <br> ".$topes_us."', `time`=".time()."");
$_SESSION['mes'][] = $mes;
header ('location: /cw'); 
}
$q = mysql_query ("SELECT * FROM `cw_memb` WHERE (`id_event`='$e[id]') AND (`id_user`='$user[id]')");
if ($e['start'] == 1 and mysql_num_rows ($q)!=0) {
$m = mysql_fetch_array ($q);
if ($m['hp']==0) {
?>
div class="bdr cnr f mb2 bl nd">
<div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8" align='center'>Вас убили, дождитесь окончания турнира! | <?=ceil (($e['time']-time ())/60)?> 
</div> </div> </div> </div> </div> </div> </div> </div> </div> </div> </div> </div> </div> </div> </div> </div> </div> </div> </div><?php								
										
								}
								else {
												
  										$_GET['change'] = isset ($_GET['change']) ? intval ($_GET['change']) : 0;
											if ($_GET['change']==1) {

																$query = mysql_query ("SELECT * FROM `cw_memb` WHERE (`id_event`='$e[id]') AND (`id_clan`!='$m[id_clan]') ORDER BY RAND()");
																if (mysql_num_rows ($query)!=0) {
																		
																				$opponent = mysql_fetch_array ($query);
																				mysql_query ("UPDATE `cw_memb` SET `id_opponent`='$opponent[id]' WHERE (`id_event`='$m[id_event]') AND (`id_user`='$m[id_user]')");		

																}

																header ('location:/cw');
																exit;
												}
  										$_GET['regeneration'] = isset ($_GET['regeneration']) ? intval ($_GET['regeneration']) : 0;
											if ($_GET['regeneration']==1) {
															if ((time () - $m['last_regeneration'])>60) {
																			mysql_query ("UPDATE `cw_memb` SET `hp`='" . ceil (($user['vit']*2)) . "',`last_regeneration`='" . time () . "' WHERE (`id`='$m[id]')");		
															}
																header ('location:/cw');
																exit;
												}


?>
  <div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Турнир кланов
    </div>
   </div>
  </div> 
  <span style='float:right;'>До конца 
<?=_time($e['time']-time ())?></span><br><img src='/view/image/icons/health.png' alt=''/> <?=$m['hp']?></div>
				

	
	

	  <div class="bdr bg_blue">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="cntr mt5 mb5"> 
            <div class="mb5">
<html>
 <head>
  <meta charset="utf-8">
  <style>
   table.text  {
    width:  100%; /* Ширина таблицы */
    border-spacing: 0; /* Расстояние между ячейками */
   }
   table.text td {
    width: 50%; /* Ширина ячеек */
    vertical-align: top; /* Выравнивание по верхнему краю */
   }
   td.rightcol { /* Правая ячейка */ 
    text-align: right; /* Выравнивание по правому краю */
   }
  </style>
 </head>
 <body>
  <table class="text">
   <tr>
    <td><img src=/view/image/icons/health.png class=icon> <?=$m['hp']?></td>
    <td class="rightcol"><img src=/view/image/icons/safari.png class=icon> <?=_time($e['time']-time ())?> </td>
   </tr>
  </table>
 </body>
</html>	
	
	
	
	
				
			</div>	
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
<?php
												if ($m['id_opponent']!=0) {
																$cw_opponent = mysql_fetch_array (mysql_query ("SELECT * FROM `cw_memb` WHERE (`id`='$m[id_opponent]')"));
																if ($cw_opponent['hp']!=0) {
																				$opponent = mysql_fetch_array (mysql_query ("SELECT * FROM `users` WHERE (`id`='$cw_opponent[id_user]')"));


												$_GET['attack'] = isset ($_GET['attack']) ? intval ($_GET['attack']) : 0;
												if ($_GET['attack']==1) {
																if (time () - $m['last_attack']<ATTACK_DELAY) {
																				header ('location: /cw'); exit;
																}
																
																// current damage
																$dmg = 0;
														
																

															
																		
																		

																		$dmg += ceil (rand(($user['str']/6), ($user['str']/4)));
																		
																		if ($ability_1==1) {
																				$dmg += ceil (($dmg / 100) * $ability_1_b);
																		}

																		$dmg -= ceil (rand(($opponent['def']/12), ($opponent['def']/7)));        
																		
																		if ($dmg < 0)
																				$dmg = 0;

																		$crit = $ability_1==1?((rand (1,2)*($user['agi']/100)+$ability_3_c_c)-(rand (1,2)*($opponent['agi']/100))):((rand (1,2)*($user['agi']/100))-(rand (1,2)*($opponent['agi']/100)));
																		
																		if (mt_rand(0, 100) <= $crit) {   
																		
																				$dmg *= 2;

																				if($ability_3 == 1) {							 
																						$dmg += ceil (($dmg/100)*$ability_3_b);								
																				}    
																		
																		}

																		$dodge = ((rand (1,3)*($opponent['agi']/100))-(rand (1,3)*($user['agi']/100)));
														
																		if(mt_rand(0, 100) <= $dodge)
																				$dmg = 0;
																
																		
																		if ($dmg>$cw_opponent['hp']) {
																						$dmg = $cw_opponent['hp'];
																		
																						mysql_query ("UPDATE `cw_clans` SET `kp`=`kp`+1 WHERE (`id_event`='$e[id]') AND (`id_clan`='$m[id_clan]')");
																						mysql_query ("INSERT INTO `cw_log` (`id_event`,`text`) VALUES ('$e[id]','$user[login] убил $opponent[login]')");
																		}
																		
																mysql_query ("UPDATE `cw_memb` SET `hp`=`hp`-$dmg WHERE (`id`='$m[id_opponent]')");
																mysql_query ("UPDATE `cw_memb` SET `last_attack`=" . time () . " WHERE (`id`='$m[id]')");
												?>
  <div class="bdr bg_red mb2">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="ml10 mt5 mr10 mb5 cntr"> 
           
           <?php
																if ($dmg==0) {
mysql_query ("INSERT INTO `cw_log` (`id_event`,`text`) VALUES ('$e[id]','$user[login] попытался ударить $opponent[login]')");
?>
																Вы промахнулись
<?php				
}
else
{
mysql_query ("INSERT INTO `cw_log` (`id_event`,`text`) VALUES ('$e[id]','$user[login] нанес $opponent[login] $dmg урона')");
?>
																Вы нанесли <b><?=$dmg?></b> урона
												<?php
																}
															if ($ability_1!=0 || $ability_2!=0 || $ability_3!=0 | $ability_4!=0) {
?>
														<div class='separator'></div>

<?php
																		if($ability_1==1) {
												?>
														<img src='/view/image/ability/1.<?=$user['ability_1_quality']?>.png' style='width:25px;height:25px;' alt=''/>
												<?php
																		}
																		if($ability_2==1) {
												?>
														<img src='/view/image/ability/2.<?=$user['ability_2_quality']?>.png' style='width:25px;height:25px;' alt=''/>
												<?php
																		}
																		if($ability_3==1) {
												?>
														<img src='/view/image/ability/3.<?=$user['ability_3_quality']?>.png' style='width:25px;height:25px;' alt=''/>
												<?php
																		}
																		if($ability_4==1) {
												?>
														<img src='/view/image/ability/4.<?=$user['ability_4_quality']?>.png' style='width:25px;height:25px;' alt=''/>
												<?php
																		}
																}
												?>
												</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
<?php
}

$i_clan2 = mysql_query('SELECT * FROM `clan_memb` WHERE `id_event` = "'.$cw_opponent['id'].'"');
    $i_clan2 = mysql_fetch_array($i_clan2);


$i_clan = mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$cw_opponent['id_clan'].'"');
    $i_clan = mysql_fetch_array($i_clan);
	$i_clan_memb = mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$cw_opponent['id_user'].'"');
  $i_clan_memb = mysql_fetch_array($i_clan_memb);

	switch($i_clan_memb['rank']) {
  
    case 0:
    $rank = 'Новичек';
     break;
    case 1:
    $rank = 'Ветеран';
     break;
    case 2:
    $rank = 'Офицер';
     break;
    case 3:
    $rank = 'Генерал';
     break;
    case 5;
    $rank = 'Маршал';
    break;
    case 6:
    $rank = 'Лидер клана';
     break;
    
  }
$clan_vsego = mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_memb` WHERE `clan` = "'.$i_clan['id'].'"'),0);
//$clab_ubit = mysql_result(mysql_query('SELECT COUNT(*) FROM `cw_memb` WHERE `hp` = "'.($cw_opponent['id'] == 0).'"'),0);
$clan_onlaiv = mysql_result(mysql_query('SELECT COUNT(*) FROM `cw_memb` WHERE `id_clan` = "'.$i_clan['id'].'" AND  `last_attack` > "'.(time() - 160).'"'),0);
$clab_ubit = mysql_result(mysql_query("SELECT SUM(`hp`='0') FROM `cw_memb` WHERE (`id_event`='$e[id]') AND (`id_clan`='$cw_opponent[id_clan]')"),0);

?>


  <div class="bdr bg_blue mb2">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="ml10 mt5 mr10 mb5 cntr"> 
<font color='#FFCC00'><img src='/view/image/cw/1.png' class=icon> <?=$i_clan['name']?> <img src='view/image/cw/1.png' class=icon></font>
<br>
<font color='#009E00'>Всего в клане: <img src='/view/image/cw/2.png' class=icon> <?=$clan_vsego?></font><br>
Сражается: <?=$clan_onlaiv?>
<br>
<font color='#FD310E'>Врагов убито:  <img src='/view/image/cw/3.png' class=icon> <?=$clab_ubit;?></font><br/></div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>


<div class="bdr bg_red mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
      <div class="fl ml10 mt10">
          
          
<?
  if($opponent['sex'] == '0'){
     echo' <img src="/view/image/user/0.png" alt="user" width="48">';}
  if($opponent['sex'] == '1'){
     echo' <img src="/view/image/user/1.png" alt="user" width="48">';}
?>



      </div>
      <div class="ml68 mt10 mb10 mr10 sh">
        <div class="cmcon2"><div class="ccbtn11"><span class="lwhite tdn"><a class="nd" href="?attack=1"><?=$opponent['login']?></a></span></div></div><div class="cablock15"><div class="cdblck15"><span class="lwhite tdn"></span></div></div>        <div class="small mb2">
          <span class="fr rdmg"></span>
                <div class="mt2 mb2 small lorange"> 
             <img src="view/image/icons/clan.png" class="va_t" height="16" width="16" alt=""> <?=$i_clan['name']?> , <?=$rank?>
            </div>       
          <span class="lorange">
            <img src="/view/image/icons/strength.png" class="va_t" height="16" width="16" alt=""> <?=_string(_num($opponent['str']))?>          <img src="https://static.mrush.mobi/view/image/icons/health.png" class="va_t" height="16" width="16" alt=""><?=_string(_num($opponent['vit']))?>           <img src="https://static.mrush.mobi/view/image/icons/defense.png" class="va_t" height="16" width="16" alt=""> <?=_string(_num($opponent['def']))?>         </span><?if(!empty($logs)){?><span class="fr rdmg">-<?=$lair_attack?></span><?}?>   
        </div>
      </div>
      <div class="clb"></div>
    </div></div></div></div></div></div></div></div>
     </div>
 </div>
 </div>
 </div>
 </div>


 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>



 <div class="bdr bg_blue mb2">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="ml10 mt5 mr10 mb5 cntr"> 
<br>
<div class="cntr mb10 mt-5"> 
   <div class="fr w50"> 
    <div class="iqcont6">
     <div class="iabtn14">
      <a href="?attack=1" class="ubtn inbl s red_no"><span class="ul"><span class="ur">Атаковать</span></span></a>
     </div>
     </div>
    </div>


   <div class="fl w50"> 
    <div class="cmcon6">
     <div class="cdblck16">
      <a href="?change=1" class="ubtn inbl s blue_no"><span class="ul"><span class="ur">Сменить</span></span></a>
     </div>
    </div>
    </div>


  </div> 
<br>

<?

if ((time () - $m['last_regeneration'])>60) {?>
<div class=cntr>
             <a href="?regeneration=1" class="ubtn mb2 green_no inbl"><span class="ul"><span class="ur">Лечение </span></span> </a></div>
             <?php				}
?>

 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>





                 
                  
   <div class="bdr bg_blue mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
      <div class="fl ml10 mt10">
          
          
<?
  if($user['sex'] == '0'){
     echo' <img src="/images/user/0.png" alt="user" width="48">';}
  if($user['sex'] == '1'){
     echo' <img src="/images/user/1.png" alt="user" width="48">';}
?>



      </div>
      <div class="ml68 mt10 mb10 mr10 sh">
        <div class="cmcon2"><div class="ccbtn11"><span class="lwhite tdn"><a class="nd" href="/lair?action=attack&amp;r=660&amp;hash=0"><?=$user['login']?></a></span></div></div><div class="cablock15"><div class="cdblck15"><span class="lwhite tdn"></span></div></div>        <div class="small mb2">
          <span class="fr rdmg"></span>
                      <div class="mt2 mb2 small lorange"> 
             <img src="http://144.76.127.94/view/image/icons/clan.png" class="va_t" height="16" width="16" alt=""> Повышаем_градус , офицер 
            </div> 
          <span class="lorange">



               
                  

      <img src="/view/image/icons/strength.png" class="va_t" height="16" width="16" alt=""> 
<font color="
  
<?
if($opponent['str'] < $user['str']) {
$diff += $opponent['str'] - $user['str'];
?>#009E00<? 
    
    }
    else
    {

?>#FF6600<?
    
    }
?>
">  <?=$user['str']?></font>
  <img src="/view/image/icons/health.png" class="va_t" height="16" width="16" alt=""> 
 <font color="
  
<?
if($opponent['vit'] < $user['vit']) {
    
      $diff += $opponent['vit'] - $user['vit'];
    
?>#009E00<? 
    
    }
    else
    {

?>#FF6600<?
    
    }
    

?>
  
  ">  <?=$user['vit']?></font>
   <font color="
  
<?
if($opponent['agi'] < $user['agi']) {
    
      $diff += $opponent['agi'] - $user['agi'];
    
?>#009E00<? 
    
    }
    else
    {

?>#FF6600<?
    
    }
    

?>
  
  ">  <?=$user['agi']?></font>
<img src="/view/image/icons/defense.png" class="va_t" height="16" width="16" alt=""> 
<font color="
  
<?

    if($opponent['def'] < $user['def']) {
    
      $diff += $opponent['def'] - $user['def'];
    
?>#009E00<? 
    
    }
    else
    {

?>#FF6600<?
    
    }
    

?>
  
  ">  <?=$user['def']?></font><br/>

          <div class="clb"></div>
    </div></div></div></div></div></div></div></div>
         
                            
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div></div>

            <div class="bdr bg_blue mb2">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="ml10 mt5 mr10 mb5 cntr"> 
<?php
				if ((time () - $m['last_attack'])>ATTACK_DELAY) {

?>							<!--	<a href='/cw?attack=1' class='button'>Атаковать</a><br/>-->
<?php
				}
				else {
?>
				До удара <?=(ATTACK_DELAY - (time () - $m['last_attack']))?> сек<br/>

<?php
				}
?>

<?php

?>
</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>

<?php																				
																				
																				
																}
																else {
?>
  <div class="bdr bg_blue">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="mlr10 sh small cntr lblue"> 
            <div class="w200px mrauto">
                
                								Поиск противника...<br/><br>
             <a href="?change=1" class="ubtn mb2 green_no inbl"><span class="ul"><span class="ur">Обновить </span></span> </a></div>
			
			
				</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
<?php																				
																}
												}
												else {											
?>
  <div class="bdr bg_blue">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="mlr10 sh small cntr lblue"> 
            <div class="w200px mrauto">
                
                								Поиск противника...<br/><br>
             <a href="?change=1" class="ubtn mb2 green_no inbl"><span class="ul"><span class="ur">Обновить</span></span> </a></div>
				</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
<?php												
												}
								}
								
								$q = mysql_query ("SELECT * FROM `cw_log` WHERE (`id_event`='$e[id]') ORDER BY `id` DESC LIMIT 10");
								while ($log = mysql_fetch_array ($q)) {
?>
  <div class="bdr bg_blue">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="mlr10 sh small cntr lblue"> 
            <div class="w200px mrauto"><?=$log['text']?>
</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
<?php
								}
				
				
				}
				else {
								if ($e['start']==1) {
?>												
				 <div class="bdr cnr f mb2 bl nd ">
<div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8" align='center'>
								Битва в самом разгаре!<br/>
								До конца остается <?=ceil (($e['time']-time ())/60)?> <br/>
</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
<?php												
								}
								else {
								
												$_GET['register'] = isset ($_GET['register']) ? intval ($_GET['register']) : 0;


				if (isset ($c)) {
								if (mysql_num_rows (mysql_query ("SELECT * FROM `cw_clans` WHERE (`id_event`='$e[id]') AND (`id_clan`='$c[clan]')"))==0) {
												if ($c['rank']==5 OR $c['rank']==4) {
																// register clan at event
																if ($_GET['register']==1) {
if($clan) {

	$topes_us.= '<span class="login"><font color="90c0c0"></span>Наш клан участвует в турнире кланов!!!</font>';
	mysql_query("INSERT INTO `chat` SET `clan`= '".$clan['id']."', `read` ='0', `user`='3', `user_id`='1', `text`='".$topes_us."', `time`='".time()."'");
}
																				if ($c['g']>=PRICE) {
																								
																								mysql_query ("INSERT INTO `cw_clans` (`id_event`,`id_clan`,`kp`) VALUES ('$e[id]','$c[clan]','0')");
																								mysql_query ("UPDATE `clans` SET `g`=`g`-" . PRICE . " WHERE (`id`='$c[clan]')");
																								$query = mysql_query ("SELECT `users`.* FROM `clan_memb` LEFT JOIN `users` ON `users`.`id`=`clan_memb`.`user` WHERE (`clan_memb`.`clan`='$c[clan]')");
																								while ($m = mysql_fetch_array ($query)) {
																												mysql_query ("INSERT INTO `cw_memb` (`id_event`,`id_clan`,`id_user`,`hp`,`id_opponent`) VALUES ('$e[id]', '$c[clan]', '$m[id]', '" . ($m['vit']*2) . "','0')");

																								}
																				}
																				
																				header ('location:/cw');																
																}
												}
?>
 <div class="bdr bg_blue mb2">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="ml10 mt5 mr10 mb5 cntr"> 
           <img src='/images/main.png'><br>
  <?

?>
                Турнир начнется через <?=_time($e['time']-time ())?> </br>
				Всего кланов <?=mysql_result(mysql_query('SELECT COUNT(*) FROM `cw_clans` WHERE (`id_event`='.$e['id'].')'),0)?><br><br>
                <?
												
												if ($c['rank']==5 OR $c['rank']==4) {
?>
             <a href="?register=1" class="ubtn mb2 green_no inbl"><span class="ul"><span class="ur">Подать заявку, 1000 золота.</span></span> </a></div>

<?
									}
?>
				</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
<?php
}else {
?>
 <div class="bdr bg_blue mb2">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="ml10 mt5 mr10 mb5 cntr"> 
           
           <img src='/images/main.png'><br>
								Ваш клан учавствует в турнире!<br/><br>
								
             <a href="?" class="ubtn mb2 green_no inbl"><span class="ul"><span class="ur">Обновить </span></span> </a>
								
								
								<br><br>
								Турнир начнется через <?=_time($e['time']-time ())?> </br>Всего кланов <?=mysql_result(mysql_query('SELECT COUNT(*) FROM `cw_clans` WHERE (`id_event`='.$e['id'].')'),0)?>

				</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div></div></div>
<?php								
								}

				}


?> <a class="mbtn mb2" href="/cw_log.php"><img src="/view/image/icons/png/icon.png" class=icon width="20"> История битв</a><?

								}
				}

} 
else {

				mysql_query ("INSERT INTO `cw_event` (`start`,`end`,`time`) VALUES ('0','0','" . (time ()+TIME). "')");
				header ('location:/cw');
				
}

?>

</ul>

<?php

// footer
require ROOT . "/system/f.php";