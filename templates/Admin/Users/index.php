<?php
/**
 * @var \EntreeCore\View\AppView $this
 * @var iterable<\EntreeCore\Model\Entity\User> $users
 */

$pageTitle = __d('users', 'Users');
$this->assign('title', $this->makeAdminTitle($pageTitle));

$this->element('EntreeCore.Users/breadcrumbs');
?>
<div class="container-xxl mb-4">
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

<?= $this->element('EntreeCore.layout/flash') ?>

<!-- User list -->
<?php $pagination = $this->element('EntreeCore.layout/pagination'); ?>
<div class="container-xxl mt-4">
  <?= $pagination ?>

  <?= $this->element('EntreeCore.Users/list') ?>

  <?= $pagination ?>
</div>
