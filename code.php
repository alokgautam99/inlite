<?php
    include("connection.php");
    include("header.php");
    if(isset($_POST['upload'])){
        $question = htmlspecialchars(@$_POST['question']);
        echo $question;
        $tags = htmlspecialchars(@$_POST['tags']);
        if($question == ""){
            header("location:code.php?message=question");
        }
        if($tags === NULL){
            header("location:code.php?message=tag");
        }
        $filecount = count($_FILES['file']['name']);
        $filename = $_FILES['file']['name'][0];
        if($filename == NULL){
            echo "null";
        }else{
            for($i=0;$i<4;$i++){
                $bytes = uniqid();
                $filename = $_FILES['file']['name'][$i];
                //compressor code;
                $valid_ext = array('png','jpeg','jpg');
                $ext = explode(".",$filename);
                $ext[1] = strtolower($ext[1]);
                //echo $ext[1];
                $filename = $ext[0].$bytes;
                $file_upload[$i] = $filename.".".$ext[1];
                if(in_array($ext[1],$valid_ext)){  

                    // Compress Image
                    compressedImage($_FILES['file']['tmp_name'][$i],'question/'.$file_upload[$i],10);
                    echo "success";
                
                }
                else{
                        echo "File format is not correct.";
                }
                // move_uploaded_file($_FILES['file']['tmp_name'][$i], 'question/'.$file_upload[$i]);
            }
        }
        $sqlCommand = "INSERT INTO question VALUES('','$question','$file_upload[0]','$file_upload[1]','$file_upload[2]','$file_upload[3]','$tags')";
        $query = mysqli_query($conn , $sqlCommand) or die(mysql_error());
        header("location:code.php?message=success");

        
    }
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Textarea</title>
    <style>
        .container {
            max-width: 820px;
            margin: 0px auto;
            margin-top: 50px;
        }

        .comment {
            float: left;
            width: 100%;
            height: auto;
        }

        .commenter {
            float: left;
        }

        .commenter img {
            width: 35px;
            height: 35px;
        }

        .comment-text-area {
            float: left;
            width: 100%;
            height: auto;
        }

        .textinput {
            float: left;
            width: 100%;
            min-height: 75px;
            outline: none;
            resize: none;
            border: 1px solid grey;
        }
        #tags{
            margin-bottom:2%;
        }
    </style>
</head>
<body>
<form action="code.php" method="post" enctype="multipart/form-data">
    <div class="container">
        <div class="comment">
            <textarea class="textinput" name="question" placeholder="Write Something Cool"></textarea>
            <b>Add Tags:</b><input type="text" name="tags" id="tags" placeholder="Seperate tags by commas"><br />
            <input type="file" name="file[]" id="file" multiple ><br/><br />
            <button type="submit" class="submit" name="upload">Upload</button>
        </div>
    </div>
</form>
</body>
</html>