<?php
/**
 * @var \EntreeCore\Model\Entity\PermissionCategory $permissionCategory The permission category
 * @var \EntreeCore\View\AppView $this The view
 */

$pageTitle = __('Edit {0}', strtolower(__d('permission_categories', 'Permission category')));
$this->assign('title',  $this->makeTitle($pageTitle));

$this->element('EntreeCore.PermissionCategories/breadcrumbs');
?>
<div class="container-xxl mb-4">
  <h1 class="m-0">
    <?= $pageTitle ?>
  </h1>
</div>

<?= $this->element('EntreeCore.layout/flash') ?>

<?= $this->Form->create($permissionCategory, ['id' => 'form-permission-category']); ?>
  <div class="container-xxl mt-4">
    <div class="d-flex flex-column gap-5">
      <!-- Input fields -->
      <?= $this->element('EntreeCore.PermissionCategories/form') ?>
    </div>
  </div>
<?= $this->Form->end(); ?>

<!-- Delete -->
<div class="container-xxl mt-4 text-end">
  <?= $this->element('EntreeCore.PermissionCategories/delete_form') ?>
</div>

<!-- Action -->
<div class="py-5 text-center">
  <button type="submit" class="btn btn-success" form="form-permission-category">
    <?= __('Save') ?>
  </button>
</div>
