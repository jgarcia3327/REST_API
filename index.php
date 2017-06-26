<?php require_once 'header.php'; ?>

<h3>Online School</h3>
<p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sign-up-teacher">Sign Up as TEACHER</button></p>
<?= modal("sign-up-teacher"); ?>

<p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sign-up-student">Sign Up as STUDENT</button></p>
<?= modal("sign-up-student"); ?>

<?php require_once 'footer.php'; ?>
