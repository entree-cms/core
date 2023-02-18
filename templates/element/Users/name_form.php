<div class="d-flex flex-row gap-3">
  <?= $this->Form->exControl('first_name', [
    'label' => __d('users', 'First name'),
    'container' => ['class' => 'w-100'],
  ]) ?>

  <?= $this->Form->exControl('last_name', [
    'label' => __d('users', 'Last name'),
    'container' => ['class' => 'w-100'],
  ]) ?>
</div>
