<?php
/**
 * @var \EntreeCore\Model\Entity\Permission $permission The user
 * @var \EntreeCore\View\AppView $this The view
 */
?>
<!-- Permission category -->
<?php $field = 'permission_category_id'; ?>
<?= $this->Form->exControl('permission_category_id', [
  'label' => __d('ecr_permissions', 'Category'),
  'options' => $permissionCategories->combine('id', 'name')->toArray(),
  'required' => true,
]) ?>

<!-- Code -->
<?= $this->Form->exControl('code', [
  'label' => __d('ecr_permissions', 'Code'),
  'required' => true,
]) ?>

<!-- Name -->
<?= $this->Form->exControl('name', [
  'label' => __d('ecr_permissions', 'Name'),
  'required' => true,
]) ?>


<!-- Description -->
<?= $this->Form->exControl('description', [
  'label' => __d('ecr_permissions', 'Description'),
]) ?>
