<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>


<?php
require("connect-db.php");
global $db;

session_start();
if(isset($_SESSION["userID"]) && isset($_SESSION["email"]) && isset($_SESSION["name"])) {
    echo "logged in as " . $_SESSION["name"]. " userID: " . $_SESSION["userID"]
        . " email: ". $_SESSION["email"];

    $userId = $_SESSION["userID"];

    $used_items_sql = "SELECT * FROM Collection JOIN Posts ON Collection.postID = Posts.id JOIN Used_item_post ON Posts.id = Used_item_post.id WHERE Collection.userID = $userId";
    $used_items_result = $db->query($used_items_sql);

    $house_rentals_sql = "SELECT * FROM Collection JOIN Posts ON Collection.postID = Posts.id JOIN House_rental_post ON Posts.id = House_rental_post.id WHERE Collection.userID = $userId";
    $house_rentals_result = $db->query($house_rentals_sql);

    $carpooling_sql = "SELECT * FROM Collection JOIN Posts ON Collection.postID = Posts.id JOIN Carpooling_post ON Posts.id = Carpooling_post.id WHERE Collection.userID = $userId";
    $carpooling_result = $db->query($carpooling_sql);

} else {
    echo "You have not logged in";
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


<form action="collection.php" method="get">
    <input type="text" name="query" placeholder="Search...">
    <button type="submit">Search</button>
</form>

<h1>My Collections</h1>
<br>


<?php
// Check if a search query has been submitted
if(!(isset($_SESSION["userID"]) && isset($_SESSION["email"]) && isset($_SESSION["name"]))) {
    echo "<h1> Please log in to see your collections </h1>";
    exit();
}
if (isset($_GET['query']) && !empty($_GET['query'])) {
    // Get the user's search query
    $query = $_GET['query'];
    $userId = $_SESSION["userID"];

    // Search the database for records with a name that matches the search query
    $sql1 = "SELECT * FROM Collection JOIN Posts ON Collection.postID = Posts.id JOIN Used_item_post ON Posts.id = Used_item_post.id WHERE Collection.userID = $userId AND Posts.name LIKE '%$query%'";
    $result1 = $db->query($sql1);
    $sql2 = "SELECT * FROM Collection JOIN Posts ON Collection.postID = Posts.id JOIN House_rental_post ON Posts.id = House_rental_post.id WHERE Collection.userID = $userId AND Posts.name LIKE '%$query%'";
    $result2 = $db->query($sql2);
    $sql3 = "SELECT * FROM Collection JOIN Posts ON Collection.postID = Posts.id JOIN Carpooling_post ON Posts.id = Carpooling_post.id WHERE Collection.userID = $userId AND Posts.name LIKE '%$query%'";
    $result3 = $db->query($sql3);
    ?>
    <h1>Used Item Posts</h1>
    <?php
    // Display the search results
    while ($row = $result1->fetch(PDO::FETCH_ASSOC)) {
        // Display the item using the same HTML structure as before
        ?>
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
<!--                    <button name="collectionbutton" value="collection" class="btn btn-primary">Add to Collection</button>-->
                </form>
            </div>
        </div>
        <?php } ?>
        <h1>House Rental Posts</h1>
        <?php while($row = $result2->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="card" style="width: 18rem;">
                <img src="placeholder.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                    <p>Post Time: <?php echo $row['post_time']; ?></p>
                    <p>Price: <?php echo $row['price']; ?></p>
                    <p>State: <?php echo $row['state']; ?></p>
                    <p>Notes: <?php echo $row['notes']; ?></p>
                    <p>UserID: <?php echo $row['userID']; ?></p>
                    <p>Rental Type: <?php echo $row['rental_type']; ?></p>
                    <p>Location: <?php echo $row['location']; ?></p>
                    <p>Start Date: <?php echo $row['start_date']; ?></p>
                    <p>End Date: <?php echo $row['end_date']; ?></p>
                    <form method="post">
                        <input type="hidden" name="collection_item" value="<?php echo $row['id'] ?>">
                        <a href="#" class="btn btn-primary">view more</a>
<!--                        <button type="submit" name="collectionbutton" value="collection" class="btn btn-primary">Add to Collection</button>-->
                    </form>
                </div>
            </div>
        <?php } ?>
        <h1>Carpooling Posts</h1>
        <?php while($row = $result3->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="card" style="width: 18rem;">
                <img src="placeholder.jpg" class="card-img-top" alt="...">
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
                    <form method="post">
                        <input type="hidden" name="collection_item" value="<?php echo $row['id'] ?>">
                        <a href="#" class="btn btn-primary">view more</a>
<!--                        <button name="collectionbutton" value="collection" class="btn btn-primary">Add to Collection</button>-->
                    </form>
                </div>
            </div>
        <?php } ?>
        <?php
} else {
    // No search query has been submitted, so display all items as before
    ?>
    <!-- Your existing code to display all items goes here -->
    <h1>Used Item Posts</h1>
    <div style="display: flex; flex-wrap: wrap;">
        <?php while($row = $used_items_result->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="card" style="width: 18rem; margin: 10px;">
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
<!--                        <button type="submit" name="collectionbutton" value="collection" class="btn btn-primary">Add to Collection</button>-->
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>


    <h1>House Rental Posts</h1>
    <div style="display: flex; flex-wrap: wrap;">
        <?php while($row = $house_rentals_result->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="card" style="width: 18rem;">
                <img src="placeholder.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                    <p>Post Time: <?php echo $row['post_time']; ?></p>
                    <p>Price: <?php echo $row['price']; ?></p>
                    <p>State: <?php echo $row['state']; ?></p>
                    <p>Notes: <?php echo $row['notes']; ?></p>
                    <p>UserID: <?php echo $row['userID']; ?></p>
                    <p>Rental Type: <?php echo $row['rental_type']; ?></p>
                    <p>Location: <?php echo $row['location']; ?></p>
                    <p>Start Date: <?php echo $row['start_date']; ?></p>
                    <p>End Date: <?php echo $row['end_date']; ?></p>
                    <form method="post">
                        <input type="hidden" name="collection_item" value="<?php echo $row['id'] ?>">
                        <a href="#" class="btn btn-primary">view more</a>
<!--                        <button type="submit" name="collectionbutton" value="collection" class="btn btn-primary">Add to Collection</button>-->
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>


    <h1>Carpooling Posts</h1>
    <div style="display: flex; flex-wrap: wrap;">
        <?php while($row = $carpooling_result->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="card" style="width: 18rem;">
                <img src="placeholder.jpg" class="card-img-top" alt="...">
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
                    <form method="post">
                        <input type="hidden" name="collection_item" value="<?php echo $row['id'] ?>">
                        <a href="#" class="btn btn-primary">view more</a>
<!--                        <button type="submit" name="collectionbutton" value="collection" class="btn btn-primary">Add to Collection</button>-->
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php
}
?>

</body>
</html>