<?php

    // DEPENDENCIES
        require_once __DIR__."/../vendor/autoload.php"; // frameworks
        require_once __DIR__."/../src/Marker.php";

    //ENABLE HTTP PARAMETER OVERRIDE
        use Symfony\Component\HttpFoundation\Request;
        Request::enableHttpMethodParameterOverride();

    //DEBUGGER *DISABLED IN PROD*
        use Symfony\Component\Debug\Debug;
        Debug::enable();

    //INITIALIZE DATABASE CONNECTION
        try{
            $server = 'mysql:host=localhost:8889;dbname=shoe_store';
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

            return $app['twig']->render('tinklr.html.twig');
        });

        // display index webpage
        $app->get('/add_bathroom', function() use ($app) {

            return $app['twig']->render('add_bathroom.html.twig');
        });


    return $app;

?>
