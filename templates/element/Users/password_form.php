<?= $this->Form->exControl('password', [
  'label' => __d('ecr_users', 'Password'),
  'type' => 'password',
  'prepend' => '<i class="fa-solid fa-key small"></i>',
  'required' => $user->isNew(),
  'val' => '',
]) ?>
