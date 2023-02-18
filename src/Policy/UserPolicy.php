<?php
declare(strict_types=1);

namespace EntreeCore\Policy;

use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;
use EntreeCore\Model\Entity\User;

/**
 * User policy
 */
class UserPolicy implements BeforePolicyInterface
{
    /**
     * Pre conditions
     *
     * @param ?\Authorization\IdentityInterface $loginUser The logged in user
     * @param \EntreeCore\Model\Entity\User $user The User
     * @param string $action The action
     * @return bool|void
     */
    public function before(?IdentityInterface $loginUser, $user, $action)
    {
        if (
            $loginUser
            && method_exists($loginUser, 'hasRole')
            && $loginUser->hasRole('admin')
            && $action !== 'editRole'
        ) {
            return true;
        }
    }

    /**
     * Check if $loginUser can add User
     *
     * @param \EntreeCore\Model\Entity\User $loginUser The logged in user
     * @param \EntreeCore\Model\Entity\User $user The User
     * @return bool
     */
    public function canAdd(User $loginUser, User $user)
    {
        return false;
    }

    /**
     * Check if $loginUser can edit User
     *
     * @param \EntreeCore\Model\Entity\User $loginUser The logged in user
     * @param \EntreeCore\Model\Entity\User $user The User
     * @return bool
     */
    public function canEdit(User $loginUser, User $user)
    {
        return false;
    }

    /**
     * Check if $loginUser can edit User
     *
     * @param \EntreeCore\Model\Entity\User $loginUser The logged in user
     * @param \EntreeCore\Model\Entity\User $user The User
     * @return bool
     */
    public function canEditRole(User $loginUser, User $user)
    {
        return $loginUser->can('edit users') && $loginUser->id !== $user->id;
    }

    /**
     * Check if $loginUser can delete User
     *
     * @param \EntreeCore\Model\Entity\User $loginUser The logged in user
     * @param \EntreeCore\Model\Entity\User $user The User
     * @return bool
     */
    public function canDelete(User $loginUser, User $user)
    {
        return false;
    }

    /**
     * Check if $loginUser can view User
     *
     * @param \EntreeCore\Model\Entity\User $loginUser The logged in user
     * @param \EntreeCore\Model\Entity\User $user The User
     * @return bool
     */
    public function canView(User $loginUser, User $user)
    {
        return false;
    }
}
