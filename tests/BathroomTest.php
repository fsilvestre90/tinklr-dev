<?php

    /**
    * @backupGlobals disabled
    * @backupStatic Attributes disabled
    */

    require_once "src/Bathroom.php";
    require_once "src/Review.php";


	$server = 'mysql:host=localhost:8889;dbname=tinklr_test';
	$username = 'root';
	$password = 'root';
	$DB = new PDO($server, $username, $password);

    class BathroomTest extends PHPUnit_Framework_TestCase
    {
    	protected function tearDown()
    	{
    		Bathroom::deleteAll();
            Review::deleteAll();
    	}

    	function test_getunisex()
    	{
    		//Arrange
    		$unisex = 0;
    		$key_required = 1;
    	 	$public = 0;
    	 	$handicap = 1;
    	 	$changing_table = 1;
    	 	$marker_id = 2;
    		$id = null;
    		$test_bathroom = new Bathroom($unisex, $key_required, $public, $handicap, $changing_table, $marker_id, $id);

    		//Act
    		$result = $test_bathroom->getunisex();

    		//Assert
    		$this->assertEquals($unisex, $result);
    	}

    	function test_setunisex()
    	{
    		//Arrange
    		$unisex = 0;
    	 	$key_required = 1;
    	 	$public = 0;
    	 	$handicap = 1;
    	 	$changing_table = 1;
    	 	$marker_id = 1;
    		$id = null;
    		$test_unisex = new Bathroom($unisex, $key_required, $public, $handicap, $changing_table, $marker_id, $id);
    		$test_unisex->setunisex(1);

    		//Act
    		$result = $test_unisex->getunisex();

    		//Assert
    		$this->assertEquals(1, $result);
    	}

    	function test_getKey_required()
    	{
    		//Arrange
            $unisex = 0;
    		$key_required = '1';
    		$id = null;
    		$test_key_required = new Bathroom($unisex, $key_required, $public, $handicap, $changing_table, $id);

    		//act
    		$result = $test_key_required->getkey_required();

    		//Assert
    		$this->assertEquals($key_required, $result);
    	}

    	function test_setKey_required()
    	{
    		//Arrange
            $unisex = 0;
    		$key_required = '01';
    		$id = null;
    		$test_key_required = new Bathroom($unisex, $key_required, $public, $handicap, $changing_table, $id);

    		//Act
    		$test_key_required->setkey_required("10");
    		$result = $test_key_required->getkey_required();

    		//Assert
    		$this->assertEquals("10", $result);
    	}

    	function test_getpublic()
    	{
    		//Arrange
    		$public = '1';
    		$id = null;
    		$test_public = new Bathroom($unisex, $key_required, $public, $handicap, $changing_table, $id);

    		//Act
    		$result = $test_public->getpublic();

    		//Assert
    		$this->assertEquals($public, $result);
    	}

    	function test_setpublic()
    	{
    		//Arrange
    		$public = '00';
    		$id = null;
    		$test_public = new Bathroom($unisex, $key_required, $public, $handicap, $changing_table, $id);

    		//Act
    		$test_public->setpublic('01');
    		$result = $test_public->getpublic();

    		//Assert
    		$this->assertEquals('01', $result);
    	}

    	function test_getHandicap()
    	{
    		//Arrange
    		$handicap = '1';
    		$id = null;
    		$test_handicap = new Bathroom($unisex, $key_required, $public, $handicap, $changing_table, $id);

    		//Act
    		$result = $test_handicap->getHandicap();

    		//Assert
    		$this->assertEquals($handicap, $result);
    	}

    	function test_setHandicap()
    	{
    		//Arrange
    		$handicap = '00';
    		$id = null;
    		$test_handicap = new Bathroom($unisex, $key_required, $public, $handicap, $changing_table, $id);

    		//Act
    		$test_handicap->setHandicap('1');
    		$result = $test_handicap->getHandicap();

    		//Assert
    		$this->assertEquals('1', $result);
    	}

    	function test_getChangingTable()
    	{
    		//Arrange
    		$changing_table = '1';
    		$id = null;
    		$test_changingTable = new Bathroom($unisex, $key_required, $public, $handicap, $changing_table, $marker_id, $id);

    		//Act
    		$result = $test_changingTable->getChangingTable();

    		//Assert
    		$this->assertEquals($changing_table, $result);
    	}

    	function test_setChangingTable()
    	{
    		//Arrange
    		$changing_table = 0;
    		$id = null;
    		$test_changingTable = new Bathroom($unisex, $key_required, $public, $handicap, $changing_table, $marker_id, $id);

    		//Act
    		$test_changingTable->setChangingTable('1');
    		$result = $test_changingTable->getChangingTable();

    		//Assert
    		$this->assertEquals('1', $result);
    	}

    	function test_getId()
    	{
    		//Arrange
    		$unisex = 0;
    		$key_required = 1;
    		$public = 0;
    		$handicap = 1;
    		$changing_table = 1;
    		$marker_id = 2;
    		$id = 1;
    		$test_bathroom = new Bathroom($unisex, $key_required, $public, $handicap, $changing_table, $marker_id, $id);
    		$test_bathroom->save();

    		//Act
    		$result = $test_bathroom->getId();

    		//Assert
    		$this->assertEquals(true, is_numeric($result));
    	}

    	function test_getMarkerId()
    	{
    		//Arrange
    		$unisex = 0;
    		$key_required = 1;
    		$public = 0;
    		$handicap = 1;
    		$changing_table = 1;
    		$marker_id = 2;
    		$id = 1;
    		$test_bathroom = new Bathroom($unisex, $key_required, $public, $handicap, $changing_table, $marker_id, $id);
    		$test_bathroom->save();

    		//Act
    		$result = $test_bathroom->getId();
    		var_dump($result);
    		//Assert
    		$this->assertEquals(true, is_numeric($result));
    	}

    	function test_save()
    	{
    		$unisex = 0;
    		$key_required = 1;
    		$public = 1;
    		$handicap = 1;
    		$changing_table = 0;
    		$marker_id = 2;
    		$test_bathroom = new Bathroom($unisex, $key_required, $public, $handicap, $changing_table, $marker_id);
    		$test_bathroom->save();

    		$result = Bathroom::getAll();

    		$this->assertEquals($test_bathroom, $result[0]);
    	}

    	function test_deleteAll()
    	{
    		$unisex = "0";
    		$key_required = '0';
    		$public = '0';
    		$handicap = '0';
    		$changing_table = '0';
   			$marker_id = '3';
    		$id = 1;
    		$test_bathroom = new Bathroom($unisex, $key_required, $public, $handicap, $changing_table, $marker_id, $id);
    		$test_bathroom->save();

    		$unisex2 = 0;
    		$key_required2 = 1;
    		$public2 = 1;
    		$handicap2 = 1;
    		$changing_table2 = 1;
   			$marker_id2 = 2;
    		$id2 = 1;
    		$test_bathroom2 = new Bathroom($unisex2, $key_required2, $public2, $handicap2, $changing_table2, $marker_id2, $id2);
    		$test_bathroom2->save();

    		// $test_bathroom->addBathroom($test_bathroom->getId());
    		// $test_bathroom->addBathroom($test_bathroom2->getId());

			// $test_bathroom->deleteAllBathrooms($test_bathroom->getId());
			Bathroom::deleteAll();
			$result = Bathroom::getAll();

			$this->assertEquals([], $result);
    	}

    	function test_find()
    	{
    		//Arrange
    		$unisex = 0;
    		$key_required = 0;
    		$public = 0;
    		$handicap = 0;
    		$changing_table = 0;
   		$marker_id = 2;
    		$id = 1;
    		$test_bathroom = new Bathroom($unisex, $key_required, $public, $handicap, $changing_table, $marker_id, $id);
    		$test_bathroom->save();


    		$unisex2 = 0;
    		$key_required2 = 0;
    		$public2 = 0;
    		$handicap2 = 0;
    		$changing_table2 = 0;
   			$marker_id = 2;
    		$id2 = 2;
    		$test_bathroom2 = new Bathroom($unisex2, $key_required2, $public2, $handicap2, $changing_table2, $marker_id2, $id2);
    		$test_bathroom2->save();

    		//Act
    		$result = Bathroom::find($test_bathroom->getId());

    		//Assert
    		$this->assertEquals($test_bathroom, $result);

    	}
        
        function test_addReview()
        {
            $unisex = 0;
    		$key_required = 0;
    		$public = 0;
    		$handicap = 0;
    		$changing_table = 0;
            $marker_id = 2;
    		$test_bathroom = new Bathroom($unisex, $key_required, $public, $handicap, $changing_table, $marker_id);
    		$test_bathroom->save();


            $rating = 1;
            $comment = "This place sucks!";   
            $test_review = new Review($rating, $comment);
            $test_review->save();

            $test_bathroom->addReview($test_review->getId());

            $this->assertEquals($test_bathroom->getReviews(), [$test_review]);
        }
        
        function test_getReviews()
        {
            $unisex = 0;
    		$key_required = 0;
    		$public = 0;
    		$handicap = 0;
    		$changing_table = 0;
            $marker_id = 2;
    		$test_bathroom = new Bathroom($unisex, $key_required, $public, $handicap, $changing_table, $marker_id);
    		$test_bathroom->save();
            
            
            $rating = 1;
            $comment = "This place sucks!";
            $test_review = new Review($rating, $comment);
            $test_review->save();
            
            $rating2 = 3;
            $comment2 = "Its aight!";
            $test_review2 = new Review($rating2, $comment2);
            $test_review2->save();

            $test_bathroom->addReview($test_review->getId());
            $test_bathroom->addReview($test_review2->getId());

            $result = $test_bathroom->getReviews();

            $this->assertEquals([$test_review, $test_review2], $result);
        }
    }
?>
