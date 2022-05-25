<?php
include_once("./_common.php");
$mb_id = trim($_POST['mb_id']) ?? "";
$mb_password = md5(trim($_POST['mb_password'])) ?? "";

$mb = get_member($mb_id);

if (!isset($mb['id'])) {
    alert("회원 정보가 올바르지 않습니다.");
    exit;
}

if ($mb['mb_password'] != $mb_password) {
    alert("회원 정보가 올바르지 않습니다.");
    exit;
}

$_SESSION['mb_id'] = $mb_id; // $mb_id로 세션 생성 -> 로그인

header("Location: /");
exit;