<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * PermissionCategories seed.
 */
class PermissionCategoriesSeed extends AbstractSeed
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
                'name' => 'システム',
                'deleted' => NULL,
                'created' => '2023-01-01 00:00:00',
                'modified' => '2023-01-01 00:00:00',
            ],
        ];

        $table = $this->table('permission_categories');
        $table->truncate();
        $table->insert($data)->save();
    }
}
