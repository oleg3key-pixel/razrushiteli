<?
include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';

include './system/h.php';



$id = _string(_num($_GET['id']));

if(!$id && $user) {
    $id = $user['id'];
}

  $i = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"');
  $i = mysql_fetch_array($i);








    $amulet = mysql_query('SELECT * FROM `amulet` WHERE `id` = "'.$user['amulet'].'"');
    $amulet = mysql_fetch_array($amulet);
    $amulet_new = mysql_query('SELECT * FROM `amulet` WHERE `id` = "'.($user['amulet']+1).'"');
    $amulet_new = mysql_fetch_array($amulet_new);


if($_GET['buy'] == true) {
  if($user['amulet'] >= '200'){
$_SESSION['mes'] = mes('У вас максимальный уровень амулета!');  
header('location: /amulet_x.php');
exit;}
  
  if($user['g'] < $amulet['gold']){
$_SESSION['mes'] = mes('Недостаточно золота!');  
header('location: /amulet_x.php');
exit;}


mysql_query('UPDATE `users` SET `g` = `g` - "'.$amulet_new['gold'].'" WHERE `id` = \''.$user['id'].'\'');
mysql_query('UPDATE `users` SET `str` = `str` + "'.$amulet_new['stat'].'",
                                    `vit` = `vit` + "'.$amulet_new['stat'].'",
                                    `def` = `def` + "'.$amulet_new['stat'].'",
                                    `amulet` = `amulet` + "1",
                                    `amulet_stat` = `amulet_stat` + "'.$amulet_new['stat'].'",
                                    `amulet_exp` = `amulet_exp` + "'.$amulet_new['exp'].'",
                                    `amulet_silver` = `amulet_silver` + "'.$amulet_new['silver'].'"                                    

                                     WHERE `id` = \''.$user['id'].'\'');
								 
$_SESSION['mes'] = mes('Амулет улучшен'); 
header('location: /amulet_x.php');
exit;
  
}

      echo' '.$_SESSION['mes'].'  ';
    $_SESSION['mes']=NULL; //Удаляем сесию



echo ' <div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Амулет игрока '.$i[login].'
    </div>
   </div>
  </div> ';
if($i['id'] == $user['id']){
  echo'  <div class="cntr lorange small mt-5"> 
   <span class="nowrap"> Ваши ресурсы: <img class="icon" src="/view/image/icons/png/gold.png">'.n_f($user['g']).' <img class="icon" src="/view/image/icons/png/silver.png">'.n_f($user['s']).'</span> 
  </div> ';
}
  echo'  <div class="bdr bg_green">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="fl ml10 mt10"> 
            <img src="/view/image/arena/amulet1.png"> 
           </div> 
           <div class="ml68 mt10 mb10 mr10 sh small lorange"> 
            <div class="medium lwhite tdn mb2">
              Ваш Амулет 
            </div> 
            <span class="lblue">Качество: '.$i['amulet'].' из 200</span>
            <div class="mt5"></div> +'.$i['amulet_stat'].' ко всем параметрам
            <br> +'.$i['amulet_exp'].'  к 
            <img class="icon" src="/view/image/icons/png/expirience.png">опыту
            <br> +'.$i['amulet_silver'].'  к 
            <img class="icon" src="/view/image/icons/png/silver.png">серебру
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
  </div>
  <div class="cntr">';
    if($user['amulet'] < '200' && $i['id'] == $user['id']){
  echo'<br><a  class="ubtn inbl mt-15 green mb5"   href="/amulet_x.php?buy=true">   <span class="ul"><span class="ur">'.($user['amulet'] != '0' ? 'Улучшить за <img src="/images/ico/png/gold.png" alt="*" width="16"/> '.$amulet_new['gold'].'':'Купить за <img src="/images/ico/png/gold.png" alt="*" width="16"/> '.$amulet_new['gold'].'').'</span></span></a>

 </div> 
  <div class="cntr small mb10">
    Станет '.($user['amulet_stat']+$amulet_new['stat']).'  к параметрам, +
   <img class="icon" src="/view/image/icons/png/expirience.png">'.($user['amulet_exp']+$amulet_new['exp']).', +
   <img class="icon" src="/view/image/icons/png/silver.png">'.($user['amulet_silver']+$amulet_new['silver']).'
  </div>';

}
echo '  <div class="hr_g mb2">
   <div>
    <div></div>
   </div>
  </div> 
  <div class="bntf">
   <div class="small">
    <div class="nl">
     <div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">
       Амулет увеличивает количество опыта и серебра, получаемые на арене, а так же повышает курс обмена золота на серебро
     </div>
    </div>
   </div>
  </div> 
  <div class="hr_g mb2">
   <div>
    <div></div>
   </div>
  </div> 
  <a class="mbtn mb2" href="/user/'.$i[id].'"><img src="/view/image/icons/png/back.png" class="icon"> Назад к герою</a>
   <div>
    <div></div>
   </div>
  </div> 
   <div>
    <div></div>
   </div>
  </div> ';







include ('./system/f.php');


