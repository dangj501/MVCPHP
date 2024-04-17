<?php
use DI\Container;
use Psr\Container\ContainerInterface;
use App\Settings\Settings;
use App\Data\DataContext;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
require __DIR__ . '/vendor/autoload.php';

// Inicializar PHP-DI Container
$container =new Container();


// Configurar servicios en el contenedor
$container->set('settings', function () {
    // Cargar settings desde un archivo
    $settings = require __DIR__ . '/app/settings.php';
    return new Settings($settings);
});

$container->set('view', function () {
    $twig = Twig::create(__DIR__ . '/src/Views/', ['cache' => false]);
    return $twig;
});

$container->set('db', function(ContainerInterface $container) {
    return new DataContext($container->get('settings')->get());
});


$app = AppFactory::createFromContainer($container); 

$app->addRoutingMiddleware();
// Define app routes
$routes = require __DIR__ .'/app/routes.php';
$routes ($app);

// Error Middleware para el manejo de errores 
$app->addErrorMiddleware (true, true, true);
// Ejecuta la aplicación
$app->run();