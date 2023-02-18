<?php
/**
 * Form control
 *
 * @var ?string $class Additional class(es) for form container block
 * @var ?string $input Input field html
 * @var ?string $label Form label html
 * @var \EntreeCore\View\AppView $this The view
 */

$class = $class ?? '';
if ($class !== '') {
  $class = ' ' . $class;
}
$label = $label ?? null;
$input = $input ?? null;
?>
<div class="form-container<?= $class ?>">
  <?= $label ?>

  <div class="d-flex flex-column gap-1">
    <?= $input ?>

    <?= $translations ?>
  </div>
</div>
