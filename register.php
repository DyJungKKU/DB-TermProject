<?php
include_once("./_common.php");
?>

<?php
include_once("./_common.php");

if (isset($_SESSION['mb_id'])) {
    header("Location: /");
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" method="POST" action="register_ok.php">
      <h1 class="h3 mb-3 font-weight-normal">회원가입</h1>

      <label for="mb_id" class="sr-only">아이디</label>
      <input type="text" id="mb_id" name="mb_id" class="form-control" style="margin-bottom: 10px;" placeholder="아이디" required autofocus>

      <label for="mb_password" class="sr-only">비밀번호</label>
      <input type="password" id="mb_password" name="mb_password" class="form-control" placeholder="비밀번호" required>

      <label for="mb_password_repeat" class="sr-only">비밀번호 확인</label>
      <input type="password" id="mb_password_repeat" name="mb_password_repeat" class="form-control" placeholder="비밀번호 확인" required>

      <button class="btn btn-lg btn-primary btn-block" type="submit">회원가입</button>
      <button class="btn btn-lg btn-primary btn-block" type="button" onclick="location.href='/'">로그인</button>
      <p class="mt-5 mb-3 text-muted">&copy; Jung.</p>
    </form>
  </body>
</html>