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
        $app->get('/admin_bathroom/{id}', function($id) use ($app) {
            //Get all bathrooms
            $bathrooms = Bathroom::getAll();

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

            //Handle null values
            if($found_bathroom->getUnisex == null)
            {
                $found_bathroom->setUnisex == 'No Data';
            }
            if($found_bathroom->getKey_required == null)
            {
                $found_bathroom->setKey_required == 'No Data';
            }
            if($found_bathroom->getPublic == null)
            {
                $found_bathroom->setPublic == 'No Data';
            }
            if($found_bathroom->getHandicap == null)
            {
                $found_bathroom->setHandicap == 'No Data';
            }
            if($found_bathroom->getChangingTable == null)
            {
                $found_bathroom->setChangingTable == 'No Data';
            }

            return $app['twig']->render('admin_bathroom.html.twig', array('bathroom' => $found_bathroom, 'marker' => Marker::find($id)));
        });


        // Bathroom list
        $app->get('/bathrooms', function() use($app) {

            return $app['twig']->render('add_bathroom.html.twig', array('bathrooms' => Bathroom::getAll(), 'markers' => Marker::getAll(), 'form_check' => false));
        });

        $app->get('/bathroom_form', function() use($app) {

            return $app['twig']->render('add_bathroom.html.twig', array('bathrooms' => Bathroom::getAll(), 'markers' => Marker::getAll(), 'form_check' => true));
        });

        $app->post("/add_bathroom", function() use ($app) {
            $marker = new Marker($_POST['name'], $_POST['address'], $_POST['type']);
            $marker->save();

            $bathroom = new Bathroom($_POST['unisex'], $_POST['key_required'], $_POST['public'], $_POST['handicap'], $_POST['changing_table'],$_POST['marker_id']);
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
            $new_review = new Review($rating, $review);
            $new_review->save();

            $marker = Marker::find($id);
            $bathroom = Bathroom::find($marker->getId());
            var_dump($bathroom);
            $reviews = Review::getReviewsForBathroom($bathroom);

            return $app['twig']->render('bathroom.html.twig', array('bathroom' => $bathroom, 'marker' => $marker, 'reviews' => $reviews));
        });

    return $app;

?>
