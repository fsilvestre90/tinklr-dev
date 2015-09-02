<?php
    /**
    * @backupGlobals disabled
    * @backupAtrributes disabled
    */
    require_once "src/Review.php";
    // require_once "src/Marker.php";

    $server = 'mysql:host=localhost:8889;dbname=Tinklr_test;';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ReviewTest extends PHPUnit_Framework_TestCase
    {

      protected function tearDown()
      {
          Review::deleteAll();
          // Marker::deleteAll();
      }

      function test_getId()
      {
         //Arrange
         $id = null;
         $rating = 1;
         $comment = "This place sucks!";

         $test_review = new Review($rating, $comment, $id);
         $test_review->save();

         //Act
         $result = $test_review->getId();

         //Assert
         $this->assertEquals(true, is_numeric($result));
      }

      function test_getRating()
      {
         //Arrange
         $rating = 1;
         $test_review = new Review($rating, $comment, $id);

         //Act
         $result = $test_review->getRating();

         //Assert
         $this->assertEquals($rating, $result);
      }

      function test_getComment()
      {
         //Arrange
         $comment = "This bathroom is the worst!";
         $test_review = new Review($rating, $comment, $id);

         //Act
         $result = $test_review->getComment();

         //Assert
         $this->assertEquals($comment, $result);
      }

      function test_save()
      {
          //Arrange
          $id = null;
          $rating = 1;
          $comment = "This place sucks!";

          $test_review = new Review($rating, $comment, $id);
          $test_review->save();

          //Act
          $result = Review::getAll();

          //Assert
          $this->assertEquals($test_review, $result[0]);
      }

      function test_getAll()
      {
          //Arrange
          $id = null;
          $rating = 1;
          $comment = "This place sucks!";

          $test_review = new Review($rating, $comment, $id);
          $test_review->save();

          $id2 = null;
          $rating2 = 2;
          $comment2 = "This place sucks!";

          $test_review2 = new Review($rating2, $comment2, $id2);
          $test_review2->save();

          //Act
          $result = Review::getAll();

          //Assert
          $this->assertEquals([$test_review, $test_review2], $result);
      }

      function test_deleteAll()
      {
          //Arrange
          $id = null;
          $rating = 1;
          $comment = "This place sucks!";

          $test_review = new Review($rating, $comment, $id);
          $test_review->save();

          $id2 = null;
          $rating2 = 2;
          $comment2 = "This place sucks!";

          $test_review2 = new Review($rating2, $comment2, $id2);
          $test_review2->save();

          //Act
          Review::deleteAll();
          $result = Review::getAll();

          //Assert
          $this->assertEquals([], $result);
      }

      function test_find()
      {
          //Arrange
          $id = null;
          $rating = 1;
          $comment = "This place sucks!";

          $test_review = new Review($rating, $comment, $id);
          $test_review->save();

          $id2 = null;
          $rating2 = 2;
          $comment2 = "This place sucks!";

          $test_review2 = new Review($rating2, $comment2, $id2);
          $test_review2->save();

          //Act
          $result = Review::find($test_review2->getId());

          //Assert
          $this->assertEquals($test_review2, $result);
      }
    }
 ?>
