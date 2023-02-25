<?php
declare(strict_types=1);

namespace EntreeCore\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\InternalErrorException;
use Cake\Http\Exception\NotFoundException;

/**
 * Users Controller
 *
 * @property \EntreeCore\Model\Table\UsersTable $Users
 * @method \EntreeCore\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Initialization hook method.
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->Authentication->allowUnauthenticated(['avatar', 'login', 'logout']);
    }

    // *******************************************************
    // * Actions
    // *******************************************************

    /**
     * Avatar method
     *
     * @param string $fileName The file name
     * @return \Cake\Http\Response Output the file
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When there is no first record.
     * @throws \Cake\Http\Exception\NotFoundException When file not found
     */
    public function avatar($fileName)
    {
        $this->Authorization->skipAuthorization();

        $user = $this->Users->findByAvatar($fileName)->firstOrFail(); // @phpstan-ignore-line

        $filePath = $user->avatar_path;
        if (!is_string($filePath) || !file_exists($filePath)) {
            throw new NotFoundException();
        }

        return $this->response->withFile($filePath);
    }

    /**
     * Login method
     *
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Http\Exception\InternalErrorException
     */
    public function login()
    {
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('EntreeCore.login');

        $result = $this->Authentication->getResult();
        if ($result === null) {
            throw new InternalErrorException();
        }

        if ($result->isValid()) {
            return $this->redirect($this->getLoginRedirectUrl($result));
        }

        if ($this->request->is('post') && $result->isValid() === false) {
            $this->Flash->error(__d('login', 'Invalid {0} or password', [
                strtolower(__d('users', 'Username')),
            ]));
        }
    }

    /**
     * Logout method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function logout()
    {
        $this->Authorization->skipAuthorization();

        $this->Authentication->logout();

        return $this->redirect(['action' => 'login']);
    }

    // *********************************************************
    // * Internal methods
    // *********************************************************

    /**
     * Get login redirect URL
     *
     * @param \Authentication\Authenticator\ResultInterface $result The result of the last authenticate
     * @return \Psr\Http\Message\UriInterface|array|string
     */
    protected function getLoginRedirectUrl($result)
    {
        $redirect = $this->request->getQuery('redirect');
        if ($redirect) {
            return $redirect;
        }

        return Configure::read('Entree.loginRedirect', [
            'prefix' => 'Site',
            'controller' => 'Home',
            'action' => 'index',
        ]);
    }
}
