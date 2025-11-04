<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';
include './system/h.php';  

?>
<div class="ribbon mb2"><div class="rl"><div class="rr">Сотрудники игры</div></div></div>
<style>
   table.text  {
    width:  100%; /* Ширина таблицы */
    border-spacing: 0; /* Расстояние между ячейками */
   }
   table.text td {
    width: 50%; /* Ширина ячеек */
    vertical-align: top; /* Выравнивание по верхнему краю */
   }
   td.rightcol { /* Правая ячейка */ 
    text-align: right; /* Выравнивание по правому краю */
   }
  </style>
<?
?>
<div class="bdr bg_blue"><div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8"><br><div class="hr_arr mt-5 mlr10"><div class="alf"><div class="art"><div class="acn"></div></div></div></div><br>
<?
$q = mysql_query("SELECT * FROM `users` WHERE `access` > '0' ORDER BY `access` DESC");
while($post = mysql_fetch_assoc($q)) {
if($post['access']==1) $vip='Модератор чата';
if($post['access']==2) $vip='Модератор форума';
if($post['access']==3) $vip='Служба поддержки';
if($post['access']==4) $vip='Администрация';
if($post['access']==5) $vip='Создатель';
if($post['id']==101) $vip='Спонсор';
echo '<table class="text"><tr><td><a class="tdn lwhite" href="/user/'.$post['id'].'" class="admin">'.nick($post['id']).'</a></td><td class="rightcol">'.$vip.'</td></tr></table><br>';
}
?>
<br><div class="hr_arr mt-5 mlr10"><div class="alf"><div class="art"><div class="acn"></div></div></div></div><br></div></div></div></div></div></div></div></div></div></div>
<?
include './system/f.php';

?>