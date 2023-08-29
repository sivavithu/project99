<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>OTP Verification</title>
</head>
<body>
    <?php
    session_start();
    
    if(isset($_SESSION['user_id'])&& isset($_SESSION['role'])){
        if($_SESSION['role']=='admin'){
            header("location:/admin/home.php");
            exit;}
    
    else if($_SESSION['role']=="student"){
        header("location:/student/home.php");
        exit;
    }
}

    if(isset($_SESSION['user_id'])){
        displayform2();

    }
    else{
        displayform1();
    }
    include ("connection.php");
    if (isset($_POST['submit'])) { 

    if (isset($_POST['email'])) {
        $email = $_POST['email'];

        $queryforemail = "select * from users where email='$email'";
        $result = mysqli_query($con, $queryforemail);
        echo "hi".mysqli_num_rows($result);
        if (!$result) {
            echo "Connection failed: " . mysqli_connect_error();
        }
        else{
        if (mysqli_num_rows($result) != 0) {
            $_SESSION['email'] = $email;
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $row['user_id'];
            header("location:/sendotp.php");
            exit;
        } else {
            echo "<script>showerr();</script>";
        }
    }
}
    }

    if(isset($_SESSION['user_id'])&&isset($_SESSION['timestamp'])){
        $user=$_SESSION['user_id'];
   
        $time=$_SESSION['timestamp'];
       
    
    if (isset($_POST['verify'])&&isset($_POST['otp'])) {
        $inputOTP = $_POST['otp'];

        $queryforotp="select * from authenthication where user_id='$user' and timestamp='$time' ";
        $result=mysqli_query($con,$queryforotp);
        if (!$result) {
            
            echo "Query error: " . mysqli_error($con);}
            
        if(mysqli_num_rows($result)!=0){
            $row=mysqli_fetch_assoc($result);
        
        if ($inputOTP==$row['otp'] && $time==$row['timestamp']) {
            
            $query = "select * from users where user_id='$user'";
            $userlist = mysqli_query($con, $query);
            if(!$userlist){
                echo mysqli_error($con);
            }
            $retrieved=mysqli_fetch_assoc($userlist);
            if ($retrieved) {
               
                 header("location:/newpass.php");
                 exit;

                }
            } 
        } 
        else {
            $message='invalidotp';
        }
    }}
    



function showerr(){
    echo "enter a valid email";
}


function displayform1(){?>
<div class="emailchecker">
   <form action="/otp.php" method="post">
      <span>email:</span><input required type="text" name="email"><span id="err"></span><br>
      <input type="submit" name="submit" value="submit">
   </form>
   </div>



<?php }function displayform2(){
    ?>
    <form action="" method="post">
        OTP: <input type="number" name="otp" id="otp"><span><?php if(isset($message)&& $message='invalidotp'){echo"invaliotp";}?></span><br>
        <input type="submit" name="verify" value="Verify"><br><br><br>
    </form>
    
    <button id="resendButton">Resend</button>

    <?php } ?>
    <script>
        if(window.history.replaceState){
            window.history.replaceState(null,null,window.location.href);
        }

        document.getElementById('resendButton').addEventListener('click', function() {
            sendOtp();
        });
        
        
        function sendOtp() {
           window.location.href="/sendotp.php";
        }
        

    // Set a timeout to call the function after 5 minutes (300,000 milliseconds)
         setTimeout(sendOtp, 300000);
         function showerr(){
           var err=document.getElementById("err");
           err.innerHTML="Email doesn't match any account";
           err.style.backgroundColor="red";

         }
    </script>
    </script>

</body>
</html>
