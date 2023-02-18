<?php
declare(strict_types=1);

namespace EntreeCore\Controller\Site;

/**
 * Site users controller
 *
 * @property \EntreeCore\Controller\Component\UserActionComponent $UserAction
 */
class UsersController extends AppController
{
    /**
     * initialize callback
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->Authorization->skipAuthorization();
    }

    /**
     * Profile method
     *
     * @return \Cake\Http\Response|null Renders view
     */
    public function profile()
    {
        $this->loadComponent('EntreeCore.UserAction');

        return $this->UserAction->executeProfile();
    }
}
