<?php
declare(strict_types=1);

namespace EntreeCore\Controller\Admin;

use Cake\Http\Exception\ForbiddenException;

/**
 * Permissions Controller
 *
 * @property \EntreeCore\Model\Table\PermissionsTable $Permissions
 * @method \EntreeCore\Model\Entity\Permission[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PermissionsController extends AppController
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
        if ($this->loginUser && $this->loginUser->cannot('manage permissions')) {
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
        $permission = $this->Permissions->newEntity([], ['validate' => false]);

        if ($this->request->is('post')) {
            $defaults = $this->request->getData();
            $permission = $this->Permissions->patchEntity($permission, $this->request->getData());
            if ($this->Permissions->save($permission)) {
                $this->Flash->success(__('The {0} has been saved successfully.', __d('permissions', 'Permission')));

                return $this->redirect(['action' => 'edit', $permission->id]);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', __d('permissions', 'Permission')));
        }
        $this->set(compact('permission'));

        $this->set($this->getFormVars());
    }

    /**
     * Edit
     *
     * @param string $permissionId The Permission id.
     * @return \Cake\Http\Response|null|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($permissionId)
    {
        $this->Permissions->setLocale($this->defaultLocale);
        $permission = $this->Permissions->findDetailById($permissionId)->firstOrFail();

        if ($this->request->is(['post', 'put'])) {
            $permission = $this->Permissions->patchEntity($permission, $this->request->getData());
            if ($this->Permissions->save($permission)) {
                $this->Flash->success(__('The {0} has been saved successfully.', __d('permissions', 'Permission')));

                return $this->redirect(['action' => 'edit', $permission->id]);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', __d('permissions', 'Permission')));
        }
        $this->set(compact('permission'));

        $this->set($this->getFormVars());
    }

    /**
     * Index
     *
     * @return void
     */
    public function index()
    {
        $query = $this->Permissions->find()
            ->contain(['PermissionCategories']);
        $permissions = $this->paginate($query);
        $this->set(compact('permissions'));
    }

    // *********************************************************
    // * User-defined functions
    // *********************************************************

    /**
     * Get variables for form.
     *
     * @return array
     */
    private function getFormVars()
    {
        $vars = [];
        $vars['permissionCategories'] = $this->Permissions->PermissionCategories->find('notDeleted')->all();

        return $vars;
    }
}
