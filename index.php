<?php
include 'db.php';

// Adding a Book
if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    mysqli_query($conn, "INSERT INTO books (title, author, price) VALUES ('$title', '$author', '$price')");
    header("Location: index.php");
}


// Deletion of a Book
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM books WHERE id=$id");
    header("Location: index.php");
}


// Editing a Book
$edit_mode = false;
$edit_id = "";
$edit_title = "";
$edit_author = "";
$edit_price = "";

if (isset($_GET['edit'])) {
    $edit_mode = true;
    $id = $_GET['edit'];
    $result = mysqli_query($conn, "SELECT * FROM books WHERE id=$id");
    $book = mysqli_fetch_assoc($result);
    $edit_id = $book['id'];
    $edit_title = $book['title'];
    $edit_author = $book['author'];
    $edit_price = $book['price'];
}

// Book updatation
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    mysqli_query($conn, "UPDATE books SET title='$title', author='$author', price='$price' WHERE id=$id");
    header("Location: index.php");
}

?>



<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit();
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Online Publication Store</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 80%;
            margin: auto;
        }

        .header,
        .footer {
            background-color: rgb(3, 90, 29);
            color: white;
            padding: 10px;
            text-align: center;
        }

        .form-section,
        .table-section {
            background: white;
            padding: 20px;
            margin-top: 20px;
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="number"] {
            padding: 8px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: rgb(3, 90, 29);
            border: none;
            padding: 10px 20px;
            color: white;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border-bottom: 1px solid #ccc;
            text-align: center;
        }

        a {
            color: rgb(8, 109, 25);
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1 style="display:inline-block;">Online Publication Store</h1>
            <a href="logout.php" style="float:right; color:white; margin-top:10px;">Logout</a> <br>
            <a href="Admin.php" style="float:right; color:white; margin-top:-20px;">←Admin Page</a>

        </div>


        <div class="form-section">
            <h2><?php echo $edit_mode ? "Edit Book" : "Add New Book"; ?></h2>
            <form method="POST">
                <?php if ($edit_mode): ?>
                    <input type="hidden" name="id" value="<?php echo $edit_id; ?>">
                <?php endif; ?>

                <div class="form-group">
                    <label>Title:</label>
                    <input type="text" name="title" value="<?php echo $edit_title; ?>" required>
                </div>
                <div class="form-group">
                    <label>Author:</label>
                    <input type="text" name="author" value="<?php echo $edit_author; ?>">
                </div>
                <div class="form-group">
                    <label>Price:</label>
                    <input type="number" step="0.01" name="price" value="<?php echo $edit_price; ?>">
                </div>

                <input type="submit" name="<?php echo $edit_mode ? "update" : "add"; ?>" value="<?php echo $edit_mode ? "Update Book" : "Add Book"; ?>">
            </form>
        </div>

        <div class="table-section">
            <h2>Book List</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM books");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['title']}</td>
                            <td>{$row['author']}</td>
                            <td>{$row['price']}</td>
                            <td>
                                <a href='?edit={$row['id']}'>Edit</a> |
                                <a href='?delete={$row['id']}' onclick=\"return confirm('Are you sure to delete this book?')\">Delete</a>
                            </td>
                          </tr>";
                }
                ?>
            </table>
        </div>

        <div class="footer">
            <p>&copy; 2025 Online Publication Store</p>
        </div>
    </div>
</body>

</html>