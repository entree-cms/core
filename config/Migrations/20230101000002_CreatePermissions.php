<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreatePermissions extends AbstractMigration
{
    /**
     * Change Method.
     *
     * @return void
     */
    public function change()
    {
        $table = $this->table('permissions', [
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
        $table->addColumn('permission_category_id', 'tinyinteger', [
            'default' => null,
            'limit' => 3,
            'null' => false,
            'default' => 1,
            'signed' => false,
        ]);
        $table->addColumn('code', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addIndex(['code'], [
            'name' => 'UNIQUE_CODE',
            'unique' => true,
        ]);
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('description', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('deleted', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
