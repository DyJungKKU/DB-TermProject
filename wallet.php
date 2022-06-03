<?php
include_once("./_common.php");
$pageTitle = "가상화폐 거래 시뮬레이션";
include_once("./_head.php");

if (!$is_logined) { // 로그인 확인
    alert("로그인 후 이용 가능합니다.", "/login.php");
}

$mb_id = $member['mb_id'];

$total_sell = 0;

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
        <h1 class="h2">지갑 - 잔액 : <?php echo number_format($member['mb_point']); ?> KRW</b></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <?php foreach ($symbols as $symbol) { ?>
                <button class="btn btn-sm btn-outline-secondary" id="chart-<?php echo $symbol; ?>" onclick="location.href='/simulator.php?symbol=<?php echo $symbol; ?>'"><?php echo $symbol; ?></button>
            <?php } ?>
          </div>
        </div>
      </div>
      <h2>암호화폐 보유 리스트</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>종목</th>
              <th>현재가</th>
              <th>평균 매수 단가</th>
              <th>보유량</th>
              <th>판매가</th>
              <th>실현 손익</th>
            </tr>
          </thead>
          <tbody>
              <?php
              $sql = " SELECT * FROM wallet WHERE mb_id = '$mb_id' ORDER BY id DESC ";
              $rs = sql_query($sql);
              while($result = sql_fetch_array($rs)) { 
                  $coinUnit = str_replace("USDT", "", $result['symbol']);
                  $getCoin = get_coin($result['symbol']);
                  $nowPrice = floor($getCoin['lastPrice'] * $exchange_rate);
                  $sonik = round(100 - ($result['buy_price'] / $nowPrice * 100), 2);
                  $realizeSonik = ($nowPrice * $result['amount']) - ($result['buy_price'] * $result['amount']);
                  ?>
            <tr>
              <td><?php echo $result['id']; ?></td>
              <td><a href="/simulator.php?symbol=<?php echo $result['symbol']; ?>"><?php echo $result['symbol']; ?></a></td>
              <td><?php echo number_format($nowPrice); ?> KRW</td>
              <td><?php echo number_format($result['buy_price']); ?> KRW <b style="color: <?php echo $sonik >= 0 ? $color_green : $color_red; ?>">(<?php echo ($sonik); ?> %)</b></td>
              <td><?php echo $result['amount']; ?> <?php echo $coinUnit; ?></td>
              <td><?php echo number_format($nowPrice * $result['amount']) ?> KRW</td>
              <td style="color: <?php echo $sonik >= 0 ? $color_green : $color_red; ?>"><?php echo number_format($realizeSonik); ?> KRW</td>
            </tr>
            <?php 
        $total_sell += $nowPrice * $result['amount'];
        } 
        $total_sonik = ($total_sell + $member['mb_point']) - 10_000_000;
        
        ?>
          </tbody>
        </table>
        <h2>총 자산 : <?php echo number_format($total_sell + $member['mb_point']); ?> KRW</h2>
        <h2>총 손익 : <b style="color: <?php echo $total_sonik >= 0 ? $color_green : $color_red; ?>"><?php echo number_format($total_sonik); ?> KRW</b></h2>
      </div>
    </main>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<?php
include_once("./_tail.php");
?>