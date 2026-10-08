<?php

declare(strict_types=1);

$cache = require __DIR__ . '/../data/mockData.php';
$feed = $cache['feed'];
?>
<div class="p-5 max-w-2xl mx-auto">
  <div class="card p-4">
    <div class="flex items-start gap-3">
      <div class="w-10 h-10 rounded-full bg-sage/40 flex items-center justify-center">M</div>
      <div class="flex-1">
        <div class="card bg-transparent border-line p-4">
          <p class="soft">O que você está pensando?</p>
        </div>
        <div class="flex gap-3 mt-3 text-lg soft">
          <span>◻</span><span>▭</span><span>⌁</span>
          <button class="ml-auto btn btn-primary text-sm" type="button">Post</button>
        </div>
      </div>
    </div>
  </div>

  <div class="mt-5 space-y-4">
    <?php foreach ($feed as $post): ?>
      <article class="card p-4">
        <div class="flex gap-3">
          <div class="w-10 h-10 rounded-full bg-sage/40 flex items-center justify-center"><?= e(strtoupper(substr($post['name'], 0, 1))) ?></div>
          <div class="flex-1">
            <div class="flex items-center gap-2">
              <b><?= e($post['name']) ?></b>
              <span class="soft text-sm">@<?= e($post['username']) ?> · <?= e($post['time']) ?></span>
            </div>
            <p class="mt-3 whitespace-pre-wrap"><?= e($post['body']) ?></p>
            <div class="mt-4 flex gap-4 soft text-sm">
              <span>♥ <?= (int) $post['likes'] ?></span>
              <span>◫ <?= (int) $post['comments'] ?></span>
            </div>
            <div class="mt-3 flex gap-2">
              <button class="btn btn-secondary text-sm" type="button">Curtir</button>
              <button class="btn btn-secondary text-sm" type="button">Comentar</button>
              <button class="btn btn-secondary text-sm" type="button">Editar</button>
              <button class="btn btn-secondary text-sm" type="button">Excluir</button>
            </div>
          </div>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</div>
