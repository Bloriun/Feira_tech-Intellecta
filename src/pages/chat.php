<?php

declare(strict_types=1);

$cache = require __DIR__ . '/../data/mockData.php';
$people = $cache['people'];
$messages = $cache['messages'];
?>
<div class="p-5 max-w-4xl mx-auto">
  <h1 class="text-2xl font-semibold">Chat</h1>

  <div class="grid lg:grid-cols-[280px_1fr] gap-5 mt-5">
    <div class="card p-4">
      <input class="input mb-4" placeholder="Pesquisar conversa">
      <div class="space-y-2">
        <?php foreach ($people as $person): ?>
          <div class="flex items-center gap-3 p-3 rounded-xl bg-[#11140C]/35">
            <div class="w-10 h-10 rounded-full bg-sage/40 flex items-center justify-center"><?= e(strtoupper(substr($person['name'], 0, 1))) ?></div>
            <div>
              <b class="block"><?= e($person['name']) ?></b>
              <span class="soft text-sm">Última mensagem...</span>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="card p-4 min-h-[520px] flex flex-col">
      <div class="flex items-center gap-3 pb-4 border-b border-line">
        <div class="w-11 h-11 rounded-full bg-sage/40 flex items-center justify-center">M</div>
        <div>
          <b>matheus</b>
          <div class="soft text-sm">online agora</div>
        </div>
      </div>

      <div class="flex-1 py-5 space-y-4 overflow-auto">
        <?php foreach ($messages as $message): ?>
          <div class="<?= $message['side'] === 'right' ? 'text-right' : '' ?>">
            <div class="inline-block max-w-[85%] rounded-2xl px-4 py-3 <?= $message['side'] === 'right' ? 'bg-[#c7d36a] text-[#11140C]' : 'bg-[#292d22]' ?>">
              <div><?= e($message['text']) ?></div>
              <div class="text-[10px] mt-1 opacity-70"><?= e($message['time']) ?></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="flex gap-2 pt-4 border-t border-line">
        <input class="input rounded-full" placeholder="Mensagem">
        <button class="btn btn-primary">Enviar</button>
      </div>
    </div>
  </div>
</div>
