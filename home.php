<!DOCTYPE html>
<html>
<head>
    <title>Welcome Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right,rgb(164, 254, 137),rgb(96, 216, 49));
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .box {
            background: white;
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }

        .box h1 {
            margin-bottom: 30px;
        }

        .box a {
            display: block;
            margin: 10px auto;
            padding: 10px 20px;
            background-color:rgb(5, 92, 5);
            color: white;
            text-decoration: none;
            border-radius: 6px;
            width: 150px;
        }

        .box a:hover {
            background-color:rgb(0, 179, 30);
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>Choose Login Type</h1>
        <a href="user.php">User</a>
        <a href="admin.php">Admin</a>
    </div>
</body>
</html>
