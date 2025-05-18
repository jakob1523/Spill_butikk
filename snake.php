<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Snake</title>
        <link rel="stylesheet" href="spill/sss.css">
        <script src="spill/snake.js"></script>
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
            
            <a href="index.php">Home</a>
            <a href="library.php">Library</a>
            
            
        </div>
    </div>
        </div>

        <div class="flytt">
            <p>Spill fra GitHub bruker ImKennyYip: <a href="https://github.com/ImKennyYip/snake" target="_blank">Github spill</a></p>
        </div>
        <div class="spillet">
            <h1>Snake</h1>
            <canvas id="board"></canvas>
        </div>
        
    
            <p id="snake-score">Score: 0</p>
    
    </body>

    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
        }

        .spillet {
            text-align: center;
        }

        #snake-score {
            display: flex;
            justify-content: center;
            font-size: 20px;
        }

    </style>
</html>
