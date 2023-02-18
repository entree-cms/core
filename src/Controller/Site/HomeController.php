<?php
declare(strict_types=1);

namespace EntreeCore\Controller\Site;

/**
 * Site home controller
 */
class HomeController extends AppController
{
    /**
     * initialize callback
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->Authentication->allowUnauthenticated(['index']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
    }
}
