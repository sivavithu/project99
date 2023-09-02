<?php ob_start(); ?>
<?php 
session_start();

if (!(isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'student')) {
    header("location:../login.php");
    exit;
}
$user = $_SESSION['user_id'];

include("../connection.php");

if (isset($_POST['upload'])) {
    $targetDirectory = "../profileimages/"; 
    $allowedExtensions = array("jpg", "jpeg");
    $maxFileSize = 1024 * 1024; // 2 MB

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
        echo "Only JPG and JPEG files up to 1MB are allowed.";
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
    <link rel="stylesheet" href="css/profile.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
    <title>CMS</title>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
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
                           <img id="picture1" src="<?php echo $imagePath; ?>">
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
                <div class="title">
                    profile
                </div>
                <div class="box-container">
                    <?php
                    $user = $_SESSION['user_id'];
                    $sql = "SELECT * FROM users WHERE user_id='$user'";
                    $result = mysqli_query($con, $sql);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <div class="imgBx">
                            <img id="picture2" src="<?php echo $imagePath; ?>">
                        </div>
                        <div class="box">
                            <p><strong>Username :</strong> <?php echo $row['user_name']; ?></p>
                            <p><strong>Email :</strong> <?php echo $row['email']; ?></p>
                            <p><strong>Role :</strong> <?php echo $row['role']; ?></p>  
                            <button class="btn btn-primary edit-btn" data-toggle="modal" data-target="#uploadModal">Edit</button>              
                        </div>
                    <?php
                        }
                    } else {
                        echo "Error: " . mysqli_error($con);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div id="uploadModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Profile Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="uploadForm" action="profile.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="image">Select an image to upload (jpg, jpeg):</label>
                            <input type="file" class="form-control-file" name="image" id="image" accept=".jpg, .jpeg">
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" name="upload" class="btn btn-primary" value="Upload">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
