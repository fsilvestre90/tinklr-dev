<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Marker.php";

    $server = 'mysql:host=localhost:8889;dbname=tinklr_test';
    $username = 'root';
    $password = 'root';

    $DB = new PDO($server, $username, $password);

    class MarkerTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Marker::deleteAll();
        }

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

        function test_setName()
        {
            $name = "Pok Pok";
            $address = "123 abcd street";
            $lat = 34.3435345;
            $lng = 41.9847594;
            $type = "Bar";
            $test_marker = new Marker($name, $address, $lat, $lng, $type);

            $test_marker->setName("Whiskey Soda Lounge");

            $result = $test_marker->getName();

            $this->assertEquals("Whiskey Soda Lounge", $result);
        }

        // function test_getAddress()
        // {
        //     $name = "Pok Pok";
        //     $address = "123 abcd street";
        //     $lat = 34.3435345;
        //     $lng = 41.8908908;
        //     $type = "Bar";

        //     $test_marker = new Marker($name, $address, $lat, $lng, $type);

        //     $result = $test_marker->getAddress();

        //     $this->assertEquals($address, $result);
        // }

        // function test_setAddress()
        // {
        //     $name = "Pok Pok";
        //     $address = "123 abcd street";
        //     $lat = 34.3435345;
        //     $lng = 41.8908908;
        //     $type = "Bar";

        //     $test_marker = new Marker($name, $address, $lat, $lng, $type);

        //     $test_marker->setAddress("321 fdg street");

        //     $result = $test_marker->getAddress();

        //     $this->assertEquals($address, $result);
        // }

        // function test_getLat()
        // {
        //     $name = "Pok Pok";
        //     $address = "123 abcd street";
        //     $lat = 34.3435345;
        //     $lng = 41.8908908;
        //     $type = "Bar";

        //     $test_marker = new Marker($name, $address, $lat, $lng);

        //     $result = $test_marker->getWebsite();

        //     $this->assertEquals($lat, $result);
        // }

        // function test_setLat()
        // {
        //     $name = "Pok Pok";
        //     $address = "123 abcd street";
        //     $lat = 34.3435345;
        //     $lng = 41.8908908;
        //     $type = "Bar";

        //     $test_marker = new Marker($name, $address, $lat, $lng, $type);

        //     $test_marker->setLat(42.4321356);
        //     $result = $test_marker->getLat();

        //     $this->assertEquals(42.4321356, $result);
        // }

        // function test_getLng()
        // {
        //     $name = "Pok Pok";
        //     $address = "123 abcd street";
        //     $lat = 34.3435345;
        //     $lng = 41.8908908;
        //     $type = "Bar";

        //     $test_marker = new Marker($name, $address, $lat, $lng, $type);

        //     $result = $test_marker->getLng();

        //     $this->assertEquals($cuisine_id, $result);
        // }


        // function test_setLng()
        // {
        //     $name = "Pok Pok";
        //     $address = "123 abcd street";
        //     $lat = 34.3435345;
        //     $lng = 41.8908908;
        //     $type = "Bar";
        //     $test_marker = new Marker($name, $address, $lat, $lng, $type);

        //     $test_marker->setLng(43.8900987);

        //     $result = $test_marker->getLng();

        //     $this->assertEquals(43.8900987, $result);
        // }

        // function test_getType()
        // {
        //     $name = "Pok Pok";
        //     $address = "123 abcd street";
        //     $lat = 34.3435345;
        //     $lng = 41.9847594;
        //     $type = "Bar";

        //     $test_marker = new Marker($name, $address, $lat, $lng, $type);

        //     $result = $test_marker->getType();

        //     $this->assertEquals($type, $result);
        // }

        // function test_setType()
        // {
        //     $name = "Pok Pok";
        //     $address = "123 abcd street";
        //     $lat = 34.3435345;
        //     $lng = 41.9847594;
        //     $type = "Bar";

        //     $test_marker = new Marker($name, $address, $lat, $lng, $type);
        //     $test_marker->setType("Restaurant");

        //     $result = $test_marker->getType();

        //     $this->assertEquals("Restaurant", $result);
        // }

        // function test_getId()
        // {
        //     $name = "Pok Pok";
        //     $address = "123 abcd street";
        //     $lat = 34.3435345;
        //     $lng = 41.9847594;
        //     $type = "Bar";
        //     $id = 1;

        //     $test_marker = new Marker($name, $address, $lat, $lng, $type, $id);
        //     $test_marker->save();

        //     $result = $test_marker->getId();

        //     $this->assertEquals(true, is_numeric($result));
        // }

        // function test_save()
        // {
        //     $name = "Pok Pok";
        //     $address = "123 abcd street";
        //     $lat = 34.3435345;
        //     $lng = 41.9847594;
        //     $type = "Bar";

        //     $test_marker = new Marker($name, $address, $lat, $lng, $type);
        //     $test_marker->save();

        //     $result = Marker::getAll();

        //     $this->assertEquals($test_marker, $result[0]);
        // }

        // function test_update()
        // {
        //     $test_marker = new Marker("Pok Pok", "123 abcd street", 34.3435345, 41.8908908, "Restaurant");

        //     $new_name = "Whiskey Soda Lounge";
        //     $new_address = "678 DEF street";
        //     $new_lat = 41.8908908;
        //     $new_lng = 34.3435345;
        //     $new_type = "Bar";

        //     $new_marker = new Marker($new_name, $new_address, $new_lat, $new_lng, $new_type);

        //     $test_marker->update($new_name, $new_address, $new_lat, $new_lng, $new_type);

        //     $this->assertEquals($new_marker, $test_marker);
        // }

        // function test_delete()
        // {
        //     $test_marker = new Marker("Pok Pok", "123 abcd street", 34.3435345, 41.8908908, "Restaurant");
        //     $test_marker->save();

        //     $test_marker2 = new Marker("Whiskey Soda Lounge", "678 DEF street", 41.8908908, 34.3435345, "Bar");
        //     $test_marker2->save();

        //     $test_marker->delete();

        //     $this->assertEquals([$test_marker2], Marker::getAll());
        // }
    }
?>