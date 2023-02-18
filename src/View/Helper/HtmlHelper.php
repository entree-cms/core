<?php
declare(strict_types=1);

namespace EntreeCore\View\Helper;

use Cake\View\Helper\HtmlHelper as BaseHelper;

class HtmlHelper extends BaseHelper
{
    /**
     * Make attributes text for HTML tag
     *
     * @param array|string|null $attrs Attributes list
     * @return string
     */
    public function makeAttrsText($attrs)
    {
        if (is_string($attrs)) {
            return $attrs;
        }

        $params = [];
        if (is_array($attrs)) {
            foreach ($attrs as $key => $value) {
                if (is_numeric($key)) {
                    $params[] = $value;
                } elseif (is_string($key)) {
                    $params[] = "{$key}=\"{$value}\"";
                }
            }
        }

        return implode(' ', $params);
    }
}
