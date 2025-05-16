<?php 
session_start();
include 'db_connect.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['friend'])) {

       
        $game_name = $_POST['game_name'];
        $game_price = $_POST['game_price'];



        $stmt = $lenke->prepare("SELECT friend_id FROM friend WHERE user_id = ?");
        $stmt->bind_param("i", $_SESSION['id']);
        $stmt->execute();
        $result = $stmt->get_result();

        $user_stmt = $lenke->prepare("SELECT username FROM brukere WHERE id = ?");
        
        echo '
        <p>What friend do you want to gift '. $game_name .' to?</p>

        <form action="" method="POST">
            <input type="hidden" name="game_name" value="'. $game_name .'">>
            <input type="hidden" name="game_price" value="'.$game_price.'">

            <select name="friend" id="">
        ';
        
                while ($row = $result->fetch_assoc()) {
                    $friend_id = $row['friend_id'];

                    $user_stmt->bind_param("i", $friend_id);
                    $user_stmt->execute();
                    $user_result = $user_stmt->get_result();
                    $user = $user_result->fetch_assoc();

                    if ($user) {
                        echo '<option value="' . $friend_id . '">' . $user['username'] . '</option>';
                    }
                }
                ?>
            </select>

            <button type="submit">Send gift request</button>
        </form>

        <?php
    }

    if (isset($_POST['friend'])) {

        $game_name = $_POST['game_name'];
        $game_price = $_POST['game_price'];
        $game_price_form = number_format((float)$game_price, 2, '.', '');

        $stmt = $lenke->prepare("INSERT INTO game_request (from_id, to_id, game) values (?,?,?)");
        $stmt->bind_param("iis", $_SESSION['id'], $_POST['friend'], $game_name);
        $stmt->execute();

        $type = 'gift';

        $stmt = $lenke->prepare("INSERT INTO transactions (user_id, type, belop, referance) values (?,?,?,?)");
        $stmt->bind_param("isds", $_SESSION['id'], $type, $game_price_form, $game_name);
        $stmt->execute();


?>
        <p>Gift request sucsesfull.</p>
        <a href="home.php"><button>Home</button></a>
        <?php

    }
    
}


else {
    header('Location: home.php');
}

?>