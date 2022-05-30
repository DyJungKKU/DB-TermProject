<?php
include_once("./_common.php");
$pageTitle = "가상화폐 거래 시뮬레이션";
include_once("./_head.php");

if (!$is_logined) { // 로그인
    header("Location: /login.php");
}

$symbol = $_GET['symbol'] ?? "BTCUSDT";
if (!isset($symbol)) exit;

$coin = get_coin($symbol);
if (!isset($coin)) exit;

?>
<link href="./css/simulator.css" rel="stylesheet">
<style>
  input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>

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
            <a class="nav-link <?php echo $symbol == "DOGEUSDT" ? "active" : "" ; ?>" href="/simulator.php?symbol=DOGEUSDT">
              <span data-feather="shopping-cart"></span>
              DOGEUSDT - 도지코인<?php if ($symbol == "DOGEUSDT") { ?><span class="sr-only">(current)<?php } ?></span>
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
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              가상화폐 지갑
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php echo $symbol; ?> - <?php echo $coin['bidPrice']; ?><b style="font-size: 18px;">USDT</b> <b style="font-size: 18px; color: <?php echo (double)$coin['priceChange'] > 0 ? "#01A66D" : "#CF304A" ?>">(<?php echo (double)$coin['priceChange'] > 0 ? "+" : "" ?><?php echo $coin['priceChange']; ?>)</b></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
          <div class="input-group">
            <input type="number" class="form-control">
            <div class="input-group-append">
              <span class="input-group-text">₩</span>
            </div>  
          </div>
          &nbsp;
            <button class="btn btn-sm btn-outline-secondary">매수</button>
            <button class="btn btn-sm btn-outline-secondary">매도</button>
          </div>
        </div>
      </div>
      <canvas class="my-4" id="myChart" width="900" height="380"></canvas>
      <h2>매수 / 매도 내역</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Header</th>
              <th>Header</th>
              <th>Header</th>
              <th>Header</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1,001</td>
              <td>Lorem</td>
              <td>ipsum</td>
              <td>dolor</td>
              <td>sit</td>
            </tr>
            <tr>
              <td>1,002</td>
              <td>amet</td>
              <td>consectetur</td>
              <td>adipiscing</td>
              <td>elit</td>
            </tr>
            <tr>
              <td>1,003</td>
              <td>Integer</td>
              <td>nec</td>
              <td>odio</td>
              <td>Praesent</td>
            </tr>
            <tr>
              <td>1,003</td>
              <td>libero</td>
              <td>Sed</td>
              <td>cursus</td>
              <td>ante</td>
            </tr>
            <tr>
              <td>1,004</td>
              <td>dapibus</td>
              <td>diam</td>
              <td>Sed</td>
              <td>nisi</td>
            </tr>
            <tr>
              <td>1,005</td>
              <td>Nulla</td>
              <td>quis</td>
              <td>sem</td>
              <td>at</td>
            </tr>
            <tr>
              <td>1,006</td>
              <td>nibh</td>
              <td>elementum</td>
              <td>imperdiet</td>
              <td>Duis</td>
            </tr>
            <tr>
              <td>1,007</td>
              <td>sagittis</td>
              <td>ipsum</td>
              <td>Praesent</td>
              <td>mauris</td>
            </tr>
            <tr>
              <td>1,008</td>
              <td>Fusce</td>
              <td>nec</td>
              <td>tellus</td>
              <td>sed</td>
            </tr>
            <tr>
              <td>1,009</td>
              <td>augue</td>
              <td>semper</td>
              <td>porta</td>
              <td>Mauris</td>
            </tr>
            <tr>
              <td>1,010</td>
              <td>massa</td>
              <td>Vestibulum</td>
              <td>lacinia</td>
              <td>arcu</td>
            </tr>
            <tr>
              <td>1,011</td>
              <td>eget</td>
              <td>nulla</td>
              <td>Class</td>
              <td>aptent</td>
            </tr>
            <tr>
              <td>1,012</td>
              <td>taciti</td>
              <td>sociosqu</td>
              <td>ad</td>
              <td>litora</td>
            </tr>
            <tr>
              <td>1,013</td>
              <td>torquent</td>
              <td>per</td>
              <td>conubia</td>
              <td>nostra</td>
            </tr>
            <tr>
              <td>1,014</td>
              <td>per</td>
              <td>inceptos</td>
              <td>himenaeos</td>
              <td>Curabitur</td>
            </tr>
            <tr>
              <td>1,015</td>
              <td>sodales</td>
              <td>ligula</td>
              <td>in</td>
              <td>libero</td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

<hr>
<?php
include_once("./_tail.php");
?>