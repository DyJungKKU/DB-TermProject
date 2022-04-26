<?php
include_once("./_common.php");

$sql = " SELECT * FROM test WHERE 1 ";
$rs = sql_query($sql);
$result = sql_fetch_array($rs);

echo $result['id'] . $result['text'];