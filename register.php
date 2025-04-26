<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $security_question = mysqli_real_escape_string($conn, $_POST['security_question']);
   $security_answer = mysqli_real_escape_string($conn, md5($_POST['security_answer']));
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist'; 
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }elseif($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $insert = mysqli_query($conn, "INSERT INTO `user`(name, email, password, security_question, security_answer, image) VALUES('$name', '$email', '$pass', '$security_question', '$security_answer', '$image')") or die('query failed');

         if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'registered successfully!';
            header('location:login.php');
         }else{
            $message[] = 'registeration failed!';
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- custom css file link  -->
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
   background-color: rgba(0, 0, 0, 0.5); /* Adjust opacity here */
   z-index: 1;
}

      /* Container pushed to the right */
      .form-container {
         position: absolute;
         right: 50px;
         top: 50%;
         transform: translateY(-50%);
         background: rgba(0, 0, 0, 0.6);
         color: #fff;
         padding: 15px;
         border-radius: 10px;
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
         width: 400px;
         height: 450px;
         z-index: 2;
      }

      .form-container h3 {
         text-align: center;
         margin-bottom: 12px;
         color: white;
         font-size: 24px;
      }

      .form-container .box {
         width: 85%;
         padding: 12px;
         margin: 12px 0;
         border: 1px solid #ccc;
         border-radius: 5px;
         background: rgba(255, 255, 255, 0.9);
         color: #333;
         margin-left: auto;
         margin-right: auto;
         display: block;
      }

      .form-container .btn {
         width: 100%;
         padding: 12px;
         background: #333;
         color: #fff;
         border: none;
         border-radius: 5px;
         cursor: pointer;
         transition: background 0.3s ease;
         font-size: 16px;
         margin-top: 12px;
      }

      .form-container p {
         text-align: center;
         margin-top: 15px;
      }

      .form-container p a {
   color: #ccc; /* Subtle link color for dark background */
}

   </style>

</head>
   
<body>
   <a href="/wedplanner/index.php" class="logo">
      <img src="/wedplanner/images/logo_wed.jpg" alt="Wedding Planner Logo">
   </a>

   <div class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>register now</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="text" name="name" placeholder="enter username" class="box" required>
      <input type="email" name="email" placeholder="enter email" class="box" required>
      <input type="password" name="password" placeholder="enter password" class="box" required>
      <input type="password" name="cpassword" placeholder="confirm password" class="box" required>
      <select name="security_question" class="box" required>
         <option value="">Select Security Question</option>
         <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
         <option value="What was your first pet's name?">What was your first pet's name?</option>
         <option value="In which city were you born?">In which city were you born?</option>
         <option value="What is your favorite movie?">What is your favorite movie?</option>
      </select>
      <input type="text" name="security_answer" placeholder="enter security answer" class="box" required>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" name="submit" value="register now" class="btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</div>

</body>
</html>