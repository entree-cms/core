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

<!-- Search form -->
<div class="container-xxl my-4 py-2">
  <?= $this->element('EntreeCore.Users/search_form') ?>
</div>

<!-- User list -->
<div class="container-xxl">
  <?php if (count($users) === 0): ?>
    <div class="alert alert-secondary text-center">
      <?= __("We couldn't find any {0}.", strtolower(__d('users', 'Users'))) ?>
    </div>
  <?php else: ?>
    <?php $pagination = $this->element('EntreeCore.layout/pagination'); ?>
    <?= $pagination ?>

    <?= $this->element('EntreeCore.Users/list') ?>

    <?= $pagination ?>
  <?php endif; ?>
</div>
