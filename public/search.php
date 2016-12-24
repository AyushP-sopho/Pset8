<?php

    require(__DIR__ . "/../includes/config.php");

    // numerically indexed array of places
    $places = [];

    // TODO: search database for places matching $_GET["geo"], store in $places
    if(!empty($_GET["geo"]))
    {
        //$query = CS50::query("SELECT * FROM places WHERE place_name LIKE ")
        $rows = CS50::query("SELECT * FROM `places` WHERE MATCH(`postal_code`, `place_name`, `admin_name1`) AGAINST(?)", $_GET["geo"]);
        
        foreach($rows as $row)
        {
            //$entry = sprintf("%s, %s %s", $row["place_name"], $row["admin_name1"], $row["postal_code"]);
            array_push($places, $row);
        }
    }
    
    // output places as JSON (pretty-printed for debugging convenience)
    header("Content-type: application/json");
    print(json_encode($places, JSON_PRETTY_PRINT));

?>