<?php
    function displayImageFromDatabase($postId) {
        global $db;

        $sql = "SELECT picture, image_data FROM Picture WHERE post_id = :postId";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':postId', $postId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $image_name = $result['picture'];
            $image_data = $result['image_data'];
            $encoded_image = base64_encode($image_data);

            // Determine mime type from image data
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime_type = $finfo->buffer($image_data);

            return "<img src='data:$mime_type;base64,$encoded_image' alt='Image from database'>";
        } else {
            return "<img src='placeholder.jpg' class='card-img-top' alt='No image found for post_id: $postId'>";
        }
    }
?>

<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#" ><b>&nbsp;UVassistance</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item nav-item_dec nav-item-custom active">
                <a class="nav-link " href="index.php">  <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Home&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>  <span class="sr-only"></span></a>
            </li>
            <li class="nav-item nav-item_dec active">
                <a class="nav-link" href="usedItem.php"><b>&nbsp;&nbsp;&nbsp;&nbsp;Used Item&nbsp;&nbsp;&nbsp;&nbsp;</b></a>
            </li>


            <li class="nav-item nav-item_dec active">
                <a class="nav-link" href="houseRental.php"><b>&nbsp;House Rental&nbsp;</b></a>
            </li>

            <li class="nav-item nav-item_dec active">
                <a class="nav-link" href="carpooling.php"><b>&nbsp;&nbsp;Carpooling&nbsp;&nbsp;</b></a>

            </li>

            <li class="nav-item nav-item_dec active">
                <a class="nav-link" href="account.php"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Account&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></a>
            </li>

            <li class="nav-item nav-item_dec active">
                <a class="nav-link" href="collection.php"><b>&nbsp;&nbsp;&nbsp;&nbsp;Collection&nbsp;&nbsp;&nbsp;&nbsp;</b></a>
            </li>
        </ul>

    </div>

    <li class="nav-item">
        <a href="upload.php"><button class="btn btn-primary ml-auto mr-2" type="button">Upload</button></a>
        <?php
            if(isset($_SESSION["userID"]) && isset($_SESSION["email"]) && isset($_SESSION["name"])) {
                $current_file_name = basename($_SERVER['PHP_SELF']);
                $getPath = "clearsession.php?return_url=" . $current_file_name;
                echo "<a href='$getPath'><button name='logoutbutton' value='logout' class='btn btn-primary ml-auto mr-2' type='button'>Log Out</button></a>";
            } else {
                echo "<a href='login.php'><button class='btn btn-primary ml-auto mr-2' type='button'>Log In</button></a>";

            }
        ?>
        <a href="signup.php"><button class="btn btn-primary ml-auto mr-2" type="button">Sign Up</button></a>
    </li>
</nav>