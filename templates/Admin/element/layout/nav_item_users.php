<?php
/**
 * @var \EntreeCore\View\AppView $this
 */
?>
<?= $this->element('EntreeCore.layout/nav_item', [
  'title' => __d('admin_layout', 'Users'),
  'isActive' => $this->request->getParam('controller') === 'Users',
  'url' => $this->Url->build([
    'plugin' => 'EntreeCore',
    'controller' => 'Users',
    'action' => 'index',
  ]),
]) ?>
