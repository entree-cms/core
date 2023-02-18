<?php
/**
 * @var \EntreeCore\Model\Entity\User $user The user
 * @var \EntreeCore\View\AppView $this The viewer
 */

$pageTitle = __('Add {0}', strtolower(__d('users', 'User')));
$this->assign('title', $this->makeAdminTitle($pageTitle));

$this->Html->script([
  'EntreeCore.common/users/form',
], [
  'block' => true,
]);

$this->element('EntreeCore.Users/breadcrumbs');
?>
<div class="container-xxl mb-4">
  <h1 class="m-0">
    <?= $pageTitle ?>
  </h1>
</div>

<?= $this->element('EntreeCore.layout/flash') ?>

<?= $this->Form->create($user, ['type' => 'file']); ?>
  <div class="container-xxl mt-4">
    <div class="d-flex flex-column gap-5">
      <!-- Input fields -->
      <div id="user-form">
        <?= $this->element('EntreeCore.Users/form') ?>
      </div>
      <!-- Actions -->
      <div class="py-5 text-center">
        <button type="submit" class="btn btn-success">
          <?= __('Save') ?>
        </button>
      </div>
    </div>
  </div>
<?= $this->Form->end(); ?>
