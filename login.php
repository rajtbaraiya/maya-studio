<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:../wedplanner/index.php');
   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      body {
   margin: 0;
   padding: 0;
   font-family: Arial, sans-serif;
   background: url('images/log.jpg') no-repeat center center/cover;
   height: 100vh;
   display: flex;
   align-items: center;
   justify-content: center;
   position: relative;
}

.logo {
   position: fixed;
   top: 20px;
   left: 20px;
   z-index: 1000;
}

.logo img {
   width: 150px;
   height: auto;
}

body::before {
   content: "";
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   background-color: rgba(0, 0, 0, 0.5); /* Adjust opacity here */
   z-index: 1;
}
.form-container {
   position: absolute;
   right: 50px; /* Slightly moved left */
   top: 50%;
   transform: translateY(-50%);
   background: rgba(0, 0, 0, 0.6); /* Reduced background opacity */
   color: #fff; /* Ensure text remains visible against the dark background */
   padding: 20px;
   border-radius: 10px;
   box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
   width: 100%;
   max-width: 400px;
   height: 300px; /* Adjusted height for better layout */
   z-index: 2; /* Ensures it appears above the overlay */
}



.form-container h3 {
   text-align: center;
   margin-bottom: 20px;
   color: white; /* Match the text color for readability */
}

      .form-container .box {
         width: 100%;
         padding: 10px;
         margin: 10px 0;
         border: 1px solid #ccc;
         border-radius: 5px;
      }

      .form-container .btn {
         width: 100%;
         padding: 10px;
         background: #333;
         color: #fff;
         border: none;
         border-radius: 5px;
         cursor: pointer;
         transition: background 0.3s ease;
      }

      .form-container .btn:hover {
         background: #555;
      }

      .form-container .forgot-password {
         text-align: right;
         margin-bottom: 10px;
      }

      .form-container .forgot-password a {
         text-decoration: none;
         color: #333;
         font-size: 0.9em;
      }

      .form-container p {
         text-align: center;
         margin-top: 20px;
      }

      .form-container p a {
   color: #ccc; /* Subtle link color for dark background */
}

      /* Container pushed to the right */
      .form-container {
         position: absolute;
         right: 00px;
         top: 50%;
         transform: translateY(-50%);
      }
   </style>

</head>
<body>
   <a href="../wedplanner/index.php" class="logo">
      <img src="../wedplanner/images/logo_wed.jpg" alt="Wedding Planner Logo">
   </a>

   <div class="form-container">

      <form action="" method="post" enctype="multipart/form-data">
         <h3>login now</h3>
         <?php
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>';
            }
         }
         ?>
         <input type="email" name="email" placeholder="enter email" class="box" required>
         <input type="password" name="password" placeholder="enter password" class="box" required>
         <div class="forgot-password">
            <a href="forgot.php">Forgot Password?</a>
         </div>
         <input type="submit" name="submit" value="login now" class="btn">
         
         <?php
         session_start();
         $_SESSION['usermail']=$_POST['email'];
         ?>
         
         <p>don't have an account? <a href="register.php">register now</a></p>
      </form>

   </div>

</body>
</html>
