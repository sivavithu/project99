<?php
ob_start();
session_start();


if(!(isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin')) {
     header("location:../login.php");
       exit;}
    
include("../connection.php");
require('actions.php');

if (isset($_POST['createuser'])) {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $result = createUser($username, $name, $email, $hashedPassword, $role);

    if ($result) {
        header("location: manageusers.php");
        exit;
    } else {
        echo mysqli_error($con);
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
  <title>Complaint Portal</title>
  <style>
    body {
      overflow-x: hidden;
    }
    #sb {
      height: 100vh;
      background-color: #333;
      color: white;
      width: 350px;
    }
    #ct {
      margin-left: 350px;
    }
   
  .lg {
    margin-top: 10px; /* Reduce the margin for more height */
    margin-bottom: 10px; /* Reduce the margin for more height */
    background-color: #333;
    color: white;
    border-color: #444;
    font-size: 18px;
    display: flex;
    align-items: center;
    height: 80px; /* Increase the height */
    padding-left: 30px;
    transition: background-color 0.3s;
  }

  .lg:hover {
    background-color: #444;
  }

    .wline {
      margin-top: 20px;
      position: relative;
      top: 20px;
      border: none;
      height: 12px;
      background: white;
      margin-bottom: 20px;
    }
    .dcs {
      color: white;
      font-weight: bold;
      font-size: x-large;
      margin-left: 70px;
    }
    .uoj {
      color: white;
      font-weight: bold;
      font-size: large;
      margin-left: 20px;
    }
    .navbar-center {
      margin-left: auto;
      margin-right: auto;
    }
    .navbar-center-adjusted {
      margin-left: calc(50% - 350px/2); /* Adjusted for sidebar width */
    }
  </style>
  
  <script>
   document.addEventListener("DOMContentLoaded", function() {
  const profileElement = document.getElementById("propic");

  const userID = "<?php echo $user; ?>"; // Make sure to sanitize and validate this value
  const imageExtensions = ["jpg", "jpeg"];
  const imagesFolderPath = "../imagestore/";



  // Try loading images with different extensions
  for (const extension of imageExtensions) {
    const imageURL = `${imagesFolderPath}${userID}.${extension}`;
    console.log("Trying image URL:", imageURL);

    const img = new Image();
    img.src = imageURL;

    img.onload = function() {
     
      profileElement.src = `url(${imageURL})`;
      profileElement.style.backgroundSize = "40px 40px";// Set dimensions here
    };
  }
});
</script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Complaint Portal</a>
  
  <div class="navbar-center navbar-center-adjusted">
    <form class="form-inline">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>

  <div class="d-flex align-items-center ml-auto">
    <!-- Profile Picture -->
    <img id="propic" src="../imagestore/person.png" alt="Profile Picture" class="rounded-circle" style="width: 40px; height: 40px; margin-right: 10px;">
    <!-- Name -->
    <span class="text-white">John Doe <br>Admin</span>
  </div>
  
  <div class="ml-3">
    <a class="btn btn-danger btn-sm" href="#">
      <i class="ri-logout-circle-line ri-lg"></i> Logout
    </a>
  </div>
</nav>



<div class="d-flex" id="wrapper">
  <!-- Sidebar -->
  <div class="bg-dark border-right" id="sb">
    <div class="sb-heading"></div>
    <div class="list-group list-group-flush">
      <a href="#" class="lg list-group-item-action">
        <i class="ri-home-4-line"></i> Home
      </a>
      <a href="#" class="lg list-group-item-action">
        <i class="ri-user-line"></i> Profile
      </a>
      <a href="#" class="lg list-group-item-action">
        <i class="ri-add-circle-line"></i> Create Users
      </a>
      <a href="#" class="lg list-group-item-action">
        <i class="ri-settings-line"></i> Manage Users
      </a>
      <a href="#" class="lg list-group-item-action">
        <i class="ri-alert-line"></i> Active Complaints
      </a>
      <a href="#" class="lg list-group-item-action">
        <i class="ri-check-double-line"></i> Complaint History
      </a>
 
       
     
    </div>
    <hr class="wline">
    <p class="dcs">DCS</p>
    <p class="uoj">University of Jaffna</p>
  </div>
  <!-- /#sidebar -->

  <!-- Page Content -->
  <div id="ct" class="container-fluid">
  <h2>Create User</h2>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>
        
        <label for="name">Name:</label>
        <input type="text" name="name" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>
        
        <label for="role">Role:</label>
        <select name="role" required>
            <option value="admin">Admin</option>
            <option value="student">Student</option>
        </select><br><br>
        
        <input type="submit" name="createuser" value="Create User">
    </form>
  </div>
  <!-- /#content -->
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
