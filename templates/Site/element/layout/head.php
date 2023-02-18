<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="<?= $this->request->getAttribute('csrfToken') ?>">
  <title><?= $this->fetch('title') ?></title>
  <?= $this->Html->meta('icon') ?>
  <?= $this->fetch('meta') ?>
  <?= $this->element('EntreeCore.layout/head_css') ?>
  <?= $this->element('EntreeCore.layout/head_script') ?>
</head>
