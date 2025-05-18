<?php
session_start();


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stein, saks, papir</title>
    <link rel="stylesheet" href="spill/sss.css">
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
            
            <a href="index.php">Home
            <a href="library.php">Library</a>
            
            
        </div>
    </div>

    <div class="games">
        <div class="game-container">
            <input type="hidden" name="csrf_token" id="csrf_token" value="{{ csrf_token() }}">
            <div class="tittel">
                <h1>Stein, saks, papir</h1>
            </div>
    
            <div class="images-container">
                <img id="valgBilde" class="choice-image" src="spill/s-s-p-bilder/Placeholderr.jpg" alt="User's Choice">
                <p id="resultat"></p>
                <img id="botBilde" class="choice-image" src="spill/s-s-p-bilder/Placeholderr.jpg" alt="Bot's Choice">
            </div>
    
            <div class="scores">
                <p class="score-item" id="scoree">Score: 0</p>
                <p class="score-item" id="high_score">High score: 0</p>
            </div>
    
            <div class="valgg">
                <div class="knap">
                    <button onclick="userChoice(this.id)" id="rock">
                        <img src="spill/s-s-p-bilder/rock.png" alt="rock">
                    </button>
                </div>
                <div class="knap">
                    <button onclick="userChoice(this.id)" id="paper">
                        <img src="spill/s-s-p-bilder/paper.png" alt="paper">
                    </button>
                </div>
                <div class="knap">
                    <button onclick="userChoice(this.id)" id="scissor">
                        <img src="spill/s-s-p-bilder/scissor.png" alt="scissor">
                    </button>
                </div>
            </div>
        </div>
    </div>
   

    <script src="spill/script.js"></script>
</body>
</html>