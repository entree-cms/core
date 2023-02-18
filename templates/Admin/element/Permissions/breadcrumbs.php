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
$params[] = ['title' => __d('permissions', 'Permissions'), 'url' => $url];

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
