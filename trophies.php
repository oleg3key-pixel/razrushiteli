<? 
include './system/common.php';
include './system/functions.php';
include './system/user.php';
if(!$user) {
header('location: /');
exit;}

$id = _string(_num($_GET['id']));
  if($id) {
    $i = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"');
    $i = mysql_fetch_array($i);
    
    if(!$i) {
      header('location: /user/');
      exit;}

    }else{ 
      $i = $user;
    }


if(!$id){
$title = 'Трофеи';
}else{
$title = 'Трофеи '.$i['login'].'';	
}
include './system/h.php'; 
echo '  <div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Трофеи
    </div>
   </div>
  </div>';


$c = mysql_query('SELECT * FROM `trophies_user` WHERE `user_id` = "'.$i['id'].'" ORDER BY `id` DESC');
  
while($row = mysql_fetch_array($c)){
echo'  <div class="bdr bg_blue mb2 cntr">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="mt10 mlr10 mb5 ">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding-top: 5px;">
<tbody><tr><td width="25%">
<center><img src="/images/ico/medals/trophy'.$row['trophies_id'].'.png"></center>
</td>
<td width="75%">
<font color="#fff"> '.$row['name'].' </font></br>
+'.$row['param'].' к параметрам </br>
+'.$row['exp'].'% <img src="/images/ico/png/exp.png" class=icon> опыту</br>
+'.$row['silver'].'% <img src="/images/ico/png/silver.png" class=icon> серебру<br>
+'.$row['valor'].'% <img src="http://144.76.125.123/view/image/icons/valor_exp.png" class=icon> серебру
</td>
</tr></tbody>
</table>
</div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div><div class="line"></div>';
}

echo'<div class="hr_g mb2"><div><div></div></div></div><div class="bntf"><div class="small"><div class="nl"><div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">
		Трофеи - одни из самых ценных артефактов в игре	</div></div></div></div><div class="hr_g mb2"><div><div></div></div></div>';
echo'<div class="block_link"><a class=mbtn mb2 href="/user/'.$i['id'].'/"><img src="/images/ico/png/back.png" class=icon> Назад в профиль </a></div>
<div class="line"></div>';
include './system/f.php';
?>