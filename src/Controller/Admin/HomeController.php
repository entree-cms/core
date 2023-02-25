<?php
declare(strict_types=1);

namespace EntreeCore\Controller\Admin;

/**
 * Admin Home Controller
 */
class HomeController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $this->render('EntreeCore.index');
    }
}
