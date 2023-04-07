<?php
require('connect-db.php');

session_start();

function addPost($name, $post_time, $price, $state,$notes)
{
    global $db;
    $userID = $_SESSION["userID"];
    $stmt = $db->prepare("INSERT INTO Posts (name, post_time, price, state, notes, userID) VALUES (:name, :post_time, :price, :state, :notes, :userID)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':post_time', $post_time);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':state', $state);
    $stmt->bindParam('notes', $notes);
    $stmt->bindParam('userID', $userID);
    $stmt->execute();
    $stmt->closeCursor();


}

function addUsedItem($item_type, $brand, $used_time){
    global $db;
    //$id = $db->lastInsertId();
    try{
        $stmt = $db->prepare("INSERT INTO Used_item_post (id, item_type, brand, used_time) VALUES (:id, :item_type, :brand, :used_time)");
        $id = $db->lastInsertId();
        //print($id);
        $stmt -> bindParam(':id', $id);
        $stmt -> bindParam('item_type', $item_type);
        $stmt -> bindParam('brand', $brand);
        $stmt -> bindParam('used_time', $used_time);
        $stmt -> execute();
        $stmt -> closeCursor();
    }catch (PDOException $e){
        echo $e->getMessage();
    }
}

function addRental($rental_type, $location, $start_date, $end_date){
    global $db;
    try{
        $stmt = $db->prepare("INSERT INTO House_rental_post (id, rental_type, location, start_date, end_date) VALUES (:id, :rental_type, :location, :start_date, :end_date)");
        $id = $db->lastInsertId();
        $stmt -> bindParam(':id', $id);
        $stmt -> bindParam('rental_type', $rental_type);
        $stmt -> bindParam('location', $location);
        $stmt -> bindParam('start_date', $start_date);
        $stmt -> bindParam('end_date', $end_date);
        $stmt -> execute();
        $stmt -> closeCursor();
    }catch (PDOException $e){
        echo $e->getMessage();
    }

}

function addCarpooling($start_location, $destination, $car_color, $car_model, $car_license, $driver){
    global $db;
    try{
        $stmt = $db->prepare("INSERT INTO Carpooling_post(id, start_location, destination, car_color, car_model, car_license, driver) VALUES (:id, :start_location, :destination, :car_color, :car_model, :car_license, :driver)" );
        $id = $db->lastInsertId();
        $stmt -> bindParam(':id', $id);
        $stmt -> bindParam('start_location', $start_location);
        $stmt -> bindParam('destination', $destination);
        $stmt -> bindParam('car_color', $car_color);
        $stmt -> bindParam('car_model', $car_model);
        $stmt -> bindParam('car_license', $car_license);
        $stmt -> bindParam('driver', $driver);
        $stmt -> execute();
        $stmt -> closeCursor();
    }catch (PDOException $e){
        echo $e->getMessage();
    }


}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["name"])&&isset($_POST["time"])&&isset($_POST["price"])&&isset($_POST["state"])&&isset($_POST["note"])){
        $name = $_POST["name"];
        $time = $_POST["time"];
        $price = $_POST["price"];
        $state = $_POST["state"];
        $note = $_POST["note"];
        addPost($name, $time, $price, $state, $note);
        if(isset($_POST["itemType"])&&isset($_POST["brand"])&&isset($_POST["usedTime"])){
            $item_type = $_POST["itemType"];
            $brand = $_POST["brand"];
            $used_time = $_POST["usedTime"];
            print("excuted used item");
            addUsedItem($item_type, $brand,$used_time);
        }
        if(isset($_POST["rental_type"])&&isset($_POST["location"])&&isset($_POST["start_date"])&&isset($_POST["end_date"])){
            print("excuted rental");
            addRental($_POST["rental_type"], $_POST["location"],$_POST["start_date"],$_POST["end_date"]);
        }
        if(isset($_POST["start_location"])&&isset($_POST["destination"])&&isset($_POST["car_color"])&&isset($_POST["car_model"])&&isset($_POST["car_license"])&&isset($_POST["driver"])){
            print("excuted carpooling");
            addCarpooling($_POST["start_location"], $_POST["destination"],$_POST["car_color"], $_POST["car_model"],$_POST["car_license"], $_POST["driver"]);
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
        <button class="btn btn-primary ml-auto mr-2" type="button">Upload</button>
        <button class="btn btn-primary ml-auto mr-2" type="button">Log In</button>
    </li>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form name="uploadForm" action = "upload.php" method = "post">
                <h4>Upload Info</h4>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="time">Time</label>
                    <input type="text" class="form-control" name="time" placeholder="Enter time">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" name="price" placeholder="Enter price">
                </div>
                <div class="form-group">
                    <label for="state">State</label>
                    <input type="text" class="form-control" name="state" placeholder="Enter state">
                </div>
                <div class="form-group">
                    <label for="note">Note</label>
                    <input type="text" class="form-control" name="note" placeholder="Enter note">
                </div>
<!--            </form>-->
<!--        </div>-->
<!--        <div class="col-md-6">-->
<!--            <form>-->
                <h4>Upload Image</h4>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" id="image">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" id="category">
                        <option>Used Item</option>
                        <option>House Rental</option>
                        <option>Carpooling</option>
                        <option>Other</option>
                    </select>
                </div>
<!--                <div class="form-group">-->
<!--                    <label for="category">Category</label><br>-->
<!--                    <div class="form-check form-check-inline">-->
<!--                        <input class="form-check-input" type="radio" name="category" id="usedItem" value="Used Item">-->
<!--                        <label class="form-check-label" for="usedItem">Used Item</label>-->
<!--                    </div>-->
<!--                    <div class="form-check form-check-inline">-->
<!--                        <input class="form-check-input" type="radio" name="category" id="houseRental" value="House Rental">-->
<!--                        <label class="form-check-label" for="houseRental">House Rental</label>-->
<!--                    </div>-->
<!--                    <div class="form-check form-check-inline">-->
<!--                        <input class="form-check-input" type="radio" name="category" id="carpooling" value="Carpooling">-->
<!--                        <label class="form-check-label" for="carpooling">Carpooling</label>-->
<!--                    </div>-->
<!--                    <div class="form-check form-check-inline">-->
<!--                        <input class="form-check-input" type="radio" name="category" id="other" value="Other">-->
<!--                        <label class="form-check-label" for="other">Other</label>-->
<!--                    </div>-->
<!--                </div>-->


                <div id="additionalFields"></div>
                <script>
                    const categorySelect = document.getElementById("category");
                    const additionalFieldsDiv = document.getElementById("additionalFields");
                    //const radioButtons = document.querySelectorAll('input[name="category"]');

                    // radioButtons.forEach((radioButton) => {
                    //     radioButton.addEventListener("click", function () {
                    //         if (document.querySelector(':checked').value === "Used Item") {
                    //             additionalFieldsDiv.innerHTML = `
                    //             <div class="form-group">
                    //               <label for="itemType">Item Type</label>
                    //               <input type="text" class="form-control" id="itemType" placeholder="Enter item type">
                    //             </div>
                    //             <div class="form-group">
                    //               <label for="brand">Brand</label>
                    //               <input type="text" class="form-control" id="brand" placeholder="Enter brand">
                    //             </div>
                    //             <div class="form-group">
                    //               <label for="usedTime">Used Time</label>
                    //               <input type="text" class="form-control" id="usedTime" placeholder="Enter used time">
                    //             </div>
                    //           `;
                    //         }else if(document.querySelector(':checked').value === "House Rental"){
                    //             additionalFieldsDiv.innerHTML = `
                    //             <div class="form-group">
                    //               <label for="rental_type">Rental Type</label>
                    //               <input type="text" class="form-control" id="rental_type" placeholder="Enter rental type">
                    //             </div>
                    //             <div class="form-group">
                    //               <label for="location">Location</label>
                    //               <input type="text" class="form-control" id="location" placeholder="Enter location">
                    //             </div>
                    //             <div class="form-group">
                    //               <label for="start_date">Start Date</label>
                    //               <input type="text" class="form-control" id="start_date" placeholder="Enter starting date">
                    //             </div>
                    //             <div class="form-group">
                    //               <label for="end_date">End Date</label>
                    //               <input type="text" class="form-control" id="end_date" placeholder="Enter ending date">
                    //             </div>
                    //
                    //           `;
                    //         }else if(document.querySelector(':checked').value === "Carpooling"){
                    //             additionalFieldsDiv.innerHTML = `
                    //             <div class="form-group">
                    //               <label for="start_location">Start Location</label>
                    //               <input type="text" class="form-control" id="start_location" placeholder="Enter start location">
                    //             </div>
                    //             <div class="form-group">
                    //               <label for="destination">Destination</label>
                    //               <input type="text" class="form-control" id="destination" placeholder="Enter destination">
                    //             </div>
                    //             <div class="form-group">
                    //               <label for="car_color">Car Color</label>
                    //               <input type="text" class="form-control" id="car_color" placeholder="Enter car color">
                    //             </div>
                    //             <div class="form-group">
                    //               <label for="car_model">Car Model</label>
                    //               <input type="text" class="form-control" id="car_model" placeholder="Enter car model">
                    //             </div>
                    //             <div class="form-group">
                    //               <label for="car_license">Car License</label>
                    //               <input type="text" class="form-control" id="car_license" placeholder="Enter car license">
                    //             </div>
                    //             <div class="form-group">
                    //               <label for="driver">Driver</label>
                    //               <input type="text" class="form-control" id="driver=" placeholder="Enter driver">
                    //             </div>
                    //
                    //           `;
                    //         }else{
                    //             additionalFieldsDiv.innerHTML = "";
                    //         }
                    //     }
                    //     });

                    categorySelect.addEventListener("change", function (event) {
                        if (event.target.value === "Used Item") {
                            additionalFieldsDiv.innerHTML = `
                                <div class="form-group">
                                  <label for="itemType">Item Type</label>
                                  <input type="text" class="form-control" name="itemType" placeholder="Enter item type">
                                </div>
                                <div class="form-group">
                                  <label for="brand">Brand</label>
                                  <input type="text" class="form-control" name="brand" placeholder="Enter brand">
                                </div>
                                <div class="form-group">
                                  <label for="usedTime">Used Time</label>
                                  <input type="text" class="form-control" name="usedTime" placeholder="Enter used time">
                                </div>
                              `;
                        }else if(event.target.value === "House Rental"){
                            additionalFieldsDiv.innerHTML = `
                                <div class="form-group">
                                  <label for="rental_type">Rental Type</label>
                                  <input type="text" class="form-control" name="rental_type" placeholder="Enter rental type">
                                </div>
                                <div class="form-group">
                                  <label for="location">Location</label>
                                  <input type="text" class="form-control" name="location" placeholder="Enter location">
                                </div>
                                <div class="form-group">
                                  <label for="start_date">Start Date</label>
                                  <input type="text" class="form-control" name="start_date" placeholder="Enter starting date">
                                </div>
                                <div class="form-group">
                                  <label for="end_date">End Date</label>
                                  <input type="text" class="form-control" name="end_date" placeholder="Enter ending date">
                                </div>

                              `;
                        } else if(event.target.value === "Carpooling"){
                            additionalFieldsDiv.innerHTML = `
                                <div class="form-group">
                                  <label for="start_location">Start Location</label>
                                  <input type="text" class="form-control" name="start_location" placeholder="Enter start location">
                                </div>
                                <div class="form-group">
                                  <label for="destination">Destination</label>
                                  <input type="text" class="form-control" name="destination" placeholder="Enter destination">
                                </div>
                                <div class="form-group">
                                  <label for="car_color">Car Color</label>
                                  <input type="text" class="form-control" name="car_color" placeholder="Enter car color">
                                </div>
                                <div class="form-group">
                                  <label for="car_model">Car Model</label>
                                  <input type="text" class="form-control" name="car_model" placeholder="Enter car model">
                                </div>
                                <div class="form-group">
                                  <label for="car_license">Car License</label>
                                  <input type="text" class="form-control" name="car_license" placeholder="Enter car license">
                                </div>
                                <div class="form-group">
                                  <label for="driver">Driver</label>
                                  <input type="text" class="form-control" name="driver" placeholder="Enter driver">
                                </div>

                              `;
                        } else {
                            additionalFieldsDiv.innerHTML = "";
                        }
                    });
                </script>
                <input type="submit" class="btn btn-primary" name= "Submit" value="Submit">
            </form>
<!--            <button type="submit" class="btn btn-primary">Submit</button>-->
<!--            <button type="submit" class="btn btn-primary">Reset</button>-->
        </div>

    </div>
</div>
</body>
</html>
