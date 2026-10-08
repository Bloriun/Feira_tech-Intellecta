<?php

declare(strict_types=1);

$cache = require __DIR__ . '/../data/mockData.php';
$people = $cache['people'];
?>
<div class="p-5 max-w-2xl mx-auto">
  <h1 class="text-2xl font-semibold">Explorar</h1>
  <input class="input mt-5" placeholder="Pesquisar usuários e publicações">

  <div class="mt-5 space-y-3">
    <?php foreach ($people as $person): ?>
      <div class="card p-4 flex gap-3 items-center">
        <div class="w-10 h-10 rounded-full bg-sage/40 flex items-center justify-center"><?= e(strtoupper(substr($person['name'], 0, 1))) ?></div>
        <div class="flex-1">
          <b><?= e($person['name']) ?></b>
          <p class="soft text-sm">@<?= e($person['username']) ?></p>
          <p class="text-sm mt-1"><?= e($person['bio']) ?></p>
        </div>
        <button class="btn btn-secondary text-sm" type="button">Perfil</button>
      </div>
    <?php endforeach; ?>
  </div>
</div>
