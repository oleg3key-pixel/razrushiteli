<?
include './system/common.php';  
include './system/functions.php';
include './system/user.php';
    
if(!$user) {
header('location: /');   
exit;}

$id = _string(_num($_GET['id']));
  if($id && $id != $user['id']) {
    $i = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"');
    $i = mysql_fetch_array($i);
if(!$i) {    
header('location: /user/');
exit; }

$title = 'Снаряжение '.$i['login'];
}else{
$i = $user;
$title = 'Снаряжение';
}

include './system/h.php';  
echo' <div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      '.$title.'
    </div>
   </div>
  </div>';
     echo' '.$_SESSION['mes'].'  ';
    $_SESSION['mes']=NULL; //Удаляем сесию
    
    for($w = 1; $w < 9; $w++) {
      
$w_name = [	'1'=>'Голова',
		'2'=>'Плечи',
		'3'=>'Торс',
		'4'=>'Перчатки',
		'5'=>'Левая рука',
		'6'=>'Правая рука',
		'7'=>'Ноги',
		'8'=>'Обувь'
		];


echo'<div class="empty_block">
<table cellpadding="0" cellspacing="0">
<tr>';
  


        if($i['w_'.$w]) {
        
    $inv = mysql_query('SELECT * FROM `inv` WHERE `id` = "'.$i['w_'.$w].'"');      
    $inv = mysql_fetch_array($inv);

        $item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$inv['item'].'"');
        $item = mysql_fetch_array($item);

  $quality = [	'1'=>'Обычный',
				'2'=>'Необычный',
				'3'=>'Редкий',
				'4'=>'Эпический',
				'5'=>'Легендарный',
				'6'=>'Мифический',
				'7'=>'Реликтовный',
				'8'=>'Древний',
		];
$quality_color=['1'=>'#999999',
				'2'=>'#B1D689',
				'3'=>'#6BA0E7',
				'4'=>'#C780DB',
				'5'=>'#FF8E94',
				'6'=>'#FE7E01',
				'7'=>'aqua',
				'8'=>'#A0522D'
		];

echo'  
  <div class="bdr cnr bg_blue mb2">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="fl ml5 mt5 mr5 w48px"> 
            <div class="fl h48">  
            <td width="  15%"><img src="/view/image/items/'.$inv['item'].'.png" alt="*"/></td>
  <td> <img src="/view/image/icons/quality/'.$item['quality'].'.png" alt="*"/>
  <a href="/item/'.$inv['id'].'/">
  
  '.$item['name'].'</a> '.($inv['smith'] > 0 ? '<small><font color="#90b0c0"> +'.$inv['smith'].'</font></small>':'').'
  <br/><small> <font color="#fff"><img src="/view/image/icons/png/up.png" alt="*" width="12"/>'.$item['level'].' ур, </font> <font color="'.$quality_color[$item['quality']].'">'.$quality[$item['quality']].'</font>
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

if($user['id'] != $item['user']) {
      
      $equip_item = mysql_query('SELECT * FROM `inv` WHERE `id` = "'.$user['w_'.$item['w']].'"');
      $equip_item = mysql_fetch_array($equip_item);        
    
  if(($equip_item['_str']+$equip_item['_vit']+$equip_item['_def']) - ($inv['_str']+$inv['_vit']+$inv['_def']) > 0) {
echo'<font color="#c06060">-'.(($equip_item['_str']+$equip_item['_vit']+$equip_item['_def']) - ($inv['_str']+$inv['_vit']+$inv['_def'])).'</font>';
 }else{
	 if($user['id'] != $inv['user']){
	 echo'  <font color="#3c3">+'.(($inv['_str']+$inv['_vit']+$inv['_def']) - ($equip_item['_str']+$equip_item['_vit']+$equip_item['_def'])).'</font>';}
 }
}



  if($inv['rune']) {


$rune_stats = [ '1'=>'15',
				'2'=>'30',
				'3'=>'60',
				'4'=>'200',
				'5'=>'500',
				'6'=>'850',
				'7'=>'1500',
				'8'=>'2000',
				'10'=>'30000'
		];
$rune_color=[   '1'=>'#999999',
				'2'=>'#B1D689',
				'3'=>'#6BA0E7',
				'4'=>'#C780DB',
				'5'=>'#FF8E94',
				'6'=>'#FE7E01',
				'7'=>'aqua',
				'8'=>'#A0522D',
				'10'=> 'yellow'


		];  


}

echo ' <div class="bdr cnr bg_blue mb2">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="fl ml5 mt5 mr5 w48px"> 
            <div class="fl h48"> 
            <img width="48" src="/view/image/items/'.$inv['item'].'.png" alt="*" width=50 height=50/>
            </div> 
            <div class="clb"></div> 
           </div> 
           <div class="mt5 mb5 sh small"> 
    <a href="/item/'.$inv['id'].'/"> '.$item['name'].'</a> '.($inv['smith'] > 0 ? '<small><font color="#90b0c0"> +'.$inv['smith'].'</font></small>':'').'
           </div> 
<div class="mt5 mb5 sh small"><img src=/view/image/icons/shop/amulet.png class=icon width=16> <i>Уровень чар:</i> <a><b>'.$inv['zachar'].'</b></a><font></span></div>
          
           <div class="mt5 mb5 sh small"> 
<img width=16 src="/view/image/icons/rune/'.$inv['rune'].'.png" width=12 height=12> 
            <span class="q_rune2"><font color="'.$rune_color[$inv['rune']].'"> +'.$rune_stats[$inv['rune']].' к параметрам</font></span> 
           </div> 
           <div class="ml58 mt5 mb5 sh small"> 
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

    
echo'</small></td>';
}else{     
    
echo ' <div class="bdr cnr bg_blue mb2">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="fl ml5 mt5 mr5 w48px"> 
            <div class="fl h48"> 
             <img class="item_icon" width="48" height="48" src="/view/image/empty.png"> 
            </div> 
            <div class="clb"></div> 
           </div> 
           <div class="mt5 mb5 sh small">
             '.$w_name[$w].'
           </div> 
           <div class="mt5 mb5 sh small">
             Ничего не надето 
           </div> 
           <div class="mt5 mb5 sh small"> 
            <a href="/shop/items/ class="">Купить в магазине</a> 
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
  
echo' <td width="15%"><img src="/view/image/item_null.png" alt="*"/></td>
<td> 
</td>';     

}

echo'</tr></table>
</div>
<div class="line"></div>';
}
  
include './system/f.php';
?>