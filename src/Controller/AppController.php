<?php
declare(strict_types=1);

namespace EntreeCore\Controller;

use App\Controller\AppController as BaseController;
use Cake\Core\Configure;
use Cake\Http\Exception\InternalErrorException;
use Cake\Http\Session;
use Cake\I18n\I18n;
use Cake\Routing\Router;
use EntreeCore\Model\Entity\User;

/**
 * Application controller
 *
 * @property \Authentication\Controller\Component\AuthenticationComponent $Authentication
 * @property \Authorization\Controller\Component\AuthorizationComponent $Authorization
 */
class AppController extends BaseController
{
    /**
     * @var ?string Default locale
     */
    protected ?string $defaultLocale = null;

    /**
     * @var ?\EntreeCore\Model\Entity\User The login user
     */
    protected ?User $loginUser = null;

    /**
     * @var \Cake\Http\Session|null Session
     */
    protected ?Session $session = null;

    /**
     * Initialization hook method.
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Authentication.Authentication');
        $this->loadComponent('Authorization.Authorization');

        $this->initSession();

        $this->setLocaleVars();
        $this->setLoginUser();

        $this->initFlash();
        $this->initLocale();
        $this->initPersonalNameOrder();
        $this->initView();
    }

    // *********************************************************
    // * Internal methods
    // *********************************************************

    /**
     * Get base parameters for breadcrumbs
     *
     * @return array
     */
    protected function getBreadcrumbBase(): array
    {
        if (method_exists(parent::class, 'getBreadcrumbBase')) {
            return parent::getBreadcrumbBase();
        }

        $prefix = $this->request->getParam('prefix');

        $title = __d('ecr_site_layout', 'Home');
        $url = Router::url([
            'plugin' => 'EntreeCore',
            'prefix' => $prefix,
            'controller' => 'Home',
            'action' => 'index',
        ]);

        return [compact('title', 'url')];
    }

    /**
     * Initialize flash
     *
     * @return void
     */
    protected function initFlash(): void
    {
        if (method_exists(parent::class, 'initFlash')) {
            parent::initFlash();

            return;
        }

        $this->Flash->setConfig('plugin', 'EntreeCore');
    }

    /**
     * Initialize locale
     *
     * @return void
     */
    protected function initLocale(): void
    {
        if (method_exists(parent::class, 'initLocale')) {
            parent::initLocale();

            return;
        }

        $this->defaultLocale = Configure::read('App.defaultLocale');

        $locale = $this->session->read('locale');
        if (!$locale) {
            $userLocale = $this->loginUser->locale ?? null;
            $locale = $userLocale ?? $this->defaultLocale;
        }

        I18n::setLocale($locale);
    }

    /**
     * Initialize personal name order
     *
     * @return null|void
     */
    protected function initPersonalNameOrder()
    {
        if (method_exists(parent::class, 'initPersonalNameOrder')) {
            parent::initPersonalNameOrder();

            return;
        }

        if (is_array(Configure::read('EntreeCore.personalNameOrder'))) {
            return;
        }

        $order = ['first', 'last'];

        $locale = I18n::getLocale();
        if (in_array($locale, ['ja_JP'])) {
            $order = ['last', 'first'];
        }

        Configure::write('EntreeCore.personalNameOrder', $order);
    }

    /**
     * Initialize session
     *
     * @return void
     */
    protected function initSession(): void
    {
        if (method_exists(parent::class, 'initSession')) {
            parent::initSession();

            return;
        }

        $this->session = $this->request->getSession();
    }

    /**
     * Initialize view
     *
     * @return void
     */
    protected function initView(): void
    {
        if (method_exists(parent::class, 'initView')) {
            parent::initView();

            return;
        }

        $this->viewBuilder()->setClassName('EntreeCore.App');
    }

    /**
     * Set variables about locale
     *
     * @return void
     * @throws \Cake\Http\Exception\InternalErrorException
     */
    protected function setLocaleVars(): void
    {
        if (method_exists(parent::class, 'setLocaleVars')) {
            parent::setLocaleVars();

            return;
        }

        $defaultLocale = Configure::read('App.defaultLocale');
        $locales = Configure::read('EntreeCore.locales', [$defaultLocale]);
        if (!is_array($locales)) {
            throw new InternalErrorException();
        }

        $localeList = [];
        foreach ($locales as $locale) {
            $localeList[$locale] = __d('ecr_locales', $locale);
        }

        $translationLocales = array_filter($locales, function ($value) use ($defaultLocale) {
            return $value !== $defaultLocale;
        });

        $this->set(compact('locales', 'localeList', 'translationLocales'));
    }

    /**
     * Set login user
     *
     * @return void
     */
    protected function setLoginUser(): void
    {
        if (method_exists(parent::class, 'setLoginUser')) {
            parent::setLoginUser();

            return;
        }

        $this->loginUser = $this->request->getAttribute('identity');
        if ($this->request->getParam('prefix') !== 'Api') {
            $this->set('loginUser', $this->loginUser);
        }
    }
}
