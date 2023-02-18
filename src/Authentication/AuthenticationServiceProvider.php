<?php
declare(strict_types=1);

namespace EntreeCore\Authentication;

use Authentication\AuthenticationService;
use Authentication\AuthenticationServiceInterface;
use Authentication\AuthenticationServiceProviderInterface;
use Cake\Core\Configure;
use Cake\Routing\Router;
use Psr\Http\Message\ServerRequestInterface;

class AuthenticationServiceProvider implements AuthenticationServiceProviderInterface
{
    /**
     * Get authentication service
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request The request
     * @return \Authentication\AuthenticationServiceInterface
     */
    public function getAuthenticationService(ServerRequestInterface $request): AuthenticationServiceInterface
    {
        $unauthRedirect = Router::url(
            Configure::read('Entree.unauthRedirect') ?? [
                'plugin' => 'EntreeCore',
                'prefix' => '',
                'controller' => 'Users',
                'action' => 'login',
            ]
        );

        $service = new AuthenticationService();
        $service->setConfig([
            'unauthenticatedRedirect' => $unauthRedirect,
            'queryParam' => 'redirect',
        ]);
        $service->loadAuthenticator('Authentication.Session');
        $service->loadAuthenticator('Authentication.Form');
        $service->loadIdentifier('Authentication.Password', [
            'resolver' => [
                'className' => 'Authentication.Orm',
                'finder' => 'authentication',
                'userModel' => \EntreeCore\Model\Table\UsersTable::class,
            ],
        ]);

        return $service;
    }
}
