<?php
declare(strict_types=1);

namespace App;

use Cake\Core\Configure;
use Cake\Core\ContainerInterface;
use Cake\Core\Exception\MissingPluginException;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Http\Middleware\BodyParserMiddleware;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Http\MiddlewareQueue;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

class Application extends BaseApplication
{
    public function bootstrap(): void
    {
        parent::bootstrap();
        
        // Router 초기화
        Router::reload();

        if (PHP_SAPI === 'cli') {
            $this->bootstrapCli();
        }

        // DebugKit은 캐시 설정이 완료된 후에만 로드
        // if (Configure::read('debug')) {
        //     $this->addPlugin('DebugKit');
        // }
    }
    
    public function routes(RouteBuilder $routes): void
    {
        // BaseApplication의 routes()가 config/routes.php를 로드함
        parent::routes($routes);
    }

    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middlewareQueue
            ->add(new ErrorHandlerMiddleware(Configure::read('Error')))
            ->add(new AssetMiddleware([
                'cacheTime' => Configure::read('Asset.cacheTime'),
            ]))
            ->add(new RoutingMiddleware($this))
            ->add(new BodyParserMiddleware())
            ->add(new CsrfProtectionMiddleware([
                'httponly' => true,
            ]));

        return $middlewareQueue;
    }

    public function services(ContainerInterface $container): void
    {
    }

    protected function bootstrapCli(): void
    {
        try {
            $this->addPlugin('Bake');
        } catch (MissingPluginException $e) {
        }
    }
}

