<link rel="stylesheet" href="spill/sss.css" >
<link rel="stylesheet" href="style.css" >

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
    
    <a href="index.php">Hjem</a>
    <a href="store.php">Store</a>
    <a href="library.php">Library</a>
    <a href="friend_list.php">Friends</a>
          
</div>
<div class="header-links">
    <a href="user.php">User</a>
    <a href="logout.php">Logout</a>
</div>
</div>
<?php



    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_start();
        include 'db_connect.php';

        $game_id = $_POST['game_id'];

        $stmt = $lenke->prepare("SELECT id, title, description, price, image, release_date FROM games WHERE id = ?");
        $stmt->bind_param("i", $game_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $game = $result->fetch_assoc();
            $_SESSION['game_id'] = $game['id'];
            ?>
            <div class="game-page">
                <h1><?php echo $game['title'] ?></h1>
                <img src="<?php echo $game['image'] ?>" alt="<?php echo $game['title'] ?>">
                <p><?php echo $game['description'] ?></p>
                <p>Price: $<?php echo $game['price'] ?></p>
                <p>Release Date: <?php echo $game['release_date'] ?></p>
                <form action="checkout.php" method="POST">
                    <input type="hidden" name="game_name" value="<?php echo $game['title'] ?>">
                    <input type="hidden" name="game_id" value="<?php echo $game['id'] ?>">
                    <input type="hidden" name="game_price" value="<?php echo $game['price'] ?>">
                    <button>
                        Checkout
                    </button>
                </form>
                <form action="gift.php" method="POST">
                    <input type="hidden" name="game_name" value="<?php echo $game['title'] ?>">
                    <input type="hidden" name="game_price" value="<?php echo $game['price'] ?>">
                    <button>Gift to friend</button>
                </form>
            </div>
            

            <?php
        }}
    
        else {
            header("Location: store.php");
        }

        ?>

        

    