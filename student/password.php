<?php ob_start(); ?>
<?php 


session_start();

// Debugging: Check the session variables



if(!(isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'student')) {
     header("location:../login.php");
       exit;
}
	$user=$_SESSION['user_id'];
include("../connection.php");
$query = "SELECT * FROM user_profiles WHERE user_id = '$user'";
$result = mysqli_query($con, $query);

$imagePath = "../profileimages/person.png"; 

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $imagePath = $row['path'];
}?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
        <script>
            $(document).ready(function(){
                $(".hamburger .hamburger__inner").click(function(){
                $(".wrapper").toggleClass("active")
                })

                $(".top_navbar .fas").click(function(){
                $(".profile_dd").toggleClass("active");
                });
            })
            function validatePassword(event) {
    var newPassword = document.getElementById("new_password").value;
    var confirmPassword = document.getElementById("confirm_password").value;
    var confirmError = document.getElementById("confirm_password_error");

    if (newPassword !== confirmPassword) {
        event.preventDefault();
        confirmError.textContent = "Passwords do not match.";
    } else {
        confirmError.textContent = ""; // Clear the error message
    }
}
            if(window.history.replaceState){
    window.history.replaceState(null,null,window.location.href);}

    
    document.addEventListener("DOMContentLoaded", function() {
            
            const profileElementx = document.getElementById("profile2");
            const imagePath = "<?php echo $imagePath; ?>"; 
            

        ;
            profileElementx.style.backgroundImage = `url(${imagePath})`;
            profileElementx.style.backgroundSize = "60px 60px"; // Set dimensions here
        });
 
        </script>
         

        <title>CMS</title>
        <link rel="icon" href="f.png" sizes="120x120" type="image/png">
          <style>#profile2 {
	border: 1px solid black;
	height: 60px;
	width: 60px;
	margin: 10px;
	border-radius: 50%; /* Set the border-radius to half of the width/height for a full circle */
	box-shadow: 2px 3px 10px black;
	background-color: white; /* Set a background color */
	background-size: 100%; /* Adjust the background size to make the image smaller */
	background-position: center; /* Center the background image */
	background-image: url("../imagestore/person.png"); /* Set the default background image */
}</style>
    </head>
    <body>
 <?php  
   
  include ("../connection.php");
 
  
       $user=$_SESSION['user_id'];
       
       if(isset($_POST['change'])){
        $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password ='$password' WHERE user_id = '$user'";
        $result=mysqli_query($con,$sql);
        if($result){
         header("location:./home.php");
         exit;
        }
         else{
            echo mysqli_error($con);
         }
       }
       
       
       
       
       
       ?>

        <div class="wrapper">
            <div class="top_navbar">
                <div class="hamburger">
                    <div class="hamburger__inner">
                        <div class="one"></div>
                        <div class="two"></div>
                        <div class="three"></div>
                    </div>
                </div>
                <div class="menu">
                    <div class="logo">
                        HOME
                    </div>
                    <div class="right_menu">
                        <ul>
                            <li><i class="fas fa-user"></i>
                                <div class="profile_dd">
                                <div class="dd_item"><a href="../logout.php">Logout</a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="main_container">
                <div class="sidebar">
                    <div class="sidebar__inner">
                        <div class="profile">
                            <div class="img">
                          <div id="profile2"></div>
                 </div>
                          
                            <div class="profile_info">
                                <p>Welcome</p>
                                <p class="profile_name">User</p>
                            </div>
                        </div>
                        <ul>
                            <li>
                                <a href="home.php" >
                                <span class="icon"><i class="ri-home-4-fill"></i></span>
                                <span class="title">Home</span>
                                </a>
                            </li>
                            <li>
                                <a href="profile.php" >
                                <span class="icon"><i class="ri-account-circle-fill"></i></span>
                                <span class="title">Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="password.php" class="active">
                                <span class="icon"><i class="ri-key-2-fill"></i></span>
                                <span class="title">Change Password</span>
                                </a>
                            </li>
                            <li>
                                <a href="complaint.php">
                                <span class="icon"><i class="ri-add-circle-fill"></i></span>
                                <span class="title">Add Complaint</span>
                                </a>
                            </li>
                            <li>
                                <a href="history.php">
                                <span class="icon"><i class="ri-check-double-line"></i></span>
                                <span class="title">Your Complaints</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="container">
                    <center>
                        <h2> Welcome to department of computer science complaint register portal </h2>
                    </center>
                    <br><br>
                    <center>
                        <h2> Change Password </h2>
                    </center>
                    <br><br>
                        
                    <div class="item1">
                   <div class="search">
                    <form action="history.php" method="post">
        <input type="text" name="key">
         <input type="submit" name="search" value="search">
    </form>
    <form action="" method="post">
    <label for="new_password">New Password:</label>
<input type="password" id="new_password" name="password" required>
<br><br>

<label for="confirm_password">Confirm New Password:</label>
<input type="password" id="confirm_password" name="confirm_password" required>
<span id="confirm_password_error" style="color: red;"></span>
<br><br>

<input type="submit" name="change" value="Change Password" onclick="validatePassword(event)">
    </form>
</div>
           
        
        </div>	
 
  
    </body>
</html>
