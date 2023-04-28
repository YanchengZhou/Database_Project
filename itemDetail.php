<?php
function getComments($itemId){
    global $db;
    $queryComment = "SELECT * FROM Comment NATURAL JOIN User WHERE postID = :postID";
    $stmtComment = $db->prepare($queryComment);
    $stmtComment->bindValue(':postID', $itemId);
    $stmtComment->execute();
    return $stmtComment->fetchAll(PDO::FETCH_ASSOC);
}
?>

<?php
    require("connect-db.php");
    global $db;

    session_start();
    if(isset($_SESSION["userID"]) && isset($_SESSION["email"]) && isset($_SESSION["name"])) {
        echo "logged in as " . $_SESSION["name"]. " userID: " . $_SESSION["userID"]
            . " email: ". $_SESSION["email"];
        $userId = $_SESSION["userID"];
    } else {
        $userID = null;
        echo "You have not logged in";
    }

    // Retrieve the item ID from the URL parameter
    $itemId = $_GET['id'];
    echo "itemID:" . $itemId ;
    // Query the database to get the item details based on the ID
    $query = "SELECT * FROM Posts NATURAL JOIN Used_item_post WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $itemId);
    $statement->execute();
    $item = $statement->fetch(PDO::FETCH_ASSOC);
//    $queryComment = "SELECT * FROM Comment NATURAL JOIN User WHERE postID = :postID";
//    $stmtComment = $db->prepare($queryComment);
//    $stmtComment->bindValue(':postID', $itemId);
//    $stmtComment->execute();
    $comments = getComments($itemId);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['comment'])){
        $content = $_POST['comment'];
        $itemId = $_POST['id'];
        if($_POST["submit"] == "Submit"){
            $currentDate = date('Y-m-d');
            $userID = $_SESSION["userID"];
            $postID = $itemId;
            $insertQuery = "INSERT INTO Comment (userID, postID, comment_time, content) VALUES (:userID, :postID, :comment_time, :content)";
            $insertStmt = $db->prepare($insertQuery);
            $insertStmt->bindValue(':userID', $userID);
            $insertStmt->bindValue(':postID', $postID);
            $insertStmt->bindValue(':comment_time', $currentDate);
            $insertStmt->bindValue(':content', $content);
            $insertStmt->execute();
            $insertStmt->closeCursor();
        }
    }else if(!empty($_POST['submit'])&&$_POST['submit'] == "Delete"){
            $comment_to_delete = $_POST['comment_to_delete'];
            $query = "delete from Comment where userID = :comment_to_delete";
            $stmt = $db->prepare($query);
            $stmt->bindParam('comment_to_delete', $comment_to_delete);
            $stmt->execute();
            $stmt->closeCursor();
    }else{
        echo "<script>alert('Nothing is entered');</script>";
    }

    $comments = getComments($itemId);
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
<?php include 'navbar.php'; ?>

    <!-- Display the item details -->
    <h1><?php echo $item['name']; ?></h1>
    <p>Post Time: <?php echo $item['post_time']; ?></p>
    <p>Price: <?php echo $item['price']; ?></p>
    <p>State: <?php echo $item['state']; ?></p>
    <p>Notes: <?php echo $item['notes']; ?></p>
    <p>UserID: <?php echo $item['userID']; ?></p>
    <p>Item Type: <?php echo $item['item_type']; ?></p>
    <p>Brand: <?php echo $item['brand']; ?></p>
    <p>Used Time: <?php echo $item['used_time']; ?></p>

    <form action="itemDetail.php?id=<?php echo $itemId; ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $itemId; ?>">
        <label for="comment">Leave a comment:</label><br>
        <textarea id="comment" name="comment" rows="4" cols="50"></textarea><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <div class="comments">
        <h2>Comments</h2>
        <ul>
            <!-- Loop through comments -->
            <?php if(!$comments){
                echo "Wow, such empty, enter your first comments";
            }else{
                foreach ($comments as $comment): ?>
                    <li>
                        <h4><?php echo $comment['name'];?></h4>
                        <small><?php echo $comment['comment_time']; ?></small>
                        <p><?php echo $comment['content']?></p>
                        <?php
                        // Check if the comment was posted by the current user
                        if ($comment['userID'] == $userId) { ?>
                            <form action="itemDetail.php?id=<?php echo $itemId; ?>" method = "post">
                                <input type="submit" name="submit" value="Delete"/>
                                <input type="hidden" name="comment_to_delete"
                                       value="<?php echo $comment['userID']; ?>" />
                            </form>
<!--                            echo "<button>Delete</button>";-->
                        <?php }
                        ?>
                    </li>
                <?php endforeach;
            }
            ?>
        </ul>
    </div>
</body>
</html>
