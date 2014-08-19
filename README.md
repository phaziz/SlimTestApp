SlimTestApp
===========

Using Slim PHP-Framework, Twig Template Engine, RedBean-ORM.

	<?php
	
	    require_once 'Slim/Slim.php';
	    require_once 'app/classes/rb.php';
	    require_once 'app/classes/testdata.php';
	    require_once 'app/classes/Twig/Autoloader.php';
	
	    Twig_Autoloader::register();
	    $loader = new Twig_Loader_Filesystem('./app/views');
	
	    $twig = new Twig_Environment($loader, array
	        (
	            'cache' => './app/cache',
	            'debug' => false,
	            'charset' => 'utf-8',
	            'auto_reload' => true,
	            'strict_variables' => true,
	            'autoescape' => true,
	            'optimizations' => -1
	        )
	    );
	
	    $twig -> addFilter('var_dump', new Twig_Filter_Function('var_dump'));
	
	    \Slim\Slim::registerAutoloader();
	
	    $app = new \Slim\Slim(array
	        (
	            'mode' => 'development',
	            'debug' => true
	        )
	    );
	
	    R::setup('mysql:host=localhost;dbname=XXXXX','XXXXX','XXXXX');
	
	    $app -> get('/',function() use ($app)
	        {
	            $app -> redirect('/testdata');
	        }
	    );
	
	    $app -> get('/testdata',function() use ($app,$twig)
	        {
	            $TESTDATA = new Testdata();
	            $TESTDATA -> getTestdata();
	
	            echo $twig -> render('testdata.twig', 
	                array
	                (
	                    'NAME' => 'phaziz',
	                    'TESTDATA' => $TESTDATA
	                )
	            );
	        }
	    );
	
	    $app -> run();
	
	    R::close();