<?php session_start(); ?>
<html>
<head>	
<title>Project Link Hub</title>
<link rel="stylesheet" href="mystyle.css" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<style>
    
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
#ProjectDesc::placeholder,#ProjectTitle::placeholder,#ProjectTech::placeholder{
      color:white;
    }
</style>
</head>
<body>

<!--
    Code to insert vertical sidebar 
-->

<input type="checkbox" id="menu-toggle" checked>
<div class="menu dflex">
  <div id="logoCSS3" class="text-center">
    <i class="fa fa-css3"></i>
  </div>
  <div class="elements-container dflex">
            <a class="element" href="myproject.php">
                <i class="fa fa-money"></i> Project Dashboard
            </a>
            <a class="element" href="Dashboard.php">
                <i class="fa fa-money"></i> Project Ideas
            </a>
            <a class="element" href="suggest.php">
                <i class="fa fa-gavel"></i> Give Suggestions
            </a>
            <a class="element" href="my_suggestions.php">
                <i class="fa fa-list"></i> --->My Suggestions
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
<div id="myModal" class="modal1">
  <div class="modal-content">
    <span class="close" id="closeModal">&times;</span>
    <p id="popupMessage">Sorry! The Project is Unavailable</p>
  </div>
</div>
<script>
    // Function to close the modal
    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }
    document.getElementById("closeModal").addEventListener("click", closeModal);
  window.addEventListener("click", function(event) {
        if (event.target == document.getElementById("myModal")) {
            closeModal();
        }
    });
</script>

<div class="container d-flex justify-content-center 
    align-items-center"
    style="min-height:100vh; color:white">
    <div style="box-shadow: 0 0 10px 2px  rgba(255, 255, 255, 0.5);">
<form action="" method="POST" class="border shadow p-3 rounded" >
<h1 class="text-center p-3 mb-5 colbl">Suggest a Project</h1>
<div class="mb-3 m-4">
        <label for="ProjectTitle" 
            class="form-label colblk"
            ><b>Title</b> 
        </label>
        <input type="text" 
            class="form-control" 
            name="ProjectTitle"
            id="ProjectTitle" placeholder="Enter Project Title"
            style="color:white;background-color:rgb(34, 34, 31);">
</div>
<div class="mb-3 m-4" >
        <label for="ProjectDesc" 
            class="form-label colblk"><b>Description</b></label> <br>
            <textarea name="ProjectDesc" id="ProjectDesc" cols=60" rows="10" placeholder="Enter project description"
            style="color:white;background-color:rgb(34, 34, 31);"></textarea>
</div>
<div class="mb-3 m-4">
        <label for="ProjectTech" class="form-label colblk"><b>Required Technology</b> 
        </label>
        <input type="text" 
            class="form-control" 
            name="ProjectTech"
            id="ProjectTech" placeholder="Enter Project Technology" style="color:white;background-color:rgb(34, 34, 31);">
</div>
<div class="mb-3 m-4" >
        <label for="ProjectSDG" class="form-label colblk"><b>Select SDG</b></label> <br>
        <select  class="first" name="sdg" required>
          <option id="sdg" value="GOAL 1: No Poverty">GOAL 1: No Poverty </option>
         <option id="sdg" value="GOAL 2: Zero Hunger>" >GOAL 2: Zero Hunger </option>
          <option id="sdg" value="GOAL 3: Good Health and Well-Being" >GOAL 3: Good Health and Well-Being </option> 
          <option id="sdg" value="GOAL 4: Quality Education" >GOAL 4: Quality Education </option> 
          <option id="sdg" value="GOAL 5: Gender Equality" >GOAL 5: Gender Equality </option> 
          <option id="sdg" value="GOAL 6: Clean Water and Sanitation" >GOAL 6: Clean Water and Sanitation </option> 
          <option id="sdg" value="GOAL 7: Affordable and Clean Energy" >GOAL 7: Affordable and Clean Energy </option> 
          <option id="sdg" value="GOAL 8: Decent Work and Economic Growth" >GOAL 8: Decent Work and Economic Growth </option> 
          <option id="sdg" value="GOAL 9: Industry, Innovation and Infrastructure" >GOAL 9: Industry, Innovation and Infrastructure </option> 
          <option id="sdg" value="GOAL 10: Reduced Inequalities" >GOAL 10: Reduced Inequalities </option> 
          <option id="sdg" value="GOAL 11: Sustainable Cities and Communities" >GOAL 11: Sustainable Cities and Communities </option> 
          <option id="sdg" value="GOAL 12: Responsible Consumption and Production" >GOAL 12: Responsible Consumption and Production </option> 
          <option id="sdg" value="GOAL 13: Climate Action" >GOAL 13: Climate Action </option> 
          <option id="sdg" value="GOAL 14: Life Below Water" >GOAL 14: Life Below Water </option> 
          <option id="sdg" value="GOAL 15: Life On Land" >GOAL 15: Life On Land </option> 
          <option id="sdg" value="GOAL 16: Peace, Justice and Strong Institutions" >GOAL 16: Peace, Justice and Strong Institutions </option> 
          <option id="sdg" value="GOAL 17: Partnerships for the Goals" >GOAL 17: Partnerships for the Goals </option></div>
        </select>
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
  $SDG=$_POST['sdg'];	
  $ProjectTech=$_POST['ProjectTech'];
  if (empty($ProjectTitle)) {
    echo '<script>alert("Title is required");</script>';
} elseif (empty($ProjectDesc)) {
  echo '<script>alert("Project Description is required");</script>';
} elseif (ctype_space($ProjectTitle)) {
  echo '<script>alert("Title should not contain only white spaces");</script>';
} elseif (ctype_space($ProjectDesc)) {
  echo '<script>alert("Project Description should not contain only white spaces");</script>';
}
  else{
    
    $sname=$_SESSION['username'];
	$sql = "INSERT INTO `suggestion` (`Sname`,`ProjectTitle`, `ProjectDesc`,`ProjectTech`,`SDG`,`Time`) 
	VALUES('$sname','$ProjectTitle', '$ProjectDesc','$ProjectTech','$SDG',now());";
	if(mysqli_query($conn,$sql)){
    echo '<script>
    document.getElementById("popupMessage").innerHTML = "Your suggestions have been well noted!  Thankyou";
    document.getElementById("myModal").style.display = "block";
</script>';}
	else{
		echo "Something went wrong! please try after some time";
		//echo mysqli_error($conn);
	}
}
}
  
?>


</div>
</body>
</html>