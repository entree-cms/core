<?php
/**
 * @var \EntreeCore\Model\Entity\User $loginUser
 * @var \EntreeCore\View\AppView $this
 */
?>
<?php if ($loginUser->can('manage roles')): ?>
  <?= $this->element('EntreeCore.layout/nav_item', [
    'title' => __d('admin_layout', 'Roles'),
    'isActive' => $this->request->getParam('controller') === 'Roles',
    'url' => $this->Url->build([
      'plugin' => 'EntreeCore',
      'controller' => 'Roles',
      'action' => 'index',
    ]),
  ]) ?>
<?php endif; ?>
