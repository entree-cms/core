<form method="get">
  <div class="d-flex flex-row gap-2 align-items-center">
    <!-- Keyword -->
    <?= $this->Form->exInput('kw', [
      'inputContainer' => ['class' => 'flex-fill'],
      'placeholder' => __('Keyword'),
      'prepend' => '<i class="fa-solid fa-magnifying-glass"></i>',
      'val' => $this->request->getQuery('kw'),
    ]) ?>
    <!-- Action -->
    <div>
      <button type="submit" class="btn btn-outline-secondary">
        <?= __('Search') ?>
      </button>
    </div>
  </div>
</form>
