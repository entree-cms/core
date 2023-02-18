<?php
/**
 * @var \EntreeCore\Model\User\Entity $user The user
 * @var int|null $fontSize Font size of the initial
 * @var int|null $size Display size
 */

// Icon size
$size = $size ?? 32;

// Font size
$fontSize = $fontSize ?? null;
if (!is_numeric($fontSize)) {
  $fontSize = floor($size * .6);
}

// User's name
$userName = $user->name;
?>
<?php if ($user->avatar): ?>
  <img
    class="d-block rounded-circle" src="<?= $user->avatar_url ?>"
    width="<?= $size ?>" height="<?= $size ?>">
<?php else: ?>
  <div
    class="bg-secondary rounded-circle text-white d-flex align-items-center justify-content-center"
    style="font-size: <?= $fontSize ?>px; width: <?= $size ?>px; height: <?= $size ?>px;">
    <?= mb_substr($userName, 0, 1) ?>
  </div>
<?php endif; ?>
