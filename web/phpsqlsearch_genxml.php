<?php
try{
    $server = 'mysql:host=localhost:8889;dbname=tinklr';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set Errorhandling to Exception
} catch (PDOException $e) {
    echo "There was an error: " . $e->getMessage();
}
    // Get parameters from URL
    $center_lat = $_GET["lat"];
    $center_lng = $_GET["lng"];
    $radius = $_GET["radius"];

    // Start XML file, create parent node
    $dom = new DOMDocument("1.0");
    $node = $dom->createElement("markers");
    $parnode = $dom->appendChild($node);

    // Search the rows in the markers table
    try{
        $result_markers = $GLOBALS['DB']->query("SELECT address, name, lat, lng, ( 3959 * acos( cos( radians('$center_lat') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('$center_lng') ) + sin( radians('$center_lat') ) * sin( radians( lat ) ) ) ) AS distance FROM markers HAVING distance < '$radius' ORDER BY distance LIMIT 0 , 20;");
    } catch (PDOException $e) {
        echo "There was an error: " . $e->getMessage();
    }

    header("Content-type: text/xml");
    // Iterate through the rows, adding XML nodes for each
    foreach($result_markers as $marker)
    {
        $name = $marker['name'];
        $address = $marker['address'];
        $lat = $marker['lat'];
        $lng = $marker['lng'];
        $distance = $marker['distance'];

        $node = $dom->createElement("marker");
        $newnode = $parnode->appendChild($node);
        $newnode->setAttribute("name", $name);
        $newnode->setAttribute("address", $address);
        $newnode->setAttribute("lat", $lat);
        $newnode->setAttribute("lng", $lng);
        $newnode->setAttribute("distance", $distance);
    }

    echo $dom->saveXML();
?>
