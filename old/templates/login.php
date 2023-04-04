<!DOCTYPE html>

 <html lang="en">
     <head>
         <meta charset="utf-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1"> 
         <meta name="author" content="Yancheng Zhou(worked on this), Xiyuan Song(worked on this)">
         <meta name="description" content="basicinfo">
         <meta name="keywords" content="sprint">  
         <link rel="stylesheet" type="text/css" href="styles/info_upload.css">
         <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> 

         <title>UVA Connect Login</title> 
     </head>
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
            <div class="row">
                <div class= "col-12">
                    <h5 class="text-center" style="color:white;">Only email, password and name are mandatory</h5>
                    
                    <form action="?command=login" method="post">
                        <div style="width:40%; margin: auto;">
                            <label for="email" class="form-label" style="color:white;">Email:</label>
                            <input type="email" maxlength="40" class="form-control" id="email" name="email" required/>
                            <h6 style= "color:red" id="warning1"></h6>
                        </div>
                        <div style="width:40%; margin: auto;">
                            <label for="password" class="form-label" style="color:white;">Password:</label>
                            <input type="password" maxlength="40" class="form-control" id="password" name="password" required/>
                            <h6 style= "color:red" id="warning0"></h6>
                        </div>
                        <div style="width:40%; margin: auto;">
                            <label for="name" class="form-label" style="color:white;">Name:</label>
                            <input type="text" maxlength="40" class="form-control" id="name" name="name" required/>
                        </div>
                        <div style="width:40%; margin: auto;">
                            <label for="gender" class="form-label" style="color:white;">Gender:</label>
                            <input type="text" maxlength="40" class="form-control" id="gender" name="gender" placeholder="not specified" />
                        </div>
                        <div style="width:40%; margin: auto;">
                            <label for="age" class="form-label" style="color:white;">Age:</label>
                            <input type="text" maxlength="3" class="form-control" id="age" name="age" placeholder="not specified"/>
                        </div>
                        <div style="width:40%; margin: auto;">
                            <label for="contact" class="form-label" style="color:white;">Contact:</label>
                            <input type="text" maxlength="60" class="form-control" id="contact" name="contact" placeholder="not specified"/>
                        </div>
                        <div style="width:40%; margin: auto; padding-bottom: 20px;">
                            <label for="note" class="form-label" style="color:white;">Notes:</label>
                            <input type="text" maxlength="150" class="form-control" id="note" name="note" placeholder="not specified"/>
                        </div>

                        <div class="text-center">                
                            <button id = "javabutton" type="submit" class="btn btn-primary">login/signup</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>    


        <div class="container">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                <p class="col-md-4 mb-0 text-muted" >© All rights authorized to Zhou, Song, 2022</p>

                <ul class="nav col-md-8 justify-content-end">
                    <li class="nav-item"><a href="?command=index" class="nav-link px-2 text-muted">Home</a></li>
                    <li class="nav-item"><a href="?command=usedItems" class="nav-link px-2 text-muted">Used Items</a></li>
                    <li class="nav-item"><a href="?command=rentals" class="nav-link px-2 text-muted">House Rentals</a></li>
                    <li class="nav-item"><a href="?command=carpooling" class="nav-link px-2 text-muted">Carpooling</a></li>
                    <li class="nav-item"><a href="?command=account" class="nav-link px-2 text-muted">Account</a></li>
                </ul>
            </footer>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script type="text/javascript">

            //anon function jquery
            $(document).ready(function() {
                //arrow function
                let matchPattern = (email) => (/\S+@\S+/).test(email);

                let emailValid = true;
                let pwValid = true;

                $("#email").keyup( function(){

                    let email = $("#email").val();
                    if(email === "") {
                        document.getElementById("warning1").innerHTML = "email cannot be empty!";
                        emailValid = false;
                    }
                    else if(!matchPattern(email)){
                        document.getElementById("warning1").innerHTML = "email is invalid, should be ...@...";
                        $("#javabutton").prop('disabled', true);
                        emailValid = false;
                    }else{
                        document.getElementById("warning1").innerHTML = "";
                        emailValid = true;
                        if(pwValid) {
                            $("#javabutton").prop('disabled', false);
                        }
                    }
                });

                $("#password").keyup( function(){
                    let pwlen = $("#password").val().length;
                    if(pwlen === 0) {
                        $("#javabutton").prop('disabled', true);
                        document.getElementById("warning0").innerHTML = "Password cannot be empty!";
                        pwValid = false;
                    }
                    else if(pwlen>25){
                        $("#javabutton").prop('disabled', true);
                        document.getElementById("warning0").innerHTML = "Password too long!";
                        pwValid = false;
                    }else{
                        pwValid = true;
                        if(emailValid) {
                            $("#javabutton").prop('disabled', false);
                        }
                        document.getElementById("warning0").innerHTML = "";
                    }
                });
            });

        </script>
    </body>
 </html>
