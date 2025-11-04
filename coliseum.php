<?
include './system/common.php';   
include './system/functions.php';
include './system/user.php';
    
if(!$user OR $user['id'] < 1) {
header('location: /index.php');
exit;}


$title = 'Колизей';    
include './system/h.php';  

///////////////////////////////////////////////////////////////////////////////////////////////////////
if($user['coliseum_rating'] >= '0' AND $user['coliseum_rating'] < '1500'){   $liga='<img src="/images/ico/quality/1.png" alt="*"> Лига новичков';   }
if($user['coliseum_rating'] >= '1500' AND $user['coliseum_rating'] < '2000'){$liga='<img src="/images/ico/quality/2.png" alt="*"> Лига охотников';  }
if($user['coliseum_rating'] >= '2000' AND $user['coliseum_rating'] < '3000'){$liga='<img src="/images/ico/quality/3.png" alt="*"> Лига ветеранов';  }
if($user['coliseum_rating'] >= '3000' AND $user['coliseum_rating'] < '4000'){$liga='<img src="/images/ico/quality/4.png" alt="*"> Лига гладиаторов';}
if($user['coliseum_rating'] >= '4000' AND $user['coliseum_rating'] < '5000'){$liga='<img src="/images/ico/quality/5.png" alt="*"> Лига чемпионов';  }
if($user['coliseum_rating'] >= '5000'){                                      $liga='<img src="/images/ico/quality/6.png" alt="*"> Лига непобедимых';}
///////////////////////////////////////////////////////////////////////////////////////////////////////

if($user['level'] > 1) {

  $member = mysql_query('SELECT * FROM `coliseum_member` WHERE `user` = "'.$user['id'].'" AND `exit` = "0" ORDER BY `time` DESC LIMIT 1');
  $member = mysql_fetch_array($member);
  
  if($member) {
  $battle = mysql_query('SELECT * FROM `coliseum` WHERE `id` = "'.$member['battle'].'"');
  $battle = mysql_fetch_array($battle);}

  
  if($member['exit'] == 0 && $battle['start'] == 1 && $battle['end'] == 0) {
	  
  if(mysql_result(mysql_query('SELECT COUNT(*) FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'" AND `dead` = "0"'),0) == 1) {  
mysql_query('UPDATE `coliseum` SET `end` = "1" WHERE `id` = "'.$battle['id'].'"');
header('location: /coliseum/');
exit;}
    if($member['dead'] == '1') {//Если вас убили 
echo'<br><div class="aablock13">
   <div class="aeblck19">
    <div class="cntr">
     <a href="?" class="ubtn inbl mt-15 green mb2"><span class="ul"><span class="ur">Ждать окончания боя</span></span></a>
    </div>
   </div>
  </div>';

echo '<font color="red">Ваш герой погиб!!!</font>';
}else{ 
    if($_GET['exit'] == true) {//Ливаем с боя
mysql_query('INSERT INTO `coliseum_log` (`battle`,
                                         `user`,
                                         `opponent`,
                                         `text`) VALUES ("'.$battle['id'].'",
                                                         "'.$user['id'].'",
                                                         "'.$opponent['id'].'",
                                                         "'.$log.'")');
mysql_query('UPDATE `coliseum_member` SET `dead` = "1" WHERE `battle` = "'.$battle['id'].'" AND `user` = "'.$user['id'].'"');
header('location: /coliseum.php');
exit;}
  
  
  if($member['opponent'] == 0) {//Даем противника
$rand_opponent = mysql_query('SELECT * FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'" AND `dead` = "0" AND `user` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
$rand_opponent = mysql_fetch_array($rand_opponent);
mysql_query('UPDATE `coliseum_member` SET `opponent` = "'.$rand_opponent['id'].'" WHERE `battle` = "'.$battle['id'].'" AND `user` = "'.$user['id'].'"');
header('location: /coliseum/');
}


if($member['opponent']) {

  if($_GET['last'] == true) {//Меняем противника кнопкой
$rand_opponent = mysql_query('SELECT * FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'" AND `dead` = "0" AND `user` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
$rand_opponent = mysql_fetch_array($rand_opponent);
mysql_query('UPDATE `coliseum_member` SET `opponent` = "'.$rand_opponent['id'].'" WHERE `battle` = "'.$battle['id'].'" AND `user` = "'.$user['id'].'"');
header('location: /coliseum/');
}


$memberOpponent = mysql_fetch_array(mysql_query('SELECT * FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'" AND `id` = "'.$member['opponent'].'"'));
$memberColiseum = mysql_fetch_array(mysql_query('SELECT * FROM `coliseum_member` WHERE `user` = "'.$user['id'].'"'));

    $opponent = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$memberOpponent['user'].'"');
    $opponent = mysql_fetch_array($opponent);

  
  
  
  ////////////////////////////////////
  //////////////////////////////////////
  if($_GET['attack'] == true && $memberOpponent['dead'] == 0) {
    
$my_attack = round(rand($memberColiseum['str'] * 2.4 * 0.15,$memberColiseum['str'] * 2.5 * 0.15) - ($memberOpponent['def'] / 5 * 0.75));
if($my_attack <= '0'){ $my_attack = 5;}


	
		



    
  
    
  
    if($my_attack == 0 AND $my_attack <= $memberOpponent['vit'])  {
    $log = 'Вы промахнулись';
    }elseif($my_attack <= $memberOpponent['vit']){
    $log='<font color="lime"> Вы ударили '.nick($memberOpponent['user']).'  на '.$my_attack.'</font> '; 
	
	
	
    mysql_query("INSERT INTO `coliseum_log` (`battle`,
                                             `user`,
                                             `opponent`,
                                             `text`,
                                             `show`) VALUES ('".$battle['id']."',
                                                             '".$user['id']."',
                                                             '0',
                                                             '".$log."',
                                                             '".$user['id']."')");
    }

	
    
    if($my_attack > 0) {
	$log='<font color="red"> '.nick($memberColiseum['user']).' ударил Вас на '.$my_attack.'</font> '; 
    mysql_query("INSERT INTO `coliseum_log` (`battle`,
                                             `user`,
                                             `opponent`,
                                             `text`,
                                             `show`) VALUES ('".$battle['id']."',
                                                             '".$memberOpponent['user']."',
                                                             '".$user['id']."',
                                                             '".$log."',
                                                             '".$memberOpponent['user']."')");
    
	}
	/* Если хотим чтобы другие видили логи 
    if($my_attack > 0) {
	$log='<font color="#90b0c0"> '.nick($memberColiseum['user']).' ударил '.nick($memberOpponent['user']).' на '.$my_attack.'</font> '; 
    mysql_query("INSERT INTO `coliseum_log` (`battle`,
                                             `user`,
                                             `opponent`,
                                             `text`) VALUES ('".$battle['id']."',
                                                             '".$user['id']."',
                                                             '".$memberOpponent['user']."',
                                                             '".$log."')");
    }
	*/



	mysql_query('UPDATE `coliseum_member` SET `vit` = `vit` - "'.$my_attack.'" WHERE `battle` = "'.$battle['id'].'" AND `user` = "'.$memberOpponent['user'].'"');
    mysql_query('UPDATE `coliseum_member` SET `time` = "'.time().'", `dmg` = `dmg` + "'.$my_attack.'" WHERE `battle` = "'.$battle['id'].'" AND `user` = "'.$user['id'].'"');






    if($my_attack >= $memberOpponent['vit']) {
    $log='<font color="lime"> Вы убили '.nick($memberOpponent['user']).' </font> ';        
    mysql_query("INSERT INTO `coliseum_log` (`battle`,
                                             `user`,
                                             `opponent`,
                                             `text`,
                                             `show`) VALUES ('".$battle['id']."',
                                                             '".$user['id']."',
                                                             '".$opponent['id']."',
                                                             '".$log."',
                                                             '".$user['id']."')");
    $log='<font color="red"> '.nick($user['id']).' убил Вас </font> ';   
    mysql_query("INSERT INTO `coliseum_log` (`battle`,
                                             `user`,
                                             `opponent`,
                                             `text`,
                                             `show`) VALUES ('".$battle['id']."',
                                                             '".$opponent['id']."',
                                                             '".$user['id']."',
                                                             '".$log."',
                                                             '".$opponent['id']."')");
    
    $log='<font color="#90b0c0"> '.nick($user['id']).' убил '.nick($memberOpponent['user']).' </font> ';
    mysql_query("INSERT INTO `coliseum_log` (`battle`,
                                             `user`,
                                             `opponent`,
                                             `text`) VALUES ('".$battle['id']."', 
                                                             '".$user['id']."',
                                                             '".$opponent['id']."',
                                                             '".$log."')");


      mysql_query('UPDATE `coliseum_member` SET `dead` = "1" WHERE `battle` = "'.$battle['id'].'" AND `user` = "'.$memberOpponent['user'].'"');
      mysql_query('UPDATE `coliseum_member` SET `kills` = `kills` + 1 WHERE `battle` = "'.$battle['id'].'" AND `user` = "'.$user['id'].'"');

      $rand_opponent = mysql_query('SELECT * FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'" AND `dead` = "0" AND `user` != "'.$user['id'].'" ORDER BY RAND() LIMIT 1');
      $rand_opponent = mysql_fetch_array($rand_opponent);

      mysql_query('UPDATE `coliseum_member` SET `opponent` = "'.$rand_opponent['id'].'" WHERE `battle` = "'.$battle['id'].'" AND `user` = "'.$user['id'].'"');

    }
header('Location:/coliseum/');
exit;}
//////////////////////////////////
//////////////////////////////////
/*

  echo'<div class="empty_block item_center">
  <table align="center" style="width:100%;"> <tbody><tr>
 <td style="width:33%;">
 <span style="float:right;"> <b>Вы</b> </span> <br>
 <span style="float:right;"> <img src="/images/ico/png/hp.png" alt="*" width="15"> '._string($member['vit']).' </span>               
    </td>
  <td style="width:33%;">
    <span style="float:left;"> <b>'.nick($memberOpponent['user']).'</b> </span> <br>
    <span style="float:left;"> <img src="/images/ico/png/hp.png" alt="*" width="15"> '._string($memberOpponent['vit']).'  </span> 
  </td></tr>
 </tbody></table></div> 
 <div class="line"></div>';
*/



?>

</div>

<?

  }
  
  

		
		
	$memberColiseum = mysql_fetch_array(mysql_query('SELECT * FROM `coliseum_member` WHERE `user` = "'.$user['id'].'"'));
	$opponentColiseum = mysql_fetch_array(mysql_query('SELECT * FROM `coliseum_member` WHERE `user` = "'.$memberColiseum['opponent'].'"'));
	
	
echo '  <div class="bdr bg_blue mb2">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="fl ml10 mt10">
           	    <td> <img src="/images/user/'.$opponent['sex'].'.png" alt="*" width="48"> </td>';
          echo '</div> 
           <div class="ml68 mt10 mb10 mr10 sh"> 
            <span class="lwhite tdn">'.nick($memberOpponent['user']).'</span> 

            <div class="small mb2"> 
             <span class="fr rdmg"></span> 
             <span class="lorange"> <img src="http://144.76.127.94/view/image/icons/strength.png" class="va_t" height="16" width="16" alt=""> '._string($memberOpponent['str']).' <img src="http://144.76.127.94/view/image/icons/health.png" class="va_t" height="16" width="16" alt=""> '._string($memberOpponent['vit']).' <img src="http://144.76.127.94/view/image/icons/defense.png" class="va_t" height="16" width="16" alt=""> '._string($memberOpponent['def']).' </span> 
            </div> 
            <div class="prg-bar fght">
             <div class="prg-green fl" style="width:100%;"></div>
             <div class="prg-red fl" style="width:0%;"></div>
            </div>
           </div> 
          </div> 
          <div class="clb"></div> 
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
  
  <div class="cntr mb10 mt-5"> 
   <div class="fr w50">
   
    <div class="imcon6">
     <div class="idblck6">
      <a href="/coliseum/?attack=true" class="ubtn inbl s red_no"><span class="ul"><span class="ur">Атаковать</span></span></a>
     </div>
    </div>
    <div class="imcon6">
    </div>
   </div>
  
   <div class="fl w50"> 
    <div class="cbgcont9">
     <div class="ceblck23">
      <a href="/coliseum/?last=true" class="ubtn inbl s blue_no"><span class="ul"><span class="ur">Сменить</span></span></a>
     </div>
    </div>


     </div>
    </div>
   </div> 
  </div> 
  <div class="clb"></div> 
  <div class="bdr bg_blue mb2">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="fl ml10 mt10">
           	<td> <img src="/images/user/'.$user['sex'].'.png" alt="*" width="48"><td> ';
           echo '</div> 
           <div class="ml68 mt10 mb10 mr10 sh"> 
            <span class="lwhite tdn">'.$user['login'].'</span> 
            <div class="small mb2"> 
             <span class="fr rdmg"> </span> 
             <span class="lorange"> <img src="http://144.76.127.94/view/image/icons/strength.png" class="va_t" height="16" width="16" alt=""> '._string($user['def']).' <img src="http://144.76.127.94/view/image/icons/health.png" class="va_t" height="16" width="16" alt=""> '._string($user['vit']).' <img src="http://144.76.127.94/view/image/icons/defense.png" class="va_t" height="16" width="16" alt=""> '._string($user['def']).' </span> 
            </div> 
            <div class="prg-bar fght">
             <div class="prg-green fl" style="width:100%;"></div>
             <div class="prg-red fl" style="width:0%;"></div>
            </div>
           </div> 
          </div> 
          <div class="clb"></div> 
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div> 
  <div class="cntr mb10 mt-5"> 
  </div> 

   <div>
    <div></div>
   </div>
  </div>
  
<div class="wr8"><div class="ml10 mt5 mb5 mr10 sh small cntr">  
  ';
	
/*
echo' <div class="block_link"><a href="/coliseum/?attack=true"> <img src="/images/ico/png/attack.png" alt="attack"> Атаковать </a></div>
	  <div class="line"></div>
	  <div class="block_link"><a href="/coliseum/?last=true"> <img src="/images/ico/png/attack.png" alt="attack"> Сменить цель </a></div>';
	  */
}

echo'	</div>
  <div class="hr_g mb2">
   <div>
    <div></div>
   </div>
  </div> 
  <div class="bntf">
   <div class="small">
    <div class="nl">
     <div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">';
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `coliseum_log` WHERE `battle` = "'.$battle['id'].'"'),0);
if($count > 0) {



$q = mysql_query('SELECT * FROM `coliseum_log` WHERE `battle` = "'.$battle['id'].'" ORDER BY `id` DESC LIMIT 15');
  while($row = mysql_fetch_array($q)) {
    if($row['user'] == $user['id'] && $row['show'] == $user['id'] OR $row['opponent'] == $user['id'] && $row['show'] == $user['id']) {
   echo '<font color=\'#'.($row['opponent'] == 0 ? 'ffffff':'c06060').'\'>'.$row['text'].'</font><br/>';
  }elseif($row['show'] == 0){
    if($row['user'] == $user['id']) {
  }else{
    if($row['opponent'] == $user['id']) {
    }else{
   echo $row['text'].'<br/>';
  }
  }
  }
}
  

echo'</div>';
}else{
echo'<font color="lime">Битва началась</font>';	  
}
echo'</div><div class="line"></div>           </div> 
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>   </div>   </div>   </div>   </div>   </div>
  </div> ';



  if($member['dead'] == 0) {
echo'<a class=mbtn mb2 href="/coliseum/?exit=true"><img src="/images/ico/png/logout.png" alt="*"/> Покинуть бой</a>
</div><div class="line"></div>';
}
  
  }else{
///////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
  if($member['exit'] == 0 && $battle['start'] == 1 && $battle['end'] == 1 ) {//Если битва закончилась

$q = mysql_query('SELECT * FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'" ORDER BY `kills` DESC  LIMIT '.mysql_result(mysql_query('SELECT COUNT(*) FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'"'),0).'');
while($row = mysql_fetch_array($q)) {
$i++;
if($i == 1) {
    $best = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'"');
    $best = mysql_fetch_array($best);}
  if($row['user'] == $user['id']) {
    $place = $i;}
  }

if($member['dmg'] != '0'){$_s =  240 + (360 * $member['kills']);}else{$_s=0;}
if($member['dmg'] != '0'){$_exp =  360 + (540 * $member['kills']);}else{$_exp=0;}
    
    if($clan_memb && $clan_memb['v'] > 0) {
$_exp += round($_exp/100) * $_clan_memb['v'];
}
$_valor = $lair_mobs['valor'] + rand(1,7);  
  if($premium) {
$_exp+= round($_exp/ 100) * 25;
}

  mysql_query('UPDATE `users`  SET `valor_exp` = `valor_exp` + '.$_valor.' WHERE `id` = "'.$user['id'].'"');


      if($clan) {
mysql_query('UPDATE `clans`     SET `exp` = `exp` + '.$_exp.' WHERE `id` = "'.$clan['id'].'"');
mysql_query('UPDATE `clan_memb` SET `exp` = `exp` + '.$_exp.' WHERE `clan` = "'.$clan['id'].'" AND `user` = "'.$user['id'].'"');
}




  echo' <div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Колизей 
    </div>
   </div>
  </div> 
   <div>
    <div></div>
   </div>
  </div>
  <div class="bntf">
   <div class="nl">
    <div class="nr cntr lyell lh1 p5 sh">
    </div>
   </div>
  </div>
  <div class="hr_g mb2">
   <div>
    <div></div>
   </div>
  </div> 
  <div class="bdr bg_blue">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="mt10 mb5 sh cntr"> 
             <span class="win">Победил</span> 
              '.nick($best['id']).' 
           </div> 
           <div class="hr_arr mlr10 mb5">
            <div class="alf">
             <div class="art">
              <div class="acn"></div>
             </div>
            </div>
           </div> 
           <div class="mb5 mr10 sh cntr">
             Результаты 
            <div class="mb2"></div> 
            <table class="mrauto"> 
             <tbody>
              <tr>';

$q = mysql_query('SELECT * FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'" ORDER BY `kills` AND `dmg` DESC LIMIT '.mysql_result(mysql_query('SELECT COUNT(*) FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'"'),0).'');

  while($row = mysql_fetch_array($q)) {
$d++;
if($d == 1) {  $_rating = +mt_rand(17,26);  }
if($d == 2) {  $_rating = +mt_rand(8,16);   }
if($d == 3) {  $_rating = mt_rand(-8,8);   }
if($d == 4) {  $_rating = -mt_rand(8,16);  }
if($d == 5) {  $_rating = -mt_rand(17,26); }
    $coliseum_user = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'"');
    $coliseum_user = mysql_fetch_array($coliseum_user);


mysql_query('UPDATE `users` SET `coliseum_rating` = "'.($coliseum_user['coliseum_rating'] + $_rating).'" WHERE `id` = "'.$coliseum_user['id'].'"');



echo '<td width="33%">  <span style="float:right;"><div class=cntr><a href="/user/'.$coliseum_user['id'].'">'.nick($coliseum_user['id']).' </a></div></span></td>
		
	               <td class="lft nwr plr10"> 
                <div class="mw90px"> 
                 <div class="win fl">
		<font color="'.($_rating >= 0 ? 'lime':'red').'">+ '.$_rating.'</font>
                 </div> 
                </div> </td> 
              </tr> 
              <tr>';
  }

echo '              <br><br><td class="rgt w50 nwr pt5"><span class="win">Награда:</span></td> 
               <td class="lft w50 nwr plr10 pt5"> 
                <div class="lyell fl"> 
                 Серебро: +  '.$_s.'<br>
                 Опыт: + '.$_exp.'
                </div></td>
              </tr> 
              <tr><br>
               <td class="rgt w50 nwr"><span class="win">Бонус:  </span></td> 
               <td class="lft w50 nwr plr10">
                <div class="lyell fl">
                 Добесть: +
                 '.$_valor.'
                </div></td>
              </tr> 
             </tbody>
            </table> 
           </div> 
           <div class="hr_arr mlr10 mb5">
            <div class="alf">
             <div class="art">
              <div class="acn"></div>
             </div>
            </div>
           </div> 
           <div class="cntr mb2">
            Ваш рейтинг: '.$user['coliseum_rating'].'
            <br> 
'.$liga.'
           </div> 
           <div class="mb10 mr10 sh cntr"> 
           </div> 
           <div class="clb"></div> 
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div><br>
  <div class="cntr mb10">
   <a href="?enter=true" class="ubtn inbl mt-15 green mb2"><span class="ul"><span class="ur">Встать в очередь</span></span></a>
  </div> 
  <div class="hr_g mb2">
   <div>
    <div></div>
   </div>
  </div> 
  <div class="bntf">
   <div class="small">
    <div class="nl">
     <div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">
       В колизее проходят битвы между героями, каждый сам за себя.
     </div>
    </div>
   </div>
  </div> 
   <div>
    <div></div>
   </div>
  </div> 
   <div>
    <div></div>
   </div>
  </div> ';
/*
 echo'<font color="lime">Награда:</font>
<img src="/images/ico/png/silver.png" alt="*"/> '.$_s.'  
<img src="/images/ico/png/exp.png" alt="*"/> '.$_exp.' 
<img src="/images/ico/png/valor_exp.png" alt="*"/> '.$_valor.'
</div>
<div class="line"></div>
 
<div class="empty_block item_center"> 
<font color="#90b0c0">Ваш рейтинг: <b>
'.$user['coliseum_rating'].'
</b></br>
'.$liga.'
</font> </br>
<a href="?enter=true"><input class="button" type="submit" value="Встать в очередь"/></a>
</div><div class="line"></div>
<div class="empty_block item_center">
В колизее проходят битвы между героями, каждый сам за себя. Подробнее <a href="?">здесь</a>
</div>
<div class="line"></div>';
*/

/*
echo '  <div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Колизей 
    </div>
   </div>
  </div> 
  <div class="bdr bg_blue">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="cntr mt5 mb2"> 
            <div class="mb5">
             <img src="http://144.76.127.94/view/image/coliseum.jpg" alt="">
            </div> Ваш рейтинг: 1880
            <br> 
            <span class="small"><img src="http://144.76.127.94/view/image/quality_cloth/2.png" class="icon"> Лига охотников</span> 
            <br>
            <span class="small lorange">До конца сезона 5д 1ч </span> 
           </div> 
           <div class="mb10 mr10 sh cntr"> 
           </div> 
           <div class="clb"></div> 
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div> 
  <div class="cntr mb10">
   <a href="/pvp?in=1&amp;r=138" class="ubtn inbl mt-15 green mb2"><span class="ul"><span class="ur">Встать в очередь</span></span></a>
  </div> 
  <div class="hr_g mb2">
   <div>
    <div></div>
   </div>
  </div> 
  <div class="bntf">
   <div class="small">
    <div class="nl">
     <div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">
       В колизее проходят битвы между героями, каждый сам за себя.&nbsp;Подробнее 
      <a href="/pvp/info">здесь</a> 
     </div>
    </div>
   </div>
  </div> 
  <div class="hr_g mb2">
   <div>
    <div></div>
   </div>
  </div> ';


*/





/*
mysql_query('DELETE FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'" AND `user` = "'.$user['id'].'"');
*/
if($best['id'] == $user['id']){
// Задания
$task_id=3;// Победи в 2 битвах в колизее
$req = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
   if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
   if ($t['how'] < $task['how']){                               
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
}
// Задания
$task_id=4;// Проведи 6 боев в Колизее
$req = mysql_query ('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
   if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
   if ($t['how'] < $task['how']){                             
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}} 

mysql_query('UPDATE `coliseum_member` SET `exit` = "1" WHERE `battle` = "'.$battle['id'].'" AND `user` = "'.$user['id'].'"');
include './system/f.php';
exit;}

$i = mysql_fetch_assoc(mysql_query("SELECT * FROM `coliseum` WHERE `users` = '2' ORDER BY `id` DESC LIMIT 1"));
$i2 = mysql_fetch_assoc(mysql_query("SELECT * FROM `coliseum` ORDER BY `id` DESC LIMIT 1"));

//////////////////////////////////////////////////////  
/*
  echo''.mysql_result(mysql_query('SELECT COUNT(*) FROM `coliseum` WHERE '.mysql_result(mysql_query('SELECT COUNT(*) FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'"'),0).' >= "1" '),0).'';
///////////////////////////////////////////////////////  
*///////// 
 if(mysql_result(mysql_query('SELECT * FROM `coliseum` '),0) == 0) {//если нет боёв
mysql_query('INSERT INTO `coliseum` (`start`,
                                     `end`,
                                     `time`) VALUES ("0",
                                                     "0",
                        							 "0")'); 										 
header('location: /coliseum/');  
exit;}





    $battle = mysql_fetch_array(mysql_query('SELECT * FROM `coliseum` WHERE `start` = "0" '));



$time_start=time() + 6;//Начинаем бой через 60сек
if(mysql_result(mysql_query('SELECT COUNT(*) FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'" AND `exit` = "0"'),0) < 5 && mysql_result(mysql_query('SELECT COUNT(*) FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'" AND `user` = "'.$user['id'].'" '),0) == 0) {
  if($_GET['enter'] == true && mysql_result(mysql_query('SELECT COUNT(*) FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'" AND `exit` = "0"'),0) < 3) {  
	 
//Для того кто первый подает заявку

mysql_query('UPDATE `coliseum` SET `users` = `users` + "1" WHERE `id` = "'.$battle['id'].'"'); 
mysql_query('INSERT INTO `coliseum_member` (`battle`,
                                            `user`,
											`str`,
											`vit`,
											`def`,
                                            `time`) VALUES ("'.$battle['id'].'",
                                                            "'.$user['id'].'",
															"'.$user['str'].'",
															"'.$user['vit'].'",
															"'.$user['def'].'",
                                                            "0")'); 	

if(mysql_result(mysql_query('SELECT COUNT(*) FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'" '),0) == 3){

  														
mysql_query('INSERT INTO `coliseum` (`start`,
                                     `end`,
                                     `time`) VALUES ("0",
                                                     "0",
                        							 "0")'); 
}											 
header('location: /coliseum/');  
exit;
}

echo '  <div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Колизей 
    </div>
   </div>
  </div> 
  <div class="bdr bg_blue">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="cntr mt5 mb2"> 
            <div class="mb5">
            <img src="/images/coliseum.jpg" alt="*"/></br>

            <br> 
Ваш рейтинг: <b>'.$user['coliseum_rating'].'</b></br>'.$liga.'</br>
           </div> 
           <div class="mb10 mr10 sh cntr"> 
           </div> 
           <div class="clb"></div> 
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div> <br>
  <div class="cntr mb10">
   <a href="?enter=true" class="ubtn inbl mt-15 green mb2"><span class="ul"><span class="ur">Встать в очередь</span></span></a>
  </div> 
  <div class="hr_g mb2">
   <div>
    <div></div>
   </div>
  </div> 
  <div class="bntf">
   <div class="small">
    <div class="nl">
     <div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">
       В колизее проходят битвы между героями, каждый сам за себя.
     </div>
    </div>
   </div>
  </div> 
   <div>
    <div></div>
   </div>
  </div> 
  <div class="bdr bg_blue mb5">
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div> 
   <div>
    <div></div>
   </div>
  </div> ';
  /*
  
echo'<div class="empty_block item_center">
<img src="/images/coliseum.jpg" alt="*"/></br>
Ваш рейтинг: <b>'.$user['coliseum_rating'].'</b></br>'.$liga.'</br>

<a href="?enter=true"><input class="button" type="submit" value="Встать в очередь"/></a>
</div><div class="line"></div>
<div class="empty_block item_center">
В колизее проходят битвы между героями, каждый сам за себя. Подробнее <a href="?">здесь</a>
</div>
<div class="line"></div>';
*/

}else{

  if($_GET['exit'] == true && mysql_result(mysql_query('SELECT COUNT(*) FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'" AND `exit` = "0" '),0) < 5) {
mysql_query('DELETE FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'" AND `user` = "'.$user['id'].'"');
header('location: /coliseum/');
exit;
}
  
  if(mysql_result(mysql_query('SELECT COUNT(*) FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'" && "'.$battle['end'].'" = "0" AND `exit` = "0" '),0) == 3) {
	  /*if($battle['time'] < time() AND $battle['start'] == "0") {

mysql_query('UPDATE `coliseum` SET `time` = "'.$time_start.'" WHERE `id` = "'.$battle['id'].'"');
header('location: /coliseum/');
exit; }*/
  if($battle['time'] > time() ) {
  
echo ' <div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Колизей 
    </div>
   </div>
  </div> 
  <div class="bdr bg_blue">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="mb10 mr10 sh cntr"> 
            <div class="mt5">
              В очереди: '.mysql_result(mysql_query('SELECT COUNT(*) FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'" AND `exit` = "0" '),0).' из 5 
            </div> 
            <div class="cntr mb10 mt10 lh1">
             <a href="/pvp?r=886" class="ubtn inbl green"><span class="ul"><span class="ur">Обновить</span></span></a>
            </div> 
            <div class="mb5 mt5">
             <img src="http://144.76.127.94/view/image/coliseum.jpg" alt="">
            </div> 
            <div class="hr_arr mlr10 mb5">
             <div class="alf">
              <div class="art">
               <div class="acn"></div>
              </div>
             </div>
            </div> 
            <div class="cntr mb5 mt5 lh1">
             <a class="grey1" href="/pvp?out=1&amp;r=940">Покинуть очередь</a>
            </div> 
           </div> 
           <div class="clb"></div> 
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div> 
  <div class="hr_g mb2 mt10">
   <div>
    <div></div>
   </div>
  </div> ';
  
  
echo'<div class="empty_block item_center">
<font color="#90b0c0">
Битва начинается! </br>
До начала боя: '.($battle['time'] - time()).' секунд </font><br/>
<a href="?"><input class="button" type="submit" value="Обновить"/></a></br>
<font color="#90b0c0">Учасники</font>';

	$req = mysql_query('SELECT * FROM `users` ORDER by `coliseum_rating` DESC');
while($row_us = mysql_fetch_array($req)) {
    $c = mysql_query('SELECT * FROM `coliseum_member` WHERE `user` = "'.$row_us['id'].'" AND `battle` = "'.$battle['id'].'"  LIMIT 5');
while($row = mysql_fetch_array($c)){
	echo'<table width="100%">
<tbody><tr>
		<td width="33%">  <span style="float:right;"><a href="/user/'.$row_us['id'].'">'.nick($row_us['id']).' </a>:</span> </td>
		<td width="33%">  <span style="float:left;"> '.$row_us['coliseum_rating'].'</span>  </td>
</tbody></tr>
</table>';
  }
  }
echo'</div><div class="line"></div>';

include './system/f.php';
exit;
}else{
mysql_query('UPDATE `coliseum` SET `start` = "1", time = "0" WHERE `id` = "'.$battle['id'].'"');
header('location: /coliseum/');
}
}
echo ' <div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Колизей 
    </div>
   </div>
  </div> 
  <div class="bdr bg_blue">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="mb10 mr10 sh cntr"> 
            <div class="mt5">
В очереди '.mysql_result(mysql_query('SELECT COUNT(*) FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'" AND `exit` = "0" '),0).'  из 5 </br>
            </div> 
            <div class="cntr mb10 mt10 lh1">
             <a href="?" class="ubtn inbl green"><span class="ul"><span class="ur">Обновить</span></span></a>
            </div> 
            <div class="mb5 mt5">
             <img src="http://144.76.127.94/view/image/coliseum.jpg" alt="">
            </div> 
            <div class="hr_arr mlr10 mb5">
             <div class="alf">
              <div class="art">
               <div class="acn"></div>
              </div>
             </div>
            </div> 
            <div class="cntr mb5 mt5 lh1">
             <a class="grey1" href="/coliseum/?exit=true">Покинуть очередь</a>
            </div> 
           </div> 
           <div class="clb"></div> 
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div> 
   <div>
    <div></div>
   </div>
  </div> ';
/*
echo'<div class="empty_block item_center">
<img src="/images/coliseum.jpg" alt="*"/></br>
В очереди '.mysql_result(mysql_query('SELECT COUNT(*) FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'" AND `exit` = "0" '),0).'  из 5 </br>

<a href="?"><input class="button" type="submit" value="Обновить"/></a></br>
<a href="/coliseum/?exit=true"><input class="button" type="submit" value="Покинуть очередь"/></a>
</div><div class="line"></div>';
*/
}


}


}else{
echo'<div class="empty_block item_center">
Для участии в <img src="/images/ico/png/coliseum.png" width="18" alt="*"/> Колизее требуется <img src="/images/ico/png/up.png" width="18" alt="*"/> 10 уровень
</div>
<div class="line"></div>';


 
 }
  
include './system/f.php';

?>