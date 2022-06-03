<?php
include_once("./_common.php");

$pr_amount = ($_GET['price']) ?? "";
$symbol = $_GET['symbol'] ?? "";

if (!$pr_amount || !$symbol) {
    alert("알 수 없는 요청입니다.");
}

if (!$member['mb_id']) {
    alert("로그인이 필요한 서비스 입니다.");
}

$symbol = strtolower($symbol);
$symbolBig = strtoupper($symbol);

$mb_id = $member['mb_id'];
$now = date("Y-m-d H:i:s");

$getCoin = get_coin($symbolBig);

// print_r($getCoin);

if (!$getCoin['lastPrice']) {
    alert("알 수 없는 오류가 발생하였습니다.\n다시 시도해주세요.");
    exit;
}

$now_price = round($getCoin['lastPrice'] * $exchange_rate, 2);

$amount = round($pr_amount / $now_price, 8);
$buy_price = round($now_price * $amount, 2);

if ((int)$now_price == 0) {
    alert("알 수 없는 오류가 발생하였습니다.");
    exit;
}

if ($member['mb_point'] < $buy_price) {
    alert("보유 잔고가 부족합니다.");
    exit;
}

insert_point($mb_id, -$buy_price); // 매수 가격만큼 차감

$sql = " SELECT * FROM wallet WHERE mb_id = '$mb_id' AND symbol = '$symbolBig' ";
$rs = sql_query($sql);
$checkBalance = sql_fetch_array($rs);

if (isset($checkBalance['id'])) { // 이미 해당 종목의 구입 항목이 있을 경우.
    $beforePrice = $checkBalance['buy_price'];
    $beforeQuantity = $checkBalance['amount'];
    $newAmount = $checkBalance['amount'] + $amount; // 업데이트 수량 계산
    $newPrice = round((($beforePrice * $beforeQuantity) + ($now_price * $amount)) / $newAmount, 2); // 가격 업데이트 계산
    $sql = " UPDATE `wallet` SET
    `amount` = '$newAmount',
    `buy_price` = '$newPrice'
    WHERE mb_id = '$mb_id' AND symbol = '$symbolBig' ";
    sql_query($sql);
} else { // 해당 항목 구입이 처음 인경우
    $sql = " INSERT INTO `wallet` SET
    `id` = NULL,
    `mb_id` = '$mb_id',
    `symbol` = '$symbolBig',
    `amount` = '$amount',
    `buy_price` = '$now_price',
    `datetime` = '$now' ";
    sql_query($sql);
}


// 로그 작성

$sql = " INSERT INTO `history` SET
`id` = NULL,
`mb_id` = '$mb_id',
`symbol` = '$symbolBig',
`type` = '매수',
`amount` = '$amount',
`buy_price` = '$now_price',
`sell_price` = '0',
`buy_point` = '$pr_amount',
`sell_point` = '0',
`datetime` = '$now' ";
sql_query($sql);

alert("거래가 완료되었습니다.", "simulator.php?symbol=".$symbolBig);