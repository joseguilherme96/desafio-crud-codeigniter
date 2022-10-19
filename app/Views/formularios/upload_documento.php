<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload Form</title>
</head>
<body>
<form action="/UploadDoc/post" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <?=csrf_field()?>
    <label for="file">Documento pdf</label>
    <input type="file" name="file"/>
    <input type="submit" name="btnUploadDocumento" value="Upload Documento">
</form>
</body>
</html>