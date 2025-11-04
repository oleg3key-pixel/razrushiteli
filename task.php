<?php
include './system/common.php';  
include './system/functions.php';
include './system/user.php';
include './system/task.php';
//-----Если гость,то...-----//
if(!$user['id']) {
header('Location: /');
exit();}






    $data=strtotime('00:00');//Когда будет доступно задание
	if(time() <= $data){
	$dateStart =  strtotime('00:00');
	}else{
	$dateStart = strtotime('next day 00:00');
	}








 
 

echo' '.$_SESSION['mes'].' ';
    $_SESSION['mes']=NULL; //Удаляем сесию




$act = isset($_GET['act']) ? $_GET['act'] : null;
switch($act){
default:
$title = 'Задания';
include './system/h.php';


// Выполнение квеста
if (isset ($_GET['complete'])) {
	
	 

$_GET['complete'] = (int) $_GET['complete'];
$req = mysql_query ('select * from `task_user` WHERE (`user`="' . $user['id'] . '") AND (`task`="' . $_GET['complete'] . '")');
  if (mysql_num_rows ($req)==0) {
header ('location: /task');
exit;}

$task_user = mysql_fetch_array ($req);
    if ($task_user['complete']==1) {
header ('location: /task');
exit;}

$q_ = mysql_query ('SELECT * FROM `task` WHERE (`id`="' . $task_user['task'] . '")');
$task = mysql_fetch_array ($q_);
    
    if ($task_user['how']<$task['how']) {
header ('location: /task');
exit;}
      if($task['type'] == 'daily'){
$kluch = rand(3,10);  	
}else{
$kluch = 0;  
}	
	
    mysql_query ('UPDATE `task_user` SET `complete`="1", `time`="'.$dateStart.'" WHERE (`user`="' . $user['id'] . '") AND (`task`="' . $task['id'] . '")');
    mysql_query ('UPDATE `users` SET  `g`=`g`+'.$task['_gold'].', `s`=`s`+'.$task['_silver'].', `exp`=`exp`+'.$task['_exp'].',  `task_kluch`=`task_kluch`+'.$kluch.',  `maze_kluch`=`maze_kluch`+'.$kluch.'  WHERE (`id`="' . $user['id'] . '")');
    mysql_query ('UPDATE `users` SET  `g`=`g`+'.$task['_gold'].', `s`=`s`+'.$task['_silver'].', `exp`=`exp`+'.$task['_exp'].',  `task_kluch`=`task_kluch`+'.$kluch.',  `maze_kluch`=`maze_kluch`+'.$kluch.' WHERE (`id`="' . $user['id'] . '")');





	   if(date('w') != 0 AND date('w') != 7){

		$clans_q = mysql_fetch_array(mysql_query('SELECT * FROM `clans_q` WHERE `clans` = "'.$clan['id'].'"LIMIT 1'));
		if($clans_q['user_9'] == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_9` = "'.($clans_q['q_9'] >= "25" ? "25":($clans_q['q_9'] + $kluch)).'" WHERE `clans` = "'.$clan['id'].'"');
		}
		if($clans_q['user_10'] == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_10` = "'.($clans_q['q_10'] >= "80" ? "80":($clans_q['q_10'] + $kluch)).'" WHERE `clans` = "'.$clan['id'].'"');
		}
		if($clans_q['user_9_p']  == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_9` = "'.($clans_q['q_9'] >= "25" ? "25":($clans_q['q_9'] + $kluch)).'" WHERE `clans` = "'.$clan['id'].'"');
		}
		if($clans_q['user_10_p'] == $user['id']){
		mysql_query('UPDATE `clans_q` SET `q_10` = "'.($clans_q['q_10'] >= "80" ? "80":($clans_q['q_10'] + $kluch)).'" WHERE `clans` = "'.$clan['id'].'"');
		}
}




$req_task = mysql_query ('select * from `task_user` WHERE (`user`="' . $user['id'] . '") AND (`complete`="0") AND (`type`="storyline")');
if (mysql_num_rows ($req_task) == 0) {
	$trophies = mysql_fetch_assoc(mysql_query("SELECT * FROM `trophies` WHERE `id`='".$user['lair_glava']."' ")); 
mysql_query('INSERT INTO `trophies_user` (`name`, `trophies_id`, `user_id`, `param`, `exp`, `silver`) VALUES ("'.$trophies['name'].'", "'.$trophies['id'].'", "'.$user['id'].'", "'.$trophies['param'].'", "'.$trophies['exp'].'", "'.$trophies['silver'].'" )');
mysql_query("UPDATE `users` SET `str`=`str`+'".$trophies['param']."', `vit`=`vit`+'".$trophies['param']."',`def`=`def`+'".$trophies['param']."', `lair_glava`=`lair_glava`+1, `trophies_exp`=`trophies_exp`+'".$trophies['exp']."', `trophies_silver`=`trophies_silver`+'".$trophies['silver']."' WHERE `id`='".$user['id']."' ");	
}
	



header ('location: /task'.($task['type'] == 'daily' ? '/daily':'').''); 
}
$lair = mysql_fetch_array(mysql_query('SELECT * FROM `lair` WHERE `id` = "'.$user['lair_glava'].'" '));


echo '<div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Задания
    </div>
   </div>
  </div> 

<div class="cntr win mb10 mt5">

		<div class="fl w49 cntr">
		<span class="slct">
			<span class="send">
				<a class="sttl" href="/task"><img src="http://144.76.127.94/view/image/menu/task.png" class="icon">&nbsp;Сюжетные </a>
			</span>
		</span>
	</div>
		<span class="spr2bg fl">&nbsp;</span>

			<div class="fl w49 pt3">
			<a class="" href="/task/daily"><img src="http://144.76.127.94/view/image/icons/task.png" class="icon">&nbsp;Ежедневные </a>
		</div>
	
	<div class="clb"></div>
</div>
	
  <div class="bdr cnr mb10 bg_green mb2">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="fl ml10 mt5 mb5 mr10 sh">
<img src="/images/ico/lair/lair'.$lair['img'].'_nowin.jpg" alt="*" width="72"/>
</div> 
           <div class="ml10 mt5 mb5 mr10 sh small "> 
            <span class="medium lwhite bold tdn">Глава '.$lair['id'].'. '.$lair['name'].'</span>
            <br> 
           </div> 
           <div class="ml100 mr10 mt5 mb5 sh small cntr"> 
            <div class="prg-bar fght mb2 mt5"> 
             <div class="prg-blue fl" style="width: 100%;"> 
             </div> 
            </div> 
           </div> 
           <div class="ml5 mt5 mb5 mr10 sh small"> 
            <span class="small lorange tdn">'.$lair['description'].'</span>
            <br> 
           </div> 
           <div class="ml10 mb5 mr10 sh small "> 
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
  </div> ';





// Список невыполненных заданий
$req = mysql_query ('select * from `task_user` WHERE (`user`="' . $user['id'] . '") AND (`complete`="0") AND (`type`="storyline") ORDER BY `id` ASC');
if (mysql_num_rows ($req) == 0) {
    echo '';//Пишем, что нет заданий
}else{
    while ($task_user = mysql_fetch_array ($req)) {        
        $task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="' . $task_user['task'] . '")'));
       
echo ' <div class="bdr cnr mb10 bg_blue mb2">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="ml10 mt5 mb5 mr10 sh small cntr"> 
           <span class="medium lwhite tdn"><img class="icon" height="16" src="http://144.76.127.94/view/image/icons/task.png"> '.$task['name'].' </span> 
           </div>';
  if ($task_user['how']>=$task['how']) {
    echo '  <center><img src="/images/ico/png/gold.png" alt="*" width="16"/> '.$task['_gold'].'
            <img src="/images/ico/png/silver.png" alt="*" width="16"/> '.$task['_silver'].'
            <img src="/images/ico/png/exp.png" alt="*" width="16"/> '.$task['_exp'].' </br></center>'; 
}
echo'           <div class="ml10 mb5 mr10 sh small cntr"> 
            <span class="green2">

Прогресс: '.$task_user['how'].' из '.$task['how'].'             </span>  </div> 
<br/>';   
  if ($task_user['how']>=$task['how']) {
echo '<div class="cntr"><a href="/task?complete='.$task['id'].'" class="ubtn inbl mt-5 green mb5"> <span class="ul"><span class="ur">Забрать награду</span></span></a></div>';


}




echo '           </div> 
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
<div class="line"></div>';
    }
}

break;









case 'daily':
$title = 'Задания';
include './system/h.php';




       
echo '<div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Задания
    </div>
   </div>
  </div> 
<div class="cntr win mb10 mt5">

		<div class="fl w49 cntr pt3">
		<a class="" href="/task"><img src="http://144.76.127.94/view/image/menu/task.png" class="icon">&nbsp;Сюжетные</a>
	</div>
		<span class="spr2bg fl">&nbsp;</span>

		<div class="fl w49">
		<span class="slct">
			<span class="send">
				<a class=" sttl" href="/task/daily"><img src="http://144.76.127.94/view/image/icons/task.png" class="icon">&nbsp;Ежедневные </a>
			</span>
		</span>
	</div>
	
	<div class="clb"></div>
</div>
<div class="bdr cnr mb10 bg_green mb2">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="fl ml10 mt5 mb5 mr10 sh">
            <img class="task_img" src="http://144.76.127.94/view/image/task/task_daily.png" width="80px">
           </div> 
           <div class="ml10 mt5 mb5 mr10 sh small"> 
            <span class="medium lwhite bold tdn">Выполняй здания и получай неплохие награды!</span>
            <br> 
           </div> 
           <div class="ml100 mr10 mt5 mb5 sh small cntr"> 
            <div class="prg-bar fght mb2 mt5"> 
             <div class="prg-blue fl" style="width: 100%;"> 
             </div> 
            </div> 
           </div> 
           <div class="ml5 mt5 mb5 mr10 sh small"> 
            <br> 
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
  </div> ';
  

// Обновление неактивных квестов
$req = mysql_query ('select * from `task_user` WHERE (`user`="' . $user['id'] . '") AND (`complete`="1") AND (`type`="daily") ');
if (mysql_num_rows ($req) < 10) {
    $i = 0;
    while ($task_user = mysql_fetch_array ($req)) {
        
  if ($task_user['time']<time ()) {
$i++;
if ($i < 10) {
mysql_query ('UPDATE `task_user` SET `complete`="0",`how`="0" WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_user['task'].'") AND (`type`="daily")');
   }
  }    
 }
}

// Список невыполненных заданий
$req = mysql_query ('select * from `task_user` WHERE (`user`="' . $user['id'] . '") AND (`complete`="0") AND (`type`="daily") ORDER BY `id` ASC');
if (mysql_num_rows ($req) == 0) {
    echo '';//Пишем, что нет заданий
}else{
    while ($task_user = mysql_fetch_array ($req)) {        
        $task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="' . $task_user['task'] . '")'));

echo ' <div class="bdr cnr bg_blue mb10">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="ml10 mt5 mb5 mr10 sh small cntr"> 
            <span class="medium lwhite tdn"><img class="icon" height="16" src="http://144.76.127.94/view/image/icons/task.png"> '.$task['name'].' </span> 
           </div> 
           <div class="ml10 mb5 mr10 sh small cntr"> 
            <span class="green2">Прогресс: '.$task_user['how'].' из '.$task['how'].' </span> 
           </div>';
             if ($task_user['how']>=$task['how']) 
           echo '<div class="cntr">
            <a href="/task?complete='.$task['id'].' " class="ubtn inbl mt-5 green mb5"> <span class="ul"><span class="ur">Забрать награду</span></span> </a>';
           echo '</div> 
           <div class="clb"></div> 
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div> ';
  
    }}

// Список выполненных задани
$req = mysql_query ('select * from `task_user` WHERE (`user`="' . $user['id'] . '") AND (`complete`="1") AND (`type`="daily")');
if (mysql_num_rows ($req) != 0) {

    while ($task_user = mysql_fetch_array ($req)) {
        $task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="' . $task_user['task'] . '")'));


echo '  <div class="bdr cnr bg_blue mb10">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="ml10 mt5 mb2 mr10 sh small cntr"> 
            <span class="medium grey1 tdn"><img class="icon" height="16" src="http://144.76.127.94/view/image/icons/task.png"> '.$task['name'].'  </span> 
           </div> 
           <div class="cntr">
            <span class="inbl grey1 mb5 small"> Будет доступно через: '._time($task_user['time']-time()).'  </span>
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

   }
}

echo '<div class="bntf">
   <div class="small">
    <div class="nl">
     <div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">
       Собрано ключей: '.$user['task_kluch'].'. Подробнее
      <a href="/task/dailyInfo">здесь</a>
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

break;



case 'dailyInfo':
$title = 'Личный турнир по ключам';
include './system/h.php';
echo ' <div class="bdr bg_blue">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="mt5 mb5 mlr10 lyell"> 
            <span style="color: #eacc54;"><span class="large">
              <div class="cntr">
               Личный турнир по ключам
              </div></span></span>
            <br>
            <span style="color: #7afe4e;">Выполняйте ежедневные задания и собирайте ключи. За каждое выполненное задание выдается от 1 до 3 ключей, случайно.</span>
            <br>
            <br>
            <span style="color: #eff0a1;">Турнир проводится еженедельно, с понедельника по воскресение. Участвуют все игроки.<br><br>В воскресение подводится итог, кто больше собрал ключей, тот и победил.</span>
            <br>
            <br>
            <span style="color: #7afe4e;">10 лучших игроков получают призы</span>
            <br>
            <br>
            <span style="color: #eff0a1;">1 место – <img class="icon" height="20" src="http://144.76.125.123//view/image/icons/gold.png">10000 золота<br>2 место – <img class="icon" height="20" src="http://144.76.125.123//view/image/icons/gold.png">9000 золота<br>3 место – <img class="icon" height="20" src="http://144.76.125.123//view/image/icons/gold.png">8000 золота<br><br>4 место – <img class="icon" height="20" src="http://144.76.125.123//view/image/icons/gold.png">7000 золота<br>5 место – <img class="icon" height="20" src="http://144.76.125.123//view/image/icons/gold.png">6000 золота<br>6 место – <img class="icon" height="20" src="http://144.76.125.123//view/image/icons/gold.png">5000 золота<br>7 место – <img class="icon" height="20" src="http://144.76.125.123//view/image/icons/gold.png">4000 золота<br><br>8 место – <img class="icon" height="20" src="http://144.76.125.123//view/image/icons/gold.png">3000 золота<br>9 место – <img class="icon" height="20" src="http://144.76.125.123//view/image/icons/gold.png">2000 золота<br>10 место – <img class="icon" height="20" src="http://144.76.125.123//view/image/icons/gold.png">1000 золота<br><br>Дополнительно, каждый игрок, даже если он не победил, за каждый собранный ключ получает награду серебром.</span>
            <br>
            <br>
</div>           </div> 
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div> 
  <div class="hr_g mb2">
   <div>
    <div></div>
   </div>
  </div> 
  <a class="mbtn mb2" href="/task/daily"><img class="icon" src="http://144.76.127.94/view/image/icons/back.png"> Назад к заданиям</a> 
  <div class="hr_g mb2">
   <div>
    <div></div>
   </div>
  </div> 
  <div class="hr_g mb2 mt10">
   <div>
    <div></div>
   </div>
  </div> ';

break;
}

include './system/f.php';
?>