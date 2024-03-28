<?php
$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "my_db";
$conn = mysqli_connect($sname, $uname, $password, $db_name);
if (!$conn) {
    echo "Connection failed";
    exit();
}
session_start();
$id = $_SESSION['id'];
$query = "SELECT * FROM student,record where record.pid = student.pid AND student.id=$id";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student-Deshboard</title>

    <link rel="stylesheet" href="mystyle.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
           label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .upload-form {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        h1{
            text-align:center !important;
            padding:20px;
            font-family: 'Roboto', sans-serif;
        }
        .container {
            width: 80%;
            padding: 20px;
            text-align: center;
            
        }
        .mainbody{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90vh;
        }
        .project {
            margin-top:0px;
            margin-bottom: 20px;
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .project h3 {
            font-size: 24px;
            color: #42b883;
            margin-bottom: 10px;
        }

        .project p {
            font-size: 18px;
            line-height: 1.6;
            color: #f0f0f0;
            margin-bottom: 20px;
        }

        .progress {
            height: 20px;
            margin-top: 20px;
            
        }

        .progress-bar {
            background-color: #42b883;
        }

        .work-completed {
            font-size: 20px;
            color: #42b883;
            margin-bottom: 10px;
        }
    </style>
</head>
 
<body>
    
    
    <!-- Code to insert vertical sidebar -->

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
            <a class="element" href="logout.php">
                <i class="fa fa-cogs"></i> Logout
            </a>
            <a class="element" href="changepswd.php">
                <i class="fa fa-cogs"></i> Change Password
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
    <h1>My Project</h1> 
   <div class="mainbody">
   
    <div class="container">
        <?php
        if(mysqli_num_rows($result)==0)
        {
            echo "Sorry, Currently
            you don't have any project to show!";
        }
        while ($rows = mysqli_fetch_assoc($result)) { 
            $fid= $rows['fid'];
            $que="Select `name` from `users` where `id` = $fid";
            $fname=mysqli_query($conn,$que);
            $name=mysqli_fetch_assoc($fname);

            ?>
            
            <div class="project">
                <h3><?php echo $rows['ProjectTitle']; ?></h3>
                <p><?php echo $rows['ProjectDesc']; ?></p>
               <b><p>Project Supervisor: <?php echo $name['name']?></p></b> 
                <div class="work-completed">My Progress</div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar"
                        style="width: <?php echo $rows['progress']; ?>%;" aria-valuenow="<?php echo $rows['progress']; ?>"
                        aria-valuemin="0" aria-valuemax="100"><?php echo $rows['progress']; ?>%</div>
                </div>
                
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                    <label for="document_type">Select Document Type:</label>
                    <select name="document_type" id="document_type">
                        <option value="synopsis">Synopsis</option>
                        <option value="srs">SRS</option>
                        <option value="finalReport">Final Report</option>
                    </select>
                    <label for="file">Upload File:</label>
                    <input  class="btn btn-success" type="file" name="file" accept=".pdf, .docx, .zip, .rar">
                    <input type="hidden" id="pid" name="pid" value="<?php echo $rows['pid'];?>">
                    <input style="margin-left:5px;" type="submit" value="Upload Document">
                </form>
        <?php } ?>
    </div>
    </div>
    
    
    

    <?php
// Connect to the database (similar to your existing code)
$sname="localhost";
$uname="root";
$password="";
$db_name="my_db";
$conn=mysqli_connect($sname,$uname,$password,$db_name);
if(!$conn){
    echo "Connection failed";
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pid = $_POST['pid'];
    $document_type = $_POST['document_type'];

    // Validate document type
    $allowed_document_types = ['synopsis', 'srs', 'finalReport'];
    if (!in_array($document_type, $allowed_document_types)) {
        echo "Invalid document type";
        exit();
    }

    // Process the uploaded file
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];
    $file_size = $_FILES['file']['size'];
    
    $unique_filename = uniqid() . '_' . $file_name;
    // You may want to add more file validation (e.g., file type, size, etc.)
    if($file_tmp==null)
    {
        echo '<script>
        document.getElementById("popupMessage").innerHTML = "Kindly select a document first";
        document.getElementById("myModal").style.display = "block";
    </script>';
        
        exit();
    }
    // Read the file content
    $file_content = file_get_contents($file_tmp);
    $upload_time = date('Y-m-d H:i:s');
        $result2 = mysqli_query($conn, $query);
        $rows = mysqli_fetch_assoc($result2);
        
        if ($document_type == 'synopsis') {
            $pro=20;
            $file_column = 'synopsis';
            $filename_column = 'synopsis_filename';
        } elseif ($document_type == 'srs') {
            $pro=50;
            $file_column = 'srs';
            $filename_column = 'srs_filename';
        } elseif ($document_type == 'finalReport') {
            $pro=90;
            $file_column = 'finalReport';
            $filename_column = 'finalReport_filename';
        }
        
        else{
            echo '<script>
    document.getElementById("popupMessage").innerHTML = "Invalid Ordering";
    document.getElementById("myModal").style.display = "block";
</script>';
            exit();
        }
        $update_query = "UPDATE student SET progress=?, $file_column=?, $filename_column=?, time=? WHERE pid=?";
$stmt = mysqli_prepare($conn, $update_query);
mysqli_stmt_bind_param($stmt, "ssssi", $pro, $file_content, $unique_filename, $upload_time, $pid);
mysqli_stmt_execute($stmt);
        if (mysqli_affected_rows($conn) > 0) {
           
            echo '<script>
    document.getElementById("popupMessage").innerHTML = "Document uploaded successfully!";
    document.getElementById("myModal").style.display = "block";
</script>';
    } else {
        echo '<script>
        document.getElementById("popupMessage").innerHTML = "Error uploading document ";
        document.getElementById("myModal").style.display = "block";
    </script>';
    }
}
?>

</body>

</html>
