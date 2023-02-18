<?php
/**
 * @var \EntreeCore\View\AppView $this
 */
$this->assign('title', __d('login', 'Sign in'));

$this->Html->css([
  'EntreeCore.login',
], [
  'block' => true,
])
?>
<div class="login container-xxl">
  <h1 class="fs-2 py-4 text-center">
    <?= __d('login', 'Sign in') ?>
  </h1>

  <?= $this->Form->create() ?>
    <div class="card">
      <div class="card-body py-4">

        <?= $this->Flash->render('flash', [
          'params' => [
            'class' => 'p-2 text-center mb-4',
          ],
        ]) ?>

        <?= $this->element('EntreeCore.Users/login_form') ?>

        <div class="text-center mt-4">
          <button type="submit" class="btn btn-success">
            <?= __d('login', 'Sign in') ?>
          </button>
        </div>
      </div>
    </div>
  <?= $this->Form->end() ?>
</div>
