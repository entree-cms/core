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
     * Read
     *
     * @param string|null $var Variable to obtain. Use '.' to access array elements.
     * @param mixed $default The return value when the configure does not exist
     * @return mixed
     */
    public function read(?string $var = null, $default = null)
    {
        return Configure::read($var, $default);
    }
}
