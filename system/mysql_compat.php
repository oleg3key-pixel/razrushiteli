<?php
// Эмуляция старых mysql_* функций через mysqli
if (!function_exists('mysql_query')) {

    function mysql_query($query) {
        global $mysqli;
        return $mysqli ? $mysqli->query($query) : false;
    }

    function mysql_fetch_array($result) {
        return ($result && $result instanceof mysqli_result)
            ? $result->fetch_array(MYSQLI_ASSOC)
            : null;
    }

    function mysql_fetch_assoc($result) {
        return ($result && $result instanceof mysqli_result)
            ? $result->fetch_assoc()
            : null;
    }

    function mysql_num_rows($result) {
        return ($result && $result instanceof mysqli_result)
            ? $result->num_rows
            : 0;
    }

    function mysql_result($result, $row = 0, $col = 0) {
        if ($result && $result instanceof mysqli_result && $result->num_rows > $row) {
            $result->data_seek($row);
            $data = $result->fetch_array();
            return isset($data[$col]) ? $data[$col] : null;
        }
        return null;
    }

    function mysql_insert_id() {
        global $mysqli;
        return $mysqli ? $mysqli->insert_id : 0;
    }

    function mysql_real_escape_string($str) {
        global $mysqli;
        return $mysqli ? $mysqli->real_escape_string($str) : addslashes($str);
    }

    function mysql_error() {
        global $mysqli;
        return $mysqli ? $mysqli->error : 'MySQL connection not initialized';
    }

    // Для старых вызовов подключения
    function mysql_connect($host, $user, $pass) {
        global $mysqli;
        $mysqli = new mysqli($host, $user, $pass);
        if ($mysqli->connect_errno) {
            die('Ошибка подключения: '.$mysqli->connect_error);
        }
        return $mysqli;
    }

    function mysql_select_db($dbname) {
        global $mysqli;
        return $mysqli ? $mysqli->select_db($dbname) : false;
    }

    function mysql_close() {
        global $mysqli;
        return $mysqli ? $mysqli->close() : false;
    }
}
?>
