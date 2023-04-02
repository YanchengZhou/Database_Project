<!DOCTYPE html>

 <html lang="en">
     <head>
         <meta charset="utf-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1"> 
         <meta name="author" content="Yancheng Zhou(worked on this), Xiyuan Song(worked on this)">
         <meta name="description" content="uploadpage">
         <meta name="keywords" content="sprint">  
         <link rel="stylesheet" type="text/css" href="styles/info_upload.css">

         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> 
         <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
         <title>UVA Connect</title> 
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
        
        <section class="container">
            <form action="?command=upload" method="post">
                <div class="row">       
                    <div class= "col-4">
                        <h4>Upload Info</h4>  
                            <ul>
                              <li>
                                  <label for="name">Name:</label><br>
                                  <input style="width: 100%" type="text" maxlength="30" id="nameinput" onmouseout = "validation();" name="itemname" required>
                                  <h6 id="message"></h6>
                              </li>
                              <li>
                                  <label for="time">Time:</label>
                                  <input style="width: 100%" type="date" maxlength="30" id="time" name="time" placeholder="in format like 20201225" required>
                              </li>
                              <li>
                                  <label for="price">Price:</label>
                                  <input style="width: 100%" type="number" step="0.01" maxlength="6" id="price" name="price" required>
                              </li>
                              <li>
                                  <label for="poster">Poster:</label>
                                  <input style="width: 100%" type="text" maxlength="100" id="poster" name="poster" required>
                              </li>
                              <li>
                                  <label for="note">Note:</label>
                                  <input style="width: 100%" type="text" maxlength="100" id="note" name="note" required>
                              </li>
                                <li>
                                    <label for="status">Status:</label><br>
                                    <input type="radio" name="status" value="available" required>
                                    <label>Available</label> &nbsp
                                    <input type="radio" name="status" value="pending" required>
                                    <label>Pending</label> &nbsp
                                    <input type="radio" name="status" value="unavailable" required>
                                    <label>Unavailable</label><br>
                                </li>
                            </ul>
                    </div>
                    <div class= "col-8">  
                        <h4>Upload </h4>
                          <!-- <label for="img">Select image:</label>
                          <input type="file" id="img" name="img" accept="image/*"> -->
                          <p>Please select post category:</p>
                          <input type="radio" id="Items" name="category" value="Used Items" required>
                          <label for="Items">Used Items</label><br>
                          <input type="radio" id="Rentals" name="category" value="Housing">
                          <label for="Rentals">House Rentals</label><br>
                          <input type="radio" id="Carpooling" name="category" value="Carpooling">
                          <label for="Carpooling">Car Pooling</label><br>
                          <input type="radio" id="Other" name="category" value="Other">
                          <label for="Other">Other</label><br>

                          <button class="btn btn-primary" id="submitbutton" type="submit">Submit</button>
                          <input id="reset" class="btn btn-primary" type="reset" value="Reset">
                    </div>             
                </div>
            </form>
        </section>    


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

        <script src="sprint4javascript.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        
        <script type="text/javascript">

            function validation(){
                let input = document.getElementById("nameinput").value;
                if(input === "") {
                    document.getElementById("message").innerHTML = "Name cannot be empty!";
                    document.getElementById('submitbutton').disabled = true;
                }
            }

            $("#reset").click(function() {
                $("#message").html("Name cannot be empty!");
                $('#submitbutton').prop("disabled", true);
            });

            $("#nameinput").keyup(function() {
                let pattern = /^[A-Za-z0-9]+$/;
                let keyword = $("#nameinput").val();
                if(keyword === "") {
                    $("#message").html("Name cannot be empty!");
                    $('#submitbutton').prop("disabled", true);
                } else if(!pattern.test(keyword)){
                    $("#message").html("No symbols pls");
                    $('#submitbutton').prop("disabled", true);
                }else{
                    $("#message").html("");
                    $('#submitbutton').prop("disabled", false);
                }
            });

        </script>
    </body>
 </html>





