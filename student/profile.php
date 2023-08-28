<?php ob_start(); ?>
<?php 


session_start();


if(!(isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'student')) {
  header("location:../login.php");
      exit;
}
$user=$_SESSION['user_id];



if (isset($_POST['upload'])) {
    $targetDirectory = "../profileimages/"; // Directory where uploaded images will be stored
    $userId = $user; // Replace this with the actual user ID

    // Define allowed image file extensions
    $allowedExtensions = array("jpg", "jpeg");

    // Get the uploaded file's extension
    $fileExtension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

    // Check if the uploaded file has a valid extension
    if (in_array($fileExtension, $allowedExtensions)) {
        // Create the target file path with the user's ID as the filename
        $targetFile = $targetDirectory . $userId;

        // Delete the existing file if it exists
        if (file_exists($targetFile . ".jpg")) {
            unlink($targetFile . ".jpg");
        }
        
        if (file_exists($targetFile . ".jpeg")) {
            unlink($targetFile . ".jpeg");
        }

        // Move the uploaded file to the target location
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile . "." . $fileExtension)) {
            echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded and replaced as " . $userId;
        } else {
            echo "Error uploading the file.";
        }
    } else {
        echo "Only JPG and JPEG files are allowed.";
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
        <script>
  document.addEventListener("DOMContentLoaded", function() {
  const profileElement = document.getElementById("profile1");
  const profileElementx = document.getElementById("profile2");
  const userID = "<?php echo $user; ?>"; // Make sure to sanitize and validate this value
  const imageExtensions = ["jpg", "jpeg"];
  const imagesFolderPath = "../profileimages/";

  // Check User ID
  console.log("User ID:", userID);

  // Try loading images with different extensions
  for (const extension of imageExtensions) {
    const imageURL = `${imagesFolderPath}${userID}.${extension}`;
    console.log("Trying image URL:", imageURL);

    const img = new Image();
    img.src = imageURL;

    img.onload = function() {
      // Set the background image and adjust background size
      profileElement.style.backgroundImage = `url(${imageURL})`;
      profileElement.style.backgroundSize = "200px 200px";
      profileElementx.style.backgroundImage = `url(${imageURL})`;
      profileElementx.style.backgroundSize = "60px 60px"; // Set dimensions here
    };
  }
});

  
</script>

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
	background-image: url("../profileimages/person.png"); /* Set the default background image */
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
	background-image: url("../profileimages/person.png"); /* Set the default background image */
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
