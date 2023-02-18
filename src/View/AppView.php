<?php
declare(strict_types=1);

namespace EntreeCore\View;

use Cake\Core\Configure;
use Cake\View\View;

/**
 * Application View
 */
class AppView extends View
{
    /**
     * Initialization hook method.
     *
     * @return void
     */
    public function initialize(): void
    {
        $helpers = $this->helpers();

        if (!$helpers->has('Breadcrumbs')) {
            $this->loadHelper('Breadcrumbs', ['templates' => 'EntreeCore.templates/breadcrumbs']);
        }

        if (!$helpers->has('Configure')) {
            $this->loadHelper('EntreeCore.Configure');
        }

        if (!$helpers->has('Form')) {
            $this->loadHelper('EntreeCore.Form');
        }

        if (!$helpers->has('Html')) {
            $this->loadHelper('EntreeCore.Html');
        }
    }

    // *********************************************************
    // * User-defined functions
    // *********************************************************

    /**
     * Make admin page title
     *
     * @param string $title The page title
     * @return string
     */
    public function makeAdminTitle(string $title): string
    {
        $adminSiteTitle = Configure::read('Entree.Admin.title');

        $title = trim($title);
        if ($title === '') {
            return $adminSiteTitle;
        }

        return $title . ' - ' . $adminSiteTitle;
    }
}
