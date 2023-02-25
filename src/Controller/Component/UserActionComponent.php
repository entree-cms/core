<?php
declare(strict_types=1);

namespace EntreeCore\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\ORM\Locator\LocatorAwareTrait;

/**
 * UserAction component
 */
class UserActionComponent extends Component
{
    use LocatorAwareTrait;

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    /**
     * @var \Cake\Controller\Controller $controller The controller this component is bound to.
     */
    protected $controller;

    /**
     * @var \EntreeCore\Model\Entity\User $loginUser The loginUser
     */
    protected $loginUser;

    /**
     * @var \Cake\Http\ServerRequest $request The request
     */
    protected $request;

    /**
     * @var \Cake\ORM\Table $Users The users table
     */
    protected $Users;

    /**
     * Initialize
     *
     * @param array $config The configurations
     * @return void
     */
    public function initialize(array $config): void
    {
        $this->controller = $this->getController();
        $this->request = $this->controller->getRequest();
        $this->loginUser = $this->request->getAttribute('identity');

        $this->Users = $this->fetchTable('EntreeCore.Users');
    }

    // *********************************************************
    // * Internal methods
    // *********************************************************

    /**
     * Execute profile action
     *
     * @return \Cake\Http\Response|null|void
     */
    public function executeProfile()
    {
        $this->request->getAttribute('identity');

        $user = $this->Users->get($this->loginUser->id, [
            'contain' => [
                'Roles',
            ],
        ]);

        if ($this->request->is('put')) {
            $postData = $this->request->getData();
            $user = $this->Users->patchEntity($user, $postData);
            if ($this->Users->save($user)) {
                if (property_exists($this->controller, 'Authentication')) {
                    $this->controller->Authentication->setIdentity($user);
                }
                $this->controller->Flash->success(__(
                    'The {0} has been saved successfully.',
                    strtolower(__d('users', 'User'))
                ));

                return $this->controller->redirect(['action' => $this->request->getParam('action')]);
            }
            $this->controller->Flash->error(__(
                'The {0} could not be saved. Please, try again.',
                strtolower(__d('users', 'User'))
            ));
        }

        $this->controller->set(compact('user'));

        $this->controller->set($this->getFormVars());
    }

    /**
     * Get variables for form.
     *
     * @return array
     */
    public function getFormVars()
    {
        return [
            'localeOptions' => $this->makeLocaleOptions(),
            'roleOptions' => $this->makeRoleOptions(),
        ];
    }

    /**
     * Make locale options
     *
     * @return array
     */
    protected function makeLocaleOptions()
    {
        $locales = Configure::read('Entree.locales');

        return array_map(function ($locale) {
            return [
                'text' => __d('Languages', $locale),
                'value' => $locale,
            ];
        }, $locales);
    }

    /**
     * Make role options
     *
     * @return array
     */
    protected function makeRoleOptions()
    {
        return $this->fetchTable('EntreeCore.Roles')->find('notDeleted')
            ->all()
            ->map(function ($role) {
                return [
                    'text' => $role->name,
                    'value' => $role->id,
                ];
            })
            ->toArray();
    }
}
