<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateRolesUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * @return void
     */
    public function change()
    {
        $table = $this->table('roles_users', [
            'id' => false,
            'primary_key' => ['id'],
        ]);
        $table->addColumn('id', 'integer', [
            'autoIncrement' => true,
            'default' => null,
            'limit' => 10,
            'null' => false,
            'signed' => false,
        ]);
        $table->addColumn('role_id', 'tinyinteger', [
            'default' => null,
            'limit' => 3,
            'null' => false,
            'signed' => false,
        ]);
        $table->addColumn('user_id', 'integer', [
            'default' => null,
            'limit' => 10,
            'null' => false,
            'signed' => false,
        ]);
        $table->create();
    }
}
