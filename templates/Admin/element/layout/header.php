<?php
/**
 * @var \EntreeCore\View\AppView $this
 */

$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');
?>
<header class="navbar navbar-expand-md navbar-dark bg-dark py-1">
  <div class="container-xxl">
    <!-- Title -->
    <?php $url = $this->Url->build(['controller' => 'Home', 'action' => 'index']) ?>
    <a class="navbar-brand" href="<?= $url ?>">
      <?= $this->Configure->read('Entree.Admin.title') ?>
    </a>

    <!-- Toggler -->
    <button
      class="navbar-toggler" type="button"
      data-bs-toggle="collapse" data-bs-target="#site-header-nav"
      aria-controls="site-header-nav" aria-expanded="false" aria-label="Toggle navigation"
      >
      <span class="navbar-toggler-icon"></span>
    </button>

    <nav class="collapse navbar-collapse" id="site-header-nav">
      <!-- Menu -->
      <div>
        <?= $this->element('EntreeCore.layout/header_nav') ?>
      </div>

      <div class="ms-auto">
        <!-- Login user -->
        <?= $this->element('EntreeCore.layout/header_login_user', [], ['plugin' => false]) ?>
      </div>

      <!-- Locale  -->
      <?= $this->element('EntreeCore.layout/locale_nav') ?>
    </nav>
  </div>
</header>
