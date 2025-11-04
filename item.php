<?
include './system/common.php';   
include './system/functions.php';
include './system/user.php';
    
if(!$user) {
header('location: /');  
exit;}

$id = _string(_num($_GET['id']));
  $inv = mysql_query('SELECT * FROM `inv` WHERE `id` = "'.$id.'"');
  $inv = mysql_fetch_array($inv);

  if(!$inv) {
header('location: /');
exit;}
 
  $item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$inv['item'].'"');
  $item = mysql_fetch_array($item);
    
$title = $item['name'];
include './system/h.php';

  $quality = [	'1'=>'Обычный',
				'2'=>'Необычный',
				'3'=>'Редкий',
				'4'=>'Эпический',
				'5'=>'Легендарный',
				'6'=>'Мифический',
				'7'=>'Реликтовный',
				'8'=>'Древний'
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
		
$w = [	'1'=>'Голова',
		'2'=>'Плечи',
		'3'=>'Торс',
		'4'=>'Перчатки',
		'5'=>'Левая рука',
		'6'=>'Правая рука',
		'7'=>'Ноги',
		'8'=>'Обувь'
		];


    if($inv['rune']) {
$rune_stats = [ '1'=>'15',
				'2'=>'30',
				'3'=>'60',
				'4'=>'200',
				'5'=>'500',
				'6'=>'850',
				'7'=>'1500',
				'8'=>'2000'
		];
$rune_color=[   '1'=>'#999999',
				'2'=>'#B1D689',
				'3'=>'#6BA0E7',
				'4'=>'#C780DB',
				'5'=>'#FF8E94',
				'6'=>'#FE7E01',
				'7'=>'aqua',
				'8'=>'#A0522D'


		];




}

if($inv['_str'] > $equip_item['_str']) { 
$diff += $inv['_str'] - $equip_item['_str'];
if($inv['_vit'] > $equip_item['_vit']) {
$diff += $inv['_vit'] - $equip_item['_vit'];
if($inv['_def'] > $equip_item['_def']) {
$diff += $inv['_def'] - $equip_item['_def'];


}}}

    if($inv['user'] == $user['id']) {if($user['w_'.$item['w']] == $inv['id'] OR !$user['w_'.$item['w']] OR $user['w_'.$item['w']] != $inv['id']) {

}}
  if($user['w_'.$item['w']] != 0) {if($inv['_str'] > $equip_item['_str'] OR $inv['_vit'] > $equip_item['_vit'] OR $inv['_def'] > $equip_item['_def']) {
}}

if($equip_item && $inv['user'] != $user['id'] && $user['w_'.$item['w']]) {

    $i_equip_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$equip_item['item'].'"');
    $i_equip_item = mysql_fetch_array($i_equip_item);
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
  <img width=48 src="/images/items/'.$item['id'].'.png" alt="*"/>            </div> 
            <div class="clb"></div> 
           </div> 
           <div class="mt5 mb5 sh small">
               '.$item['name'].'
           </div> 
           <div class="mt5 mb5 sh small"> 
  <font color="'.$quality_color[$item['quality']].'">'.$quality[$item['quality']].'</font>, '.$w[$item['w']].'
           </div> 
           <div class="mt5 mb5 sh small"> 
            <img width=16 src="/images/ico/rune/'.$inv['rune'].'.png" alt="*"/> <font color="'.$rune_color[$inv['rune']].'">+'.$rune_stats[$inv['rune']].' к параметрам</font> 

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
  <div class="bdr cnr mb2">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="ml5 mt5 mb5 sh small"> 
            <img class="icon" src="http://144.76.127.94/view/image/icons/strength.png"> Сила:  '.$equip_item['str'].' 
            <br> 
            <img class="icon" src="http://144.76.127.94/view/image/icons/health.png"> Здоровье:  '.$equip_item['_vit'].' 
            <br> 
            <img class="icon" src="http://144.76.127.94/view/image/icons/defense.png"> Броня:  '.$equip_item['_def'].' 
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
  <div class="bdr cnr mb2">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
           <div class="ml5 mt5 mb5 sh small"> 
            <div class="mb5"> 
             <img class="icon" src="http://144.76.127.94/view/image/icons/grind.png"> Заточка: + '.$inv['smith'].'  
             <a class="ml10" href="/shop/smith/'.$inv['id'].'/">Заточить</a> 
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
  </div> 
  <div class="bntf">
   <div class="small">
    <div class="nl">
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
  </div> 
   <div>
    <div></div>
   </div>
  </div>';

        if($user['w_'.$item['w']] == $inv['id']) { echo'<div class="link_center"><a  class="mbtn mb2"  href="/inv/move/'.$inv['id'].'/">В сумку</a>';}





 
{


	
	
	
echo '<a class=mbtn mb2 href="/inv/wear/'.$inv['id'].'/">Надеть</a>';

    
    if($user['w_'.$item['w']] != $inv['id']) {

switch($item['quality']) {
case 1:
$_ = 6;
$_g = 0;
break;
case 2:
$_exp_item = 13;
$_g = 0;
break;
case 3:
$_exp_item = 21;
$_g = 0;
break;
case 4:
$_exp_item = 50;
$_g = 0;
break;
case 5:
$_exp_item = 150;
$_g = 0;
break;
case 6:
$_exp_item = 500;
$_g = 0;
break;
case 7:
$_exp_item = 1000;
$_g = 0;
break;
}



echo' <a class=mbtn mb2 href="/inv/?sell='.$inv['id'].'">Разобрать вещь + '.$_exp_item.' очков</a>';
 
}
echo'</div>';

  

}
  
  

  
 /////////////////////////////////////////////////////////////// 
 //Сравниваем вещи
 ///////////////////////////////////////////////////////////////  
  
  if($equip_item && $inv['user'] != $user['id'] && $user['w_'.$item['w']]) {

    $i_equip_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$equip_item['item'].'"');
    $i_equip_item = mysql_fetch_array($i_equip_item);

  $quality = [	'1'=>'Обычный',
				'2'=>'Необычный',
				'3'=>'Редкий',
				'4'=>'Эпический',
				'5'=>'Легендарный',
				'6'=>'Мифический'
		];
$quality_color=['1'=>'#999999',
				'2'=>'#B1D689',
				'3'=>'#6BA0E7',
				'4'=>'#C780DB',
				'5'=>'#FF8E94',
				'6'=>'#FE7E01'
		];
		
$w = [	'1'=>'Голова',
		'2'=>'Плечи',
		'3'=>'Торс',
		'4'=>'Перчатки',
		'5'=>'Левая рука',
		'6'=>'Правая рука',
		'7'=>'Ноги',
		'8'=>'Обувь'
		];

echo'<div class="line"></div>';
echo'<div class="title">На вас надето</div>
<div class="line"></div>

<div class="empty_block">
<table cellpadding="0" cellspacing="0">
<tr>
  <td width="15%"><img src="/images/items/'.$equip_item['item'].'.png" alt="*"/></td>
  <td><img src="/images/ico/quality/'.$i_equip_item['quality'].'.png" alt="*"/> <font color="#fff">'.$i_equip_item['name'].'</font>
  <br/>
  <small><font color="#'.($i_equip_item['level_item'] > $i_equip_item['level_item_max'] ? 'c06060':'fff').'">  <img src="/images/ico/png/up.png" alt="*" width="12"/>'.$i_equip_item['level_item'].' / '.$i_equip_item['level_item_max'].' уровень. </font>
  <font color="'.$quality_color[$i_equip_item['quality']].'">  '.$quality[$i_equip_item['quality']].'</font>, '.$w[$i_equip_item['w']].'<br/>';

    if($equip_item['rune']) {
$rune_stats = [ '1'=>'15',
				'2'=>'30',
				'3'=>'60',
				'4'=>'200',
				'5'=>'500',
				'6'=>'1000'
		];
$rune_color=[   '1'=>'#999999',
				'2'=>'#B1D689',
				'3'=>'#6BA0E7',
				'4'=>'#C780DB',
				'5'=>'#FF8E94',
				'6'=>'#FE7E01'
		];

  echo'
  <img src="/images/ico/rune/small_'.$equip_item['rune'].'.png" alt="*"/> <font color="'.$rune_color[$equip_item['rune']].'">+'.$rune_stats[$equip_item['rune']].' к параметрам </font><br/>';
	}
  
  echo'</small></td>
</tr></table>
</div><div class="line"></div>';

echo'<div class="empty_block">
<font color="#90b0c0">
  <img src="/images/ico/png/attack.png" alt="*"/> Сила:  '.$equip_item['_str'].' <br/>
  <img src="/images/ico/png/hp.png" alt="*"/> Жизнь: '.$equip_item['_vit'].' <br/>
  <img src="/images/ico/png/def.png" alt="*"/> Защита: '.$equip_item['_def'].' <br/>
  </font>
</div>';
 
}
echo'<div class="line"></div>';
include './system/f.php';

?>