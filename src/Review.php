<?php

class Review
{
    //Properties
    private $id;
    private $rating;
    private $comment;

    //Constructor
    function __construct($rating, $comment, $id = null)
    {
        $this->rating = $rating;
        $this->comment = $comment;
        $this->id = $id;
    }

    /************* Getters and Setters ****************/

    ////Rating;
    function getRating()
    {
        return $this->rating;
    }
    function setRating($new_rating)
    {
        $this->rating = $new_rating;
    }

    ////Comment
    function getComment()
    {
        return $this->comment;
    }
    function setComment($new_comment)
    {
        $this->comment = $new_comment;
    }

    ////ID
    function getId()
    {
        return $this->id;
    }

    /****************** Save & GetAll *******************/

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO reviews (rating, comment) VALUES ({$this->getRating}, '{$this->getComment}'); ");

        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    function getAll()
    {
        $returned_reviews = $GLOBALS['DB']->query("SELECT * FROM reviews ORDER BY id;");
            $reviews = array();
            foreach($returned_reviews as $review) {
                $rating = $review['rating'];
                $id = $review['id'];
                $comment = $comment['comment'];
                $new_review = new Review($review, $comment, $id);
                array_push($reviews, $new_review);
            }
        return $reviews;
    }

    /********************* Find **********************/
    static function find($search_id)
    {
        $found_review = null;
        $review = Client::getAll();
        foreach($reviews as $review) {
            $review_id = $review->getId();
            if ($review_id == $search_id) {
                $found_review = $review;
            }
        }
        return $found_review;
    }

    /************** DELETE ***************************/
    function deleteReview()
    {
        $GLOBALS['DB']->exec("DELETE FROM reviews WHERE id = {$this->getId()};");
        $GLOBALS['DB']->exec("DELETE FROM reviews_bathrooms WHERE reviews_id = {$this->getId()};");
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM reviews;");
    }

    /**************** UPDATE ***********************/
    function updateReview()
    {
        $GLOBALS['DB']->exec("UPDATE reviews SET reviews = {$new_review} WHERE id = {$this->getId()}");
        $this->setReview($new_review);
    }

}

?>
