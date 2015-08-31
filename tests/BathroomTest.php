<?php
    
    /**
    * @backupGlobals disabled
    * @backupStatic Attributes disabled
    */

    require_once "src/Bathroom.php"
    require_once "src/Marker.php"

    $server = 'mysql:host=localhost;dbname';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BathroomTest extends PHPUnit_Framework_TestCase
    {
    	protected function tearDown()
    	{

    	}

    	function test_getGender()
    	{
    		//Arrange
    		$gender = "Male";
    		$id = null;
    		$test_gender = new Gender($gender);

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
    		$test_gender = new Gender($gender, $id);
    		$test_gender->setGender("Female");

    		//Act
    		$result = $test_gender->getGender();

    		//Assert
    		$this->assertEquals("Female", $result);
    	}

    	function test_getKey()
    	{
    		//Arrange
    		$key = '01';
    		$id = null;
    		$test_key = new Key($key);

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
    		$test_key = new Key($key, $id);
    		
    		//Act	
    		$test_key->setKey("10");
    		$result = $test_key->getKey();

    		//Assert
    		$this->assertEquals("10", $result);
    	}

    	function test_getStall()
    	{
    		//Arrange
    		$stall = '3';
    		$id = null;
    		$test_stall = new Stall($stall, $id)

    		//Act
    		$result = $test_stall->getStall();

    		//Assert
    		$this->assertEquals($stall, $result);
    	}

    	function test_setStall()
    	{
    		//Arrange
    		$stall = '3';
    		$id = null;
    		$test_stall = new Stall($stall, $id);

    		//Act
    		$test_stall->setStall('2');
    		$result = $test_stall->getStall();

    		//Assert
    		$this->assertEquals('2', $result);
    	}

    	function test_getHandicap()
    	{
    		//Arrange
    		$handicap = '1';
    		$id = null;
    		$test_handicap = new Handicap($handicap, $id);
    		
    		//Act
    		$result = $test_handicap->getHandicap();	
    		
    		//Assert
    		$this->assertEquals($handicap, $result)
    	}

    	function test_setHandicap()
    	{
    		//Arrange
    		$handicap = '1';
    		$id = null;
    		$test_handicap = new Handicap($handicap, $id);

    		//Act
    		$test_handicap->setHandicap('2');
    		$result = $test_handicap->getHandicap();

    		//Assert
    		$this->assertEquals('2', $result);
    	}

    	function test_getChangingTable()
    	{
    		//Arrange
    		$changing_table = '1';
    		$id = null;
    		$test_changingTable = new ChangingTable($changing_table, $id);

    		//Act
    		$result = $test_changingTable->getChangingTable();

    		//Assert
    		$this->assertEquals($changing_table, $result);
    	}

    	function test_setChangingTable()
    	{
    		//Arrange
    		$changing_table = '1';
    		$id = null;
    		$test_changingTable = new ChangingTable($changing_table, $id);

    		//Act
    		$test_changingTable->setChangingTable('2');
    		$result = $test_changingTable->getChangingTable();

    		//Assert
    		$this->assertEquals('2', $result);
    	}

    	function test_getId()
    	{
    		//Arrange
    		$gender = "male"
    		$id = 1;
    		$
    		//Act
    		//Assert
    	}
    }
