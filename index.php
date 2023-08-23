<?php /*
    session_start();
    if(isset($_SESSION['user_id'])&& isset($_SESSION['role'])){
        if($_SESSION['role']=='admin'){
            header("location:/adminuser.php");
            exit;}
    
    else {
         header("location:/student/home.php");
        exit;
    }
}
else{
    header("location:/login.php");
    exit;}*/
include("connection.php");
$sql = "select * from users where user_id=6";
$result = mysqli_query($con, $sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    echo $row['user_id']; // Assuming 'id' is a valid column name in your users table
} else {
    echo "error";
}

?>
