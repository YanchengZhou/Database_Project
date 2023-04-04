<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="author" content="Yancheng Zhou(worked on this), Xiyuan Song(worked on this)">
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
                        <a href="?command=logout" class="btn btn-outline-dark my-2 my-sm-0">Log out </a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <span> Search </span>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="form-outline">
                                        <form action='?command=search' method='post'>
                                            <input type="search" id = "namesearch" onmouseout = "validation();" name="search" class="form-control" placeholder="Search name"/>
                                            <button class='btn btn-primary' id = "searchbutton" type='submit'>Search</button>
                                        </form>
                                        <h6 style="color:red;" id="message"></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <span> Filter </span>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                
                            
                            
                            <div class="accordion-body">
                                <form id="filterForm" action='?command=filter' method='post'>
                                        <h5> Price: $ </h5>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="filterprice" value = "lessthan10">
                                            <label class="form-check-label">&lt;10</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="filterprice" value = "between">
                                            <label class="form-check-label">10-50</label>
                                        </div>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="filterprice" value = "morethan50">
                                            <label class="form-check-label">>50</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="filterprice" value = "any" checked>
                                            <label class="form-check-label">Any</label>
                                        </div>
                                        <br><br>

                                        <h5> State </h5>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="filterstate" value = "available">
                                            <label class="form-check-label">Available</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="filterstate" value = "pending">
                                            <label class="form-check-label">Pending</label>
                                        </div>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="filterstate" value = "unavailable">
                                            <label class="form-check-label">Unavailable</label> &nbsp; &nbsp;
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="filterstate" value = "any" checked>
                                            <label class="form-check-label">Any</label>
                                        </div>
                                        <br><br>

                                        <p>
                                            <button id="filterButton" disabled="true" class='btn btn-primary' type='submit'>Filter</button>
                                        </p>

                                    <h6 style="color:red;" id="message2"> Select at least 1 filter category. </h6>

                            </div>
                                </form>
                            </div>
                            
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <span> Sort </span>
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <form id="sortForm" action='?command=sort' method='post'>

                                        <h5> By Time </h5>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sorttime" value = "latest">
                                            <label class="form-check-label">Latest</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sorttime" value = "earliest">
                                            <label class="form-check-label">Earliest</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sorttime" value = "any" checked>
                                            <label class="form-check-label">Any</label>
                                        </div>
                                        <br> <br>

                                        <h5> By Price </h5>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sortprice" value = "lowest">
                                            <label class="form-check-label">Lowest</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sortprice" value = "highest">
                                            <label class="form-check-label">Highest</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sortprice" value = "any" checked>
                                            <label class="form-check-label">Any</label>
                                        </div>
                                        <br> <br>

                                        <h5> By Upvote </h5>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sortupvote" value = "highupvote">
                                            <label class="form-check-label">Highest</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sortupvote" value = "any" checked>
                                            <label class="form-check-label">Any</label>
                                        </div>
                                        <br> <br>                   
                                        <button id="sortButton" disabled="true" class='btn btn-primary' type='submit'>Sort</button>
                                        <h6 style="color:red;" id="message3"> Select at least 1 sort category. </h6>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <div class='col-md-8'>
                <?php
                    if(!$items || empty($items)) {
                        echo "<h3> Sorry, no items Available till now.</h3>";
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
                        echo "</form>" . "</div>";

                        echo "<div class='col-md-8'>" . "<img class='card-img-top' src='images/item.jpg' alt='No picture available'>";
                        echo "</div>" . "</div>" . "</div>" . "<br>";
                    }
                ?>
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

        $("#namesearch").keyup(function() {
            let pattern = /^[A-Za-z0-9]+$/;
            let keyword = $("#namesearch").val();
            if(keyword === "") {
                $("#message").html("Search content cannot be empty");
                $("#searchbutton").prop("disabled", true);
            }
            else if(!pattern.test(keyword)){
                $("#message").html("No symbols in search pls");
                $('#searchbutton').prop("disabled", true);
            }else{
                $("#message").html("");
                $('#searchbutton').prop("disabled", false);
            }
        });

        $("#filterForm input").click(function() {
            $("#filterButton").prop("disabled", false);
            $("#message2").html("");
        });

        $("#sortForm input").click(function() {
            $("#sortButton").prop("disabled", false);
            $("#message3").html("");
        });

        function validation() {
            let input = document.getElementById("namesearch").value;
            if(input === "") {
                document.getElementById("message").innerHTML = "Enter something to search";
                document.getElementById('searchbutton').disabled = true;
            }
        }

    </script>
</body>

</html>