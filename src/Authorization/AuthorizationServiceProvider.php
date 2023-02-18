<?php
declare(strict_types=1);

namespace EntreeCore\Authorization;

use Authorization\AuthorizationService;
use Authorization\AuthorizationServiceInterface;
use Authorization\AuthorizationServiceProviderInterface;
use Authorization\Policy\OrmResolver;
use Psr\Http\Message\ServerRequestInterface;

class AuthorizationServiceProvider implements AuthorizationServiceProviderInterface
{
    /**
     * Get authorization service
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request The request
     * @return \Authorization\AuthorizationServiceInterface
     */
    public function getAuthorizationService(ServerRequestInterface $request): AuthorizationServiceInterface
    {
        $resolver = new OrmResolver();
        $service = new AuthorizationService($resolver);

        return $service;
    }
}
