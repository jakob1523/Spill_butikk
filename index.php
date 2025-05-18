<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="spill/sss.css" >
</head>
<body>
    
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
if (!isset($_SESSION['logget'])) {
    ?>

    <h3>Log in to use GamePlace</h3>
    <a href="login.php"><button>login</button></a>
    <a href="register.php"><button>register</button></a>
    
    <?php
}

if (isset($_SESSION['logget']) && $_SESSION['logget'] == TRUE) {
    ?>

    <h3>Hello  <?php echo $_SESSION['username']; ?></h3>
    <a href="logout.php"><button>Logout</button></a>

    <a href="user.php"><button>User</button></a>

    <a href="store.php"><button>Store</button></a>

    <a href="index.php"><button>Library</button></a>

    <a href="friend_list.php"><button>Friends</button></a>

    <a href="faq.php"><button>Faq</button></a>


    <?php
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        ?>
        <a href="adminside.php"><button>Admin</button></a>
        <br>
        <div>
            <p>Games for admin:</p>
            <br>
            <a href="spill.php"><button>sss</button></a>
            <a href="snake.php"><button>snake</button></a>
            <a href="flappy.php"><button>flappy</button></a>
        </div>
        
        <?php
    }
}



?>
    <script src="script.js"></script>
</body>
</html>