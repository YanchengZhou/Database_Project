<h3> <a href="login.php"> go to login </a> </h3>
<h3> <a href="signup.php"> go to sign up </a> </h3>

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

<br>
<a href="login.php"> go to login </a>
<br>
<a href="signup.php"> go to sign up </a>
<br>
<a href="upload.php"> go to upload </a>
<h1>Used Item Posts</h1>
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
        <th>Item Type</th>
        <th>Brand</th>
        <th>Used Time</th>
    </tr>
    </thead>
    <tbody>
    <?php while($row = $used_items_result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td> $value </td>";
            }
            echo "</tr>";
        }
    ?>
    </tbody>
</table>


<h1>House Rental Posts</h1>
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
        <th>Rental Type</th>
        <th>Location</th>
        <th>Start Date</th>
        <th>End Date</th>
    </tr>
    </thead>
    <tbody>
    <?php while($row = $house_rentals_result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td> $value </td>";
        }
        echo "</tr>";
    }
    ?>
    </tbody>
</table>


<h1>Carpooling Posts</h1>
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
