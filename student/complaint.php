
<?php

ob_start();
?>
<?php 


session_start();

// Debugging: Check the session variables



if(!(isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'student')) {
     header("location:../login.php");
       ob_end_flush();
}
     $user=$_SESSION['user_id'];
include("../connection.php");
$query = "SELECT * FROM user_profiles WHERE user_id = '$user'";
$result = mysqli_query($con, $query);

$imagePath = "../profileimages/person.png"; 
$query = "SELECT * FROM user_profiles WHERE user_id = '$user'";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $imagePath = $row['path'];
}?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/complaint.css">
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
    
    document.addEventListener("DOMContentLoaded", function() {
            
            const profileElementx = document.getElementById("profile2");
            const imagePath = "<?php echo $imagePath; ?>"; 
            

        
            profileElementx.style.backgroundImage = `url(${imagePath})`;
            profileElementx.style.backgroundSize = "60px 60px"; // Set dimensions here
        });

            let popup = document.getElementById("popup");
		
            function openPopup(){
                popup.classList.add("open-popup");
            }
            
            function closePopup(){
                popup.classList.remove("open-popup");
            }	

        </script>
	    <style>
#profile2 {
	border: 1px solid black;
	height: 60px;
	width: 60px;
	margin: 10px;
	border-radius: 50%; /* Set the border-radius to half of the width/height for a full circle */
	box-shadow: 2px 3px 10px black;
	background-color: white; /* Set a background color */
	background-size: 100%; /* Adjust the background size to make the image smaller */
	background-position: center; }/* Center the background image */
	</style>
        <title>Student-Complaint</title>
        <link rel="icon" href="images/favicon.png" sizes="120x120" type="image/png">

    </head>
    <body>
    
        <?php 
   

        function name(){
         if(isset($_POST['updater'])){
             $_SESSION['issue_id'] = $_POST['updater'];
             echo "update";
         }else{
             echo "submit";
         }
         
     }
     if (isset($_POST['updater'])) {
     
         $issue_id =  $_SESSION['issue_id'];
     
       
         $query = "SELECT * FROM complaints WHERE issue_id ='$issue_id'";
         $result = mysqli_query($con, $query);
         
         if ($result && mysqli_num_rows($result) > 0) {
           
             $row = mysqli_fetch_assoc($result);
           
     }
     else{
         echo mysqli_error($con);
     }
     }
     function setValue($val)
     {
     global $row; 
     if (isset($row[$val])) {
         echo $row[$val];
     } else {
         echo "";
     }
     }
     
     function setSelected($val, $optionValue)
     {
     global $row; 
     if (isset($row[$val]) && $row[$val] === $optionValue) {
         echo "selected";
     } else {
         echo "";
     }
     }
     
     function title(){
         if(isset($_POST['updater'])){
             
             echo "update the form";
         }else{
             echo "Add an complaint";
         }
     }
     include ("../connection.php");
     if (isset($_POST['submit'])) {
         $username = $_POST['username'];
         $contact = $_POST['contact'];
         $location = $_POST['location'];
         $type = $_POST['type'];
         $date = $_POST['date'];
         $time = $_POST['time'];
         $issue = $_POST['issue'];
         $serial = $_POST['serial'];
     
     
         $query = "INSERT INTO complaints (user_id,username,contact,location,type,date,time, issue,serial,status)
                   VALUES ('$user','$username','$contact', '$location', '$type', '$date', '$time', '$issue', '$serial','unresolved')";
     
         if (mysqli_query($con, $query)) {
            //echo "<script>window.location.href='studentuser.php';</script>";
         } else {
             echo "Error: " . mysqli_error($con);
         }
        
     }
     
     if (isset($_POST['update'])) {
     
     
         $issue_id=$_SESSION['issue_id'];
         $updatedUsername = $_POST['username'];
         $updatedLocation = $_POST['location'];
         $updatedType = $_POST['type'];
         $updatedDate = $_POST['date'];
         $updatedTime = $_POST['time'];
         $updatedIssue = $_POST['issue'];
         $updatedSerial = $_POST['serial'];
     
         $updateQuery = "UPDATE complaints 
                         SET username = '$updatedUsername', 
                             location = '$updatedLocation', 
                             type = '$updatedType', 
                             date = '$updatedDate', 
                             time = '$updatedTime', 
                             issue = '$updatedIssue', 
                             serial = '$updatedSerial' 
                         WHERE issue_id = '$issue_id'";
     
         if (mysqli_query($con, $updateQuery)) {
             unset($_SESSION['issue_id']);
             header("location:history.php");
             exit;
            
         } else {
             unset($_SESSION['issue_id']);
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
                        ADD COMPLAINT
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
                                <a href="password.php">
                                <span class="icon"><i class="ri-key-2-fill"></i></span>
                                <span class="title">Change Password</span>
                                </a>
                            </li>
                            <li>
                                <a href="complaint.php"  class="active" >
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
                    <div class="form">
                        <div class="title">
                            Add Complaint On
                        </div>
                        <form action="" method="post">
                            <div class="inputfield">
                                <label>User Name</label>
                                <input required type="text" class="input" id="username" name="username" value="<?php setValue('username'); ?>">
                            </div>
                            <div class="inputfield">
                                <label>Contact No</label>
                                <input required type="text" class="input" id="contact" name="contact" value="<?php setValue('contact'); ?>">
                            </div>
                            <div class="inputfield">
                                <label>Location</label>
                                <div class="custom_select">
                                    <select required id="location" name="location">
                                        <option value="">Select</option>
                                        <option value="csl1" <?php setSelected('location', 'csl1'); ?>>CSL1</option>
                                        <option value="csl2" <?php setSelected('location', 'csl2'); ?>>CSL2</option>
                                        <option value="csl3" <?php setSelected('location', 'csl3'); ?>>CSL3</option>
                                        <option value="csl4" <?php setSelected('location', 'csl4'); ?>>CSL4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="inputfield">
                                <label>Type</label>
                                <div class="custom_select">
                                    <select required id="type" name="type">
                                        <option value="">Select</option>
                                        <option value="equipment malfunction" <?php setSelected('type', 'equipment malfunction'); ?>>Equipment Malfunction</option>
                                        <option value="maintenance" <?php setSelected('type', 'maintenance'); ?>>Maintenance</option>
                                    </select>
                                </div>
                            </div>
                            <div class="inputfield">
                                <label>Date</label>
                                <input type="date" class="input" id="date" name="date" required value="<?php setValue('date'); ?>">
                            </div>
                            <div class="inputfield">
                                <label>Time</label>
                                <input type="time" class="input" id="time" name="time" required value="<?php setValue('time'); ?>">
                            </div>
                            <div class="inputfield">
                                <label>Description of Issue</label>
                                <textarea id="issue" name="issue" required class="textarea"><?php setValue('issue'); ?></textarea>
                            </div>
                            <div class="inputfield terms">
                                <label class="check">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Agreed to terms and conditions</p>
                            </div>
                            <div class="inputfield">
                                <input type="submit" name="<?php name(); ?>" value="<?php name(); ?>" class="btn" onclick="openPopup()">
                            </div>
                        </form>
                    </div>
                    
                    <div class = "popup" id = "popup">
                        <img src = "images/tick.jpeg">
                        <h2>Thank You!</h2>
                        <p>Your complaint has been successfully submitted. Thanks!</p>
                        <button type = "button" onclick = "closePopup()">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
