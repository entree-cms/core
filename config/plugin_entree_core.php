<?php
return [
    'EntreeCore' => [
        /*
         * Common
         */
        'base' => '',
        'locales' => null,
        'paths' => [
            'avatars' => ENTREE_CORE_DEFAULT_STORAGE . 'avatars',
        ],
        'personalNameOrder' => null, // ['first', 'last'] or ['last', 'first']
        'translate' => false,

        /*
         * Login
         */
        'loginRedirect' => [
            'prefix' => 'Site',
            'controller' => 'Home',
            'action' => 'index',
        ],
        'unauthRedirect' => [
            'plugin' => 'EntreeCore',
            'prefix' => '',
            'controller' => 'Users',
            'action' => 'login',
        ],

        /*
         * Admin
         */
        'Admin' => [
            'base' => 'admin-12345',
            'layout' => 'EntreeCore.admin_default',
            'title' => 'Entree CMS Admin',
            'titleSeparator' => ' - ',
            // Navigation items
            'navItems' => [
                'home' => [
                    'element' => 'EntreeCore.layout/nav_item_home',
                    'sortNo' => 100,
                ],
                'users' => [
                    'element' => 'EntreeCore.layout/nav_item_users',
                    'sortNo' => 200,
                ],
                'settings' => [
                    'element' => 'EntreeCore.layout/nav_item_settings',
                    'sortNo' => 900,
                    'vars' => [
                        'navItems' => [
                            'roles' => [
                                'element' => 'EntreeCore.layout/nav_item_roles',
                                'sortNo' => 100,
                            ],
                            'permissions' => [
                                'element' => 'EntreeCore.layout/nav_item_permissions',
                                'sortNo' => 200,
                            ],
                        ],
                    ],
                ],
            ],
        ],

        /*
         * API
         */
        'Api' => [
            'base' => 'api',
        ],

        /*
         * Site
         */
        'Site' => [
            'base' => '',
            'layout' => 'EntreeCore.site_default',
            'title' => 'Entree CMS',
            'titleSeparator' => ' - ',
            // Navigation items
            'navItems' => [],
        ],
    ],
];
