<?php
namespace App;

use App\Controller\AuthController;
use App\Controller\WalletController;

class Router
{
    private function __construct() {}

    private static array $routes = [
        '/wallet/index'   => [WalletController::class, 'index'],
        '/wallet/creer'   => [WalletController::class, 'creerWallet'],
        '/wallet/depot'   => [WalletController::class, 'depot'],
        '/wallet/retrait' => [WalletController::class, 'retrait'],
        '/auth/login'     => [AuthController::class,   'login'],
        '/auth/logout'    => [AuthController::class,   'logout'],
    ];

    public static function run(): void
    {
        $uri = $_SERVER['REQUEST_URI'];

        [$controllerClass, $method] = self::$routes[$uri] ?? [AuthController::class, 'login'];

        $controller = new $controllerClass();
        $controller->$method();
    }
}