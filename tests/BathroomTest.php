<?php
    
    /**
    * @backupGlobals disabled
    * @backupStatic Attributes disabled
    */

    require_once "src/Bathroom.php";
 

		$server = 'mysql:host=localhost:8889;dbname=tinklr_test';
		$username = 'root';
		$password = 'root';
		$DB = new PDO($server, $username, $password);

    class BathroomTest extends PHPUnit_Framework_TestCase
    {
    	protected function tearDown()
    	{

    	}

    	function test_getName()
    	{
    		//Arrange
    		$name = "Starbucks Bathroom";
    		$gender = "male";
    		$key = '1';
    		$stall = '0';
    		$handicap = '1';
    		$changing_table = '1';
    		$id = 1;

    		$test_bathroom = new Bathroom($name, $gender, $key, $stall, $handicap, $changing_table, $id);

    		$result = $test_bathroom->getName();
    		var_dump($test_bathroom);


    		$this->assertEquals($name, $result);
    	}

    	function test_setName()
    	{
    		$name = "Starbucks Bathroom";
    		$test_bathroom = new Bathroom($name, $gender, $key, $stall, $handicap, $changing_table, $id);

    		$test_bathroom->setName("Target Bathroom");

    		$result = $test_bathroom->getName();

    		$this->assertEquals("Target Bathroom", $result);
    	}

    	function test_getGender()
    	{
    		//Arrange
    		$gender = "Male";
    		$id = null;
    		$test_gender = new Bathroom($name, $gender, $key, $stall, $handicap, $changing_table, $id);

    		//Act
    		$result = $test_gender->getGender();

    		//Assert
    		$this->assertEquals($gender, $result);
    	}

    	function test_setGender()
    	{
    		//Arrange
    		$gender = "Male";
    		$id = null;
    		$test_gender = new Bathroom($name, $gender, $key, $stall, $handicap, $changing_table, $id);
    		$test_gender->setGender("Female");

    		//Act
    		$result = $test_gender->getGender();

    		//Assert
    		$this->assertEquals("Female", $result);
    	}

    	function test_getKey()
    	{
    		//Arrange
    		$key = '1';
    		$id = null;
    		$test_key = new Bathroom($name, $gender, $key, $stall, $handicap, $changing_table, $id);

    		//act
    		$result = $test_key->getKey();

    		//Assert
    		$this->assertEquals($key, $result);
    	}

    	function test_setKey()
    	{
    		//Arrange
    		$key = '01';
    		$id = null;
    		$test_key = new Bathroom($name, $gender, $key, $stall, $handicap, $changing_table, $id);
    		
    		//Act	
    		$test_key->setKey("10");
    		$result = $test_key->getKey();

    		//Assert
    		$this->assertEquals("10", $result);
    	}

    	function test_getStall()
    	{
    		//Arrange
    		$stall = '01';
    		$id = null;
    		$test_stall = new Bathroom($name, $gender, $key, $stall, $handicap, $changing_table, $id);

    		//Act
    		$result = $test_stall->getStall();

    		//Assert
    		$this->assertEquals($stall, $result);
    	}

    	function test_setStall()
    	{
    		//Arrange
    		$stall = '00';
    		$id = null;
    		$test_stall = new Bathroom($name, $gender, $key, $stall, $handicap, $changing_table, $id);

    		//Act
    		$test_stall->setStall('01');
    		$result = $test_stall->getStall();

    		//Assert
    		$this->assertEquals('01', $result);
    	}

    	function test_getHandicap()
    	{
    		//Arrange
    		$handicap = '1';
    		$id = null;
    		$test_handicap = new Bathroom($name, $gender, $key, $stall, $handicap, $changing_table, $id);
    		
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
    		$test_handicap = new Bathroom($name, $gender, $key, $stall, $handicap, $changing_table, $id);

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
    		$test_changingTable = new Bathroom($name, $gender, $key, $stall, $handicap, $changing_table, $id);

    		//Act
    		$result = $test_changingTable->getChangingTable();

    		//Assert
    		$this->assertEquals($changing_table, $result);
    	}

    	function test_setChangingTable()
    	{
    		//Arrange
    		$changing_table = '0';
    		$id = null;
    		$test_changingTable = new Bathroom($name, $gender, $key, $stall, $handicap, $changing_table, $id);

    		//Act
    		$test_changingTable->setChangingTable('1');
    		$result = $test_changingTable->getChangingTable();

    		//Assert
    		$this->assertEquals('1', $result);
    	}

    	function test_getId()
    	{
    		//Arrange
    		$name = "Starbucks Bathroom";
    		$gender = "male";
    		$key = '01';
    		$stall = '00';
    		$handicap = '01';
    		$changing_table = '01';
    		$id = 1;
    		$test_bathroom = new Bathroom($name, $gender, $key, $stall, $handicap, $changing_table, $id);
    		$test_bathroom->save();
    		
    		//Act
    		$result = $test_bathroom->getId();

    		//Assert
    		$this->assertEquals(true, is_numeric($result));
    	}
   
    	function test_save()
    	{
    		$name = "Starbucks Bathroom";
    		$gender = "male";
    		$key = '1';
    		$stall = '0';
    		$handicap = '1';
    		$changing_table = '1';
    		$id = 1;
    		$test_bathroom = new Bathroom($name, $gender, $key, $stall, $handicap, $changing_table, $id);
    		$test_bathroom->save();

    		$result = Bathroom::getAll();

    		$this->assertEquals($test_bathroom, $result[0]);
    	}

   //  	function test_deleteAll()
   //  	{
   //  		$name = "Starbucks Bathroom";
   //  		$gender = "male";
   //  		$key = '0';
   //  		$stall = '0';
   //  		$handicap = '0';
   //  		$changing_table = '0';
   //  		$id = 1;
   //  		$test_bathroom = new Bathroom($name, $gender, $key, $stall, $handicap, $changing_table, $id);
   //  		$test_bathroom->save();

   //  		$name2 = "Target Bathroom";
   //  		$gender2 = "female";
   //  		$key2 = '1';
   //  		$stall2 = '1';
   //  		$handicap2 = '1';
   //  		$changing_table2 = '1';
   //  		$id2 = 1;
   //  		$test_bathroom2 = new Bathroom($name2, $gender2, $key2, $stall2, $handicap2, $changing_table2, $id2);
   //  		$test_bathroom2->save();

   //  		// $test_bathroom->addBathroom($test_bathroom->getId());
   //  		// $test_bathroom->addBathroom($test_bathroom2->getId());

			// // $test_bathroom->deleteAllBathrooms($test_bathroom->getId());
			// Bathroom::deleteAll();
			// $result = Bathroom::getAll();

			// $this->assertEquals([], $result);
   //  	}

   //  	function test_find()
   //  	{
   //  		//Arrange	
   //  		$name = "Starbucks Bathroom";
   //  		$gender = "male";
   //  		$key = '0';
   //  		$stall = '0';
   //  		$handicap = '0';
   //  		$changing_table = '0';
   //  		$id = 'id';
   //  		$test_bathroom = new Bathroom($name, $gender, $key, $stall, $handicap, $changing_table, $id);
   //  		$test_bathroom->save();

   //  		$name2 = "Target Bathroom";
   //  		$gender2 = "female";
   //  		$key2 = '0';
   //  		$stall2 = '0';
   //  		$handicap2 = '0';
   //  		$changing_table2 = '0';
   //  		$id2 = 2;
   //  		$test_bathroom2 = new Bathroom($name2, $gender2, $key2, $stall2, $handicap2, $changing_table2, $id2);
   //  		$test_bathroom2->save();

   //  		//Act
   //  		$result = Bathroom::find($test_bathroom->getId());

   //  		//Assert
   //  		$this->assertEquals($test_bathroom, $result);

   //  	}
    }
