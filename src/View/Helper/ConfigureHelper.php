<?php
declare(strict_types=1);

namespace EntreeCore\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;

/**
 * Configure helper
 */
class ConfigureHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    /**
     * Read
     *
     * @param string $key The key
     * @return mixed
     */
    public function read($key)
    {
        return Configure::read($key);
    }
}
