<? 
include './system/common.php';  
include './system/functions.php';
include './system/user.php';
    
    
    
    if(!$user) {
header('location: /');   
exit;}


$title = 'Тренировка';    
include './system/h.php';  

$id = _string(_num($_GET['id']));

  if($id && $id != $user['id']) {
    
  $i = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"');
  $i = mysql_fetch_array($i);
    
  if(!$i) {  
header('location: /user/');
exit;}

}else{
$i = $user;
}
    
    
    
    

$id = htmlspecialchars($_GET['id']); //Оприделяем какой параметр   
	

	
	
	
	
	
    function cost($i) {

	switch($i) {
case 0:
$cost = 50;
break;
        
case 1:
$cost = 100;
break;
        
case 2:
$cost = 150;
break;
          
case 3:
$cost = 250;
break;

case 4:
$cost = 5;
break;   
           
case 5:
$cost = 400;
break;        

case 6:
$cost = 600;
break;   

case 7:
$cost = 800;
break;

case 8:
$cost = 1000;
break;   
           
case 9:
$cost = 20;
break;   

case 10:
$cost = 1500;
break;   

case 11:
$cost = 2500;
break;   

case 12:
$cost = 3500;
break;   

case 13:
$cost = 5000;
break;   

case 14:
$cost = 50;
break;   

case 15:
$cost = 7000;
break;   

case 16:
$cost = 9600;
break;   

case 17:
$cost = 12000;
break;   

case 18:
$cost = 15000;
break;   

case 19:
$cost = 100;
break;   

case 20:
$cost = 18000;
break;   

case 21:
$cost = 21000;
break;   

case 22:
$cost = 24000;
break;   

case 23:
$cost = 27000;
break;   

case 24:
$cost = 200;
break;   

case 25:
$cost = 30000;
break;   

case 26:
$cost = 34000;
break;   

case 27:
$cost = 48000;
break;   

case 28:
$cost = 42000;
break;   

case 29:
$cost = 400;
break;   

case 30:
$cost = 46000;
break;   

case 31:
$cost = 50000;
break;   

case 32:
$cost = 54000;
break;   

case 33:
$cost = 60000;
break;   

case 34:
$cost = 800;
break;   

case 35:
$cost = 75000;
break;   

case 36:
$cost = 80000;
break;   

case 37:
$cost = 85000;
break;   

case 38:
$cost = 90000;
break;   

case 39:
$cost = 1500;
break;   

case 40:
$cost = 90000;
break;   

case 41:
$cost = 105000;
break;   

case 42:
$cost = 120000;
break;   

case 43:
$cost = 135000;
break;   

case 44:
$cost = 2500;
break;   

case 45:
$cost = 150000;
break;   

case 46:
$cost = 200000;
break;   

case 47:
$cost = 250000;
break;   

case 48:
$cost = 300000;
break;   

case 49:
$cost = 2500;
break;   

case 50:
$cost = 450000;
break;   

case 51:
$cost = 500000;
break;   

case 52:
$cost = 550000;
break;   

case 53:
$cost = 600000;
break;   

case 54:
$cost = 2500;
break;   

case 55:
$cost = 700000;
break;   

case 56:
$cost = 800000;
break;   

case 57:
$cost = 900000;
break;   

case 58:
$cost = 1000000;
break;   

case 59:
$cost = 2500;
break;   

case 60:
$cost = 1250000;
break; 

case 61:
$cost = 1500000;
break; 

case 62:
$cost = 1750000;
break; 

case 63:
$cost = 2000000;
break; 

case 64:
$cost = 2500;
break; 

case 65:
$cost = 2500000;
break; 

case 66:
$cost = 3000000;
break; 

case 67:
$cost = 3500000;
break; 

case 68:
$cost = 4000000;
break; 

case 69:
$cost = 2500;
break; 

case 70:
$cost = 5000000;
break; 

case 71:
$cost = 6000000;
break; 

case 72:
$cost = 7000000;
break; 

case 73:
$cost = 8000000;
break; 

case 74:
$cost = 3000;
break; 

case 75:
$cost = 10000000;
break; 

case 76:
$cost = 15000000;
break; 

case 77:
$cost = 20000000;
break; 

case 78:
$cost = 25000000;
break; 

case 79:
$cost = 3000;
break; 

case 80:
$cost = 35000000;
break; 

case 81:
$cost = 40000000;
break; 

case 82:
$cost = 45000000;
break; 

case 83:
$cost = 50000000;
break; 

case 84:
$cost = 3000;
break; 

case 85:
$cost = 55000000;
break; 

case 86:
$cost = 60000000;
break; 

case 87:
$cost = 65000000;
break; 

case 88:
$cost = 70000000;
break; 

case 89:
$cost = 3000;
break; 

case 90:
$cost = 75000000;
break; 

case 91:
$cost = 80000000;
break; 

case 92:
$cost = 85000000;
break; 

case 93:
$cost = 90000000;
break; 

case 94:
$cost = 3000;
break; 

case 95:
$cost = 95000000;
break; 

case 96:
$cost = 100000000;
break; 

case 97:
$cost = 105000000;
break; 

case 98:
$cost = 110000000;
break; 

case 99:
$cost = 4000;
break; 

case 100:
$cost = 100000000;
break; 

case 101:
$cost = 100000000;
break; 

case 102:
$cost = 100000000;
break; 

case 103:
$cost = 100000000;
break; 

case 104:
$cost = 4000;
break; 

case 105:
$cost = 100000000;
break; 

case 106:
$cost = 100000000;
break; 

case 107:
$cost = 100000000;
break; 

case 108:
$cost = 100000000;
break; 

case 109:
$cost = 4000;
break; 

case 110:
$cost = 100000000;
break; 

case 111:
$cost = 100000000;
break; 

case 112:
$cost = 100000000;
break; 

case 113:
$cost = 100000000;
break; 

case 114:
$cost = 4000;
break; 

case 115:
$cost = 100000000;
break; 

case 116:
$cost = 100000000;
break; 

case 117:
$cost = 100000000;
break; 

case 118:
$cost = 100000000;
break; 

case 119:
$cost = 4000;
break; 

case 120:
$cost = 100000000;
break; 

case 121:
$cost = 100000000;
break; 

case 122:
$cost = 100000000;
break; 

case 123:
$cost = 100000000;
break; 

case 124:
$cost = 4000;
break; 

case 125:
$cost = 100000000;
break; 

case 126:
$cost = 100000000;
break; 

case 127:
$cost = 100000000;
break; 

case 128:
$cost = 100000000;
break; 

case 129:
$cost = 4000;
break; 

case 130:
$cost = 100000000;
break; 

case 131:
$cost = 100000000;
break; 

case 132:
$cost = 100000000;
break; 

case 133:
$cost = 100000000;
break; 

case 134:
$cost = 4000;
break; 

case 135:
$cost = 100000000;
break; 

case 136:
$cost = 100000000;
break; 

case 137:
$cost = 100000000;
break; 

case 138:
$cost = 100000000;
break; 

case 139:
$cost = 4000;
break; 

case 140:
$cost = 100000000;
break; 

case 141:
$cost = 100000000;
break; 

case 142:
$cost = 100000000;
break; 

case 143:
$cost = 100000000;
break; 

case 144:
$cost = 4000;
break; 

case 145:
$cost = 100000000;
break; 

case 146:
$cost = 100000000;
break; 

case 147:
$cost = 100000000;
break; 

case 148:
$cost = 100000000;
break; 

case 149:
$cost = 4000;
break; 

case 150:
$cost = 100000000;
break; 

case 151:
$cost = 100000000;
break; 

case 152:
$cost = 100000000;
break; 

case 153:
$cost = 100000000;
break; 

case 154:
$cost = 4000;
break; 

case 155:
$cost = 100000000;
break; 

case 156:
$cost = 100000000;
break; 

case 157:
$cost = 100000000;
break; 

case 158:
$cost = 100000000;
break; 

case 159:
$cost = 4000;
break; 

case 160:
$cost = 100000000;
break; 

case 161:
$cost = 100000000;
break; 

case 162:
$cost = 100000000;
break; 

case 163:
$cost = 100000000;
break; 

case 164:
$cost = 4000;
break; 

case 165:
$cost = 100000000;
break; 

case 166:
$cost = 100000000;
break; 

case 167:
$cost = 100000000;
break; 

case 168:
$cost = 100000000;
break; 

case 169:
$cost = 4000;
break; 

case 170:
$cost = 100000000;
break; 

case 171:
$cost = 100000000;
break; 

case 172:
$cost = 100000000;
break; 

case 173:
$cost = 100000000;
break; 

case 174:
$cost = 4000;
break; 

case 175:
$cost = 100000000;
break; 

case 176:
$cost = 100000000;
break; 

case 177:
$cost = 100000000;
break; 

case 178:
$cost = 100000000;
break; 

case 179:
$cost = 4000;
break; 

case 180:
$cost = 100000000;
break; 

case 181:
$cost = 100000000;
break; 

case 182:
$cost = 100000000;
break; 

case 183:
$cost = 100000000;
break; 

case 184:
$cost = 4000;
break; 

case 185:
$cost = 100000000;
break; 

case 186:
$cost = 100000000;
break; 

case 187:
$cost = 100000000;
break; 

case 188:
$cost = 100000000;
break; 

case 189:
$cost = 4000;
break; 

case 190:
$cost = 100000000;
break; 

case 191:
$cost = 100000000;
break; 

case 192:
$cost = 100000000;
break; 

case 193:
$cost = 100000000;
break; 

case 194:
$cost = 4000;
break; 

case 195:
$cost = 100000000;
break; 

case 196:
$cost = 100000000;
break; 

case 197:
$cost = 100000000;
break; 

case 198:
$cost = 100000000;
break; 

case 199:
$cost = 4000;
break; 
}
        
return $cost;
    
}

    function value($i) {
        
       switch($i) {
case 0:
$value = 's';
break;
        
case 1:
$value = 's';
break;
        
case 2:
$value = 's';
break;
          
case 3:
$value = 's';
break;

case 4:
$value = 'g';
break;        

case 5:
$value = 's';
break;        

case 6:
$value = 's';
break;        

case 7:
$value = 's';
break;        

case 8:
$value = 's';
break;        

case 9:
$value = 'g';
break;        

case 10:
$value = 's';
break;        

case 11:
$value = 's';
break;        

case 12:
$value = 's';
break;        

case 13:
$value = 's';
break;        

case 14:
$value = 'g';
break;        

case 15:
$value = 's';
break;        

case 16:
$value = 's';
break;        

case 17:
$value = 's';
break;        

case 18:
$value = 's';
break;        
        
case 19:
$value = 'g';
break;        

case 20:
$value = 's';
break;        
          
case 21:
$value = 's';
break;        
          
case 22:
$value = 's';
break;     
              
case 23:
$value = 's';
break;        

case 24:
$value = 'g';
break;     

case 25:
$value = 's';
break;     

case 26:
$value = 's';
break;     

case 27:
$value = 's';
break;     

case 28:
$value = 's';
break;     

case 29:
$value = 'g';
break;     

case 30:
$value = 's';
break;     

case 31:
$value = 's';
break;     

case 32:
$value = 's';
break;     

case 33:
$value = 's';
break;     

case 34:
$value = 'g';
break;     

case 35:
$value = 's';
break;     

case 36:
$value = 's';
break;     

case 37:
$value = 's';
break;     

case 38:
$value = 's';
break;     

case 39:
$value = 'g';
break;     

case 40:
$value = 's';
break;     

case 41:
$value = 's';
break;     

case 42:
$value = 's';
break;     

case 43:
$value = 's';
break;     

case 44:
$value = 'g';
break;     

case 45:
$value = 's';
break;     

case 46:
$value = 's';
break;     

case 47:
$value = 's';
break;     

case 48:
$value = 's';
break;     

case 49:
$value = 'g';
break;     

case 50:
$value = 's';
break;     

case 51:
$value = 's';
break;     

case 52:
$value = 's';
break;     

case 53:
$value = 's';
break;     

case 54:
$value = 'g';
break;     

case 55:
$value = 's';
break;     

case 56:
$value = 's';
break;     

case 57:
$value = 's';
break;     

case 58:
$value = 's';
break;     

case 59:
$value = 'g';
break; 

case 60:
$value = 's';
break;     

case 61:
$value = 's';
break;     

case 62:
$value = 's';
break;     

case 63:
$value = 's';
break;     

case 64:
$value = 'g';
break;

case 65:
$value = 's';
break;     

case 66:
$value = 's';
break;     

case 67:
$value = 's';
break;     

case 68:
$value = 's';
break;     

case 69:
$value = 'g';
break;

case 70:
$value = 's';
break;     

case 71:
$value = 's';
break;     

case 72:
$value = 's';
break;     

case 73:
$value = 's';
break; 

case 74:
$value = 'g';
break;

case 75:
$value = 's';
break;     

case 76:
$value = 's';
break;     

case 77:
$value = 's';
break;     

case 78:
$value = 's';
break; 

case 79:
$value = 'g';
break;

case 80:
$value = 's';
break;     

case 81:
$value = 's';
break;     

case 82:
$value = 's';
break;     

case 83:
$value = 's';
break; 

case 84:
$value = 'g';
break;

case 85:
$value = 's';
break;     

case 86:
$value = 's';
break;     

case 87:
$value = 's';
break;     

case 88:
$value = 's';
break; 

case 89:
$value = 'g';
break;

case 90:
$value = 's';
break;     

case 91:
$value = 's';
break;     

case 92:
$value = 's';
break;     

case 93:
$value = 's';
break; 

case 94:
$value = 'g';
break;

case 95:
$value = 's';
break;     

case 96:
$value = 's';
break;     

case 97:
$value = 's';
break;     

case 98:
$value = 's';
break; 

case 99:
$value = 'g';
break;

case 100:
$value = 's';
break;     

case 101:
$value = 's';
break;     

case 102:
$value = 's';
break;     

case 103:
$value = 's';
break; 

case 104:
$value = 'g';
break;

case 105:
$value = 's';
break;     

case 106:
$value = 's';
break;     

case 107:
$value = 's';
break;     

case 108:
$value = 's';
break; 

case 109:
$value = 'g';
break;

case 110:
$value = 's';
break;     

case 111:
$value = 's';
break;     

case 112:
$value = 's';
break;     

case 113:
$value = 's';
break; 

case 114:
$value = 'g';
break;

case 115:
$value = 's';
break;     

case 116:
$value = 's';
break;     

case 117:
$value = 's';
break;     

case 118:
$value = 's';
break; 

case 119:
$value = 'g';
break;

case 120:
$value = 's';
break;     

case 121:
$value = 's';
break;     

case 122:
$value = 's';
break;     

case 123:
$value = 's';
break; 

case 124:
$value = 'g';
break;

case 125:
$value = 's';
break;     

case 126:
$value = 's';
break;     

case 127:
$value = 's';
break;     

case 128:
$value = 's';
break; 

case 129:
$value = 'g';
break;

case 130:
$value = 's';
break;     

case 131:
$value = 's';
break;     

case 132:
$value = 's';
break;     

case 133:
$value = 's';
break; 

case 134:
$value = 'g';
break;

case 135:
$value = 's';
break;     

case 136:
$value = 's';
break;     

case 137:
$value = 's';
break;     

case 138:
$value = 's';
break; 

case 139:
$value = 'g';
break;

case 140:
$value = 's';
break;     

case 141:
$value = 's';
break;     

case 142:
$value = 's';
break;     

case 143:
$value = 's';
break; 

case 144:
$value = 'g';
break;

case 145:
$value = 's';
break;     

case 146:
$value = 's';
break;     

case 147:
$value = 's';
break;     

case 148:
$value = 's';
break; 

case 149:
$value = 'g';
break;

case 150:
$value = 's';
break;     

case 151:
$value = 's';
break;     

case 152:
$value = 's';
break;     

case 153:
$value = 's';
break; 

case 154:
$value = 'g';
break;

case 155:
$value = 's';
break;     

case 156:
$value = 's';
break;     

case 157:
$value = 's';
break;     

case 158:
$value = 's';
break; 

case 159:
$value = 'g';
break;

case 160:
$value = 's';
break;     

case 161:
$value = 's';
break;     

case 162:
$value = 's';
break;     

case 163:
$value = 's';
break; 

case 164:
$value = 'g';
break;

case 165:
$value = 's';
break;     

case 166:
$value = 's';
break;     

case 167:
$value = 's';
break;     

case 168:
$value = 's';
break; 

case 169:
$value = 'g';
break;

case 170:
$value = 's';
break;     

case 171:
$value = 's';
break;     

case 172:
$value = 's';
break;     

case 173:
$value = 's';
break; 

case 174:
$value = 'g';
break;

case 175:
$value = 's';
break;     

case 176:
$value = 's';
break;     

case 177:
$value = 's';
break;     

case 178:
$value = 's';
break; 

case 179:
$value = 'g';
break;

case 180:
$value = 's';
break;     

case 181:
$value = 's';
break;     

case 182:
$value = 's';
break;     

case 183:
$value = 's';
break; 

case 184:
$value = 'g';
break;

case 185:
$value = 's';
break;     

case 186:
$value = 's';
break;     

case 187:
$value = 's';
break;     

case 188:
$value = 's';
break; 

case 189:
$value = 'g';
break;

case 190:
$value = 's';
break;     

case 191:
$value = 's';
break;     

case 192:
$value = 's';
break;     

case 193:
$value = 's';
break; 

case 194:
$value = 'g';
break;

case 195:
$value = 's';
break;     

case 196:
$value = 's';
break;     

case 197:
$value = 's';
break;     

case 198:
$value = 's';
break; 

case 199:
$value = 'g';
break;







}
return $value;
 }

 
 
 
 
if($id) {

if($user['_'.$id.''] < 200) {

    if(value($user['_'.$id.'']) == 's') {
if($user['s'] < cost($user['_'.$id.''])) {
header("Location:/train/");
$_SESSION[''.$id.''] = mes('Недостаточно ресурсов!');
exit;           
}else{
mysql_query('UPDATE `users` SET `'.$id.'` =   `'.$id.'` + 3,
                                         `_'.$id.'` =  `_'.$id.'` + 1,
                                        `skill` = `skill` + 1 WHERE `id` = "'.$user['id'].'"');
mysql_query('UPDATE `users` SET `s` = `s` - '.cost($user['_'.$id.'']) .' WHERE `id` = "'.$user['id'].'"');
}

}else
    if(value($user['_'.$id.''] == 'g')) {
      
      if($user['g'] < cost($user['_'.$id.''])/ 2) {
header("Location:/train/");
$_SESSION[''.$id.''] = mes('Недостаточно ресурсов!');
exit; 
}else{
mysql_query('UPDATE `users` SET `'.$id.'` =   `'.$id.'` + 3,
                                         `_'.$id.'` =  `_'.$id.'` + 1,
                                        `skill` = `skill` + 1 WHERE `id` = "'.$user['id'].'"');
mysql_query('UPDATE `users` SET `g` = `g` - '.cost($user['_'.$id.'']) .' WHERE `id` = "'.$user['id'].'"');
  }    
}
}   


// Задания
$task_id=5;// Подними параметры героя 3 раза
$req = mysql_query('select * from `task_user` WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'") AND (`complete`="0")');
    if (mysql_num_rows ($req) != 0) {
while ($t = mysql_fetch_array ($req)) {
$task = mysql_fetch_array(mysql_query ('SELECT * FROM `task` WHERE (`id`="'.$task_id.'")'));
if ($t['how'] < $task['how']){                            
mysql_query ('UPDATE `task_user` SET `how`=`how`+1 WHERE (`user`="'.$user['id'].'") AND (`task`="'.$task_id.'")');
}}}
/////////////////////////////////////////////////

$_SESSION[''.$id.''] = mes('Успешно улучшено!');
header('location: /train/');
exit;
}	








echo'<div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Тренировка
    </div>
   </div>
  </div> ';

echo'



<div class="bdr bg_green"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
			<div class="fl ml10 mt10">
				<img class="item_icon" src="http://144.76.127.94/view/image/train/strength.png">			</div>
			<div class="ml68 mt10 mb10 mr10 sh small lorange">
				<span class="medium lwhite tdn"><span class="darkgreen_link">Сила </span><span class="darkgreen_link font_15">+ '.($i['_str']*3).'</span></span><br>
				<span><span class="text_small">Увеличивает наносимый врагам урон</span><br>Уровень: '.$i['_str'].' из 200</span>
			</div>
			<div class="clb"></div>
	</div></div></div></div></div></div></div></div></div>
<br>
';

  if($user['_str'] < 200) {
echo' <div class="cntr">
   <a href="/train/str" class="ubtn inbl green mb5 mt-15 ml5 mr5"><span class="ul"><span class="ur"><img src="/images/ico/png/'.(value($user['_str']) == 'g' ? 'gold':'silver').'.png" class=icon> '.cost($user['_str'])  .' </a></span></span></a>
  </div>';
}
echo'</div>
<div class="line"></div>';



echo'

<div class="bdr bg_green"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
			<div class="fl ml10 mt10">
				<img class="item_icon" src="http://144.76.127.94/view/image/train/health.png">			</div>
			<div class="ml68 mt10 mb10 mr10 sh small lorange">
				<span class="medium lwhite tdn"><span class="darkgreen_link">Здоровье </span><span class="darkgreen_link font_15">+ '.($i['_vit']*3).'</span></span><br>
				<span><span class="text_small">Увеличивает запас здоровья</span><br>Уровень: '.$i['_vit'].' из 200</span>
			</div>
			<div class="clb"></div>
	</div></div></div></div></div></div></div></div></div>





<br>




';
  if($user['_vit'] < 200) {
echo' <div class="cntr">
   <a href="/train/vit" class="ubtn inbl green mb5 mt-15 ml5 mr5"><span class="ul"><span class="ur"><img src="/images/ico/png/'.(value($user['_vit']) == 'g' ? 'gold':'silver').'.png" class=icon> '.cost($user['_vit'])  .' </a></span></span></a>
  </div>';
}
echo'</div>
<div class="line"></div>';




echo'


<div class="bdr bg_green"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
			<div class="fl ml10 mt10">
				<img class="item_icon" src="http://144.76.127.94/view/image/train/defense.png">			</div>
			<div class="ml68 mt10 mb10 mr10 sh small lorange">
				<span class="medium lwhite tdn"><span class="darkgreen_link">Броня </span><span class="darkgreen_link font_15">+ '.($i['_def']*3).'</span></span><br>
				<span><span class="text_small">Поглощает урон врага</span><br>Уровень: '.$i['_def'].' из 200</span>
			</div>
			<div class="clb"></div>
	</div></div></div></div></div></div></div></div></div>



 <br>




';
  if($user['_def'] < 200) {
echo' <div class="cntr">
   <a href="/train/def" class="ubtn inbl green mb5 mt-15 ml5 mr5"><span class="ul"><span class="ur"><img src="/images/ico/png/'.(value($user['_def']) == 'g' ? 'gold':'silver').'.png" class=icon> '.cost($user['_def'])   .'</a></span></span></a>
  </div>';}
echo'</div>
<div class="line"></div>




<div class="hr_g mb2"><div><div></div></div></div>
<div class="bntf"><div class="small"><div class="nl"><div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">
	Тренировка увеличивает параметры вашего героя</div></div></div></div>';


  
include './system/f.php';

?>