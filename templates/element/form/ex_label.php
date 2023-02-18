<?php
/**
 * @var ?array $attrs
 * @var ?string $labelText
 * @var ?string $labelClass
 * @var ?bool $required
 */

$attrsText = is_array($attrs) ? $this->Html->makeAttrsText($attrs) : '';
?>
<?php if (is_string($labelText) && $labelText !== ''): ?>
  <!-- Label -->
  <label class="form-label<?= $labelClass ?>"<?= $attrsText ?>>
    <?= $labelText ?>
    <?php if ($required): ?>
      <span class="badge align-items-center fw-normal ms-2 px-2 small text-bg-danger">
        <?= __('Required') ?>
      </span>
    <?php endif; ?>
  </label>
<?php endif; ?>
