<?php
	
	class Bathroom
	{
		private $name;
		private $gender;
		private $key;
		private $stall;
		private $handicap;
		private $changing_table;
		private $id;


		function __construct($name, $gender, $key, $stall, $handicap, $changing_table, $id = null)
		{
			$this->name = $name;
			$this->gender = $gender;
			$this->key = $key;
			$this->stall = $stall;
			$this->handicap = $handicap;
			$this->changing_table = $changing_table;
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

		function getGender()
		{
			return $this->gender;
		}

		function setGender($new_gender)
		{
			$this->gender = $new_gender;

		}

		function getKey()
		{
			return $this->key;
		}

		function setKey($new_key)
		{
			$this->key = $new_key;
		}

		function getStall()
		{
			return $this->stall;
		}

		function setStall($new_stall)
		{
			$this->stall = $new_stall;
		}

		function getHandicap()
		{
			return $this->handicap;
		}

		function setHandicap($new_handicap)
		{
			$this->handicap = $new_handicap;
		}

		function getChangingTable()
		{
			return $this->changing_table;
		}

		function setChangingTable($new_changing_table)
		{
			$this->changing_table = $new_changing_table;
		}

		function getId()
		{
			return $this->id;
		}

		//Database methods
		function save()
		{
			$GLOBALS['DB']->exec(
				"INSERT INTO bathrooms (name, gender, key, stall, handicap, changing_table, id) VALUES(
					'{$this->getName()}',
					'{$this->getGender()}',
					'{$this->getKey()}',
					'{$this->getStall()}',
					'{$this->getHandicap()}',
					'{$this->getChangingTable()}'
					'{$this->getId()}'
				);" 
			);
			$this->id = $GLOBALS['DB']->lastInsertId();
		}

		function update_bathroom($new_gender, $new_key, $new_stall, $new_handicap, $new_changing_table)
		{
			$GLOBALS['DB']->exec("UPDATE bathrooms SET gender = '{$new_gender}', key = '{$new_key}', stall = '{$new_stall}', handicap = '{new_handicap}', changing_table = '{new_changing_table}' WHERE id = $id;");
			$this->setGender($new_gender);
			$this->setKey($new_key);
			$this->setStall($new_stall);
			$this->setHandicap($new_handicap);
			$this->setChangingTable($new_changing_table);
		}

		static function getAll()
		{
			$returned_bathrooms = $GLOBALS['DB']->query("SELECT * FROM bathrooms");
			$bathrooms =array();
			foreach($returned_bathrooms as $bathroom)
			{
				$gender = $bathroom['gender'];
				$key = $bathroom['key'];
				$stall = $bathroom['stall'];
				$handicap = $bathroom['handicap'];
				$changing_table = $bathroom['changing_table'];
				$id = $bathroom['id'];
				$new_bathroom = new Bathroom($gender, $key, $stall, $handicap, $changing_table, $id);
				array_push($bathrooms, $new_bathroom);
			}
			return $bathrooms;
		}

		static function deleteAll()
		{
			$GLOBALS['DB']->exec("DELETE FROM bathrooms;");
		}

		static function find($search_id)
		{
			$found_bathroom = null;
			$bathrooms = Bathroom::getAll();
			foreach($bathrooms as $bathroom) {
				$bathroom_id = $bathroom->getId();
				if ($bathroom_id == $search_id) {
					$found_bathroom = $bathroom;
				}
			}
			return $found_bathroom;
		}

		static function find_bathroom($search_id)
		{
			$found_bathroom = array();
			$bathrooms = Bathroom::getAll();
			foreach($bathrooms as $bathroom) {
				$bathroom_id = $bathroom->getId();
				if ($bathroom_id == $search_id) {
					$found_bathroom = array($bathroom->getGender, $bathroom->getKey(), $bathroom->getStall(), $bathroom->getHandicap, $bathroom->getStall());
				}
			}
			return $found_bathroom;
		}

	}





?>