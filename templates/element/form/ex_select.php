
<?php
/**
 * @var string $name
 * @var ?string $class
 * @var ?array $attrs
 * @var ?array $options
 */

$class = $class ?? '';
if ($class !== '') {
  $class = ' ' . $class;
}

$attrs = $attrs ?? [];
?>
<?= $this->Form->select($name, $options, [
  'class' => "form-select{$class}",
] + $attrs); ?>
