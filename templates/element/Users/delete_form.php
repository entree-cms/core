<?php
/**
 * @var \EntreeCore\View\AppView $this
 * @var \EntreeCore\Model\ENtity\User $loginUser
 * @var \EntreeCore\Model\Entity\User $user
 */
?>
<?php if ($loginUser->can('delete', $user)): ?>
  <?= $this->Form->postButton(
    __('Delete'),
    ['action' => 'delete', $user->id],
    [
      'class' => 'btn btn-danger',
      'confirm' => __('Are you sure?')
    ]
  ) ?>
<?php endif; ?>
