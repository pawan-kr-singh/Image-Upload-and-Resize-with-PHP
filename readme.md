How to use
--------------------------
<?php
include_once('class_upload_file.php');//include class
if(isset($_FILES['image'])){ //set action isset
$ob=new Pks_image_upload($_SERVER['DOCUMENT_ROOT'].'/upload/'); //create object
$ob->image_crop($_FILES['image'],500,500);//get image resource for crop image and upload
//if only upload file
$ob->upload_file($_FILES['image']);
echo $ob->new_file;
}
?>
<html>
   <body>
      
      <form action = "" method = "POST" enctype = "multipart/form-data">
         <input type = "file" name = "image" />
         <input type = "submit"/>
      </form>
      
   </body>
</html>
