<?php
/**
 * @var \EntreeCore\View\AppView $this
 * @var \EntreeCore\Model\Entity\User $loginUser
 * @var \EntreeCore\Model\Entity\PermissionCategory $permissionCategory
 */
?>
<?php if ($loginUser->can('delete', $permissionCategory)): ?>
  <?= $this->Form->postButton(
    __d('ecr_common', 'Delete'),
    ['action' => 'delete', $permissionCategory->id],
    [
      'class' => 'btn btn-danger',
      'confirm' => __d('ecr_common', 'Are you sure?')
    ]
  ) ?>
<?php endif; ?>
