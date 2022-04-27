<?php
include_once("./_common.php");

if (isset($_SESSION['mb_id'])) {
    header("Location: http://localhost/");
}
?>

<form action="login_check.php" method="POST">
    <input type="text" name="mb_id" id="mb_id"><br>
    <input type="password" name="mb_password" id="mb_password">
    <button type="submit">로그인</button>
</form>
