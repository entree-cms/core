<?php
declare(strict_types=1);

namespace EntreeCore\Controller\Admin;

use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\InternalErrorException;
use Cake\I18n\FrozenTime;

/**
 * PermissionCategories Controller
 *
 * @property \EntreeCore\Model\Table\PermissionCategoriesTable $PermissionCategories
 * @method \EntreeCore\Model\Entity\PermissionCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PermissionCategoriesController extends AppController
{
    /**
     * Initialization
     *
     * @return void
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
        $permissionCategory = $this->PermissionCategories->newEntity([], ['validate' => false]);

        if ($this->request->is('post')) {
            $permissionCategory = $this->PermissionCategories->patchEntity(
                $permissionCategory,
                $this->request->getData()
            );
            if ($this->PermissionCategories->save($permissionCategory)) {
                $this->Flash->success(__(
                    'The {0} has been saved successfully.',
                    __d('permission_categories', 'Permission category')
                ));

                return $this->redirect(['action' => 'edit', $permissionCategory->id]);
            }
            $this->Flash->error(__(
                'The {0} could not be saved. Please, try again.',
                __d('permission_categories', 'Permission category')
            ));
        }
        $this->set(compact('permissionCategory'));

        $this->render('EntreeCore.add');
    }

    /**
     * Edit
     *
     * @param string $permissionCategoryId The Permission category id.
     * @return \Cake\Http\Response|null|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($permissionCategoryId)
    {
        if ($this->PermissionCategories->hasBehavior('Translate')) {
            $this->PermissionCategories->setLocale($this->defaultLocale);
        }
        $permissionCategory = $this->PermissionCategories->findDetailById($permissionCategoryId)->firstOrFail();

        if ($this->request->is(['post', 'put'])) {
            $permissionCategory = $this->PermissionCategories->patchEntity(
                $permissionCategory,
                $this->request->getData()
            );
            if ($this->PermissionCategories->save($permissionCategory)) {
                $this->Flash->success(__(
                    'The {0} has been saved successfully.',
                    __d('permission_categories', 'Permission category')
                ));

                return $this->redirect(['action' => 'edit', $permissionCategory->id]);
            }
            $this->Flash->error(__(
                'The {0} could not be saved. Please, try again.',
                __d('permission_categories', 'Permission category')
            ));
        }
        $this->set(compact('permissionCategory'));

        $this->render('EntreeCore.edit');
    }

    /**
     * Delete method
     *
     * @param string $permissionCategoryId The permission category ID
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException
     * @throws \Cake\Http\Exception\InternalErrorException
     */
    public function delete($permissionCategoryId)
    {
        $permissionCategory = $this->PermissionCategories->get($permissionCategoryId);
        if ($this->loginUser->cannot('delete', $permissionCategory)) {
            throw new ForbiddenException();
        }

        if ($permissionCategory->deleted !== null) {
            $this->Flash->warning(__(
                'The {0} has already been deleted.',
                strtolower(__d('permission_categories', 'Permission category'))
            ));
        } else {
            $permissionCategory->deleted = FrozenTime::now();
            if (!$this->PermissionCategories->save($permissionCategory)) {
                throw new InternalErrorException();
            }
            $this->Flash->success(__(
                'The {0} has been deleted.',
                strtolower(__d('permission_categories', 'Permission category'))
            ));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Index
     *
     * @return void
     */
    public function index()
    {
        $query = $this->PermissionCategories->find('notDeleted');
        $permissionCategories = $this->paginate($query);
        $this->set(compact('permissionCategories'));

        $this->render('EntreeCore.index');
    }
}
