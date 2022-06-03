<?php
include_once("./_common.php");
$symbol = trim($_GET['symbol']) ?? "";
$now = date("Y-m-d H:i:s");
$amount = ($_GET['amount']) ?? "";
$mb_id = $member['mb_id'];

if (!$amount || !$symbol) {
    alert("알 수 없는 요청입니다.", "/");
}

if (!$member['mb_id']) {
    alert("로그인이 필요한 서비스 입니다.");
}

$symbol = strtolower($symbol);
$symbolBig = strtoupper($symbol);

$sql = " SELECT * FROM wallet WHERE symbol = '$symbolBig' AND mb_id = '$mb_id' ";
$rs = sql_query($sql);
$result = sql_fetch_array($rs);

if (!isset($result['id'])) {
    alert("{$symbolBig}에 해당하는 포지션이 없습니다.");
}

$myAmount = $result['amount'];
$myBuyPrice = $result['buy_price'] * $myAmount;
$bp = $result['buy_price'];

$unit = str_replace("USDT", "", $symbolBig);

if ($amount > $myAmount) {
    alert("{$myAmount}{$unit} 이상 거래 불가능 합니다.");
}

$getCoin = get_coin($symbolBig);

if (!$getCoin['lastPrice']) {
    alert("알 수 없는 요청입니다.");
    exit;
}

$nowPrice = $getCoin['lastPrice'];

$nowSellPrice = round($nowPrice * $exchange_rate * $myAmount, 2);
$displayPrice = round($nowPrice * $exchange_rate, 2);

$amountNowSellPrice = round($nowPrice * $exchange_rate * $amount, 2);
$amountPastSellPrice = round($result['buy_price'] * $amount, 2);
$amountSonik = round(($amountNowSellPrice - $amountPastSellPrice), 2);

$nowD = date("Y-m-d H:i:s");
$newAmount = ($myAmount - $amount);

$sonik = ($nowSellPrice - $myBuyPrice);

$sellPoint = $amountPastSellPrice + $amountSonik;

if ($newAmount <= 0) { // 다 팔았을 경우
    $sql = " DELETE FROM wallet WHERE symbol = '$symbolBig' AND mb_id = '$mb_id' ";
    sql_query($sql);
} else {
    $sql = " UPDATE `wallet` SET `amount` = '$newAmount' WHERE symbol = '$symbolBig' AND mb_id = '$mb_id' ";
    sql_query($sql);
}

$sql = " INSERT INTO `history` SET
`id` = NULL,
`mb_id` = '$mb_id',
`symbol` = '$symbolBig',
`type` = '매도',
`amount` = '$amount',
`buy_price` = '$bp',
`sell_price` = '$displayPrice',
`buy_point` = '$amountPastSellPrice',
`sell_point` = '$sellPoint',
`datetime` = '$nowD' ";
sql_query($sql);

insert_point($mb_id, $sellPoint);

alert("{$symbolBig} {$amount}{$unit} 매도 완료 - {$sellPoint} KRW", "/wallet.php");