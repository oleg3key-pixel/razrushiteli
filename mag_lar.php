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








echo '  <div class="ribbon mb2">
   <div class="rl">
    <div class="rr">
      Магическая лавка
    </div>
   </div>
  </div> 
  <div class="bdr bg_blue mb2 lyell">
   <div class="wr1">
    <div class="wr2">
     <div class="wr3">
      <div class="wr4">
       <div class="wr5">
        <div class="wr6">
         <div class="wr7">
          <div class="wr8"> 
<br>
<center><img width=40 src=/put.png class=icon> В наше королевство пришёл изгнанник, который был служителем Титана. Он принёс с собой Сверх-сильное оружие.<br>Одну вещь он отдаст за 300.000 золота.<br>Из за сильной магии, и хорошего качества, вещь прибавляет +3000 к каждому параметру<br></center>
<br><img src=/images/items/10001.png class=icon> <font color=red><b>Тесак Бездны</b<font> <a class="ubtn inbl mt-15 blue mb2" href="/shop/?buy_item=10001/"><span class="ul"><span class="ur">Приобрести</span></span></a><br>
<br><img src=/images/items/10002.png class=icon> <font color=red><b>Палаш Мстителя</b></font> <a class="ubtn inbl mt-15 blue mb2" href="/shop/?buy_item=10002/"><span class="ul"><span class="ur">Приобрести</span></span></a><br>
<br><img src=/images/items/10003.png class=icon> <font color=red><b>Молот Небесного</b></font> <a class="ubtn inbl mt-15 blue mb2" href="/shop/?buy_item=10003/"><span class="ul"><span class="ur">Приобрести</span></span></a><br>
<br><img src=/images/items/10004.png class=icon> <font color=red><b>Глефа Хели</b></font> <a class="ubtn inbl mt-15 blue mb2" href="/shop/?buy_item=10004/"><span class="ul"><span class="ur">Приобрести</span></span></a><br>
<br><img src=/images/items/10005.png class=icon> <font color=red><b>Меч Древнего</b></font> <a class="ubtn inbl mt-15 blue mb2" href="/shop/?buy_item=10005/"><span class="ul"><span class="ur">Приобрести</span></span></a><br>
<br><img src=/images/items/10006.png class=icon> <font color=red><b>Топор Люцифера</b></font> <a class="ubtn inbl mt-15 blue mb2" href="/shop/?buy_item=10006/"><span class="ul"><span class="ur">Приобрести</span></span></a><br>
<br><img src=/images/items/10008.png class=icon> <font color=red><b>Щит Драгера</b></font> <a class="ubtn inbl mt-15 blue mb2" href="/shop/?buy_item=10008/"><span class="ul"><span class="ur">Приобрести</span></span></a><br>
<br><img src=/images/items/10007.png class=icon> <font color=red><b>Меч Всевластия</b></font> <a class="ubtn inbl mt-15 blue mb2" href="/shop/?buy_item=10007/"><span class="ul"><span class="ur">Приобрести</span></span></a><br>




           <div class="clb"></div> <br>
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
  </div> ';


//http://trush.pw/shop/?buy_item=9/





include ('./system/f.php');


