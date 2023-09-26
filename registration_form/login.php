<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $host = "localhost:3306";
    $user = "root";
    $db_password = "root";
    $name = "php";
    
    $conn = new mysqli($host, $user, $db_password, $name);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = $_POST["password"];
    
    $sql = "SELECT f_name, pass FROM register WHERE f_name='$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["pass"])) {
            echo "Login successful! Welcome, " . $row["f_name"];
        } else {
            echo "Incorrect password. Please try again.";
        }
    } else {
        echo "User not found. Please register first.";
    }
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<center>
<body>
    <h2>Login</h2>
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>
</body>
</center>
</html>
