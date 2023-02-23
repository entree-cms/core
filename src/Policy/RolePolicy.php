<?php
declare(strict_types=1);

namespace EntreeCore\Policy;

use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;
use Cake\ORM\Locator\LocatorAwareTrait;
use EntreeCore\Model\Entity\Role;
use EntreeCore\Model\Entity\User;

/**
 * Role policy
 */
class RolePolicy implements BeforePolicyInterface
{
    use LocatorAwareTrait;

    /**
     * Pre conditions
     *
     * @param ?\Authorization\IdentityInterface $user The user to check authorization
     * @param \EntreeCore\Model\Entity\Role $role The role to be operated
     * @param string $action The action
     * @return bool|void
     */
    public function before(?IdentityInterface $user, $role, $action)
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
     * Check if $user can add Role
     *
     * @param \EntreeCore\Model\Entity\User $user The user to check authorization
     * @param \EntreeCore\Model\Entity\Role $role The role to be operated
     * @return bool
     */
    public function canAdd(User $user, Role $role)
    {
        return false;
    }

    /**
     * Check if $user can edit Role

     * @param \EntreeCore\Model\Entity\User $user The user to check authorization
     * @param \EntreeCore\Model\Entity\Role $role The role to be operated
     * @return bool
     */
    public function canEdit(User $user, Role $role)
    {
        return false;
    }

    /**
     * Check if $user can delete Role
     *
     * @param \EntreeCore\Model\Entity\User $user The user to check authorization.
     * @param \EntreeCore\Model\Entity\Role $role The role to be operated.
     * @return bool
     */
    public function canDelete(User $user, Role $role)
    {
        if ($user->cannot('delete roles')) {
            return false;
        }

        $userCount = $this->fetchTable('EntreeCore.Users')
            ->find('notDeleted')
            ->matching('Roles', function ($q) use ($role) {
                return $q->where(['Roles.id' => $role->id]);
            })
            ->count();

        return $userCount === 0;
    }
}
