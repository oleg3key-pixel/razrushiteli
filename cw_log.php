<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';
include './system/h.php';
$q = mysql_query('SELECT * FROM `cw_logs` ORDER BY `id` DESC LIMIT 1');
while($row = mysql_fetch_array($q)) {
if($row['to'] == $user['id'] && $row['read'] == 0) {
mysql_query('UPDATE `cw_logs` SET `read` = 1 WHERE `id` = "'.$row['id'].'"');
}
echo ''.$row['text'].'';//Сообщение
}
include './system/f.php';
?>