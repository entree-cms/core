<?php
/**
 * @var \EntreeCore\Model\Entity\PermissionCategory $permissionCategory The permission_category
 * @var \EntreeCore\View\AppView $this The view
 */
?>
<div class="permission_category-form d-flex flex-column gap-4">
  <?= $this->Form->exControl('name', [
    'label' => __d('permission_categories', 'Name'),
    'required' => true,
  ]) ?>

  <?= $this->Form->exControl('description', [
    'label' => __d('permission_categories', 'Description'),
    'required' => false,
  ]) ?>
</div>
