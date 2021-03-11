<?php
include_once("../Assets/Function.php");
$FooterText = http_request("http://localhost:8080/simple_soap/webresources/com.mywebsite.database.produk/Footer");
?>
<footer>
<div class="row">
<div class="col col-md-8">
<?= $FooterText ?>
</div>
</div>
</footer>
