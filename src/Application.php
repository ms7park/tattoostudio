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
        
        // Router 초기화 - RouteCollection 생성
        Router::defaultRouteClass('DashedRoute');
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
        // BaseApplication의 routes()가 config/routes.php를 자동으로 로드함
        parent::routes($routes);
    }

    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        // Router가 초기화되지 않았으면 초기화
        if (Router::getRouteCollection() === null) {
            Router::reload();
        }
        
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

