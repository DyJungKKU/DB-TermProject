<?php
include_once("./_common.php");
$mb_id = trim($_POST['mb_id']) ?? "";
$mb_password = trim($_POST['mb_password']) ?? "";

$mb = get_member($mb_id);

if (!isset($mb['id'])) {
    echo "NO ID";
    exit;
}

if ($mb['mb_password'] != $mb_password) {
    echo "Incorrect Password";
    exit;
}

$_SESSION['mb_id'] = $mb_id; // $mb_id로 세션 생성 -> 로그인

echo "Login Success";