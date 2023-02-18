<?php
declare(strict_types=1);

/**
 * Recursive implode
 *
 * @param string $separator The separator
 * @param mixed $values
 * @return string
 */
function exImplode(string $separator, $values): string
{
    $output = [];
    foreach ($values as $value) {
        if (is_iterable($value)) {
            $value = exImplode($value);
        }
        $output[] = $value;
    }

    return implode($separator, $output);
}
