<?php
/**
 * @var \EntreeCore\Model\Entity\Role $role The role
 * @var \EntreeCore\View\AppView $this The view
 * @var iterable<\EntreeCore\Model\Entity\PermissionCategory> $permissionCategories The permission categories
 */
?>
<?php foreach ($permissionCategories as $permissionCategory): ?>
  <dl>
    <!-- Category name -->
    <dt class="ms-1 mb-1 fw-normal text-secondary small">
      <?= h($permissionCategory->name) ?>
    </dt>
    <!-- Permission list -->
    <dd>
      <ul class="list-group">
        <?php $defaultIds = $this->request->getData('permissions._ids', $role->permission_ids); ?>
        <?php foreach ($permissionCategory->permissions as $permission): ?>
          <?php $checked = (in_array($permission->id, $defaultIds)) ? ' checked' : ''; ?>
          <li class="list-group-item list-group-item-action">
            <input
              class="form-check-input me-1" type="checkbox"
              id="input-permission-id-<?= $permission->id ?>"
              name="permissions[_ids][]" value="<?= $permission->id ?>"
              <?= $checked ?>>
            <label class="form-check-label stretched-link" for="input-permission-id-<?= $permission->id ?>">
              <?= h($permission->name) ?>
            </label>
          </li>
        <?php endforeach; ?>
      </ul>
    </dd>
  </dl>
<?php endforeach; ?>
