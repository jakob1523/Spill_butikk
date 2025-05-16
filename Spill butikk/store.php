<link rel="stylesheet" href="style.css" > 
<link rel="stylesheet" href="spill/sss.css" >
<?php
session_start();
include 'db_connect.php';

$stmt = $lenke->prepare("SELECT id, title, description, price, image, release_date FROM games;");
$stmt->execute();
$result = $stmt->get_result();

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
    <?php while ($row = $result->fetch_assoc()): ?>
        <form action="game_page.php" method="POST">
        
        <div class="games-shell">
            <h4><?php echo $row['title'] ?></h4>
            <div class="games-image">
                <img src="<?php echo $row['image'] ?>" alt="<?php echo $row['title'] ?>">
            </div>
            <p class="price">$<?php echo $row['price'] ?></p>
            <input type="hidden" name="game_id" value="<?php echo $row['id'] ?>">
            <button type="submit" class="knapp">Check out</button>
        </div>
        
    </form>
    <?php endwhile; ?>
    </div>



