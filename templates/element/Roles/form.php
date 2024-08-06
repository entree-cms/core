<?php
/**
 * @var \EntreeCore\View\AppView $this The view
 */
?>
<!-- Code -->
<?= $this->Form->exControl('code', [
  'label' => __d('ecr_roles', 'Code'),
  'required' => true,
]) ?>

<!-- Name -->
<?= $this->Form->exControl('name', [
  'label' => __d('ecr_roles', 'Name'),
  'required' => false,
]) ?>

<!-- Name -->
<?= $this->Form->exControl('description', [
  'label' => __d('ecr_roles', 'Description'),
]) ?>
