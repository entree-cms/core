<?php
/**
 * @var \EntreeCore\View\AppView $this
 * @var \EntreeCore\Model\Entity\User $loginUser
 * @var \EntreeCore\Model\Entity\PermissionCategory $permissionCategory
 */
?>
<?php if ($loginUser->can('delete', $permissionCategory)): ?>
  <?= $this->Form->postButton(
    __d('entree', 'Delete'),
    ['action' => 'delete', $permissionCategory->id],
    [
      'class' => 'btn btn-danger',
      'confirm' => __d('entree', 'Are you sure?')
    ]
  ) ?>
<?php endif; ?>
