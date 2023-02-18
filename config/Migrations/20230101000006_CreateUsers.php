<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * @return void
     */
    public function change()
    {
        $table = $this->table('users', [
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
        $table->addColumn('username', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('password', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('first_name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('last_name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('nickname', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('email', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('avatar', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('locale', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('deleted', 'datetime', [
            'default' => null,
            'limit' => null,
            'null' => true,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'limit' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'limit' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
