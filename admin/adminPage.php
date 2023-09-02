<html>
    <head>
        <title> pop
        </title>
        <link rel = "stylesheet" href="popupstyle.css" >
    </head>
    <body>
    <?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    include('connection.php');
    if(isset($_POST["comment"]) && isset($_POST["name"]) ){
        $comment = $_POST["comment"];
        $name =$_POST["name"];


    $query = "SELECT * from complaints where issue_id=$id";

        $result = mysqli_query($con,$query);

        while($row = mysqli_fetch_assoc($result)){
            $issue_id = $row['issue_id'];
            $user_id = $row['user_id'];

            $date = date('Y-m-d');
            $queryinsert = "INSERT into resolved_complaints (issue_id,user_id,date_solved,comments,resolved_by) values('$issue_id','$user_id','$date','$comment','$name')";

            $result2 = mysqli_query($con,$queryinsert);

            if(!($result2)){
                echo mysqli_error($con);
            }



            $queryupdate = "UPDATE complaints set status='resolved' where issue_id='$id'";
            $resultupdate = mysqli_query($con,$queryupdate);

            if(!($resultupdate)){
               echo mysqli_error($con);
            }
        }
        $urlWithoutId = strtok($_SERVER['REQUEST_URI'], '?');
        // Redirect to the URL without the "id" parameter
        header("Location: $urlWithoutId");
    }
}

?>

        <div class="container" id="blur">
            <div class="content">
                <h1>COMPLAINTS TO CHECK</h1>
                <table id="complaint" >
        <tr>

            <th>USER_NAME</th>
            <th>CONTACT</th>
            <th>LOCATION</th>
            <th>TYPE</th>
            <th>DATE</th>
            <th>ISSUE</th>
            <th style="text-align:center;">MARK_COMPLETE</th>

        </tr>

        <?php


            include('connection.php');

            $query = "SELECT * from complaints where status='unresolved'";
            $result = mysqli_query($con,$query);

            while($row = mysqli_fetch_assoc($result)){
                $id = $row['issue_id'];
                ?>

            <tr>
                <td><?php echo $row['username'] ?></td>
                <td><?php echo $row["contact"]; ?></td>
                <td><?php echo $row["location"]; ?></td>
                <td><?php echo $row["type"]; ?></td>
                <td><?php echo $row["date"]; ?></td>
                <td ><?php echo $row["issue"]; ?></td>


                <td style="text-align:center;"><button class="button" onclick="toggle()">Completed</button></td>
            </tr>

            <?php } ?>
            </table>
                <br>
                <a href="addhistory.php">view resolved issues</a>
            </div>
        </div>
            <div id="popup">
                <form method="post" action="adminPage.php?id=<?php echo $id?>">
                <h1>ADD COMMENT</h1>
                <label for="name">Resolved by</label><br>
                <input type="text" name="name" value="" required>
                <label for="cmt">Comment of issue</label><br>
                <textarea name= "comment" id="cmt" required></textarea> <br><br>
                <input type="submit" class="btn" name="submit" value="ADD">
                </form>
            </div>
        <script type="text/javascript">
        function toggle(){
            var blur = document.getElementById('blur');
            blur.classList.toggle('active');
            var popup = document.getElementById('popup');
            popup.classList.toggle('active');
        }
    </script>
    </body>
</html>