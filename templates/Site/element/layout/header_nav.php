<?php
/**
 * @param \EntreeCore\View\AppView $this
 */
?>
<ul class="navbar-nav">
  <?= $this->Nav->convertItemsToHtml($this->Configure->read('EntreeCore.Site.navItems')); ?>
</ul>
