<?php
session_start();
include("./db_connect.php");



?>

<p>Your friend code: <?php echo $_SESSION['friend_code']; ?></p>

<form action="" method="POST">

<label for="text">Write friend code</label>
<input type="text" name="friend_code" placeholder="Friend_code">

<input type="submit" value="Send request" name="send_request">

<br>

</form>

<a href="friend_list.php"><button>Friends</button></a>
<a href="index.php"><button>Home</button></a>

<br>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $friend_code = $_POST['friend_code'];
    $requesting_id = $_SESSION['id'];
    
    if ($friend_code != $_SESSION['friend_code'] && $friend_code != 0 && !empty($friend_code)) {

        $stmt = $lenke->prepare("SELECT id FROM brukere WHERE friend_code = ?");
        $stmt->bind_param("i", $friend_code);
        $stmt->execute();
        $result = $stmt->get_result();



        if ($row = $result->fetch_assoc()) {

            if (!$row['id']) {
                echo "Error sending friend request";
            }
            

            else {
                $friend_id = $row['id'];
                $stmt = $lenke->prepare("SELECT id FROM friend_requests WHERE requesting_id = (?) and requested_id = (?)");
                $stmt->bind_param("ii", $requesting_id, $friend_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows == 0) {

                    $stmt = $lenke->prepare("INSERT INTO friend_requests (requesting_id, requested_id) VALUES (?,?)");
                    $stmt->bind_param("ii", $requesting_id, $friend_id);
        
                    if ($stmt->execute()) {
                        echo "Friend request successfully sent!";
                    }
            }
            
                
            else {
                echo "You have already sent a request.";
                    }
        }
  
    }    

    }
    elseif ($friend_code == $_SESSION['friend_code']){
        echo "You can't send a friend request to yourself.";
    }
    else {
        echo"You need to input a friend code";
    }

}

?>
