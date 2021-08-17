<?php
include ("connection.php");
    
   if(isset($_POST['upload'])){

       // Getting file name
       $filename = $_FILES['image']['name'];
       //echo $filename;
         
       // Valid extension
       $valid_ext = array('png','jpeg','jpg');

			
        $photoExt1 = @end(explode('.', $filename)); // explode the image name to get the extension
        // echo $photoExt1;
	    $phototest1 = strtolower($photoExt1);
			
	    $new_profle_pic = time().'.'.$phototest1;
			// echo $new_profle_pic;
       // Location
        $location = "images/".$new_profle_pic;

       // file extension
        $file_extension = pathinfo($location, PATHINFO_EXTENSION);
        $file_extension = strtolower($file_extension);
        // echo $file_extension;
        // print_r($file_extension);

    //    // Check extension
        if(in_array($file_extension,$valid_ext)){  

             // Compress Image
             compressedImage($_FILES['image']['tmp_name'],$location,10);
				
	// 	    //Here i am enter the insert code in the step ........

         }
	     else
         {
                 echo "File format is not correct.";
         }
     }

    // // Compress image
     function compressedImage($source, $path, $quality) {

            $info = getimagesize($source);
            // print_r($info);

             if ($info['mime'] == 'image/jpeg') 
                 $image = imagecreatefromjpeg($source);

             elseif ($info['mime'] == 'image/gif') 
                 $image = imagecreatefromgif($source);

             elseif ($info['mime'] == 'image/png') 
                 $image = imagecreatefrompng($source);

             imagejpeg($image, $path, $quality);

     }

 ?>
<form method='post' action='' enctype='multipart/form-data'>
	<input type='file' name='image' class="form-control"><br>
	<input type='submit' value='Upload Image' class="btn btn-primary" name='upload'>    
</form>