<?php

	class Bathroom
	{
		private $unisex;
		private $key_required;
		private $public;
		private $handicap;
		private $changing_table;
		private $marker_id;
		private $id;



		function __construct($unisex, $key_required, $public, $handicap, $changing_table, $marker_id, $id = null)
		{
			$this->unisex = $unisex;
			$this->key_required = $key_required;
			$this->public = $public;
			$this->handicap = $handicap;
			$this->changing_table = $changing_table;
			$this->marker_id = $marker_id;
			$this->id = $id;
		}

		function getUnisex()
		{
			return $this->unisex;
		}

		function setUnisex($new_unisex)
		{
			$this->unisex = $new_unisex;

		}

		function getKey_required()
		{
			return $this->key_required;
		}

		function setKey_required($new_key_required)
		{
			$this->key_required = $new_key_required;
		}

		function getPublic()
		{
			return $this->public;
		}

		function setPublic($new_public)
		{
			$this->public = $new_public;
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

		function getMarkerId()
		{
			return $this->marker_id;
		}

		function setMarkerId($new_marker_id)
		{
			$this->marker_id = $new_marker_id;
		}

		//Database methods
		function save()
		{
			$GLOBALS['DB']->exec(
				"INSERT INTO bathrooms (unisex, key_required, public, handicap, changing_table, marker_id) VALUES(
					{$this->getUnisex()},
					{$this->getKey_required()},
					{$this->getPublic()},
					{$this->getHandicap()},
					{$this->getChangingTable()},
					{$this->getMarkerId()}
				);"
			);
            $this->id = $GLOBALS['DB']->lastInsertId();
		}

		function update_bathroom($new_unisex, $new_key_required, $new_public, $new_handicap, $new_changing_table)
		{
			$GLOBALS['DB']->exec("UPDATE bathrooms SET unisex = '{$new_unisex}', key_required = '{$new_key_required}', public = '{$new_public}', handicap = '{new_handicap}', changing_table = '{new_changing_table}' WHERE id = $id;");
			$this->setUnisex($new_unisex);
			$this->setKey_required($new_key_required);
			$this->setPublic($new_public);
			$this->setHandicap($new_handicap);
			$this->setChangingTable($new_changing_table);
			$this->setMarkerId($new_marker_id);
		}

		static function getAll()
		{
			$returned_bathrooms = $GLOBALS['DB']->query("SELECT * FROM bathrooms");
			$bathrooms =array();
			foreach($returned_bathrooms as $bathroom)
			{
				$unisex = (int) $bathroom['unisex'];
				$key_required = (int) $bathroom['key_required'];
				$public = (int) $bathroom['public'];
				$handicap = (int) $bathroom['handicap'];
				$changing_table = (int) $bathroom['changing_table'];
				$marker_id = (int) $bathroom['marker_id'];
				$id = (int) $bathroom['id'];
				$new_bathroom = new Bathroom($unisex, $key_required, $public, $handicap, $changing_table, $marker_id, $id);
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
					$found_bathroom = array($bathroom->getunisex, $bathroom->getkey_required(), $bathroom->getpublic(), $bathroom->getHandicap, $bathroom->getpublic());
				}
			}
			return $found_bathroom;
		}
		
		function addReview($review_id)
        {
            $GLOBALS['DB']->exec("INSERT INTO reviews_bathrooms (bathroom_id, review_id) VALUES ({$this->getId()}, {$review_id});");
        }
        
        function getReviews()
        {
            $returned_reviews = $GLOBALS['DB']->query("SELECT reviews.* FROM
                bathrooms JOIN reviews_bathrooms ON (bathrooms.id = reviews_bathrooms.bathroom_id)
                JOIN reviews ON (reviews_bathrooms.review_id = reviews.id)
                WHERE bathrooms.id = {$this->getId()};");

            $reviews = array();
            foreach($returned_reviews as $review)
            {
				$rating = $review['rating'];                
				$comment = $review['comment'];
                $id = $review['id'];
                $new_review = new Review($rating, $comment, $id);
                array_push($reviews, $new_review);
            }

            return $reviews;
        }

	}





?>
