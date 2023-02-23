<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $this->fetch('title') ?></title>
  <?= $this->Html->meta('icon') ?>
  <?= $this->fetch('meta') ?>
  <?= $this->Html->css([
    'EntreeCore.common/style',
  ]) ?>
  <?= $this->fetch('css') ?>
  <?= $this->Html->script([
    'EntreeCore.common/app',
  ]) ?>
  <?= $this->fetch('script') ?>
</head>
<body class="bg-light">
  <?= $this->fetch('content') ?>
</body>
</html>
