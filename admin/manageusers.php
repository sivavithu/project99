<?php 
ob_start();
session_start();
/*if(!(isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin')) {
    header("location:../login.php");
    exit;
}*/
include("../connection.php");
require 'actions.php';
$sqlAdmins = "SELECT user_name, name, email, status FROM users WHERE role = 'admin'";
$resultAdmins = mysqli_query($con, $sqlAdmins);
$admins = array();

if ($resultAdmins) {
    while ($row = mysqli_fetch_assoc($resultAdmins)) {
        $admins[] = $row;
    }
}

$sqlStudents = "SELECT  user_id,user_name, name, email, status FROM users WHERE role = 'student'";
$resultStudents = mysqli_query($con, $sqlStudents);
$students = array();

if ($resultStudents) {
    while ($row = mysqli_fetch_assoc($resultStudents)) {
        $students[] = $row;
    }
}
if (isset($_POST['toggle_status'])) {
    $id = $_POST['student'];
    
   
    $currentStatus = getStatus($id);

  
    $newStatus = ($currentStatus === 'active') ? 'inactive' : 'active';
      $result = updateStatus($id, $newStatus);

    if ($result) {
        header("location:manageusers.php");
        exit;
    } else {
        echo mysqli_error($con);
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_POST['delete'];

   
    $deleteSql = "DELETE FROM users WHERE user_id = $id";
    $deleteResult = mysqli_query($con, $deleteSql);

    if ($deleteResult) {
      
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
    <title>Admin Dashboard</title>
</head>
<body>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.15/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.15/dist/sweetalert2.all.min.js"></script>
 <script src="actions.js"></script>  


</head>
<body>
<form action="" method="post"><input type="submit" name="create" value="Create User"></form>
     <?php if(isset($_POST['create'])){header("location:createuser.php");exit;} ?>

    <h1>Admins</h1>
    
    <table border="1">
        <tr>
           
            <th>Username</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
        </tr>
        <?php foreach ($admins as $admin){ ?>
            <tr>
              
                <td><?php echo $admin['user_name']; ?></td>
                <td><?php echo $admin['name']; ?></td>
                <td><?php echo $admin['email']; ?></td>
                <td><?php echo $admin['status']; ?></td>
            </tr>
        <?php } ?>
    </table>

    <h1>Students</h1>
    <table border="1">
        <tr>
          
            <th>Username</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th colspan="2">Actions</th>
        </tr>
        <?php foreach ($students as $student){ ?>
            <tr>
            
                <td><?php echo $student['user_name']; ?></td>
                <td><?php echo $student['name']; ?></td>
                <td><?php echo $student['email']; ?></td>
                <td><?php echo $student['status']; ?></td>
                <td>
                <form method="post" action="">
                    <input type="hidden" name="student" value=<?php echo $student['user_id']; ?>>
                    <input type="submit" name="toggle_status" value="<?php echo ($student['status'] === 'active') ? 'Deactivate' : 'Activate'; ?>">
                </form>
                
                <button onclick="submitDeleteForm('<?php echo $student['user_id'];?>')">delete</button>
                 

          </td>

                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

