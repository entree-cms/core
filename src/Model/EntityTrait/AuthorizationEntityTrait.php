<?php
declare(strict_types=1);

namespace EntreeCore\Model\EntityTrait;

use Authorization\AuthorizationServiceInterface;
use Authorization\Policy\ResultInterface;
use Cake\Http\Exception\InternalErrorException;

/**
 * AuthorizationEntityTrait
 *
 * @property \Authorization\AuthorizationServiceInterface $authorization
 */
trait AuthorizationEntityTrait
{
    // ********************************************************
    // * User-defined functions
    // ********************************************************

    /**
     * Cannot check
     *
     * @param string $action The action
     * @param mixed $resource The resource
     * @return bool
     */
    public function cannot(string $action, $resource = null): bool
    {
        return !$this->can($action, $resource);
    }

    /**
     * Has permission.
     *
     * @param string|array $permCodes Permission code(s)
     * @return bool
     * @throws \Cake\Http\Exception\InternalErrorException When pass invalid permission code(s) to argument.
     */
    public function hasPermission($permCodes)
    {
        if ($this->hasRole('admin')) {
            return true;
        }

        // Get owned permission codes
        $roles = $this->roles ?? null;
        if (!$roles) {
            return false;
        }
        $ownedPermCodes = [];
        foreach ($roles as $role) {
            $ownedPerms = $role->permissions ?? [];
            foreach ($ownedPerms as $perm) {
                $ownedPermCodes[] = $perm->code;
            }
        }

        $permCodes = $this->formatCodes($permCodes);
        foreach ($permCodes as $permCode) {
            if (in_array($permCode, $ownedPermCodes)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Has role.
     *
     * @param string|array $roleCodes Role code(s)
     * @return bool
     * @throws \Cake\Http\Exception\InternalErrorException When pass invalid role code(s) to argument.
     */
    public function hasRole($roleCodes)
    {
        // Get owned role codes
        $ownedRoles = $this->roles ?? null;
        if (!$ownedRoles) {
            return false;
        }
        $ownedRoleCodes = array_column($ownedRoles, 'code');

        $roleCodes = $this->formatCodes($roleCodes);
        foreach ($roleCodes as $roleCode) {
            if (in_array($roleCode, $ownedRoleCodes)) {
                return true;
            }
        }

        return false;
    }

    // ********************************************************
    // * User-defined private methods
    // ********************************************************

    /**
     * Format role and permission code(s)
     *
     * @param array|string $codes role or permission codes
     * @return array
     * @throws \Cake\Http\Exception\InternalErrorException
     */
    private function formatCodes($codes)
    {
        if (is_string($codes)) {
            $codes = explode('|', $codes);
        }

        if (!is_array($codes)) {
            throw new InternalErrorException('Passed invalid code(s).');
        }
        foreach ($codes as $code) {
            if (!is_string($code)) {
                throw new InternalErrorException('Passed invalid code(s).');
            }
        }

        return $codes;
    }

    // ********************************************************
    // * Using user entity as the Identity
    // ********************************************************

    /**
     * @inheritDoc
     */
    public function applyScope($action, $resource)
    {
        return $this->authorization->applyScope($this, $action, $resource);
    }

    /**
     * @inheritDoc
     */
    public function can(string $action, $resource = null): bool
    {
        if (!$resource) {
            if ($this->hasRole('admin')) {
                return true;
            }

            return $this->hasPermission($action);
        }

        return $this->authorization->can($this, $action, $resource);
    }

    /**
     * @inheritDoc
     */
    public function canResult($action, $resource): ResultInterface
    {
        return $this->authorization->canResult($this, $action, $resource);
    }

    /**
     * @inheritDoc
     */
    public function getOriginalData()
    {
        return $this;
    }

    /**
     * Setter to be used by the middleware.
     *
     * @param \Authorization\AuthorizationServiceInterface $service The service
     * @return self
     */
    public function setAuthorization(AuthorizationServiceInterface $service)
    {
        $this->authorization = $service;

        return $this;
    }
}
