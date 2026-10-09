<?php declare(strict_types=1); ?>

<header class="page-header home-page-header">
  <div>
    <span class="eyebrow">Terça, 08 de outubro · comunidade online</span>
    <h1>Seu espaço, suas ideias.</h1>
    <p class="page-header__lead">
      Um lugar para aprender em voz alta, encontrar pessoas e deixar suas
      descobertas circularem.
    </p>
  </div>

  <button
    class="btn btn-primary"
    type="button"
    data-action="placeholder"
    data-message="A criação de publicação está pronta para ser conectada."
  >
    + Publicar
  </button>
</header>

<div class="page-content home-page">
  <section class="card composer">
    <div class="avatar">M</div>

    <div class="composer__body">
      <form
        data-demo-form
        data-success="Sua publicação foi salva no modo demonstração."
      >
        <label class="form-label" for="new-post">
          <span class="muted">Compartilhe algo com a comunidade</span>
          <textarea
            class="composer-input"
            id="new-post"
            rows="2"
            placeholder="O que está passando pela sua cabeça?"
          ></textarea>
        </label>

        <div class="composer__actions">
          <button
            class="btn btn-ghost"
            type="button"
            data-action="placeholder"
            data-message="Anexos estarão disponíveis em breve."
          >
            <?= icon('image') ?> mídia
          </button>
          <button
            class="btn btn-ghost"
            type="button"
            data-action="placeholder"
            data-message="A opção de enquete estará disponível em breve."
          >
            <?= icon('spark') ?> enquete
          </button>
          <button class="btn btn-primary" type="submit">Publicar</button>
        </div>
      </form>
    </div>
  </section>

  <div class="feed-heading">
    <div>
      <span class="eyebrow">Agora na comunidade</span>
      <h2>Conversas recentes</h2>
    </div>
    <span class="feed-heading__line"></span>
  </div>

  <div class="list home-feed">
    <?php foreach ($feed as $post): ?>
      <article class="card post" data-filter-item>
        <div class="post__head">
          <div class="avatar"><?= e(initials($post['name'])) ?></div>
          <div class="post__meta">
            <strong><?= e($post['name']) ?></strong>
            <span>@<?= e($post['username']) ?> · <?= e($post['time']) ?></span>
          </div>
          <button
            class="btn btn-ghost"
            type="button"
            data-action="placeholder"
            data-message="Mais opções em breve."
            aria-label="Mais opções"
          >
            •••
          </button>
        </div>

        <p class="post__body"><?= e($post['body']) ?></p>

        <div class="post__footer">
          <button class="btn btn-ghost" type="button" data-like aria-pressed="false">
            ♡ <span data-count><?= (int) $post['likes'] ?></span>
          </button>
          <button
            class="btn btn-ghost"
            type="button"
            data-action="placeholder"
            data-message="Comentários em breve."
          >
            <?= icon('message') ?> <?= (int) $post['comments'] ?>
          </button>
          <span class="post__stats"><?= e($post['time']) ?></span>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</div>
