# PHP File Upload
 Upload files easily with using this class. All you thing you should do is shown below.

```php
<?php
include("./fileUpload.php");

if ( isset($_POST['upload']) )
{
  $upload = new upload("./uploads/files/", $_FILES["fileInput"], "document", 10);
  $upload->upload();
}

?>

<form  method="POST" enctype="multipart/form-data">
  Select file to upload:
  <input type="file" name="fileInput">
  <button name="upload">Submit</button>
</form>
```

# CLASS INTRODUCTION

`$dir` stands for directory. You need to type the directory where you want to upload the file.
`$uploadedFile` stands for file that you want to upload to server. In this example I uploaded a file with using input which had a name tag called `fileInput`. You should enter your input name here.
`$typeOfUpload` stands for the document type. Is document a image file, PDF file etc. There are three type of uploads in this class.

- image
- document
- csv

`$maxSizeOfUpload` is clear I think. It limits the file size which user want to upload to server. Unit of this integer is `Megabyte`.

```php
$dir = "./upload/files/";
$uploadedFile = $_FILES["fileInput"];
$typeOfUpload = "document";
$maxSizeOfUpload = 10;

$upload = new upload($dir, $uploadedFile, $typeOfUpload, $maxSizeOfUpload);
```
