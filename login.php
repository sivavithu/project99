<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
    <style>
        body {
            display: flex;
            justify-content: center;
        }

      
    </style>
    
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        function showerr() {
            document.getElementById("error-message").innerHTML="enter a valid username or password";
        }
    </script>
</head>

<body>

    <div class="loginform">
        <h1>Login</h1>
        <p id="error-message"></p>
        <form action="" method="post">
            <div class="username">
                <p>Username:</p>
                <input type="text" name="username">
            </div>
            <div class="password">
                <p>Password:</p>
                <input type="password" name="password">
            </div>
            <div class="submit">
                <input type="submit" name="login" value="Login">
            </div>
        </form>
        <div class="forgotpass">
            <a href="/otp.php"><button>forgot password</button></a>
        </div>
    </div>

    <?php
    session_start();
    ob_start();
    if(isset($_SESSION['error'])){
        echo $_SESSION['error'];
    }

    if (isset($_SESSION['invalidmail'])) {
        echo $_SESSION['invalidmail'];
    }
    if (isset($_SESSION['user_id'])) {
        if ($_SESSION['role'] == 'admin') {
            header("location:/adminuser.php");
            exit;
        } else {
            header("location:/student/home.php");
            exit;
        }
    }

    include "/connection.php";
    if (isset($_POST['login'])) {
        if ((isset($_POST['username']) && isset($_POST['password']))) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = "select * from users where user_name='$username'";
            $result = mysqli_query($con, $query);
            if (!$result) {
                die("connection failed" . mysqli_connect_error());
            }
           if(mysqli_num_rows($result)!=0){
            $row = mysqli_fetch_assoc($result);
         
           if (password_verify($password, $row['password'])) {
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['role'] = $row['role'];
               echo   ."hi",$_SESSION['user_id'],$_SESSION['role'];
    
   // ob_end_clean(); // Clear the output buffer
 // echo '<script>window.location.href = "/index.php";</script>';
exit;

} 

                  
            else {
                ob_end_clean();
                echo "<script>showerr();</script>";
            }
        }
        else{
            echo "<script>showerr();</script>";
        }

        
    }
    
    }

    ?>


</body>

</html>
