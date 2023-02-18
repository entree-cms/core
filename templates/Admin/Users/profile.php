<?php
/**
 * @var \EntreeCore\Model\Entity\User $user The user
 * @var \EntreeCore\View\AppView $this The viewer
 */

 $pageTitle = __('Edit {0}', strtolower(__d('users', 'Profile')));
$this->assign('title', $this->makeAdminTitle($pageTitle));

$this->Html->script([
  'EntreeCore.common/users/form',
], [
  'block' => true,
]);

$breadcrumbs = $breadcrumbBase;
$breadcrumbs[] = ['title' => __d('users', 'Profile')];
$this->Breadcrumbs->add($breadcrumbs);
?>
<div class="container-xxl my-4">
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
