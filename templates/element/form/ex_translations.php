<?php
/**
 * @var \EntreeCore\View\AppView $this The view
 * @var array $translationLocales The locales
 * @var string $field The field name
 * @var \Cake\ORM\Entity $entity The entity
 */
?>
<div class="translations">
  <?php foreach ($translationLocales as $locale): ?>
    <?php $name = "_translations.{$locale}.{$field}"; ?>
    <?php $language = __d('languages', $locale); ?>
    <?= $this->Form->exControl($name, [
      'label' => false,
      'val' => $this->request->getData($name, $entity->translation($locale)->{$field}),
      'prepend' => "<span class=\"small\">{$language}</span>",
    ]) ?>
  <?php endforeach ?>
</div>
