<?php
    include("connection.php");
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }else{
        exit();
    }
    if(isset($_POST['upload'])){
        $answer = htmlspecialchars(@$_POST['answer']);
        $filecount = count($_FILES['file']['name']);
        $filename = $_FILES['file']['name'][0];
        if($filename == NULL){
            $sqlCommand = "INSERT INTO answer VALUES('','$id','$answer','','','','')";
            $query = mysqli_query($conn , $sqlCommand) or die(mysql_error());
        }else{
            for($i=0;$i< 4;$i++){
                $bytes = uniqid();
                if($filecount > $i){
                $filename = $_FILES['file']['name'][$i];
                $ext = explode(".",$filename);
                $filename = $ext[0].$bytes;
                $file_upload[$i] = $filename.".".$ext[1];
                    move_uploaded_file($_FILES['file']['tmp_name'][$i], 'answer/'.$file_upload[$i]);
                }else{
                    $file_upload[$i] = "";
                }
            }
            $sqlCommand = "INSERT INTO answer VALUES('','$id','$answer','$file_upload[0]','$file_upload[1]','$file_upload[2]','$file_upload[3]')";
            $query = mysqli_query($conn , $sqlCommand) or die(mysql_error());
        }
    }
    if($id){
        $id = $_GET['id'];
        $sql = mysqli_query($conn, "SELECT * from question WHERE id='$id'");
        $fetch = mysqli_fetch_assoc($sql);
        $q = $fetch['question'];
        $img1 = $fetch['img1'];
        $img2 = $fetch['img2'];
        $img3 = $fetch['img3'];
        $img4 = $fetch['img4'];
        $sql2 = mysqli_query($conn, "SELECT * from answer WHERE qid='$id'");
        $fetch2 = mysqli_fetch_assoc($sql2);
    }
    
?>
<!Doctype html>
<html>
<head>
    <title>Responsive Textarea</title>
    <style>
        .container {
            max-width: 820px;
            margin: 0px auto;
            margin-top: 50px;
            
        }
        .comment2{
            float: left;
            height: auto;
            width: 100%;
        }

        .comment {
            float: left;
            width: 100%;
            height: auto;
            background-color: white;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            margin-bottom: 25px;
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
        img{
            height:300px;
            width:100%;
        }
        hr{
            border: 2px solid black;
            border-radius: 5px;
        }
        @media screen and (max-width: 600px) {
            img{
                width:100%;
                height:100%;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="comment2">
        <?php echo $fetch['question'];?>
    </div>
</div>
    <div class="container">
        <div class="comment">
            <?php 
                if($img1 !=""){
                $ext = explode(".",$img1);
                if($ext[1] !=""){ 
                    $img1 = "question/".$img1;
                    ?>
                        <img src="<?php echo $img1; ?>" class="image" >
            <?php   }   ?>
            <?php } ?>
            <?php
                if($img2 !=""){
                $ext = explode(".",$img2);
                if($ext[1] !=""){ 
                    $img2 = "question/".$img2;
                    ?>
                        <img src="<?php echo $img2; ?>" class="image" >
            <?php   }   ?>
            <?php } ?>
            <?php
                if($img3 !=""){
                $ext = explode(".",$img3);
                if($ext[1] !=""){ 
                    $img3 = "question/".$img3;
                    ?>
                        <img src="<?php echo $img3; ?>" class="image" >
            <?php   }   ?>
            <?php } ?>
            <?php
                if($img4 !=""){
                $ext = explode(".",$img4);
                if($ext[1] !=""){ 
                    $img4 = "question/".$img4;
                    ?>
                        <img src="<?php echo $img4; ?>" class="image" >
            <?php   }   ?>
            <?php } ?>
        </div>
    </div>
<br />
<!-- for answer -- for answer --for answer --for answer --for answer --for answer --for answer --for answer --for answer ---->
<div class="container">
    <div class="comment2">
        <h1>Discuss for this Topic:</h1>
        <h3>Write Your Comment:</h3>
    </div>
</div>
<form action="discussion.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
    <div class="container">
        <div class="comment2">
            <textarea class="textinput" name="answer" placeholder="Answer"></textarea>
            <input type="file" name="file[]" id="file" multiple ><br/><br />
            <button type="submit" class="submit" name="upload">Upload</button>
        </div>
    </div>
</form>
        <?php
        $i=1;
        foreach($sql2 as $fetch2) {
            echo "<div class='container'>";
            $q2 = $fetch2['answer'];
            $img11 = $fetch2['img1'];
            $img22 = $fetch2['img2'];
            $img33 = $fetch2['img3'];
            $img44 = $fetch2['img4'];
            echo "<div class='comment2'>
                <b>Comment ".$i.": </b>".$q2."
                </div>";
        echo "<div class='comment'>";
                if($img11 !=""){
                $ext = explode(".",$img11);
                // print_r($img11);
                // print_r($ext);
                if($ext[1] !=""){ 
                    $img11 = "answer/".$img11;
                    ?>
                        <img src="<?php echo $img11; ?>" class="image" >
            <?php   }   ?>
            <?php } ?>
            <?php
                if($img22 !=""){
                $ext = explode(".",$img22);
                if($ext[1] !=""){ 
                    $img22 = "answer/".$img22;
                    ?>
                        <img src="<?php echo $img22; ?>" class="image" >
            <?php   }   ?>
            <?php } ?>
            <?php
                if($img33 !=""){
                $ext = explode(".",$img33);
                if($ext[1] !=""){ 
                    $img33 = "answer/".$img33;
                    ?>
                        <img src="<?php echo $img33; ?>" class="image" >
            <?php   }   ?>
            <?php } ?>
            <?php
                if($img44 !=""){
                $ext = explode(".",$img44);
                if($ext[1] !=""){ 
                    $img44 = "answer/".$img44;
                    ?>
                        <img src="<?php echo $img44; ?>" class="image" >
            <?php   }   ?>
            <?php } ?>
            </div>
            </div>
            <?php $i = $i+1; } ?>
<br />
</body>
</html>