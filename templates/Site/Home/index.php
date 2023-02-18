<?php
/**
 * @var \EntreeCore\View\AppView $this
 */

$pageTitle = __d('site_home', 'Home');
$this->assign('title', $pageTitle);
?>
<div class="container-xxl py-5">
  <h1 class="text-center"><?= $pageTitle ?></h1>
</div>
