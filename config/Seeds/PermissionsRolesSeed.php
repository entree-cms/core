<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * PermissionsRoles seed.
 */
class PermissionsRolesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * @return void
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'permission_id' => 1,
                'role_id' => 2,
            ],
            [
                'id' => 2,
                'permission_id' => 1,
                'role_id' => 3,
            ],
        ];

        $table = $this->table('permissions_roles');
        $table->insert($data)->save();
    }
}
