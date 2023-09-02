<html>
    <head>
        <title>solved issues</title>
        <link rel="stylesheet" href="popupstyle.css">
    </head>

    <body>
    <h1>SOLVED ISSUES</h1>

    <table id="complaint" >

    <tr>

            <th>USER_NAME</th>
            <th>LOCATION</th>
            <th>TYPE</th>
            <th>ISSUE</th>
            <th>DATE_REGISTERED</th>
            <th>DATE_SOLVED</th>
            <th>COMMENTS</th>
            <th>RESOLVED_BY</th>

        </tr>

        <?php


            include('connection.php');


            $query = "SELECT resolved_id,r.issue_id,u.user_name,c.contact,c.location,c.type,c.issue,c.date,date_solved,c.serial,r.comments,r.resolved_by
            from complaints as c , resolved_complaints as r , users as u
            where c.issue_id=r.issue_id and u.user_id=r.user_id";


            $result = mysqli_query($con,$query);

            while($row = mysqli_fetch_assoc($result)){
                ?>


    <tr>

                <td><?php echo $row["user_name"]."<br>"; ?></td>
                <td><?php echo $row["location"]."<br>"; ?></td>
                <td> <?php echo $row["type"]."<br>"; ?></td>
                <td><?php echo $row["issue"]."<br>"; ?></td>
                <td><?php echo $row["date"]."<br>"; ?></td>
                <td><?php echo $row["date_solved"]."<br>"; ?></td>
                <td><?php echo $row["comments"]."<br>"."<br>"; ?></td>
                <td><?php echo $row["resolved_by"]."<br>"."<br>"; ?></td>
            </tr>

        <?php
            }

        ?>

        </table>




</body>
</html>