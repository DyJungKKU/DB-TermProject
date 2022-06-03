<?php
include_once("./_common.php");
$pageTitle = "가상화폐 거래 시뮬레이션";
include_once("./_head.php");

if (!$is_logined) { // 로그인 확인
    alert("로그인 후 이용 가능합니다.", "/login.php");
}

?>
<link href="./css/simulator.css" rel="stylesheet">
<style>
  input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php echo $symbol; ?> - <?php echo $coin['bidPrice']; ?><b style="font-size: 18px;">USDT</b> <b style="font-size: 18px; color: <?php echo (double)$coin['priceChange'] > 0 ? "#01A66D" : "#CF304A" ?>">(<?php echo (double)$coin['priceChange'] > 0 ? "+" : "" ?><?php echo $coin['priceChange']; ?> <?php echo (double)$coin['priceChange'] > 0 ? "+" : "" ?><?php echo $coin['priceChangePercent']; ?>%)</b></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
          <div class="input-group">
            <input type="number" class="form-control" name="price" autocomplete="off" id="tradeKRWValue" placeholder="<?php echo number_format($member['mb_point']); ?>">
            <div class="input-group-append">
              <span class="input-group-text">₩</span>
            </div>  
          </div>
          &nbsp;
            <button class="btn btn-sm btn-outline-secondary" id="buyButton">매수</button>
          </div>
        </div>
      </div>
      <!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container" style="height: 400px;">
  <div id="tradingview_bdda3"></div>
  <div class="tradingview-widget-copyright">TradingView 제공 <a href="https://kr.tradingview.com/symbols/<?php echo $symbol; ?>/?exchange=BINANCE" rel="noopener" target="_blank"><span class="blue-text"><?php echo $symbol; ?> 차트</span></a></div>
  <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
  <script type="text/javascript">
  new TradingView.widget(
  {
  "width": "100%",
  "height": 400,
  "symbol": "BINANCE:<?php echo $symbol; ?>",
  "interval": "D",
  "timezone": "Etc/UTC",
  "theme": "light",
  "style": "1",
  "locale": "kr",
  "toolbar_bg": "#f1f3f6",
  "enable_publishing": false,
  "allow_symbol_change": true,
  "container_id": "tradingview_bdda3"
}
  );
  </script>
</div>
<!-- TradingView Widget END -->
      <h2>매수 / 매도 내역</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>종목</th>
              <th>종류</th>
              <th>평균 매수 단가</th>
              <th>거래가</th>
              <th>거래 수량</th>
              <th>날짜</th>
            </tr>
          </thead>
          <tbody>
              <?php
              $cnt = 0;
              $sql = " SELECT * FROM history WHERE mb_id = '$mb_id' ORDER BY id DESC ";
              $rs = sql_query($sql);
              while($result = sql_fetch_array($rs)) { 
                  $coinUnit = str_replace("USDT", "", $result['symbol']);
                  if ($result['type'] == "매도") {
                      $realizedSonik = $result['sell_point'] - $result['buy_point'];
                  }
                  $cnt++;
                  ?>
            <tr>
              <td><?php echo $result['id']; ?></td>
              <td><a href="/simulator.php?symbol=<?php echo $result['symbol']; ?>"><?php echo $result['symbol']; ?></a></td>
              <td><?php echo $result['type']; ?></td>
              <td><?php echo number_format($result['buy_price']); ?> KRW</td>
              <td><?php echo $result['type'] == "매수" ? number_format($result['buy_point']) : number_format($result['sell_point']); ?> KRW <b style="color: <?php echo $realizedSonik >= 0 ? $color_green : $color_red; ?>"><?php echo $result['type'] == "매도" ? "(".number_format($realizedSonik)." KRW)" : ""; ?></b></td>
              <td><?php echo $result['amount']; ?> <?php echo $coinUnit; ?></td>
              <td><?php echo $result['datetime']; ?></td>
            </tr>
            <?php }  if ($cnt == 0) { ?>
                <td colspan="7" style="text-align: center;">데이터가 없습니다.</td>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </main>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script>
    $("#tradeKRWValue").on("change keyup paste", function() {
        $("#buyButton").attr("onclick", "location.href='buy.php?price=" + $("#tradeKRWValue").val() + "&symbol=<?php echo $symbol; ?>'");
    });
</script>

<?php
include_once("./_tail.php");
?>