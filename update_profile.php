<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['update_profile'])){
   $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);

   mysqli_query($conn, "UPDATE `user` SET name = '$update_name', email = '$update_email' WHERE id = '$user_id'") or die('query failed');

   $old_pass = $_POST['old_pass'];
   $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
   $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
   $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));

   if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "UPDATE `user` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('query failed');
         $message[] = 'password updated successfully!';
      }
   }

   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'uploaded_img/'.$update_image;

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image is too large';
      }else{
         $image_update_query = mysqli_query($conn, "UPDATE `user` SET image = '$update_image' WHERE id = '$user_id'") or die('query failed');
         if($image_update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
         $message[] = 'image updated successfully!';
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
   <title>Update Profile</title>

   <style>
      * {
         margin: 0;
         padding: 0;
         box-sizing: border-box;
         font-family: 'Poppins', sans-serif;
      }

      body {
         background: #f4f4f4;
         min-height: 100vh;
         display: flex;
         justify-content: center;
         align-items: center;
         padding: 20px;
      }

      .update-profile {
         background: #fff;
         padding: 2rem;
         border-radius: 10px;
         box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
         max-width: 600px;
         width: 100%;
      }

      .update-profile img {
         display: block;
         margin: 0 auto 1.5rem;
         width: 150px;
         height: 150px;
         object-fit: cover; /* Ensures image stays within bounds */
         border-radius: 50%;
         border: 3px solid #f45866;
      }

      .message {
         background: #ffebee;
         color: #d32f2f;
         padding: 1rem;
         margin-bottom: 1rem;
         border-radius: 5px;
         text-align: center;
         font-size: 0.9rem;
      }

      .message.success {
         background: #e8f5e9;
         color: #2e7d32;
      }

      .flex {
         display: grid;
         grid-template-columns: 1fr 1fr;
         gap: 1.5rem;
      }

      .inputBox {
         display: flex;
         flex-direction: column;
         gap: 0.5rem;
      }

      .inputBox span {
         font-size: 0.9rem;
         color: #333;
         font-weight: 500;
      }

      .inputBox input, .inputBox select {
         width: 100%;
         padding: 0.8rem;
         border: 1px solid #ddd;
         border-radius: 5px;
         font-size: 1rem;
         transition: border-color 0.3s ease;
      }

      .inputBox input:focus {
         border-color: #f45866;
         outline: none;
      }

      .btn, .delete-btn {
         display: inline-block;
         padding: 0.8rem 1.5rem;
         margin-top: 1.5rem;
         border-radius: 5px;
         text-align: center;
         text-decoration: none;
         font-size: 1rem;
         cursor: pointer;
         transition: all 0.3s ease;
      }

      .btn {
         background: #f45866;
         color: #fff;
         border: none;
      }

      .btn:hover {
         background: #d14755;
      }

      .delete-btn {
         background: #eee;
         color: #666;
         margin-left: 1rem;
      }

      .delete-btn:hover {
         background: #ddd;
         color: #333;
      }

      @media (max-width: 480px) {
         .flex {
            grid-template-columns: 1fr;
         }

         .update-profile {
            padding: 1.5rem;
         }

         .update-profile img {
            width: 120px;
            height: 120px;
         }
      }
   </style>
</head>
<body>
   
<div class="update-profile">
   <?php
      $select = mysqli_query($conn, "SELECT * FROM `user` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <?php
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png" alt="Profile Picture">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['image'].'" alt="Profile Picture">';
         }
         if(isset($message)){
            foreach($message as $msg){
               $class = (strpos($msg, 'successfully') !== false) ? 'message success' : 'message';
               echo '<div class="'.$class.'">'.$msg.'</div>';
            }
         }
      ?>
      <div class="flex">
         <div class="inputBox">
            <span>Username:</span>
            <input type="text" name="update_name" value="<?php echo $fetch['name']; ?>" class="box" required>
            <span>Your Email:</span>
            <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box" required>
            <span>Update Your Picture:</span>
            <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
         </div>
         <div class="inputBox">
            <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
            <span>Old Password:</span>
            <input type="password" name="update_pass" placeholder="Enter previous password" class="box">
            <span>New Password:</span>
            <input type="password" name="new_pass" placeholder="Enter new password" class="box">
            <span>Confirm Password:</span>
            <input type="password" name="confirm_pass" placeholder="Confirm new password" class="box">
         </div>
      </div>
      <input type="submit" value="Update Profile" name="update_profile" class="btn">
      <a href="home.php" class="delete-btn">Go Back</a>
   </form>
</div>

</body>
</html>