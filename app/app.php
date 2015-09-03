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

<<<<<<< HEAD
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
            var_dump($bathrooms);

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

=======
        // Admin Page
        $app->get('/admin_bathroom/{id}', function($id) use ($app){
            $bathroom = Bathroom::find($id);

            return $app['twig']->render('admin.html.twig', array('bathroom' => $bathroom));
        });
>>>>>>> 803968f9bb370f748afd2c639e5a58e5753d63bb

    return $app;

?>
