<?php
/**
 * @var \EntreeCore\Model\Entity\Role $role The role
 * @var \EntreeCore\View\AppView $this The view
 */
?>
<div class="permission-form">
  <div class="form-container">
    <!-- Label -->
    <label class="form-label">
      <?= __d('roles', 'Permissions'); ?>
    </label>
    <!-- Privileged role -->
    <?php if ($role->is_privileged): ?>
      <?= $this->element('EntreeCore.Roles/permission_form_privileged_alert') ?>
    <?php else: ?>
      <!-- Permission list -->
      <?= $this->element('EntreeCore.Roles/permission_form_list') ?>
    <?php endif; ?>
  </div>
</div>
