<?php
declare(strict_types=1);

namespace EntreeCore\Model\Entity;

use Cake\ORM\Behavior\Translate\TranslateTrait;
use Cake\ORM\Entity;

/**
 * Permission Entity
 *
 * @property int $id
 * @property int $permission_category_id
 * @property string $code
 * @property string $description
 * @property \Cake\I18n\DateTime|null $deleted
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \EntreeCore\Model\Entity\PermissionCategory $permissionCategory
 * @property \EntreeCore\Model\Entity\Role[] $roles
 */
class Permission extends Entity
{
    use TranslateTrait;

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        '_translations' => true,
        'permission_category_id' => true,
        'code' => true,
        'name' => true,
        'description' => true,
    ];
}
