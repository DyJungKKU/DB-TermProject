<?php
include_once("./_common.php");
$msg = $_GET['msg'] ?? "";
$url = $_GET['url'] ?? "";

if (!$url) { ?>
<script>
    alert("<?php echo $msg; ?>");
    window.history.back();
</script>
<?php } else { ?>
<script>
    alert("<?php echo $msg; ?>");
    location.href = '<?php echo $url; ?>';
</script>
<?php } ?>