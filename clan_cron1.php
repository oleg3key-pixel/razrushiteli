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
$titleNews = 'Еженедельный турнир от '.$q['0'].''.$q['1'].''.$q['2'].'';
$top_q  = mysql_query("SELECT  `id` FROM `clans` WHERE  `plat` > 0 ORDER BY `plat` DESC LIMIT 10");
$alPos2 = 0;
$topes_us.= '<center><font color=lime> <img src=http://144.76.125.123/view/image/icons/mythicLevel.png class=icon><img src=http://144.76.125.123/view/image/icons/mythicLevel.png class=icon><br>Еженедельный турнир был закончен!<br><img src=http://144.76.125.123/view/image/icons/mythicLevel.png class=icon><img src=http://144.76.125.123/view/image/icons/mythicLevel.png class=icon></font><br><br></center>';
$topes_us.= '<center><font color=gold> <img src=http://144.76.125.123/view/image/icons/svalor5.png class=icon> Победители среди кланов <img src=http://144.76.125.123/view/image/icons/svalor5.png class=icon></font><br><br></center>';


	while($top = mysql_fetch_assoc($top_q)){
	$alPos++;
	//расчет награды//
	$nagrada1_g = round(25000 / $alPos);
	$nagrada1_s = round(25000000 / $alPos);
	$name_top = mysql_fetch_assoc(mysql_query("SELECT `id`, `name`, `plat` FROM `clans` WHERE `id`='".$top['id']."' LIMIT 1"));
$topes_us.= '<center><b><font color=red> '.$alPos.' место: <img src=http://144.76.127.94/view/image/icons/clan.png class=icon> <a href=\'/clan/'.$name_top['id'].'/\'>'.$name_top['name'].'</a> <br> Собрали: <img src=http://144.76.127.94/view/image/icons/diamond.png class=icon> '.$name_top['plat'].'<br> + <img src=http://144.76.127.94/view/image/icons/gold.png class=icon> '.$nagrada1_g.' золота в казну клана <br> + <img src=http://144.76.127.94/view/image/icons/silver.png class=icon> '.$nagrada1_s.' серебра в казнy</b></font></center><br><br>';

	mysql_query('UPDATE `clans` SET `g` = `g` + '.$nagrada1_g.', `s` = `s` + '.$nagrada1_s.'  WHERE `id` = '.$name_top['id'].'');


}

$topes_us.= '';
$topes_us.= '<center><font color=gold> <img src=http://144.76.125.123/view/image/icons/svalor5.png class=icon> Победители среди игроков <img src=http://144.76.125.123/view/image/icons/svalor5.png class=icon></font><br><br></center>';
$top_q_rilik  = mysql_query("SELECT  `id` FROM `users` WHERE  `task_kluch` > 0 ORDER BY `task_kluch` DESC LIMIT 10");
 while($top_rilik = mysql_fetch_assoc($top_q_rilik)){
	$alPos2++;
	$nagrada2_g = round(25000 / $alPos2);
	$nagrada2_s = round(25000000 / $alPos2);
	$name_top_rilik = mysql_fetch_assoc(mysql_query("SELECT `id`, `login`, `task_kluch` FROM `users` WHERE `id`='".$top_rilik['id']."' LIMIT 1"));
$topes_us.= '<center><b><font color=red>'.$alPos2.' место:  <a href=\'/user/'.$name_top_rilik['id'].'\'>  '.$name_top_rilik['login'].'</a> <br>Собрал: <img src=http://mrush.pw/images/ico/png/keys.png class=icon> '.$name_top_rilik['task_kluch'].' <br>+ <img src=http://144.76.127.94/view/image/icons/gold.png class=icon> '.$nagrada2_g.' золота <br> + <img src=http://144.76.127.94/view/image/icons/silver.png class=icon> '.$nagrada2_s.' серебра</b></font></center><br><br>';
mysql_query('UPDATE `users` SET `g` = `g`+ '.$nagrada2_g.', `s` = `s`+ '.$nagrada2_s.' WHERE `id` = '.$name_top_rilik['id'].'');
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
 $top_q_rilik2  = mysql_query("SELECT  * FROM `users` WHERE  `task_kluch` > 0 ORDER BY `task_kluch` DESC");

 while($top_rilik2 = mysql_fetch_assoc($top_q_rilik2)){
 while($top_val2 = mysql_fetch_assoc($top_q_val2)){

$alPos2++;
$name_top_rilik2 = mysql_fetch_assoc(mysql_query("SELECT `id`, `login`, `task_kluch` FROM `users` WHERE `id`='".$top_rilik2['id']."' LIMIT 1"));
//где 2 это от кого шлем письмо
if(mysql_result(mysql_query('SELECT COUNT(*) FROM `contacts` WHERE `user` = '.$name_top_rilik2['id'].' AND `ho` = "2"'),0) == 0) {
mysql_query("INSERT INTO `contacts` SET `user` = '".$name_top_rilik2['id']."', `ho` = '2', `time` = ".time()."");
}}

	mysql_query('UPDATE `contacts` SET `time` = \''.time().'\' WHERE `user` = '.$name_top_rilik2['id'].' AND `ho` = "2"');
	$text2 = "Вы собрали <img src=http://mrush.pw/images/ico/png/keys.png class=icon> ".$name_top_rilik2['task_kluch']." ключей.<br>
	
	<br>Подробности [url=/forum/topic/$news[id]]здесь[/url]";
mysql_query("INSERT INTO `mail` SET `from` = '2', `to` = '".$name_top_rilik2['id']."', `time` = '".time()."', `read` = '0', `text` = '".$text2."'");



}
 

mysql_query("UPDATE `users` SET `task_kluch` = '0'");
mysql_query("UPDATE `clans` SET `plat` = '0'");
mysql_query("UPDATE `clan_memb` SET `plat` = '0'");
mysql_query("UPDATE `clans` SET `plat_drag` = '0'");

?>