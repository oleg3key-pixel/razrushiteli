<?


include './system/common.php';
include './system/functions.php';
include './system/user.php';
    
if(!$user) header('location: /');
$title = 'Зеленый дракон';

include './system/h.php';


$sw ='Герой ';

$name = $sw. $user['login'];



$aid = mysql_query('SELECT * FROM `aid` WHERE `id`=3');       


   $aid = mysql_fetch_array($aid);


 
        $hp_aid = round(100/(500000/$aid['hp']));

  



 





if(!$aid) {


  mysql_query('INSERT INTO `aid` (`id`) VALUES (1)');


header('location:dragon3.php');exit;}



if($aid['status']==0 && $aid['time']<=time()){


mysql_query('UPDATE `aid` SET `hp` = 500000 ,`status`=1 WHERE `id` = 3');   


if($aid['gr']!=0){  mysql_query('UPDATE `users` SET `str` = `str`-2000,`vit`=`vit`-2000,`agi`=`agi`-2000,`def`=`def`-2000 WHERE `id` = "'.$aid['gr'].'"'); 
mysql_query('UPDATE `aid` SET `gr`=0 WHERE `id` =2');  }      


header('location:dragon3.php');exit;


} 



$ten = mysql_query('SELECT * FROM `dragon_hero_3` WHERE `users` = "'.$user['id'].'"');      


    $ten = mysql_fetch_array($ten);

if($aid['hp']>0){   if(!$ten) {


  mysql_query('INSERT INTO `dragon_hero_3` (users,hp,strong,def,name) VALUES ("'.$user['id'].'","'.$user['hp'].'","'.$user['str'].'","'.$user['def'].'","'.$name.'")');


mysql_query('UPDATE `aid` SET `ten` =`ten`+1 WHERE `id`= 3');


header('location:dragon3.php');exit;


} 

}



$udar = $user['str']/10;
$udar = ceil($udar);

if($udar>2000){ $udar= mt_rand(1000,3000); }

$plus = $udar+1000;



if (isset($_GET['bat'])){
    
    
    
    
    
    
$nagrada1 =  mt_rand(3,3);
$nagrada2 =  mt_rand(300,300);
$nagrada3 =  mt_rand(300,300);

mysql_query("UPDATE `users` SET `g`=`g` + '".$nagrada1."' WHERE `id`='".$user['id']."' ");
mysql_query("UPDATE `users` SET `s`=`s` + '".$nagrada2."' WHERE `id`='".$user['id']."' ");
mysql_query("UPDATE `users` SET `exp`=`exp` + '".$nagrada3."' WHERE `id`='".$user['id']."' ");



if($aid['status']==0){ header('location:dragon3.php');exit;}


if($aid['ten']<=0){ header('location:dragon3.php');exit;}
if($ten['vit']<=0){ header('location:dragon3.php');exit;}





if($aid['voln']==0){

mysql_query('UPDATE `aid` SET `hp` = `hp`-'.$udar.' WHERE `id`=3');   







mysql_query('UPDATE `dragon_hero_3` SET `koef` = `koef`+ '.$udar.' WHERE `users` = '.$user[id].'');    


if($udar>=$aid['hp']){   


mysql_query('UPDATE `aid` SET `voln` =1,`hp`=0 WHERE `id`= 3');

mysql_query('UPDATE `users` SET `g` =`g`+25000 WHERE `aide`= 1');
header('location:dragon3.php');exit; }












$war =  mt_rand(1,5);




if($war==2){


$ot = $ten['vit']*10/100;



$ot = ceil($ot);
if($ot>=$ten['vit']){ mysql_query('UPDATE `aid` SET `ten` =`ten`-1 WHERE `id`= 3'); }


mysql_query('UPDATE `dragon_hero_3` SET `vit` = `vit`- '.$ot.' WHERE `users` = '.$user[id].'');    

mysql_query('UPDATE `aid` SET `hp` = `hp`+ '.$ot.' WHERE `id` = 3');    
$_SESSION['prot']='<font color=red>Дракоша поглащает энергию вашего героя, воруя у него 10% здоровья</font>'; 

}



$_SESSION['log']='<font color=green>Вы Ударили Красного дракона на '.$udar.'</font>'; 
header('location:dragon3.php');exit;
}


if($aid['voln']==1){





$prot= mysql_fetch_assoc(mysql_query("SELECT * FROM `dragon_hero_3` WHERE `hp`>0 ORDER BY RAND() LIMIT 1"));


if($udar>=$prot['hp']){ 

mysql_query('UPDATE `aid` SET `ten` =`ten`-1 WHERE `id`= 3'); 


mysql_query('UPDATE `dragon_hero_3` SET `koef` = `koef`+ '.$plus.' WHERE `users` = '.$user[id].'');    

$_SESSION['log']='<font color=green>Вы убили '.$prot['name'].'</font>';}

else{   
mysql_query('UPDATE `dragon_hero_3` SET `koef` = `koef`+ '.$udar.' WHERE `users` = '.$user[id].'');    
mysql_query('UPDATE `dragon_hero_3` SET `vit` = `vit`- '.$udar.' WHERE `users` = '.$prot[users].'');    

$_SESSION['log']='<font color=green>Вы Ударили '.$prot['name'].' на '.$udar.'</font>';} 

$new = mysql_fetch_assoc(mysql_query("SELECT * FROM `aid` WHERE `id` = 3")); 
if($new['ten']<=0){




$geroi = mysql_fetch_assoc(mysql_query("SELECT * FROM `dragon_hero_3` ORDER BY `koef` DESC LIMIT 1")); 


mysql_query('UPDATE `users` SET `str` = `str`+2000,`vit`=`vit`+2000,`agi`=`agi`+2000,`def`=`def`+2000 WHERE `id` = "'.$geroi['users'].'"');    



$_gold = $aid['gold'];           
mysql_query('UPDATE `aid` SET `status` = "0",`voln`="0",


`time` = "'.(time() + 21600).'" , `gr`="'.$geroi['users'].'" WHERE `id` = 3');


mysql_query("UPDATE `users` SET `g`=`g`+'".$_gold."' WHERE `id`='".$user['id']."' ");


mysql_query('UPDATE `users` SET `aide` = "0"');


mysql_query("truncate table `dragon_hero_3` ");



}

header('location:dragon3.php');exit;



}



}







if($aid['status']==1){ 
?>
<div class='f'>
<div class="bntf">
   <div class="small">
    <div class="nl">
     <div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">
             

<b> <font color=orange>На красного дракона напало: <?=$aid['ten']?> героев</font></b>








</div>
</div>
</div>
</div>
</div>
</div>
<?


echo '

<div class="bdr bg_red">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
          <div class="imcon9">
             <div class="ieblck15">
                        <div class="fl ml10 mt10"> 

        <img src="/images/drago/3.png" class=icon width=38>

             </div>
            </div> 
           </div> 
           <div class="ml68 mt10 mb10 mr10 sh"> 
            <span class="lwhite tdn">Красный дракоша</span> 
            <div class="small mb2"> 
             <span class="fr rdmg"></span> 
             <span class="lorange"> Здоровье: <img src="http://144.76.127.94/view/image/icons/health.png" class="va_t" height="16" width="16" alt=""> '.$aid['hp'].' </span> 
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
           </div> ';




if($ten['vit']>0){

?><a class=mbtn mb2 href='dragon3.php?bat' class='btn'><span class='end'><span class='label'>Атаковать</a></span></span><?


echo '<div class=f>
<div class="bntf">
   <div class="small">
    <div class="nl">
     <div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">
';
if (isset($_SESSION['log'])){?><div class='line'></div><div class='content'><center><?=$_SESSION['log']?><center></div><br><?   $_SESSION['log']=NULL; }


if (isset($_SESSION['prot'])){?><div class='content'><center><?=$_SESSION['prot']?><center></div><?   $_SESSION['prot']=NULL; }
echo '</div></div></div></div></div></div>';



echo '

<div class="bdr bg_green">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
          <div class="imcon9">
             <div class="ieblck15">
                        <div class="fl ml10 mt10">';

  if($user['sex'] == '0'){
     echo' <img src="/images/user/0.png" alt="user" width="40">';}
  if($user['sex'] == '1'){
     echo' <img src="/images/user/1.png" alt="user" width="40">';}


            echo ' </div>
            </div> 
           </div> 
           <div class="ml68 mt10 mb10 mr10 sh"> 
            <span class="lwhite tdn">'.$user['login'].'</span> 
            <div class="small mb2"> 
            
             <span class="fr rdmg"></span> 
             <span class="lorange"> <img src="http://144.76.127.94/view/image/icons/strength.png" class="va_t" height="16" width="16" alt="">  '.$user['str'].' <img src="http://144.76.127.94/view/image/icons/health.png" class="va_t" height="16" width="16" alt=""> '.$ten['vit'].' <img src="http://144.76.127.94/view/image/icons/defense.png" class="va_t" height="16" width="16" alt=""> '.$user['def'].'
</span> 
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
           </div> ';
















			    if($_GET['wakeup'] == true){  
			        mysql_query('UPDATE  `ten` SET `vit` + "50000"  WHERE `user`="'.$user['id'].'" LIMIT 1');
}


}elseif($ten['vit']<=0){ ?><div class='content' align='center'> <font color=red>Ваш герой погиб... вы не можете принимать участие в бою</font></div> <?           }


}elseif($aid['status']==0){


$hr = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id`='".$aid['gr']."'")); 



?><div class="bdr bg_blue mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="ml10 mt5 mr10 mb5 cntr"><div class='content' align='center'> <font color=orange>До следующей битвы <?=_time($aid['time'] - time())?> </font></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div>		<div class="clb"></div>
	</div></div></div></div></div></div></div></div>

			</a><? 


?><div class="bdr bg_blue mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="ml10 mt5 mr10 mb5 cntr">
	    <div class='content'><font color=orange> Красного дракона добил: </font> <a href='/user/<?=$hr['id']?>/'><?=$hr['login']?></a></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div>		<div class="clb"></div>
	</div></div></div></div></div></div></div></div>

			</a><?





}

include './system/f.php';
