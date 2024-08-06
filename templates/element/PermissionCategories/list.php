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
        <th><?= $this->Paginator->sort('name', __d('ecr_permission_categories', 'Name')) ?></th>
        <th><?= $this->Paginator->sort('description', __d('ecr_permission_categories', 'Description')) ?></th>
        <th><?= $this->Paginator->sort('created', __d('ecr_common', 'Created')) ?></th>
        <th><?= $this->Paginator->sort('modified', __d('ecr_common', 'Modified')) ?></th>
        <th><?= __d('ecr_common', 'Actions') ?></th>
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
              <?= __d('ecr_common', 'Edit') ?>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
