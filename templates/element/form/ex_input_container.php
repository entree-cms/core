<?php
/**
 * Input field
 *
 * @var ?string $error Error message
 * @var ?string $input Input field html
 * @var ?string $append
 * @var ?string $prepend
 * @var \EntreeCore\View\AppView $this The view
 */
?>
<div class="input-container">
  <?php if (isset($prepend) || isset($append)): ?>
    <div class="input-group has-validation">
      <?php if (isset($prepend)): ?>
        <span class="input-group-text"><?= $prepend ?></span>
      <?php endif; ?>

      <?= $input ?>

      <?php if (isset($append)): ?>
        <span class="input-group-text"><?= $append ?></span>
      <?php endif; ?>

      <div class="invalid-feedback">
        <?= $error ?? '' ?>
      </div>
    </div>
  <?php else: ?>
    <?= $input ?>
    <div class="invalid-feedback">
      <?= $error ?? '' ?>
    </div>
  <?php endif; ?>
</div>
