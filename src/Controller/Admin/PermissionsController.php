<?php
declare(strict_types=1);

namespace EntreeCore\Controller\Admin;

use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\InternalErrorException;
use Cake\I18n\FrozenTime;

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
            $permission = $this->Permissions->patchEntity($permission, $this->request->getData());
            if ($this->Permissions->save($permission)) {
                $this->Flash->success(__('The {0} has been saved successfully.', __d('permissions', 'Permission')));

                return $this->redirect(['action' => 'edit', $permission->id]);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', __d('permissions', 'Permission')));
        }
        $this->set(compact('permission'));

        $this->set($this->getFormVars());

        $this->render('EntreeCore.add');
    }

    /**
     * Delete method
     *
     * @param string $permissionId The permission category ID
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException
     * @throws \Cake\Http\Exception\InternalErrorException
     */
    public function delete($permissionId)
    {
        $permission = $this->Permissions->get($permissionId);
        if ($this->loginUser->cannot('delete', $permission)) {
            throw new ForbiddenException();
        }

        if ($permission->deleted !== null) {
            $this->Flash->warning(
                __('The {0} has already been deleted.', strtolower(__d('permissions', 'Permission')))
            );
        } else {
            $permission->deleted = FrozenTime::now();
            if (!$this->Permissions->save($permission)) {
                throw new InternalErrorException();
            }
            $this->Flash->success(
                __('The {0} has been deleted.', strtolower(__d('permissions', 'Permission')))
            );
        }

        return $this->redirect(['action' => 'index']);
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
        if ($this->Permissions->hasBehavior('Translate')) {
            $this->Permissions->setLocale($this->defaultLocale);
        }
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

        $this->render('EntreeCore.edit');
    }

    /**
     * Index
     *
     * @return void
     */
    public function index()
    {
        $query = $this->Permissions->find('notDeleted')->contain(['PermissionCategories']);
        $permissions = $this->paginate($query);
        $this->set(compact('permissions'));

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
    private function getFormVars()
    {
        $vars = [];
        $vars['permissionCategories'] = $this->Permissions->PermissionCategories->find('notDeleted')->all();

        return $vars;
    }
}
