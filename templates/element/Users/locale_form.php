<?= $this->Form->exControl('locale', [
  'label' => __d('ecr_users', 'Locale'),
  'type' => 'select',
  'prepend' => '<i class="fa-solid fa-globe small"></i>',
  'options' => $localeOptions,
]) ?>
