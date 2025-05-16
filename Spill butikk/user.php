<?php
session_start();


if (isset($_SESSION['logget'])) {
    
    echo "Id: ";
    echo $_SESSION['id'];
    echo "<br>";
    echo "<br>"; 
    echo "Username: "; 
    echo $_SESSION['username'];  
    echo "<br>";   
    echo "<br>"; 
    echo "Email: ";
    echo $_SESSION['email'];
    echo "<br>";
    echo "<br>"; 
    echo "Phone: "; 
    echo $_SESSION['phone'];
    echo "<br>";
    echo "<br>";
    echo "Friend code: ";  
    echo $_SESSION['friend_code'];


}


?>
<br>
<a href="home.php"><button>Home</button></a>