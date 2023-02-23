<?php
declare(strict_types=1);

namespace EntreeCore\Policy;

use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;
use Cake\ORM\Locator\LocatorAwareTrait;
use EntreeCore\Model\Entity\PermissionCategory;
use EntreeCore\Model\Entity\User;

/**
 * PermissionCategory policy
 */
class PermissionCategoryPolicy implements BeforePolicyInterface
{
    use LocatorAwareTrait;

    /**
     * Pre conditions
     *
     * @param ?\Authorization\IdentityInterface $user The user to check authorization
     * @param \EntreeCore\Model\Entity\PermissionCategory $permissionCategory The permission category to be operated
     * @param string $action The action
     * @return bool|void
     */
    public function before(?IdentityInterface $user, $permissionCategory, $action)
    {
        if (
            $user
            && method_exists($user, 'hasRole')
            && $user->hasRole('admin')
            && !in_array($action, ['delete'])
        ) {
            return true;
        }
    }

    /**
     * Check if $user can add PermissionCategory
     *
     * @param \EntreeCore\Model\Entity\User $user The user to check authorization
     * @param \EntreeCore\Model\Entity\PermissionCategory $permissionCategory The permission category to be operated
     * @return bool
     */
    public function canAdd(User $user, PermissionCategory $permissionCategory)
    {
        return false;
    }

    /**
     * Check if $user can delete PermissionCategory
     *
     * @param \EntreeCore\Model\Entity\User $user The user to check authorization.
     * @param \EntreeCore\Model\Entity\PermissionCategory $permissionCategory The permission category to be operated.
     * @return bool
     */
    public function canDelete(User $user, PermissionCategory $permissionCategory)
    {
        if ($user->cannot('manage permissions')) {
            return false;
        }

        /** @var \EntreeCore\Model\Table\PermissionsTable $permissionsTable */
        $permissionsTable = $this->fetchTable('EntreeCore.Permissions');

        $permissionCount = $permissionsTable->findByPermissionCategoryId($permissionCategory->id)->count();

        return $permissionCount === 0;
    }

    /**
     * Check if $user can edit PermissionCategory

     * @param \EntreeCore\Model\Entity\User $user The user to check authorization
     * @param \EntreeCore\Model\Entity\PermissionCategory $permissionCategory The permission category to be operated
     * @return bool
     */
    public function canEdit(User $user, PermissionCategory $permissionCategory)
    {
        return false;
    }
}
