<?php 
session_start();
include "db_connect.php";

?>

<a href="friend.php"><button>Add friend</button></a>
<a href="index.php"><button>Home</button></a>

<?php
$id = $_SESSION['id'];

$stmt = $lenke->prepare("SELECT id, user_id, friend_id FROM friend WHERE user_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

?>

<table>
<tr>
    <th>Friend List</th>
</tr>
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        
        $stmt = $lenke->prepare("SELECT id, username FROM brukere WHERE id = ?");
        $stmt->bind_param("i", $row['friend_id']);
        $stmt->execute();
        $result2 = $stmt->get_result();
        $friend = $result2->fetch_assoc();

        ?>

        <tr>
            <td><?php echo $friend['username']; ?></td>
        </tr>

        <?php



    }
}

?>
</table>
<?php
$stmt = $lenke->prepare("SELECT id, requesting_id, requested_id FROM friend_requests WHERE requested_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
?>

    <table>
        <tr>
            <th>Received requests</th>
            <th></th>
            <th></th>
        </tr>
        <?php
if ($result->num_rows > 0) {  
        while ($row = $result->fetch_assoc()) {
            
            $stmt->prepare("SELECT username FROM brukere WHERE id = ?");
            $stmt->bind_param("i", $row['requesting_id']);
            $stmt->execute();
            $names = $stmt->get_result();
            $user = $names->fetch_assoc(); 
            
            ?>
        
        <tr>
            <td><?php echo $user['username']; ?></td>
            <td>
                <form method="post" action="">
                    <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                    <input type="submit" name="accept" value="Accept">
                </form>
            </td>
            <td>
                <form method="post" action="">
                    <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                    <input type="submit" name="decline" value="Decline">
                </form>
            </td>
        

        <?php
        }

    } else {
        ?>
        <td>No pending requests</td>
    <?php
    }
    ?>
</tr>
    </table>

    <table>
    <tr>
        <th>Sent requests</th>
        <th></th>
    </tr>
    
<?php
$stmt->prepare("SELECT id, requesting_id, requested_id FROM friend_requests WHERE requesting_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$sent = $stmt->get_result();


if ($sent ->num_rows > 0) {
    while ($row = $sent->fetch_assoc()) {
        $stmt->prepare ("SELECT username FROM brukere WHERE id = ?");
        $stmt->bind_param("i", $row['requested_id']);
        $stmt->execute();
        $svar =  $stmt->get_result();
        $navn = $svar->fetch_assoc();

        ?>

        <tr>
            <td><?php echo $navn['username']; ?></td>
            <form method="POST" action="">
            <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
            <td><input type="submit" name="cancel" value="Cancel request"></td>
        </form>

        </tr>

        <?php

    }
    

}
else {
    ?>
    <td>No pending requests</td>
<?php
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cancel'])) {
        $request_id = $_POST['request_id'];

        $stmt = $lenke->prepare("DELETE FROM friend_requests WHERE id = ?");
        $stmt->bind_param("i", $request_id);
        $stmt->execute();
        header("Location: friend_list.php");
        exit();
    }

    if (isset($_POST['decline'])) {
        $request_id = $_POST['request_id'];

        $stmt = $lenke->prepare("DELETE FROM friend_requests WHERE id = ?");
        $stmt->bind_param("i", $request_id);
        $stmt->execute();
        header("Location: friend_list.php");
        exit();
    }

    if (isset($_POST['accept'])) {
        $request_id = $_POST['request_id'];

        $stmt = $lenke->prepare("SELECT requesting_id, requested_id FROM friend_requests WHERE id = ?");
        $stmt->bind_param("i", $request_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $user1 = $row['requesting_id'];
            $user2 = $row['requested_id'];

            $stmt = $lenke->prepare("INSERT INTO friend (user_id, friend_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $user1, $user2);
            $stmt->execute();

            $stmt = $lenke->prepare("INSERT INTO friend (user_id, friend_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $user2, $user1);
            $stmt->execute();

            $stmt = $lenke->prepare("DELETE FROM friend_requests WHERE id = ?");
            $stmt->bind_param("i", $request_id);
            $stmt->execute();
        }

        header("Location: friend_list.php");
        exit();
    }
}




?>
</tr>
</table>