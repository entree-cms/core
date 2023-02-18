<?php
/**
 * @var \EntreeCore\View\AppView $this The view
 * @var array $locales Locales
 */

if (count($locales) === 0) {
  return '';
}

$localeOptions = array_map(function ($locale) {
  return ['text' => __d('languages', $locale), 'value' => $locale];
}, $locales);

?>
<div class="locale-nav">
  <?= $this->Form->exInput('locale', [
    'type' => 'select',
    'class' => 'form-select-sm',
    'options' => $localeOptions,
    'val' => $this->request->getSession()->read('locale'),
    'data-api-url' => $apiUrl = $this->Url->build([
      'plugin' => 'EntreeCore',
      'prefix' => 'Api',
      'controller' => 'Configs',
      'action' => 'setLocale',
    ]),
  ]) ?>
</div>
