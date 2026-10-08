<?php

declare(strict_types=1);

$cache = require __DIR__ . '/../data/mockData.php';
$notifications = $cache['notifications'];
?>
<div class="p-5 max-w-2xl mx-auto">
  <h1 class="text-2xl font-semibold">Notificações</h1>
  <div class="card mt-5 divide-y divide-line">
    <?php foreach ($notifications as $item): ?>
      <div class="p-4">
        <b><?= e($item['actor']) ?></b> <?= e($item['type']) ?>
        <div class="soft text-xs mt-1"><?= e($item['time']) ?></div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
