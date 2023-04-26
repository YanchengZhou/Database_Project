<?php
    require("connect-db.php");
    global $db;

    session_start();
    if(isset($_SESSION["userID"]) && isset($_SESSION["email"]) && isset($_SESSION["name"])) {
        echo "logged in as " . $_SESSION["name"]. " userID: " . $_SESSION["userID"]
            . " email: ". $_SESSION["email"];
        $userId = $_SESSION["userID"];
    } else {
        echo "You have not logged in";
    }

    $used_items_sql = "select * from Posts natural join Used_item_post";
    $used_items_result = $db->query($used_items_sql);

    function makeAlert($message) {
        echo "<script>
                            alert('$message')
                  </script>";
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(!empty($_POST['collectionbutton']) && ($_POST['collectionbutton'] == "collection")) {
            if(isset($_SESSION["userID"]) && isset($_SESSION["email"]) && isset($_SESSION["name"])) {
                $collection_id = $_POST['collection_item'];
                $userId = $_SESSION["userID"];
                $query = "INSERT INTO Collection (userID, postID) VALUES (:userId, :postId)";
                $statement = $db->prepare($query);
                $statement->bindValue(':userId', $userId);
                $statement->bindValue(':postId', $collection_id);
                $statement->execute();
                makeAlert("Add to collection succesfully");
            }
            else {
                makeAlert("Please log in to add collections");
            }

        }
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

<form action="index.php" method="get">
    <input type="text" name="query" placeholder="Search...">
    <button type="submit">Search</button>
</form>

<h1> Used Item Posts </h1>
<br>

<div style="display: flex; flex-wrap: wrap;">
<?php
    // Check if a search query has been submitted
    if (isset($_GET['query']) && !empty($_GET['query'])) {
    // Get the user's search query
    $query = $_GET['query'];

    // Search the database for records with a name that matches the search query
    $sql1 = "SELECT * FROM Posts NATURAL JOIN Used_item_post WHERE name LIKE '%$query%'";
    $result1 = $db->query($sql1);
    while ($row = $result1->fetch(PDO::FETCH_ASSOC)) {
    // Display the item using the same HTML structure as before?>
<<<<<<< HEAD
    <div class="card" style="width: 18rem;">
        <img src="placeholder.jpg" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?php echo $row['name']; ?></h5>
            <p>Post Time: <?php echo $row['post_time']; ?></p>
            <p>Price: <?php echo $row['price']; ?></p>
            <p>State: <?php echo $row['state']; ?></p>
            <p>Notes: <?php echo $row['notes']; ?></p>
            <p>UserID: <?php echo $row['userID']; ?></p>
            <p>Item Type: <?php echo $row['item_type']; ?></p>
            <p>Brand: <?php echo $row['brand']; ?></p>
            <p>Used Time: <?php echo $row['used_time']; ?></p>
            <form method="post">
                <input type="hidden" name="collection_item" value="<?php echo $row['id'] ?>">
                <a href="#" class="btn btn-primary">view more</a>
                <button name="collectionbutton" value="collection" class="btn btn-primary">Add to Collection</button>
            </form>
=======

        <div class="card" style="width: 18rem;">
            <img src="placeholder.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?php echo $row['name']; ?></h5>
                <p>Post Time: <?php echo $row['post_time']; ?></p>
                <p>Price: <?php echo $row['price']; ?></p>
                <p>State: <?php echo $row['state']; ?></p>
                <p>Notes: <?php echo $row['notes']; ?></p>
                <p>UserID: <?php echo $row['userID']; ?></p>
                <p>Item Type: <?php echo $row['item_type']; ?></p>
                <p>Brand: <?php echo $row['brand']; ?></p>
                <p>Used Time: <?php echo $row['used_time']; ?></p>
                <a href="#" class="btn btn-primary">view more</a>
            </div>
>>>>>>> 818e148cdf922ae13466f38e095a2b48c1ef2e8f
        </div>

    <?php }
    }else{?>
        <?php while($row = $used_items_result->fetch(PDO::FETCH_ASSOC)) { ?>

        <div class="card" style="width: 18rem;">
            <img src="placeholder.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?php echo $row['name']; ?></h5>
                <p>Post Time: <?php echo $row['post_time']; ?></p>
                <p>Price: <?php echo $row['price']; ?></p>
                <p>State: <?php echo $row['state']; ?></p>
                <p>Notes: <?php echo $row['notes']; ?></p>
                <p>UserID: <?php echo $row['userID']; ?></p>
                <p>Item Type: <?php echo $row['item_type']; ?></p>
                <p>Brand: <?php echo $row['brand']; ?></p>
                <p>Used Time: <?php echo $row['used_time']; ?></p>
                <form method="post">
                    <input type="hidden" name="collection_item" value="<?php echo $row['id'] ?>">
                    <a href="#" class="btn btn-primary">view more</a>
                    <button name="collectionbutton" value="collection" class="btn btn-primary">Add to Collection</button>
                </form>
            </div>
        </div>

    <?php } ?>
<?php } ?>
</div>
</body>
</html>