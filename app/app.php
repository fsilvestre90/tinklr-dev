<?php

    // DEPENDENCIES
        require_once __DIR__."/../vendor/autoload.php"; // frameworks
        require_once __DIR__."/../src/Marker.php";
        require_once __DIR__."/../src/Bathroom.php";
        require_once __DIR__."/../src/Review.php";

    //ENABLE HTTP PARAMETER OVERRIDE
        use Symfony\Component\HttpFoundation\Request;
        Request::enableHttpMethodParameterOverride();

    //DEBUGGER *DISABLED IN PROD*
        use Symfony\Component\Debug\Debug;
        Debug::enable();

    //INITIALIZE DATABASE CONNECTION
        try{
            $server = 'mysql:host=localhost:8889;dbname=tinklr';
            $username = 'root';
            $password = 'root';
            $DB = new PDO($server, $username, $password);
            $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set Errorhandling to Exception
        } catch (PDOException $e) {
            echo "There was an error: " . $e->getMessage();
        }

    // INITIALIZE APPLICATION
        $app = new Silex\Application();
        $app['debug'] = true;
        $app->register(new Silex\Provider\TwigServiceProvider(), array(
            'twig.path' => __DIR__."/../views"
        ));

    // ROUTES

        // display index webpage
        $app->get('/', function() use ($app) {

            return $app['twig']->render('index.html.twig');
        });

        // display index webpage
        $app->get('/add_bathroom', function() use ($app) {

            return $app['twig']->render('add_bathroom.html.twig');
        });

/************************** Admin Area ***************************************/

        // Admin sign-in
        $app->get('/sign-in', function() use ($app){

            return $app['twig']->render('admin_signin.html.twig');
        });

        // Admin Page
        $app->get('/admin', function() use ($app){

            return $app['twig']->render('admin.html.twig', array('bathrooms' => Bathroom::getAll(), 'markers' => Marker::getAll()));
        });

        // Admin bathroom Page
        $app->get('/admin_delete/{id}', function($id) use ($app) {
            //Get all bathrooms
            $bathrooms = Bathroom::getAll();
            $marker = Marker::find($id);

            //Go through bathrooms and grab the one associated with the
            ///marker ID
            $found_bathroom = null;
            foreach($bathrooms as $bathroom)
            {
                if($id == $bathroom->getMarkerId())
                {
                    $found_bathroom = $bathroom;
                }
            }

            //DESTROY!!!!!!
            $bathroom->delete();
            $marker->delete();

            return $app['twig']->render('admin.html.twig', array('bathrooms' => Bathroom::getAll(), 'markers' => Marker::getAll()));

        });


        // Bathroom list
        $app->get('/bathrooms', function() use($app) {

            return $app['twig']->render('add_bathroom.html.twig', array('bathrooms' => Bathroom::getAll(), 'markers' => Marker::getAll(), 'form_check' => false));
        });

        $app->get('/bathroom_form', function() use($app) {

            return $app['twig']->render('add_bathroom.html.twig', array('bathrooms' => Bathroom::getAll(), 'markers' => Marker::getAll(), 'form_check' => true));
        });

        
        $app->post('/add_bathroom', function() use($app) {
            $name = $_POST['name'];
            $address = $_POST['address'];
            $type = $_POST['type'];
            $marker = new Marker($name, $address, null, null, $type);
            
            $marker->getLatLngFromGoogleMaps($address);
            $marker->save();

            
            $unisex = $_POST['unisex'];
            $key_required = $_POST['key_required']; 
            $public = $_POST['public'];
            $handicap = $_POST['handicap'];
            $changing_table = $_POST['changing_table'];
            $marker_id = $marker->getId();
            
            $bathroom = new Bathroom($unisex, $key_required, $public ,$handicap, $changing_table, $marker_id);
            $bathroom->save();

            return $app['twig']->render('add_bathroom.html.twig', array('bathrooms' => Bathroom::getAll(), 'markers' => Marker::getAll(), 'form_check' => false));
        });

        $app->get('/bathroom/{id}', function($id) use ($app){
            $bathroom = Bathroom::find($id);
            $marker = Marker::find($id);
            $reviews = Review::getReviewsForBathroom($bathroom);

            return $app['twig']->render('bathroom.html.twig', array('bathroom' => $bathroom, 'marker' => $marker, 'reviews' => $reviews));
        });


        // reviews

        $app->get('/add_review/{id}', function($id) use ($app){
            $marker = Marker::find($id);

            return $app['twig']->render('add_review.html.twig', array('marker' => $marker));
        });

        $app->post('/add_review/{id}', function($id) use ($app){
            $review = $_POST['review'];
            $rating = $_POST['rating'];
            //get all the necessary objects
            $marker = Marker::find($id);
            $bathroom = Bathroom::find($marker->getId());
            //create new review obj
            $new_review = new Review($rating, $review);
            $new_review->save();
            $review_id = $new_review->getId();
            $bathroom->addReview($review_id);

            $reviews = Review::getReviewsForBathroom($bathroom);

            return $app['twig']->render('bathroom.html.twig', array('bathroom' => $bathroom, 'marker' => $marker, 'reviews' => $reviews));
        });

    return $app;

?>
