<?   
include './system/common.php'; 
include './system/functions.php';
include './system/user.php';
    
if(!$user) { 
header('location: /'); 
exit;}


$act = isset($_GET['act']) ? $_GET['act'] : null;
switch($act)
{
default: //Главнвя
$title = 'Подарки';
include './system/h.php';  
echo '<div class="ribbon mb2"><div class="rl"><div class="rr">
	Подарки '.$row['user'].'</div></div></div>';

?>

<?
if(isset($_GET['id'])){$id=intval($_GET['id']);}else{$id=$user['id'];}


$max = 10;
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `gifts_user` WHERE `komy` = '.$id.' '),0);
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));

if($page > $pages) {$page = $pages;}
if($page < 1) {$page = 1;}
$start = $page * $max - $max;

if($count > 0) {
$q = mysql_query('SELECT * FROM `gifts_user` WHERE `komy` = '.$id.' ORDER BY `id` DESC LIMIT '.$start.' , '.$max.'');
?>
<div class="bdr bg_blue mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="ml10 mt5 mr10 mb5 cntr">
<?
 while($row = mysql_fetch_array($q)) {
 

echo'
<table> <tbody><tr>
<td width="14%">
<img src="/images/gift/'.$row['img'].'.png" alt=""/>
</td><td> ';
 if($row['privacy'] == '2' AND $row['komy'] != $user['id']){echo'<font color="#fff"> Неизвестный </font>'; }else{ echo'<a href="/user/'.$row['user'].'">'.nick($row['user']).'</a>';}
 if($row['privacy'] == '2' AND $row['komy'] != $user['id']){if($row['text']){echo'<br><font color="#fff"> Текст скрытый </font>'; }}else{ if($row['text']){ echo'</br><font color="'.color($row['user']).'">'.$row['text'].'</font>'; }}
 echo'<br>'._times(time() - $row['time']).'
 </td></tr>
</tbody></table>
<div class="hr_arr mt5 mlr10"><div class="alf"><div class="art"><div class="acn"></div></div></div></div>';
}

echo ''.pages('?').'';  	

?>
</div>
	<div class="clb"></div>
</div></div></div></div></div></div></div></div></div>
<?
  
}else{
echo '<div class="hr_g mb2"><div><div></div></div></div>
<div class="bntf"><div class="small"><div class="nl"><div class="nr cntr lyell small lh1 plr15 pt5 pb5 sh">
		Подарков нету</div></div></div></div>';

}
echo'
<div class="hr_g mb2"><div><div></div></div></div>
<a class="mbtn mb2" href="/user/'.$id.'/"><img src="http://144.76.127.94/view/image/icons/back.png" class="icon"> Назад</a>
';
break;


case 'choose_gifts':
$title = 'Выбери подарок';
include './system/h.php';  
echo '<div class="ribbon mb2"><div class="rl"><div class="rr">Выбери подарок</div></div></div>';
$id = abs(intval($_GET['id']));

if($id == $user['id']) { 
header('location: /gifts/'.$id.'/'); 
exit;}

echo'<div class="bdr bg_blue">
    <div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
        <div class="ml10 mt5 mb5 mr10 sh cntr">
            <div id="gifts_block" class="pt3 cntr">
                
                    <a type="general" href="/choose_gifts/'.$id.'?tip=0" class="slct" style="text-decoration:none; outline: none;"><span class="send"><span class="sttl">Подарки</span></span></a>
                
                                <div class="clb"></div>
            </div>
            <div class="hr_arr mlr10 mt5">
                <div class="alf">
                    <div class="art">
                        <div class="acn"></div>
                    </div>
                </div>
            </div>';
if(isset($_GET['tip'])){
$tip=abs(intval($_GET['tip']));
}
if(@$tip > 3  or !isset($_GET['tip']) ){$tip=0;}

$q = mysql_query('SELECT * FROM `gifts` WHERE `tip` = "'.$tip.'" ORDER BY `id` DESC');
 while($row = mysql_fetch_array($q)) {
echo'<a href="/mail/'.$id.'?gift='.$row['id'].'"><img src="/images/gift/'.$row['img'].'.png" alt=""/></a>';
}


echo'</div></div></div></div></div></div></div></div></div></div></div></div></div></div>
           <div class="hr_g mb2 mt5"><div><div></div></div></div>
        </div>
            <div class="bntf">
                <div class="small">
                    <div class="nl">
                        <div class="nr cntr lyell small lh1 p2 sh">
                            Цена любого подарка <img class="icon" src="/images/ico/png/gold.png">10                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>


';  



$id = _string(_num($_GET['id']));

if(!$id && $user) {
    $id = $user['id'];
}

  $i = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"');
  $i = mysql_fetch_array($i);
  
  
$zags = mysql_query('SELECT * FROM `zags` WHERE `id_0` = "'.$user['id'].'" OR `id_1` = "'.$user['id'].'"');
$zags = mysql_fetch_array($zags);

if($i['sex'] == '1'){
if($zags['status'] == 'off'){
    ?>
    <div class="bdr bg_blue mb2"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
	<div class="ml10 mt5 mr10 mb5 cntr">
	    <?
echo ' <a href=/zags/'.$i[id].'><img src=http://144.76.125.123/view/image/present/present34.png class=icon>Позвать замуж</a>';
?>
</div>
	<div class="clb"></div>
</div></div></div></div></div></div></div></div></div>
<?
}    
}


?>
            <div class="hr_g mb2 mt5"><div><div></div></div></div>
    <a id="use_choose_gifts_back" class="mbtn mb2" href="/mail/'.$id.'"><img src="http://144.76.127.94/view/image/icons/back.png" class="icon"> Назад к переписке</a>  
<?

  
  


break;

}
include './system/f.php';

?>