<?php
class connectController {

    private $command;

    private $db;

    public function __construct($command) {
        $this->command = $command;
        $this->db = new Database();
    }
    // NOTE CONTRIBUTION : Yancheng Zhou yz4xy worked on useditems, carpooling etc and login, upload, search, delete, testing the php code
    // Xiyuan Song xs9qpu worked on filter, login, sort, viewmore, upload, testing php code
    // NOTE please: There is a setup.php which is used to generate the table, please use it only once by loading manually to create the table
    public function run() {
        switch($this->command) {
            case "index":
                $this->indexPage();
                break;
            case "usedItems":
                $this->usedItems();
                break;
            case "rentals":
                $this->rentals();
                break;
            case "carpooling":
                $this->carpooling();
                break;
            case "search":
                $this->search();
                break;
            case "filter": // new addition
                $this->filter();
                break;            
            case "sort":  // new addition
                $this->sort();
                break;
            case "upload":
                $this->upload();
                break;
            case "delete":
                $this->delete();
                break;
            case "account":
                $this->account();
                break;
            case "basicinfo":   //new addition
                $this->basicinfo();
                break;
            case "logout":
                $this->endSession();
                break;
            case "login":
            default:
                $this->login();
                break;
        }
    }

    private function endSession() {          
        session_destroy();
        header("Location: ?command=login");
    }
    

    public function indexPage(){
        $items = $this->db->query("select * from uploadhistory");

        include("templates/mainpage.php");
    }

    public function usedItems() {
        $items = $this->db->query("select * from uploadhistory where category = ?", "s", "Used Items");
        include("templates/mainpage.php");
    }

    public function rentals() {
        $items = $this->db->query("select * from uploadhistory where category = ?", "s", "Housing");
        include("templates/mainpage.php");
    }

    public function carpooling() {
        $items = $this->db->query("select * from uploadhistory where category = ?", "s", "Carpooling");
        include("templates/mainpage.php");
    }
    
     public function account() {
        $items = $this->db->query("select * from uploadhistory where userid = ?", "i", $_SESSION["userid"]);
        $userinfo = $this->db->query("select * from user where userid = ?", "i", $_SESSION["userid"]);
        include("templates/account.php");
     }

     public function basicInfo(){
        $item = $this->db->query("select * from uploadhistory where id2 = ?", "i", $_POST["basicinfoid"]);
        include("templates/basicinfo.php");
     }

     public function delete() {
        $delete = $this->db->query("delete from uploadhistory where id2 = ?", "i", $_POST["id"]);
        $postschange = $this->db->query("update user set posts = posts - 1 where userid = ?" ,"s", $_SESSION["userid"]);
        $items = $this->db->query("select * from uploadhistory where userid = ?", "i", $_SESSION["userid"]);
        header("Location: ?command=account");
        include("templates/account.php");
     }

     public function search() {
        // if fail ... then $items will be false, so we already covered it
        $items = $this->db->query("select * from uploadhistory where locate(?, itemname) > 0", 's', $_POST["search"]);        
        include("templates/mainpage.php");
     }

     public function filter(){ //filter posts
        if ($_POST["filterprice"] === "any" && $_POST["filterstate"] !== "any") {
            $items = $this->db->query("select * from uploadhistory where status = ?", 's', $_POST["filterstate"]);        
        }else if ($_POST["filterprice"] !== "any" && $_POST["filterstate"] === "any") {
            if($_POST["filterprice"] === "lessthan10"){
                $items = $this->db->query("select * from uploadhistory where price < ?", 'd', 10);        
            }else if($_POST["filterprice"] === "morethan50"){
                $items = $this->db->query("select * from uploadhistory where price > ?", 'd', 50);        
            }else{
                $items = $this->db->query("select * from uploadhistory where price between ? and ?", 'dd', 10, 50);
            }         
        }else if ($_POST["filterprice"] !== "any" && $_POST["filterstate"] !== "any"){
            if($_POST["filterprice"] === "lessthan10"){
                $items = $this->db->query("select * from uploadhistory where status = ? and price < ?", 'sd', $_POST["filterstate"], 10);        
            }else if($_POST["filterprice"] === "morethan50"){
                $items = $this->db->query("select * from uploadhistory where status = ? and price > ?", 'sd', $_POST["filterstate"], 50);        
            }else{
                $items = $this->db->query("select * from uploadhistory where status = ? and price between ? and ?", 'sdd', $_POST["filterstate"], 10, 50);
            }  
        }else{
            $items = $this->db->query("select * from uploadhistory");        
        }
        include("templates/mainpage.php");
     }

     public function sort(){ //sort posts
        if ($_POST["sorttime"] !== "any" && $_POST["sortprice"] !== "any" && $_POST["sortupvote"] !== "any") {
            if($_POST["sorttime"] === "latest" && $_POST["sortprice"] === "highest" ){
                $items = $this->db->query("select * from uploadhistory order by time DESC, price DESC, upvote DESC");        
            }else if($_POST["sorttime"] === "latest" && $_POST["sortprice"] === "lowest" ){
                $items = $this->db->query("select * from uploadhistory order by time DESC, price ASC, upvote DESC");        
            }else if($_POST["sorttime"] === "earliest" && $_POST["sortprice"] === "highest" ){
                $items = $this->db->query("select * from uploadhistory order by time ASC, price DESC, upvote DESC");        
            }else if($_POST["sorttime"] === "earliest" && $_POST["sortprice"] === "lowest" ){
                $items = $this->db->query("select * from uploadhistory order by time ASC, price ASC, upvote DESC");        
            }     
        } else if($_POST["sorttime"] === "any" && $_POST["sortprice"] !== "any" && $_POST["sortupvote"] !== "any"){
            if($_POST["sortprice"] === "highest"){
                $items = $this->db->query("select * from uploadhistory order by price DESC, upvote DESC");        
            }else if($_POST["sortprice"] === "lowest"){
                $items = $this->db->query("select * from uploadhistory order by price ASC, upvote DESC");        
            }
        } else if($_POST["sorttime"] !== "any" && $_POST["sortprice"] === "any" && $_POST["sortupvote"] !== "any"){
            if($_POST["sorttime"] === "latest"){
                $items = $this->db->query("select * from uploadhistory order by time DESC, upvote DESC");        
            }else if($_POST["sorttime"] === "earliest"){
                $items = $this->db->query("select * from uploadhistory order by time ASC, upvote DESC");        
            }
        } else if($_POST["sorttime"] !== "any" && $_POST["sortprice"] !== "any" && $_POST["sortupvote"] === "any"){
            if($_POST["sorttime"] === "latest" && $_POST["sortprice"] === "highest" ){
                $items = $this->db->query("select * from uploadhistory order by time DESC, price DESC");        
            }else if($_POST["sorttime"] === "latest" && $_POST["sortprice"] === "lowest" ){
                $items = $this->db->query("select * from uploadhistory order by time DESC, price ASC");        
            }else if($_POST["sorttime"] === "earliest" && $_POST["sortprice"] === "highest" ){
                $items = $this->db->query("select * from uploadhistory order by time ASC, price DESC");        
            }else if($_POST["sorttime"] === "earliest" && $_POST["sortprice"] === "lowest" ){
                $items = $this->db->query("select * from uploadhistory order by time ASC, price ASC");        
            }
        } else if($_POST["sorttime"] === "any" && $_POST["sortprice"] === "any" && $_POST["sortupvote"] !== "any"){
            $items = $this->db->query("select * from uploadhistory order by upvote DESC");        
        } else if($_POST["sorttime"] === "latest" && $_POST["sortprice"] === "any" && $_POST["sortupvote"] === "any"){
            $items = $this->db->query("select * from uploadhistory order by time DESC");        
        } else if($_POST["sorttime"] === "earliest" && $_POST["sortprice"] === "any" && $_POST["sortupvote"] === "any"){
            $items = $this->db->query("select * from uploadhistory order by time ASC");        
        } else if($_POST["sorttime"] === "any" && $_POST["sortprice"] === "highest" && $_POST["sortupvote"] === "any"){
            $items = $this->db->query("select * from uploadhistory order by price DESC"); 
        } else if($_POST["sorttime"] === "any" && $_POST["sortprice"] === "lowest" && $_POST["sortupvote"] === "any"){
            $items = $this->db->query("select * from uploadhistory order by price ASC");
        } else{
            $items = $this->db->query("select * from uploadhistory");
        }     
        include("templates/mainpage.php");        
    }

    //since user is logged in, we have access to upload page and session's email and name
    public function upload(){

       if (isset($_POST["note"]) && !empty($_POST["note"]) && isset($_POST["price"]) && !empty($_POST["price"]) && isset($_POST["time"]) && !empty($_POST["time"]) && isset($_POST["status"]) && !empty($_POST["status"]) && isset($_POST["itemname"]) && !empty($_POST["itemname"]) && isset($_POST["poster"]) && !empty($_POST["poster"])){

            //if date invalid, set date to current date
           if(!$this->validateDate($_POST["time"])) {
                $_POST["time"] = date("Y-m-d");
           }

           $data = $this->db->query("update user set posts = posts + 1 where userid = ?" ,"s", $_SESSION["userid"]);


           //update this user's post number by 1
           $data2 = $this->db->query("insert into uploadhistory (itemname, note, price, poster, status, time, category, userid) values (?, ?, ?, ?, ?, ?, ?, ?);","sssssssi",$_POST["itemname"],$_POST["note"],$_POST["price"],$_POST["poster"],$_POST["status"],$_POST["time"],$_POST["category"],$_SESSION["userid"]);
           header("Location: ?command=index");
       }
       include "templates/uploadpage.php";
    }

    public function login() {
        if (isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["name"]) && !empty($_POST["name"]) ) {       
            
            // need to create a table called user
            $data = $this->db->query("select * from user where email = ?;", "s", $_POST["email"]);
            if ($data === false) {
                echo "<div class='alert alert-danger'> Error checking for user.</div>";
            } else if (!empty($data)) {
                if ($data[0]["name"] === $_POST["name"] && password_verify($_POST["password"], $data[0]["password"])) {
                    $_SESSION["name"] = $data[0]["name"];
                    $_SESSION["email"] = $data[0]["email"];
                    //for old users
                    $getuserid = $this->db->query("select * from user where email = ? and name = ?" ,"ss", $_SESSION['email'], $_SESSION['name']);
                    //locate userid from user table create session for userid
                    if (!isset($_SESSION["userid"])){
                        $_SESSION["userid"] = $getuserid[0]["userid"];
                    }

                    
                    header("Location: ?command=index");
                } else{
                    echo "<div class='alert alert-danger'> Password was incorrect.</div>";
                }
            } else {  
                //for new users  
                if(!isset($_POST["gender"]) || empty($_POST["gender"])){
                    $gender = "not specified";
                }else{
                    $gender = $_POST["gender"];
                }
                if(!isset($_POST["age"]) || empty($_POST["age"])){
                    $age = "not specified";
                }else{
                    $age = $_POST["age"];
                }
                if(!isset($_POST["contact"]) || empty($_POST["contact"])){
                    $contact = "not specified";
                }else{
                    $contact = $_POST["contact"];
                }
                if(!isset($_POST["note"]) || empty($_POST["note"])){
                    $note = "not specified";
                }else{
                    $note = $_POST["note"];
                }


                $insert = $this->db->query("insert into user (name, email, password, gender, age, contact, note) values (?, ?, ?, ?, ?, ?, ?);", 
                        "sssssss", $_POST["name"], $_POST["email"], password_hash($_POST["password"], PASSWORD_DEFAULT), $gender, $age, $contact, $note);
                if ($insert === false) {
                    echo "<div class='alert alert-danger'> Error inserting user.</div>";
                }else{
                    $_SESSION["name"] = $_POST["name"];
                    $_SESSION["email"] = $_POST["email"];
                    
                    $getuserid = $this->db->query("select * from user where email = ? and name = ?" ,"ss", $_SESSION['email'], $_SESSION['name']);
                    //locate userid from user table create session for userid
                    if (!isset($_SESSION["userid"])){
                        $_SESSION["userid"] = $getuserid[0]["userid"];
                    }     
                    
                    header("Location: ?command=index");
                }
            }
        }
        include "templates/login.php";
    }

    function validateDate($date, $format = 'Y-m-d'){
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
}