<?php

use Cake\Core\Configure;
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return static function (RouteBuilder $routes) {
    /*
     * Admin
     */
    (function () use ($routes) {
        $adminBase = Configure::read('Entree.Admin.base') ?? 'admin-12345';
        $params = ['plugin' => 'EntreeCore', 'prefix' => 'Admin'];
        // Home
        $routes->connect("{$adminBase}/", ['controller' => 'Home', 'action' => 'index'] + $params);
        // Permissions
        $routes->connect("{$adminBase}/permissions", ['controller' => 'Permissions', 'action' => 'index'] + $params);
        $routes->connect("{$adminBase}/permissions/add", ['controller' => 'Permissions', 'action' => 'add'] + $params);
        $routes->connect("{$adminBase}/permissions/edit/*", ['controller' => 'Permissions', 'action' => 'edit'] + $params);
        $routes->connect("{$adminBase}/permissions/delete/*", ['controller' => 'Permissions', 'action' => 'delete'] + $params);
        // Permission categories
        $routes->connect("{$adminBase}/permission-categories", ['controller' => 'PermissionCategories', 'action' => 'index'] + $params);
        $routes->connect("{$adminBase}/permission-categories/add", ['controller' => 'PermissionCategories', 'action' => 'add'] + $params);
        $routes->connect("{$adminBase}/permission-categories/edit/*", ['controller' => 'PermissionCategories', 'action' => 'edit'] + $params);
        $routes->connect("{$adminBase}/permission-categories/delete/*", ['controller' => 'PermissionCategories', 'action' => 'delete'] + $params);
        // Profile
        $routes->connect("{$adminBase}/profile", ['controller' => 'Users', 'action' => 'profile'] + $params);
        // Roles
        $routes->connect("{$adminBase}/roles", ['controller' => 'Roles', 'action' => 'index'] + $params);
        $routes->connect("{$adminBase}/roles/add", ['controller' => 'Roles', 'action' => 'add'] + $params);
        $routes->connect("{$adminBase}/roles/edit/*", ['controller' => 'Roles', 'action' => 'edit'] + $params);
        $routes->connect("{$adminBase}/roles/delete/*", ['controller' => 'Roles', 'action' => 'delete'] + $params);
        // Users
        $routes->connect("{$adminBase}/users", ['controller' => 'Users', 'action' => 'index'] + $params);
        $routes->connect("{$adminBase}/users/add", ['controller' => 'Users', 'action' => 'add'] + $params);
        $routes->connect("{$adminBase}/users/edit/*", ['controller' => 'Users', 'action' => 'edit'] + $params);
        $routes->connect("{$adminBase}/users/delete/*", ['controller' => 'Users', 'action' => 'delete'] + $params);
    })();

    /*
     * Api
     */
    (function () use ($routes) {
        $apiBase = Configure::read('Entree.Api.base') ?? 'api';
        $params = ['plugin' => 'EntreeCore', 'prefix' => 'Api'];
        // Configurations
        $routes->connect("{$apiBase}/configs/set-locale", ['controller' => 'Configs', 'action' => 'setLocale'] + $params);
    })();

    /*
     * Site
     */
    (function () use ($routes) {
        $siteBase = Configure::read('Entree.Site.base') ?? '';
        $params = ['plugin' => 'EntreeCore', 'prefix' => 'Site'];

        $routes->connect("{$siteBase}/", ['controller' => 'Home', 'action' => 'index'] + $params);
        // Profile
        $routes->connect("{$siteBase}/profile", ['controller' => 'Users', 'action' => 'profile'] + $params);
    })();

    /*
     * Others
     */
    (function () use ($routes) {
        $base = Configure::read('Entree.base') ?? '';
        $params = ['plugin' => 'EntreeCore', 'prefix' => ''];

        $routes->connect("{$base}/avatars/{fileName}", ['controller' => 'Users', 'action' => 'avatar'] + $params)
            ->setPass(['fileName']);
        $routes->connect("{$base}/login", ['controller' => 'Users', 'action' => 'login'] + $params);
        $routes->connect("{$base}/logout", ['controller' => 'Users', 'action' => 'logout'] + $params);
        $routes->connect("{$base}/profile", ['controller' => 'Users', 'action' => 'profile'] + $params);
    })();
};
