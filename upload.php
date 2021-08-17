<?php
    include("connection.php");
    if(isset($_POST['upload'])){
        $question = htmlspecialchars(@$_POST['question']);
        $tags = htmlspecialchars(@$_POST['tags']);
        $filecount = count($_FILES['file']['name']);
        $filename = $_FILES['file']['name'][0];
        if($filename == NULL){
            echo "null";
        }else{
            for($i=0;$i<4;$i++){
                $bytes = uniqid();
                $filename = $_FILES['file']['name'][$i];
                $ext = explode(".",$filename);
                $filename = $ext[0].$bytes;
                $file_upload[$i] = $filename.".".$ext[1];
                move_uploaded_file($_FILES['file']['tmp_name'][$i], 'question/'.$file_upload[$i]);
            }
        }
        $sqlCommand = "INSERT INTO question VALUES('','$question','$file_upload[0]','$file_upload[1]','$file_upload[2]','$file_upload[3]','$tags')";
        $query = mysqli_query($conn , $sqlCommand) or die(mysql_error());
        header("location:index.php?message=success");
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
            margin-bottom:2%;
        }
        #tags{
            margin-bottom:2%;
        }
    </style>
</head>
<body>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <div class="container">
        <div class="comment">
            <textarea class="textinput" name="question" placeholder="Write Something Cool"></textarea><br />
            <b>Tags:</b><input type="text" name="tags" id="tags" placeholder="Tags"><br />
            <input type="file" name="file[]" id="file" multiple ><br/><br />
            <button type="submit" class="submit" name="upload">Upload</button>
        </div>
    </div>
</form>
</body>
</html>