<?php
/**
 * @var array $breadcrumbBase The base parameters for breadcrumbs
 * @var \EntreeCore\View\AppView $this The view
 */

$action = $this->request->getParam('action');
$params = $breadcrumbBase;

// Permission list
$isList = $action === 'index';
$url = $isList ? null : ['plugin' => 'EntreeCore', 'controller' => 'Permissions', 'action' => 'index'];
$params[] = ['title' => __d('ecr_permissions', 'Permissions'), 'url' => $url];

// Current
switch ($action) {
  case 'add':
    $params[] = ['title' => __d('ecr_common', 'Add new')];
    break;
  case 'edit':
    $params[] = ['title' => __d('ecr_common', 'Edit')];
    break;
}

$this->Breadcrumbs->add($params);
