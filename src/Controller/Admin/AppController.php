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

        // Layout
        $layout = Configure::read('EntreeCore.Admin.layout');
        $this->viewBuilder()->setLayout($layout);

        // Set base parameters for breadcrumbs
        $this->set('breadcrumbBase', $this->getBreadcrumbBase());
    }
}
