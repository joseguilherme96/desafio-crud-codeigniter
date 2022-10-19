<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload Form</title>
</head>
<body>

<?php foreach ($errors as $error): ?>
    <li><?= esc($error) ?></li>
<?php endforeach ?>

<?= form_open_multipart('upload/upload') ?>
<?=csrf_field()?><!--Formulario não funciona sem esta linha -->
<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

<?=form_close(); ?>

</body>
</html>