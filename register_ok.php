<?php
include_once("./_common.php");

$mb_id = trim($_POST['mb_id']) ?? "";
$mb_password = md5(trim($_POST['mb_password'])) ?? "";
$mb_password_repeat = md5(trim($_POST['mb_password_repeat'])) ?? "";

$getMember = get_member($mb_id);

if (isset($getMember)) {
    header("Location: /");
    exit;
}

if (!$mb_password || !$mb_password_repeat) {
    alert("비밀번호를 입력해야 합니다.");
    exit;
}

if ($mb_password != $mb_password_repeat) {
    alert("비밀번호와 비밀번호 확인이 서로 같지 않습니다.");
    exit;
}


$sql = " INSERT INTO `member` SET
`id` = NULL,
`mb_id` = '$mb_id',
`mb_password` = '$mb_password',
`mb_point` = '10000000' ";
sql_query($sql);

alert("회원가입이 완료 되었습니다.", "/");