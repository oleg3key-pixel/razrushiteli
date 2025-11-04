<?
include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';

include './system/h.php';



$id = _string(_num($_GET['id']));

if(!$id && $user) {
    $id = $user['id'];
}

  $i = mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$id.'"');
  $i = mysql_fetch_array($i);








echo '<div class="bdr bg_main mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
				<div class="mt8 ml5 mb5">
				<div class="fl ml5 sz0">
					<a href="/build?clan_id=78&amp;type=1"><img class="item_icon" src="http://144.76.127.94/view/image/builds/build1_1.png"></a>
				</div>
				<div class="ml68 mt5">
					
					
					<a class="medium lwhite tdn" href="/build?clan_id=78&amp;type=1"> Академия <span class="lwhite small">'.$i['built_1'].' из 20)</span></a><br>				</div>

				
				<div class="ml68 mt5 lorange small">
					Бонус: +'.clan_bufff($i['built_1']).'% к опыту в <a href=/lair>поземелье</a>				</div>
							</div>
			<div class="clb"></div>
							<div class="hr_arr mlr10"><div class="alf"><div class="art"><div class="acn"></div></div></div></div>
							<div class="mt8 ml5 mb5">
				<div class="fl ml5 sz0">
					<a href="/build?clan_id=78&amp;type=2"><img class="item_icon" src="http://144.76.127.94/view/image/builds/build2_1.png"></a>
				</div>
				<div class="ml68 mt5">
					
					
					<a class="medium lwhite tdn" href="/build?clan_id=78&amp;type=2"> Архивы знаний <span class="lwhite small">('.$i['built_2'].' из 20)</span></a><br>				</div>

				
				<div class="ml68 mt5 lorange small">
					Бонус: +'.clan_bufff($i['built_2']).'% к опыту на <a href=/arena>арене</a>				</div>
							</div>
			<div class="clb"></div>
							<div class="hr_arr mlr10"><div class="alf"><div class="art"><div class="acn"></div></div></div></div>
							<div class="mt8 ml5 mb5">
				<div class="fl ml5 sz0">
					<a href="/build?clan_id=78&amp;type=3"><img class="item_icon" src="http://144.76.127.94/view/image/builds/build3_1.png"></a>
				</div>
				<div class="ml68 mt5">
					
					
					<a class="medium lwhite tdn" href="/build?clan_id=78&amp;type=3"> Магическая лавка <span class="lwhite small">('.$i['built_3'].' из 20)</span></a><br>				</div>

				
				<div class="ml68 mt5 lorange small">
					Бонус: +'.clan_bufff($i['built_3']).'% к серебру в <a href=/lair>поземелье</a>				</div>
							</div>
			<div class="clb"></div>
							<div class="hr_arr mlr10"><div class="alf"><div class="art"><div class="acn"></div></div></div></div>
							<div class="mt8 ml5 mb5">
				<div class="fl ml5 sz0">
					<a href="/build?clan_id=78&amp;type=4"><img class="item_icon" src="http://144.76.127.94/view/image/builds/build4_1.png"></a>
				</div>
				<div class="ml68 mt5">
					
					
					<a class="medium lwhite tdn" href="/build?clan_id=78&amp;type=4"> Серебряный зал <span class="lwhite small">('.$i['built_4'].' из 20)</span></a><br>				</div>

				
				<div class="ml68 mt5 lorange small">
					Бонус: +'.clan_bufff($i['built_4']).'% к серебру на <a href=/arena>арене</a>				</div>
							</div>
			<div class="clb"></div>
							<div class="hr_arr mlr10"><div class="alf"><div class="art"><div class="acn"></div></div></div></div>
							<div class="mt8 ml5 mb5">
				<div class="fl ml5 sz0">
					<a href="/build?clan_id=78&amp;type=5"><img class="item_icon" src="http://144.76.127.94/view/image/builds/build5_1.png"></a>
				</div>
				<div class="ml68 mt5">
					
					
					<a class="medium lwhite tdn" href="/build?clan_id=78&amp;type=5"> Зал славы <span class="lwhite small">('.$i['built_5'].' из 20)</span></a>				</div>

				
				<div class="ml68 mt5 lorange small">
					Бонус: +'.clan_bufff($i['built_5']).'% к доблести в <a href=/lair>поземелье</a>				</div>
							</div>
			<div class="clb"></div>
							<div class="hr_arr mlr10"><div class="alf"><div class="art"><div class="acn"></div></div></div></div>
							<div class="mt8 ml5 mb5">
				<div class="fl ml5 sz0">
					<a href="/build?clan_id=78&amp;type=6"><img class="item_icon" src="http://144.76.127.94/view/image/builds/build6_1.png"></a>
				</div>
				<div class="ml68 mt5">
					
					
					<a class="medium lwhite tdn" href="/build?clan_id=78&amp;type=6"> Обелиск доблести <span class="lwhite small">('.$i['built_6'].' из 20)</span></a><br>				</div>

				
				<div class="ml68 mt5 lorange small">
					Бонус: +'.clan_bufff($i['built_6']).'% к доблести на <a href=/arena>арене</a>				</div>
							</div>
			<div class="clb"></div>
							<div class="hr_arr mlr10"><div class="alf"><div class="art"><div class="acn"></div></div></div></div>
							<div class="mt8 ml5 mb5">
				<div class="fl ml5 sz0">
					<a href="/build?clan_id=78&amp;type=7"><img class="item_icon" src="http://144.76.127.94/view/image/builds/build7_1.png"></a>
				</div>
				<div class="ml68 mt5">
					
					
					<a class="medium lwhite tdn" href="/build?clan_id=78&amp;type=7"> Дом герольдов <span class="lwhite small">('.$i['built_7'].' из 20)</span></a><br>				</div>

				
				<div class="ml68 mt5 lorange small">
					Бонус: +'.clan_bufff($i['built_7']).'% к алмазам в <a href=/lair>поземелье</a>				</div>
							</div>
			<div class="clb"></div>
							<div class="hr_arr mlr10"><div class="alf"><div class="art"><div class="acn"></div></div></div></div>
							<div class="mt8 ml5 mb5">
				<div class="fl ml5 sz0">
					<a href="/build?clan_id=78&amp;type=8"><img class="item_icon" src="http://144.76.127.94/view/image/builds/build8_1.png"></a>
				</div>
				<div class="ml68 mt5">
					
					
					<a class="medium lwhite tdn" href="/build?clan_id=78&amp;type=8"> Цитадель герольдов <span class="lwhite small">('.$i['built_8'].' из 20)</span></a>				</div>

				
				<div class="ml68 mt5 lorange small">
					Бонус: +'.clan_bufff($i['built_8']).'% к алмазам на <a href=/arena>арене</a>				</div>
							</div>
			<div class="clb"></div>
					</div></div></div></div></div></div></div></div></div>';








include ('./system/f.php');


