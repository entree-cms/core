<?php
/**
 * @var \EntreeCore\View\AppView $this
 * @var \EntreeCore\Model\Entity\User $loginUser
 * @var \EntreeCore\Model\Entity\Role $role
 */
?>
<?php if ($loginUser->can('delete', $role)): ?>
  <?= $this->Form->postButton(
    __d('entree', 'Delete'),
    ['action' => 'delete', $role->id],
    [
      'class' => 'btn btn-danger',
      'confirm' => __d('entree', 'Are you sure?')
    ]
  ) ?>
<?php endif; ?>
