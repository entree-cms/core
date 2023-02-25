<?php
declare(strict_types=1);

namespace EntreeCore;

use Authentication\Middleware\AuthenticationMiddleware;
use Authorization\Middleware\AuthorizationMiddleware;
use Cake\Console\CommandCollection;
use Cake\Core\BasePlugin;
use Cake\Core\Configure;
use Cake\Core\ContainerInterface;
use Cake\Core\PluginApplicationInterface;
use Cake\Http\MiddlewareQueue;
use EntreeCore\Authentication\AuthenticationServiceProvider;
use EntreeCore\Authorization\AuthorizationServiceProvider;

/**
 * Plugin for EntreeCore
 */
class Plugin extends BasePlugin
{
    /**
     * Load all the plugin configuration and bootstrap logic.
     *
     * The host application is provided as an argument. This allows you to load
     * additional plugin dependencies, or attach events.
     *
     * @param \Cake\Core\PluginApplicationInterface $app The host application
     * @return void
     */
    public function bootstrap(PluginApplicationInterface $app): void
    {
        if (!defined('DS')) {
            define('DS', DIRECTORY_SEPARATOR);
        }

        require dirname(__DIR__) . DS . 'config' . DS . 'basics.php';

        if (!defined('ENTREE_CORE_DEFAULT_STORAGE')) {
            $root = defined('ROOT') ? ROOT : dirname(dirname(dirname(__DIR__)));
            define('ENTREE_CORE_DEFAULT_STORAGE', $root . DS . 'storage' . DS);
        }

        // Load an environment default configuration file
        $this->loadConfig();

        $app->addPlugin('Authentication');
        $app->addPlugin('Authorization');

        // DebugKit settings
        Configure::write('DebugKit.ignoreAuthorization', true);
    }

    /**
     * Add middleware for the plugin.
     *
     * @param \Cake\Http\MiddlewareQueue $middlewareQueue The middleware queue to update.
     * @return \Cake\Http\MiddlewareQueue
     */
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        return $middlewareQueue
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

    // *********************************************************
    // * Internal methods
    // *********************************************************

    /**
     * Load EntreeCore configure
     *
     * @internal
     * @return void
     */
    private function loadConfig(): void
    {
        Configure::load('EntreeCore.plugin_entree_core', 'default');
        if (file_exists(CONFIG . 'plugin_entree_core.php')) {
            Configure::load('plugin_entree_core', 'default');
        }
    }
}
