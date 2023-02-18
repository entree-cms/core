<?php
/**
 * @var \EntreeCore\View\AppView $view The view
 * @var iterable<\EntreeCore\Model\Entity\PermissionCategory> $permissionCategories The permission categories
 */
?>
<div class="table-responsive bg-white">
  <table class="table table-sm table-hover table-striped border m-0 small">
    <thead>
      <tr class="text-nowrap">
        <th><?= $this->Paginator->sort('name', __d('permission_categories', 'Name')) ?></th>
        <th><?= $this->Paginator->sort('description', __d('permission_categories', 'Description')) ?></th>
        <th><?= $this->Paginator->sort('created', __('Created')) ?></th>
        <th><?= $this->Paginator->sort('modified', __('Modified')) ?></th>
        <th><?= __('Actions') ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($permissionCategories as $permissionCategory): ?>
        <tr>
          <!-- Name -->
          <td>
            <?= h($permissionCategory->name) ?>
          </td>
          <!-- Description -->
          <td>
            <?= h($permissionCategory->description) ?>
          </td>
          <!-- Created -->
          <td>
            <?= h($permissionCategory->created) ?>
          </td>
          <!-- Modified -->
          <td>
            <?= h($permissionCategory->modified) ?>
          </td>
          <!-- Actions -->
          <td>
            <!-- Edit -->
            <?php $url = $this->Url->build(['action' => 'edit', $permissionCategory->id]) ?>
            <a href="<?= $url ?>" class="btn btn-sm btn-primary">
              <?= __('Edit') ?>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
