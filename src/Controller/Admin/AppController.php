<?php
declare(strict_types=1);

namespace EntreeCore\Controller\Admin;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Routing\Router;
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

        // View
        $this->viewBuilder()->setClassName('EntreeCore.App');

        // Layout
        $layout = Configure::read('Entree.Admin.layout') ?? 'EntreeCore.admin_default';
        $this->viewBuilder()->setLayout($layout);

        // Configure navigation items
        $this->configureNavItems();

        // Set base parameters for breadcrumbs
        $this->set('breadcrumbBase', $this->getBreadcrumbBase());
    }

    // *********************************************************
    // * User-defined functions
    // *********************************************************

    /**
     * Get base parameters for breadcrumbs
     *
     * @return array
     */
    protected function getBreadcrumbBase(): array
    {
        $title = __d('admin_layout', 'Home');
        $url = Router::url(['plugin' => 'EntreeCore', 'controller' => 'Home', 'action' => 'index']);

        return [compact('title', 'url')];
    }
}
