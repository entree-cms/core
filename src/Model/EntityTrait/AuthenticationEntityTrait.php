<?php
declare(strict_types=1);

namespace EntreeCore\Model\EntityTrait;

trait AuthenticationEntityTrait
{
    // ********************************************************
    // * Using user entity as the Identity
    // ********************************************************

    /**
     * Authentication\IdentityInterface method
     *
     * @return array|string|int|null
     */
    public function getIdentifier(): array|string|int|null
    {
        return $this->id;
    }
}
