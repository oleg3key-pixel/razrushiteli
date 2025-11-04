<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';   
if(!$user) header('location: /');
$title = 'Пещерный Дракон';
include './system/h.php';
$df1=  round(rand($user['def']/15,$user['def']/17));
$df2 = round(rand($user['agi']/10,$user['agi']/9));
$aluk_def = round(rand($df1,$df2));
$my_atk = round(rand($user['str']/6,$user['str']/4)-$aluk_def);
if ($my_atk<1)
{
$my_atk = $user['level']+rand($user['level'],$user['level']/2);
}
$aluko = mysql_fetch_assoc(mysql_query("SELECT * FROM `aluko` ORDER BY `id` LIMIT 1"));
if($aluko['health']==0){
echo '<div class="bdr bg_blue mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="ml10 mt5 mr10 mb5 cntr">
<center><img src="/pdrakon.png"></center><br>
<font color="green">АЛУКО повержен, оживает он 5 раз в день в неожиданное (любое) для игроков  время!</div></font></center></br>
</div>
	<div class="clb"></div>
</div></div></div></div></div></div></div></div></div>';
include './system/f.php';
exit;
}
if($my_atk >$aluko['health'] and $aluko['health']!=0){
mysql_query("UPDATE `aluko` SET `health`=0 WHERE `id`='".$aluko['id']."'")or die (mysql_error());
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `aluko_log`"),0);
if($total>0){
$q_nagr = mysql_query("SELECT * FROM `aluko_log` GROUP BY `user_id` ORDER BY RAND()");
/*3 лучших */
$top_q  = mysql_query("SELECT SUM(uron) , `user_id` FROM  `aluko_log` GROUP BY  `user_id` ORDER BY  SUM(uron) DESC LIMIT 10");
$topes_us = '<br><br><center><font color=red>Результат сражения с АЛУКО</font><br><br> ';
while($top= mysql_fetch_assoc($top_q)){
mysql_query("UPDATE `users` SET `s`=`s`+".$aluko['s']."  WHERE `id`='".$top['user_id']."'");
// Рассчёт награды


$max_uron = mysql_result(mysql_query("SELECT SUM( uron ) FROM `aluko_log` WHERE `user_id`='".$top['user_id']."'"),0);
$nagrada1 = round(100000 / 10); // монет за единицу урона            
$nagrada2 = round(1000000 / 10); // монет за единицу урона            
$nagrada3 = round(10000000 / 10); // монет за единицу урона            
$uron_money=$max_uron/4;
if($max_uron >0){
mysql_query("UPDATE `users` SET `g`=`g`+ ".$nagrada1.", `s`=`s`+ ".$nagrada2.", `exp`=`exp`+ ".$nagrada3."  WHERE `id`='".$top['user_id']."'");
}          
$name_top = mysql_fetch_assoc(mysql_query("SELECT `login` FROM `users` WHERE `id`='".$top['user_id']."' LIMIT 1"));
$topes_us.= '<font color=orange><span class="login">'.$name_top['login'].'</span> (Нанес <img src=http://144.76.125.123/view/image/icons/strength.png class=icon> '.n_f($max_uron).' урона )</font><br><br><center>'; 
$aluko['s']=$aluko['s']-4;
$aluko['exp']= round($aluko['exp']/2);
}
mysql_query("INSERT INTO `chat` SET `user`='1', `text`='".$topes_us."', `time`='".time()."'");
#sleep(1);
//////
mysql_query("TRUNCATE TABLE  `aluko_log`");
}
include './system/f.php';
exit;
}
$aluko['health'] = $aluko['health']-$my_atk;    
$aluko_sl = array('ударил','нанес урон','порезал','побил','царапнул');
shuffle($aluko_sl);
if($user['mp']<0){
echo '<div id="error"><center><font color="#c06060">Для нападения надо минимум <img src="/images/icon/mana.png" alt="*"/> 1 маны</font></center></div>';
echo'<center>Здоровье дракона:<font color="green"> '.$aluko['health'].'</font>/<font color="green">'.$aluko['max_health'].'</font></center>';
$aluko_log_q = mysql_query("SELECT * FROM `aluko_log` ORDER BY `time` DESC LIMIT 3");
echo '</div><div class="main"><div class="block_zero"><center><font color="yellow"></font>';
while($aluko_log = mysql_fetch_assoc($aluko_log_q)){
$ank = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id`='".$aluko_log['user_id']."'"));
echo '<a href="user.php?id='.$ank['id'].'">'.$ank['login'].'</a> '.$aluko_log['text'].'<br>';
}
echo '</center>';
include './system/f.php';
exit;
}
if($user['vit']<100){
echo '<div id="error"><font color="#c06060"><center>Вы погибли в бою , дождитесь окончания боя или восстановите у колдуна здоровье!!!</font></center></div>';
echo'<center>Здоровье дракона:<font color="green"> '.$aluko['health'].'</font>/<font color="green">'.$aluko['max_health'].'</font></center>';
$aluko_log_q = mysql_query("SELECT * FROM `aluko_log` ORDER BY `time` DESC LIMIT 5");
echo '</div><div class="main"><div class="block_zero"><center><font color="yellow"></font>';
while($aluko_log = mysql_fetch_assoc($aluko_log_q)){
$ank = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id`='".$aluko_log['user_id']."'"));
echo '<a href="user.php?id='.$ank['id'].'">'.$ank['login'].'</a> '.$aluko_log['text'].'<br>';
}
echo '</center>';
include './system/f.php';
exit;
}
mysql_query("INSERT INTO `aluko_log` SET `user_id`='".$user['id']."',`text`='".$aluko_sl[0]." <b>Дракона</b> на <b>".$my_atk."</b>',`time`='".time()."',`uron`='".$my_atk."'");
$_hp = rand(1,40);
$_mp = rand(25,25);
mysql_query("UPDATE `aluko` SET `health`=`health`-".$my_atk." WHERE `id`='".$aluko['id']."'");
mysql_query('UPDATE `users` SET `hp` = `hp` - '.$_hp.' WHERE `id` = "'.$user['id'].'"');
mysql_query('UPDATE `users` SET `mp` = `mp` - '.$_mp.' WHERE `id` = "'.$user['id'].'"');
$all_uron = mysql_result(mysql_query("SELECT SUM( uron )FROM `aluko_log` WHERE `user_id`='".$user['id']."'"),0);
$perc_health_aluko = round($aluko['health']/$aluko['max_health']*100,2);
echo '<div class="bdr bg_blue mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="ml10 mt5 mr10 mb5 cntr">
<center><img src="/pdrakon.png"><br>

<br><b>Мифический АЛУКО напал на нас!!!<br>Хватай меч и сражайся</b></center><br><img class=icon src=http://144.76.125.123/view/image/icons/mythicLevel.png><img class=icon src=http://144.76.125.123/view/image/icons/mythicLevel.png><img class=icon src=http://144.76.125.123/view/image/icons/mythicLevel.png><img class=icon src=http://144.76.125.123/view/image/icons/mythicLevel.png><img class=icon src=http://144.76.125.123/view/image/icons/mythicLevel.png>


</div>
	<div class="clb"></div>
</div></div></div></div></div></div></div></div></div>

<div class="hr_g mb2"><div><div></div></div></div>
<div class="bdr bg_blue mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="ml10 mt5 mr10 mb5 cntr">
			<img class=icon src=http://144.76.125.123/view/image/icons/heart_totem.png> Здоровье: <a class="lyell">  <font color=red>'.n_f($aluko['health']).'</font> / <font color=lime>'.n_f($aluko['max_health']).'</font></a>	
</div>
	<div class="clb"></div>
</div></div></div></div></div></div></div></div></div>
<div class="hr_g mb2"><div><div></div></div></div>

<br><br><div class="cntr p_relative"><a href="/drakon" class="ubtn inbl mt-15 mb2 red"><span class="ul"><span class="ur">Атаковать</span></span></a>
';
$aluko_log_q = mysql_query("SELECT * FROM `aluko_log` ORDER BY `time` DESC LIMIT 10");
echo '</div><div class="main"><div class="block_zero"><center><font color="yellow"></font><br>';
while($aluko_log = mysql_fetch_array($aluko_log_q))
{
$row = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$aluko_log['user_id']."'"));
?>
<div class="hr_g mb2"><div><div></div></div></div>
<div class="bntf"><div class="small"><div class="nl"><div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">

<a class="tdn lwhite" href='/user/<?=$row['id']?>/'> <?=nick($row['id'])?>
</a></span> - <?=$aluko_log['text'];?></div>
	<div class="clb"></div>
</div></div></div></div></div></div></div></div></div>
<?
}
$queryLiders  = mysql_query("SELECT SUM( uron ) , `user_id`  FROM  `aluko_log`GROUP BY  `user_id` ORDER BY  SUM( uron ) DESC LIMIT 10");
?>
<div class="hr_g mb2"><div><div></div></div></div>
<div class="hr_g mb2"><div><div></div></div></div>
<div class="bdr bg_red mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="ml10 mt5 mr10 mb5">
<center>Топ 10 бойцов:</center>
<?
$alPos = 0;
while ($liders = mysql_fetch_array($queryLiders))
{
$alPos++;
$row = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$liders['user_id']."'"));
$damageUs = mysql_result(mysql_query("SELECT SUM( uron ) , `user_id` FROM  `aluko_log`WHERE `user_id`='".$liders['user_id']."'"),0);
?>  

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
    <td><a class="tdn lwhite" href='/user/<?=$row['id']?>/'>
<?=nick($row['id'])?></a></td>
    <td class="rightcol"><img src=http://144.76.125.123/view/image/icons/strength.png class=icon> <?=n_f($damageUs);?></td>
   </tr>
  </table>
 </body><br>










<?
}

?>
</div>
</div>
	<div class="clb"></div>
</div></div></div></div></div></div></div></div></div>
</div>
<?
echo '</center></div></div></div>';
include './system/f.php';
?>