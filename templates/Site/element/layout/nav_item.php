<?php
/**
 * Header navigation item
 *
 * @var bool|null $isActive Active flag
 * @var bool|null $isDisabled Disabled flag
 * @var int|null $level Layer level
 * @var string $title The title
 * @var string $url The url
 */

$isActive = $isActive ?? null;
$active = ($isActive === true) ? ' active' : '';

$ariaCurrent = $isActive ? ' aria-current="page"' : '';

$isDisabled = $isDisabled ?? null;
$disabled = ($isDisabled === true) ? ' disabled' : '';

$level = $level ?? null;
?>
<?php if (!is_numeric($level) || $level <= 1): ?>
  <li class="nav-item">
    <a class="nav-link<?= $disabled ?><?= $active ?>" href="<?= $url ?>"<?= $ariaCurrent ?>>
      <?= h($title) ?>
    </a>
  </li>
<?php else: ?>
  <li>
    <a class="dropdown-item<?= $disabled ?><?= $active ?>" href="<?= $url ?>"<?= $ariaCurrent ?>>
      <?= h($title) ?>
    </a>
  </li>
<?php endif; ?>
