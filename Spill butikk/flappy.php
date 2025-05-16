<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FlappyBird</title>
    <link rel="stylesheet" href="spill/sss.css" > 
    <link href="https://fonts.googleapis.com/css?family=Squada+One&display=swap" rel="stylesheet">
</head>
<body>

    <input type="hidden" name="csrf_token" id="csrf_token" value="{{ csrf_token() }}">


    <div class="home-header">
        <div class="header-logget">
        <?php
        session_start();
            if (isset($_SESSION['logget']) && $_SESSION['logget'] == TRUE) {
                echo '<p style="font-weight: bold;">Logget inn som: '. $_SESSION["username"]. '</p>';
            }
            
            

        else{
            echo '<p style="font-weight: bold;">Ikke logget inn</p>';
        }
            
            ?>
        </div>
        

        <div class="home-links">
            
            <a href="home.php">Home</a>
            <a href="library.php">Library</a>
            
            
        </div>
    </div>
        </div>

    <div class="flytt">
        <p>Spill fra GitHub bruker aaarafat: <a href="https://github.com/aaarafat/JS-Flappy-Bird" target="_blank">Github spill</a></p>
    </div>

    <div>
    <h1 style="text-align: center;">Flappy Bird</h1>
    <canvas id="canvas" width="276" height="414"></canvas>
    <script src="spill/flappy.js"></script>
    </div>

</body>
</html>