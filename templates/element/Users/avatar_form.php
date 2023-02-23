<?php
$isNoAvatar = $this->request->getData('no_avatar') === '1';

$avatarUrl = null;
if (!$isNoAvatar) {
  $avatarUrl = $user->avatar_url;
} else {
  $tmpUser = clone $user;
  $tmpUser->avatar = $user->getOriginal('avatar');
  $avatarUrl = $tmpUser->avatar_url;
}
?>
<!-- File form -->
<?= $this->Form->exControl('avatar_file', [
  'label' => __d('users', 'Avatar'),
  'type' => 'file',
  'class' => 'input-avatar-file',
  'prepend' => '<i class="fa-solid fa-circle-user small"></i>',
  'disabled' => $isNoAvatar,
]) ?>

<!-- Uploaded file -->
<?php if ($avatarUrl !== null): ?>
  <div class="d-flex flex-row flex-wrap align-items-center">
    <div class="me-3">
      <img src="<?= $avatarUrl ?>" class="d-block rounded-circle" width="64" height="64">
    </div>
    <div>
      <?php $checked = $isNoAvatar ? ' checked' : ''; ?>
      <input
        class="input-no-avatar" type="checkbox"<?= $checked ?>
        id="input-no-avatar"name="no_avatar" value="1">
      <label for="input-no-avatar">
        <?= __d('users', 'No avatar') ?>
      </label>
    </div>
  </div>
<?php endif; ?>
