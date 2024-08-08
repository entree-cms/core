<?php
declare(strict_types=1);

namespace EntreeCore;

use Authentication\Middleware\AuthenticationMiddleware;
use Authorization\Middleware\AuthorizationMiddleware;
use Cake\Console\CommandCollection;
use Cake\Core\BasePlugin;
use Cake\Core\ContainerInterface;
use Cake\Http\MiddlewareQueue;
use Cake\Routing\RouteBuilder;
use EntreeCore\Authentication\AuthenticationServiceProvider;
use EntreeCore\Authorization\AuthorizationServiceProvider;

/**
 * Plugin for EntreeCore
 */
class EntreeCorePlugin extends BasePlugin
{
    /**
     * Add routes for the plugin.
     *
     * If your plugin has many routes and you would like to isolate them into a separate file,
     * you can create `$plugin/config/routes.php` and delete this method.
     *
     * @param \Cake\Routing\RouteBuilder $routes The route builder to update.
     * @return void
     */
    public function routes(RouteBuilder $routes): void
    {
        parent::routes($routes);
    }

    /**
     * Add middleware for the plugin.
     *
     * @param \Cake\Http\MiddlewareQueue $middlewareQueue The middleware queue to update.
     * @return \Cake\Http\MiddlewareQueue
     */
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        // Add your middlewares here
        $middlewareQueue
            // Add the AuthenticationMiddleware. It should be after routing and body parser.
            ->add(new AuthenticationMiddleware(
                new AuthenticationServiceProvider()
            ))

            // Add the AuthorizationMiddleware *after* routing, body parser and authentication middleware.
            ->add(new AuthorizationMiddleware(
                new AuthorizationServiceProvider(),
                [
                    'identityDecorator' => function ($auth, $user) {
                        return $user->setAuthorization($auth);
                    },
                ]
            ));

        return $middlewareQueue;
    }

    /**
     * Add commands for the plugin.
     *
     * @param \Cake\Console\CommandCollection $commands The command collection to update.
     * @return \Cake\Console\CommandCollection
     */
    public function console(CommandCollection $commands): CommandCollection
    {
        // Add your commands here

        $commands = parent::console($commands);

        return $commands;
    }

    /**
     * Register application container services.
     *
     * @param \Cake\Core\ContainerInterface $container The Container to update.
     * @return void
     * @link https://book.cakephp.org/4/en/development/dependency-injection.html#dependency-injection
     */
    public function services(ContainerInterface $container): void
    {
        // Add your services here
    }
}
