<?php
/**
 * @var \EntreeCore\View\AppView $this
 */

$this->assign('title', $this->configure->read('Entree.Site.title'));
?>
<div class="container-xxl py-5">
  <h1 class="text-center"><?= __d('site_home', 'Home') ?></h1>
</div>
