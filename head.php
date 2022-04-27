<?php

include_once("./_common.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $pageTitle; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/jumbotron.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="/">My Project</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">메인 <span class="sr-only">(current)</span></a>
          </li>
          <?php if (!$is_logined) { ?>
          <li class="nav-item active">
                <a class="nav-link" href="/login.php">로그인</a>
          </li>
          <?php } else {?>
            <li class="nav-item active">
                <a class="nav-link" href="/simulator.php">가상화폐 시뮬레이션</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/logout.php">로그아웃</a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </nav>