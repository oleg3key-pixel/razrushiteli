<?php
error_reporting(E_ALL);
include './system/common.php';
include './system/functions.php';
include './system/user.php';

if(!$user) {
    header('location: /');
    exit;
}

global $mysqli;

if($user['lair_boi'] == '0'){
    header('location: /');
    exit;
}

$lair_mobs = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM `lair_mobs` WHERE `id`='{$user['lair']}'"));
$lair = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM `lair` WHERE `id`='{$lair_mobs['glava']}'"));
$lair_users = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM `lair_users` WHERE `user_id`='{$user['id']}'"));

$title = $lair['name'];
include './system/h.php';

// Если бой не начат
if($lair_users['start'] == '0'){
    if(isset($_GET['start'])) {
        mysqli_query($mysqli, "DELETE FROM `lair_logs` WHERE `user_id` = '{$user['id']}'");
        mysqli_query($mysqli, "UPDATE `lair_users` SET 
            `user_str`='{$user['str']}',
            `user_vit`='{$user['vit']}',
            `user_def`='{$user['def']}',
            `boss_id`='{$lair_mobs['id']}',
            `boss_str`='{$lair_mobs['str']}',
            `boss_vit`='{$lair_mobs['vit']}',
            `boss_def`='{$lair_mobs['def']}',
            `start`='1', `time`='0'
            WHERE `user_id`='{$user['id']}'");
        header('Location: /lair');
        exit;
    }
    ?>
    <div class="ribbon mb2"><div class="rl"><div class="rr"><?=$title?></div></div></div>
    <div class="bdr bg_blue">
        <div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4">
            <div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
                <div class="mt10 mb10 mr10 sh cntr">
                    <span class="lwhite tdn">Вы встретили <?=$lair_mobs['name2']?></span>
                </div>
                <div class="cntr">
                    <a href="/lair?start"><img class="icon" src="/view/image/lair/lair<?=$lair_mobs['img']?>_nowin.jpg"></a>
                </div>
                <div class="mt5 mb5 mr10 sh cntr small lorange">
                    <img class="icon" src="/view/image/icons/strength.png"> <?=$lair_mobs['str']?>
                    <img class="icon" src="/view/image/icons/health.png"> <?=$lair_mobs['vit']?>
                    <img class="icon" src="/view/image/icons/defense.png"> <?=$lair_mobs['def']?>
                </div>
            </div></div></div></div>
        </div></div></div></div>
    </div>
    <div class="cntr">
        <a href="/lair?start" class="ubtn inbl mt-15 red mb5">
            <span class="ul"><span class="ur">Начать бой</span></span>
        </a>
    </div>
    <?php
    include './system/f.php';
    exit;
}

// Обновлённые запросы для награды
if($lair_users['boss_vit'] <= 0) {
    $_gold = $lair_mobs['gold'];
    $_valor = $lair_mobs['valor'];
    $_exp = $lair_mobs['exp'];

    // Выдача награды
    mysqli_query($mysqli, "UPDATE `users` SET 
        `g` = `g` + '{$_gold}',
        `exp` = `exp` + '{$_exp}',
        `lair_boi` = `lair_boi` - 1,
        `lair` = LEAST(`lair` + 1, 81)
        WHERE `id`='{$user['id']}'");

    mysqli_query($mysqli, "UPDATE `lair_users` SET 
        `user_str`='0', `user_vit`='0', `user_def`='0', 
        `boss_id`='0', `boss_str`='0', `boss_vit`='0', 
        `boss_def`='0', `start`='0', `time`='0'
        WHERE `user_id`='{$user['id']}'");

    echo '
    <div class="bntf"><div class="nl"><div class="nr cntr lyell lh1 p5 sh">
        <span class="win"><b>Вы победили '.$lair_mobs['name2'].'!</b></span><br><br>
        <span class="win">Награда: </span>
        <img class="icon" src="/view/image/icons/gold.png"> '.$_gold.',
        <img class="icon" src="/view/image/icons/expirience.png"> '.$_exp.',
        <img class="icon" src="/view/image/icons/valor_exp.png"> '.$_valor.'<br>
        <a href="/" class="ubtn inbl green"><span class="ul"><span class="ur">Забрать награду</span></span></a>
    </div></div></div>';
    include './system/f.php';
    exit;
}

// Боевая система
if(isset($_GET['attack'])) {
    $my_attack = max(5, round(rand($lair_users['user_str'] * 2.4 * 0.38, $lair_users['user_str'] * 2.5 * 0.65) - ($lair_users['boss_def'] / 5 * 0.66)));
    $lair_attack = max(5, round(rand($lair_users['boss_str'] * 2.1 * 0.37, $lair_users['boss_str'] * 2.2 * 0.38) - ($lair_users['user_def'] / 5 * 0.66)));

    $hp_mob = round(100 / ($lair_mobs['vit'] / $lair_users['boss_vit']));
    if($hp_mob > 100) $hp_mob = 100;

    $hp_user = round(100 / ($user['vit'] / $lair_users['user_vit']));
    if($hp_user > 100) $hp_user = 100;

    $log = "Вы ударили {$lair_mobs['name']} на <span class='red'>{$my_attack}</span><br>{$lair_mobs['name']} ударил вас на <span class='red'>{$lair_attack}</span>";
    mysqli_query($mysqli, "INSERT INTO `lair_logs` (`user_id`, `text`, `time`) VALUES ('{$user['id']}', '{$log}', '".time()."')");
    mysqli_query($mysqli, "UPDATE `lair_users` SET 
        `user_vit` = `user_vit` - '{$lair_attack}', 
        `boss_vit` = `boss_vit` - '{$my_attack}', 
        `last_prg_red` = '{$hp_mob}', 
        `last_prg_red_us` = '{$hp_user}'
        WHERE `user_id` = '{$user['id']}'");
    header('Location: /lair');
    exit;
}

// Вывод состояния боя
$hp_mob = round(100 / ($lair_mobs['vit'] / $lair_users['boss_vit']));
if($hp_mob > 100) $hp_mob = 100;

$hp_user = round(100 / ($user['vit'] / $lair_users['user_vit']));
if($hp_user > 100) $hp_user = 100;

$logs = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM `lair_logs` WHERE `user_id` = '{$user['id']}' ORDER BY `id` DESC LIMIT 1"));
?>
<div class="bdr bg_red">
    <div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
        <div class="cntr"><b><?=$lair_mobs['name']?></b><br>
        <?=$logs['text']?><br>
        <a href="?attack=true" class="ubtn inbl mt-15 red mb2"><span class="ul"><span class="ur">Атаковать</span></span></a></div>
    </div></div></div></div></div></div></div></div>
</div>
<?php
include './system/f.php';
?>
