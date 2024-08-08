<?php
declare(strict_types=1);

namespace EntreeCore\Controller\Site;

use Cake\Core\Configure;
use EntreeCore\Controller\AppController as BaseController;

/**
 * Site app controller
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

        // Layout
        $layout = Configure::read('EntreeCore.Site.layout');
        $this->viewBuilder()->setLayout($layout);

        // Set base parameters for breadcrumbs
        $this->set('breadcrumbBase', $this->getBreadcrumbBase());
    }
}
