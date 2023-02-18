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
     * @return int
     */
    public function getIdentifier()
    {
        return $this->id;
    }
}
