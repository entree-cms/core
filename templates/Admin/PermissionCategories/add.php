<?php
/**
 * @var \EntreeCore\Model\Entity\PermissionCategory $permissionCategory The permission category
 * @var \EntreeCore\View\AppView $this The view
 */
$pageTitle = __('Add {0}', strtolower(__d('permission_categories', 'Permission category')));
$this->assign('title',  $this->makeTitle($pageTitle));

$this->element('EntreeCore.PermissionCategories/breadcrumbs');
?>
<div class="container-xxl mb-4">
  <h1 class="m-0">
    <?= $pageTitle ?>
  </h1>
</div>

<?= $this->element('EntreeCore.layout/flash') ?>

<?= $this->Form->create($permissionCategory); ?>
  <div class="container-xxl mt-4">
    <div class="d-flex flex-column gap-5">
      <!-- Input fields -->
      <?= $this->element('EntreeCore.PermissionCategories/form') ?>
      <!-- Action -->
      <div class="py-5 text-center">
        <button type="submit" class="btn btn-success">
          <?= __('Save') ?>
        </button>
      </div>
    </div>
  </div>
<?= $this->Form->end(); ?>
