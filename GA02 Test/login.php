<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="mystyle.css" type="text/css">
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
    border: var(--bs-border-widthj) var(--bs-border-style) white !important;}
   .colblk{
    color:white;
   }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center 
    align-items-center"
    style="min-height:100vh; color:white">
    <div style="box-shadow: 0 0 10px 3px  rgba(255, 255, 255, 0.5);">
        <form class="border shadow p-3 rounded" 
            action="php/check-login.php"
            method="post"
            style="width:450px;">
            <h1 class="text-center p-3 colblk">LOGIN</h1>
            <?php if(isset($_GET['error'])){ ?>
            <div class="alert alert-danger" role="alert">
                  <?=$_GET['error']?>
            </div>
            <?php } ?>
        <div class="mb-3">
        <label for="username" 
            class="form-label colblk">
            <b>Username </b></label>
        <input type="text" 
            class="form-control" 
            name="username"
            id="username"
            style="color:white;background-color:rgb(34, 34, 31);">
        </div>
       
        <div class="mb-3">
        <label for="password" 
            class="form-label colblk">
            <b>Password</b></label>
        <input type="password" 
            class="form-control" 
            name="password"
            id="password"
            style="color:white;background-color:rgb(34, 34, 31);">
        </div>
        
        <div class="mb-1">
        <label  class="form-label colblk">
        <b>Select User Type</b></label>
        </div>
        <select class="form-select mb-3"
            name="role" 
            aria-label="Default select example"
            style="background-color:rgb(34, 34, 31);color:white;">
            <option selected value="student">Student</option>
            <option value="faculty">Faculty</option>
         
            </select>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
            </div>
    </div>
</body>
</html>