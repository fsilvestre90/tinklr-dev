<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Marker.php";
    require_once "src/Bathroom.php";

    $server = 'mysql:host=localhost:8889;dbname=tinklr';
    $username = 'root';
    $password = 'root';

    $DB = new PDO($server, $username, $password);

    class MarkerTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     Marker::deleteAll();
        //     Bathroom::deleteAll();
        // }

        function test_getName()
        {
            $name = "Pok Pok";
            $address = "123 abcd street";
            $lat = 34.3435345;
            $lng = 41.9847594;
            $type = "Bar";

            $test_marker = new Marker($name, $address, $lat, $lng, $type);

            $result = $test_marker->getName();

            $this->assertEquals($name, $result);
        }
	}
?>