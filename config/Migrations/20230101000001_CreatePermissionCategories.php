<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreatePermissionCategories extends AbstractMigration
{
    /**
     * Change Method.
     *
     * @return void
     */
    public function change()
    {
        $table = $this->table('permission_categories', [
            'id' => false,
            'primary_key' => ['id'],
        ]);
        $table->addColumn('id', 'tinyinteger', [
            'autoIncrement' => true,
            'default' => null,
            'limit' => 3,
            'null' => false,
            'signed' => false,
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
