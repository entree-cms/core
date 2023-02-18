<?php
/**
 * Login form
 *
 * @var \Cake\View\AppView $this
 */
?>
<div class="d-flex flex-column gap-3">
  <?= $this->Form->exControl('username', [
    'label' => __d('users', 'Username'),
    'autofocus' => true,
    'val' => $this->request->getData('username'),
  ]) ?>

  <?= $this->Form->exControl('password', [
    'label' => __d('users', 'Password'),
    'type' => 'password',
    'val' => false,
  ]) ?>
</div>
