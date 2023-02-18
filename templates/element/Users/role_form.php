<?php $isDisabled = $loginUser->cannot('editRole', $user) ?>
<?php $name = 'roles._ids.0'; ?>
<?= $this->Form->exControl($name, [
  'label' => __d('users', 'Role'),
  'type' => 'select',
  'container' => ['class' => 'w-100'],
  'disabled' => $isDisabled,
  'options' => $roleOptions,
  'required' => !$isDisabled,
  'val' => $this->request->getData($name,$user->roles[0]->id ?? ''),
]) ?>
