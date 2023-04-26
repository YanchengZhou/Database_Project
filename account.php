<?php
    require("connect-db.php");
    global $db;

    session_start();
    include("navbar.php");
    if(isset($_SESSION["userID"]) && isset($_SESSION["email"]) && isset($_SESSION["name"])) {
        echo "logged in as " . $_SESSION["name"]. " userID: " . $_SESSION["userID"]
            . " email: ". $_SESSION["email"];
        $userId = $_SESSION["userID"];
        $used_info_sql = "select * from User where userID=$userId";
        $user = $db->query($used_info_sql)->fetch(PDO::FETCH_ASSOC);

        $friend_sql = "select * from User where UserID in (select friend_ID from Is_friend where userID=$userId)";
        $friends = $db->query($friend_sql);

        $selectedUsers_result = array();

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(!empty($_POST['searchfriend']) && ($_POST['searchfriend'] == "search") && ($_POST['query'] != "")) {
                $content = $_POST["query"];
                $selectedUsers_sql = "select * from User where email='$content'";
                $selectedUsers_result = $db->query($selectedUsers_sql)->fetch(PDO::FETCH_ASSOC);
                if(!$selectedUsers_result) {
                    $selectedUsers_result = array();
                }
            }

            if (!empty($_POST['deletefriend']) && ($_POST['deletefriend'] == "delete")) {
                $friend_to_delete = $_POST['friend_to_delete'];
                $delete_query = "DELETE FROM Is_friend WHERE friend_ID = $friend_to_delete AND userID = $userId";
                $result = $db->query($delete_query);
                header("Refresh:0");
            }

            if(!empty($_POST['addfriend']) && ($_POST['addfriend'] == "add")) {
                $friendID = $_POST['friendID'];
                $query = "INSERT INTO Is_friend (userID, friend_ID) VALUES (:userId, :friendID)";
                $statement = $db->prepare($query);
                $statement->bindValue(':userId', $userId);
                $statement->bindValue(':friendID', $friendID);
                $statement->execute();
                header("Refresh:0");
            }
        }

    } else {
        echo "<h1>Please log in first to see your information</h1>";
        echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>";
        exit();
    }

?>

<!DOCTYPE html>
<html>
<head>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>

    <title>User Information</title>
    <style>
        .fontStyle {
            font-size:25px;
        }
        .addPadding {
            padding-top: 3%;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row" style="padding-top:2%">
        <div class="col-md-4">
            <div class="card" style="width: 36rem;">
                <img src="placeholder.jpg" class="card-img-top" alt="..." style="max-width: 150%; max-height: 300px;">
                <div class="card-body">
                    <h1 class="card-title"><?php echo $user['name']; ?></h1>
                    <p class="fontStyle">Age: <?php echo $user['age']; ?></p>
                    <p class="fontStyle">Gender: <?php echo $user['gender']; ?></p>
                    <p class="fontStyle">Email: <?php echo $user['email']; ?></p>
                    <p class="fontStyle">Phone: <?php echo $user['phone']; ?></p>
                    <p class="fontStyle">Bio: <?php echo $user['bio']; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" style="padding-top: 2%">
    <form method="post">
        <input type="text" name="query" placeholder="Search friend...">
        <button type="submit" name="searchfriend" value="search">Search</button>
    </form>
</div>

<div class="container" style="padding-top: 2%">
    <?php
        if (count($selectedUsers_result) == 0) {
            echo "<p class='fontStyle'>No users searched.</p>";
        } else {
            $row = $selectedUsers_result;
            ?>
            <div class="card" style="width: 36rem;">
                <div class="card-body">
                    <form method="post">
                            <p class="fontStyle addPadding"><?php echo $row['name']; ?></p>
                            <p class="addPadding">email: <?php echo $row['email']; ?>, gender:<?php echo $row['gender']; ?>, age: <?php echo $row['age']; ?></p>
                        <input type="hidden" name="friendID" value="<?php echo $row['userID'] ?>">
                        <button class="btn btn-primary" type="submit" name="addfriend" value="add">Add Friend</button>
                    </form>
                </div>
            </div>
        <?php } ?>
</div>

<div class="container">
    <h1 class="addPadding"> My Friends </h1>
    <div class="row">
        <div class="col-md-4" style="padding-left:2%">
            <?php while($friend = $friends->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="card" style="width: 36rem;">
                    <div class="card-body">
                        <p class="fontStyle addPadding"><?php echo $friend['name']; ?></p>
                        <p class="addPadding">email: <?php echo $friend['email']; ?>, gender:<?php echo $friend['gender']; ?>, age: <?php echo $friend['age']; ?></p>
                        <form method="post">
                            <input type="hidden" name="friend_to_delete" value="<?php echo $friend["userID"]?>">
                            <button class="btn btn-danger" name="deletefriend" value="delete" type="submit">Delete</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<br> <br> <br>

</body>
</html>
