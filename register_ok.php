<?php
include_once("./_common.php");

$mb_id = trim($_POST['mb_id']) ?? "";
$mb_password = md5(trim($_POST['mb_password'])) ?? "";

$getMember = get_member($mb_id);

if (isset($getMember)) {
    header("Location: /");
    exit;
}

$sql = " INSERT INTO `member` SET
`id` = NULL,
`mb_id` = '$mb_id',
`mb_password` = '$mb_password',
`mb_point` = '0' ";
sql_query($sql);

alert("회원가입이 완료 되었습니다.", "/");