<?php
    include("connection.php");
    include("header.php");
    $sql = mysqli_query($conn, "SELECT * from question");
    $fetch = mysqli_fetch_assoc($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    body{
        background-color:#f0f8ff;
    }
    #tag{
        color:#483d8b;
    }
    img {
        float: left;
        width:8%;
        height:8%;
        margin-right:15px;
    }
    .container {
        max-width: 80%;
        margin: 0px auto;
        margin-left:2%;
        margin-top: 20px;
            
    }
    .comment {
        float: left;
        width: 100%;
        height: auto;
        /* background-color: white;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        margin-bottom: 25px; */
    }
    .text{
        display:flex;
        flex-direction:column;
        max-height:40px;
        overflow:hidden;
    }
    .upload{
        width:15%;
        height:150px;
        background-color:#A9A9A9;
        float:right;
        margin-top:-20%;
        border-style:groove;
        margin-right:5px;
    }
    .button{
        margin-top:30px;
        width:100%;
        margin-bottom:10px;
        cursor:pointer;
    }
    @media screen and (max-width: 600px) {
        img {
            float: left;
            width:20%;
            height:100%;
            margin-right:15px;

            
        }
        .text{
            max-height:35px;
            overflow:hidden;
        }
        .container {
            max-width: 70%;
            margin: 0px auto;
            margin-left:5%;
            margin-top: 10px;
            
        }
        .desc{
            margin-top:5%;
        }
        .upload{
            width:20%;
            height:100px;
            background-color:#A9A9A9;
            float:right;
            margin-top:-65%;
            border-style:groove;
            margin-right:5px;
        }
        .button{
            margin-top:0px;
            width:100%;
            margin-bottom:10px;
            cursor:pointer;
        }
    }
</style>
</head>
<body>
<div class="container">
<?php 
foreach($sql as $fetch) { 
    $q2 = $fetch['question'];
    $img1 = $fetch['img1'];
    $id = $fetch['id'];
    if($img1 != ""){
        $img1 = "question/".$img1;
    }else{
        $img1 = "1.jpg";
    }
    $x = "discussion.php?id=".$id;
    $report = "report.php?id=".$id;
    ?>
    <div class="comment">
    <div><img src="<?php echo $img1; ?>" alt="image"></div>
    <div class="text"><a href='<?php echo $x; ?>'><?php echo $q2; ?></a><br/></div>
    <div class="desc"><?php
        $tag = explode(",",$fetch['tags']);
        foreach($tag as $t) { ?>
            <b><a href="<?php echo $t; ?>" id="tag"><?php echo $t; ?></a></b>&nbsp&nbsp
    <?php  } ?>
        <b><a href="<?php echo $report; ?>" id="tag">report</a></b>
    </div>
    </div>
    <hr />
    <?php } ?>
</div>
<div class="upload">
    <b><p>Upload a post</p></b>
    <form action="" method="post">
        <button type="submit" class="button">Upload</button>
    </form>
</div>
</body>
</html>
