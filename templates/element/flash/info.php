<?php
/**
 * Information flash element for bootstrap 5
 *
 * @var \Cake\View\View $this
 * @var array $params
 * @var string $message
 */
$class = 'alert alert-info';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="<?= h($class) ?>" onclick="this.classList.add('d-none');"><?= $message ?></div>
