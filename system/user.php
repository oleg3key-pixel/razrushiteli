<?php
// Подключаем поддержку старых mysql_* функций и базу
require_once __DIR__ . '/mysql_compat.php';
require_once __DIR__ . '/db.php';

global $mysqli;

$id = isset($_COOKIE['id']) ? (int)$_COOKIE['id'] : 0;
$password = isset($_COOKIE['password']) ? $_COOKIE['password'] : '';

$user = null;

if ($id > 0 && $password != '') {
    $stmt = $mysqli->prepare("SELECT * FROM `users` WHERE `id` = ? AND `password` = ?");
    $stmt->bind_param("is", $id, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        setcookie('id', '', time() - 3600, '/');
        setcookie('password', '', time() - 3600, '/');
    }
    $stmt->close();
}

if ($user) {
    $stmt = $mysqli->prepare("
        UPDATE `users`
        SET `online` = ?, `ip` = ?, `ua` = ?, `self` = ?
        WHERE `id` = ?
    ");
    $time = time();
    $ip = $_SERVER['REMOTE_ADDR'];
    $ua = $_SERVER['HTTP_USER_AGENT'];
    $self = $_SERVER['PHP_SELF'];
    $stmt->bind_param("isssi", $time, $ip, $ua, $self, $user['id']);
    $stmt->execute();
    $stmt->close();

    // ---- bonus_valor ----
    function bonus_valor($i)
    {
        $map = array(
            0=>5,1=>5,2=>5,3=>10,4=>15,5=>20,6=>25,7=>30,8=>35,9=>40,10=>45,
            11=>50,12=>55,13=>60,14=>65,15=>70,16=>75,17=>80,18=>85,19=>90,
            20=>95,21=>100,22=>105,23=>110,24=>115,25=>120,26=>125,27=>130,
            28=>135,29=>140,30=>145,31=>150,32=>155,33=>160,34=>165,35=>170,
            36=>175,37=>180,38=>185,39=>190,40=>195,41=>200,42=>205,43=>210,
            44=>215,45=>220,46=>225,47=>230,48=>235,49=>240,50=>245,51=>250,
            52=>255,53=>260,54=>265,55=>270,56=>275,57=>280,58=>285,59=>290,
            60=>295,61=>300,62=>305,63=>310,64=>315,65=>320,66=>325,67=>330,
            68=>335,69=>340,70=>345,71=>350,72=>355,73=>360,74=>365,75=>370,
            76=>375,77=>380,78=>385,79=>390,80=>395,81=>400,82=>405,83=>410,
            84=>415,85=>420,86=>425,87=>430,88=>435,89=>440,90=>445,91=>450,
            92=>455,93=>460,94=>465,95=>470,96=>475,97=>480,98=>485,99=>490,
            100=>495
        );
        return isset($map[$i]) ? $map[$i] : 0;
    }

    $bonus_valor = bonus_valor($user['valor']);
    if ($user['valor'] > 0 && $bonus_valor) {
        $user['valor_b_exp'] = $bonus_valor;
    }

    $bonus_valor = bonus_valor($user['valor_b_silver']);
    if ($user['valor_b_silver'] > 0 && $bonus_valor) {
        $user['valor_b_silver'] = $bonus_valor;
    }

    // ---- Кланы ----
    $q = $mysqli->query("SELECT * FROM `clan_memb` WHERE `user` = '{$user['id']}'");
    $clan_memb = $q ? $q->fetch_assoc() : null;

    if ($clan_memb) {
        $res = $mysqli->query("SELECT * FROM `clans` WHERE `id` = '{$clan_memb['clan']}'");
        $clan = $res ? $res->fetch_assoc() : null;

        if ($clan_memb['last_update'] <= time()) {
            $mysqli->query("UPDATE `clan_memb` SET `last_update` = '".($clan_memb['last_update'] + 86400)."', `v` = `v` + 3 WHERE `id` = '{$clan_memb['id']}'");
        }

        function clan_bufff($i)
        {
            $map = array(
                0=>3,1=>3,2=>8,3=>12,4=>17,5=>21,6=>26,7=>32,8=>39,9=>44,
                10=>52,11=>60,12=>66,13=>75,14=>84,15=>91,16=>99,17=>106,
                18=>118,19=>125,20=>150
            );
            return isset($map[$i]) ? $map[$i] : 0;
        }

        for ($i = 1; $i <= 8; $i++) {
            $key = 'built_' . $i;
            $built = isset($clan[$key]) ? $clan[$key] : 0;
            $buff = clan_bufff($built);
            if ($built > 0 && $buff) {
                $user_key = '';
                if ($i == 1) $user_key = 'b_exp_1';
                if ($i == 2) $user_key = 'b_exp_2';
                if ($i == 3) $user_key = 'b_silver_1';
                if ($i == 4) $user_key = 'b_silver_2';
                if ($i == 5) $user_key = 'b_valor_1';
                if ($i == 6) $user_key = 'b_valor_2';
                if ($i == 7) $user_key = 'b_plat_1';
                if ($i == 8) $user_key = 'b_plat_2';
                if ($user_key != '') $user[$user_key] += $buff;
            }
        }
    }

    // ---- Проверка банов ----
    $res = $mysqli->query("SELECT * FROM `ban` WHERE `user` = '{$user['id']}'");
    $ban = $res ? $res->fetch_assoc() : null;
    if ($ban && $ban['time'] <= time()) {
        $mysqli->query("DELETE FROM `ban` WHERE `user` = '{$user['id']}'");
    }

    // ---- Проверка блоков ----
    $res = $mysqli->query("SELECT * FROM `block` WHERE `user` = '{$user['id']}'");
    $block = $res ? $res->fetch_assoc() : null;
    if ($block) {
        if ($block['time'] <= time()) {
            $mysqli->query("DELETE FROM `block` WHERE `user` = '{$user['id']}'");
        } elseif ($block['time'] > time() && $_SERVER['PHP_SELF'] != '/block.php') {
            header('Location: /block.php');
            exit;
        }
    }
}
?>
