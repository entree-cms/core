
<?php
/**
 * @var string $type
 * @var string $name
 * @var ?string $class
 * @var ?array $attrs
 */

$class = $class ?? '';
if ($class !== '') {
  $class = ' ' . $class;
}

$attrs = $attrs ?? null;
$attrsText = is_array($attrs) ? $this->Html->makeAttrsText($attrs) : '';
?>
<input
  type="<?= h($type) ?>" name="<?= $name ?>" class="form-control<?= $class ?>"
  <?= $attrsText ?>>
