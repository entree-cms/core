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
     * @param ?\Authorization\IdentityInterface $user The user to check authorization.
     * @param \EntreeCore\Model\Entity\User $targetUser The user to be operated.
     * @param string $action The action
     * @return bool|void
     */
    public function before(?IdentityInterface $user, $targetUser, $action)
    {
        if (
            $user
            && method_exists($user, 'hasRole')
            && $user->hasRole('admin')
            && !in_array($action, ['delete', 'editRole'])
        ) {
            return true;
        }
    }

    /**
     * Check if $user can add User
     *
     * @param \EntreeCore\Model\Entity\User $user The user to check authorization.
     * @param \EntreeCore\Model\Entity\User $targetUser The user to be operated.
     * @return bool
     */
    public function canAdd(User $user, User $targetUser)
    {
        return false;
    }

    /**
     * Check if $user can delete User
     *
     * @param \EntreeCore\Model\Entity\User $user The user to check authorization.
     * @param \EntreeCore\Model\Entity\User $targetUser The user to be operated.
     * @return bool
     */
    public function canDelete(User $user, User $targetUser)
    {
        return $user->can('delete users') && $user->id !== $targetUser->id;
    }

    /**
     * Check if $user can edit user
     *
     * @param \EntreeCore\Model\Entity\User $user The user to check authorization.
     * @param \EntreeCore\Model\Entity\User $targetUser The user to be operated.
     * @return bool
     */
    public function canEdit(User $user, User $targetUser)
    {
        return false;
    }

    /**
     * Check if $user can edit user
     *
     * @param \EntreeCore\Model\Entity\User $user The user to check authorization.
     * @param \EntreeCore\Model\Entity\User $targetUser The user to be operated.
     * @return bool
     */
    public function canEditRole(User $user, User $targetUser)
    {
        return $user->can('edit users') && $user->id !== $targetUser->id;
    }

    /**
     * Check if $user can view user
     *
     * @param \EntreeCore\Model\Entity\User $user The user to check authorization.
     * @param \EntreeCore\Model\Entity\User $targetUser The User
     * @return bool
     */
    public function canView(User $user, User $targetUser)
    {
        return false;
    }
}
