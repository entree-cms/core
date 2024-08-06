<?php
/**
 * Login form
 *
 * @var \Cake\View\AppView $this
 */
?>
<div class="d-flex flex-column gap-3">
  <?= $this->Form->exControl('username', [
    'label' => __d('ecr_users', 'Username'),
    'autofocus' => true,
  ]) ?>

  <?= $this->Form->exControl('password', [
    'label' => __d('ecr_users', 'Password'),
    'type' => 'password',
    'val' => '',
  ]) ?>
</div>
