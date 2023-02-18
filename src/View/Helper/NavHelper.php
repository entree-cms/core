<?php
declare(strict_types=1);

namespace EntreeCore\View\Helper;

use Cake\View\Helper;

class NavHelper extends Helper
{
    /**
     * Convert navigation item parameters to HTML
     *
     * @param array $navItems The navigation items
     * @param array $options The options
     * @return string
     */
    public function convertItemsToHtml(array $navItems, array $options = [])
    {
        $options += [
            'level' => 1,
        ];

        $navItems = array_filter($navItems, 'is_array');
        $sortNos = array_column($navItems, 'sortNo');
        array_multisort($sortNos, SORT_ASC, $navItems);

        // Create HTML
        $output = '';
        foreach ($navItems as $navItem) {
            $view = $this->getView();
            $vars = $navItem['vars'] ?? [];
            if (!is_array($vars)) {
                $vars = [];
            }
            $vars['level'] = $options['level'];
            $view->set($vars);

            // Html
            $html = $navItem['html'] ?? null;
            if (is_string($html)) {
                $output .= $html;
                continue;
            }
            // Element
            $el = $navItem['element'] ?? null;
            if (is_string($el)) {
                $output .= $view->element($el);
                continue;
            }
        }

        return $output;
    }
}
