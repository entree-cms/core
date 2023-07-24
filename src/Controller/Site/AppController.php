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

        // Title
        if (Configure::read('Entree.Site.title') === null) {
            Configure::write('Entree.Site.title', 'Entree CMS');
        }

        // Layout
        $layout = Configure::read('Entree.Site.layout') ?? 'EntreeCore.site_default';
        $this->viewBuilder()->setLayout($layout);

        // Configure navigation items
        $this->configureNavItems();

        // Set base parameters for breadcrumbs
        $this->set('breadcrumbBase', $this->getBreadcrumbBase());
    }
}
