<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

global $mysqli; // доступ к подключению из common.php

list($msec, $sec) = explode(' ', microtime());

// считаем онлайн игроков
$time = time();
$result = $mysqli->query(
    "SELECT COUNT(*) AS c FROM `users` WHERE `online` > '" . ($time - 10800) . "'"
);
$online = 0;
if ($result) {
    $row = $result->fetch_assoc();
    $online = (int)$row['c'];
}



if($user){







echo'<div class="hr_g mb10">
   <div>
    <div></div>
   </div>
  </div> 
  <div class="hr_g mb2 mt10">
   <div>
    <div></div>
   </div>
  </div> 
  <a class="mbtn mb2" href="/user"><img class="icon" src="/view/image/icons/png/hero.png"> Мой Герой</a>
  <a class="mbtn mb2" href="/clan"><img src="/view/image/icons/png/clan.png" class="icon"> Мой Клан</a>
  <a class="mbtn mb2" href="/start"><img class="icon" src="/view/image/icons/png/home.png"> Главная</a>';

if($user['access'] >= 1) { echo '<a class="mbtn mb2" href="/adm/"> <img class=icon src=/view/image/icons/png/password.png> Панель управления</a>';}
echo' <div class="hr_g mb2">
   <div>
    <div></div>
   </div>
  </div>';
 
  
  echo '<div class="cntr">
  
   <div class="cntr lorange small">
    <img class="icon" src="/view/image/icons/png/gold.png">'.n_f($user['g']).' | 
    <img class="icon" src="/view/image/icons/png/silver.png"> '.n_f($user['s']).'  |
    <img class="icon" width=16 src="/view/image/icons/png/keys.png"> '.n_f($user['maze_kluch']).'  
   </div>
  </div>
  
   <div class="hr_g mb2">
   <div>
    <div></div>
   </div>
  </div> 




 
  
 
   <div>
    <div></div>
   </div>
  </div>
  <div class="mbtn mb2 cntr">
   <a class="lblue" href="/chat?id=0">Чат</a> | 
   <a class="lblue" href="/forum">Форум</a>
</div>

   </div>
  </div> 
 <div class="hr_g mb2">
   <div>
    <div></div>
   </div>
  </div> 



        <a class="lwhite nd small bold" href="/actions.php"> 
   <div class="mt5 mb2 cntr">
    <img class="icon" src="/view/image/art/blick-action.png?2">
   </div> 
   <div class="mb5 cntr">
Бонусы Х10
</div> </a>
  <div class="hr_g mb2">
   <div>
    <div></div>
   </div>
  </div>



';
/*



'.n_f($online).'
*/

echo'
   <div>
    <div></div>
   </div>
  </div> 
   <div>
    <div></div>
   </div>
  </div> 

  <div class="ftr small">
   <div class="ftr_l cntr">
    <div class="ftr_r cntr">
     <div class="grey1 mb5">
      <a href="/settings" class="grey1">Настройки</a> | 
      <a class="grey1" href="/online">Онлайн: '.n_f($online).'</a> | 
      <a class="grey1" href="/icons.php">Надписи</a>
     </div>
     <div class="grey2">
      <span class="ib ml10"> </span>
      <div class="p_t_v11">'.round((($sec+$msec)-$gtime),3).' сек, <span id="time_s">'.date("H:i:s").'</span></div> 

<script type="text/javascript">var time = '.(date("s",$time)+date("i",$time)*60+date("H",$time)*86400).':</script>
      <a class="grey2" href="/tickets">Служба поддержки</a>
      <br><a href=http://trush.site>MegaMobile</a> © 2020, 16+
      <br>
     </div>
    </div>
   </div>
   <div class="hr_g mb2">
    <div>
     <div></div>
    </div>
   </div> 
   <div class="cntr"></div> 

  </div>';

}


echo'

</div></div></div></div></div></div></div></div>
<div class=cntr>
<div>
</body></html>




';

/*

 
*/  

  
ob_end_flush();

?>
