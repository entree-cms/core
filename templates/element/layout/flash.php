<?php
/**
 * Flash message box
 *
 * @var ?array $options
 * @var ?string $key
 * @var Cake\View\View $this
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
