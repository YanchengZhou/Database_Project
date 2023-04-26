<?php
    require("connect-db.php");
    global $db;

    function checkIfExist($email) {
        global $db;
        $query = "select * from User";
        $result = $db->query($query);
        if ($result->rowCount() > 0) {
            foreach($result as $row) {
                if($row["email"] == $email) {
                    return true;
                }
            }
        }
        return false;
    }

    function addNewUser($email, $password, $name, $gender, $age, $phone, $bio)
    {
        global $db;
        if (empty($age)) {
            $age = 'NULL';
        } else {
            $age = (int)$age;
        }
        $hash_result = hash('sha256', $password);
        $query = "INSERT INTO User (password, gender, age, phone, email, bio, name, portrait) 
          VALUES ('$hash_result', '$gender', $age, '$phone', '$email', '$bio', '$name', '');";
        $statement = $db->prepare($query);
        $statement->execute();
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(!empty($_POST['signupbutton']) && ($_POST['signupbutton'] == "signup")) {
            if(!checkIfExist($_POST['email'])) {
                addNewUser($_POST['email'], $_POST['password'], $_POST['name'],
                    $_POST['gender'], $_POST['age'], $_POST['phone'], $_POST['bio']);

                session_start();
                $_SESSION["userID"] = $db->lastInsertId();
                $_SESSION["name"] = $_POST["name"];
                $_SESSION["email"] = $_POST["email"];

                $message = 'Hi, ' . $_POST['name'] . ", you have successfully signed up and logged in as " . $_POST['email'];
                echo "<script>
                        alert('$message')
                        document.location = 'index.php';
                      </script>";
            }
            else {
                $message = "Sorry, the email has been registered. Please try another one!";
                echo "<script> alert('$message') </script>";
            }
        }
    }
?>


<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<style>
    .form-item {
        width: 40%;
        margin: auto;
        padding-top: 10px;
    }

    .inline-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 0 auto;
        width: 60%;
    }
</style>

<section class="container">
    <div class="row" style="padding-top: 50px">
        <div class= "col-12">
            <h1 class="form-item" style="padding-bottom: 20px;"> Sign up your account now! </h1>
            <form method="post">
                <h4 class="form-item">(Only email, password and name are mandatory)</h4>
                <div class="form-item">
                    <label for="email" class="form-label">(*) Email:</label>
                    <input type="email" maxlength="40" class="form-control" id="email" name="email" required/>
                    <h6 style= "color:red" id="warning1"></h6>
                </div>
                <div class="form-item">
                    <label for="password" class="form-label">(*) Password:</label>
                    <input type="password" maxlength="40" class="form-control" id="password" name="password" required/>
                    <h6 style= "color:red" id="warning0"></h6>
                </div>
                <div class="form-item">
                    <label for="name" class="form-label">(*) Name:</label>
                    <input type="text" maxlength="40" class="form-control" id="name" name="name" required/>
                </div>
                <div class="form-item">
                    <label for="gender" class="form-label">Gender:</label>
                    <input type="text" maxlength="40" class="form-control" id="gender" name="gender" placeholder="not specified" />
                </div>
                <div class="form-item">
                    <label for="age" class="form-label">Age:</label>
                    <input type="number" maxlength="3" class="form-control" id="age" name="age" placeholder="not specified"/>
                </div>
                <div class="form-item">
                    <label for="contact" class="form-label">Phone:</label>
                    <input type="text" maxlength="60" class="form-control" id="phone" name="phone" placeholder="not specified"/>
                </div>
                <div class="form-item">
                    <label for="note" class="form-label">Bio:</label>
                    <input type="text" maxlength="150" class="form-control" id="bio" name="bio" placeholder="not specified"/>
                </div>

                <div class="inline-container" style="padding-right:10%; margin-top:10px;">
                    <div class="form-item" style="padding-top: 30px">
                        <button id = "javabutton" name="signupbutton" type="submit" value="signup" class="btn btn-primary">Sign Up</button>
                    </div>

                    <a href="index.php" style="padding-top: 30px">
                        <button type="button" id = "cancelbutton" class="btn btn-secondary">
                            Cancel
                        </button>
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>


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

</html>