<?
include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';

include './system/h.php';



echo ' 
<div class="bdr cnr bg_blue mb2 bl nd"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="ml10 mt5 mr10 mb5">
		<div class="medium win tdn bold mb10">Турнир по доблести</div>
		<span class="lorange">Ваш уровень доблести:</span> <span class="lyell"><img class="icon" height="20" src="http://144.76.127.94/view/image/icons/up_valor.png">'.$clan_memb['valor'].'</span>
		<div class="mb5"></div>
		<span class="lorange">Доблесть вашего клана:</span> <span class="lyell"><img class="icon" height="20" src="http://144.76.127.94/view/image/icons/up_valor.png">'.$clan['valor'].'</span>
	</div>
	<div class="ml10 mt5 mr10 mb10 lorange">
			</div>
	<div class="ml10 mt5 mr10 mb10 lyell">
		<br><br>
		Каждый месяц проводятся турниры по доблести, как среди игроков так и среди кланов. 
		</div>
	<div class="clb"></div>
</div></div></div></div></div></div></div></div></div>




<div class="bdr cnr bg_blue mt10 mb2 bl nd"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="ml10 mt5 mr10 mb5">
		
<div class="medium win tdn bold mb10">Турнир по алмазам</div>
<span class="lorange">Вы добыли:</span> <img src="http://144.76.127.94/view/image/icons/diamond.png" class="icon"><span class="lyell">'.$clan_memb['plat'].' алмазов</span><div class="mb5"></div>
<span class="lorange">Ваш клан добыл:</span> <img src="http://144.76.127.94/view/image/icons/diamond.png" class="icon"><span class="lyell">'.$clan['plat'].' алмазов</span><br>
	</div>
	<div class="ml10 mt5 mr10 mb10 lyell">
		<br><br>
		Каждую неделю проводятся турниры по алмазам. Участвуют все игроки и все кланы.
В воскресенье подводится итог, кто больше собрал алмазов, тот и победил.
Также за  алмазы все кланы могут открыть портал к сокровищам, которые охраняют драконы.	</div>
	<div class="clb"></div>
</div></div></div></div></div></div></div></div></div>';








include ('./system/f.php');



