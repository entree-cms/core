<?php
declare(strict_types=1);

namespace EntreeCore\Controller\Admin;

use Cake\I18n\I18n;
use EntreeCore\Model\Table\RolesTable;

/**
 * Users Controller
 *
 * @property \EntreeCore\Controller\Component\UserActionComponent $UserAction
 * @property \EntreeCore\Model\Table\UsersTable $Users
 * @method \EntreeCore\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public const DEFAULT_ROLE_ID = RolesTable::MEMBER;

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

    // *********************************************************
    // * Actions
    // *********************************************************

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function add()
    {
        $user = $this->Users->newEntity([], [
            'accessibleFields' => ['roles' => true],
            'validate' => false,
        ]);
        $user->locale = I18n::getLocale();

        if ($this->request->is('post')) {
            $postData = $this->request->getData();
            if ($this->loginUser->cannot('editRole', $user)) {
                $postData['roles'] = ['_ids' => [self::DEFAULT_ROLE_ID]];
            }
            $user = $this->Users->patchEntity($user, $postData);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The {0} has been saved successfully.', strtolower(__d('users', 'User'))));

                return $this->redirect(['action' => 'edit', $user->id]);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', __d('users', 'User')));
        }

        $this->set(compact('user'));

        $this->loadComponent('EntreeCore.UserAction');
        $this->set($this->UserAction->getFormVars());
    }

    /**
     * Edit method
     *
     * @param string $userId The user ID
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function edit($userId)
    {
        $user = $this->Users->get($userId, [
            'contain' => [
                'Roles',
            ],
        ]);

        if ($this->request->is('put')) {
            $postData = $this->request->getData();
            $options = [];
            if ($this->loginUser->can('editRole', $user)) {
                $options = ['accessibleFields' => ['roles' => true]];
            }
            $user = $this->Users->patchEntity($user, $postData, $options);
            if ($this->Users->save($user)) {
                // Update logged in user
                if ($user->id === $this->loginUser->id) {
                    $this->Authentication->setIdentity($user);
                }

                $this->Flash->success(__('The {0} has been saved successfully.', strtolower(__d('users', 'User'))));

                return $this->redirect(['action' => 'edit', $user->id]);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', strtolower(__d('users', 'User'))));
        }

        $this->set(compact('user'));

        $this->loadComponent('EntreeCore.UserAction');
        $this->set($this->UserAction->getFormVars());
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Users->find()
            ->contain(['Roles']);
        $users = $this->paginate($query);

        $this->set(compact('users'));
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
