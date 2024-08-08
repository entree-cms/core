<?php
use Cake\Core\Configure;
use Cake\Utility\Hash;

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

require_once dirname(__DIR__) . DS . 'config' . DS . 'basics.php';

if (!defined('ENTREE_CORE_DEFAULT_STORAGE')) {
    $root = defined('ROOT') ? ROOT : dirname(dirname(dirname(__DIR__)));
    define('ENTREE_CORE_DEFAULT_STORAGE', $root . DS . 'storage' . DS);
}

// Load an environment default configuration file
$origValues = Configure::read('EntreeCore', []);
Configure::load('EntreeCore.plugin_entree_core', 'default');
if (file_exists(CONFIG . 'plugin_entree_core.php')) {
    Configure::load('plugin_entree_core', 'default');
}
$values = Configure::read('EntreeCore', []);
Configure::write('EntreeCore', Hash::merge($values, $origValues));

$app->addPlugin('Authentication');
$app->addPlugin('Authorization');

// DebugKit settings
Configure::write('DebugKit.ignoreAuthorization', true);
