<?php
include_once('class_upload_file.php');
if(isset($_FILES['image'])){
$ob=new Sct_image_upload($_SERVER['DOCUMENT_ROOT'].'/upload/');
$ob->image_crop($_FILES['image'],500,500);

echo $ob->new_file;
}
?>
<html>
   <body>
      
      <form action = "" method = "POST" enctype = "multipart/form-data">
         <input type = "file" name = "image" />
         <input type = "submit"/>
			
         <ul>
            <li>Sent file: <?php echo $_FILES['image']['name'];  ?>
            <li>File size: <?php echo $_FILES['image']['size'];  ?>
            <li>File type: <?php echo $_FILES['image']['type'] ?>
         </ul>
			
      </form>
      
   </body>
</html>
