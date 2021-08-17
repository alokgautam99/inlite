<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
ul {
  list-style-type: none;
  margin: 0px;
  padding: 0px;
  overflow: hidden;
  background-color: #5F9EA0;
  height:30px;
}

li {
  float: left;
}

li a {
  color: white;
  text-align: center;
  margin-right:20px;
  /* text-decoration: none; */
}
#search{
    margin-left:50%;
    width:30%;
}
</style>
</head>
<body>
<div class="top">
<ul>
    <li><a class="active" href="index.php?active=0">Home</a></li>
    <li><a href="Login.php">Login</a></li>
    <li><a href="signup.php">Signup</a></li>
    <li><a href="profile.php">Profile</a></li>
    <!-- <form action="index.php?active=0" method="POST">
        <input type="text" placeholder="Search.." name="search" id="search">
        <button type="submit"><i class="fa fa-search"></i></button>
    </form> -->
</ul>
<ul>
    <!-- <li><a class="active" href="index.php?active=0">Home</a></li>
    <li><a href="Login.php">Login</a></li>
    <li><a href="signup.php">Signup</a></li>
    <li><a href="profile.php">Profile</a></li> -->
    <form action="index.php?active=0" method="POST">
        <input type="text" placeholder="Search.." name="search" id="search">
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>
</ul>
</div>
</body>
</html>
