<?php
declare(strict_types=1);

namespace EntreeCore\Controller;

use App\Controller\AppController as BaseController;
use Cake\Core\Configure;
use Cake\Http\Exception\InternalErrorException;
use Cake\I18n\I18n;

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
    protected $defaultLocale;

    /**
     * @var ?\EntreeCore\Model\Entity\User The login user
     */
    protected $loginUser;

    /**
     * @var \Cake\Http\Session|null Session
     */
    protected $session;

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

        $this->configureLocales();
        $this->configurePaths();

        $this->initLocale();
        $this->initView();
    }

    // *********************************************************
    // * User-defined functions
    // *********************************************************

    /**
     * Configure locales
     *
     * @internal
     * @return void
     */
    protected function configureLocales(): void
    {
        $locales = Configure::read('Entree.locales', []);
        if (is_array($locales) && count($locales) > 0) {
            return;
        }
        $defaultLocales = Configure::read('EntreeCore.locales');
        Configure::write('Entree.locales', $defaultLocales);
    }

    /**
     * Configure navigation items
     *
     * @internal
     * @param string|null $prefix The prefix
     * @return void
     */
    protected function configureNavItems($prefix = null): void
    {
        $prefix = $prefix ?? $this->request->getParam('prefix');
        $navItems = Configure::read("{$prefix}.navItems", []);
        $thisNavItems = Configure::read("EntreeCore.{$prefix}.navItems", []);
        Configure::write("{$prefix}.navItems", array_merge($thisNavItems, $navItems));
    }

    /**
     * Configure paths
     *
     * @internal
     * @return void
     */
    protected function configurePaths(): void
    {
        $defaultPaths = Configure::read('EntreeCore.paths');
        $paths = Configure::read('Entree.paths', []);
        Configure::write('Entree.paths', array_merge($defaultPaths, $paths));
    }

    /**
     * Initialize locale
     *
     * @return void
     */
    protected function initLocale(): void
    {
        $this->defaultLocale = Configure::read('App.defaultLocale');

        $locale = $this->session->read('locale');
        if (!$locale) {
            $userLocale = $this->loginUser->locale ?? null;
            $locale = $userLocale ?? $this->defaultLocale;
        }

        I18n::setLocale($locale);
    }

    /**
     * Initialize session
     *
     * @return void
     */
    protected function initSession(): void
    {
        $this->session = $this->request->getSession();
    }

    /**
     * Initialize view
     *
     * @return void
     */
    protected function initView(): void
    {
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
        $locales = Configure::read('Entree.locales');
        if (!is_array($locales)) {
            throw new InternalErrorException();
        }

        $localeList = [];
        foreach ($locales as $locale) {
            $localeList[$locale] = __d('locales', $locale);
        }

        $defaultLocale = Configure::read('App.defaultLocale');
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
        $this->loginUser = $this->request->getAttribute('identity');
        if ($this->request->getParam('prefix') !== 'Api') {
            $this->set('loginUser', $this->loginUser);
        }
    }
}
