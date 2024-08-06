<?php
/**
 * @var \EntreeCore\View\AppView $this
 * @var \EntreeCore\Model\Entity\User $loginUser
 * @var \EntreeCore\Model\Entity\Permission $permission
 */
?>
<?php if ($loginUser->can('delete', $permission)): ?>
  <?= $this->Form->postButton(
    __d('ecr_common', 'Delete'),
    ['action' => 'delete', $permission->id],
    [
      'class' => 'btn btn-danger',
      'confirm' => __d('ecr_common', 'Are you sure?')
    ]
  ) ?>
<?php endif; ?>
