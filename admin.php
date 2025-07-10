<?php
session_start();
include 'db.php';

$error = "";
$success = "";

                        // registration 
if (isset($_POST['register'])) {
    $reg_username = $_POST['reg_username'];
    $reg_password = $_POST['reg_password'];

             // Checking if admin already exists
    $check = mysqli_query($conn, "SELECT * FROM admin WHERE username='$reg_username'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Admin already exists!";
    } else {
        mysqli_query($conn, "INSERT INTO admin (username, password) VALUES ('$reg_username', '$reg_password')");
        $success = "Admin registered successfully!";
    }
}

                                // Admin login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($query) == 1) {
        $_SESSION['admin'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid login credentials!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #d4fc79, #96e6a1);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-box {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            width: 350px;
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 20px;
            color: rgb(0, 0, 0);
        }

        .login-box label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .login-box input[type="text"],
        .login-box input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .login-box input[type="submit"] {
            background-color: rgb(3, 90, 29);
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .login-box input[type="submit"]:hover {
            background-color: rgb(3, 90, 29);
        }

        .error {
            color: red;
            text-align: center;
        }

        .success {
            color: green;
            text-align: center;
        }


    </style>
</head>

<body>
    <div class="login-box">
        <h2>Admin Login</h2>
        <form method="POST">
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <input type="submit" name="login" value="Login">
        </form>

        <h2 style="font-size: 18px; margin-top: 30px;">Register New Admin</h2>
        <form method="POST">
            <input type="text" name="reg_username" placeholder="Create Admin Username" required>
            <input type="password" name="reg_password" placeholder="Create Admin Password" required>
            <input type="submit" name="register" value="Register">
        </form>

        <?php
        if ($error) echo "<p class='error'>$error</p>";
        if ($success) echo "<p class='success'>$success</p>";
        ?>
    </div>
</body>

</html>