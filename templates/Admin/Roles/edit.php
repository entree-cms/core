<?php
/**
 * @var \EntreeCore\View\AppView $this The view
 * @var \EntreeCore\Model\Entity\Role $role The Role
 */

$pageTitle = __('Edit {0}', strtolower(__d('roles', 'Role')));
$this->assign('title',  $this->makeAdminTitle($pageTitle));

$this->element('EntreeCore.Roles/breadcrumbs');
?>
<div class="container-xxl mb-4">
  <h1 class="m-0">
    <?= $pageTitle ?>
  </h1>
</div>

<?= $this->element('EntreeCore.layout/flash') ?>

<?= $this->Form->create($role, ['id' => 'form-role']); ?>
  <div class="container-xxl mt-4">
    <div class="d-flex flex-column gap-5">
    <div class="role-form d-flex flex-column gap-4">
        <!-- Input fields -->
        <?= $this->element('EntreeCore.Roles/form') ?>

        <!-- Permission field -->
        <?= $this->element('EntreeCore.Roles/permission_form') ?>
      </div>
    </div>
  </div>
<?= $this->Form->end(); ?>

<!-- Delete -->
<div class="container-xxl mt-4 text-end">
  <?= $this->element('EntreeCore.Roles/delete_form') ?>
</div>

<!-- Action -->
<div class="py-5 text-center">
<button type="submit" class="btn btn-success" form="form-role">
    <?= __('Save') ?>
  </button>
</div>
