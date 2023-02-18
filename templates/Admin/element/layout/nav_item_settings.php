<?php
/**
 * @var \EntreeCore\View\AppView $this
 */

$itemsHtml = $this->Nav->convertItemsToHtml($navItems, [
  'level' => 2,
]);
?>
<?php if (trim($itemsHtml) !== ''): ?>
  <!-- Settings -->
  <li class="nav-item dropdown">
    <?php $isActive = in_array($this->request->getParam('controller'), ['Settings']); ?>
    <?php $active = $isActive ? ' active' : ''; ?>
    <a
      id="nav-settings" class="nav-link dropdown-toggle<?= $active ?>" href="#"
      role="button" data-bs-toggle="dropdown" aria-expanded="false"
      >
      <?= __d('admin_layout', 'Settings') ?>
    </a>
    <ul class="dropdown-menu" aria-labelledby="nav-settings">
      <?= $itemsHtml ?>
    </ul>
  </li>
<?php endif; ?>
