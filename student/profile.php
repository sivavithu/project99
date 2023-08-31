<?php ob_start(); ?>
<?php 


session_start();


if(!(isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'student')) {
  header("location:../login.php");
       exit;
}
$user=$_SESSION['user_id'];



include("../connection.php");

if (isset($_POST['upload'])) {
    $targetDirectory = "../profileimages/"; 
    $allowedExtensions = array("jpg", "jpeg");
    $maxFileSize = 2 * 1024 * 1024; // 2 MB

    $fileExtension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
    $imagePath = $targetDirectory . $_FILES["image"]["name"];

    // Check if user ID exists
    $query = "SELECT user_id FROM user_profiles WHERE user_id = '$user'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userIdExists = true;

        // Delete the previous image if it exists
        $currentImagePath = $row['path'];
        if (file_exists($currentImagePath)) {
            unlink($currentImagePath);
        }
    } else {
        $userIdExists = false;
    }

    if (in_array($fileExtension, $allowedExtensions) && $_FILES["image"]["size"] <= $maxFileSize) {
        if ($userIdExists) {
            // Update the image path in the database
            $updateQuery = "UPDATE user_profiles SET path = '$imagePath' WHERE user_id = '$user'";
            $updateResult = mysqli_query($con, $updateQuery);

            if ($updateResult) {
                echo "Image updated successfully.";
            } else {
                echo "Error updating image record: " . mysqli_error($con);
            }
        } else {
            $insertQuery = "INSERT INTO user_profiles (user_id, path) VALUES ('$user', '$imagePath')";
            $insertResult = mysqli_query($con, $insertQuery);

            if ($insertResult) {
                echo "Image uploaded and record inserted successfully.";
            } else {
                echo "Error inserting image record: " . mysqli_error($con);
            }
        }

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
            echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded for user " . $user;
        } else {
            echo "Error uploading the file.";
        }
    } else {
        echo "Only JPG and JPEG files up to 2MB are allowed.";
    }
}
$imagePath = "../profileimages/person.png"; 
$query = "SELECT * FROM user_profiles WHERE user_id = '$user'";
$result = mysqli_query($con, $query);


if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $imagePath = $row['path'];
}

?>







<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="path/to/idb.filesystem.js"></script>

        <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
        <script src="script.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0"> </script>

     

        <title>CMS</title>
 <!-- ... (previous code) ... -->

<script>
   document.addEventListener("DOMContentLoaded", function() {
    const profileElement = document.getElementById("profile1");
            const profileElementx = document.getElementById("profile2");
            const imagePath = "<?php echo $imagePath; ?>"; 
            

            profileElement.style.backgroundImage = `url(${imagePath})`;
            profileElement.style.backgroundSize = "200px 200px"; // Set dimensions here
            profileElementx.style.backgroundImage = `url(${imagePath})`;
            profileElementx.style.backgroundSize = "60px 60px"; // Set dimensions here
        });
</script>

<!-- ... (remaining code) ... -->


        <style>
            .modal {
    display: none; 

}
.modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

      
        .modal-content {
            background-color: #fefefe;
            margin: auto; /* Center the modal horizontally */
            margin-top: 10%; /* Adjust as needed */
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px; /* Limit the width of the modal */
            position: relative;
        }

.close {
    color: #aaa;
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 20px;
    cursor: pointer;
}
.close {
    color: #aaa;
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 24px; /* Increase the font size */
    cursor: pointer;
}
.center-button {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        #openModal {
            padding: 5px 10px;
            background-color: #003996;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
        }

        #openModal:hover {
            background-color: #002678;
        }

        #profile1 {
	border: 1px solid black;
	height: 200px;
	width: 200px;
	margin: 10px;
	border-radius: 50%; /* Set the border-radius to half of the width/height for a full circle */
	box-shadow: 2px 3px 10px black;
	background-color: white; /* Set a background color */
	background-size: 100%; /* Adjust the background size to make the image smaller */
	background-position: center; /* Center the background image */
	
}
#profile2 {
	border: 1px solid black;
	height: 60px;
	width: 60px;
	margin: 10px;
	border-radius: 50%; /* Set the border-radius to half of the width/height for a full circle */
	box-shadow: 2px 3px 10px black;
	background-color: white; /* Set a background color */
	background-size: 100%; /* Adjust the background size to make the image smaller */
	background-position: center; /* Center the background image */
	
}
.item1 {
  display: flex;
  flex-direction: column;
  align-items: center;
}
.item1 {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.item1 {
  display: flex;
  flex-direction: column;
  align-items: center;
  max-width: 500px; /* Limit the width of the container */
  margin: 0 auto; /* Center the container on the page */
  padding: 20px; /* Add some padding */
}

.item1 .profile {
  background-color: #f5f5f5;
  padding: 15px;
  margin: 10px 0;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  border-radius: 5px; /* Add some rounded corners */
}

.item1 .profile p {
  margin: 5px 0;
}

/* Style for alternating profiles */
.item1 .profile:nth-child(odd) {
  background-color: #fff;
}
#openModal {
  margin-top: 10px;
  margin-bottom:20px;
  padding: 5px 10px; /* Adjust padding to make the button smaller */
  background-color: #003996;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 12px; /* Adjust font size to make the text smaller */
}

#openModal:hover {
  background-color: #002678;
}

.center-button {
  display: flex;
  justify-content: center;
  margin-top: 10px;
}



        </style>
     





        <link rel="icon" href="f.png" sizes="120x120" type="image/png">

    </head>
    <body>
 

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
                                <a href="./home.php" >
                                <span class="icon"><i class="ri-home-4-fill"></i></span>
                                <span class="title">Home</span>
                                </a>
                            </li>
                            <li>
                                <a href="./profile.php" class="active">
                                <span class="icon"><i class="ri-account-circle-fill"></i></span>
                                <span class="title">Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="./password.php">
                                <span class="icon"><i class="ri-key-2-fill"></i></span>
                                <span class="title">Change Password</span>
                                </a>
                            </li>
                            <li>
                                <a href="./complaint.php">
                                <span class="icon"><i class="ri-add-circle-fill"></i></span>
                                <span class="title">Add Complaint</span>
                                </a>
                            </li>
                            <li>
                                <a href="./history.php">
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
        <div id="profile1"></div>
    </center>

<center>
                    <button id="openModal">Add/Change Picture</button></center>
                    <div class="item1">
                       <?php
                       include ("../connection.php");
                       $sql = "SELECT * FROM users WHERE user_id='$user'";
                       $result = mysqli_query($con, $sql);

                       if ($result) {
                           while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                     
                

                     <div class='profile'>
                        
                        <p><strong>username:</strong> <?php echo $row['user_name']; ?></p>
                        <p><strong>email:</strong> <?php echo $row['email']; ?></p>
                        <p><strong>role:</strong> <?php echo $row['role']; ?></p>
                        
                      
                    </div>
                           
                        <?php }
                    } else {
                        echo "Error: " . mysqli_error($con);
                    }
                 
                       ?>
                    </div>
                   
                    
                </div>
            </div>
        
        </div>	
        <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Upload Image</h2>
            <form id="uploadForm" action="profile.php" method="post" enctype="multipart/form-data">
                <label for="image">Select an image to upload(jpg,jpeg):</label>
                <input type="file" name="image" id="image">
                <input type="submit" name="upload" value="Upload">
            </form>
        </div>
    </div>
    </body>
</html>
