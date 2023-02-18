<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
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
                'username' => 'admin',
                'password' => '$2y$10$upS0PnfNjZ/5HT2CoOJOdOMs2NhVwjnpEuv9NYrEZI74pOv7QyIcC',
                'first_name' => 'User',
                'last_name' => 'Admin',
                'nickname' => 'Admin',
                'email' => NULL,
                'avatar' => NULL,
                'locale' => NULL,
                'deleted' => NULL,
                'created' => '2023-01-01 00:00:00',
                'modified' => '2023-01-01 00:00:00',
            ],
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
