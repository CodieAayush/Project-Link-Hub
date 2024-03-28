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
            <a class="element" href="my_suggestions.php">
                <i class="fa fa-list"></i> My Suggestions
            </a>
            <a class="element" href="Dashboard.php">
                <i class="fa fa-money"></i> Project Ideas
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
<h1 class="text-center p-3 mb-5 colbl">Change Password</h1>
<div class="mb-3 m-4">
        <label for="ProjectTitle" 
            class="form-label colblk"
            ><b>New Password</b> 
        </label>
        <input type="password" 
            class="form-control" 
            name="newPassword"
            id="newPassword" placeholder="Enter Password"
            style="color:white;background-color:rgb(34, 34, 31);">
</div>
<div class="mb-3 m-4">
        <label for="confirmPassword" 
            class="form-label colblk"
            ><b>Confirm Password</b> 
        </label>
        <input type="password" 
            class="form-control" 
            name="confirmPassword"
            id="confirmPassword" placeholder="Enter Password Again"
            style="color:white;background-color:rgb(34, 34, 31);">
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


// if(isset($_POST['ADD']))
// 	{
// 	$password=$_POST['newPassword'];	
// 	$password1=$_POST['confirmPassword'];	
// 	if($password!=$password1){
//   echo "password mismatch";
//   exit();}
//   else{
//     $id=$_SESSION['id'];
//     $sql="UPDATE `users` set `password`=$passsword where `id`='$id'";
    
  
  

// 	if(mysqli_query($conn,$sql)){
//     echo '<script>
//     document.getElementById("popupMessage").innerHTML = "Your password has been changed";
//     document.getElementById("myModal").style.display = "block";
//     </script>';}
// 	else{
// 		echo "Something went wrong! please try after some time";
// 		echo mysqli_error($conn);
// 	}
// }
// }
if (isset($_POST['ADD'])) {
  $password = $_POST['newPassword'];
  $password1 = $_POST['confirmPassword'];
  if(ctype_space($password))
  {
    echo '<script>
    document.getElementById("popupMessage").innerHTML = "Password Invalid";
    document.getElementById("myModal").style.display = "block";
    </script>';
      exit();
  }
  if ($password != $password1) {
    echo '<script>
    document.getElementById("popupMessage").innerHTML = "Password Mismatch";
    document.getElementById("myModal").style.display = "block";
    </script>';
      exit();
  } else {
      $id = $_SESSION['id'];
      // Fix the typo in variable name and enclose the password value in single quotes
      $sql = "UPDATE `users` SET `password`='$password' WHERE `id`='$id'";
      
      if (mysqli_query($conn, $sql)) {
          echo '<script>
          document.getElementById("popupMessage").innerHTML = "Your password has been changed";
          document.getElementById("myModal").style.display = "block";
          </script>';
          header("Location: index.php");
      } else {
          echo "Something went wrong! Please try after some time";
          echo mysqli_error($conn);
      }
  }
}

?>


</div>
</body>
</html>
