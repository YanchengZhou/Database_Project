<?php
    spl_autoload_register(function($classname) {
        include "$classname.php";
    });

    $db = new Database();
    $allsubmissions = $db->query("select * from uploadhistory");
    $jsonObj = json_encode($allsubmissions);
    echo $jsonObj;