<?php
/**
 * @var ?bool $escape
 * @var bool|string|null $url
 * @var mixed $value
 */

$escape ??= true;
if ($escape !== false && isset($value)) {
  $value = h($value);
}

$url ??= null;
if ($url === true) {
  $url = $value;
}
?>
<?php if (is_string($url) && $url !== ''): ?>
  <a href="<?= $url ?>">
    <?= $value ?>
  </a>
<?php elseif (isset($value) && $value !== ''): ?>
  <?= $value ?>
<?php else: ?>
  <span class="text-muted">-</span>
<?php endif; ?>
