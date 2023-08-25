<?php


function createUser($username, $name, $email, $password, $role) {
    global $con;
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (user_name, name, email, password, role, status) VALUES ('$username', '$name', '$email', '$hashedPassword', '$role', 'active')";
    return mysqli_query($con, $sql);
}


function updateUser($id, $username, $email, $role) {
    global $con;
    $sql = "UPDATE users SET username = '$username', email = '$email', role = '$role' WHERE id = $id";
    return mysqli_query($con, $sql);
}


function getStatus($id) {
    global $con;
    $sql = "SELECT status FROM users WHERE user_id = $id";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['status'];
    } else {
        return false;
    }
}

function updateStatus($id, $newStatus) {
    global $con;
    $sql = "UPDATE users SET status = '$newStatus' WHERE user_id = $id";
    return mysqli_query($con, $sql);
}
?>


