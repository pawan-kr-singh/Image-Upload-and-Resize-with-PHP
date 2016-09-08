<?php
/***
*Name: Pawan Kumar singh
* Upload images and crop it
*/
class Pks_image_upload{

	public $path;
	public $ext_allow;
	public $folder_path;
	public $errors;
	public $new_file;
/***
* Initialize variable for upload image
*
****/
function __construct($path=NULL)
{
$this->ext_allow=array("jpeg","jpg","png");
$this->max_size = $this->parse_size(ini_get('post_max_size'));
if($path){
	$this->folder_path=$path;
}else{
$this->folder_path=$_SERVER['DOCUMENT_ROOT'].'/image/';
}
$this->errors=array();
}

/***
* Upload file 
*
****/
function upload_file($file){
     
      $file_name = $file['name'];
      $file_size = $file['size'];
      $file_tmp = $file['tmp_name'];
      $file_type = $file['type'];
      $file_ext=strtolower(end(explode('.',$file['name'])));
           
      if(in_array($file_ext,$this->ext_allow)=== false){
         $this->errors="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > $this->max_size) {
         $this->errors='File size must be excately 2 MB';
      }
	  $new_filename=time().'.'.$file_ext;
      
      if(empty($this->errors)==true) {
			if(move_uploaded_file($file_tmp,$this->folder_path.$new_filename)){
			$this->new_file= $new_filename;
			}
        
      }

}
/***
* upload and crop files
*
****/
function image_crop($file,$twidth,$theight){
	  $file_name = $file['name'];
      $file_size = $file['size'];
      $file_tmp = $file['tmp_name'];
      $file_type = $file['type'];
      $file_ext=strtolower(end(explode('.',$file_name)));
           
      if(in_array($file_ext,$this->ext_allow)=== false){
         $this->errors="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > $this->max_size) {
         $this->errors='File size must be excately 2 MB';
      }
	 
      
	if(count($this->errors)==0) {
	
	     if($file_ext=="jpg" || $file_ext=="jpeg" )
					{
						
						$src = imagecreatefromjpeg($file_tmp);
						 $new_filename=time().'.'.$file_ext;
					}
					else if($file_ext=="png")
					{
						
						$src = imagecreatefrompng($file_tmp);
						 $new_filename=time().'.'.$file_ext;
					}
					else
					{
						$src = imagecreatefromgif($file_tmp);
						 $new_filename=time().'.'.$file_ext;
					}
	
	
	
	              list($width,$height)=getimagesize($file_tmp);
					// echo $width,$height;
				
					$tmp=imagecreatetruecolor($twidth,$theight);
					imagecopyresampled($tmp,$src,0,0,0,0,$twidth,$theight,$width,$height);
					//add folder for 
				    $file_folder = $this->folder_path.$new_filename;
					
					imagejpeg($tmp,$file_folder,100);
					
					imagedestroy($src);
					imagedestroy($tmp);
					$this->new_file= $file_folder;
					
	}					
	
}
/***
* convert 2M to bit 
*
****/
function parse_size($size) {
  $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); 
  $size = preg_replace('/[^0-9\.]/', '', $size);
  if ($unit) {
    
    return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
  }
  else {
    return round($size);
  }
}
}//close class
