<?php
/**
 * @var \EntreeCore\View\AppView $this
 * @var iterable<\EntreeCore\Model\Entity\Permission> $permissions
 */

$pageTitle = __d('permissions', 'Permissions');
$this->assign('title', $this->makeAdminTitle($pageTitle));

$this->element('EntreeCore.Permissions/breadcrumbs');
?>
<div class="container-xxl">
  <div class="d-flex flex-row flex-wrap align-items-center gap-3">
    <h1 class="m-0">
      <?= $pageTitle ?>
    </h1>
    <nav class="ms-auto d-flex flex-row gap-3">
      <!-- Permission categories -->
      <?php $url = $this->Url->build(['controller' => 'PermissionCategories', 'action' => 'index']) ?>
      <a class="btn btn-outline-dark btn-sm rounded-pill" href="<?= $url ?>">
        <?= __d('permissions', 'Permission categories') ?>
      </a>

      <!-- Add new -->
      <?php $url = $this->Url->build(['action' => 'add']) ?>
      <a class="btn btn-secondary btn-sm rounded-circle" href="<?= $url ?>" title="<?= __('Add new') ?>">
        <i class="fas fa-plus"></i>
      </a>
    </nav>
  </div>
</div>

<!-- Perission list -->
<?php $pagination = $this->element('EntreeCore.layout/pagination'); ?>
<div class="container-xxl mt-4">
  <?= $pagination ?>

  <?= $this->element('EntreeCore.Permissions/list'); ?>

  <?= $pagination ?>
</div>
