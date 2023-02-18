<?php
/**
 * @var \EntreeCore\View\AppView $this The view
 * @var iterable<\EntreeCore\Model\Entity\PermissionCategory> $permissionCategories The permission categories
 */
$pageTitle = __d('permission_categories', 'Permission categories');
$this->assign('title', $this->makeAdminTitle($pageTitle));

$pagination = $this->element('EntreeCore.layout/pagination');

$this->element('EntreeCore.PermissionCategories/breadcrumbs');
?>
<div class="container-xxl">
  <div class="d-flex flex-row flex-wrap align-items-center gap-3">
    <h1 class="m-0">
      <?= $pageTitle ?>
    </h1>
    <nav class="ms-auto">
      <?php $url = $this->Url->build(['action' => 'add']) ?>
      <a class="btn btn-secondary btn-sm rounded-circle" href="<?= $url ?>" title="<?= __('Add new') ?>">
        <i class="fas fa-plus"></i>
      </a>
    </nav>
  </div>
</div>

<div class="container-xxl mt-4">
  <?= $pagination ?>

  <?= $this->element('EntreeCore.PermissionCategories/list'); ?>

  <?= $pagination ?>
</div>