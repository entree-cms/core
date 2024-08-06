<?php
/**
 * @var \EntreeCore\View\AppView $this
 * @var \EntreeCore\Model\Entity\User $loginUser
 * @var \EntreeCore\Model\Entity\Role $role
 */
?>
<?php if ($loginUser->can('delete', $role)): ?>
  <?= $this->Form->postButton(
    __d('ecr_common', 'Delete'),
    ['action' => 'delete', $role->id],
    [
      'class' => 'btn btn-danger',
      'confirm' => __d('ecr_common', 'Are you sure?')
    ]
  ) ?>
<?php endif; ?>
