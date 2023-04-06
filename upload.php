<?php
require('connect-db.php');

function addPost($name, $post_time, $price, $state,$note):void
{
    global $db;
    $stmt = $db->prepare("INSERT INTO Posts (name, post_time, price, state, note) VALUES (:name, :post_time, :price, :state, :note)");
//    $stmt->bindParam(':name', $name);
//    $stmt->bindParam(':major', $major);
//    $stmt->bindParam(':year', $year);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':post_time', $post_time);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':state', $state);
    $stmt->bindParam('note', $note);
    $stmt->execute();
    $stmt->closeCursor();

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
                <a class="nav-link" href="#">Home <span class="sr-only"></span></a>
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
                    <input type="text" class="form-control" id="name" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="time">Time</label>
                    <input type="text" class="form-control" id="time" placeholder="Enter time">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" placeholder="Enter price">
                </div>
                <div class="form-group">
                    <label for="state">State</label>
                    <input type="text" class="form-control" id="state" placeholder="Enter state">
                </div>
                <div class="form-group">
                    <label for="note">Note</label>
                    <input type="text" class="form-control" id="note" placeholder="Enter note">
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <form>
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
                                  <input type="text" class="form-control" id="itemType" placeholder="Enter item type">
                                </div>
                                <div class="form-group">
                                  <label for="brand">Brand</label>
                                  <input type="text" class="form-control" id="brand" placeholder="Enter brand">
                                </div>
                                <div class="form-group">
                                  <label for="usedTime">Used Time</label>
                                  <input type="text" class="form-control" id="usedTime" placeholder="Enter used time">
                                </div>
                              `;
                        }else if(event.target.value === "House Rental"){
                            additionalFieldsDiv.innerHTML = `
                                <div class="form-group">
                                  <label for="rental_type">Rental Type</label>
                                  <input type="text" class="form-control" id="rental_type" placeholder="Enter rental type">
                                </div>
                                <div class="form-group">
                                  <label for="location">Location</label>
                                  <input type="text" class="form-control" id="location" placeholder="Enter location">
                                </div>
                                <div class="form-group">
                                  <label for="start_date">Start Date</label>
                                  <input type="text" class="form-control" id="start_date" placeholder="Enter starting date">
                                </div>
                                <div class="form-group">
                                  <label for="end_date">End Date</label>
                                  <input type="text" class="form-control" id="end_date" placeholder="Enter ending date">
                                </div>

                              `;
                        } else if(event.target.value === "Carpooling"){
                            additionalFieldsDiv.innerHTML = `
                                <div class="form-group">
                                  <label for="start_location">Start Location</label>
                                  <input type="text" class="form-control" id="start_location" placeholder="Enter start location">
                                </div>
                                <div class="form-group">
                                  <label for="destination">Destination</label>
                                  <input type="text" class="form-control" id="destination" placeholder="Enter destination">
                                </div>
                                <div class="form-group">
                                  <label for="car_color">Car Color</label>
                                  <input type="text" class="form-control" id="car_color" placeholder="Enter car color">
                                </div>
                                <div class="form-group">
                                  <label for="car_model">Car Model</label>
                                  <input type="text" class="form-control" id="car_model" placeholder="Enter car model">
                                </div>
                                <div class="form-group">
                                  <label for="car_license">Car License</label>
                                  <input type="text" class="form-control" id="car_license" placeholder="Enter car license">
                                </div>
                                <div class="form-group">
                                  <label for="driver">Driver</label>
                                  <input type="text" class="form-control" id="driver=" placeholder="Enter driver">
                                </div>

                              `;
                        } else {
                            additionalFieldsDiv.innerHTML = "";
                        }
                    });
                </script>

            </form>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="submit" class="btn btn-primary">Reset</button>
        </div>

    </div>
</div>
</body>
</html>
