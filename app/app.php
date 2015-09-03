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

        // Admin Page
        $app->get('/admin', function() use ($app){

            return $app['twig']->render('admin.html.twig', array('bathrooms' => Bathroom::getAll(), 'markers' => Marker::getAll()));
        });

        // Admin bathroom Page
        $app->get('/bathroom/{id}', function($id) use ($app) {
            //Get all bathrooms
            $bathrooms = Bathroom::getAll();

            //Go through bathrooms and grab the one associated with the
            ///marker ID
            foreach($bathrooms as $bathroom)
            {
                if($id == $bathroom->getMarkerId())
                {
                    $found_bathroom = $bathroom;
                }
            }

            return $app['twig']->render('admin_bathroom.html.twig', array('bathroom' => $found_bathroom));
        });


    return $app;

?>
