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
  <form id="add-book" action="" method="post">
    <input type="text" name="title" value=""><br/>
    <textarea name="description" rows="8" cols="80"></textarea><br/>
    <input type="submit" value="Submit">
  </form>
  <p>All list:</p>
  <?= callREST("GET", $SITE_URL.'REST/query/books/title,description/1/'); ?>
  <br/>
</footer>
</body>
<script type="text/javascript" src="<?= $ASSET_URL ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?= $ASSET_URL ?>js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?= $ASSET_URL ?>js/tether.min.js"></script>
<script type="text/javascript" src="<?= $ASSET_URL ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= $ASSET_URL ?>js/main.js"></script>
</script>
</html>
