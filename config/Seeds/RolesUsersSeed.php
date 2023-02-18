<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * RolesUsers seed.
 */
class RolesUsersSeed extends AbstractSeed
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
                'role_id' => 1,
                'user_id' => 1,
            ],
        ];

        $table = $this->table('roles_users');
        $table->insert($data)->save();
    }
}
