<?php
declare(strict_types=1);

namespace EntreeCore\Policy;

use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;
use Cake\ORM\Locator\LocatorAwareTrait;
use EntreeCore\Model\Entity\Permission;
use EntreeCore\Model\Entity\User;

/**
 * Permission policy
 */
class PermissionPolicy implements BeforePolicyInterface
{
    use LocatorAwareTrait;

    /**
     * Pre conditions
     *
     * @param ?\Authorization\IdentityInterface $user The user to check authorization
     * @param \EntreeCore\Model\Entity\Permission $permission The permission to be operated
     * @param string $action The action
     * @return bool|void
     */
    public function before(?IdentityInterface $user, $permission, $action)
    {
        if (
            $user
            && method_exists($user, 'hasRole')
            && $user->hasRole('admin')
        ) {
            return true;
        }
    }

    /**
     * Check if $user can add Permission
     *
     * @param \EntreeCore\Model\Entity\User $user The user to check authorization
     * @param \EntreeCore\Model\Entity\Permission $permission The permission to be operated
     * @return bool
     */
    public function canAdd(User $user, Permission $permission)
    {
        return false;
    }

    /**
     * Check if $user can delete Permission
     *
     * @param \EntreeCore\Model\Entity\User $user The user to check authorization.
     * @param \EntreeCore\Model\Entity\Permission $permission The permission to be operated.
     * @return bool
     */
    public function canDelete(User $user, Permission $permission)
    {
        return false;
    }

    /**
     * Check if $user can edit Permission

     * @param \EntreeCore\Model\Entity\User $user The user to check authorization
     * @param \EntreeCore\Model\Entity\Permission $permission The permission to be operated
     * @return bool
     */
    public function canEdit(User $user, Permission $permission)
    {
        return false;
    }
}
