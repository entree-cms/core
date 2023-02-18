<?php
declare(strict_types=1);

use Cake\Datasource\ConnectionManager;
use Cake\Http\Exception\InternalErrorException;
use Migrations\AbstractMigration;

class CreateI18n extends AbstractMigration
{
    /**
     * Up method
     *
     * @return void
     */
    public function up()
    {
        if (!defined('DS')) {
            define('DS', DIRECTORY_SEPARATOR);
        }

        // Get the SQL to create i18n table
        $configDir = dirname(__DIR__);
        $sqlFile = $configDir . DS . 'schema' . DS . 'i18n.sql';
        if (!file_exists($sqlFile)) {
            throw new InternalErrorException("SQL File is not found. ({$sqlFile})");
        }
        $sql = file_get_contents($sqlFile);
        if ($sql === false) {
            throw new InternalErrorException("Failed to read SQL file. ({$sqlFile})");
        }

        // Create i18n table
        $conn = ConnectionManager::get('default');
        $conn->execute($sql);
    }

    /**
     * Down method
     *
     * @return void
     */
    public function down()
    {
        $this->table('i18n')->drop()->save();
    }
}
