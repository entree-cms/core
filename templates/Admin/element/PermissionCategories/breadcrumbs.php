<?php
/**
 * @var \EntreeCore\View\AppView $this The view
 * @var array $breadcrumbBase The base parameters for breadcrumbs
 */

$action = $this->request->getParam('action');
$params = $breadcrumbBase;
$params[] = ['title' => __d('permissions', 'Permissions'), 'url' => ['controller' => 'Permissions', 'action' => 'index']];

// Permission category list
$isList = $action === 'index';
$url = $isList ? null : ['plugin' => 'EntreeCore', 'controller' => 'PermissionCategories', 'action' => 'index'];
$params[] = ['title' => __d('permission_categories', 'Categories'), 'url' => $url];

// Current
switch ($action) {
  case 'add':
    $params[] = ['title' => __('Add new')];
    break;
  case 'edit':
    $params[] = ['title' => __('Edit')];
    break;
}

$this->Breadcrumbs->add($params);
