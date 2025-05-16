<?php
include 'db_connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['purchased']) && $_POST['purchased'] == 1) {
        $game_name = $_POST['game_title'];
        $game_price = $_POST['price'];

        if (!is_numeric($game_price)) {
            echo 'Invalid price value.';
            exit;
        }

        
        $formatted_price = number_format((float)$game_price, 2, '.', '');

        echo 'Purchase successful!
        <br>
        <a href="home.php"><button>Home</button></a>';

        $stmt = $lenke->prepare('INSERT INTO owned_games (user_id, game) VALUES (?, ?)');
        $stmt->bind_param("is", $_SESSION['id'], $game_name);
        $stmt->execute();

        $stmt = $lenke->prepare('INSERT INTO transactions (user_id, type, belop, referance) VALUES (?,?,?,?)');
        $stmt->bind_param('isds', $_SESSION['id'], $type, $formatted_price, $game_name);

        $type = 'Game Purchase';
        $stmt->execute();
    }


    if (!isset($_POST['purchased'])) {
        $game_id = $_POST['game_id'];
        $game_name = $_POST['game_name'];
        $game_price = $_POST['game_price'];

        echo 'Do you want to buy ' . $game_name . ' for $' . $game_price . '?
        <form action="checkout.php" method="POST">
            <input type="hidden" name="purchased" value="1">   
            <input type="hidden" name="game_title" value="'. $game_name . '">
            <input type="hidden" name="price" value="'. $game_price . '">
            <button type="submit" style="background-color: limegreen;">
                Purchase
            </button>
        </form>
        <a href="home.php"><button>home</button></a>';
    }
    
} 

else {
    header("Location: home.php");
}

?>