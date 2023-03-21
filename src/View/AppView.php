<?php
declare(strict_types=1);

namespace EntreeCore\View;

use Cake\Core\Configure;
use Cake\Http\Exception\InternalErrorException;
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

        if (!$helpers->has('Nav')) {
            $this->loadHelper('EntreeCore.Nav');
        }

        if (!$helpers->has('Paginator')) {
            $this->loadHelper('Paginator', ['templates' => 'EntreeCore.templates/paginator']);
        }
    }

    // *********************************************************
    // * User-defined methods
    // *********************************************************

    /**
     * Make admin page title
     *
     * @param string $title The page title
     * @return string
     * @throws \Cake\Http\Exception\InternalErrorException
     */
    public function makeTitle(string $title): string
    {
        $prefix = $this->getRequest()->getParam('prefix');

        $append = '';
        $separator = ' - ';
        switch ($prefix) {
            case 'Admin':
                $append = Configure::read('Entree.Admin.title') ?? '';
                $separator = Configure::read('Entree.Admin.titleSeparator') ?? $separator;
                break;
            case 'Site':
                $append = Configure::read('Entree.Site.title') ?? '';
                $separator = Configure::read('Entree.Site.titleSeparator') ?? $separator;
                break;
        }
        if (!is_string($append) || !is_string($separator)) {
            throw new InternalErrorException();
        }

        $title = trim($title);
        if ($title === '') {
            return $append;
        }

        if ($append === '') {
            return $title;
        }

        return $title . $separator . $append;
    }
}
