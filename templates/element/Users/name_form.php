<div class="d-flex flex-row gap-3">
  <?php foreach ($this->Configure->read('Entree.personalNameOrder') as $prefix): ?>
    <?php $field = "{$prefix}_name"; ?>
    <?php $label = ucfirst($prefix) . ' name'; ?>
    <?= $this->Form->exControl($field, [
      'label' => __d('users', $label),
      'container' => ['class' => 'w-100'],
    ]) ?>
  <?php endforeach; ?>
</div>
