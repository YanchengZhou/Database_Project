<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="author" content="Yancheng Zhou(Worked on this), Xiyuan Song(worked on this)">
    <meta name="description" content="Website for connecting people by exchanging items and information">
    <meta name="keywords" content="Connect Website">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    
    <link rel="stylesheet/less" type="text/css" href="styles/main.less" />
    <script src="less.min.js" ></script>
    <title> Connect Project </title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
        <div class="container-xl">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link active" href="?command=index"> Home | </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?command=usedItems"> Used Items | </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?command=rentals"> House Rentals | </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?command=carpooling"> Carpooling | </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?command=account"> Account | </a>
                    </li>
                </ul>
            </div>

            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="?command=upload" class="btn btn-primary my-2 my-sm-0"> Upload </a>
                        &nbsp; &nbsp; &nbsp; &nbsp;
                        <a href="?command=logout" class="btn btn-outline-dark my-2 my-sm-0"> Log out </a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div id="personalInfo">
                    <h1>User: <?=$userinfo[0]["name"];?></h1>
                    <div class="col-md-6">
                        <img class="card-img-top" src="images/uva.jpg" alt="Default head portrait">
                    </div>

                        <table class="table">
                            <tr>
                                <th scope="row" style="width: 30%;">Gender</th>
                                <td><?=$userinfo[0]["gender"];?></td>
                            </tr>
                            <tr>
                                <th scope="row">Age</th>
                                <td><?=$userinfo[0]["age"];?></td>
                            </tr>
                            <tr>
                                <th scope="row">Contact</th>
                                <td><?=$userinfo[0]["contact"];?></td>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td><?=$userinfo[0]["email"];?></td>
                            </tr>
                            <tr>
                                <th scope="row">Posts</th>
                                <td><?=$userinfo[0]["posts"];?></td>
                            </tr>
                            <tr>
                                <th scope="row">Upvoted by</th>
                                <td><?=$userinfo[0]["upvotednumber"];?></td>
                            </tr>
                            <tr>
                                <th scope="row">Note</th>
                                <td><?=$userinfo[0]["note"];?></td>
                            </tr>
                        </table>
                        <button type="button" class="btn btn-primary" id = "viewusers">Hover to preview all users!</button>
                        <div id="userview"></div>
                </div>
            </div>

            <div class="col-md-8">
                <h1 style="background: lavender">My Posts</h1>

                <?php
                if(!$items || empty($items)) {
                    echo "<h3> You haven't posted any items yet.</h3>";
                    echo "<br>". "<br>". "<br>". "<br>". "<br>". "<br>". "<br>". "<br>". "<br>". "<br>". "<br>". "<br>". "<br>". "<br>". "<br>". "<br>". "<br>". "<br>";
                }

                foreach($items as $item) {
                    $id = $item['id2'];
                    $name = $item['itemname'];
                    $poster = $item['poster'];
                    $time = $item['time'];
                    $price = $item['price'];
                    $status = $item['status'];
                    $upvote = $item['upvote'];
                    $category = $item['category'];

                    echo "<div class='p-5 mb-4'>" . "<div class='upper'>" .
                        "<h1 class='display-8 fw-bold'> $name </h1>" . " <h4 style='text-align:right'> posted by $poster on $time </h4>" . "</div>";
                    echo "<div class='row'>" . "<div class='col-md-4 itemInfo'>";
                    echo "<ul>" . "<li> Price: $price$ </li>
                                    <li> Type: $category </li>
                                    <li> Status: $status </li>
                                    <li> Upvote: $upvote </li>" . "</ul>";                  
                    echo "<form action='?command=basicinfo' method='post'>";
                    echo "<input type='hidden' name='basicinfoid' value=$id>";
                    echo "<button class='btn btn-primary btn-lg' type='submit'>View More</button>";
                    echo "</form>";
                    echo "<br>";
                    echo "<form action='?command=delete' method='post'>";
                    echo "<input type='hidden' name='id' value=$id>";
                    echo "<button class='btn btn-danger btn-lg' type='submit' onclick='deleteItem(this)'>Delete</button>". "</div>";
                    echo "</form>";
                    echo "<div class='col-md-8'>" . "<img class='card-img-top' src='images/item.jpg' alt='No picture available'>";
                    echo "</div>" . "</div>" . "</div>" . "<br>";
                }
                ?>

            </div>
        </div>
    </div>


    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-muted">© All rights authorized to Zhou, Song, 2022</p>

            <ul class="nav col-md-8 justify-content-end">
                <li class="nav-item"><a href="?command=index" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="?command=usedItems" class="nav-link px-2 text-muted">Used Items</a></li>
                <li class="nav-item"><a href="?command=rentals" class="nav-link px-2 text-muted">House Rentals</a></li>
                <li class="nav-item"><a href="?command=carpooling" class="nav-link px-2 text-muted">Carpooling</a></li>
                <li class="nav-item"><a href="?command=account" class="nav-link px-2 text-muted">Account</a></li>
            </ul>
        </footer>
    </div>
    <script type="text/javascript">
            $(document).ready(function() {
                $('#viewusers').mouseenter(function() {
                    $.ajax({
                        type: "GET",
                        url: 'classes/user.php',
                        success: function(response){
                            //json1 is our javascript object
                            json1 = eval(response);
                            itemlist = [];
                            itemlist.push("All users: ");
                            for (var i = 0; i < json1.length; i++){
                                var obj = json1[i];
                                itemlist.push(obj["name"]);
                                itemlist.push(" ");
                            }     
                            $("#userview").html(itemlist);
                            $("#viewusers").html("------- List of users: -------");
                            $("#viewusers").removeClass("btn btn-primary");
                            $("#viewusers").addClass("btn btn-success");
                        },
                        error: function(xhr, status, error){
                            alert(error);
                        }
                });
                }).mouseleave(function(){
                    $("#userview").html("");
                    $("#viewusers").html("Hover to preview all users!");
                    $("#viewusers").removeClass("btn btn-success");
                    $("#viewusers").addClass("btn btn-primary");
                });
            });

            //change view of screen by deleting the item
            function deleteItem(o) {
                var item = o.parentNode.parentNode.parentNode;
                item.parentNode.removeChild(item);
            }
    </script>
</body>

</html>