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





echo '<div class="ribbon mb2"><div class="rl"><div class="rr">О '.$i['login'].'</div></div></div>


  
  
  <div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
		<div class="ml5 mt10 mb10 mr5 sh">
			
				<span class="lyell"><img src="/view/image/icons/png/about_a.png" alt="" class="icon"> Статус</span><br>

				<div class="mb5">'.$i['anketa_status'].'</div>

			
			
				<span class="lyell"><img src="/view/image/icons/png/name.png" alt="" class="icon"> Реальное имя</span><br>

				<div class="lblue mb5">'.$i['anketa_name'].'</div>

			



			
				<span class="lyell"><img src="/view/image/icons/png/city.png" alt="" class="icon"> Город</span><br>




				<div class="lblue mb5">

				'.$i['anketa_city'].'

				
				</div>

		

			
			
				<span class="lyell"><img src="/view/image/icons/png/anketa.png" alt="" class="icon"> Анкета</span><br>

				<div class="lblue mb5">'.$i['anketa_anketa'].'</div>

					</div>
</div></div></div></div></div></div></div></div></div>';
  
  
  
  
  
  
  
  

include './system/f.php';
?>