<?php // 공통 파일
$pageTitle = "메인 페이지";
if(!session_id()) { // id가 없을 경우 세션 시작 
    session_start(); 
}
include_once("./dbconfig.php"); // DB 정보
$conn = mysqli_connect("localhost", $DB_User, $DB_Password, $DB_Name);

// 사용 함수 정의 

if (isset($_SESSION['mb_id'])) {
    $member = get_member($_SESSION['mb_id']);
    $is_logined = true;
} else {
    $is_logined = false;
}

function sql_query($sql) {
    global $conn;
    return mysqli_query($conn, trim($sql));
} 

function sql_fetch_array($result) {
    return mysqli_fetch_array($result);
}

function insert_point($mb_id, $point) { // 사용자 포인트 지급 함수
    if (!is_int($point)) return; // 포인트가 정수가 아닐 경우 리턴
    $mb = get_member($mb_id);
    if (!$mb['mb_id']) return; // 사용자가 없을 경우 리턴
    $newPoint = $mb['mb_point'] + $point;
    $sql = " UPDATE `member` SET `mb_point` = '$newPoint' WHERE mb_id = '$mb_id' ";
    sql_query($sql);
}

function get_member($mb_id) { // 사용자 SELECT 함수
    $sql = " SELECT * FROM member WHERE mb_id = '$mb_id' ";
    $rs = sql_query($sql);
    $result = sql_fetch_array($rs);
    return $result;
}

function get_coin($symbol) {
    $url = "https://api.binance.com/api/v3/ticker/24hr?symbol=" . $symbol;
    $json_string = file_get_contents_curl($url);
    $data = array();
    $data = json_decode($json_string, true);

    return $data;
}

function get_coin_ticker($symbol) {
    $url = "https://api.binance.com/api/v3/ticker/24hr?symbol=" . $symbol;
    $json_string = file_get_contents_curl($url);
    $data = array();
    $data = json_decode($json_string, true);

    return $data;
}

function file_get_contents_curl($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // 요청결과를 문자열로 반환
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}