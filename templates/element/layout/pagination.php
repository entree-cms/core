<?php if ($this->Paginator->total() > 1): ?>
  <nav class="my-4" aria-label="Page navigation">
    <ul class="pagination justify-content-center">
      <?= $this->Paginator->prev('< ' . __('Prev')) ?>
      <?= $this->Paginator->numbers([
        'first' => 2,
        'modulus' => 4,
        'last' => 2
      ]) ?>
      <?= $this->Paginator->next(__('Next') . ' >') ?>
    </ul>
  </nav>
<?php endif; ?>
