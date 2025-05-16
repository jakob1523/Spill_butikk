<?php
session_start();
$ip_address = $_SERVER['REMOTE_ADDR'];
$_SESSION['autentisert'] = "avvist";
$_SESSION['navn'] = "";

?>
<html><head>
    <title>Login</title>
    
    </head><body>

<h2>Log in.</h2>
<form method="POST" action="">
    <label for="username">Email:</label>
    <input type="text" id="email" name="email" required><br><br>
    <label for="password">Passord:</label>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Login">
</form>

<a href="register.php">
<button>Registrer</button>
</a>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input_email = $_POST['email'];
    $input_password = $_POST['password'];

    include_once("./Db_connect.php");

    $stmt = $lenke->prepare("SELECT id, username, password, email, phone, role, friend_code FROM brukere WHERE email = ?");
    $stmt->bind_param("s", $input_email);
    $stmt->execute();
    $result = $stmt->get_result();

    $mail = null;
    $pass = null;

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $mail = $user['email'];
        $pass = $user['password'];
    }

    if ($mail == $input_email && password_verify($input_password, $pass)) {
        $_SESSION['logget'] = TRUE;
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];       
        $_SESSION['email'] = $user['email'];
        $_SESSION['password'] = $user['password'];       
        $_SESSION['phone'] = $user['phone'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['friend_code'] = $user['friend_code'];
        header("Location: home.php");
        exit();
    } 
    else {
        ?>
        <p>Email eller passord er feil</p>
        <br>
        <a href='login.php'><button>Tilbake</button></a>
        <?php
    }
} else {
    print '</body></html>';
}

?>
