<?= $this->Form->exControl('locale', [
  'label' => __d('users', 'Locale'),
  'type' => 'select',
  'prepend' => '<i class="fa-solid fa-globe small"></i>',
  'options' => $localeOptions,
]) ?>
