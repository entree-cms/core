<?php
/**
 * @var \EntreeCore\View\AppView $this The view
 * @var array $breadcrumbBase The base parameters for breadcrumbs
 */

$action = $this->request->getParam('action');
$params = $breadcrumbBase;

// Role list
$isList = $action === 'index';
$url = $isList ? null : ['plugin' => 'EntreeCore', 'controller' => 'Roles', 'action' => 'index'];
$params[] = ['title' => __d('ecr_roles', 'Roles'), 'url' => $url];

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
