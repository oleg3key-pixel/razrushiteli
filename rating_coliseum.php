<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';
    
if(!$user) {//Переадресация для не авторизованных
header('location: /');    
exit;}




/*
$max = 10;
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `users`'),0);
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));

if($page > $pages) {$page = $pages;}
if($page < 1) {$page = 1;}
$start = $page * $max - $max;

if($page == 1) {$i = $page - 1;}
elseif($page == 2) {
$i = ($page + 9);
}else{$i = ($page * 10) - 9;}
*/





$max = 10;
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `users`'),0);
if($count > '100'){ $count=100;}
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));

if($page > $pages) {$page = $pages;}
if($page < 1) {$page = 1;}
$start = $page * $max - $max;

$i = ($page * 10 - 10 );




$q = mysql_query('SELECT * FROM `users` ORDER BY `coliseum_rating`DESC LIMIT '.$start.', '.$max.'');
include './system/h.php';  

/*
echo'<div class="block_link"><a href="/user/'.$row['id'].'/">'; 
if($user['id'] == $row[id])echo ' <font color="lime"> '.$i.'. </font>';
else echo ''.$i.'';
echo''.nick($row['id']).' ';

*/



echo '  <div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Рейтинг лучших
    </div>
   </div>
  </div> 
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
            <div class="cntr mt10"> ';

echo '<div class="hr_arr mlr10 mb-3"><div class="alf"><div class="art"><div class="acn"></div></div></div></div>
          <div class="pt3 cntr">
		<div class="fl w25 inbl spr2bg r">
							<a href="/rating.php" class="pt3 inbl">
					Игроки				</a>
					</div>
		<div class="fl w25 inbl spr2bg r">
			<a href="/clans.php" class="pt3 inbl">
				Кланы			</a>
		</div>
		<div class="fl w25 inbl spr2bg r">
							<span class="slct"><span class="send"><span class="sttl">
					Колизей				</span></span></span>
					</div>
		<div class="fr w25 inbl">
							<a href="/rating_valor.php" class="pt3 inbl">
					Доблесть				</a>
					</div>
		<div class="clb"></div>
	</div>  
            
            
            
            
            
            
            
            
            
            
             <div class="clb"></div> 
            </div> 
            <div class="hr_arr mlr10">
             <div class="alf">
              <div class="art">
               <div class="acn"></div>
              </div>
             </div>
            </div> 
            <table class="cntr wa mlra mb10"> 
             <tbody>
              <tr> 
               <td class="p5">Место</td> 
               <td class="p5">Имя</td> 
               <td class="p5">Рейтинг</td> 
              </tr>';

           while($row = mysql_fetch_array($q)) {//Вывод игроков
            $a=array($row['coliseum_rating']);//Додаем Уровень
$i++;


   
echo '           <tr>
               <td class="yell">'.$i.'</td>
               <td class="lft"><a href="/user/'.$row['id'].'" class="">'.$row['login'].'</a></td>
               <td class="yell">'.array_sum($a).'</td>
              </tr>
              <tr>
              </tr>';
 }
echo '           </tbody>
            </table>
            <div class="hr_arr mt5 mlr10">
             <div class="alf">
              <div class="art">
               <div class="acn"></div>
              </div>
             </div>
            </div>
            <div class="pgn">
             <span class="pag">';
             echo''.pages('?').'';//Вывод страниц
echo '       </span> </div>
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
   <div>
    <div></div>
   </div>
  </div> 
   <div>
    <div></div>
   </div>
  </div>';
  

include './system/f.php';

?>