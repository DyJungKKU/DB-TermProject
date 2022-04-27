<?php
include_once("./_common.php");

if (ini_get("session.use_cookies")) { 
    $params = session_get_cookie_params(); 
    setcookie( session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]); 
} // 세션 파일 삭제 session_destroy();

session_destroy();

header("Location: /");
exit;