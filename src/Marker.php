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
	}	
?>