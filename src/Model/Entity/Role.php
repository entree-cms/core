<?php
declare(strict_types=1);

namespace EntreeCore\Model\Entity;

use Cake\ORM\Behavior\Translate\TranslateTrait;
use Cake\ORM\Entity;
use EntreeCore\Model\Table\RolesTable;

/**
 * Role Entity
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property \Cake\I18n\FrozenTime|null $deleted
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \EntreeCore\Model\Entity\Permission[] $permissions
 * @property array $permission_ids
 * @property bool $is_privileged
 */
class Role extends Entity
{
    use TranslateTrait;

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        '_translations' => true,
        'code' => true,
        'name' => true,
        'description' => true,
        'permissions' => true,
    ];

    // *********************************************************
    // * Virtual fields
    // *********************************************************

    /**
     * Is privileged role
     *
     * @return bool
     */
    protected function _getIsPrivileged(): bool
    {
        return in_Array($this->id, RolesTable::$privilegedIds);
    }

    /**
     * Permission IDs
     *
     * @return array<int>
     */
    protected function _getPermissionIds(): array
    {
        if (!isset($this->permissions)) {
            return [];
        }

        $ids = [];
        foreach ($this->permissions as $permission) {
            $ids[] = $permission->id;
        }

        return $ids;
    }
}
