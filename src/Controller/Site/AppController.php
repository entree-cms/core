<?php
declare(strict_types=1);

namespace EntreeCore\Controller\Site;

use Cake\Core\Configure;
use Cake\Routing\Router;
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

        // Title
        if (Configure::read('Entree.Site.title') === null) {
            Configure::write('Entree.Site.title', 'Entree CMS');
        }

        // Layout
        $layout = Configure::read('Entree.Site.layout') ?? 'EntreeCore.site_default';
        $this->viewBuilder()->setLayout($layout);

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
        $title = __d('site_layout', 'Home');
        $url = Router::url(['plugin' => 'EntreeCore', 'controller' => 'Home', 'action' => 'index']);

        return [compact('title', 'url')];
    }
}
