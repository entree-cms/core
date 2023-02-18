<?php
/**
 * @var \EntreeCore\View\AppView $view The view
 * @var iterable<\EntreeCore\Model\Entity\Role> $roles The roles
 */
?>
<div class="table-responsive bg-white">
  <table class="table table-sm table-hover table-striped border small">
    <thead>
      <tr class="text-nowrap">
        <th><?= $this->Paginator->sort('name', __d('roles', 'Name')) ?></th>
        <th><?= $this->Paginator->sort('code', __d('roles', 'Code')) ?></th>
        <th><?= $this->Paginator->sort('description', __d('roles', 'Description')) ?></th>
        <th><?= $this->Paginator->sort('created', __d('roles', 'Created')) ?></th>
        <th><?= $this->Paginator->sort('modified', __d('roles', 'Modified')) ?></th>
        <th><?= __('Actions') ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($roles as $role): ?>
        <tr>
          <!-- Name -->
          <td>
            <?= h($role->name) ?>
          </td>
          <!-- Code -->
          <td>
            <?= h($role->code) ?>
          </td>
          <!-- Description -->
          <td>
            <?php if (is_string($role->description)): ?>
              <?= h($role->description) ?>
            <?php else: ?>
              <span class="text-muted">-</span>
            <?php endif; ?>
          </td>
          <!-- Created -->
          <td>
            <?= h($role->created) ?>
          </td>
          <!-- Modified -->
          <td>
            <?= h($role->modified) ?>
          </td>
          <!-- Actions -->
          <td>
            <!-- Edit -->
            <?php $url = $this->Url->build(['action' => 'edit', $role->id]) ?>
            <a href="<?= $url ?>" class="btn btn-sm btn-primary">
              <?= __('Edit') ?>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
