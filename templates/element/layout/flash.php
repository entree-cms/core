<?php
/**
 * Flash message box
 *
 * @var ?array $container
 * @var ?array $options
 * @var ?string $key
 * @var Cake\View\View $this
 */
$key = $key ?? 'flash';
$options = $options ?? [];

$containerClass = $container['class'] ?? null;
if (is_string($containerClass)) {
  $containerClass = ' ' . trim($containerClass);
} else {
  $containerClass = '';
}
?>
<?php $message = $this->Flash->render($key, $options); ?>
<?php if ($message): ?>
  <div class="container-xxl<?= h($containerClass) ?>">
    <?= $message ?>
  </div>
<?php endif ?>
