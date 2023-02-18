<?php
/**
 * @var \EntreeCore\View\AppView $this
 */
?>
<?= $this->element('EntreeCore.layout/nav_item', [
  'title' => __d('admin_layout', 'Home'),
  'isActive' => $this->request->getParam('controller') === 'Home',
  'url' => $this->Url->build([
    'plugin' => 'EntreeCore',
    'controller' => 'Home',
    'action' => 'index',
  ]),
]) ?>
