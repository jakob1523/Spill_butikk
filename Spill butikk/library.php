<link rel="stylesheet" href="style.css" > 
<link rel="stylesheet" href="spill/sss.css" >
<?php
session_start();
include 'db_connect.php';



$stmt = $lenke->prepare("SELECT game FROM owned_games WHERE user_id = ?");
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$result = $stmt->get_result();

$owned_games = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $owned_games[] = $row['game'];
    }
}


$game_details = [];

$stmt = $lenke->prepare("SELECT id, title, description, price, image, release_date, game_url FROM games WHERE title = ?");

foreach ($owned_games as $title) {
    $stmt->bind_param("s", $title);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $game_details[] = $row;
        }
    }
}


?>

<div class="home-header">
        <div class="header-logget">
        <?php
            if (isset($_SESSION['logget']) && $_SESSION['logget'] == TRUE) {
                echo '<p style="font-weight: bold;">Logget inn som: '. $_SESSION["username"]. '</p>';
            }     

        else{
            echo '<p style="font-weight: bold;">Ikke logget inn</p>';
        }
            
            ?>
        </div>
        

        <div class="home-links">
            
            <a href="home.php">Hjem</a>
            <a href="home.php">Se leaderboard</a>
            
            
        </div>
    </div>

    <div class="games-container">
    <?php foreach ($game_details as $row): ?>
            <div class="games-shell">
                <h4><?php echo htmlspecialchars($row['title']); ?></h4>
                
                <div class="games-image">
                    <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                </div>
                <a href="<?php echo $row['game_url']?> "><button class="knapp">Play</button></a>

            </div>
    <?php endforeach; ?>
</div>
    </div>

    <?php

        $stmt = $lenke->prepare("SELECT from_id, to_id, game FROM game_request WHERE to_id = ?");
        $stmt->bind_param("i", $_SESSION['id']);
        $stmt->execute();
        $requests = $stmt->get_result();


        if (isset($_POST['accept'])) {
            $stmt = $lenke->prepare("INSERT INTO owned_games (user_id, game) values (?,?)");
            $stmt->bind_param("is", $_SESSION['id'], $_POST['sent_game']);
            $stmt->execute();

            $stmt = $lenke->prepare("DELETE FROM game_request WHERE from_id = ? AND to_id = ? AND game = ?");
            $stmt->bind_param("iis", $_POST['fromm_id'], $_SESSION['id'], $_POST['sent_game']);
            $stmt->execute();
            header("Refresh:0");
        }

        if (isset($_POST['decline'])) {
            $stmt = $lenke->prepare("DELETE FROM game_request WHERE from_id = ? AND to_id = ? AND game = ?");
            $stmt->bind_param("iis", $_POST['fromm_id'], $_SESSION['id'], $_POST['sent_game']);
            $stmt->execute();

            header("Refresh:0");
        }

        if ($requests->num_rows>0) {
            while ($row = $requests->fetch_assoc()) {
            
                $stmt->prepare("SELECT username FROM brukere WHERE id = ?");
                $stmt->bind_param("i", $row['from_id']);
                $stmt->execute();
                $names = $stmt->get_result();
                $user = $names->fetch_assoc(); 
                
                ?>
            
            <tr>
                
                <td><?php echo $user['username']; ?> gifted you <bold><?php echo $row['game'] ?></bold></td>
                <td>
                    <form method="post" action="">
                        <input type="hidden" name="fromm_id" value="<?php echo $row['from_id']; ?>">
                        <input type="hidden" name="sent_game" value="<?php echo $row['game']; ?>">
                        <input type="submit" name="accept" value="Accept">
                    </form>
                </td>
                
                <td>
                    <form method="post" action="">
                        <input type="hidden" name="fromm_id" value="<?php echo $row['from_id']; ?>">
                        <input type="hidden" name="sent_game" value="<?php echo $row['game']; ?>">
                        <input type="submit" name="decline" value="Decline">
                    </form>
                </td>
                <br>
            
<?php
               }   }

        ?>



