<?php ob_start(); ?>
<?php 


session_start();

// Debugging: Check the session variables



if(!(isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'student')) {
     header("location:../login.php");
       exit;
} 
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

            if(window.history.replaceState){
    window.history.replaceState(null,null,window.location.href);}


    function button(str,issue_id){
        let location;
        if(str=="updater"){
            location="./complaint.php"
        }
        else{
            location="";
        }
        let form=document.createElement('form');
        form.action=location;
        form.method="post"
        let input=document.createElement("input");
        input.type="hidden";
        input.name=str;
        input.value=issue_id;

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
       document.addEventListener("DOMContentLoaded", function() {
            
            const profileElementx = document.getElementById("profile2");
            const imagePath = "<?php echo $imagePath; ?>"; 
            

        
            profileElementx.style.backgroundImage = `url(${imagePath})`;
            profileElementx.style.backgroundSize = "60px 60px"; // Set dimensions here
        });
    }
        </script>
        <style>
              .history {
            border: 1px solid black;
            width: 400px;
            padding: 8px;
            margin: 20px;
            text-align: left;
        }
        </style>

        <title>CMS</title>
        <link rel="icon" href="f.png" sizes="120x120" type="image/png">

    </head>
    <body>
 <?php  
   

 
  
       $user=$_SESSION['user_id'];
       include "../connection.php"; 
       if(isset($_POST['deleter'])){
        $issue_id=$_POST['deleter'];
        $query="delete from complaints where issue_id='$issue_id'";
        
        if (mysqli_query($con, $query)) {
            echo "Complaint submitted successfully!";
        } else {
            echo "Error: " . mysqli_error($con);
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
                                <a href="../logout.php"> <div class="dd_item">Logout</div></a>
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
                                <img src="https://p7.hiclipart.com/preview/922/81/315/stock-photography-computer-icons-user-3d-character-icon-vector-material.jpg" alt="profile_pic">
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
                                <a href="password.php">
                                <span class="icon"><i class="ri-key-2-fill"></i></span>
                                <span class="title">Change Password</span>
                                </a>
                            </li>
                            <li>
                                <a href="complaint.php" >
                                <span class="icon"><i class="ri-add-circle-fill"></i></span>
                                <span class="title">Add Complaint</span>
                                </a>
                            </li>
                            <li>
                                <a href="history.php" class="active">
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
                        <div class="search">
                    <form action="history.php" method="post">
        <input type="text" name="key">
         <input type="submit" name="search" value="search">
    </form>
                    <div class="item1">
                        <?php
                    include "../connection.php";  
     if(!isset($_POST['search'])){
      $sql="select * from complaints where user_id=$user";
          $result=mysqli_query($con, $sql);
      if (!$result) {
       echo "Error: " . mysqli_error($con);
    } else {
        
    

     while($row=mysqli_fetch_assoc($result)){?>

         <div class='history'>
            
                <p><strong>Location:</strong> <?php echo $row['location']; ?></p>
                <p><strong>Date:</strong> <?php echo $row['date']; ?></p>
                <p><strong>Status:</strong> <?php echo $row['status']; ?></p>
                <p><strong>issue:</strong> <?php echo $row['issue']; ?></p>
                <p><strong>serial:</strong> <?php echo $row['serial']; ?></p>
                <button onclick="button('updater',<?php echo $row['issue_id'];?>)">update</button>
                <button onclick="button('deleter',<?php echo $row['issue_id'];?>)">delete</button>
            </div>
       

                 
                       <?php }
      }
     }
          else if(isset($_POST['search'])){
        $keywords=$_POST['key'];
        $sql = "SELECT * FROM complaints WHERE issue LIKE '%$keywords%' or  username LIKE '%$keywords%' or  location LIKE '%$keywords%'
                 or  type LIKE '%$keywords%' or  status LIKE '%$keywords%' or  issue LIKE '%$keywords%'";
        $result = mysqli_query($con, $sql);

      if ($result) {
        
            while ($row = mysqli_fetch_assoc($result)) {?>
            
         <div class='history'>
            
            <p><strong>Location:</strong> <?php echo $row['location']; ?></p>
            <p><strong>Date:</strong> <?php echo $row['date']; ?></p>
            <p><strong>Status:</strong> <?php echo $row['status']; ?></p>
            <p><strong>issue:</strong> <?php echo $row['issue']; ?></p>
            <p><strong>serial:</strong> <?php echo $row['serial']; ?></p>
            <button onclick="button('updater',<?php echo $row['issue_id'];?>)">update</button>
            <button onclick="button('deleter',<?php echo $row['issue_id'];?>)">delete</button>
        </div>
               
            <?php }
        } else {
            echo "Error: " . mysqli_error($con);
        }
        
       
       
    
}
?>
  
</div>
    </body>
</html>
