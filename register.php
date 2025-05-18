<?php

?>

<form method="POST">
    <input type="text" name="input1" placeholder="Username"><br>
    <input type="text" name="input2" placeholder="E-mail"><br>
    <input type="password" name="input3" placeholder="Passord"><br>
    <p>Phone number not required</p>
    <input type="text" name="input4" placeholder="Telefon nummer"><br>
    <input type="submit" value="Register">
</form>

<a href="login.php">
    <button>login</button>
</a>
<br>

<?php





$inputs = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    $friend_code = rand(10000000000, 19999999999);

    for ($i = 1; $i <= 4; $i++) {
        $inputs[] = isset($_POST["input$i"]) ? $_POST["input$i"] : '';
    }

    $inputs[] = isset($_POST["input7"]) ? 1 : 0;

    $hash = password_hash($inputs[2], PASSWORD_DEFAULT);

    include("./Db_connect.php");

    $sql = "INSERT INTO brukere (username, email, password, phone, friend_code) 
            VALUES ('$inputs[0]', '$inputs[1]', '$hash', '$inputs[3]', '$friend_code')";

    if (mysqli_query($lenke, $sql)) {
        header("Location: login.php");
    } else {
        echo "Error: " . mysqli_error($lenke);
    }
    mysqli_close($lenke);
}
print '<html><head>
    <link rel="stylesheet" href="style.css">
    </head><body>';
?>