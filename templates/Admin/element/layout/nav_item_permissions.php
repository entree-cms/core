<?php
/**
 * @var \EntreeCore\Model\Entity\User $loginUser
 * @var \EntreeCore\View\AppView $this
 */
?>
<?php if ($loginUser->can('manage permissions')): ?>
  <?= $this->element('EntreeCore.layout/nav_item', [
    'title' => __d('admin_layout', 'Permissions'),
    'isActive' => $this->request->getParam('controller') === 'Permissions',
    'url' => $this->Url->build([
      'plugin' => 'EntreeCore',
      'controller' => 'Permissions',
      'action' => 'index',
    ]),
  ]) ?>
<?php endif; ?>
