<?php
$sql_host="localhost";
$sql_id="begint664_2";
$sql_pass="12345240Game";
$sql_db="begint664_2";
$link = @mysql_connect ("$sql_host", "$sql_id", "$sql_pass") or die ("Нема конекта");
$link2 = @mysql_select_db("$sql_db") or die ("aaa");
	mysql_query("SET NAMES 'utf8'");

$q =  explode("00:00", date('d.m.o'));
/** 
* Формируем заголовок новости
*/
$alPos = 0;
$titleNews = 'Доблестный сезон от '.$q['0'].''.$q['1'].''.$q['2'].'';
$top_q_val1  = mysql_query("SELECT  `id` FROM `clans` WHERE  `valor` > 0 ORDER BY `valor` DESC LIMIT 10");
$alPos2 = 0;
$topes_us.= '<center><font color=lime> <img src=http://144.76.125.123/view/image/icons/mythicLevel.png class=icon><img src=http://144.76.125.123/view/image/icons/mythicLevel.png class=icon><br>Сезон доблести был завершен!<br><img src=http://144.76.125.123/view/image/icons/mythicLevel.png class=icon><img src=http://144.76.125.123/view/image/icons/mythicLevel.png class=icon></font><br><br></center>';
$topes_us.= '<center><font color=gold> <img src=http://144.76.125.123/view/image/icons/svalor5.png class=icon> Доблестные кланы <img src=http://144.76.125.123/view/image/icons/svalor5.png class=icon></font><br><br></center>';


	while($top_val1 = mysql_fetch_assoc($top_q_val1)){
	$alPos++;
	$nagrada10_g = round(0 / $alPos2);
	$nagrada10_s = round(0 / $alPos2);
	$name_top_val1 = mysql_fetch_assoc(mysql_query("SELECT `id`, `name`, `r`, `valor` FROM `clans` WHERE `id`='".$top_val1['id']."' LIMIT 1"));
$topes_us.= '<center><b><font color=red> '.$alPos.' место: <img src=http://144.76.127.94/view/image/icons/clan.png class=icon> <a href=\'/clan/'.$name_top_val1['id'].'/\'>'.$name_top_val1['name'].'</a> <br> Набрали: <img src=http://begint663.beget.tech/images/ico/png/valor_exp.png class=icon> '.$name_top_val1['valor'].'</b></font></center><br><br>';

	mysql_query('UPDATE `clans` SET `g` = `g` + '.$nagrada10_g.', `s` = `s` + '.$nagrada10_s.'  WHERE `id` = '.$name_top_val1['id'].'');


}

$topes_us.= '';
$topes_us.= '<center><font color=gold> <img src=http://144.76.125.123/view/image/icons/svalor5.png class=icon> Доблестные игроки <img src=http://144.76.125.123/view/image/icons/svalor5.png class=icon></font><br><br></center>';
$top_q_val2  = mysql_query("SELECT  `id` FROM `users` WHERE  `valor` > 0 ORDER BY `valor` DESC LIMIT 10");
 while($top_val2 = mysql_fetch_assoc($top_q_val2)){
	$alPos2++;
	$nagrada20_g = round(25000 / $alPos2);
	$nagrada20_s = round(0 / $alPos2);
	$name_top_val2 = mysql_fetch_assoc(mysql_query("SELECT `id`, `login`, `valor` FROM `users` WHERE `id`='".$top_val2['id']."' LIMIT 1"));
$topes_us.= '<center><b><font color=red>'.$alPos2.' место:  <a href=\'/user/'.$name_top_val2['id'].'\'>  '.$name_top_val2['login'].'</a> <br>Набрал: <img src=http://begint663.beget.tech/images/ico/png/valor_exp.png class=icon> '.$name_top_val2['valor'].' уровень доблести. <br>+ <img src=http://144.76.127.94/view/image/icons/gold.png class=icon> '.$nagrada20_g.' золота </b></font></center><br><br>';
mysql_query('UPDATE `users` SET `g` = `g`+ '.$nagrada20_g.', `s` = `s`+ '.$nagrada20_s.' WHERE `id` = '.$name_top_val2['id'].'');
 }








mysql_query('INSERT INTO `forum_topic` (`sub`,
                                        `name`,
										`stick`,
                                        `user`,
                                        `text`,
                                        `time`) VALUES ("1",
														"'.$titleNews.'",
														"0",
														"2",
														"'.$topes_us.'",
														"'.time().'")');

$alPos2 = 0;

     $forum_r = mysql_query("SELECT * FROM `forum_topic` WHERE `sub` = '1' ORDER BY `id` DESC");
     $f = mysql_fetch_array($forum_r);
     $news = mysql_query('SELECT * FROM `forum_topic` WHERE `id` = "'.$f['id'].'"');
     $news = mysql_fetch_array($news);
 $top_q_val2  = mysql_query("SELECT  * FROM `users` WHERE  `valor` > 0 ORDER BY `valor` DESC");
 
 while($top_val2 = mysql_fetch_assoc($top_q_val2)){

$alPos2++;
$name_top_val2 = mysql_fetch_assoc(mysql_query("SELECT `id`, `login`, `valor` FROM `users` WHERE `id`='".$top_val2['id']."' LIMIT 1"));
//где 2 это от кого шлем письмо
if(mysql_result(mysql_query('SELECT COUNT(*) FROM `contacts` WHERE `user` = '.$name_top_val2['id'].' AND `ho` = "2"'),0) == 0) {
mysql_query("INSERT INTO `contacts` SET `user` = '".$name_top_val2['id']."', `ho` = '2', `time` = ".time()."");
}

	mysql_query('UPDATE `contacts` SET `time` = \''.time().'\' WHERE `user` = '.$name_top_val2['id'].' AND `ho` = "2"');
	$text2 = "
	Вы набрали <img src=http://begint663.beget.tech/images/ico/png/valor_exp.png class=icon> ".$name_top_val2['valor']." уровень доблести.<br>
	
	<br>Подробности [url=/forum/topic/$news[id]]здесь[/url]";
mysql_query("INSERT INTO `mail` SET `from` = '2', `to` = '".$name_top_val2['id']."', `time` = '".time()."', `read` = '0', `text` = '".$text2."'");



}
 
mysql_query("UPDATE `users` SET `valor` = '0'");
mysql_query("UPDATE `clans` SET `valor` = '0'");
mysql_query("UPDATE `clan_memb` SET `valor` = '0'");



mysql_query("UPDATE `users` SET `valor_exp` = '0'");
mysql_query("UPDATE `users` SET `valor_b_silver` = '0'");
mysql_query("UPDATE `users` SET `valor_b_exp` = '0'");


?>