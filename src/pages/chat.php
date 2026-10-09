<?php declare(strict_types=1); ?>

<header class="page-header">
  <div>
    <span class="eyebrow">Conecte-se sem ruído</span>
    <h1>Conversas</h1>
  </div>
  <button
    class="btn btn-primary"
    type="button"
    data-action="placeholder"
    data-message="Nova conversa em breve."
  >
    <?= icon('plus') ?> Nova conversa
  </button>
</header>

<div class="page-content">
  <div class="chat-layout">
    <section class="conversation-list" aria-label="Suas conversas">
      <div class="conversation-list__heading">
        <span class="eyebrow">Mensagens</span>
        <strong>Suas conversas</strong>
      </div>

      <label class="chat-search" for="chat-search">
        <span class="sr-only">Pesquisar conversas</span>
        <span class="icon"><?= icon('search') ?></span>
        <input
          class="input"
          id="chat-search"
          data-filter
          placeholder="Pesquisar alguém"
        >
      </label>

      <div class="conversation-list__items">
        <?php foreach ($people as $person): ?>
          <?php $isActive = $person['username'] === 'matheus'; ?>
          <a
            href="?page=chat"
            class="conversation <?= $isActive ? 'active' : '' ?>"
            data-filter-item
          >
            <div class="avatar"><?= e(initials($person['name'])) ?></div>
            <div class="conversation__copy">
              <div>
                <strong><?= e($person['name']) ?></strong>
                <time><?= $isActive ? 'agora' : 'ontem' ?></time>
              </div>
              <span>
                <?= $isActive
                  ? 'Perfeito. Se precisar, eu mando o resumo depois.'
                  : 'Última mensagem da conversa' ?>
              </span>
            </div>
            <?php if ($isActive): ?>
              <i class="conversation__unread" aria-label="Conversa ativa"></i>
            <?php endif; ?>
          </a>
        <?php endforeach; ?>
      </div>
    </section>

    <section class="chat-box" aria-label="Conversa com matheus">
      <header class="chat-box__head">
        <div class="avatar">M</div>
        <div class="chat-box__identity">
          <strong>matheus</strong>
          <span><i></i> online agora</span>
        </div>
        <button
          class="chat-more"
          type="button"
          aria-label="Mais opções"
          data-action="placeholder"
          data-message="Mais opções em breve."
        >
          •••
        </button>
      </header>

      <div class="chat-messages">
        <div class="chat-date"><span>Hoje</span></div>

        <?php foreach ($messages as $message): ?>
          <?php $isMine = $message['side'] === 'right'; ?>
          <div class="message-row <?= $isMine ? 'message-row--mine' : '' ?>">
            <div class="message <?= $isMine ? 'message--mine' : '' ?>">
              <p><?= e($message['text']) ?></p>
              <small><?= e($message['time']) ?></small>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <form
        class="chat-form"
        data-demo-form
        data-success="Mensagem enviada."
      >
        <label class="chat-composer">
          <span class="sr-only">Escreva uma mensagem</span>
          <input
            class="input"
            aria-label="Mensagem"
            placeholder="Escreva uma mensagem..."
            required
          >
          <button type="submit" aria-label="Enviar mensagem">
            <?= icon('send') ?>
          </button>
        </label>
      </form>
    </section>
  </div>
</div>
