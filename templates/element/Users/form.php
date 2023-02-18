<?php
/**
 * @var \EntreeCore\Model\Entity\User $user The user
 * @var \EntreeCore\View\AppView $this The view
 */

$this->Html->css([
  'EntreeCore.common/users/form',
], [
  'block' => true,
])
?>
<div class="user-form d-flex flex-column gap-4">
  <!-- Name -->
  <?= $this->element('EntreeCore.Users/name_form') ?>

  <!-- Role -->
  <?= $this->element('EntreeCore.Users/role_form') ?>

  <!-- Nickname -->
  <?= $this->element('EntreeCore.Users/nickname_form') ?>

  <!-- Username -->
  <?= $this->element('EntreeCore.Users/username_form') ?>

  <!-- Password -->
  <?= $this->element('EntreeCore.Users/password_form') ?>

  <!-- Email -->
  <?= $this->element('EntreeCore.Users/email_form') ?>

  <!-- Avatar -->
  <?= $this->element('EntreeCore.Users/avatar_form') ?>

  <!-- Locale -->
  <?= $this->element('EntreeCore.Users/locale_form') ?>
</div>
