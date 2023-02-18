<?php
declare(strict_types=1);

namespace EntreeCore\Controller\Api;

use Cake\Event\EventInterface;
use EntreeCore\Controller\AppController as BaseController;

/**
 * Api App Controller
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
    }

    /**
     * beforeRender callback
     *
     * @param \Cake\Event\EventInterface $event The event
     * @return void
     */
    public function beforeRender(EventInterface $event)
    {
        $this->viewBuilder()->setClassName('Json')
            ->setOption('serialize', array_keys($this->viewBuilder()->getVars()))
            ->setOption('jsonOptions', JSON_FORCE_OBJECT);
    }
}
