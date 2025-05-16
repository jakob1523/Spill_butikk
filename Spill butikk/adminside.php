<?php
session_start();

if ($_SESSION['role'] !== 'admin') {
    echo "Du er ikke admin.";
    exit();
}

include("./db_connect.php");

$sql = "SELECT id, username, email, phone, role FROM brukere";
$result = mysqli_query($lenke, $sql);

if (!$result) {
    die("Error retrieving users: " . mysqli_error($lenke));
}

?>
<head>

<link rel="stylesheet" src="style.css">

</head>
<body>
<div width="900px">
    <h1>Admin Page - User List</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Delete</th>
        </tr>

        <?php

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "
        <tr>
            <td>{$row['id']}</td>
            <td>{$row['username']}</td>
            <td>{$row['email']}</td>
            <td>{$row['phone']}</td>
            <td>{$row['role']}</td>
            <td>
            <form action='delete.php' method='POST'>
            <input type='hidden' name='id' value='{$row['id']}'>
            <input type='submit' value='Delete'>
            </form>
            </td>
        </tr>
        ";
            }
        } else {
            echo "
    <p>Ingen brukere</p>
    ";
        }

        echo '
    </table>
    </div>';


        mysqli_close($lenke);
        print '<html><head>
    <link rel="stylesheet" href="style.css">
    </head><body>';
        ?>


        <a href="home.php">
            <button>Hjem</button>
        </a>