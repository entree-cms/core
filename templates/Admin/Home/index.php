<?php
/**
 * @var \EntreeCore\View\AppView $this
 */

$pageTitle = __d('admin_home', 'Home');
$this->assign('title', $this->makeTitle($pageTitle));

$this->Breadcrumbs->add([
  ['title' => __d('admin_home', 'Home')],
]);
?>
<div class="container-xxl">
  <h1><?= $pageTitle ?></h1>
</div>
