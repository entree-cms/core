<!DOCTYPE html>
<html lang="ja">
<?= $this->element('EntreeCore.layout/head') ?>
<body class="bg-light">
  <?= $this->element('EntreeCore.layout/header') ?>

  <?= $this->element('EntreeCore.layout/breadcrumbs') ?>

  <?= $this->fetch('content') ?>
</body>
</html>
