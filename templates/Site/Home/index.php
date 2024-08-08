<?php
/**
 * @var \EntreeCore\View\AppView $this
 */

$this->assign('title', $this->configure->read('EntreeCore.Site.title'));
?>
<div class="container-xxl py-5">
  <h1 class="text-center"><?= __d('ecr_site_home', 'Home') ?></h1>
</div>
