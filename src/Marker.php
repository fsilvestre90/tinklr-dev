<?php 
	class Marker
	{
		private $name;
		private $address;
		private $city;
		private $state;
		private $zipcode;
		private $type;
		private $id;
		
		function __construct($name, $address, $city, $state, $zipcode, $type, $id)
		{
			$this->name = $name;
			$this->address = $address;
			$this->city = $city;
			$this->state = $state;
			$this->zipcode = $zipcode;
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
		
		function getCity()
		{
			return $this->city;
		}
		
		function setCity($new_city)
		{
			$this->city = $new_city;
		}
		
		function getState()
		{
			return $this->state;
		}
		
		function setState($new_state)
		{
			$this->state = $new_state;
		}
		
		function getZipcode()
		{
			return $this->zipcode;
		}
		
		function setZipcode($new_zipcode)
		{
			$this->zipcode = $new_zipcode;	
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
            $GLOBALS['DB']->exec("INSERT INTO bathrooms (name, address, city, state) VALUES ('{$this->getName()}',
             '{$this->getAddress()}',
             '{$this->getCity()}',
             '{$this->getState()}',
			 '{$this->getZipcode}',
			 '{$this->getType}')"
             );
            
			$this->id = $GLOBALS['DB']->lastInsertId();
        }
		
		function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM markers WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM bathrooms_markers WHERE marker_id = {$this->getId()};");
        }
		
		static function getAll()
        {
            $returned_markers = $GLOBALS['DB']->query("SELECT * from markers;");
            
            $markers = array();
            
            foreach($returned_markers as $marker) {
                $name = $marker['name'];
				$address = $marker['address'];
				$city = $marker['city'];
				$state = $marker['state'];
				$zipcode = $marker['zipcode'];
				$type = $marker['type'];
                $id = $marker['id'];
                $new_marker = new Marker($name, $address, $city, $state, $zipcode, $type, $id);
                array_push($markers, $new_marker);
            }
            return $markers;
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
		
	}	
?>