<?php
session_start();
include 'db.php';

$error = "";
$success = "";

                                        // registration
if (isset($_POST['register'])) {
    $reg_username = $_POST['reg_username'];
    $reg_password = $_POST['reg_password'];

                    // checking if user already exists
    $check_user = mysqli_query($conn, "SELECT * FROM users WHERE username='$reg_username'");
    if (mysqli_num_rows($check_user) > 0) {
        $error = "Username already exists!";
    } else {
                                             //  new user 
        mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$reg_username', '$reg_password')");
        $success = "User registered successfully!";
    }
}

                            //  login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($query) == 1) {
        $_SESSION['user'] = $username;
    } else {
        $error = "Invalid login credentials!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Login & Books</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #d4fc79, #96e6a1);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        input[type="text"],
        input[type="password"] {
            padding: 10px;
            width: 100%;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: rgb(3, 90, 29);
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .error {
            color: red;
            text-align: center;
        }

        .success {
            color: green;
            text-align: center;
        }

        .logout {
            text-align: center;
            margin-top: 20px;
        }

        .logout a {
            text-decoration: none;
            color: red;
        }
    </style>
</head>

<body>
    <div style="position: absolute; top: 10px; right: 10px;">
        <a href="home.php" style="text-decoration: none; color:rgb(3, 90, 29); font-weight: bold;">
            ← Back to Home
        </a>
    </div>

    <div class="container">

        <?php if (!isset($_SESSION['user'])): ?>
            <h2>User Login</h2>
            <p>Please login or register to view available books.</p>
            <form method="POST">
                <input type="text" name="username" placeholder="Enter Username" required>
                <input type="password" name="password" placeholder="Enter Password" required>
                <input type="submit" name="login" value="Login">
            </form>

            <h2>New User? Register Below</h2>
            <form method="POST">
                <input type="text" name="reg_username" placeholder="Create Username" required>
                <input type="password" name="reg_password" placeholder="Create Password" required>
                <input type="submit" name="register" value="Register">
            </form>

            <?php
            if ($error) echo "<p class='error'>$error</p>";
            if ($success) echo "<p class='success'>$success</p>";
            ?>
        <?php else: ?>
            <h2>Available Books</h2>
            <table>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Price</th>
                </tr>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM books");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['title']}</td>
                            <td>{$row['author']}</td>
                            <td>{$row['price']}</td>
                          </tr>";
                }
                ?>
            </table>
            <div class="logout">
                <p><a href="logout.php">Logout</a></p>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>