<?php
/**
 * @var \EntreeCore\Model\Entity\ $Permission The Permission
 * @var \EntreeCore\View\AppView $this The view
 */

$pageTitle = __d('ecr_common', 'Add {0}', strtolower(__d('ecr_permissions', 'Permission')));
$this->assign('title',  $this->makeTitle($pageTitle));

$this->element('EntreeCore.Permissions/breadcrumbs');
?>
<div class="container-xxl mb-4">
  <h1 class="m-0">
    <?= $pageTitle ?>
  </h1>
</div>

<?= $this->element('EntreeCore.layout/flash') ?>

<?= $this->Form->create($permission); ?>
  <div class="container-xxl mt-4">
    <div class="d-flex flex-column gap-5">
      <!-- Input fields -->
      <div class="permission-form d-flex flex-column gap-4">
        <?= $this->element('EntreeCore.Permissions/form') ?>
      </div>
      <!-- Actions -->
      <div class="py-5 text-center">
        <button type="submit" class="btn btn-success">
          <?= __d('ecr_common', 'Save') ?>
        </button>
      </div>
    </div>
  </div>
<?= $this->Form->end(); ?>
