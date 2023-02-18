<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Permissions seed.
 */
class PermissionsSeed extends AbstractSeed
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
                'permission_category_id' => 1,
                'code' => 'access admin',
                'name' => 'Access admin settings',
                'description' => NULL,
                'deleted' => NULL,
                'created' => '2023-01-01 00:00:00',
                'modified' => '2023-01-01 00:00:00',
            ],
        ];

        $table = $this->table('permissions');
        $table->insert($data)->save();
    }
}
