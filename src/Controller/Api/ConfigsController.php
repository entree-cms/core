<?php
declare(strict_types=1);

namespace EntreeCore\Controller\Api;

use Cake\Event\EventInterface;

/**
 * Configs Controller
 */
class ConfigsController extends AppController
{
    /**
     * beforeFilter callback
     *
     * @param \Cake\Event\EventInterface $event The event
     * @return void
     */
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['setLocale']);
        $this->Authorization->skipAuthorization();

        // Clear view vars
        $this->viewBuilder()->setVars([], false);
    }

    // *********************************************************
    // * Actions
    // *********************************************************

    /**
     * Set locale.
     *
     * @return void
     */
    public function setLocale()
    {
        $locale = $this->request->getData('locale');
        $this->session->write('locale', $locale);
    }
}
