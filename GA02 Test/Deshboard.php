<?php

$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "my_db";
$conn = mysqli_connect($sname, $uname, $password, $db_name);
session_start();
if (!$conn) {
    echo "Connection failed";
    exit();
}

$query = "select * from `record`";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Fetch Data From Database</title>

    <link rel="stylesheet" href="mystyle.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
        <style>
        /* body{
        background-image: url('background.jpg'); 
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: white;
        backdrop-filter: blur(3px);
         overflow-y: scroll; 
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 25vh auto;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
            color:"white";
            font-size: 20px;
        }

        td{
            font-weight:bold;
        }

        th {
            background-color: #e0dbc1;
            color:black;
        }

        tr:hover {
            background-color: #f5f5f5;
            color:black;
        }

        form {
            margin: 0;
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

        .men{
            font-size:20px;
            color:white;
        } */

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
            
            <a class="element" href="#">
                <i class="fa fa-money men" style="font-size:20px;color:white;"></i> Project Dashboard
            </a>
            <a class="element" href="suggest.php">
                <i class="fa fa-gavel men" style="font-size:20px;color:white;"></i> Give Suggestions
            </a>
            <a class="element" href="logout.php">
                <i class="fa fa-cogs men" style="font-size:20px;color:white;"></i> Logout
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
    <p id="popupMessage">Sorry! The Projecy is Unavailable</p>
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

    <h2 style="text-align:center;padding-top:20px;">Projects</h2>
    <!-- style="color:white; width:800px; line-height:40px;" -->
     <table>
        <tr class="table-info">
            <th>Faculty Name</th>
            <th>Project ID</th>
            <th>Project Title</th>
            <th>Project Description</th>
            <th>Status</th>
            <th>Request</th>
        </tr>

        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            // Your PHP code for data retrieval goes here
            $fid = $row['fid'];
            $query = "SELECT `name` FROM `users` WHERE `id` = '$fid'";
            $innerResult = mysqli_query($conn, $query);
            
            if ($innerResult) {
                if (mysqli_num_rows($innerResult) == 1) {
                    $rowa = mysqli_fetch_assoc($innerResult);
                    $name = $rowa['name'];
                } else {
                    echo "Invalid credentials. Please try again.";
                }
            }
            else {
                echo "Error in the query: " . mysqli_error($conn);
            }
        ?>
            <tr>
                <td><?php echo $name; ?></td>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['ProjectTitle']; ?></td>
                <td><?php echo $row['ProjectDesc']; ?></td>
                <td style="background-color: <?php echo ($row['Status'] == 1) ? 'lightgreen' : 'rgb(255, 127, 127)'; ?>;">
                    <?php
                    if ($row['Status'] == 1)
                        echo "Available";
                    else
                        echo "Unavailable";
                    ?>
                </td>
                <td>
                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['fid']; ?>" />
                        <input type="submit" name="request_<?php echo $row['id']; ?>" value="Request">
                    </form>
                    <?php
                    if(isset($_POST["request_".$row['id']])) {
                        $id = $row['id'];
                        $fid = $row['fid'];
                        $pt = $row['ProjectTitle'];
                        // Ensure to sanitize user inputs before inserting into the database to prevent SQL injection
                        $pt = mysqli_real_escape_string($conn, $pt);
                        $id = mysqli_real_escape_string($conn, $id);
                        $fid = mysqli_real_escape_string($conn, $fid);
                        $sname=$_SESSION['username'];
                         // Check if the user has already requested the same project
                        $existingRequestQuery = "SELECT * FROM `request` WHERE `id`='$id' AND `fid`='$fid' AND `Sname`='$sname'";
                        $existingRequestResult = mysqli_query($conn, $existingRequestQuery);

                        if (mysqli_num_rows($existingRequestResult) > 0) {
                            // User has already requested this project
                            echo '<script>alert("You have already requested this project.");</script>';
                        } 
                        else {
                        if ($row['Status'] == 1) {
                        $sql = "INSERT INTO `request` (`id`,`fid`,`Sname`, `ProjectTitle`,`status`) 
                                VALUES('$id','$fid','$sname', '$pt','pending');";
                        $query = mysqli_query($conn, $sql);

                        // You can add more handling or feedback here if needed
                        if ($query) {
                            echo '<script>
                            document.getElementById("popupMessage").innerHTML = "Your request has been submitted successfully";
                            document.getElementById("myModal").style.display = "block";
                        </script>';
                        } else {
                            echo "Error inserting request: " . mysqli_error($conn);
                        }
                    }else {
                        
                        echo '<script>
                            document.getElementById("popupMessage").innerHTML = "Sorry! The Project is Unavailable";
                            document.getElementById("myModal").style.display = "block";
                        </script>';
                    }
                    }
                }
                    ?>
                </td>
            </tr>

        <?php
        }
        ?>
    </table>
</body>

</html>
