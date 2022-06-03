<?php

include_once("./_common.php");

// echo "<pre>";
//     print_r($_SERVER);
// echo "</pre>";

$mb_id = $member['mb_id'];

if ($_SERVER['PHP_SELF'] == "/simulator.php") {
    $symbol = $_GET['symbol'] ?? "BTCUSDT";
    if (!isset($symbol)) exit;
    
    $coin = get_coin($symbol);
    if (!isset($coin)) exit;
    
    
} else {
    $symbol = "";
}

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
      <a class="navbar-brand" href="/">가상화폐 시뮬레이션</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <?php if (!$is_logined) { ?>
          <li class="nav-item active">
                <a class="nav-link" href="/login.php">로그인</a>
          </li>
          <?php } else {?>
            <li class="nav-item active">
                <a class="nav-link" href="/logout.php">로그아웃</a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link <?php echo $symbol == "BTCUSDT" ? "active" : "" ; ?>" href="/simulator.php?symbol=BTCUSDT">
              <span data-feather="home"></span>
              BTCUSDT - 비트코인<?php if ($symbol == "BTCUSDT") { ?><span class="sr-only">(current)<?php } ?></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $symbol == "ETHUSDT" ? "active" : "" ; ?>" href="/simulator.php?symbol=ETHUSDT">
              <span data-feather="file"></span>
              ETHUSDT - 이더리움<?php if ($symbol == "ETHUSDT") { ?><span class="sr-only">(current)<?php } ?></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $symbol == "LTCUSDT" ? "active" : "" ; ?>" href="/simulator.php?symbol=LTCUSDT">
              <span data-feather="file"></span>
              LTCUSDT - 라이트코인<?php if ($symbol == "LTCUSDT") { ?><span class="sr-only">(current)<?php } ?></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $symbol == "EOSUSDT" ? "active" : "" ; ?>" href="/simulator.php?symbol=EOSUSDT">
              <span data-feather="file"></span>
              EOSUSDT - 이오스<?php if ($symbol == "EOSUSDT") { ?><span class="sr-only">(current)<?php } ?></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $symbol == "XRPUSDT" ? "active" : "" ; ?>" href="/simulator.php?symbol=XRPUSDT">
              <span data-feather="file"></span>
              XRPUSDT - 리플<?php if ($symbol == "XRPUSDT") { ?><span class="sr-only">(current)<?php } ?></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $symbol == "DOGEUSDT" ? "active" : "" ; ?>" href="/simulator.php?symbol=DOGEUSDT">
              <span data-feather="shopping-cart"></span>
              DOGEUSDT - 도지코인<?php if ($symbol == "DOGEUSDT") { ?><span class="sr-only">(current)<?php } ?></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $symbol == "LUNAUSDT" ? "active" : "" ; ?>" href="/simulator.php?symbol=LUNAUSDT">
              <span data-feather="shopping-cart"></span>
              LUNAUSDT - 루나코인<?php if ($symbol == "LUNAUSDT") { ?><span class="sr-only">(current)<?php } ?></span>
            </a>
          </li>
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>기능</span>
          <a class="d-flex align-items-center text-muted" href="#">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link <?php echo $symbol == "" ? "active" : "" ; ?>" href="wallet.php">
              <span data-feather="file-text"></span>
              가상화폐 지갑
            </a>
          </li>
        </ul>
      </div>
    </nav>