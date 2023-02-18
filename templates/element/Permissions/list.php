<?php
/**
 * @var \EntreeCore\View\AppView $view The view
 * @var iterable<\EntreeCore\Model\Entity\Permission> $permissions The permissions
 */
?>
<div class="table-responsive bg-white">
  <table class="table table-sm table-hover table-striped border small">
    <thead>
      <tr class="text-nowrap">
        <th><?= $this->Paginator->sort('permission_category.name', __d('permissions', 'Category')) ?></th>
        <th><?= $this->Paginator->sort('name', __d('permissions', 'Name')) ?></th>
        <th><?= $this->Paginator->sort('code', __d('permissions', 'Code')) ?></th>
        <th><?= $this->Paginator->sort('description', __d('permissions', 'Description')) ?></th>
        <th><?= $this->Paginator->sort('created', __('Created')) ?></th>
        <th><?= $this->Paginator->sort('modified', __('Modified')) ?></th>
        <th><?= __('Actions') ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($permissions as $permission): ?>
        <tr>
          <!-- Permission category -->
          <td>
            <?= h($permission->permission_category->name) ?>
          </td>
          <!-- Name -->
          <td>
            <?= h($permission->name) ?>
          </td>
          <!-- Code -->
          <td>
            <?= h($permission->code) ?>
          </td>
          <!-- Description -->
          <td>
            <?php if (is_string($permission->description)): ?>
              <?= h($permission->description) ?>
            <?php else: ?>
              <span class="text-muted">-</span>
            <?php endif; ?>
          </td>
          <!-- Created -->
          <td>
            <?= h($permission->created) ?>
          </td>
          <!-- Modified -->
          <td>
            <?= h($permission->modified) ?>
          </td>
          <!-- Actions -->
          <td>
            <?php $url = $this->Url->build(['action' => 'edit', $permission->id]); ?>
            <a href="<?= $url ?>" class="btn btn-sm btn-primary">
              <?= __('Edit') ?>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
