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

    <title>로그인</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" method="POST" action="login_check.php">
      <h1 class="h3 mb-3 font-weight-normal">로그인</h1>
      <label for="inputEmail" class="sr-only">ID</label>
      <input type="text" id="inputEmail" name="mb_id" class="form-control" placeholder="ID" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="mb_password" class="form-control" placeholder="Password" required>

      <button class="btn btn-lg btn-primary btn-block" type="submit">로그인</button>
      <button class="btn btn-lg btn-primary btn-block" type="button" onclick="location.href='/register.php'">회원가입</button>
      <p class="mt-5 mb-3 text-muted">&copy; Jung.</p>
    </form>
  </body>
</html>

