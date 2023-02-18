<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Roles seed.
 */
class RolesSeed extends AbstractSeed
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
                'code' => 'admin',
                'name' => 'システム管理者',
                'description' => null,
                'deleted' => NULL,
                'created' => '2023-01-01 00:00:00',
                'modified' => '2023-01-01 00:00:00',
            ],
            [
                'id' => 2,
                'code' => 'manager',
                'name' => 'マネジャー',
                'description' => null,
                'deleted' => NULL,
                'created' => '2023-01-01 00:00:00',
                'modified' => '2023-01-01 00:00:00',
            ],
            [
                'id' => 3,
                'code' => 'member',
                'name' => 'メンバー',
                'description' => null,
                'deleted' => NULL,
                'created' => '2023-01-01 00:00:00',
                'modified' => '2023-01-01 00:00:00',
            ],
        ];

        $table = $this->table('roles');
        $table->truncate();
        $table->insert($data)->save();
    }
}
