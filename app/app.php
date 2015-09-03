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

        // Admin Page
        $app->get('/admin', function() use ($app){
            //Dummy bathrooms

            return $app['twig']->render('admin.html.twig', array('bathrooms' => Bathroom::getAll(), 'markers' => Marker::getAll()));
        });

        // Bathroom list
        $app->get('/bathroom/{id}', function($id) use ($app){
            $bathroom = Bathroom::find($id);
            $marker = Marker::find($id);

            return $app['twig']->render('bathroom.html.twig', array('bathroom' => $bathroom, 'marker' => $marker));
        });

    return $app;

?>
