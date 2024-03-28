<?php
session_start();
include "..//db_conn.php";

    if(isset($_POST['username']) && isset($_POST['password'])){

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }
          $username = test_input($_POST['username']);
          $password = test_input($_POST['password']);
         
          if((empty($username))){
            header("Location: ../login.php?error= User Name is Required");    
          }
          
          else if((empty($password))){
            header("Location: ../login.php?error= Password is Required");    
          }
        
          else{
            //Hashing the password
            //$password = md5($password);
            $sql = "Select * from users where username='$username' and password='$password' ";
            $result = mysqli_query($conn,$sql);
            

            if(mysqli_num_rows($result)===1)
            {
                $row=mysqli_fetch_assoc($result);
                
                    $_SESSION['name']=$row['name'];
                    $_SESSION['id']=$row['id'];
                    $_SESSION['role']=$row['role'];
                    $_SESSION['username']=$row['username'];
                    if($_SESSION['role']=='faculty')
                          header("Location: ../Deshboardf.php");
                    else if($_SESSION['role']=='hod')
                          header("Location: ../DashboardA.php");
                    else  header("Location: ../myproject.php");
            }
            else{
                header("Location: ../login.php?error= Incorrect username or password");    
                
            }
          }
          
    }
    else{
        header("Location: ../login.php");
    }
?>