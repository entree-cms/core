<?php
use Cake\Core\Configure;

return [
    'EntreeCore' => [
        'locales' => [
            Configure::read('App.defaultLocale', env('APP_DEFAULT_LOCALE', 'en_US')),
        ],
        'paths' => [
            'avatars' => ENTREE_CORE_DEFAULT_STORAGE . 'avatars',
        ],

        'Admin' => [
            // Navigation items
            'navItems' => [
                'home' => [
                    'element' => 'layout/nav_item_home',
                    'sortNo' => 100,
                ],
                'users' => [
                    'element' => 'layout/nav_item_users',
                    'sortNo' => 200,
                ],
                'settings' => [
                    'element' => 'layout/nav_item_settings',
                    'sortNo' => 900,
                    'vars' => [
                        'navItems' => [
                            'roles' => [
                                'element' => 'layout/nav_item_roles',
                                'sortNo' => 100,
                            ],
                            'permissions' => [
                                'element' => 'layout/nav_item_permissions',
                                'sortNo' => 200,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
