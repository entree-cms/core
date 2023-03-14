<?php
/**
 * @var \EntreeCore\View\AppView $this
 */

?>
<header class="navbar navbar-expand-sm bg-white border-bottom sticky-top">
  <div class="container-xxl">
    <!-- Title -->
    <a class="navbar-brand" href="<?= $this->Configure->read('Entree.Site.homeUrl', $this->Url->build('/')) ?>">
      <?= $this->Configure->read('Entree.Site.title') ?>
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
        <?php if ($loginUser): ?>
          <!-- Login user -->
          <?= $this->element('EntreeCore.layout/header_login_user') ?>
        <?php endif; ?>
      </div>

      <!-- Locale  -->
      <?= $this->element('EntreeCore.layout/locale_nav') ?>
    </nav>
  </div>
</header>
