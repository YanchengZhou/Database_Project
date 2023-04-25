

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

    $house_rentals_sql = "select * from Posts natural join House_rental_post";
    $house_rentals_result = $db->query($house_rentals_sql);

    $carpooling_sql = "select * from Posts natural join Carpooling_post";
    $carpooling_result = $db->query($carpooling_sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only"></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Used Item</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">House Rental</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">Carpooling</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">Account</a>
            </li>

        </ul>

    </div>

    <li class="nav-item">
        <a href="upload.php"><button class="btn btn-primary ml-auto mr-2" type="button">Upload</button></a>
        <a href="login.php"><button class="btn btn-primary ml-auto mr-2" type="button">Log In</button></a>
        <a href="signup.php"><button class="btn btn-primary ml-auto mr-2" type="button">Sign Up</button></a>
    </li>
</nav>

<form class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</form>

<h1>Used Item Posts</h1>
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
        <a href="#" class="btn btn-primary">view more</a>
    </div>
</div>
<?php } ?>
<!--<div class="item-cards">-->
<!--    --><?php //while($row = $used_items_result->fetch(PDO::FETCH_ASSOC)) { ?>
<!--        <div class="item-card">-->
<!--            <h2>--><?php //echo $row['name']; ?><!--</h2>-->
<!--            <p>Post Time: --><?php //echo $row['post_time']; ?><!--</p>-->
<!--            <p>Price: --><?php //echo $row['price']; ?><!--</p>-->
<!--            <p>State: --><?php //echo $row['state']; ?><!--</p>-->
<!--            <p>Notes: --><?php //echo $row['notes']; ?><!--</p>-->
<!--            <p>UserID: --><?php //echo $row['userID']; ?><!--</p>-->
<!--            <p>Item Type: --><?php //echo $row['item_type']; ?><!--</p>-->
<!--            <p>Brand: --><?php //echo $row['brand']; ?><!--</p>-->
<!--            <p>Used Time: --><?php //echo $row['used_time']; ?><!--</p>-->
<!--        </div>-->
<!--    --><?php //} ?>
<!--</div>-->
<!--<table border="1">-->
<!--    <thead>-->
<!--    <tr>-->
<!--        <th>ID</th>-->
<!--        <th>Name</th>-->
<!--        <th>Post Time</th>-->
<!--        <th>Price</th>-->
<!--        <th>State</th>-->
<!--        <th>Notes</th>-->
<!--        <th>UserID</th>-->
<!--        <th>Item Type</th>-->
<!--        <th>Brand</th>-->
<!--        <th>Used Time</th>-->
<!--    </tr>-->
<!--    </thead>-->
<!--    <tbody>-->
<!--    --><?php //while($row = $used_items_result->fetch(PDO::FETCH_ASSOC)) {
//        echo "<tr>";
//        foreach ($row as $value) {
//            echo "<td> $value </td>";
//        }
//        echo "</tr>";
//    }
//    ?>
<!--    </tbody>-->
<!--</table>-->


<h1>House Rental Posts</h1>
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
        <a href="#" class="btn btn-primary">view more</a>
    </div>
</div>
<?php } ?>
<!--<table border="1">-->
<!--    <thead>-->
<!--    <tr>-->
<!--        <th>ID</th>-->
<!--        <th>Name</th>-->
<!--        <th>Post Time</th>-->
<!--        <th>Price</th>-->
<!--        <th>State</th>-->
<!--        <th>Notes</th>-->
<!--        <th>UserID</th>-->
<!--        <th>Rental Type</th>-->
<!--        <th>Location</th>-->
<!--        <th>Start Date</th>-->
<!--        <th>End Date</th>-->
<!--    </tr>-->
<!--    </thead>-->
<!--    <tbody>-->
<!--    --><?php //while($row = $house_rentals_result->fetch(PDO::FETCH_ASSOC)) {
//        echo "<tr>";
//        foreach ($row as $value) {
//            echo "<td> $value </td>";
//        }
//        echo "</tr>";
//    }
//    ?>
<!--    </tbody>-->
<!--</table>-->


<h1>Carpooling Posts</h1>
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
            <a href="#" class="btn btn-primary">view more</a>
        </div>
    </div>
<?php } ?>
<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Post Time</th>
        <th>Price</th>
        <th>State</th>
        <th>Notes</th>
        <th>UserID</th>
        <th>Start Location</th>
        <th>Destination</th>
        <th>Car Color</th>
        <th>Car Model</th>
        <th>Car License</th>
        <th>Driver</th>
    </tr>
    </thead>
    <tbody>
    <?php while($row = $carpooling_result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td> $value </td>";
        }
        echo "</tr>";
    }
    ?>
    </tbody>
</table>

</body>
</html>

