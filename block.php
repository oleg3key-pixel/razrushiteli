<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';

if(!$user OR !$block) {
header('location: /'); 
exit;
}

$title = 'Ваш аккаунт заблокирован!';    
include './system/h.php';

echo'<div class="title">'.$title.'</div>';

echo'<div class="empty_block item_center">
До окончания блокировки: '._time($block['time'] - time()).'<br/>
Причина блокировки: '.($block['text']).'<br/>
Заблокировал: '.nick($block['who']).'
</div>
<div class="line"></div>';


include './system/f.php';
  
?>