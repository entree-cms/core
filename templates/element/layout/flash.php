<?php
/**
 * Flash message box
 *
 * @var Cake\View\View $this
 * @var string|null $key Flash key.
 * @var array|null $config Flash render options.
 */
$key = $key ?? 'flash';
$options = $options ?? [];
?>
<?php $message = $this->Flash->render($key, $options); ?>
<?php if ($message): ?>
  <div class="container-xxl">
    <?= $message ?>
  </div>
<?php endif ?>
