<?php
declare(strict_types=1);

namespace EntreeCore\Controller\Admin;

use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\InternalErrorException;
use Cake\I18n\FrozenTime;

/**
 * Roles Controller
 *
 * @property \EntreeCore\Model\Table\RolesTable $Roles
 * @method \EntreeCore\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RolesController extends AppController
{
    /**
     * Initialization
     *
     * @return void
     * @throws \Cake\Http\Exception\ForbiddenException
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->Authorization->skipAuthorization();
        if ($this->loginUser && $this->loginUser->cannot('manage roles')) {
            throw new ForbiddenException();
        }
    }

    // *********************************************************
    // * Actions
    // *********************************************************

    /**
     * Add
     *
     * @return \Cake\Http\Response|null|void
     */
    public function add()
    {
        $role = $this->Roles->newEntity([], ['validate' => false]);

        if ($this->request->is('post')) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The {0} has been saved successfully.', __d('roles', 'Role')));

                return $this->redirect(['action' => 'edit', $role->id]);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', __d('roles', 'Role')));
        }
        $this->set(compact('role'));

        $this->set($this->getFormVars());

        $this->render('EntreeCore.add');
    }

    /**
     * Delete method
     *
     * @param string $roleId The role ID
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException
     * @throws \Cake\Http\Exception\InternalErrorException
     */
    public function delete($roleId)
    {
        $role = $this->Roles->get($roleId);
        if ($this->loginUser->cannot('delete', $role)) {
            throw new ForbiddenException();
        }

        if ($role->deleted !== null) {
            $this->Flash->warning(
                __('The {0} has already been deleted.', strtolower(__d('roles', 'Role')))
            );
        } else {
            $role->deleted = FrozenTime::now();
            if (!$this->Roles->save($role)) {
                throw new InternalErrorException();
            }
            $this->Flash->success(
                __('The {0} has been deleted.', strtolower(__d('roles', 'Role')))
            );
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Edit
     *
     * @param string $roleId The Role id
     * @return \Cake\Http\Response|null|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function edit($roleId)
    {
        if ($this->Roles->hasBehavior('Translate')) {
            $this->Roles->setLocale($this->defaultLocale);
        }
        $role = $this->Roles->findDetailById($roleId)->firstOrFail();

        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();
            $data['permissions']['_ids'] = $this->request->getData('permissions._ids', []);
            $role = $this->Roles->patchEntity($role, $data);
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The {0} has been saved successfully.', __d('roles', 'Role')));

                return $this->redirect(['action' => 'edit', $role->id]);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', __d('roles', 'Role')));
        }
        $this->set(compact('role'));

        $this->set($this->getFormVars());

        $this->render('EntreeCore.edit');
    }

    /**
     * Index
     *
     * @return void
     */
    public function index()
    {
        $query = $this->Roles->find('notDeleted');
        $roles = $this->paginate($query);
        $this->set(compact('roles'));

        $this->render('EntreeCore.index');
    }

    // *********************************************************
    // * Internal methods
    // *********************************************************

    /**
     * Get variables for form.
     *
     * @return array
     */
    protected function getFormVars()
    {
        $vars = [];
        $vars['permissionCategories'] = $this->fetchTable('EntreeCore.PermissionCategories')
            ->find('notDeleted')
            ->contain(['Permissions'])
            ->all();

        return $vars;
    }
}
