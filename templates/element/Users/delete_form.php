<?php
/**
 * @var \EntreeCore\View\AppView $this
 * @var \EntreeCore\Model\Entity\User $loginUser
 * @var \EntreeCore\Model\Entity\User $user
 */
?>
<?php if ($loginUser->can('delete', $user)): ?>
  <?= $this->Form->postButton(
    __d('entree', 'Delete'),
    ['action' => 'delete', $user->id],
    [
      'class' => 'btn btn-danger',
      'confirm' => __d('entree', 'Are you sure?')
    ]
  ) ?>
<?php endif; ?>
