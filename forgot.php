<?php
include 'config.php';

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $security_answer = mysqli_real_escape_string($conn, md5($_POST['security_answer']));
    $new_password = mysqli_real_escape_string($conn, md5($_POST['new_password']));
    $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm_password']));

    // Check if email exists and security answer matches
    $select = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email' AND security_answer = '$security_answer'") or die('query failed');

    if(mysqli_num_rows($select) > 0){
        if($new_password != $confirm_password){
            $message[] = 'Confirm password not matched!';
        }else{
            mysqli_query($conn, "UPDATE `user` SET password = '$new_password' WHERE email = '$email'") or die('query failed');
            $message[] = 'Password updated successfully!';
            header('location:login.php');
        }
    }else{
        $message[] = 'Invalid email or security answer!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Forgot Password</title>
   <link rel="stylesheet" href="css/style.css">
   <style>
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

      body::before {
         content: "";
         position: absolute;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background-color: rgba(0, 0, 0, 0.5);
         z-index: 1;
      }

      .form-container {
         position: absolute;
         right: 50px;
         top: 50%;
         transform: translateY(-50%);
         background: rgba(0, 0, 0, 0.6);
         color: #fff;
         padding: 20px;
         border-radius: 10px;
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
         width: 100%;
         max-width: 400px;
         z-index: 2;
      }

      .form-container h3 {
         text-align: center;
         margin-bottom: 20px;
         color: white;
         font-size: 24px;
      }

      .form-container input,
      .form-container select {
         width: 100%;
         padding: 10px;
         margin: 10px 0;
         border: 1px solid #ccc;
         border-radius: 5px;
         background: white;
         color: #333;
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
         margin-top: 10px;
      }

      .form-container .btn:hover {
         background: #555;
      }

      .back-to-login {
         text-align: center;
         margin-top: 20px;
      }

      .back-to-login a {
         color: #ccc;
         text-decoration: none;
      }

      .back-to-login a:hover {
         text-decoration: underline;
      }

      .message {
         margin: 10px 0;
         padding: 10px;
         border-radius: 5px;
         text-align: center;
         background: rgba(255, 255, 255, 0.1);
         color: #fff;
      }

      .success {
         background: rgba(40, 167, 69, 0.2);
      }

      .error {
         background: rgba(220, 53, 69, 0.2);
      }
   </style>
</head>
<body>
   <a href="../wedplanner/index.php" class="logo">
      <img src="../wedplanner/images/logo_wed.jpg" alt="Wedding Planner Logo">
   </a>

   <div class="form-container">
      <form action="" method="post" enctype="multipart/form-data">
         <h3>Reset Password</h3>
         <?php
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>';
            }
         }
         ?>
         <input type="email" name="email" placeholder="enter your email" class="box" required>
         <input type="text" name="security_answer" placeholder="enter your security answer" class="box" required>
         <input type="password" name="new_password" placeholder="enter new password" class="box" required>
         <input type="password" name="confirm_password" placeholder="confirm new password" class="box" required>
         <input type="submit" name="submit" value="Reset Password" class="btn">
         <p>Remember your password? <a href="login.php">Login now</a></p>
      </form>
   </div>
</body>
</html>
