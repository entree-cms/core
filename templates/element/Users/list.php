<?php
/**
 * @var \EntreeCore\View\AppView $this
 * @var iterable<\EntreeCore\Model\Entity\User> $users
 */
?>
<div class="table-responsive bg-white">
  <table class="table table-sm table-hover table-striped border small">
    <thead>
      <tr class="text-nowrap">
        <th><?= $this->Paginator->sort('username', __d('users', 'Username')) ?></th>
        <th><?= $this->Paginator->sort('full_name', __d('users', 'Full name')) ?></th>
        <th><?= __d('users', 'Role') ?></th>
        <th><?= $this->Paginator->sort('created', __('Created')) ?></th>
        <th><?= $this->Paginator->sort('modified', __('Modified')) ?></th>
        <th><?= __('Actions') ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user): ?>
        <tr>
          <!-- Username -->
          <td class="py-1">
            <div class="d-flex flex-row gap-2 align-items-center">
              <?= $this->element('EntreeCore.Users/avatar', ['user' => $user, 'size' => 24]) ?>
              <?= h($user->username) ?>
            </div>
          </td>
          <!-- Name -->
          <td>
            <?php $fullName = $user->full_name; ?>
            <?php if ($fullName): ?>
              <?= h($user->full_name) ?>
            <?php else: ?>
              <div class="text-muted">-</div>
            <?php endif; ?>
          </td>
          <!-- Role -->
          <td>
            <?php $roleNames = $user->role_names ?>
            <?php if (is_array($roleNames) && count($roleNames) > 0): ?>
              <?= implode($roleNames ?? ', ') ?>
            <?php else: ?>
              <div class="text-cente text-muted">-</div>
            <?Php endif; ?>
          </td>
          <!-- Created -->
          <td>
            <?= h($user->created) ?>
          </td>
          <!-- Modified -->
          <td>
            <?= h($user->modified) ?>
          </td>
          <!-- Actions -->
          <td>
            <?php $url = $this->Url->build(['action' => 'edit', $user->id]); ?>
            <a href="<?= $url ?>" class="btn btn-sm btn-primary">
              <?= __('Edit') ?>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
