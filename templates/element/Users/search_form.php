<form method="get">
  <div class="d-flex flex-row gap-2 align-items-center">
    <!-- Keyword -->
    <?= $this->Form->exInput('kw', [
      'inputContainer' => ['class' => 'flex-fill'],
      'placeholder' => __d('ecr_common', 'Keyword'),
      'prepend' => '<i class="fa-solid fa-magnifying-glass"></i>',
      'val' => $this->request->getQuery('kw'),
    ]) ?>
    <!-- Action -->
    <div>
      <button type="submit" class="btn btn-outline-secondary">
        <?= __d('ecr_common', 'Search') ?>
      </button>
    </div>
  </div>
</form>
