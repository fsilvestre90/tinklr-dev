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
			$this->zipcode = $new_zipcaddress;	
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
		
		
	}	
?>