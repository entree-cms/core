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
        <th><?= $this->Paginator->sort('name', __d('ecr_roles', 'Name')) ?></th>
        <th><?= $this->Paginator->sort('code', __d('ecr_roles', 'Code')) ?></th>
        <th><?= $this->Paginator->sort('description', __d('ecr_roles', 'Description')) ?></th>
        <th><?= $this->Paginator->sort('created', __d('ecr_roles', 'Created')) ?></th>
        <th><?= $this->Paginator->sort('modified', __d('ecr_roles', 'Modified')) ?></th>
        <th><?= __d('ecr_common', 'Actions') ?></th>
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
              <?= __d('ecr_common', 'Edit') ?>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
