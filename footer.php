<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<footer>
  <p>All list:</p>
  <?= callREST("GET", $SITE_URL.'REST/request/list/'); ?>
  <br/>
  <p>No.3 list:</p>
  <?= callREST("GET", $SITE_URL.'REST/request/list/3/'); ?>
</footer>
</body>
<script type="text/javascript" src="<?= $ASSET_URL ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?= $ASSET_URL ?>js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?= $ASSET_URL ?>js/tether.min.js"></script>
<script type="text/javascript" src="<?= $ASSET_URL ?>js/bootstrap.min.js"></script>
</script>
</html>
