<html>
<head>	
<title>Project Link Hub</title>
<link rel="stylesheet" href="mystyle.css" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<style>
     body{
        background-image: url('background.jpg'); 
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: white;
        backdrop-filter: blur(3px);
        }
   .border {
    border: var(--bs-border-widthj) var(--bs-border-style) #0e4379!important;
}
.colblk
{
  color:white;
  font-size:20px;
}
.colbl{
  color:white;
}
#ProjectTitle::placeholder,#ProjectDesc::placeholder{
      color:white;
    }
</style>
</head>
<body style="overflow: hidden;">

<!--
    Code to insert vertical sidebar 
-->

<input type="checkbox" id="menu-toggle" checked>
<div class="menu dflex">
  <div id="logoCSS3" class="text-center">
    <i class="fa fa-css3"></i>
  </div>
  <div class="elements-container dflex">
   
    <a class="element" href="Deshboard.php">
        <i class="fa fa-money"></i>  Project Dashboard
      </a>
    <a class="element" href="suggest.php">
        <i class="fa fa-gavel"></i> Give Suggestions
      </a>
    <a class="element" href="logout.php">
        <i class="fa fa-cogs"></i> Logout
      </a>
  </div>
  <div class="menu-container-btn">
    <div class="menu-toggle-btn">
      <label class="menu-btn text-center" for="menu-toggle">
          <i class="fa fa-close"></i>
          <i class="fa fa-bars"></i>
        </label>
    </div>
  </div>
</div>


<div class="container d-flex justify-content-center 
    align-items-center"
    style="min-height:100vh; color:white">
    <div style="box-shadow: 0 0 10px 2px  rgba(255, 255, 255, 0.5);">
<form action="" method="POST" class="border shadow p-3 rounded" >
<h1 class="text-center p-3 mb-5 colbl">Suggest a Project</h1>

<div class="mb-3 m-4">
        <label for="ProjectTitle" 
            class="form-label colblk"><b>Title</b></label>
        <input type="text" 
            class="form-control" 
            name="ProjectTitle"
            id="ProjectTitle" placeholder="Enter Project Title"
            style="color:white;background-color:rgb(34, 34, 31);width:243px;">
</div>
<div class="mb-3 m-4" >
        <label for="ProjectDesc" 
            class="form-label colblk"><b>Description</b></label> <br>
            <textarea name="ProjectDesc" id="ProjectDesc" cols="30" rows="10" placeholder="Enter project description"
            style="color:white;background-color:rgb(34, 34, 31);"></textarea>
        <!-- <input type="text" 
            class="form-control" 
            name="ProjectDesc"
            id="ProjectDesc"
            placeholder="Enter Project Description"
             style="height: 220px;"> -->

</div>
<input class="btn btn-success m-4" name="ADD" type="submit" value="SUBMIT" ><input class="btn btn-danger"  type="RESET" value="RESET">
</form>
  </div>
<?php
$sname="localhost";
$uname="root";
$password="";
$db_name="my_db";
$conn=mysqli_connect($sname,$uname,$password,$db_name);
if(!$conn){
    echo "Connection failed";
    exit();
}

if(isset($_POST['ADD']))
	{
	$ProjectTitle=$_POST['ProjectTitle'];	
	$ProjectDesc=$_POST['ProjectDesc'];
  
  if((empty($ProjectTitle))){
   echo "Title is required";
  }
  
  else if((empty($ProjectDesc))){
    echo "Project Description is Requires";    
  }
  else{
    session_start();
    $sname=$_SESSION['username'];
	$sql = "INSERT INTO `suggestion` (`Sname`,`ProjectTitle`, `ProjectDesc`,`Time`) 
	VALUES('$sname','$ProjectTitle', '$ProjectDesc',now());";
	if(mysqli_query($conn,$sql)){
	echo "Project has been added submitted successfully";}
	else{
		echo "Something went wrong! please try after some time";
		echo mysqli_error($conn);
	}
}
}
  
?>


</div>
</body>
</html>