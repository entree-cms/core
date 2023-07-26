<?php
declare(strict_types=1);

namespace EntreeCore\Controller\Admin;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use EntreeCore\Controller\AppController as BaseController;

/**
 * Admin App Controller
 */
class AppController extends BaseController
{
    /**
     * initialize callback
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        if ($this->loginUser && $this->loginUser->cannot('access admin')) {
            throw new ForbiddenException();
        }

        // Title
        if (Configure::read('Entree.Admin.title') === null) {
            Configure::write('Entree.Admin.title', 'Entree CMS Admin');
        }

        // Layout
        $layout = Configure::read('Entree.Admin.layout') ?? 'EntreeCore.admin_default';
        $this->viewBuilder()->setLayout($layout);

        // Configure navigation items
        $this->configureNavItems();

        // Set base parameters for breadcrumbs
        $this->set('breadcrumbBase', $this->getBreadcrumbBase());
    }
}
