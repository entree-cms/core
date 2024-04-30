<?php
declare(strict_types=1);

namespace EntreeCore\Model\Entity;

use Cake\ORM\Behavior\Translate\TranslateTrait;
use Cake\ORM\Entity;

/**
 * PermissionCategory Entity
 *
 * @property int $id
 * @property string $name
 * @property \Cake\I18n\DateTime|null $deleted
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \EntreeCore\Model\Entity\Permission[] $permissions
 */
class PermissionCategory extends Entity
{
    use TranslateTrait;

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        '_translations' => true,
        'name' => true,
        'description' => true,
    ];
}
