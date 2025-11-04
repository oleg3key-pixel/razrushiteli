<?php
// Системные подключения
include './system/common.php';
include './system/functions.php';
include './system/user.php';
// Если не пользователь
if(empty($user)): header('location: /'); exit; endif;
// Фильтруем ид пользователя
$id = _string(_num($_GET['id']));
// Если ид передается через гет
if(isset($id)):
  $i = mysql_query('SELECT * FROM users WHERE id = "'.$id.'"');
  $i = mysql_fetch_array($i);
  // Если такого ид нет
  if(empty($i)): header('location: /user/'.$user['id'].'/'); exit; endif;
else:
  $i = $user;
endif;
// Передает в титлах логин    
$title = $i['login'];
// Инклуд верхней страницы (хеадер)
include './system/h.php';
// Пока не понимаю заче сессия тут вообе нужна
//echo' '.$_SESSION['mes'].'  ';
///$_SESSION['mes']=NULL; //Удаляем сесию
// Тут работа с рунами Flowap
$w_1 = mysql_query('SELECT zachar,rune,item FROM inv WHERE user = "'.$i['id'].'" AND id = "'.$i['w_1'].'"');
$w_1 = mysql_fetch_array($w_1);
if(empty($w_1)): $w_1['item'] = 0; endif;
//$w_1_item = mysql_query('SELECT * FROM items WHERE id = "'.$w_1['item'].'"');
//$w_1_item = mysql_fetch_array($w_1_item);
$w_2 = mysql_query('SELECT zachar,rune,item FROM inv WHERE user = "'.$i['id'].'" AND id = "'.$i['w_2'].'"');
$w_2 = mysql_fetch_array($w_2);
if(empty($w_2)): $w_2['item'] = 0; endif;
//$w_2_item = mysql_query('SELECT * FROM items WHERE id = "'.$w_2['item'].'"');
//$w_2_item = mysql_fetch_array($w_2_item);
$w_3 = mysql_query('SELECT zachar,rune,item FROM inv WHERE user = "'.$i['id'].'" AND id = "'.$i['w_3'].'"');
$w_3 = mysql_fetch_array($w_3);
if(empty($w_3)): $w_3['item'] = 0; endif;
//$w_3_item = mysql_query('SELECT * FROM items WHERE id = "'.$w_3['item'].'"');
//$w_3_item = mysql_fetch_array($w_3_item);
$w_4 = mysql_query('SELECT zachar,rune,item FROM inv WHERE user = "'.$i['id'].'" AND id = "'.$i['w_4'].'"');
$w_4 = mysql_fetch_array($w_4);
if(empty($w_4)): $w_4['item'] = 0; endif;
//$w_4_item = mysql_query('SELECT * FROM items WHERE id = "'.$w_4['item'].'"');
//$w_4_item = mysql_fetch_array($w_4_item);
$w_5 = mysql_query('SELECT zachar,rune,item FROM inv WHERE user = "'.$i['id'].'" AND id = "'.$i['w_5'].'"');
$w_5 = mysql_fetch_array($w_5);
if(empty($w_5)): $w_5['item'] = 0; endif;
//$w_5_item = mysql_query('SELECT * FROM items WHERE id = "'.$w_5['item'].'"');
//$w_5_item = mysql_fetch_array($w_5_item);
$w_6 = mysql_query('SELECT zachar,rune,item FROM inv WHERE user = "'.$i['id'].'" AND id = "'.$i['w_6'].'"');
$w_6 = mysql_fetch_array($w_6);
if(empty($w_6)): $w_6['item'] = 0; endif;
//$w_6_item = mysql_query('SELECT * FROM items WHERE id = "'.$w_6['item'].'"');
//$w_6_item = mysql_fetch_array($w_6_item);
$w_7 = mysql_query('SELECT zachar,rune,item FROM inv WHERE user = "'.$i['id'].'" AND id = "'.$i['w_7'].'"');
$w_7 = mysql_fetch_array($w_7);
if(empty($w_7)): $w_7['item'] = 0; endif;
//$w_7_item = mysql_query('SELECT * FROM items WHERE id = "'.$w_7['item'].'"');
//$w_7_item = mysql_fetch_array($w_7_item);
$w_8 = mysql_query('SELECT zachar,rune,item FROM inv WHERE user = "'.$i['id'].'" AND id = "'.$i['w_8'].'"');
$w_8 = mysql_fetch_array($w_8);
if(empty($w_8)): $w_8['item'] = 0; endif;
//$w_8_item = mysql_query('SELECT * FROM items WHERE id = "'.$w_8['item'].'"');
//$w_8_item = mysql_fetch_array($w_8_item);
$i_clan_memb = mysql_query('SELECT clan,rank,v,time FROM clan_memb WHERE user = "'.$i['id'].'"');
$i_clan_memb = mysql_fetch_array($i_clan_memb);
// Если нет в клане, то показываем уведомление о приглашении в клан
if(empty($i_clan_memb)):
  if($clan && $clan_memb['rank'] >= $clan['rank_for_invite'] && $_GET['clan_invite'] == true):
    if(mysql_result(mysql_query('SELECT COUNT(id) FROM clan_invite WHERE ho = "'.$i['id'].'" AND clan = "'.$clan['id'].'"'),0) == 0):
      mysql_query('INSERT INTO clan_invite (clan, user, ho) VALUES ("'.$clan['id'].'", "'.$user['id'].'", "'.$i['id'].'")');
      echo mes('<div class="bntf"><div class="nl"><div class="nr cntr lyell lh1 plr15 pt5 pb5 sh"><font color=lime>Приглашение отправлено!</font></div></div><div class="hr_g mb2"><div><div></div></div></div>');
    else:
      echo mes('<div class="bntf"><div class="nl"><div class="nr cntr lyell lh1 plr15 pt5 pb5 sh"><font color=red>У этого игрока уже есть приглашение в другой клан!</font></div></div><div class="hr_g mb2"><div><div></div></div></div>');
    endif;
  endif;
endif;
// Показывает пол пользователя 

echo'<div class="empty_block">
<b>'.nick($i['id']).'</b> <img src="/view/image/icons/png/up.png" alt="*"/> <small> '.$i['level'].' ур, '.($i['sex'] == 0 ? 'Мужской':'Женский').' </small><br/>';

// Показывает привелегию в клане
if(isset($i_clan_memb)):
  $i_clan = mysql_query('SELECT id,name FROM clans WHERE id = "'.$i_clan_memb['clan'].'"');
  $i_clan = mysql_fetch_array($i_clan);
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
    case 4:
      $rank = '<span class="yell">Маршал</span>';
    break;
    case 5:
      $rank = '<span class="yell">Лидер</span>';
    break;    
  }
endif;
?>
</div><div class="line"></div>
<?php

$ban = mysql_fetch_assoc(mysql_query("SELECT * FROM ban WHERE user = '".$i['id']."'"));
$block = mysql_fetch_assoc(mysql_query("SELECT * FROM block WHERE user = '".$i['id']."'"));
if(isset($ban['user']) AND isset($block['user']) != $i['id'])
{
echo'
<div class="bdr cnr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
			<div class="mb5 ml5 mr5 mt5 cntr rdmg">
				Игрок забанен<br>    До конца:  '._time($ban['time'] - time()).'			</div>
		</div></div></div></div></div></div></div></div></div>
';
}elseif(isset($block['user'])){
echo'<div class="bdr cnr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
			<div class="mb5 ml5 mr5 mt5 cntr rdmg">
				Игрок заблокирован<br> До конца: '._time($block['time'] - time()).'			</div>
		</div></div></div></div></div></div></div></div></div>
';    
}


    if($inv['rune']) {
$rune_stats = [ 
    '1'=>'15',
				'2'=>'30',
				'3'=>'60',
				'4'=>'200',
				'5'=>'500',
				'6'=>'1000'];
		
		
    }
    


  

echo '
 <div class="bdr bg_main mb2">
   <div class="light">
    <div class="wr1">
     <div class="wr2">
      <div class="wr3">
       <div class="wr4">
        <div class="wr5">
         <div class="wr6">
          <div class="wr7">
           <div class="wr8"> 
            <table class="dummy"> 
             <tbody>
              <tr> 
               <td class="w10px">
<div class="slot">'; 
                // Если руны ниже нуля то просто оставляем поле пустым flowap
                if(isset($w_1['rune'])): 
                  if($w_1['zachar'] == 0){echo '<img src=/view/image/icons/rune/'.$w_1['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px black;">';}
                  if($w_1['zachar'] == 1){echo '<img src=/view/image/icons/rune/'.$w_1['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px lime;">';}
                  if($w_1['zachar'] == 2){echo '<img src=/view/image/icons/rune/'.$w_1['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px blue;">';}
                  if($w_1['zachar'] == 3){echo '<img src=/view/image/icons/rune/'.$w_1['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px red;">';}
                  if($w_1['zachar'] == 4){echo '<img src=/view/image/icons/rune/'.$w_1['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px aqua;">';}
                endif;
                //
               echo '</div></td> 
               <td colspan="2" rowspan="4">
                <div class="pic_shd">';

if($i['dragon'] < 1) {
    echo '<a href="/avatar/'.$i['id'].'">
    <img src="/manekenImage.php?g='.$i['sex'].
    '&w_1='.$w_1['item'].
    '&w_2='.$w_2['item'].
    '&w_3='.$w_3['item'].
    '&w_4='.$w_4['item'].
    '&w_5='.$w_5['item'].
    '&w_6='.$w_6['item'].
    '&w_7='.$w_7['item'].
    '&w_8='.$w_8['item'].'"
    width="80%"></a>';
}

if($i['dragon'] > 1) {
    echo '<a href="/avatar/'.$i['id'].'">
    <img src="/manekenImage.php?g=1'.
    '&w_1='.$w_1['item'].
    '&w_2='.$w_2['item'].
    '&w_3='.$w_3['item'].
    '&w_4='.$w_4['item'].
    '&w_5='.$w_5['item'].
    '&w_6='.$w_6['item'].
    '&w_7='.$w_7['item'].
    '&w_8='.$w_8['item'].'"
    width="80%"></a>';
}




if($i['dragon'] > 1) {
echo '<a href=/avatar/'.$i['id'].'><img src="/manekenImage/1/'.$w_1['item'].'/'.$w_2['item'].'/'.$w_3['item'].'/'.$w_4['item'].'/'.$w_5['item'].'/'.$w_6['item'].'/'.$w_7['item'].'/'.$w_8['item'].'/" width="80%"></a>';
}

        echo '<td class="w10px">
          <div class="slot"> ';
          // Руны слот 2
          if(isset($w_2['rune'])): 
            if($w_2['zachar'] == 0){echo '<img src=/view/image/icons/rune/'.$w_2['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px black;">';}
            if($w_2['zachar'] == 1){echo '<img src=/view/image/icons/rune/'.$w_2['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px lime;">';}
            if($w_2['zachar'] == 2){echo '<img src=/view/image/icons/rune/'.$w_2['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px blue;">';}
            if($w_2['zachar'] == 3){echo '<img src=/view/image/icons/rune/'.$w_2['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px red;">';}
            if($w_2['zachar'] == 4){echo '<img src=/view/image/icons/rune/'.$w_2['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px aqua;">';}
          endif;

              echo '</dv></td>
              </tr>
              <tr> 
               <td class="w10px">
               <div class="slot"> ';
               if(isset($w_3['rune'])): 
                  if($w_3['zachar'] == 0){echo '<img src=/view/image/icons/rune/'.$w_3['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px black;">';}
                  if($w_3['zachar'] == 1){echo '<img src=/view/image/icons/rune/'.$w_3['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px lime;">';}
                  if($w_3['zachar'] == 2){echo '<img src=/view/image/icons/rune/'.$w_3['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px blue;">';}
                  if($w_3['zachar'] == 3){echo '<img src=/view/image/icons/rune/'.$w_3['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px red;">';}
                  if($w_3['zachar'] == 4){echo '<img src=/view/image/icons/rune/'.$w_3['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px aqua;">';}
               endif;
               echo '</div></td> 
               <td class="w10px">
               <div class="slot"> ';
               if(isset($w_4['rune'])): 
                if($w_4['zachar'] == 0){echo '<img src=/view/image/icons/rune/'.$w_4['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px black;">';}
                if($w_4['zachar'] == 1){echo '<img src=/view/image/icons/rune/'.$w_4['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px lime;">';}
                if($w_4['zachar'] == 2){echo '<img src=/view/image/icons/rune/'.$w_4['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px blue;">';}
                if($w_4['zachar'] == 3){echo '<img src=/view/image/icons/rune/'.$w_4['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px red;">';}
                if($w_4['zachar'] == 4){echo '<img src=/view/image/icons/rune/'.$w_4['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px aqua;">';}
               endif;
                echo '</div></td> 
              </tr>
              <tr> 
               <td class="w10px">
               <div class="slot"> ';
               if(isset($w_5['rune'])): 
                if($w_5['zachar'] == 0){echo '<img src=/view/image/icons/rune/'.$w_5['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px black;">';}
                if($w_5['zachar'] == 1){echo '<img src=/view/image/icons/rune/'.$w_5['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px lime;">';}
                if($w_5['zachar'] == 2){echo '<img src=/view/image/icons/rune/'.$w_5['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px blue;">';}
                if($w_5['zachar'] == 3){echo '<img src=/view/image/icons/rune/'.$w_5['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px red;">';}
                if($w_5['zachar'] == 4){echo '<img src=/view/image/icons/rune/'.$w_5['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px aqua;">';}
               endif;
               echo '</div> </td> 
               <td class="w10px">
               <div class="slot"> ';
               if(isset($w_6['rune'])): 
                if($w_6['zachar'] == 0){echo '<img src=/view/image/icons/rune/'.$w_6['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px black;">';}
                if($w_6['zachar'] == 1){echo '<img src=/view/image/icons/rune/'.$w_6['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px lime;">';}
                if($w_6['zachar'] == 2){echo '<img src=/view/image/icons/rune/'.$w_6['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px blue;">';}
                if($w_6['zachar'] == 3){echo '<img src=/view/image/icons/rune/'.$w_6['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px red;">';}
                if($w_6['zachar'] == 4){echo '<img src=/view/image/icons/rune/'.$w_6['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px aqua;">';}
               endif;
               echo '</div></td> 
              </tr>
              <tr> 
               <td class="w10px">
               <div class="slot"> ';
               if(isset($w_7['rune'])): 
                if($w_7['zachar'] == 0){echo '<img src=/view/image/icons/rune/'.$w_7['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px black;">';}
                if($w_7['zachar'] == 1){echo '<img src=/view/image/icons/rune/'.$w_7['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px lime;">';}
                if($w_7['zachar'] == 2){echo '<img src=/view/image/icons/rune/'.$w_7['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px blue;">';}
                if($w_7['zachar'] == 3){echo '<img src=/view/image/icons/rune/'.$w_7['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px red;">';}
                if($w_7['zachar'] == 4){echo '<img src=/view/image/icons/rune/'.$w_7['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px aqua;">';}
               endif;
               echo '</div> </td> 
               <td class="w10px">
               <div class="slot">';
               if(isset($w_8['rune'])): 
                if($w_8['zachar'] == 0){echo '<img src=/view/image/icons/rune/'.$w_8['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px black;">';}
                if($w_8['zachar'] == 1){echo '<img src=/view/image/icons/rune/'.$w_8['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px lime;">';}
                if($w_8['zachar'] == 2){echo '<img src=/view/image/icons/rune/'.$w_8['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px blue;">';}
                if($w_8['zachar'] == 3){echo '<img src=/view/image/icons/rune/'.$w_8['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px red;">';}
                if($w_8['zachar'] == 4){echo '<img src=/view/image/icons/rune/'.$w_8['rune'].'.png width=35 height=35 style="box-shadow: 0px 0px 25px aqua;">';}
               endif;
               echo '</div></td> 
              </tr> 
             </tbody>
            </table> 
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
  ';










/////////////////////////////////////////
/////////////////////////////////////////
if($i['lair_glava'] > 1) {

echo ' <div class="bdr bg_main mb2">
   <div class="light">
    <div class="wr1">
     <div class="wr2">
      <div class="wr3">
       <div class="wr4">
        <div class="wr5">
         <div class="wr6">
          <div class="wr7">
           <div class="wr8"> 
             <div class="sz0 cntr mlr10"> 
              <div class="mb2"> ';
$c = mysql_query('SELECT * FROM trophies_user WHERE user_id = "'.$i['id'].'" ');
if (mysql_num_rows ($c) != 0) { echo'<a href="/trophies/'.($user['id'] == $i['id'] ? '':''.$i['id'].'').'"><div class="empty_block item_center">';  }
while($row = mysql_fetch_array($c)){
echo'<div class="inbl mr4"><img src="/view/image/icons/medals/trophy'.$row['trophies_id'].'.png"></div>';
}
$c = mysql_query('SELECT * FROM trophies_user WHERE user_id = "'.$i['id'].'" ');
if (mysql_num_rows ($c) != 0) { echo'</div></a><div class="line"></div>';}
echo '              </div> 
              </div> 
              <div> 
              </div> 
             </div></a>            </div> 
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>  ';
}
/////////////////////////////////////////
/////////////////////////////////////////



if($i['svitok1'] > 0) {

echo ' <div class="bdr bg_main mb2">
   <div class="light">
    <div class="wr1">
     <div class="wr2">
      <div class="wr3">
       <div class="wr4">
        <div class="wr5">
         <div class="wr6">
          <div class="wr7">
           <div class="wr8"> 
            <div class="yell mlr10 mt5 mb5">';




echo '<center>';
echo '<div class="table"><div class="tr">
        <div class="d1"><img src=/view/image/bonus/4.png width=40 class=icon></div>
        <div class="d2"><img src=/view/image/bonus/5.png width=40 class=icon></div>
        <div class="d3"><img src=/view/image/bonus/6.png width=40 class=icon></div><br>
</div></div>';
echo '<div class="table"><div class="tr">
        <div class="d1">'.$i['svitok1'].'шт.</div>
        <div class="d2">'.$i['svitok2'].'шт.</div>
        <div class="d3">'.$i['svitok3'].'шт.</div><br>
</div></div>';
echo '</center>';








?>
<style>
.table {
    display:table;
    width:100%;
}
.tr {
    display:table-row;
}
.d1 {
    display:table-cell;
    width:25%;
}
.d2 {
    display:table-cell;
    text-align:center;
    width:50%;
}
.d3 {
    display:table-cell;
    text-align:right;
    width:17%;
}
</style>
<?




echo '</div> 
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
}






             



echo ' <div class="bdr bg_main mb2">
   <div class="light">
    <div class="wr1">
     <div class="wr2">
      <div class="wr3">
       <div class="wr4">
        <div class="wr5">
         <div class="wr6">
          <div class="wr7">
           <div class="wr8"> 
            <div class="yell mlr10 mt5 mb5"> 
             <span class="nowrap win"><b> '.nick($i['id']).' , '.$i['level'].' уровень</span></b>';
$zags = mysql_query('SELECT * FROM zags WHERE id_0 = "'.$i['id'].'" AND status = "da" OR id_1 = "'.$i['id'].'" AND status = "da"');
$zags = mysql_fetch_array($zags);
$w_zags = mysql_query('SELECT * FROM users WHERE id = "'.$zags['id_1'].'"');
$w_zags = mysql_fetch_array($w_zags);
$m_zags = mysql_query('SELECT * FROM users WHERE id = "'.$zags['id_0'].'"');
$m_zags = mysql_fetch_array($m_zags);
?>
<?
if($zags){
if($i['sex'] == 0){
echo "<br><img src='/view/image/zags/1.png' width=20 class=icon> Женат на <a class=tdn lwhite href='/user/$w_zags[id]/'>$w_zags[login]</a>
";
}else{
echo "<br><img src='/view/image/zags/1.png'  width=20 class=icon> Замужем за <a class=tdn lwhite href='/user/$m_zags[id]/'>$m_zags[login]</a>
";
}
}

if($i['id'] == $user['id']) {
echo' <br><span class="now"> <img src="/view/image/icons/png/about_a.png"  class="icon"> <a class=tdn lwhite href=/status.php> Статус:</a> '.$i['anketa_status'].'';
}else{
echo' <br><span class="now"> <img src="/view/image/icons/png/about_a.png"  class="icon"> <a class=tdn lwhite href=/info_user/'.$i['id'].'> Статус:</a> '.$i['anketa_status'].'';
}
$premium = mysql_fetch_array(mysql_query('SELECT * FROM premium WHERE user = "'.$i['id'].'"'));  if($premium) {    
echo'<br><span class="nowrap"><img class="icon" src="/view/image/icons/png/premium.png" class=icon > Премиум-аккаунт</span>';}
echo '<br>';
echo '<span class="nwr"><img class="icon" height="20" src="/view/image/icons/png/up_valor.png" class=icon> <a class=tdn lwhite href=/valor.php> Доблесть:</a> '.n_f($i['valor']).' ур.</span>';
echo '<br>';
if($i['id'] == $user['id']) {
echo '<span class="nowrap"><img class="icon" src="/view/image/icons/png/exp.png" class=icon> Опыт: '.n_f($i['exp']).' / '.n_f(exp($i['level'])).'</span><br>';
}
echo '<span class="nowrap"><img class="icon" src="/view/image/icons/png/strength.png"> Сила: '.$i['str'].'</span><br>'; 
echo '<span class="nowrap"><img class="icon" src="/view/image/icons/png/health.png"> Здоровье: '.$i['vit'].'</span><br>'; 
echo '<span class="nowrap"><img class="icon" src="/view/image/icons/png/defense.png"> Броня: '.$i['def'].'</span><br>';
if($i_clan_memb){ echo '<span class="nowrap"><img class="icon" src="/view/image/icons/png/clan.png"> Клан: <a class=tdn lwhite href="/clan/'.$i_clan['id'].'/"> '.$i_clan['name'].'</a> , </span> '.$rank.'';}
if($i_clan_memb){ echo '<br><span class="nowrap"><img class="icon" src="/view/image/icons/png/calendar.png"> Времени в клане: '. _times(time() - $i_clan_memb['time']).'		</span>';}
if($i_clan_memb){ echo'<br><img class="icon" src="/view/image/icons/png/calendar.png">  <font color="#7afe4e">Верность клану: '.$i_clan_memb['v'].'%</font> ';
if($i['id'] == $user['id'] AND $i_clan_memb['v'] < '100') { echo'<a class=tdn lwhite href="/clan/const/"><font color="#fff"><u>поднять</u></font></a><br>';}}
echo '<br><span class="nowrap"><img class="icon" src="/view/image/icons/png/records.png"> Последнее действие: '. _times(time() - $i['online']).' назад</span>';

if($i['id'] == $user['id']) {
echo '<br><span class="nowrap"><img class="icon" src="/view/image/icons/png/gold.png"> Золото: '.n_f($i['g']).'</span><span class="nowrap"> <img class="icon" src="/view/image/icons/png/silver.png"> Серебро: '.n_f($i['s']).'</span></div>';
}










echo '</div></div></div></div></div></div></div></div></div></div></div> ';


  $equips = 0;
  if($i['w_1']) {
    $equips++;
  }
  if($i['w_2']) {
    $equips++;
  }
  if($i['w_3']) {
    $equips++;
  }
  if($i['w_4']) {
    $equips++;
  }
  if($i['w_5']) {
    $equips++;
  }
  if($i['w_6']) {
    $equips++;
  }
  if($i['w_7']) {
    $equips++;
  }
  if($i['w_8']) {
    $equips++;
  }


           $b=array(
          $i['ability_1']
         ,$i['ability_2']
         ,$i['ability_3']
         ,$i['ability_4']
         ,$i['ability_5']
         ,$i['ability_6']
         ,$i['ability_7']
         ,$i['ability_8']
         ,$i['ability_9']

           );//Додаем параметры

if($_GET[the]==act) {
mysql_query("INSERT INTO blacklist (user,user2)VALUES('$user[id]','$i[id]')");

$_SESSION['chok'] = '<center> <font color="green"><img src="/view/image/icons/png/ok.png"> ('.$i[login].')
добавлен в ваш чёрный список </center>';

header('location:?');
}
if($_GET[the]==act3) {
mysql_query("INSERT INTO friends (user,user2)VALUES('$user[id]','$i[id]')");

$_SESSION['chok2'] = '<center> <font color="lime"><img src="/view/image/icons/png/ok.png"> ('.$i[login].')
добавлен в список друзей </center>';

header('location:?');
}

if($_GET[the]==act2) {
mysql_query("DELETE FROM blacklist WHERE user2 = ".$i[id]."");

$_SESSION['choke'] = '<center> <font color="green"><img src="/view/image/icons/png/ok.png"> ('.$i[login].')
Удален с вашего чёрного списка</center>';

header('location:?');
}


if($_GET[the]==act4) {
mysql_query("DELETE FROM friends WHERE user2 = ".$ho[id]."");

$_SESSION['choke2'] = '<center> <font color="lime"><img src="/view/image/icons/png/ok.png"> ('.$i[login].')
Удален с списка друзей</center>';
}



           $a=array($i['_vit'],$i['_str'],$i['_def']);//Додаем параметры
 if($i['id'] == $user['id']) {

echo'<a  class="mbtn mb2"  href="/mail/"><img src="/view/image/icons/png/post.png" class=icon> Mоя почта</a><div class="line"></div>';
}else{
echo'<a  class="mbtn mb2" href="/mail/'.$i['id'].'/"><img src="/view/image/icons/png/post.png" class=icon> Отправить почту</a></div><div class="line"></div>';

if(mysql_result(mysql_query('SELECT COUNT(*) FROM blacklist WHERE user = \''.$user['id'].'\' AND user2 = \''.$i[id].'\''),0) == 0){
?>
<a class="mbtn mb2" href="?the=act"><span class="end"><span class="label"><img src="/view/image/icons/png/black.png" class=icon> Добавить в ЧС</span></span></a>
<?
}else{
echo "<a class='mbtn mb2' href='?the=act2'><span class='end'><span class='label'><img src=/view/image/icons/png/black.png class=icon> Удалить в ЧС</span></span></a>";
}
?>
<?
if(mysql_result(mysql_query('SELECT COUNT(*) FROM friends WHERE user = \''.$user['id'].'\' AND user2 = \''.$i[id].'\''),0) == 0){
?>
<a class="mbtn mb2" href="?the=act3"><span class="end"><span class="label"><img src=/view/image/icons/png/friend.png class=icon> Добавить в друзья</span></span></a>
<?
}else{
echo "<a class='mbtn mb2' href='?the=act4'><span class='end'><span class='label'><img src=/view/image/icons/png/friend.png class=icon> Удалить из друзей</span></span></a>";
}
?></center>
<?
?><div class="mb10"></div> <?
if(!$i_clan_memb && $clan && $clan_memb['rank'] >= $clan['rank_for_invite']) {
if(mysql_result(mysql_query('SELECT COUNT(*) FROM clan_invite WHERE ho = "'.$i['id'].'" AND clan = "'.$clan['id'].'"'),0) == 0) {
echo'<div class="block_link"><a class=mbtn mb2 href="/user/'.$i['id'].'/?clan_invite=true"><img src="/view/image/icons/png/clan.png" class=icon> Пригласить в клан</a></div><div class="line"></div>';
}
}
}



$gifts = mysql_result(mysql_query('SELECT COUNT(*) FROM gifts_user WHERE komy="'.$i['id'].'" ORDER BY id'),0);
echo'<a  class="mbtn mb2"  href="/gifts/'.$i['id'].'/"><img src="/view/image/icons/png/gift_s.png" class=icon> Подарки ('.$gifts.') </a></div><div class="line"></div>';
echo'
<a  class="mbtn mb2" href="/equip/'.$i['id'].'/"><img src="/view/image/icons/png/slots.png" class=icon> Снаряжение ('.$equips.' из 8)</a>
<div class="line"></div>';






 if($i['id'] == $user['id']) {

echo'
<a class="mbtn mb2"  href="/inv/"> <img src="/view/image/icons/png/bag.png" class=icon> Сумка ('.mysql_result(mysql_query('SELECT COUNT(id) FROM inv WHERE user = "'.$user['id'].'" AND equip = "0"'),0).'/100) '.(mysql_result(mysql_query('SELECT COUNT(*) FROM inv WHERE user = "'.$user['id'].'" AND equip = "0"  AND new = "0"'),0) > 0 ? '<font color=\'#30c030\'>(+)</font>':'').' </a><div class="line"></div>
  ';
 }
  echo'
<a class="mbtn mb2" href="/trophies/'.$i['id'].'"><img src="/view/image/icons/png/trophies.png" class="icon" alt="" width="20px"> Трофеи ('.$i['lair_glava'].')</a>
';



echo '  <div class="mb10"></div> 
<a  class="mbtn mb2" href="/ability/'.$i['id'].'/"><img src="/view/image/icons/png/ability.png" class=icon> Умения ( '.array_sum($b).' из 900)</a>
<div class="line"></div>
<a  class="mbtn mb2"  href="/train/"><img src="/view/image/icons/png/train.png" class=icon> Тренировка (   '.array_sum($a).' из 600) </a>
<div class="line"></div>
<a  class="mbtn mb2" href="/amulet_x/'.$i['id'].'/"><img class="icon" src="/view/image/icons/png/amulet.png">  Амулет ('.$i['amulet'].' из 200) </a>
<div class="line"></div>';
$mult = mysql_result(mysql_query('SELECT COUNT(*) FROM users WHERE ip = "'.$i['ip'].'" AND id != "'.$i['id'].'"'),0);

if($user['access'] > '0' AND $user['id'] != $i['id']){
echo'<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
<div class="ml10 mt5 mr10 mb5">
<div class="mb5"></div>
<span class="lorange">
<font color=gold>IP:</font> '.$i['ip'].' <br>
<font color=gold>Device:</font> '.$i['ua'].'<br>
<font color=gold>Мультов:</font> '.$mult.'</span>
<div class="clb"></div></div></div></div></div></div></div></div></div></div></div></div></div></div>';
}
if($user['access'] > '0' AND $user['id'] != $i['id']){
echo'<div class="block_link"><a class=mbtn mb2 href="/ban1/'.$i['id'].'/"><img src="/view/image/icons/png/rules.png" class=icon> Забанить аккаунт </a></div>';
}
if($user['access'] >'0' AND $user['id'] != $i['id']){
echo'<div class="block_link"><a class=mbtn mb2 href="/ban2/'.$i['id'].'/"><img src="/view/image/icons/png/black.png" class=icon> Заблокировать аккаунт </a></div>';

}



include './system/f.php';

?>