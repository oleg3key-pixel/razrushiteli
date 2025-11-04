<?php
include 'system/common.php';
// Добовляем раз в 2 часа
$aluko = mysql_fetch_assoc(mysql_query("SELECT * FROM `aluko` ORDER BY `id` LIMIT 1"));	
if($aluko['health']==0){	
mysql_query("UPDATE `aluko` SET `health`=`max_health`");	
}
?>