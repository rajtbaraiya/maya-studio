<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home - Wed Planner</title>

   <style>
      * {
         margin: 0;
         padding: 0;
         box-sizing: border-box;
         font-family: 'Poppins', sans-serif;
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

      body {
         background: linear-gradient(135deg, #f7f0ed 0%, #f4f1f1 100%);
         min-height: 100vh;
         display: flex;
         justify-content: center;
         align-items: center;
         padding: 20px;
      }

      .container {
         max-width: 500px;
         width: 100%;
         background: #fff;
         padding: 2rem;
         border-radius: 15px;
         box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
         text-align: center;
         position: relative;
         overflow: hidden;
      }

      .container::before {
         content: '';
         position: absolute;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background: linear-gradient(45deg, rgba(244, 88, 102, 0.1), rgba(64, 64, 104, 0.1));
         z-index: 0;
         pointer-events: none;
      }

      .profile {
         position: relative;
         z-index: 1;
      }

      .profile img {
         width: 150px;
         height: 150px;
         border-radius: 50%;
         object-fit: cover;
         border: 4px solid #f45866;
         margin-bottom: 1.5rem;
         transition: transform 0.3s ease;
      }

      .profile img:hover {
         transform: scale(1.05);
      }

      .profile h3 {
         font-size: 1.8rem;
         color: #404068;
         margin-bottom: 1.5rem;
         font-weight: 600;
         text-transform: capitalize;
      }

      .profile a {
         display: inline-block;
         padding: 0.8rem 2rem;
         margin: 0.5rem 0;
         border-radius: 25px;
         text-decoration: none;
         font-size: 1rem;
         font-weight: 500;
         transition: all 0.3s ease;
      }

      .btn {
         background: #f45866;
         color: #fff;
      }

      .btn:hover {
         background: #d14755;
         box-shadow: 0 4px 10px rgba(244, 88, 102, 0.3);
      }

      .delete-btn {
         background: #eee;
         color: #666;
      }

      .delete-btn:hover {
         background: #ddd;
         color: #333;
         box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      }

      .album-link {
         background: #404068;
         color: #fff;
      }

      .album-link:hover {
         background: #323250;
         box-shadow: 0 4px 10px rgba(64, 64, 104, 0.3);
      }

      .profile p {
         margin-top: 1.5rem;
         font-size: 0.9rem;
         color: #666;
      }

      .profile p a {
         color: #f45866;
         padding: 0;
         margin: 0 0.2rem;
         font-weight: 500;
         background: none;
      }

      .profile p a:hover {
         color: #d14755;
         text-decoration: underline;
      }

      @media (max-width: 480px) {
         .container {
            padding: 1.5rem;
         }

         .profile img {
            width: 120px;
            height: 120px;
         }

         .profile h3 {
            font-size: 1.5rem;
         }

         .profile a {
            padding: 0.7rem 1.5rem;
            font-size: 0.9rem;
         }
      }
   </style>
</head>
<body>
   <a href="../wedplanner/index.php" class="logo">
      <img src="../wedplanner/images/logo_wed.jpg" alt="Wedding Planner Logo">
   </a>

   <div class="container">
      <div class="profile">
         <?php
            $select = mysqli_query($conn, "SELECT * FROM `user` WHERE id = '$user_id'") or die('query failed');
            if(mysqli_num_rows($select) > 0){
               $fetch = mysqli_fetch_assoc($select);
            }
            if($fetch['image'] == ''){
               echo '<img src="images/default-avatar.png" alt="Profile Picture">';
            }else{
               echo '<img src="uploaded_img/'.$fetch['image'].'" alt="Profile Picture">';
            }
         ?>
         <h3><?php echo $fetch['name']; ?></h3>
         <a href="update_profile.php" class="btn">Update Profile</a>
         <a href="home.php?logout=<?php echo $user_id; ?>" class="delete-btn">Logout</a>
         <p>New <a href="login.php">Login</a> or <a href="register.php">Register</a></p>
      </div>
   </div>

</body>
</html>