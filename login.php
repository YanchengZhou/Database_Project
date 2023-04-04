<?php
    require("connect-db.php");
    global $db;

    $password = "";

    function checkIfExist($email) {
        global $db;
        global $password;
        $query = "select * from User";
        $result = $db->query($query);
        if ($result->rowCount() > 0) {
            foreach($result as $row) {
                if($row["email"] == $email) {
                    $password = $row["password"];
                    return true;
                }
            }
        }
        return false;
    }

    function getUserInfo($email) {
        global $db;
        $query = "select * from User";
        $result = $db->query($query);
        if ($result->rowCount() > 0) {
            foreach($result as $row) {
                if($row["email"] == $email) {
                    return $row;
                }
            }
        }
        return array();
    }

    function makeAlert($message) {
        echo "<script> alert('$message') </script>";
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($_POST['loginbutton']) && ($_POST['loginbutton'] == "login")) {
            if(checkIfExist($_POST["email"])) {
                if($password != $_POST["password"]) {
                    makeAlert("Wrong password, please try again!");
                } else {
                    $userInfo = getUserInfo($_POST["email"]);

                    session_start();
                    $_SESSION["userID"] = $userInfo["userID"];
                    $_SESSION["name"] = $userInfo["name"];
                    $_SESSION["email"] = $_POST["email"];

                    $message = "successfully log in as " . $_POST["email"];
                    makeAlert($message);
                    echo "<script>
                        document.location = 'index.php';
                      </script>";
                }
            } else {
                makeAlert("Your email does not exist in the system, plean sign up first!");
                echo "<script>
                        document.location = 'signup.php';
                      </script>";
            }
        } else {
            makeAlert("Error in log in inputs, please try again!");
        }
    }

?>


<!DOCTYPE html>

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
            <h1 class="form-item" style="padding-bottom: 20px;"> Log in your account here! </h1>
            <form method="post">
                <h4 class="form-item" style="padding-bottom: 20px;">(Please input your email and password)</h4>
                <div class="form-item">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" maxlength="40" class="form-control" id="email" name="email" required/>
                    <h6 style= "color:red" id="warning1"></h6>
                </div>
                <div class="form-item">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" maxlength="40" class="form-control" id="password" name="password"/>
                    <h6 style= "color:red" id="warning0"></h6>
                </div>

                <div class="inline-container" style="padding-right:10%; margin-top:10px;">
                    <div class="form-item" style="padding-top: 30px">
                        <button id = "javabutton" name="loginbutton" type="submit" value="login" class="btn btn-primary">Log in</button>
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

</html>