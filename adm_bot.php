<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';
    
if(isset($_GET['ok'])){
$q = mysql_query("SELECT * FROM `users` WHERE `online` < '".(time()-300)."' ORDER BY RAND() LIMIT 74");
while($post = mysql_fetch_assoc($q)) {
mysql_query("update `users` set `online` = '".(time()+rand(378,1999))."' WHERE `id` = '$post[id]'");
}
$_SESSION['msg'] = 'Боты включены';
header('Location: ?');
exit();
}
if(isset($_GET['off'])){
mysql_query("update `users` set `online` = '".(time()-300)."'");
$_SESSION['msg'] = 'Боты отключены';
header('Location: ?');
exit();
}
include './system/h.php';
?>
<div class="ribbon mb2"><div class="rl"><div class="rr">
	Включить ботов
	</div></div></div>
<?
?>

   <div>
    <div></div>
   </div>
  </div>
  <div class="bntf">
   <div class="nl">
    <div class="nr cntr lyell lh1 p5 sh">
<?  
    
echo "<p>Будут включены все игроки которые оффлайн станут онлайн</p>";
?>
  </div> 
   <div>
    <div></div>
   </div>
  </div> 
   <div>
    <div></div>
   </div>
  </div> 
<?
echo "<center><a href='?ok' class='mbtn mb2'> Включить ботов</a></center>";

include './system/f.php';
?>