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

$carpooling_sql = "select * from Posts natural join Carpooling_post";
$carpooling_result = $db->query($carpooling_sql);

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

<form action="carpooling.php" method="get">
    <input type="text" name="query" placeholder="Search...">
    <button type="submit">Search</button>
</form>

<h1> Carpooling Posts </h1>
<br>

<div style="display: flex; flex-wrap: wrap;">
<?php
// Check if a search query has been submitted
if (isset($_GET['query']) && !empty($_GET['query'])) {
    // Get the user's search query
    $query = $_GET['query'];

    // Search the database for records with a name that matches the search query
    $sql3 = "SELECT * FROM Posts NATURAL JOIN Carpooling_post WHERE name LIKE '%$query%'";
    $result3 = $db->query($sql3);
    while ($row = $result3->fetch(PDO::FETCH_ASSOC)) {
        // Display the item using the same HTML structure as before?>
    <div style="display: flex; flex-wrap: wrap;">
        <div class="card" style="width: 18rem;">
            <?php echo displayImageFromDatabase($row['id']); ?>
            <div class="card-body">
                <h5 class="card-title"><?php echo $row['name']; ?></h5>
                <p>Post Time: <?php echo $row['post_time']; ?></p>
                <p>Price: <?php echo $row['price']; ?></p>
                <p>State: <?php echo $row['state']; ?></p>
                <p>Notes: <?php echo $row['notes']; ?></p>
                <p>UserID: <?php echo $row['userID']; ?></p>
                <p>Start Location: <?php echo $row['start_location']; ?></p>
                <p>Destination: <?php echo $row['destination']; ?></p>
                <p>Car Color: <?php echo $row['car_color']; ?></p>
                <p>Model: <?php echo $row['car_model']; ?></p>
                <p>License: <?php echo $row['car_license']; ?></p>
                <p>Driver: <?php echo $row['driver']; ?></p>
                <a href="itemDetail.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">view more</a>
                <form method="post">
                    <input type="hidden" name="collection_item" value="<?php echo $row['id'] ?>">
                    <button name="collectionbutton" value="collection" class="btn btn-primary">Add to Collection</button>
                </form>
            </div>
        </div>
    </div>
    <?php }
}else{?>
    <?php while($row = $carpooling_result->fetch(PDO::FETCH_ASSOC)) { ?>
    <div style="display: flex; flex-wrap: wrap;">
        <div class="card" style="width: 18rem;">
            <?php echo displayImageFromDatabase($row['id']); ?>
            <div class="card-body">
                <h5 class="card-title"><?php echo $row['name']; ?></h5>
                <p>Post Time: <?php echo $row['post_time']; ?></p>
                <p>Price: <?php echo $row['price']; ?></p>
                <p>State: <?php echo $row['state']; ?></p>
                <p>Notes: <?php echo $row['notes']; ?></p>
                <p>UserID: <?php echo $row['userID']; ?></p>
                <p>Start Location: <?php echo $row['start_location']; ?></p>
                <p>Destination: <?php echo $row['destination']; ?></p>
                <p>Car Color: <?php echo $row['car_color']; ?></p>
                <p>Model: <?php echo $row['car_model']; ?></p>
                <p>License: <?php echo $row['car_license']; ?></p>
                <p>Driver: <?php echo $row['driver']; ?></p>
                <a href="itemDetail.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">view more</a>
                <form method="post">
                    <input type="hidden" name="collection_item" value="<?php echo $row['id'] ?>">
                    <button name="collectionbutton" value="collection" class="btn btn-primary">Add to Collection</button>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>
<?php } ?>

</div>
</body>
</html>