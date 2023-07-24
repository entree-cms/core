<?php
/**
 * @var \EntreeCore\Model\Entity\User $loginUser The logged in user
 * @var \EntreeCore\View $view The view
 */

$prefix = $this->request->getParam('prefix');
?>
<ul class="login-user-nav navbar-nav">
  <li class="nav-item dropdown">
    <!-- Name of the logged in user -->
    <a
      class="nav-link dropdown-toggle d-flex flex-row align-items-center gap-2 py-1"
      id="dropdown-login-user" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
      >
      <?= $this->element('EntreeCore.Users/avatar', ['user' => $loginUser, 'size' => 32]) ?>
      <span class="name"><?= h($loginUser->name) ?></span>
    </a>

    <!-- Menu items -->
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-login-user">
      <!-- Site -->
      <?php if ($prefix !== 'Site'): ?>
        <?php $url = $this->Url->build([
          'plugin' => 'EntreeCore',
          'prefix' => 'Site',
          'controller' => 'Home',
          'action' => 'index'
        ]); ?>
        <a class="dropdown-item" href="<?= $url ?>">
          <?= __d('login_user_nav', 'Open the site') ?>
        </a>
      <?php endif ?>
      <!-- Admin settings -->
      <?php if ($prefix !== 'Admin' && $loginUser && $loginUser->can('access admin')): ?>
        <?php $url = $this->Url->build([
          'plugin' => 'EntreeCore',
          'prefix' => 'Admin',
          'controller' => 'Home',
          'action' => 'index'
        ]); ?>
        <a class="dropdown-item" href="<?= $url ?>">
          <?= __d('login_user_nav', 'Open the admin settings') ?>
        </a>
      <?php endif ?>

      <!-- Divider -->
      <div><hr class="dropdown-divider"></div>

      <!-- Profile -->
      <?php $url = $this->Url->build([
        'plugin' => 'EntreeCore',
        'controller' => 'Users',
        'action' => 'profile'
      ]); ?>
      <a class="dropdown-item" href="<?= $url ?>">
        <?= __d('login_user_nav', 'Profile') ?>
      </a>

      <!-- Logout -->
      <?php $url = $this->Url->build([
        'plugin' => 'EntreeCore',
        'prefix' => '',
        'controller' => 'Users',
        'action' => 'logout'
      ]); ?>
      <a class="dropdown-item" href="<?= $url ?>">
        <?= __d('login_user_nav', 'Sign out') ?>
      </a>
    </div>
  </li>
</ul>
