<?php
	class Marker
	{
		private $name;
		private $address;
		private $lat;
		private $lng;
		private $type;
		private $id;

		function __construct($name, $address, $lat = null, $lng = null, $type, $id=null)
		{
			$this->name = $name;
			$this->address = $address;
			$this->lat = $lat;
			$this->lng = $lng;
			$this->type = $type;
			$this->id = $id;
		}

		function getName()
		{
			return $this->name;
		}

		function setName($new_name)
		{
			$this->name = $new_name;
		}

		function getAddress()
		{
			return $this->address;
		}

		function setAddress($new_address)
		{
			$this->address = $new_address;
		}

		function getLat()
		{
			return $this->lat;
		}

		function setLat($new_lat)
		{
			$this->lat = $new_lat;
		}

		function getLng()
		{
			return $this->lng;
		}

		function setLng($new_lng)
		{
			$this->lng = $new_lng;
		}

		function getType()
		{
			return $this->type;
		}

		function setType($new_type)
		{
			$this->type = $new_type;
		}

		function getId()
		{
			return $this->id;
		}

		function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO markers (name, address, lat, lng, type) VALUES ('{$this->getName()}',
             '{$this->getAddress()}',
              {$this->getLat()},
              {$this->getLng()},
			 '{$this->getType()}');"
             );

			$this->id = $GLOBALS['DB']->lastInsertId();
        }

	    function update($new_name, $new_address, $new_lat, $new_lng, $new_type)
        {
            $GLOBALS['DB']->exec("UPDATE markers SET name = '{$new_name}', address = '{$new_address}', lat = {$new_lat}, lng = {$new_lng}, type = '{$new_type}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
            $this->setAddress($new_address);
            $this->setLat($new_lat);
            $this->setLng($new_lng);
			$this->setType($new_type);
        }

		function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM markers WHERE id = {$this->getId()};");
            // $GLOBALS['DB']->exec("DELETE FROM bathrooms_markers WHERE marker_id = {$this->getId()};");
        }

		static function getAll()
        {
            $returned_markers = $GLOBALS['DB']->query("SELECT id, name, address, lat, lng, type FROM markers;");

            $markers = array();

            foreach($returned_markers as $marker) {
                $name = $marker['name'];
				$address = $marker['address'];
				$lat = (float) $marker['lat'];
				$lng = (float) $marker['lng'];
				$type = $marker['type'];
                $id = $marker['id'];
                $new_marker = new Marker($name, $address, $lat, $lng, $type, $id);
                array_push($markers, $new_marker);
            }
            return $markers;
        }

		static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM markers;");
        }

		static function find($search_id)
        {
            $found_marker = null;
            $markers = Marker::getAll();
            foreach($markers as $marker) {
                $marker_id = $marker->getId();
                if ($marker_id == $search_id) {
                  $found_marker = $marker;
                }
            }
            return $found_marker;
        }

		/*
		* Given an address, return the longitude and latitude using The Google Geocoding API V3
		*
		*/

		function getLatLngFromGoogleMaps($address) {
		    $address = urlencode($address);

		    $url = "http://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false";

		    // Make the HTTP request
		    $data = @file_get_contents($url);
		    // Parse the json response
		    $jsondata = json_decode($data,true);

			$this->setLat($jsondata["results"][0]["geometry"]["location"]["lat"]);
			$this->setLng($jsondata["results"][0]["geometry"]["location"]["lng"]);
		}

	}
?>
